<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($t){
			$t->increments('id');
			$t->string('username');
			$t->string('email');
			$t->string('password');
			$t->string('password_temp')->nullable();
			$t->string('code')->nullable();
			$t->boolean('active')->default(false)->nullable();
			$t->string('remember_toker',100)->nullable();
			$t->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
