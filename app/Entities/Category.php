<?php
namespace App\Entities;

use App\Logics\Util;

class Category {
	public $category; // 모델
	public $childCategoryEntities = array(); // 엔티티

	public function Build($model) {
		$self = new static;
		$self->category = $model;
		$self->childCategoryEntities = $this->BuildChildrenByParentId($model->id);
		return $self;
	}

	// 자식 카테고리 생성
	// parameter : 부모 카테고리 ID
	public function BuildChildrenByParentId($parentId) {
		$categoryModels = $this->_getAllCategoryModelsWithCache();
		$categoryByParentId = $categoryModels->groupBy('parent_id');
		// 자식 카테고리가 없는 경우, 빈 배열 반환
		if(Util::CanGetArrayValue($categoryByParentId, $parentId) == false) {
			return [];
		}

		$children = $categoryByParentId[$parentId];

		$childEntities = [];
		foreach($children as $child) {
			array_push($childEntities, $this->build($child));
		}

		return $childEntities;
	}

	// 모든 카테고리 인스턴스 생성
	public function BuildAll() {
		$categoryModels = $this->_getAllCategoryModelsWithCache();
		// 최상위 카테고리 취득
		$baseCategories = $categoryModels->groupBy('depth')->get(\App\Consts\Category::MIN_CATEGORY_DEPTH);

		$selves = $baseCategories->map(function($category) {
			return $this->Build($category);
		});

		return $selves;
	}

	public function ToArray() {
		return [
			'name'     => $this->category->name,
			'depth'    => $this->category->depth,
			'children' => $this->childCategoryEntities && count($this->childCategoryEntities) > 0 ?
				array_map(function( $childCategoryEntity ){
					return $childCategoryEntity->ToArray();
				}, $this->childCategoryEntities) : [],
		];
	}

	// 모든 카테고리 모델 취득
	private function _getAllCategoryModels() {
		return Cache::remember('_getAllCategoryModels', \App\Consts\Cache::CACHE_TIME, function () {
			return \App\Models\Category::all();
		});
	}
}