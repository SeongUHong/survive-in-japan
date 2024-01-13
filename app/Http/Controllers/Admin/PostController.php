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

	// 편집
	public function Edit($id) {
		$post = (new \App\Logics\Post())->GetPost($id);
		if(is_null($post)) {
			return redirect(url("/admin_index"));
		}

		$isKorean = (new \App\Logics\Category())->IsKoreanCategory($post['category_id']);
		$isJapanese = $isKorean ? false : true;

		$categoryLogic = new \App\Logics\Category();
		$krCategoryList = $categoryLogic->GetKoreanCategories();
		$jpCategoryList = $categoryLogic->GetJapaneseCategories();

		return view('admin/post/write', [
			'post'           => $post,
			'krCategoryList' => $krCategoryList,
			'jpCategoryList' => $jpCategoryList,
			'isKorean'       => $isKorean,
			'isJapanese'     => $isJapanese,
		]);
	}

	public function EditExec(Request $request) {
		$request->validate([
			'id'          => 'required|integer',
			'category_id' => 'required|integer',
			'title'       => 'required',
			'content'     => 'required',
		]);
		$id = $request->id;

		// 포스트 검색
		$post = \App\Models\Post::find($id);
		// 없는 포스트ID일 경우 TOP으로
		if(is_null($post)) {
			return redirect(url("/admin_index"));
		}

		$post->title = $request->title;
		$post->content = $request->content;
		$post->category_id = $request->category_id;
		$post->save();

		return redirect(url("/admin_post_edit/{$id}"));
	}

	public function DeleteConfirm($id) {
		$post = (new \App\Logics\Post())->GetPost($id);
		$categoryNameById = (new \App\Logics\Category())->GetCategoryNameArray();
		$categoryName = isset($categoryNameById[$post['category_id']]) ? $categoryNameById[$post['category_id']] : null;

		return view('admin/post/delete_confirm', [
			'post'         => $post,
			'categoryName' => $categoryName,
		]);
	}

	public function DeleteExec(Request $request) {
		$request->validate([
			'id' => 'required|integer',
		]);
		$id = $request->id;

		$post = \App\Models\Post::find($id);
		if(is_null($post)) {
			return redirect('admin_index');
		}

		// 카테고리 확인용
		$categoryId = $post->category_id;
		// 삭제
		$post->delete();
		
		if ((new \App\Logics\Category())->IsKoreanCategory($categoryId)) {
			return redirect('admin_post_korean_list');
		} else {
			return redirect('admin_post_japanese_list');
		}
	}

	// 새 포스트 작성
	public function Create() {
		$categoryLogic = new \App\Logics\Category();
		$krCategoryList = $categoryLogic->GetKoreanCategories();
		$jpCategoryList = $categoryLogic->GetJapaneseCategories();

		return view('admin/post/write', [
			'krCategoryList' => $krCategoryList,
			'jpCategoryList' => $jpCategoryList,
			'isKorean'       => false,
			'isJapanese'     => true,
		]);
	}

	// 새 포스트 작성 실행
	public function CreateExec(Request $request) {
		$request->validate([
			'category_id' => 'required|integer',
			'title'       => 'required',
			'content'     => 'required',
		]);

		$post = new \App\Models\Post();
		$post->category_id = $request->category_id;
		$post->title = $request->title;
		$post->content = $request->content;
		$post->status = \App\Consts\Post::STATUS['PUBLIC'];
		$post->save();

		return redirect(url("admin_post_edit/{$post->id}"));
	}

	// 이미지를 업로드
	// 업로드 후엔 본문에 태그를 추가함
	const UPLOAD_IMAGE_PATH = "public/images";
	public function ImageUpload(Request $request) {
		$request -> validate([
			'image' => 'image|required|mimes:jpeg,png,jpg,gif',
		]);

		$image = $request->image;
		$imageName = date("ymdhms") . '_' . $image->getClientOriginalName();
		$path = $image->storeAs(self::UPLOAD_IMAGE_PATH, $imageName);

		return view('admin/sandbox', [
			'msg' => $path,
		]);
	}
}
