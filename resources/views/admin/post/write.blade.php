@extends('admin/layout')
@section('content')
記事作成<br>
<div style="padding:1rem">
  <form action="@if(isset($post)){{ url('admin_post_edit_exec') }}@else{{ url('admin_post_create_exec') }}@endif" method="post">
    @csrf

    <!-- 카테고리 탭 -->
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <button class="nav-link @if($isJapanese) active @endif" data-bs-toggle="tab" data-bs-target="#japanese" type="button" aria-selected="true">日本語</button>
      </li>
      <li class="nav-item">
        <button class="nav-link @if($isKorean) active @endif" data-bs-toggle="tab" data-bs-target="#korean" type="button" aria-selected="false">韓国語</button>
      </li>
    </ul>
    <!-- 카테고리 표시 영역 -->
    <div class="tab-content">
      <div class="tab-pane @if($isJapanese) active @endif" id="japanese">
        <select class="form-select" size="4" multiple name="category_id">
          @foreach($jpCategoryList as $category)
            <option @if(isset($post) && $post['category_id'] == $category['id']) selected @endif value="{{ $category['id'] }}">
              {{ $category['name'] }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="tab-pane @if($isKorean) active @endif" id="korean">
        <select class="form-select" size="4" multiple name="category_id">
          @foreach($krCategoryList as $category)
            <option @if(isset($post) && $post['category_id'] == $category['id']) selected @endif value="{{ $category['id'] }}">
              {{ $category['name'] }}
            </option>
          @endforeach
        </select>
      </div>
    </div>
    <br>
    <!-- 포스트 -->
    <h3>タイトル</h3>
    <div class="form-floating">
      <textarea name="title" class="form-control" style="resize: none;">@if(isset($post)){{ $post['title'] }}@endif</textarea>
    </div>
    <br>
    <h3>内容</h3>
    <div class="form-floating">
      <textarea name="content" class="form-control" style="resize: none; height: 600px">@if(isset($post)){{ $post['content'] }}@endif</textarea>
    </div>
    <br>
    @if(isset($post))
      <input type="hidden" name="id" value="{{ $post['id'] }}">
    @endif
    <input type="submit" value="保存" class="btn btn-primary">
  </form>
  <!-- 이미지 리스트 -->
  <h3>画像リスト</h3>
  <div class="container"> 
    <div class="row">
      @foreach($imagePathList as $imagePath)
        @include('admin/post/_sub/image_card', ['path' => $imagePath])
      @endforeach
    </div>
  </div>
  <!-- 이미지 업로드 -->
  <h3>画像追加</h3>
  <form action="{{ url('admin_post_image_upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="input-group">
      <input type="hidden" name="id" value="{{ $post['id'] }}">
      <input type="file" class="form-control" name="image">
      <input type="submit" class="btn btn-outline-secondary" value="追加">
    </div>
  </form>
</div>
@endsection