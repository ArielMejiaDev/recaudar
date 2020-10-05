<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);
        Newsletter::subscribe($request->email);
        return redirect()->route('welcome')->with(['success' => trans('Email added')]);
    }
}
