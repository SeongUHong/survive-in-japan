<div class="main-middle-content row" data-post-id="{{ $post['id'] }}">
  <div class="main-middle-content-thumb col-3">
    <img src="{{ '/' . \App\Consts\Image::READ_BASE_DIRECTORY . $post['thumb_path']}}">
  </div>
  <div class="main-middle-content-text col-9">
    <div class="main-middle-content-text-title">
      {{ $post['title'] }}
    </div>
  </div>
</div>