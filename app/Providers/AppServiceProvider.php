<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(
        //     'App\Repositories\Api\User\AuthRepository',
        // );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        \Illuminate\Support\Facades\URL::forceScheme('https');
//        $this->app['request']->server->set('HTTPS', true);
        if ($this->app->isLocal()) {
            //if local register your services you require for development
           // $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        }else{
            //else register your services you require for production
            $this->app['request']->server->set('HTTPS', true);
        }
        Schema::defaultStringLength(191);
        Validator::extend('min_words', function ($attribute, $value, $parameters, $validator) {
            $value = preg_replace('/<.*?>/', '', $value);
            $length = $parameters[0];
            return count(preg_split('/\s+/u', $value, null, PREG_SPLIT_NO_EMPTY)) >= $length;
        });
    }
}
