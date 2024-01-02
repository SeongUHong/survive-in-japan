<?php
namespace App\Logics;

use Illuminate\Support\Facades\Cache;

class Post {
	public function GetPostsByPage($page) {
		return [
			'korean'   => $this->GetPublicKoreanPostsByPage($page),
			'japanese' => $this->GetPublicJapanesePostsByPage($page),
		];
	}

	public function GetPost($postId) {
		$post = (new \App\Entities\Post())->BuildById($postId);
		return $post->ToArray();
	}

	public function GetPublicKoreanPostsByPage($page) {
		return Cache::remember("GetPublicKoreanPostsByPage:$page", \App\Consts\Cache::CACHE_TIME, function () use($page) {
			$categoryIds = (new \App\Logics\Category())->GetKoreanCategoryIds();
			$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds(
				$page, $categoryIds, ['status' => [
					\App\Consts\Post::STATUS['PUBLIC']
				]]
			);
			return array_map(function($post) {
				return $post->ToArray();
			}, $posts);
		});
	}

	public function GetPublicJapanesePostsByPage($page) {
		return Cache::remember("GetPublicJapanesePostsByPage:$page", \App\Consts\Cache::CACHE_TIME, function () use($page) {
			$categoryIds = (new \App\Logics\Category())->GetJapanesenCategoryIds();
			$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds(
				$page, $categoryIds, ['status' => [
					\App\Consts\Post::STATUS['PUBLIC']
				]]
			);
			return array_map(function($post) {
				return $post->ToArray();
			}, $posts);
		});
	}

	public function GetKoreanPostsWithoutRemovedByPage($page) {
		$categoryIds = (new \App\Logics\Category())->GetKoreanCategoryIds();
		$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds(
			$page, $categoryIds, ['status' => [
				\App\Consts\Post::STATUS['PUBLIC'],
				\App\Consts\Post::STATUS['DRAFT'],
			]]
		);
		return array_map(function($post) {
			return $post->ToArray();
		}, $posts);
	}

	public function GetJapanesePostsWithoutRemovedByPage($page) {
		$categoryIds = (new \App\Logics\Category())->GetJapanesenCategoryIds();
		$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds(
			$page, $categoryIds, ['status' => [
				\App\Consts\Post::STATUS['PUBLIC'],
				\App\Consts\Post::STATUS['DRAFT'],
			]]
		);
		return array_map(function($post) {
			return $post->ToArray();
		}, $posts);
	}
}