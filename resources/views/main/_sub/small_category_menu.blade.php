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
      <div class="category-modal-category">
        <div class="category-modal-category-head">
          <div class="category-modal-category-head-name">
            {{ $category['name'] }}
          </div>
          <div class="category-modal-category-head-drop">
            <span class="category-modal-category-head-drop-icon"></span>
          </div>
        </div>
        <div class="category-modal-category-body">
          @foreach($category['children'] as $childCategory)
            <span class="category-content" data-category-id="{{ $childCategory['id'] }}">{{ $childCategory['name'] }}</span>
          @endforeach
        </div>
      </div>
    @endforeach
</div>