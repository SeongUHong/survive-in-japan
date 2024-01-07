@extends('admin/layout')
@section('content')
記事作成<br>
<div style="padding:1rem">
  <form action="{{ url('admin_post_edit_exec') }}" method="post" >
   @csrf 
    <h3>タイトル</h3>
    <div class="form-floating">
      <textarea name="title" class="form-control" style="resize: none;">{{ $post['title'] }}</textarea>
    </div>
    <br>
    <h3>内容</h3>
    <div class="form-floating">
      <textarea name="content" class="form-control" style="resize: none; height: 600px">{{ $post['content'] }}</textarea>
    </div>
    <input type="hidden" name="id" value="{{ $post['id'] }}">
    <br>
    <input type="submit" value="保存" class="btn btn-primary">
  </form>
</div>
@endsection