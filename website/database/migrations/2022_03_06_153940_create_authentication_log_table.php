<?php

use Illuminate\Database\Schema\Blueprint;
use Pythagus\LaravelAbstractBasis\Database\Migration;

return new class extends Migration {

    /**
	 * Get the table name from another way, like
	 * from the config folder.
	 *
	 * @return string|null
	 */
	protected function tableName() {
		return config('authentication-log.table_name') ;
	}

    /**
	 * Structure of the table.
	 *
	 * @param Blueprint $table
	 * @return void
	 */
    public function structure(Blueprint $table) {
        $table->id();
        $table->morphs('authenticatable') ;
        $table->string('ip_address', 45)->nullable() ;
        $table->text('user_agent')->nullable() ;
        $table->timestamp('login_at')->nullable() ;
        $table->boolean('login_successful')->default(false) ;
        $table->timestamp('logout_at')->nullable() ;
        $table->boolean('cleared_by_user')->default(false) ;
        $table->json('location')->nullable() ;

        $table->foreign('authenticatable_id')->references('id')->on('users')->cascadeOnDelete() ;
    }
} ;
