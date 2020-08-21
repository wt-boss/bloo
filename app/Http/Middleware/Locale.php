<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{

    protected $languages = ['en','fr'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if(!session()->has('locale'))
        // {
        //     session()->put('locale', $request->getPreferredLanguage($this->languages));
        // }
        app()->setLocale(session('locale'));
        return $next($request);
    }
}
