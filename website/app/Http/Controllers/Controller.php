<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Base application controller.
 * 
 * @author Damien MOLINA
 */
class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests ;
    
}
