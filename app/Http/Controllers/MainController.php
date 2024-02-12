<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
	public function Index() {
		$categoryList = (new \App\Logics\Category)->GetAllCategories(['withCache' => 1]);
		// TODO
		// 테스트 후에 캐쉬 활성화 할것
		// $postList = (new \App\Logics\Post)->GetPostsByPage(1, ['withCache' => 1]);
		$postList = (new \App\Logics\Post)->GetPostsByPage(1, ['forMain' => 1]);
		return view('main/index', [
			'categoryList'     => $categoryList,
			'koreanPostList'   => $postList['korean'],
			'japanesePostList' => $postList['japanese'],
		]);
	}
}
