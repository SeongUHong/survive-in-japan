<?php
namespace App\Logics;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Category
{
	// 계층 구조로 모든 카테고리 정보를 취득
	// return : []
	public function getAllCategories() {
		return Cache::remember('getAllCategories', \App\Consts\Cache::CACHE_TIME, function () {
			$categoryEntities = (new \App\Entities\Category)->BuildAll();
			return array_map(function( $categoryEntitiy ){
				return $categoryEntitiy->ToArray();
			}, $categoryEntities);
		});
	}
}