<?php
namespace App\Logics;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Logics\Util;

class Category
{
	// 계층 구조로 모든 카테고리 정보를 취득
	// return : []
	public function GetAllCategories($options = []) {
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		$origin = function () use ($options) {
			$categoryEntities = (new \App\Entities\Category)->BuildAll($options);
			return array_map(function( $categoryEntitiy ){
				return $categoryEntitiy->ToArray();
			}, $categoryEntities);
		};

		if (isset($withCache)) {
			return Cache::remember('GetAllCategories', \App\Consts\Cache::CACHE_TIME, $origin);
		}

		return call_user_func_array($origin, []);
	}

	// 카테고리 리스트를 재귀적으로 취득
	public function GetCategoryByCategoryId($categoryId, $options = []) {
		$entity = (new \App\Entities\Category)->BuildByCategoryId($categoryId, $options);
		return $entity->ToArray();
	}

	// 한국어 카테고리 리스트 취득
	public function GetKoreanCategories($options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		$origin = function () use ($options) {
			$Category = $this->GetCategoryByCategoryId(\App\Consts\Category::BASE_CATEGORIES['KOREAN'], $options);
			return $Category['children'];
		};
		
		if (isset($withCache)) {
			return Cache::remember('GetKoreanCategories', \App\Consts\Cache::CACHE_TIME, $origin);
		}

		return call_user_func_array($origin, []);
	}

	// 일본어 카테고리 리스트 취득
	public function GetJapaneseCategories($options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		$origin = function () use ($options) {
			$Category = $this->GetCategoryByCategoryId(\App\Consts\Category::BASE_CATEGORIES['JAPANESE'], $options);
			return $Category['children'];
		};
		
		if (isset($withCache)) {
			return Cache::remember('GetJapaneseCategories', \App\Consts\Cache::CACHE_TIME, $origin);
		}

		return call_user_func_array($origin, []);
	}

	// 카테고리ID 리스트를 재귀적으로 취득
	public function GetCategoryIdsByCategoryId($categoryId, $options = []) {
		$entity = (new \App\Entities\Category)->BuildByCategoryId($categoryId, $options);
		return $entity->GetCategoryIdsRecursive();
	}

	// 한국어 카테고리ID 리스트 취득
	public function GetKoreanCategoryIds($options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		if(isset($withCache)) {
			return Cache::remember('GetKoreanCategoryIds', \App\Consts\Cache::CACHE_TIME, function () {
				return $this->GetCategoryIdsByCategoryId(\App\Consts\Category::BASE_CATEGORIES['KOREAN'], ['withCache' => 1]);
			});
		}
		
		return $this->GetCategoryIdsByCategoryId(\App\Consts\Category::BASE_CATEGORIES['KOREAN']);
	}

	// 일본어 카테고리ID 리스트 취득
	public function GetJapanesenCategoryIds($options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		if(isset($withCache)) {
			return Cache::remember('GetJapanesenCategoryIds', \App\Consts\Cache::CACHE_TIME, function () {
				return $this->GetCategoryIdsByCategoryId(\App\Consts\Category::BASE_CATEGORIES['JAPANESE'], ['withCache' => 1]);
			});
		}
		
		return $this->GetCategoryIdsByCategoryId(\App\Consts\Category::BASE_CATEGORIES['JAPANESE']);
	}

	// ID별 카테고리 이름 취득
	public function GetCategoryNameArray($options = []) {
		$Categories = $this->GetKoreanCategoryNameArray($options);
		$jpCategories = $this->GetJapaneseCategoryNameArray($options);
		
		foreach (array_keys($jpCategories) as $key) {
			$Categories[$key] = $jpCategories[$key];
		}

		return $Categories;
	}

	// ID별 한국어 카테고리 이름 취득
	// return : [id => name]
	public function GetKoreanCategoryNameArray($options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		if(isset($withCache)) {
			return Cache::remember('GetKoreanCategoryNameArray', \App\Consts\Cache::CACHE_TIME, function () {
				$entity = (new \App\Entities\Category)->BuildByCategoryId(\App\Consts\Category::BASE_CATEGORIES['KOREAN'], ['withCache' => 1]);
				return $entity->GetNameByIdRecursive();
			});
		}

		$entity = (new \App\Entities\Category)->BuildByCategoryId(\App\Consts\Category::BASE_CATEGORIES['KOREAN']);
		return $entity->GetNameByIdRecursive();
	}

	// ID별 일본어 카테고리 이름 취득
	// return : [id => name]
	public function GetJapaneseCategoryNameArray($options = []) {
		// 캐시 옵션
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		if(isset($withCache)) {
			return Cache::remember('GetJapaneseCategoryNameArray', \App\Consts\Cache::CACHE_TIME, function () {
				$entity = (new \App\Entities\Category)->BuildByCategoryId(\App\Consts\Category::BASE_CATEGORIES['JAPANESE'], ['withCache' => 1]);
				return $entity->GetNameByIdRecursive();
			});
		}

		$entity = (new \App\Entities\Category)->BuildByCategoryId(\App\Consts\Category::BASE_CATEGORIES['JAPANESE']);
		return $entity->GetNameByIdRecursive();
	}

	// 한국어 카테고리인가
	// parameter : category_id
	// return : bool
	public function IsKoreanCategory($id, $options = []) {
		$koreanIdList = $this->GetKoreanCategoryIds($options);
		foreach ($koreanIdList as $koreanId) {
			if ($koreanId == $id) {
				return true;
			}
		}
		return false;
	}
}