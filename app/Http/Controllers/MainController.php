<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
	public function Index() {
		$categoryList = (new \App\Logics\Category)->GetAllCategories();
		$postList = (new \App\Logics\Post)->GetPostsByPage(1);
		return view('main/index', [
			'categoryList'     => $categoryList,
			'koreanPostList'   => $postList['korean'],
			'japanesePostList' => $postList['japanese'],
		]);
	}
}
