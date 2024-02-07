<?php
namespace App\Logics;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Image {
	public function GetImagePathListByPostId($postId, $options = []) {
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		$origin = function () use ($postId) {
			$postImages = \App\Models\PostImage::where("post_id", $postId)->get()->all();
			return array_map(function($postImage) {
				return $this->_MakePath($postImage->path, $postImage->name);
			}, $postImages);
		};

		if (isset($withCache)) {
			return Cache::remember('GetAllCategories', \App\Consts\Cache::CACHE_TIME, $origin);
		}

		return call_user_func_array($origin, []);
	}

	// 지정 포스트 관련 이미지 삭제
	// 삭제할 수 없는 이미지 패스를 반환
	// 삭제할 수 없는 이미지가 존재할 시, 전체 삭제 중지
	// return : [];
	public function DeleteByPostId($postId) {
		$postImages = \App\Models\PostImage::where("post_id", $postId)->get()->all();
		$pathList = array_map(function($postImage) {
			return $this->_MakeStoragePath($postImage->path, $postImage->name);
		}, $postImages);

		$invalidPathList = [];
		foreach($pathList as $path) {
			if (! File::exists($path)) {
				array_push($invalidPathList, $path);
			}
		}

		// 삭제할 수 없는 이미지가 있다면 반환
		if (count($invalidPathList) > 0) {
			return $invalidPathList;
		}

		// 이미지 파일 삭제
		foreach($pathList as $path) {
			File::delete($path);
		}

		// 이미지 데이터 삭제
		\App\Models\PostImage::where("post_id", $postId)->delete();

		return [];
	}

	// 프론트 표시용 패스를 작성
	private function _MakePath($path, $name) {
		return '/' . \App\Consts\Image::READ_BASE_DIRECTORY . $path . '/' . $name;
	}

	// 실제로 저장된 패스를 작성
	private function _MakeStoragePath($path, $name) {
		return public_path(\App\Consts\Image::READ_BASE_DIRECTORY . $path . '/' . $name);
	}
}