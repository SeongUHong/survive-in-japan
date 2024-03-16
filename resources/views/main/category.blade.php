<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/pages/main.css') }}">
    <title>TOP</title>
  </head>
  <body class="base-bg-color">
    <!-- 상단 -->
    @include('main/_sub/header')
    <!-- 메인 컨텐츠 -->
    <div class="main-middle container">
      <div class="main-middle-contents-box row">
        <!-- 컨텐츠 -->
        <div class="main-middle-contents-box-category col">
            @foreach($postList as $post)
              <div>
                @include('main/_sub/content_card', ['post' => $post])
              </div>
            @endforeach
        </div>

        <!-- 컨텐츠 작은 화면 -->
        <div class="main-middle-contents-box-all col-12">
          @foreach($postList as $post)
            @include('main/_sub/small_content_card', ['post' => $post])
          @endforeach
        </div>
      </div>
    </div>
    <div class="main-bottom-fixed">
      <div class="main-bottom-fixed-left">
      </div>
      <div class="main-bottom-fixed-right">
        <button class="top-scroll-btn"></button>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="{{ asset('js/pages/app.js') }}"></script>
  </body>
</html>