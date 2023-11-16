<?php

namespace Database\Seeders\Dummy;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Post::truncate();

		$posts = [
			[
				'category_id' => 1,
				'title'       => '한국어 기사 한국어 기사 한국어 기사 한국어 기사 한국어 기사',
				'content'     => '텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
			[
				'category_id' => 1,
				'title'       => '한국어 기사 한국어 기사 한국어 기사 한국어 기사 한국어 기사',
				'content'     => '텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
			[
				'category_id' => 1,
				'title'       => '한국어 기사 한국어 기사 한국어 기사 한국어 기사 한국어 기사',
				'content'     => '텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
			[
				'category_id' => 1,
				'title'       => '한국어 기사 한국어 기사 한국어 기사 한국어 기사 한국어 기사',
				'content'     => '텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
			[
				'category_id' => 1,
				'title'       => '한국어 기사 한국어 기사 한국어 기사 한국어 기사 한국어 기사',
				'content'     => '텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트 텍스트',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
			[
				'category_id' => 2,
				'title'       => '日本語記事 日本語記事 日本語記事 日本語記事 日本語記事 日本語記事',
				'content'     => 'テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
			[
				'category_id' => 2,
				'title'       => '日本語記事 日本語記事 日本語記事 日本語記事 日本語記事 日本語記事',
				'content'     => 'テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
			[
				'category_id' => 2,
				'title'       => '日本語記事 日本語記事 日本語記事 日本語記事 日本語記事 日本語記事',
				'content'     => 'テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
			[
				'category_id' => 2,
				'title'       => '日本語記事 日本語記事 日本語記事 日本語記事 日本語記事 日本語記事',
				'content'     => 'テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
			[
				'category_id' => 2,
				'title'       => '日本語記事 日本語記事 日本語記事 日本語記事 日本語記事 日本語記事',
				'content'     => 'テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト',
				'status'      => \App\Consts\Post::STATUS["PUBLIC"],
			],
		];

		foreach ($posts as $post) {
			Post::create($post);
		}
	}
}
