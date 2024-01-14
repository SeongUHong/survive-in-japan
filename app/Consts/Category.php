<?php
namespace App\Consts;

class Category
{
	// 카테고리 단계 수
	const MIN_CATEGORY_DEPTH = 1;
	const MAX_CATEGORY_DEPTH = 3;
	const BASE_CATEGORIES = [
		'KOREAN'   => 1,
		'JAPANESE' => 2,
	];

	// 카테고리 미설정
	const UNDEF = 0;
}