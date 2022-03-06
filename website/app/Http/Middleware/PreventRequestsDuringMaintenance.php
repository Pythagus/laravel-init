<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

/**
 * Disable website access during maintenance.
 * 
 * @author Damien MOLINA
 */
class PreventRequestsDuringMaintenance extends Middleware {

    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [] ;

}
