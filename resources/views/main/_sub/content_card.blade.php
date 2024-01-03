<div class="main-middle-content row">
  <div class="main-middle-content-thumb col-3">
    <img src="./test.png">
  </div>
  <div class="main-middle-content-text col-9">
    <div class="main-middle-content-text-title fs-5 fw-bold">
      <a href="{{ url('post_view').'/'.$post['id'] }}">
        {{ $post['title'] }}
      </a>
    </div>
    <div class="main-middle-content-text-detail fs-6">
      {{ $post['content'] }}
    </div>
  </div>
</div>