<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/main/app.min.css') }}">
    <title>TOP</title>
  </head>
  <body class="base-bg-color">
    <!-- 상단 -->
    @include('main/_sub/header')
    <!-- 메인 컨텐츠 -->
    <div class="main-middle container">
      <div class="main-middle-contents-box row">
        <!-- 일본어 컨텐츠 -->
        <div class="main-middle-contents-box-japanese col-12 col-md-6">
          @foreach($postList as $childCategories)
            @include('main/_sub/content_card', [''])
          @endforeach
        </div>
        <!-- 한국어 컨텐츠 -->
        <div class="main-middle-contents-box-korean col-12 col-md-6">
          @include('main/_sub/content_card')
          @include('main/_sub/content_card')
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>