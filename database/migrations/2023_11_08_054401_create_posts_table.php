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
				$table->unsignedInteger('category_id')->default(\App\Consts\Category::UNDEF); // 카테고리ID
				$table->text('title')->default(''); // 제목
				$table->longText('content')->default(''); // 내용
				$table->string('thumb_path', 300)->nullable();
				$table->unsignedTinyInteger('status')->default(\App\Consts\Post::STATUS['DRAFT']); // 1:공개 2:임시 저장 3:삭제 대기
				$table->index('category_id');
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
