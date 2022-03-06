<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Pythagus\LaravelAbstractBasis\Database\Migration;

return new class extends Migration {

    /**
	 * Class name of the migration.
	 *
	 * @var string
	 */
	protected $class = User::class ;

    /**
	 * Structure of the table.
	 *
	 * @param Blueprint $table
	 * @return void
	 */
    public function structure(Blueprint $table) {
        $table->id() ;
        $table->string('name') ;
        $table->string('email')->unique() ;
        $table->timestamp('email_verified_at')->nullable() ;
        $table->string('password') ;
        $table->rememberToken() ;
        $table->timestamps() ;
    }
} ;
