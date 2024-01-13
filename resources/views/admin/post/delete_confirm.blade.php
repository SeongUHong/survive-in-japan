@extends('admin/layout')
@section('content')
記事削除確認<br>
<div style="padding:1rem">
  <h2>以下の記事を削除します。</h2>
  <div style="padding:1rem; border:1px solid black">
    <h3>カテゴリー</h3>
     <div>
        @if (isset($categoryName))
          {{ $categoryName }}
        @else
          <span style="color:red">不明</span>
        @endif
     </div>
    <h3>タイトル</h3>
    <div>
      {{ $post['title'] }}
    </div>
    <br>
    <h3>内容</h3>
    <div>
      {{ $post['content'] }}
    </div>
  </div>
  <form action="{{ url('admin_post_delete_exec') }}" method="post" >
   @csrf 
    <input type="hidden" name="id" value="{{ $post['id'] }}">
    <input type="submit" value="削除" class="btn btn-danger">
  </form>
</div>
@endsection