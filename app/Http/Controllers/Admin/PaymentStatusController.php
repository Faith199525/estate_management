<?php

namespace App\Http\Controllers\Admin;

use App\Imports\PaymentDetails;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Validation\Rule;
use App\User;

class PaymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.paymentStatus.index');
    }

    public function import(Request $request)
    {      
        $validatedData = $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('file')->store('import');

        $import= new PaymentDetails;
        $import->import($file);
        //dd($import->errors());
        // Excel::import(new PaymentDetails, $file);

        if($import->failures()->isNotEmpty()){
            return back()->withFailures($import->failures());
        }
        
        return back()->withStatus('Excel file uploaded successfully');
    }

}
