<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// 기존 레코드 삭제
		User::truncate();

		$user = [
			'login_id' => 'swhong',
			'password' => Hash::make('tjddn30640'),
			'nickname' => 'Hong Seongwoo',
			'status'   => \App\Consts\User::STATUS["ADMIN"],
		];

		User::create($user);
	}
}
