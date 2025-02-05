/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!************************************!*\
  !*** ./resources/js/pages/main.js ***!
  \************************************/
$(document).ready(function () {
  ClickTopLogo();
  ToggleSmallMenu();
  ClickContentCard();
  ToggleSmallCategoryDropIcon();
  ClickCategoryContent();
  FixMenuBar();
  ClickTopScrollBtn();
});
var BASE_URL = "/blog";
function Redirect(url) {
  window.location.href = BASE_URL.url;
}
function ClickTopLogo() {
  $('#main-top-title').on('click', function () {
    Redirect("/");
  });
  $('#main-top-small-fixed-bar-title').on('click', function () {
    Redirect("/");
  });
}

// 햄버거 메뉴 클릭
function ToggleSmallMenu() {
  $('.small-menu').on('click', function () {
    // active 클래스 토글
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $(this).find('span:nth-of-type(4)').text('CLOSE');
      $('.category-modal').addClass('active');
    } else {
      $(this).find('span:nth-of-type(4)').text('MENU');
      $('.category-modal').removeClass('active');
    }
  });
}

// 모달 안의 카테고리 클릭
function ToggleSmallCategoryDropIcon() {
  $('.category-modal-category-head').on('click', function () {
    var icon = $(this).find('.category-modal-category-head-drop-icon');
    icon.toggleClass('active');
    if (icon.hasClass('active')) {
      $(this).parent().find('.category-modal-category-body').slideDown(400);
    } else {
      $(this).parent().find('.category-modal-category-body').slideUp(400);
    }
  });
}

// 포스트 카드 클릭
function ClickContentCard() {
  // 동적으로 생성된 요소에 클릭 이벤트 바인딩
  $(".main-middle-contents-box").on("click", ".main-middle-content", function () {
    var postId = $(this).data("post-id");
    Redirect("/post_view/" + postId);
  });
  $(".main-middle-contents-box").on("click", ".main-middle-small-content", function () {
    var postId = $(this).data("post-id");
    Redirect("/post_view/" + postId);
  });
}

// 카테고리 클릭
function ClickCategoryContent() {
  $(".category-content").on("click", function () {
    var categoryId = $(this).data("category-id");
    if (typeof categoryId == "undefined" || categoryId == null || categoryId == "") {
      Redirect("/");
      return;
    }
    Redirect("/category/" + categoryId);
  });
}

// 상단 메뉴 고정
function FixMenuBar() {
  $(window).scroll(function () {
    // 스크롤 위치가 상단 메뉴보다 아래에 있으면 고정용 상단 메뉴를 표시
    if ($(window).scrollTop() >= $(".main-top-title").height()) {
      $(".main-top-small-fixed-bar").slideDown(400);
    } else {
      $(".main-top-small-fixed-bar").hide();
    }
  });
}

// 스크롤을 위로 보내는 버튼
function ClickTopScrollBtn() {
  $(".top-scroll-btn").on('click', function () {
    $("html, body").scrollTop(0);
  });
}
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!************************************!*\
  !*** ./resources/js/pages/post.js ***!
  \************************************/
$(document).ready(function () {
  CreateToc();
});

// 헤딩 태그로 목차 생성
function CreateToc() {
  var tocElement = $('#toc');

  // 초기값 설정
  var olElement = $('<ol></ol>');
  tocElement.append(olElement);
  var prevLevel = 0;
  var sectionId = 0;
  $("#post-view-content").find('h1, h2, h3').each(function () {
    // 헤딩 레벨 가져오기 (h1: 1, h2: 2, h3: 3) (10진수)
    var level = parseInt(this.tagName.substring(1), 10);
    sectionId++;

    // 해당 해딩 태그에 id를 부여
    $(this).attr('id', 'section' + sectionId);

    // li태그 생성
    var liElement = $('<li><a href="#section' + sectionId + '">' + $(this).text() + '</a></li>');
    liElement.attr('data-section-id');

    // 현재 레벨와 이전 레벨 비교
    if (level > prevLevel) {
      // 이전 레벨의 하위로 추가
      var newOlElement = $('<ol></ol>');
      olElement.append(newOlElement);
      olElement = newOlElement;
    } else if (level < prevLevel) {
      // 헤딩 레벨에 맞는 ol태그로 돌아가기
      for (var i = level; i < prevLevel; i++) {
        olElement = olElement.parent();
      }
    }

    // li태그 추가
    olElement.append(liElement);
    // 이전 레벨 갱신
    prevLevel = level;
  });
}
})();

/******/ })()
;