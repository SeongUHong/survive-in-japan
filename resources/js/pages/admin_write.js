$(document).ready(function() {
    $(".img-thumbnail").on("click", function() {
        // 다른 img-thumbnail 요소들의 클래스를 삭제
        $(".img-thumbnail").not(this).removeClass("border border-primary border-3");
        // 현재 클릭한 img-thumbnail 요소에 클래스를 추가 또는 제거
        $(this).toggleClass("border border-primary border-3");
    });
});