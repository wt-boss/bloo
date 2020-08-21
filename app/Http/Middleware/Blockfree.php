<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Auth;
use Closure;

class Blockfree
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
        if (Auth::check()) {
            if($request->user()->hasRole('Free'))
            {
                return redirect('/logoutfree');
            }
        }
        return $next($request);
    }
}
