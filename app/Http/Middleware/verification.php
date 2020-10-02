<?php

namespace App\Http\Middleware;

use Closure;

class verification
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
        if (!request()->user() || !$request->user()->hasVerifiedEmail()) {
            auth()->logout();

            session()->flash('login', [
                'status' => 'danger',
                'message' => trans('auth.verification_required'),
            ]);

            return redirect()->route('login')->withErrors(trans('auth.verification_required'));
        }
        return $next($request);
    }
}
