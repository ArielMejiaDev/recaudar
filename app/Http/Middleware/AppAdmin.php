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
        if(auth()->user()->role === 'app_admin') {
            return $next($request);
        }
        return redirect()->back();
    }
}
