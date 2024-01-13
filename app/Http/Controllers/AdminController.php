<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Logics\Util;

class AdminController extends Controller
{
	public function Index() {
		return view('admin/index', []);
	}

	# 로그인
	public function Login(Request $request) {
		# 이미 로그인 중이면 TOP으로
		if (session()->has('user_id')) {
			return redirect(url('/admin_index'));
		}
		return view('admin/login', []);
	}

	# 로그인 실행
	public function LoginExec(Request $request) {
		$user = \App\Models\User::Where('login_id', $request->login_id)->first();
		# 없는 유저일 경우 에러 문구를 표시
		if (is_null($user)) {
			return view('admin/login', ['login_error' => 1]);
		}
		# 패스워드 일치
		if (Hash::check($request->password, $user->password)) {
			session(['user_id' => $user->id]);
			return redirect(url('/admin_index'));
		}

		# 로그인 실패
		return view('admin/login', ['login_error' => 1]);
	}

	# 로그아웃
	public function Logout(Request $request)
	{
		session()->forget('user_id');
		return redirect(url('/'));
	}

	// 디버그
	public function Sandbox(Request $request) {
		$validate = $request->validate([
			'msg' => 'nullable',
		]);

		$msg = '';
		if (Util::CanGetArrayValue($validate, 'msg')) {
			$msg = $validate['msg'];
		}

		return view('admin/sandbox', [
			'msg' => $msg,
		]);
	}
}
