
<div class="container" style="padding:1rem" id="app">
  @extends('admin/layout')
  @section('content')
  記事作成<br>

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

  <div class="row">
    <!-- 포스트 작성 도구 -->
    <div class="col-md-4 col-12">

      <!-- 메타 데이터 -->
      <div class="d-grid">
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#add-meta">メタデータ</button>
      </div>
      <div class="collapse" id="add-meta">
        <div class="card card-body" id="meta-data-area">
          @foreach ($post['meta_list'] as $meta_data)
            @include('admin/post/_sub/meta_data_input', ['meta_data' => $meta_data])
          @endforeach
          <button class="btn btn-light mb-3" type="button" id="add-meta-data-input-btn"><i class="bi bi-plus-circle"></i></button>
          <button class="btn btn-primary" type="button" id="add-meta-data-btn">メタデータ追加</button>
        </div>
      </div>

      <!-- 이미지 업로드 -->
      <div class="d-grid">
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#add-img">画像追加</button>
      </div>
      <div class="collapse" id="add-img">
        <div class="card card-body">
          <div class="input-group">
            <input type="file" class="form-control" id="image-input">
            <button id="upload-img-btn" class="btn btn-outline-secondary" type="button">追加</button>
          </div>
        </div>
      </div>

      <!-- 이미지 리스트 -->
      <div class="d-grid">
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#img-list">画像リスト</button>
      </div>
      <div class="collapse" id="img-list">
        <div class="card card-body">
          <button id="add-img-tab-btn" class="btn btn-primary" type="button">画像タグ追加</button>
          <div class="container"> 
            <div class="row" id="img-box">
              @foreach($imagePathList as $imagePath)
                @include('admin/post/_sub/image_card', ['path' => $imagePath])
              @endforeach
            </div>
          </div>
        </div>
      </div>


      <!-- 포스트 편집 -->
      <div class="d-grid">
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#edit-content">内容編集</button>
      </div>
      <div class="collapse" id="edit-content">
        <div class="card card-body">
          <div>
            <p><b>タグ</b></p>
            <!-- h1 -->
            <input type="radio" class="btn-check" name="tag-opt" id="h1-opt" value="h1" autocomplete="off" checked>
            <label class="btn" for="h1-opt">h1</label>
            <!-- h2 -->
            <input type="radio" class="btn-check" name="tag-opt" id="h2-opt" value="h2" autocomplete="off">
            <label class="btn" for="h2-opt">h2</label>
            <!-- h3 -->
            <input type="radio" class="btn-check" name="tag-opt" id="h3-opt" value="h3" autocomplete="off">
            <label class="btn" for="h3-opt">h3</label>
            <!-- p -->
            <input type="radio" class="btn-check" name="tag-opt" id="p-opt" value="p" autocomplete="off">
            <label class="btn" for="p-opt">p</label>
            <!-- span -->
            <input type="radio" class="btn-check" name="tag-opt" id="span-opt" value="span" autocomplete="off">
            <label class="btn" for="span-opt">span</label>
            <hr>

            <p><b>スタイル</b></p>
            <!-- 왼쪽 정렬 -->
            <input type="radio" class="btn-check" name="pos-stl" id="left-stl" value="left" autocomplete="off" checked>
            <label class="btn" for="left-stl"><i class="bi bi-text-left"></i></label>
            <!-- 중앙 정렬 -->
            <input type="radio" class="btn-check" name="pos-stl" id="center-stl" value="center" autocomplete="off">
            <label class="btn" for="center-stl"><i class="bi bi-text-center"></i></label>
            <!-- 오른쪽 정렬 -->
            <input type="radio" class="btn-check" name="pos-stl" id="right-stl" value="right" autocomplete="off">
            <label class="btn" for="right-stl"><i class="bi bi-text-right"></i></label>

            <span>|</span>

            <!-- 밑줄 -->
            <input type="checkbox" class="btn-check" id="underline-stl" value="underline" autocomplete="off">
            <label class="btn" for="underline-stl"><i class="bi bi-type-underline"></i></label>
            <br>
            <hr>
            <p><b>テキストデザイン</b></p>
            <select class="form-select" id="text-design-select">
              <option value="">なし</option>
              <option value="left-line">左線</option>
              <option value="kakomisen">囲み戦</option>
              <option value="haikeiiro">背景色</option>
              <option value="center-symbol">中央電球シンボル</option>
              <option value="either-side-line">両サイドに線</option>
              <option value="short-underline">下に小さな線</option>
              <option value="subcopy">サブコピー</option>
            </select>
            <div class="row" style="background-color: #F5F5F5;">
              <div class="col-md-2 col-1"></div>
              <div class="post-view-content col-md-8 col-10" style="height: 10rem; margin-top:4rem">
                <h1 id="sample-design-text"></h1>
              </div>
              <div class="col-md-2 col-1"></div>
            </div>
            <textarea id="tag-txt" class="form-control" style="resize: none; height: 15rem;"></textarea>
            <button type="button" class="btn btn-outline-dark" id="add-tag-txt">入力</button>
            <button type="button" class="btn btn-outline-dark" id="add-tag-br">改行</button>
          </div>
        </div>
      </div>
      
    </div>

    <!-- 포스트 미리보기 -->
    <div class="col-md-8 col-12">
      <div class="btn-group">
        <input type="radio" class="btn-check" name="content_radio" id="content-preview-btn" checked>
        <label class="btn btn-outline-primary" for="content-preview-btn" style="width:6rem">Preview</label>

        <input type="radio" class="btn-check" name="content_radio" id="content-edit-btn">
        <label class="btn btn-outline-primary" for="content-edit-btn" style="width:6rem">Edit</label>
      </div>
      <div class="form-floating">
        <textarea name="content" id="content" class="form-control border border-primary" style="resize: none; height: 60rem">{{ $post['content'] }}</textarea>
      </div>
      <div class="overflow-y-auto border border-primary" id="content-preview-box" style="height: 60rem">
        <div class="row">
          <div class="col-md-2 col-1"></div>
          <div class="post-view-content col-md-8 col-10" id="post-view-content">
          </div>
          <div class="col-md-2 col-1"></div>
        </div>
      </div>
      <br>
      <input type="hidden" name="id" id="post-id" value="{{ $post['id'] }}">
      <div style="text-align:right">
        <button type="button" id="edit-exec-btn" class="btn btn-primary">公開</button>
        <button type="button" id="store-exec-btn" class="btn btn-secondary">保管</button>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/pages/admin/write.js') }}"></script>
@endsection