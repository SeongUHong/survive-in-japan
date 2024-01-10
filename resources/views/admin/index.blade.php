@extends('admin/layout')
@section('content')
  管理ぺーじ<br>
  <a href="{{ url('/') }}">SURVIVE IN JAPAN</a><br>
  <a href="{{ url('admin_logout') }}">ログアウト</a><br>
  <a href="{{ url('admin_post_create') }}">記事作成</a><br>
  <a href="{{ url('admin_post_japanese_list') }}">日本語記事</a><br>
  <a href="{{ url('admin_post_korean_list') }}">韓国語記事</a><br>
  <a href="{{ url('admin_category_japanese_list') }}">日本語カテゴリー</a><br>
  <a href="{{ url('admin_category_korean_list') }}">韓国語カテゴリー</a><br>
@endsection
