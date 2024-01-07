@extends('admin/layout')
@section('content')
カテゴリー削除確認<br>
<div style="padding:1rem">
  <h2>以下のカテゴリーを削除します。</h2>
  <div style="padding:1rem; border:1px solid black">
    <p>ID : {{ $id }}</p>
    <p>カテゴリー名 : {{ $name }}</p>
  </div>
  <form action="{{ url('admin_category_delete_exec') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="submit" value="削除" class="btn btn-danger">
  </form>
</div>
@endsection