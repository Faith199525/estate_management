<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Payment;
use App\Services\Pdf;

class PaymentReceipt extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Pdf $pdfGenerator)
    {
        $pdf = $pdfGenerator->generateReceiptForMail($this->payment);

        return $this->view('emails.payment_receipt')
            ->attachData($pdf, 'receipt.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
