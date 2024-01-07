<?php

use Illuminate\Support\Facades\Route;

# TOP
Route::get('/', 'App\Http\Controllers\MainController@Index');

#===================
# 관리자 페이지
#===================
# TOP
Route::get('/admin_index', 'App\Http\Controllers\AdminController@Index')->middleware('login');
# 로그인
Route::get('/admin_login', 'App\Http\Controllers\AdminController@Login');
# 로그인 실행
Route::post('/admin_login_exec', 'App\Http\Controllers\AdminController@LoginExec');
# 로그아웃
Route::get('/admin_logout', 'App\Http\Controllers\AdminController@Logout')->middleware('login');

#===================
# 관리자 포스트 작성
#===================
# 한국어 포스트 리스트
Route::get('/admin_post_korean_list', 'App\Http\Controllers\Admin\PostController@KoreanList')->middleware('login');
# 일본어 포스트 리스트
Route::get('/admin_post_japanese_list', 'App\Http\Controllers\Admin\PostController@JapaneseList')->middleware('login');
# 포스트 편집
Route::get('/admin_post_edit/{id}', 'App\Http\Controllers\Admin\PostController@Edit')->middleware('login');
# 포스트 편집 실행
Route::post('/admin_post_edit_exec', 'App\Http\Controllers\Admin\PostController@EditExec')->middleware('login');
# 한국어 카테고리 리스트
Route::get('/admin_category_korean_list', 'App\Http\Controllers\Admin\CategoryController@KoreanList')->middleware('login');
# 일본어 카테고리 리스트
Route::get('/admin_category_japanese_list', 'App\Http\Controllers\Admin\CategoryController@JapaneseList')->middleware('login');
# 한국어 카테고리 추가
Route::post('/admin_category_korean_add', 'App\Http\Controllers\Admin\CategoryController@AddKorean')->middleware('login');
# 일본어 카테고리 추가
Route::post('/admin_category_japanese_add', 'App\Http\Controllers\Admin\CategoryController@AddJapanese')->middleware('login');
# 카테고리 삭제 확인
Route::get('/admin_category_delete_confirm/{id}', 'App\Http\Controllers\Admin\CategoryController@DeleteConfirm')->middleware('login');
# 카테고리 삭제
Route::post('/admin_category_delete_exec', 'App\Http\Controllers\Admin\CategoryController@DeleteExec')->middleware('login');

#===================
# 포스트
#===================
Route::get('/post_view/{id}', 'App\Http\Controllers\PostController@View');