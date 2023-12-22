<?php
namespace App\Logics;

use Illuminate\Support\Facades\Cache;

class Post {
	public function GetPostsByPage($page) {
		return [
			'korean'   => $this->GetKoreanPostsByPage($page),
			'japanese' => $this->GetJapanesePostsByPage($page),
		];
	}

	public function GetKoreanPostsByPage($page) {
		return Cache::remember("GetKoreanPostsByPage:$page", \App\Consts\Cache::CACHE_TIME, function () use($page) {
			$categoryIds = (new \App\Logics\Category())->GetKoreanCategoryIds();
			$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds($page, $categoryIds);
			return array_map(function($post) {
				return $post->ToArray();
			}, $posts);
		});
	}

	public function GetJapanesePostsByPage($page) {
		return Cache::remember("GetJapanesePostsByPage:$page", \App\Consts\Cache::CACHE_TIME, function () use($page) {
			$categoryIds = (new \App\Logics\Category())->GetJapanesenCategoryIds();
			$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds($page, $categoryIds);
			return array_map(function($post) {
				return $post->ToArray();
			}, $posts);
		});
	}
}