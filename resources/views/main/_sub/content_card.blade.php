<div class="main-middle-content row" onclick="location.href='{{ url('post_view').'/'.$post['id'] }}';">
  <div class="main-middle-content-thumb col-3">
    <img src="{{ '/' . \App\Consts\Image::READ_BASE_DIRECTORY . $post['thumb_path']}}">
  </div>
  <div class="main-middle-content-text col-9">
    <div class="main-middle-content-text-title fs-5 fw-bold">
      {{ $post['title'] }}
    </div>
  </div>
</div>