<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendMessage;
use App\Resident;
use App\Landlord;
use App\User;
use App\Services\Sms;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkActivation:MESSAGING_ACTIVATED');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $messages = Message::where('content', 'ilike', '%' . $request->q . '%')
                ->orWhere('channel', 'ilike', '%' . $request->q . '%')
                ->paginate(20);
            return view('admin.messages.index')
                ->with('messages', $messages);
        }
        $messages = Message::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.messages.index')
            ->with('messages', $messages);
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
        $validatedData = $request->validate([
            'content' => 'required|max:255',
            'recepient' => 'required',
            'channel' => 'required',
        ]);

        $message = new Message;
        $message->content = $request->content;
        $message->recepient = $request->recepient;
        $message->channel = $request->channel;
        $message->user_id = $request->user()->id;
        // $message->save();

        if ($request->channel == 'email') {
            $recepients = $this->getEmailRecepients($message->recepient);

            if ($recepients != false && $recepients->isNotEmpty()) {
                \Mail::bcc($recepients)->send(new SendMessage($message));

                request()->session()->flash('message', 'Message has been sent!');
            } else {
                request()->session()->flash('error', 'Message was not sent! Receipients can not be blank.');
            }
            return back();
        }

        if ($request->channel == 'sms') {
            // Resipients ia a list of phone numbers seperated by coma
            $recepients = $this->getSMSRecepients($message->recepient);

            if ($recepients != false &&  $recepients != '') {
                $smsCreditNeeded = ceil(strlen($message->content) / 145) * count(explode(',', $recepients));

                $smsCreditAvailable = settings('SMS_REMAINING');

                if ($smsCreditAvailable >= $smsCreditNeeded) {
                    $sms = new Sms();
                    $sms->sendMessage($message->content, $recepients);

                    $smsCreditRemaining = $smsCreditAvailable - $smsCreditNeeded;
                    settings()->put('SMS_REMAINING', $smsCreditRemaining);

                    request()->session()->flash('message', 'Your message has been sent!');
                    return back();
                }

                session()->flash('error', 'You do not have enough SMS credit.');
                return back();
            } else {
                request()->session()->flash('error', 'Message was not sent! Receipients can not be empty.');
            }
            return back();
        }
    }

    public function getEmailRecepients($recepientType)
    {
        if ($recepientType == 'resident') {
            $recepients = Resident::where('email', '!=', null)->get(['fullname AS name', 'email']);
        } elseif ($recepientType == 'landlord') {
            $recepients = Landlord::where('email', '!=', null)->get(['fullname AS name', 'email']);
        } elseif ($recepientType == 'all') {
            $recepients = User::where('email', '!=', null)->get(['name', 'email']);
        } else {
            return false;
        }

        return $recepients;
    }


    public function getSMSRecepients($recepientType)
    {
        if ($recepientType == 'resident') {
            $recepients = Resident::where('phone', '!=', null)->pluck('phone');
        } elseif ($recepientType == 'landlord') {
            $recepients = Landlord::where('phone', '!=', null)->pluck('phone');
        } elseif ($recepientType == 'all') {
            $landlordRecepients = Landlord::where('phone', '!=', null)->pluck('phone');
            $tenantRecepients = Resident::where('phone', '!=', null)->pluck('phone');
            $recepients = $landlordRecepients->merge($tenantRecepients);
        } else {
            return false;
        }

        // Convert to international format
        $formatedRecipients = collect();
        $recepients->each(function ($item, $key) use ($formatedRecipients) {
            if (Str::startsWith($item, '+')) {
                $formatedRecipients->push($item);
            }else {
                try {
                    $formatedNo = PhoneNumber::make($item, 'NG')->formatE164();
                    $formatedRecipients->push($formatedNo);
                } catch (\Throwable $th) {}
            }
        });

        $recepients = $formatedRecipients;

        return $recepients->unique()->values()->implode(',');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('admin.messages.show ')->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
