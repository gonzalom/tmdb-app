<?php

namespace App\Providers;

use Schema;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Fix for non utf8mb4 charset.
         * MySQL older than the 5.7.7 release or MariaDB older than the 10.2.2 release.
         *
         * SQLSTATE[42000]
         * Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
         *
         * @link https://laravel.com/docs/master/migrations#indexes
         */
        Schema::defaultStringLength(191);

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        //
    }
}
