<div class="main-middle-small-content row" data-post-id="{{ $post['id'] }}">
  <div class="main-middle-small-content-thumb col-4">
    <img src="{{ '/' . \App\Consts\Image::READ_BASE_DIRECTORY . $post['thumb_path']}}">
  </div>
  <div class="main-middle-small-content-text col-8">
    <div class="main-middle-small-content-text-title">
      {{ $post['title'] }}
    </div>
  </div>
</div>