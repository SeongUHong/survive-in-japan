<?php
namespace App\Consts;

class Post
{
	// 상태
	const STATUS = [ 
		"PUBLIC"  => 1, // 공개
		"DRAFT"   => 2, // 임시 저장
		"REMOVE"  => 3, // 삭제 대기
	];
}