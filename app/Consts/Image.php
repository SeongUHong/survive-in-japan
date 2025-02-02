<?php
namespace App\Consts;

class Image
{
	// 업로드 되는 디렉토리 (storage/app/public)
	const UPLOAD_BASE_DIRECTORY = 'public';
	// 참조를 위한 디렉토리 (public/storage)
	const READ_BASE_DIRECTORY = 'storage';

	// 포스트 작성 이미지 패스
	const POST_IMAGE_PATH = '/images/post';
	// 포스트 썸네일 이미지 패스
	const POST_THUMB_IMAGE_PATH = '/images/thumb';
	// 포스트 작성 이미지 업로드 패스
	const UPLOAD_POST_IMAGE_PATH = self::UPLOAD_BASE_DIRECTORY . self::POST_IMAGE_PATH;
	// 포스트 썸네일 이미지 업로드 패스
	const UPLOAD_POST_THUMB_IMAGE_PATH = self::UPLOAD_BASE_DIRECTORY . self::POST_THUMB_IMAGE_PATH;
	// 포스트 작성 이미지 참조 패스
	const READ_POST_IMAGE_PATH = self::READ_BASE_DIRECTORY . self::POST_IMAGE_PATH;
	// 포스트 썸네일 이미지 참조 패스
	const READ_POST_THUMB_IMAGE_PATH = self::READ_BASE_DIRECTORY . self::POST_THUMB_IMAGE_PATH;
}