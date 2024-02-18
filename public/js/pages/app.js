/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/pages/main.js ***!
  \************************************/
$(document).ready(function () {
  ClickTopLogo();
  ToggleSmallMenu();
  ClickContentCard();
});
function ClickTopLogo() {
  $('.main-top-title').on('click', function () {
    window.location.href = "/";
  });
}

// 햄버거 메뉴 클릭
function ToggleSmallMenu() {
  $('.small-menu').on('click', function () {
    // active 클래스 토글
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $(this).find('span:nth-of-type(4)').text('CLOSE');
    } else {
      $(this).find('span:nth-of-type(4)').text('MENU');
    }
  });
}

// 포스트 카드 클릭
function ClickContentCard() {
  // 동적으로 생성된 요소에 클릭 이벤트 바인딩
  $("#content-card-box").on("click", ".main-middle-content", function () {
    var postId = $(this).data("post-id");
    window.location.href = "/post_view/" + postId;
  });
}
/******/ })()
;