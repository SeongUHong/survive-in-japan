<?php
namespace App\Logics;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Category
{
	// 계층 구조로 모든 카테고리 정보를 취득
	// return : []
	public function getCategories() {
		return Cache::remember('categories', \App\Consts\Cache::CACHE_TIME, function () {
			$categoryEntities = $this->getCategoryEntities();
			return array_map(function( $categoryEntitiy ){
				return $categoryEntitiy->to_array();
			}, $categoryEntities);
		});
	}

	// 모든 카테고리 Entity를 취득
	public function getCategoryEntities() {
		$categoryCollect = collect($this->_getAllCategoryModelsWithCache());

		$baseCategories = $categoryCollect->groupBy('depth')->get(\App\Consts\Category::MIN_CATEGORY_DEPTH);
		$categoryByParentId = $categoryCollect->groupBy('parent_id');

		$categoryEntities = [];
		foreach ($baseCategories as $category) {
			$categoryEntity = new \App\Entities\Category;
			$categoryEntity->setCategory($category);
			$categoryEntity->setChildCategoryEntities($this->_getChildCategoryEntities($category, $categoryByParentId));
			array_push($categoryEntities, $categoryEntity);
		}

		return $categoryEntities;
	}

	private function _getChildCategoryEntities($category, $categoryByParentId) {
		$childCategoryEntities = [];
		$categoryId = $category->id;

		$childCategories = $categoryByParentId->get($categoryId);
		if (is_null($childCategories)) {
			return $childCategoryEntities;
		}
		
		foreach ($childCategories as $childCategory) {
			$categoryEntity = new \App\Entities\Category;
			$categoryEntity->setCategory($childCategory);
			$categoryEntity->setChildCategoryEntities($this->_getChildCategoryEntities($childCategory, $categoryByParentId));
			array_push($childCategoryEntities, $categoryEntity);
		}

		return $childCategoryEntities;
	}

	// 모든 카테고리 모델 취득
	private function _getAllCategoryModelsWithCache() {
		return Cache::remember('categoryModels', \App\Consts\Cache::CACHE_TIME, function () {
			return \App\Models\Category::all();
		});
	}

}