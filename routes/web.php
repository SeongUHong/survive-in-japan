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
# 포스트 작성
#===================