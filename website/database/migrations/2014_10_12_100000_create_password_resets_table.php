<?php

use Illuminate\Database\Schema\Blueprint;
use Pythagus\LaravelAbstractBasis\Database\Migration;

return new class extends Migration {

    /**
	 * Name of the table
	 *
	 * @var string
	 */
	protected $table = 'password_resets' ;

    /**
	 * Structure of the table.
	 *
	 * @param Blueprint $table
	 * @return void
	 */
    public function structure(Blueprint $table) {
        $table->string('email')->index() ;
        $table->string('token') ;
        $table->timestamp('created_at')->nullable() ;
    }
} ;
