@extends('admin/layout')
@section('content')
韓国カテゴリー一覧<br>
<div style="padding:1rem">
  <form action="{{ url('admin_category_korean_add') }}" method="post">
    @include('admin/category/_sub/add_form_content')
  </form>
  @include('admin/category/_sub/category_table', ['categoryList' => $categoryList])
</div>
@endsection