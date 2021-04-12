<?php

namespace App\Services;

use App\Payment;

class Pdf
{
    public function generateReceipt(Payment $payment)
    {
        return \PDF::loadView('receipt', ['payment' => $payment]);
    }

    public function generateReceiptForMail(Payment $payment)
    {
        return \PDF::loadView('receipt', ['payment' => $payment])->output();
    }
}
