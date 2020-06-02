<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBoardUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('board_users', function(Blueprint $table)
		{
			$table->foreign('user_id', 'board_users_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('board_id', 'board_users_ibfk_2')->references('id')->on('boards')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('board_users', function(Blueprint $table)
		{
			$table->dropForeign('board_users_ibfk_1');
			$table->dropForeign('board_users_ibfk_2');
		});
	}

}
