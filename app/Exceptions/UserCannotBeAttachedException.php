<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class UserCannotBeAttachedException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::debug('User cannot be created and attach');
    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return redirect()->back()->withErrors(['error' => trans('User cannot be created')]);
    }
}
