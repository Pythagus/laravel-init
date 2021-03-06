<?php

namespace App\Providers;

use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Application server provider.
 * 
 * @author Damien MOLINA
 */
class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191) ;
        Date::setLocale('fr') ;
    }
}
