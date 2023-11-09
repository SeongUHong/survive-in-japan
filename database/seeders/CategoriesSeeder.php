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
				'id'         => \App\Consts\Category::BASE['KOREAN'],
				'parent_id'  => 0,
				'name'       => '한국어',
				'created_at' => $now,
			],
			[
				'id'         => \App\Consts\Category::BASE['JAPANESE'],
				'parent_id'  => 0,
				'name'       => '일본어',
				'created_at' => $now,
			],
		];

		foreach ($categories as $category) {
			Category::create($category);
		}
	}
}
