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

	// ID별 한국어 카테고리 이름 취득
	// return : [id => name]
	public function GetKoreanCategoryNameArray() {
		return Cache::remember('GetKoreanCategoryNameArray', \App\Consts\Cache::CACHE_TIME, function () {
			$entity = (new \App\Entities\Category)->BuildMultiByCategoryId(\App\Consts\Category::BASE_CATEGORIES['KOREAN']);
			return $entity->GetNameByIdRecursive();
		});
	}

	// ID별 일본어 카테고리 이름 취득
	// return : [id => name]
	public function GetJapaneseCategoryNameArray() {
		return Cache::remember('GetJapaneseCategoryNameArray', \App\Consts\Cache::CACHE_TIME, function () {
			$entity = (new \App\Entities\Category)->BuildMultiByCategoryId(\App\Consts\Category::BASE_CATEGORIES['JAPANESE']);
			return $entity->GetNameByIdRecursive();
		});
	}
}