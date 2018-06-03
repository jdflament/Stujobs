<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\File;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class SendCandidateApplyAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * VerifyMail constructor.
     * @param $data
     *
     * Email verify constructor
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this
                ->subject('Stujobs : Votre candidature pour l\'offre "' . $this->data['offer_title'] . '" a été transmise à l\'entreprise')
                ->view('emails.sendCandidateApplyAlert')
                ->with(['data', $this->data]);
    }
}
