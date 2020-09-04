<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
//        return parent::render($request, $exception);

        $response = parent::render($request, $exception);

        if ($this->thereAreErrorsInProduction($response)) {

            return Inertia::render('Errors/Error', [
                'status' => $response->status(),
                'message' => $exception->getMessage()
            ])->toResponse($request)->setStatusCode($response->status());
        }

        return $response;
    }

    public function thereAreErrorsInProduction($response)
    {
        return App::environment('production') && in_array($response->status(), [500, 503, 404, 403, 401, 419, 429]);
    }
}
