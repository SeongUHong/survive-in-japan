<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
	public function index() {
		$category = new \App\Logics\Category;
		$categoryList = $category->getCategories();
		return view('main/index', [
			'categoryList' => $categoryList,
		]);
	}
}
