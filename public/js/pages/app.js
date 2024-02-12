/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/pages/main.js ***!
  \************************************/
$(document).ready(function () {
  var burger = $('.small-menu');
  burger.each(function (index) {
    var $this = $(this);
    $this.on('click', function (e) {
      e.preventDefault();
      $(this).toggleClass('active-' + (index + 1));
    });
  });
});
/******/ })()
;