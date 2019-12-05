<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsDisabled
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
        if (Auth::user() && Auth::user()->isDisabled()) {
            return redirect(route('home'))->withErrors("You have disabled your account. Please contact the Administrators to re-enable it. ");
        }
        return $next($request);
    }
}
