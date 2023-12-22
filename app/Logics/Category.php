<?php
namespace App\Logics;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Category
{
	// 계층 구조로 모든 카테고리 정보를 취득
	// return : []
	public function GetAllCategories() {
		return Cache::remember('GetAllCategories', \App\Consts\Cache::CACHE_TIME, function () {
			$categoryEntities = (new \App\Entities\Category)->BuildAll();
			return array_map(function( $categoryEntitiy ){
				return $categoryEntitiy->ToArray();
			}, $categoryEntities);
		});
	}

	// 한국어 카테고리 취득
	// return : []
	public function GetKoreanCategories() {
		return Cache::remember('GetKoreanCategories', \App\Consts\Cache::CACHE_TIME, function () {
			$entity = (new \App\Entities\Category)->BuildMultiByCategoryId(\App\Consts\Category::BASE_CATEGORIES['KOREAN']);
			if (is_null($entity)) {
				return [];
			}
			return $entity->ToArray();
		});
	}

	// 일본어 카테고리 취득
	// return : []
	public function GetJapaneseCategories() {
		return Cache::remember('GetJapaneseCategories', \App\Consts\Cache::CACHE_TIME, function () {
			$entity = (new \App\Entities\Category)->BuildMultiByCategoryId(\App\Consts\Category::BASE_CATEGORIES['JAPANESE']);
			if (is_null($entity)) {
				return [];
			}
			return $entity->ToArray();
		});
	}

	// 카테고리ID 리스트를 재귀적으로 취득
	public function GetCategoryIdsByCategoryId($categoryId) {
		$entity = (new \App\Entities\Category)->BuildMultiByCategoryId($categoryId);
		return $entity->GetCategoryIdsRecursive();
	}

	// 한국어 카테고리ID 리스트 취득
	public function GetKoreanCategoryIds() {
		return Cache::remember('GetKoreanCategoryIds', \App\Consts\Cache::CACHE_TIME, function () {
			return $this->GetCategoryIdsByCategoryId(\App\Consts\Category::BASE_CATEGORIES['KOREAN']);
		});
	}

	// 일본어 카테고리ID 리스트 취득
	public function GetJapanesenCategoryIds() {
		return Cache::remember('GetJapanesenCategoryIds', \App\Consts\Cache::CACHE_TIME, function () {
			return $this->GetCategoryIdsByCategoryId(\App\Consts\Category::BASE_CATEGORIES['JAPANESE']);
		});
	}
}