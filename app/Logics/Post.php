<?php
namespace App\Logics;

use Illuminate\Support\Facades\Cache;

class Post {
	public function getPostsByPage($page) {
		return Cache::remember("getPostsByPage:$page", \App\Consts\Cache::CACHE_TIME, function () {
			$posts = (new \App\Entities\Post())->BuildMultiByPage($page);
			return array_map(function($post) {
				return $post->ToArray();
			}, $posts);
		});
	}
}