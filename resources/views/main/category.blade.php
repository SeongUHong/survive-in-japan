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
    <div class="main-top container">
      <div class="main-top-title">
        <a href="/">
          <img src="{{ asset('/storage/i/main/title.png') }}" class="img-fluid" alt="survive in japan">
        </a>
      </div>
      <div class="main-top-bg">
        <a href="/">
          <img src="{{ asset('/storage/i/main/top_bg.png') }}" class="img-fluid" alt="survive in japan">
        </a>
      </div>
      <div class="main-top-category">
        <div class="main-top-category-btn btn-group">
          <button class="btn btn-secondary btn-md dropdown-toggle bg-white text-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            한국어 카테고리
          </button>
          <ul class="dropdown-menu">여행</ul>
          <ul class="dropdown-menu">음식</ul>
        </div>
        <div class="main-top-category-btn btn-group">
          <button class="btn btn-secondary btn-md dropdown-toggle bg-white text-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            日本語カテゴリー
          </button>
          <ul class="dropdown-menu">旅行</ul>
          <ul class="dropdown-menu">料理</ul>
        </div>
        <div class="main-top-category-name">
          <h1>旅行</h1>
          <hr class="main-top-category-name-line">
        </div>
      </div>
    </div>
      <!-- 메인 컨텐츠 -->
    <div class="main-middle container">
      <div class="main-middle-contents-box row">
        <!-- 일본어 컨텐츠 -->
        <div class="main-middle-contents-box-common col-12 col-md-6">
          @include('main/_sub/content_card')
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>