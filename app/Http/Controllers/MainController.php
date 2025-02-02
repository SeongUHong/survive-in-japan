<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logics\Util;

class MainController extends Controller
{
	public function Index() {
		$categoryList = (new \App\Logics\Category)->GetAllCategories(['withCache' => 1]);
		// TODO
		// 테스트 후에 캐쉬 활성화 할것
		// $postList = (new \App\Logics\Post)->GetPostsByPage(1, ['withCache' => 1]);
		$postList = (new \App\Logics\Post)->GetPostsByPage(1, ['forMain' => 1]);
		$koreanPostList   = $postList['korean'];
		$japanesePostList = $postList['japanese'];
		$allPostList      = array_merge($japanesePostList, $koreanPostList);
		return view('main/index', [
			'categoryList'     => $categoryList,
			'koreanPostList'   => $postList['korean'],
			'japanesePostList' => $postList['japanese'],
			'allPostList'      => $allPostList,
		]);
	}

	// 카테고리별 포스트
	public function Category($id) {
		$categoryNameById = (new \App\Logics\Category())->GetCategoryNameArray(['withCache' => 1]);
		// 유효 카테고리 체크
		if (! Util::CanGetArrayValue($categoryNameById, $id)) {
			return redirect(url("/"));
		}

		$categoryList = (new \App\Logics\Category)->GetAllCategories(['withCache' => 1]);
		$posts = (new \App\Logics\Post)->GetPublicPostsByCategoryIdAndPage($id, 1, ['forMain' => 1]);
		return view('main/category', [
			'categoryList'  => $categoryList,
			'categoryName'  => $categoryNameById[$id],
			'postList'      => $posts,
		]);
	}
}
