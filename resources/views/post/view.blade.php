<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/pages/post.css') }}">
    <title>{{ $post['title'] }}</title>
  </head>
  <body class="base-bg-color">
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-1"></div>
        <div class="post-view-title col-md-8 col-10">
          <div class="main-title" id="main-top-title">
            <img src="{{ asset('/i/main/title.png') }}" alt="survive in japan">
          </div>
          <img src="{{ '/' . \App\Consts\Image::READ_BASE_DIRECTORY . $post['thumb_path']}}">
          <h1>{{ $post['title'] }}</h1>
        </div>
        <div class="col-md-2 col-1"></div>
      </div>

      <!-- 목차 -->
      <div class="row">
        <div class="col-md-2 col-1"></div>
        <div class="post-view-toc col-md-8 col-10" id="toc">
          <div>Index</div>
        </div>
        <div class="col-md-2 col-1"></div>
      </div>

      <div class="row">
        <div class="col-md-2 col-1"></div>
        <div class="post-view-content col-md-8 col-10" id="post-view-content">
          {!! $post['content'] !!}
        </div>
        <div class="col-md-2 col-1"></div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="{{ asset('js/pages/app.js') }}"></script>
  </body>
</html>