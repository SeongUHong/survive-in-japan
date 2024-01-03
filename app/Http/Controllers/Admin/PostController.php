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
		$id = $request->id;
		if(is_null($id)) {
			return redirect(url("/admin_index"));
		}
		// 포스트 검색
		$post = \App\Models\Post::find($id);
		// 없는 포스트ID일 경우 TOP으로
		if(is_null($post)) {
			return redirect(url("/admin_index"));
		}

		$post->title = $request->title;
		$post->content = $request->content;
		$post->save();

		return redirect(url("/admin_post_edit/{$id}"));
	}
}
