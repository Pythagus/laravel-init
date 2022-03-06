<?php

use Illuminate\Database\Schema\Blueprint;
use Pythagus\LaravelAbstractBasis\Database\Migration;

return new class extends Migration {

    /**
	 * Name of the table
	 *
	 * @var string
	 */
	protected $table = 'failed_jobs' ;

    /**
	 * Structure of the table.
	 *
	 * @param Blueprint $table
	 * @return void
	 */
    public function structure(Blueprint $table) {
        $table->id() ;
        $table->string('uuid')->unique() ;
        $table->text('connection') ;
        $table->text('queue') ;
        $table->longText('payload') ;
        $table->longText('exception') ;
        $table->timestamp('failed_at')->useCurrent() ;
    }
} ;
