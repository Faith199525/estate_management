<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Message;

class SendMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $messageObj;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $messageObj)
    {
        $this->messageObj = $messageObj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('admin@voeraestate.com')
        return $this->view('emails.message')->subject('New Message');
        // ->with('messageObj', $this->messageObj);
    }
}
