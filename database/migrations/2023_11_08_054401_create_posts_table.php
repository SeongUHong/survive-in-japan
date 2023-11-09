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
		if (! Schema::hasTable('posts')) {
			Schema::create('posts', function (Blueprint $table) {
				$table->id();
				$table->unsignedInteger('category_id'); // 카테고리ID
				$table->text('title'); // 제목
				$table->longText('content'); // 내용
				$table->unsignedTinyInteger('status'); // 1:공개 2:임시 저장 3:삭제 대기
				$table->index('status');
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
		Schema::dropIfExists('posts');
	}
};
