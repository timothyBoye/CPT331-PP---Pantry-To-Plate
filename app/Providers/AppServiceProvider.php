<?php

namespace App\Providers;

use \Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // This will only accept alpha and spaces.
        Validator::extend('alpha_international', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z æáãâäàåāéêëèēėęíîïìīįóõôöòœøōúûüùūçćčñńÿßśšłžźż]+$/u', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
