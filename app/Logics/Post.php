<?php
namespace App\Logics;

use Illuminate\Support\Facades\Cache;
use App\Logics\Util;

class Post {
	public function GetPostsByPage($page) {
		return [
			'korean'   => $this->GetPublicKoreanPostsByPage($page),
			'japanese' => $this->GetPublicJapanesePostsByPage($page),
		];
	}

	// 포스트 한 건 취득
	public function GetPost($postId, $options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}
		
		if (isset($withCache)) {
			return Cache::remember("GetPost:$postId", \App\Consts\Cache::CACHE_TIME, function () use($postId) {
				$post = (new \App\Entities\Post())->BuildById($postId);
				return $post->ToArray();
			});
		}
		
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

	public function GetDraftPostsByPage($page) {
		$categoryIds = (new \App\Logics\Category())->GetAllCategoryIds();
		// 카테고리 미정의 포스트도 포함
		array_push($categoryIds, \App\Consts\Category::UNDEF);
		$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds(
			$page, $categoryIds, ['status' => [
				\App\Consts\Post::STATUS['DRAFT'],
			]]
		);
		return array_map(function($post) {
			return $post->ToArray();
		}, $posts);
	}
}