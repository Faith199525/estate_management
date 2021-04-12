<?php

namespace App\Services;

use AfricasTalking\SDK\AfricasTalking;

class Sms
{
    public function sendMessage($message, $recepients)
    {
        $username = env('AFRICAS_TALKING_USERNAME');
        $apiKey   = env('AFRICAS_TALKING_API');

        $AT       = new AfricasTalking($username, $apiKey);

        // Get the SMS services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => $recepients,
            'message' => $message   //'Hello Bloc! This is what we want to send'
        ]);

        return $result;
    }

    public function generateReceiptForMail(Payment $payment)
    {
        return \PDF::loadView('receipt', ['payment' => $payment])->output();
    }
}
