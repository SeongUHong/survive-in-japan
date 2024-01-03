<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
	public function View($id) {
		$post = (new \App\Logics\Post())->GetPost($id, ['withCache' => 1]);
		return view('post/view', [
			'post' => $post,
		]);
	}
}
