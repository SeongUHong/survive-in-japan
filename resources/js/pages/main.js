$(document).ready(function() {
    ClickTopLogo();
    ToggleSmallMenu();
    ClickContentCard();
});

function ClickTopLogo() {
    $('.main-top-title').on('click', function() {
        window.location.href = "/";
    });
}

// 햄버거 메뉴 클릭
function ToggleSmallMenu() {
    $('.small-menu').on('click', function() {
        // active 클래스 토글
        $(this).toggleClass('active');

        if ($(this).hasClass('active')) {
            $(this).find('span:nth-of-type(4)').text('CLOSE');
            $('.category-modal').slideDown(400);
        } else {
            $(this).find('span:nth-of-type(4)').text('MENU');
            $('.category-modal').slideUp(400);
        }
    });
}

// 포스트 카드 클릭
function ClickContentCard() {
    // 동적으로 생성된 요소에 클릭 이벤트 바인딩
    $(".main-middle-contents-box").on("click", ".main-middle-content", function() {
        var postId = $(this).data("post-id");
        window.location.href = "/post_view/" + postId;
    });

    $(".main-middle-contents-box").on("click", ".main-middle-small-content", function() {
        var postId = $(this).data("post-id");
        window.location.href = "/post_view/" + postId;
    });
}

