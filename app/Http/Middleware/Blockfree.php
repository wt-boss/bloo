<?php

namespace App\Http\Middleware;
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
            //$user = $request->user();
            if($request->user()->hasRole('Free'))
            {
                return abort(403);
            }

        }
        return $next($request);
    }
}
