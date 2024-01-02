<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function KoreanList() {
		$postList = (new \App\Logics\Post())->GetKoreanPostsWithoutRemovedByPage(1);
		$categoryNameById = (new \App\Logics\Category())->GetKoreanCategoryNameArray();
		return view('admin/post/list', [
			'postList' => $postList,
			'categoryNameById' => $categoryNameById,
			'statusNameById' => array_flip(\App\Consts\Post::STATUS),
		]);
	}

	public function JapaneseList() {
		$postList = (new \App\Logics\Post())->GetJapanesePostsWithoutRemovedByPage(1);
		$categoryNameById = (new \App\Logics\Category())->GetJapaneseCategoryNameArray();
		return view('admin/post/list', [
			'postList' => $postList,
			'categoryNameById' => $categoryNameById,
			'statusNameById' => array_flip(\App\Consts\Post::STATUS),
		]);
	}

	public function Edit($id) {
		$post = (new \App\Logics\Post())->GetPost($id);

		return view('admin/post/write', [
			'post' => $post,
		]);
	}

	public function EditExec(Request $request) {
		return redirect(url("/admin_post_edit/{$request->id}"));
	}
}
