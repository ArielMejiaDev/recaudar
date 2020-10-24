<?php

namespace App\Http\Controllers\Team\DonationButton;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DonationButtonController extends Controller
{
    private array $trans;

    public function __construct()
    {
        $this->trans = [
            'copy' => trans('Copy'),
            'copied' => trans('Copied'),
            'donation_button' => trans('Donation Button.'),
            'subtitle' => trans('Paste the code snippet in your HTML, you can change height and width values as you need.')
        ];
    }

    public function __invoke(Team $team)
    {
        $team = $team->only(['id', 'slug']);
        return Inertia::render('Teams/DonationButton/Index')->with([
            'team' => $team,
            'trans' => $this->trans,
        ]);
    }
}
