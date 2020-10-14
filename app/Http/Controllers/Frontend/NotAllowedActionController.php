<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotAllowedActionController extends Controller
{
    public function __invoke()
    {
        abort(403, trans('Too many attempts, please try again later.'));
    }
}
