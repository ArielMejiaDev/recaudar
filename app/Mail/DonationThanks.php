<?php

namespace App\Mail;

use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationThanks extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    public Team $team;

    public \Illuminate\Database\Eloquent\Collection $plans;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transactionId, Team $team)
    {
        $this->transaction = $transactionId;
        $this->team = $team;
        $this->plans = $team->plans()
            ->where('title', '!=', 'of variable amount')
            ->inRandomOrder()
            ->limit(2)
            ->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('maileclipse::templates.donationThanks')
            ->subject('Thanks for your donation')
            ->from('info@recaudar.com', 'Recaudar')
            ->replyTo('info@recaudar.com', 'Recaudar');
    }
}
