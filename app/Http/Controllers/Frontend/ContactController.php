<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Notifications\ContactNotification;
use App\Services\SEO\LandingPageSeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function create()
    {
        (new LandingPageSeoService)->execute();
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email'],
            'message' => ['required', 'min:10'],
            'g-recaptcha-response' => 'recaptcha',
        ]);
        Notification::route('mail', 'info@recaudar.com')->notify(new ContactNotification([
            'name' => $request->name,
            'email' =>  $request->email,
            'message' => $request->message,
        ]));
        return redirect()->route('contact.store')->with(['success' => trans('Message sent')]);
    }
}
