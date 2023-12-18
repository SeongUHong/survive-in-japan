<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
	public function index($page) {
		$categoryList = (new \App\Logics\Category)->getAllCategories();
		$postList = (new \App\Logics\Post)->getPostsByPage(1);
		return view('main/index', [
			'categoryList' => $categoryList,
			'postList'     => $postList,
		]);
	}
}
