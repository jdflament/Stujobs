<?php

namespace App\Mail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OfferValidated extends Mailable
{
    use Queueable, SerializesModels;
    
    public $offer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($offer)
    {
        $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.offerValidated')
                    ->with([
                        'offerTitle' => $this->offer->title,
                        'offerDescription' => $this->offer->description,
                        'offerContractType' => $this->offer->contract_type,
                        'offerDuration' => $this->offer->duration,
                        'offerRemuneration' => $this->offer->remuneration,
                        'offerCity' => $this->offer->sector,
                    ]);
    }
}
