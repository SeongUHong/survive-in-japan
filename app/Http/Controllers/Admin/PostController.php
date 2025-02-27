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

	public function DraftList() {
		$postList = (new \App\Logics\Post())->GetDraftPostsByPage(1);
		$categoryNameById = (new \App\Logics\Category())->GetCategoryNameArray();
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
			'imagePathList'  => (new \App\Logics\Image())->GetImagePathListByPostId($id),
			'thumb_full_path' => (new \App\Logics\Thumb())->GetThumbPath($post['thumb_path'], $post['id']),
		]);
	}

	public function EditExec(Request $request) {
		$request->validate([
			'id'          => 'required|integer',
			'title'       => 'required',
			'content'     => 'required',
			'category_id' => 'required|integer',
		]);
		$id = $request->id;

		// 포스트 검색
		$post = \App\Models\Post::find($id);
		// 없는 포스트ID일 경우 에러 메세지
		if(is_null($post)) {
			return response()->json(['error' => 'Not exist post'], 400);
		}

		$post->title = $request->title;
		$post->content = $request->content;
		$post->category_id = $request->category_id;
		$post->status = \App\Consts\Post::STATUS['PUBLIC'];
		$post->save();

		return response()->json(['msg' => 'Save for public successed']);
	}

	// 포스트를 임시보관
	public function StoreExec(Request $request) {
		$request->validate([
			'id'          => 'required|integer',
			'title'       => 'nullable',
			'content'     => 'nullable',
			'category_id' => 'nullable|integer',
		]);
		$id = $request->id;

		// 포스트 검색
		$post = \App\Models\Post::find($id);
		// 없는 포스트ID일 경우 에러 메세지
		if(is_null($post)) {
			return response()->json(['error' => 'Not exist post'], 400);
		}

		$post->title = $request->title ? $request->title : '';
		$post->content = $request->content ? $request->content : '';
		$post->category_id = $request->category_id ? $request->category_id : \App\Consts\Category::UNDEF;
		$post->status = \App\Consts\Post::STATUS['DRAFT'];
		$post->save();

		return response()->json(['msg' => 'Save for draft successed']);
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

		// 관련 이미지 삭제
		$invalidimageList = (new \App\Logics\Image())->DeleteByPostId($id);
		// 삭제에 실패 했을 경우
		if (count($invalidimageList) > 0) {
			return redirect(url("/admin_category_delete_confirm/{$id}"));
		}

		// 카테고리 확인용
		$categoryId = $post->category_id;
		// 삭제
		$post->delete();
		
		if ($categoryId == 0) {
			return redirect('admin_post_draft_list');
		} elseif ((new \App\Logics\Category())->IsKoreanCategory($categoryId)) {
			return redirect('admin_post_korean_list');
		}  else {
			return redirect('admin_post_japanese_list');
		}
	}

	// 새 포스트 작성
	public function Create() {
		$categoryLogic = new \App\Logics\Category();
		$krCategoryList = $categoryLogic->GetKoreanCategories();
		$jpCategoryList = $categoryLogic->GetJapaneseCategories();

		$post = new \App\Models\Post();
		$post->save();

		return redirect(url("/admin_post_edit/{$post->id}"));
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
	public function ImageUpload(Request $request) {
		$request -> validate([
			'id'    => 'required|integer',
			'image' => 'image|required|mimes:jpeg,png,jpg,gif',
		]);

		$postId = $request->id;
		$post = \App\Models\Post::find($postId);
		// 없는 포스트ID일 경우 에러 메세지
		if(is_null($post)) {
			return response()->json(['error' => 'Not exist post'], 400);
		}

		// 이미지 저장
		$image = $request->image;
		$imageName = date("ymdhms") . '_' . $image->getClientOriginalName();
		$image->storeAs(\App\Consts\Image::UPLOAD_POST_IMAGE_PATH . '/', $imageName);

		// 포스트와 연결
		$postImage = new \App\Models\PostImage();
		$postImage->post_id = $postId;
		$postImage->name = $imageName;
		$postImage->path = \App\Consts\Image::POST_IMAGE_PATH;
		$postImage->save();

		return response()->json(['path' => "/" . \App\Consts\Image::READ_POST_IMAGE_PATH . "/" . $imageName]);
	}

	// 썸네일 업로드
	public function ThumbUpload(Request $request) {
		$request -> validate([
			'id'    => 'required|integer',
			'image' => 'image|required|mimes:jpeg,png,jpg,gif',
		]);

		$postId = $request->id;
		$post = \App\Models\Post::find($postId);
		// 없는 포스트ID일 경우 에러 메세지
		if (is_null($post)) {
			return response()->json(['error' => 'Not exist post'], 400);
		}

		// 이미 썸네일이 설정된 경우 삭제
		if (isset($post->thumb_path)) {
			// 파일 삭제에 실패한 경우 메세지
			if (!((new \App\Logics\Thumb())->DeleteByPath($post->thumb_path))) {
				return response()->json(['error' => 'Not exist image file'], 400);
			}
		}
		// 이미지 저장
		$image = $request->image;
		$imageName = $postId . date("ymdhms") . '_' . $image->extension();
		$image->storeAs(\App\Consts\Image::UPLOAD_POST_THUMB_IMAGE_PATH . '/', $imageName);

		// 포스트 정보 갱신
		$post->thumb_path = \App\Consts\Image::POST_THUMB_IMAGE_PATH . '/' . $imageName;
		$post->save();

		return response()->json(['path' => "/" . \App\Consts\Image::READ_POST_THUMB_IMAGE_PATH . "/" . $imageName]);
	}

	public function AutoEditExec(Request $request) {
		$request->validate([
			'id'          => 'required|integer',
			'title'       => 'nullable',
			'content'     => 'nullable',
		]);
		$id = $request->id;

		// 포스트 검색
		$post = \App\Models\Post::find($id);
		// 없는 포스트ID일 경우 에러 메세지
		if(is_null($post)) {
			return response()->json(['error' => 'Not exist post'], 400);
		}

		$post->title = $request->title ? $request->title : '';
		$post->content = $request->content ? $request->content : '';
		$post->save();

		return response()->json(['msg' => 'Auto save successed']);
	}
	
	public function UpdateMetaData(Request $request) {
		$request->validate([
			'post_id' => 'required|integer',
		]);
		$post_id = $request->post_id;

		// 포스트 검색
		$post = \App\Models\Post::find($post_id);
		if(is_null($post)) {
			return response()->json(['error' => 'Not exist post'], 400);
		}

		// post_id를 제외한 나머지 데이터 취득
		$metaDatas = $request->except('post_id');

		$MetaDataRecords = [];
		// key-value 연관배열을 배열화
		foreach (array_keys($metaDatas) as $name) {
			if ($name == null || $name == "") {
				continue;
			}
			$content = $metaDatas[$name];
			if ($content == null || $content == "") {
				continue;
			}

			// 배열에 메타데이터 연관배열을 추가
			array_push($MetaDataRecords, [
				'post_id' => $post_id,
				'name' => $name,
				'content' => $content,
			]);
		}

		// upsert 호출
		\App\Models\PostMeta::upsert(
			$MetaDataRecords,
			['post_id', 'name'],
			['content']
		);

		return response()->json(['msg' => 'Update meta data successed']);
	}

	// 메타데이터 삭제
	public function DeleteMetaData(Request $request) {
		$request->validate([
			'post_id' => 'required|integer',
			'name' => 'required',
		]);
		$post_id = $request->post_id;
		$name = $request->name;

		// 포스트 검색
		$post = \App\Models\Post::find($post_id);
		// 없는 포스트ID일 경우 에러 메세지
		if (is_null($post)) {
			return response()->json(['error' => 'Not exist post'], 400);
		}

		// 삭제
		\App\Models\PostMeta::where('post_id', $post_id)->where('name', $name)->delete();

		return response()->json(['msg' => 'delete meta data successed']);
	}
}
