<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

/**
 * Broadcast service provider.
 * 
 * @author Damien MOLINA
 */
class BroadcastServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Broadcast::routes() ;

        require base_path('routes/channels.php') ;
    }
}
