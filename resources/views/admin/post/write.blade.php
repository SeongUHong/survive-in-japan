@extends('admin/layout')
@section('content')
記事作成<br>
<div style="padding:1rem" id="app">
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
      <select class="form-select" size="4" multiple name="category_id" id="jp-category-id">
        @foreach($jpCategoryList as $category)
          <option @if(isset($post) && $post['category_id'] == $category['id']) selected @endif value="{{ $category['id'] }}">
            {{ $category['name'] }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="tab-pane @if($isKorean) active @endif" id="korean">
      <select class="form-select" size="4" multiple name="category_id" id="kr-category-id">
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
    <textarea name="title" id="title" class="form-control" style="resize: none;">{{ $post['title'] }}</textarea>
  </div>
  <br>

  <!-- 썸네일 -->
  <h3>サムネイル</h3>
  <div class="input-group">
    <input type="file" class="form-control" id="thumb-input">
    <button id="upload-thumb-btn" class="btn btn-outline-secondary" type="button">追加</button>
  </div>
  <div id="thumb-box" style="width:10rem">
    @if($post['thumb_path'])
      <img src="{{ asset( $thumb_full_path ) }}" style="width:100%" alt="">
    @endif
  </div>
  <br>

  <!-- 이미지 업로드 -->
  <h3>画像追加</h3>
  <div class="input-group">
    <input type="file" class="form-control" id="image-input">
    <button id="upload-img-btn" class="btn btn-outline-secondary" type="button">追加</button>
  </div>
  <br>

  <!-- 이미지 리스트 -->
  <h3>画像リスト</h3>
  <button id="add-img-tab-btn" class="btn btn-primary" type="button">画像タグ追加</button>
  <div class="container"> 
    <div class="row" id="img-box">
      @foreach($imagePathList as $imagePath)
        @include('admin/post/_sub/image_card', ['path' => $imagePath])
      @endforeach
    </div>
  </div>
  
  <br>
  <h3>内容</h3>
  <div class="btn-group">
    <input type="radio" class="btn-check" name="content_radio" id="content-edit-btn" checked>
    <label class="btn btn-outline-primary" for="content-edit-btn" style="width:6rem">Edit</label>

    <input type="radio" class="btn-check" name="content_radio" id="content-preview-btn">
    <label class="btn btn-outline-primary" for="content-preview-btn" style="width:6rem">Preview</label>
  </div>
  <div class="form-floating">
    <textarea name="content" id="content" class="form-control border border-primary" style="resize: none; height: 600px">{{ $post['content'] }}</textarea>
  </div>
  <div class="overflow-y-auto border border-primary" id="content-preview-box" style="height: 600px"></div>
  <br>
  <input type="hidden" name="id" id="post-id" value="{{ $post['id'] }}">
  <button type="button" id="edit-exec-btn" class="btn btn-primary">公開</button>
  <button type="button" id="store-exec-btn" class="btn btn-secondary">保管</button>
</div>
<script src="{{ asset('js/pages/admin_write.js') }}"></script>
@endsection