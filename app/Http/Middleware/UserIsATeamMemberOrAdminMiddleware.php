<?php

namespace App\Http\Middleware;

use Closure;

class UserIsATeamMemberOrAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd();
        if (! auth()->user()->isATeamMember($request->route('team')) && !auth()->user()->isAdmin()) {
            return redirect()->back();
        }
        return $next($request);
    }
}
