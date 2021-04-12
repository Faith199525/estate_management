<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Estate;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function settings()
    {
        $settings = Setting::where('estate_id', \Session::get('estate'));
        return view('admin.settings.index')->with('settings', $settings);
    }

    public function activateDueManagement()
    {
        $this->settings->put(['MANUAL_DUE_MANAGEMENT_ACTIVATED' => true]);
        return back()->with('message', 'Manual Due management has been activated');
    }

    public function deactivateDueManagement()
    {
        $this->settings->forget('MANUAL_DUE_MANAGEMENT_ACTIVATED');
        return back()->with('message', 'Manual Due management has been deactivated');
    }



    public function activateMessaging()
    {
        if (!$this->request->has('activate_sms') && !$this->request->has('activate_email')) {
            return back()->with('error', 'Sellect at least one option to activate Messaging');
        }
        $this->settings->put(['MESSAGING_ACTIVATED' => true]);
        if ($this->request->has('activate_sms')) {
            $this->settings->put(['ACTIVATE_SMS' => true]);
            if (!settings()->has('SMS_REMAINING')) {
                $this->settings->put(['SMS_REMAINING' => env('ALLOCATED_SMS') ? env('ALLOCATED_SMS') : 400]);
            }
        }
        if ($this->request->has('activate_email')) {
            $this->settings->put(['ACTIVATE_EMAIL' => true]);
        }
        return back()->with('message', 'Messaging has been activated');
    }

    public function updateMessaging()
    {
        if (!$this->request->has('activate_sms') && !$this->request->has('activate_email')) {
            return back()->with('error', 'Sellect at least one option to update Messaging');
        }

        if ($this->request->has('activate_sms')) {
            $this->settings->put(['ACTIVATE_SMS' => true]);
        } else {
            $this->settings->forget('ACTIVATE_SMS');
        }
        if ($this->request->has('activate_email')) {
            $this->settings->put(['ACTIVATE_EMAIL' => true]);
        } else {
            $this->settings->forget('ACTIVATE_EMAIL');
        }
        return back()->with('message', 'Messaging has been activated');
    }

    public function deactivateMessaging()
    {
        $this->settings->forget('MESSAGING_ACTIVATED');
        if ($this->settings->has('ACTIVATE_SMS')) {
            $this->settings->forget('ACTIVATE_SMS');
        }
        if ($this->settings->has('ACTIVATE_EMAIL')) {
            $this->settings->forget('ACTIVATE_EMAIL');
        }
        return back()->with('message', 'Messaging has been deactivated');
    }

    public function activatePayment()
    {
        $this->request->validate([
            'business_name' => 'required|max:255',
            'settlement_bank' => 'required|max:255:',
            'account_number' => 'required|size:10',
        ]);

        $client = new Client();

        $response = $client->request('POST', 'https://api.paystack.co/subaccount', [
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY')
            ],
            'form_params' => [
                'account_number' => $this->request->account_number,
                'settlement_bank' => $this->request->settlement_bank,
                'business_name' => $this->request->business_name,
                'percentage_charge' => 0,
            ]
        ]);

        $status = $response->getStatusCode();
        if ($status == 201 || $status == 200) {
            $data = json_decode($response->getBody());

            $this->settings->put([
                'PAYMENT_ACTIVATED' => true,
                'PAYMENT_ACCOUNT_NO' => $this->request->account_number,
                'settlement_bank' => $this->request->settlement_bank,
                'business_name' => $this->request->business_name,
                'subaccount_code' => $data->data->subaccount_code,
                'MANUAL_DUE_MANAGEMENT_ACTIVATED' => true
            ]);
            return back()->with('message', 'Payment has been activated!');
        }
        return back()->with('error', json_decode($response->getBody())->message);
    }

    public function deactivatePayment()
    {
        $this->settings->forget('PAYMENT_ACTIVATED');
        $this->settings->forget('PAYMENT_ACCOUNT_NO');
        $this->settings->forget('settlement_bank');
        $this->settings->forget('business_name');
        $this->settings->forget('subaccount_code');
        $this->settings->forget('MANUAL_DUE_MANAGEMENT_ACTIVATED');

        return back()->with('message', 'Payment has been deactivated');
    }

    public function getAllSettings(Settings $settings)
    {
        return $this->settings->all();
    }

    public function updateAppDetails(Request $request)
    {
        // Update the database table that powers the PWA
     

        $this->settings->put('APP_NAME', $this->request->app_name);
        $this->settings->put('FULL_NAME', $this->request->full_name);
        $this->settings->put('FULL_ADDRESS', $this->request->full_address);

        return back()->with(['message' => 'Settings updated']);
    }

    public function updateEmailDetails()
    {
        $this->settings->put('MAIL_FROM_NAME', $this->request->mail_from_name);
        $this->settings->put('MAIL_FROM_ADDRESS', $this->request->mail_from_address);

        return redirect()->back()->with(['message' => 'Settings updated']);
    }
}
