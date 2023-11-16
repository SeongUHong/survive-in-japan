<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class CategoriesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Category::truncate();

		$now = Carbon::now()->toDateTimeString();
		$categories = [
			[
				'id'         => \App\Consts\Category::BASE_CATEGORIES['KOREAN'],
				'depth'      => 1,
				'parent_id'  => 0,
				'name'       => '한국어 카테고리',
				'created_at' => $now,
			],
			[
				'id'         => \App\Consts\Category::BASE_CATEGORIES['JAPANESE'],
				'depth'      => 1,
				'parent_id'  => 0,
				'name'       => '日本語カテゴリー',
				'created_at' => $now,
			],
		];

		foreach ($categories as $category) {
			Category::create($category);
		}
	}
}
