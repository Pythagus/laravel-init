<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Middleware to encrypt the HTTP cookies.
 * 
 * @author Damien MOLINA
 */
class EncryptCookies extends Middleware {

    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [] ;
    
}
