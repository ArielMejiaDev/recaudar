<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class FileUploadToS3FailException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function render($request)
    {
        return redirect()->back()->withErrors(['error' => trans('Image upload fail, please try again later.')]);
    }
}
