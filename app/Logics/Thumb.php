<?php
namespace App\Logics;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Thumb {
	public function GetThumbPath($path, $options = []) {
		$withCache = null;
		if (Util::CanGetArrayValue($options, 'withCache')) {
			$withCache = 1;
		}

		$origin = function () use ($path) {
				return $this->_MakePath($path);
		};

		if (isset($withCache)) {
			return Cache::remember('GetAllCategories', \App\Consts\Cache::CACHE_TIME, $origin);
		}

		return call_user_func_array($origin, []);
	}

	// 썸네일 삭제
	// return : bool
	public function DeleteByPath($path) {
		$filePath = $this->_MakeStoragePath($path);

		// 파일이 없다면 패스 반환
		if (! File::exists($filePath)) {
			return false;
		}

		// 이미지 파일 삭제
		File::delete($filePath);

		return true;
	}

	// 프론트 표시용 패스를 작성
	private function _MakePath($path) {
		return '/' . \App\Consts\Image::READ_BASE_DIRECTORY . $path;
	}

	// 실제로 저장된 패스를 작성
	private function _MakeStoragePath($path) {
		return public_path(\App\Consts\Image::READ_BASE_DIRECTORY . $path);
	}
}