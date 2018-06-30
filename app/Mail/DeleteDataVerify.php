<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteDataVerify extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * VerifyMail constructor.
     * @param $user
     *
     * Email verify constructor
     */
    public function __construct($code, $email)
    {
        $this->code = $code;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.deleteDataVerify')
                    ->with([
                        'email' => $this->email,
                        'code' => $this->code
                    ]);
    }
}
