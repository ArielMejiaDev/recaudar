<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role === 'app_admin' ||
            auth()->user()->role === 'app_editor' ||
            auth()->user()->role === 'app_financial') {
            return $next($request);
        }
        return redirect()->back();
    }
}
