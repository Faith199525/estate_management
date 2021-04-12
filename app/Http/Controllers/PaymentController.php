<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceipt;
use App\Services\Pdf;
use Carbon\Carbon;

// use function GuzzleHttp\json_encode;

class PaymentController extends Controller
{
  public function sendReceipt($payment)
  {
    return Mail::to($payment->user)->send(new PaymentReceipt($payment));
  }

  public function downloadReceipt(Request $request, Pdf $pdfGenerator)
  {
    $payment = Payment::findOrFail($request->id);
    if (!$payment) {
      return view(404);
    }
    if ($payment->user_id != $request->user()->id) {
      request()->session()->flash('error', 'You are not allowed.');
      return back();
    }

    $pdf = $pdfGenerator->generateReceipt($payment);
    if ($request->input('d') == 1) {
      return $pdf->download('receipt.pdf');
    }
    return $pdf->inline('receipt.pdf');
  }

  public function dues(Request $request)
  {
    if (settings('PAYMENT_ACTIVATED') != true) {
      return back()->with('error', 'You are not permited to view that page');
    }

    if (\Auth::user()->landlord && \Auth::user()->residents->isNotEmpty()) {
      $dues = \App\Due::where('payer', 'residentLandlord')->orWhere('payer', 'allLandlord')->get();
    } elseif (\Auth::user()->landlord && \Auth::user()->residents->isEmpty()) {
      $dues = \App\Due::where('payer', 'allLandlord')->get();
    } elseif (\Auth::user()->residents->isNotEmpty() && !\Auth::user()->landlord) {
      $dues = \App\Due::where('payer', 'resident')->get();
    } else {
      request()->session()->flash('error', 'Something went wrong. You are not allowed to view that page!');
      return back();
    }
    $payments = $request->user()->payments()->orderBy('created_at', 'desc')->get();
    $newStandings = $this->calculateStandingDue();
    return view('dues')->with('payments', $payments)->with('dues', $dues)->with('newStandings', $newStandings);
  }

  public function verrifyTransactions($payment)
  {
    //The parameter after verify/ is the transaction reference to be verified
    $url = 'https://api.paystack.co/transaction/verify/' . $payment->trans_ref;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
      $ch,
      CURLOPT_HTTPHEADER,
      [
        'Authorization: Bearer ' . env('PAYSTACK_SECRET_KEY')
      ]
    );
    $request = curl_exec($ch);
    curl_close($ch);

    if ($request) {
      $result = json_decode($request, true);
      // print_r($result);
      if ($result) {
        if ($result['data']) {
          //something came in
          if ($result['data']['status'] == 'success') {
            // the transaction was successful, you can deliver value
            /* 
                  @ also remember that if this was a card transaction, you can store the 
                  @ card authorization to enable you charge the customer subsequently. 
                  @ The card authorization is in: 
                  @ $result['data']['authorization']['authorization_code'];
                  @ PS: Store the authorization with this email address used for this transaction. 
                  @ The authorization will only work with this particular email.
                  @ If the user changes his email on your system, it will be unusable
                  */
            //   echo "Transaction was successful";

            $payment->authorization_code = $result['data']['authorization']['authorization_code'];
            $payment->paystack_dump = json_encode($result);
            $payment->save();

            // Send Receipt
            $this->sendReceipt($payment);
            // Mail::to($request->user())->send(new PaymentReceipt($payment));

            return 'success';
          } else {
            // the transaction was not successful, do not deliver value'
            // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
            return 'failed';
            echo "Transaction was not successful: Last gateway response was: " . $result['data']['gateway_response'];
          }
        } else {
          echo $result['message'];
        }
      } else {
        //print_r($result);
        die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
      }
    } else {
      //var_dump($request);
      die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
    }


    return $request;
  }

  public function process_payment(Request $request)
  {
    if ($request->dues_paid && $request->amount > 0) {
      $payment = new Payment;
      $payment->amount = $request['amount']; // Amount is saved in kobo
      $payment->note = 'My dues';
      $payment->user_id = $request->user()->id;
      $payment->channel = 'platform';
      $payment->trans_ref = $request['trans_ref'];
      $payment->dues_paid = json_encode($request['dues_paid']);
      $payment->save();

      $this->verrifyTransactions($payment);

      $this->updateStandingDue($request['dues_paid']);    
      
      // Send receipt to email

      request()->session()->flash('message', 'Your payment was successfu!');
      return response()->json(array(
        'success' => true,
        'msg' => 'Your Payment was successful!'
      ));
    } else {

      return response()->json(array(
        'error' => true,
        'msg' => 'Your Dues payment failed. Kindly select a due to pay!'
      ), 403);
    }
  }

  public function process_payment_through_admin(Request $request)
  {
    if (settings('MANUAL_DUE_MANAGEMENT_ACTIVATED') != true) {
      return back()->with('error', 'You are not permited');
    }

    if ($request->dues_paid && $request->amount > 100) {
      $payment = new Payment;
      $payment->amount = $request['amount']; // Amount is saved in kobo
      $payment->note = '';
      $payment->user_id = $request['user_id'];
      $payment->channel = $request['channel'];
      $payment->created_by = $request->user()->id;
      $payment->dues_paid = json_encode($request['dues_paid']);
      $payment->save();

      if ($request->filled('receipt')) {
        // Send Receipt to user email.
        $this->sendReceipt($payment);
      }

      request()->session()->flash('message', 'Due has been added for user!');
      return response()->json(array(
        'success' => true,
        'msg' => 'Your Payment was successful!'
      ));
    } else {

      return response()->json(array(
        'error' => true,
        'msg' => 'Dues payment failed. Kindly select a due and pay an amount greater than ₦100!'
      ), 403);
    }
  }

  public function updateStandingDue($dues_paid)
  {
    $dues = json_decode(json_encode($dues_paid)); 
  
      foreach($dues as $singleDue) {

        $oldStanding = PaymentStatus::firstOrCreate(['user_id' => \Auth::user()->id, 'dues_id' => \App\Due::where('name', $singleDue->{'name'})->first()->id],
         ['standing' => '0', 'reference_date' => Carbon::now(), 'uploaded_excel' => 'false']);      

        $totalStanding = $this->calculateStandingDue($singleDue);
        $amount_paid = (int)$singleDue->{'amount_paid'};
        $newStanding = (int)$totalStanding + $amount_paid;

        $oldStanding->update([
          'standing' => $newStanding,
          'reference_date' => Carbon::now()
        ]);
                
      }
    
  }

  public function calculateStandingDue($singleDue = null) //optional parameter, during payment, this parameter is passed but during view rendering, its not passed
  {
    if($singleDue == null){

        $dues = PaymentStatus::with('due')->where('user_id', \Auth::user()->id)->get();
    
        foreach($dues as $due){
          $oldStanding = (int)$due->standing;
          $due_amount = (int)$due->due->amount / 100;
          $reference_date = Carbon::parse($due->reference_date);
    
          switch($due->due->type){
            case "daily":
              $difference_in_date = $reference_date->diffInDays(Carbon::now());
              break;
            case "weekly":
              $difference_in_date = $reference_date->diffInWeeks(Carbon::now());
              break;
            case "monthy":
              $difference_in_date = $reference_date->diffInMonths(Carbon::now());
              break;
            case "yearly":
              $difference_in_date = $reference_date->diffInYears(Carbon::now());
              break;
            case "oneTime":
              $difference_in_date = 0;
              break;
          }
    
          $standing_overtime = $difference_in_date == '0' ? 0 : $due_amount * (int)$difference_in_date;
          $newStanding = ($standing_overtime * -1) + $oldStanding;
    
          $due->standing = $newStanding;
        }
    
        return $dues;

    } else {

        $single = PaymentStatus::with('due')->where('user_id', \Auth::user()->id)->where('dues_id', \App\Due::where('name', $singleDue->{'name'})->first()->id) ->first();
    
        $oldStanding = (int)$single->standing;
        $due_amount = (int)$single->due->amount / 100;
        $reference_date = Carbon::parse($single->reference_date);
  
        switch($single->due->type){
          case "daily":
            $difference_in_date = $reference_date->diffInDays(Carbon::now());
            break;
          case "weekly":
            $difference_in_date = $reference_date->diffInWeeks(Carbon::now());
            break;
          case "monthy":
            $difference_in_date = $reference_date->diffInMonths(Carbon::now());
            break;
          case "yearly":
            $difference_in_date = $reference_date->diffInYears(Carbon::now());
            break;
          case "oneTime":
            $difference_in_date = 0;
            break;
        }
  
        $standing_overtime = $difference_in_date == '0' ? 0 : $due_amount * (int)$difference_in_date;
        $newStanding = ($standing_overtime * -1) + $oldStanding;    

        return $newStanding;
    }


  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if (settings('PAYMENT_ACTIVATED') != true && settings('MANUAL_DUE_MANAGEMENT_ACTIVATED') != true) {
      return back()->with('error', 'You are not permited to view that page');
    }

    if ($request->q) {
      $payments = Payment::where('name', 'ilike', '%' . $request->q . '%')
        ->orWhere('details', 'ilike', '%' . $request->q . '%')
        ->orWhere('amount', 'ilike', '%' . $request->q . '%')
        ->paginate(20);
      return view('admin.payments.index')
        ->with('payments', $payments);
    }

    $payments = Payment::orderBy('created_at', 'desc')->paginate(20);
    return view('admin.payments.index')->with('payments', $payments);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Payment  $payment
   * @return \Illuminate\Http\Response
   */
  public function show(Payment $payment)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Payment  $payment
   * @return \Illuminate\Http\Response
   */
  public function edit(Payment $payment)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Payment  $payment
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Payment $payment)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Payment  $payment
   * @return \Illuminate\Http\Response
   */
  public function destroy(Payment $payment)
  {
    //
  }
}
