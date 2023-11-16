<?php
namespace App\Entities;

use Illuminate\Support\Facades\Cache;

class Category {
	private $category; // 모델
	private $childCategoryEntities; // 엔티티

	public function getCategory() {
		return $this->category;
	}

	public function setCategory($value) {
		$this->category = $value;
	}

	public function getChildCategoryEntities() {
		return $this->childCategoryEntities;
	}

	public function setChildCategoryEntities($arr) {
		$this->childCategoryEntities = $arr;
	}

	public function to_array() {
		return [
			'name'     => $this->category->name,
			'depth'    => $this->category->depth,
			'children' => $this->childCategoryEntities && count($this->childCategoryEntities) > 0 ?
				array_map(function( $childCategoryEntity ){
					return $childCategoryEntity->to_array();
				}, $this->childCategoryEntities) : [],
		];
	}
}