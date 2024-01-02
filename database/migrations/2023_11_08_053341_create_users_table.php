<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('users')) {
			Schema::create('users', function (Blueprint $table) {
				$table->id();
				$table->string('login_id', 60)->unique(); // 로그인 아이디
				$table->string('password', 64); 
				$table->string('nickname', 50);
				$table->unsignedTinyInteger('status'); // 권한, 상태
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
};
