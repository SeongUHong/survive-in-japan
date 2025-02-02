<?php
namespace App\Entities;

use App\Logics\Util;
use Illuminate\Support\Facades\Cache;

class Category {
	public $category; // 모델
	public $childCategoryEntities = array(); // 엔티티

	public function Build($model, $options = []) {
		$self = new static;
		$self->category = $model;
		$self->childCategoryEntities = $this->BuildChildrenByParentId($model->id, $options);
		return $self;
	}

	// 자식 카테고리 생성
	// parameter : 부모 카테고리 ID
	public function BuildChildrenByParentId($parentId, $options = []) {
		$categoryModels = $this->_GetAllCategoryModels($options);
		$categoryByParentId = $categoryModels->groupBy('parent_id')->all();

		// 자식 카테고리가 없는 경우, 빈 배열 반환
		if(Util::CanGetArrayValue($categoryByParentId, $parentId) == false) {
			return [];
		}

		$children = $categoryByParentId[$parentId];

		$childEntities = [];
		foreach($children as $child) {
			array_push($childEntities, $this->build($child, $options));
		}

		return $childEntities;
	}

	// 모든 카테고리 인스턴스 생성
	public function BuildAll($options = []) {
		$categoryModels = $this->_GetAllCategoryModels($options);
		// 최상위 카테고리 취득
		$baseCategories = $categoryModels->groupBy('depth')->get(\App\Consts\Category::MIN_CATEGORY_DEPTH);

		$selves = $baseCategories->map(function($category) use ($options) {
			return $this->Build($category, $options);
		});

		return $selves->toArray();
	}

	// 지정 카테고리ID에 대한 인스턴스 생성
	// return : self
	public function BuildByCategoryId($categoryId, $options = []) {
		if (is_null($categoryId)) {
			return null;
		}

		$category = null;
		foreach ($this->_GetAllCategoryModels($options) as $model) {
			if ($model->id == $categoryId) {
				$category = $model;
				break;
			}
		}

		if (is_null($category)) {
			return null;
		}

		return $this->Build($category, $options);
	}

	// 자신 + 하위 카테고리ID 리스트
	public function GetCategoryIdsRecursive() {
		$categoryList = $this->GetCategoryModelsRecursive();
		return array_map(function ($category) {
			return $category->id;
		}, $categoryList);
	}

	public function GetNameByIdRecursive() {
		$categoryList = $this->GetCategoryModelsRecursive();
		$idByName = [];
		foreach ($categoryList as $category) {
			$idByName[$category->id] = $category->name;
		}
		return $idByName;
	}

	// 자신 + 하위 카테고리 리스트
	// return []
	public function GetCategoryModelsRecursive() {
		$categoryList = [];
		array_push($categoryList, $this->category);
		return array_merge($categoryList, $this->GetChildCategoryModelsRecursive());
	}

	// 하위 카테고리 모델 리스트
	public function GetChildCategoryModelsRecursive() {
		if (count($this->childCategoryEntities) <= 0) {
			return [];
		}

		$categoryList = [];
		foreach($this->childCategoryEntities as $child) {
			array_push($categoryList, $child->category);
			$categoryList = array_merge($categoryList, $child->GetChildCategoryModelsRecursive());
		}

		return $categoryList;
	}

	public function ToArray() {
		return [
			'id'       => $this->category->id,
			'name'     => $this->category->name,
			'depth'    => $this->category->depth,
			'children' => $this->childCategoryEntities && count($this->childCategoryEntities) > 0 ?
				array_map(function( $childCategoryEntity ){
					return $childCategoryEntity->ToArray();
				}, $this->childCategoryEntities) : [],
		];
	}

	// 모든 카테고리 모델 취득
	private function _GetAllCategoryModels($options = []) {
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		if (isset($withCache)) {
			return Cache::remember('_GetAllCategoryModels', \App\Consts\Cache::CACHE_TIME, function () {
				return \App\Models\Category::all();
			});
		}
		return \App\Models\Category::all();
	}
}