<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{

    protected $languages = ['en','fr','pt'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session()->has('locale'))
        {
            $value = $request->cookie('lang_blooapp');
            $lang = array('fr', 'en', 'pt');
            if(in_array($value, $lang)) {
                session()->put('locale', $value);
            }
        }
        app()->setLocale(session('locale'));
        return $next($request);
    }
}
