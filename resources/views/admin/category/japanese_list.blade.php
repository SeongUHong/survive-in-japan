@extends('admin/layout')
@section('content')
日本カテゴリー一覧<br>
<div style="padding:1rem">
  <form action="{{ url('admin_category_japanese_add') }}" method="post">
    @include('admin/category/_sub/add_form_content')
  </form>
    @include('admin/category/_sub/category_table', ['categoryList' => $categoryList])
</div>
@endsection