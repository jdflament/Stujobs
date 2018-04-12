<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\File;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class SendApply extends Mailable
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
        if (isset($this->data['apply_cv_filename'])) {
            return $this
                ->from(env('MAIL_USERNAME'))
                ->subject('Stujobs : Candidature pour votre offre "' . $this->data['offer_title'] . '"')
                ->view('emails.sendApply')
                ->with(['data', $this->data])
                ->attach(storage_path('app/public/cv') . '/' . $this->data['apply_cv_filename']);
        } else {
            return $this
                ->subject('Stujobs : Candidature pour votre offre "' . $this->data['offer_title'] . '"')
                ->view('emails.sendApply')
                ->with(['data', $this->data]);
        }
    }
}
