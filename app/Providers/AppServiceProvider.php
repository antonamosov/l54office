<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
        Validator::extend('vat', function ($attribute, $value) {
            return (preg_match("/^[a-zA-Z]{2}[0-9]{11}$/", $value) || !$value);
        });
        Validator::extend('fiscal_code', function ($attribute, $value) {
            return preg_match("/^[a-zA-Z0-9]{16}$/", $value);
        });

        Validator::replacer('vat', function () {
            return 'The vat Number should be with 2 letters and 11 numbers (for example: IT12362610151)';
        });
        Validator::replacer('fiscal_code', function () {
            return 'The Fiscal Code should be with 16 letters and numbers';
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
