<?php
namespace App\Logics;

use Illuminate\Support\Facades\Cache;
use App\Logics\Util;

class Post {
	public function GetPostsByPage($page, $options = []) {
		return [
			'korean'   => $this->GetPublicKoreanPostsByPage($page, $options),
			'japanese' => $this->GetPublicJapanesePostsByPage($page, $options),
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

	public function GetPublicKoreanPostsByPage($page, $options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		$origin = function () use ($page, $options) {
			$categoryIds = (new \App\Logics\Category())->GetKoreanCategoryIds();
			$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds(
				$page,
				$categoryIds,
				['status' => [
					\App\Consts\Post::STATUS['PUBLIC']
				]]
			);
			// 메인화면용
			if (Util::CanGetArrayValue($options, 'forMain')) {
				return array_map(function($post) {
					return $post->ToArrayForMain();
				}, $posts);
			}

			return array_map(function($post) {
				return $post->ToArray();
			}, $posts);
		};

		if (isset($withCache)) {
			return Cache::remember("GetPublicKoreanPostsByPage:$page", \App\Consts\Cache::CACHE_TIME, $origin);
		}

		return call_user_func_array($origin, []);
	}

	public function GetPublicJapanesePostsByPage($page, $options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		$origin = function () use ($page, $options) {
			$categoryIds = (new \App\Logics\Category())->GetJapanesenCategoryIds();
			$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds(
				$page,
				$categoryIds,
				['status' => [
					\App\Consts\Post::STATUS['PUBLIC']
				]]
			);
			// 메인화면용
			if (Util::CanGetArrayValue($options, 'forMain')) {
				return array_map(function($post) {
					return $post->ToArrayForMain();
				}, $posts);
			}

			return array_map(function($post) {
				return $post->ToArray();
			}, $posts);
		};

		if (isset($withCache)) {
			return Cache::remember("GetPublicJapanesePostsByPage:$page", \App\Consts\Cache::CACHE_TIME, $origin);
		}

		return call_user_func_array($origin, []);
	}

	public function GetPublicPostsByCategoryIdAndPage($categoryId, $page, $options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		$origin = function () use ($page, $categoryId, $options) {
			$posts = (new \App\Entities\Post())->BuildMultiByPageAndCategoryIds(
				$page,
				[$categoryId],
				['status' => [
					\App\Consts\Post::STATUS['PUBLIC']
				]]
			);
			// 메인화면용
			if (Util::CanGetArrayValue($options, 'forMain')) {
				return array_map(function($post) {
					return $post->ToArrayForMain();
				}, $posts);
			}

			return array_map(function($post) {
				return $post->ToArray();
			}, $posts);
		};

		if (isset($withCache)) {
			return Cache::remember("GetPublicPostsByCategoryIdAndPage:$categoryId:$page", \App\Consts\Cache::CACHE_TIME, $origin);
		}

		return call_user_func_array($origin, []);
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