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
    @foreach($categoryList as $category)
      <div class="main-top-category-btn btn-group">
        <button class="btn btn-secondary btn-md dropdown-toggle bg-white text-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ $category['name'] }}
        </button>
        @foreach($category['children'] as $childCategories)
          <ul class="dropdown-menu">{{ $childCategories['name'] }}</ul>
        @endforeach
      </div>
    @endforeach
  </div>
</div>