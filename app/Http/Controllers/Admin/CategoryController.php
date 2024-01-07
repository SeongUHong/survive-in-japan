<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	// 한국어 카테고리 리스트
	public function KoreanList() {
		$categoryList = (new \App\Logics\Category())->GetKoreanCategories();

		return view('admin/category/korean_list', [
			'categoryList' => $categoryList,
			'isKorean'     => 1,
		]);
	}

	// 일본어 카테고리 리스트
	public function JapaneseList() {
		$categoryList = (new \App\Logics\Category())->GetJapaneseCategories();

		return view('admin/category/japanese_list', [
			'categoryList' => $categoryList,
		]);
	}

	// 한국어 카테고리 추가
	// TODO : 부모ID를 받아서 하위 카테고리를 추가할 수 있는 형태로 수정할 것
	public function AddKorean(Request $request) {
		$request->validate([
			'name' => 'required|max:50',
		]);

		$category = new \App\Models\Category();
		$category->depth = \App\Consts\Category::MIN_CATEGORY_DEPTH + 1;
		$category->parent_id = \App\Consts\Category::BASE_CATEGORIES['KOREAN'];
		$category->name = $request->name;
		$category->save();

		return redirect(url('admin_category_korean_list'));
	}

	// 일본어 카테고리 추가
	// TODO : 부모ID를 받아서 하위 카테고리를 추가할 수 있는 형태로 수정할 것
	public function AddJapanese(Request $request) {
		$request->validate([
			'name' => 'required|max:50',
		]);

		$category = new \App\Models\Category();
		$category->depth = \App\Consts\Category::MIN_CATEGORY_DEPTH + 1;
		$category->parent_id = \App\Consts\Category::BASE_CATEGORIES['JAPANESE'];
		$category->name = $request->name;
		$category->save();

		return redirect(url('admin_category_japanese_list'));
	}

	public function DeleteConfirm($id) {
		$category = \App\Models\Category::find($id);
		if(is_null($category)) {
			return redirect('admin_index');
		}

		return view('admin/category/delete_confirm', [
			'id'    => $id,
			'name'  => $category->name,
		]);
	}

	public function DeleteExec(Request $request) {
		$request->validate([
			'id' => 'required|integer',
		]);
		$id = $request->id;

		// 한국어 카테고리인지 확인해둠
		$isKorean = (new \App\Logics\Category())->IsKoreanCategory($id);

		$category = \App\Models\Category::find($id);
		if(is_null($category)) {
			return redirect('admin_index');
		}
		// 삭제
		$category->delete();
		
		if ($isKorean) {
			return redirect('admin_category_korean_list');
		} else {
			return redirect('admin_category_japanese_list');
		}
	}
}
