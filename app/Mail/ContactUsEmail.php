<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $message;
     public $sender_email;

    public function __construct($sender_email,$message)
    {
        $this->message = $message;
        $this->sender_email = $sender_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('emails.contactus')->with([
                'sender_email' => $this->sender_email,
                'content' => $this->message
            ]);
    }
}
