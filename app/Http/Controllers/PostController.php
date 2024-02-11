<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
	public function View($id) {
		// TODO
		// 테스트 후에 캐쉬 활성화 할것
		// $post = (new \App\Logics\Post())->GetPost($id, ['withCache' => 1]);
		$post = (new \App\Logics\Post())->GetPost($id);
		return view('post/view', [
			'post' => $post,
		]);
	}
}
