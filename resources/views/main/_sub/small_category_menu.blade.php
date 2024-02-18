<!-- 햄버거 메뉴 -->
<a class="small-menu">
    <span></span>
    <span></span>
    <span></span>
    <span>MENU</span>
</a>

<!-- 카테고리 모달 -->
<div class="category-modal">
    @foreach($categoryList as $category)
      <div>
        {{ $category['name'] }}
        @foreach($category['children'] as $childCategories)
          <ul class="dropdown-menu">{{ $childCategories['name'] }}</ul>
        @endforeach
      </div>
    @endforeach
</div>