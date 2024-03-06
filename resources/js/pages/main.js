$(document).ready(function() {
    ClickTopLogo();
    ToggleSmallMenu();
    ClickContentCard();
    ToggleSmallCategoryDropIcon();
    ClickCategoryContent();
});

function ClickTopLogo() {
    $('#main-top-title').on('click', function() {
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
            $('.category-modal').addClass('active');
        } else {
            $(this).find('span:nth-of-type(4)').text('MENU');
            $('.category-modal').removeClass('active');
        }
    });
}

// 모달 안의 카테고리 클릭
function ToggleSmallCategoryDropIcon() {
    $('.category-modal-category-head').on('click', function() {
        var icon = $(this).find('.category-modal-category-head-drop-icon');
        icon.toggleClass('active');

        if(icon.hasClass('active')) {
            $(this).parent().find('.category-modal-category-body').slideDown();
        } else {
            $(this).parent().find('.category-modal-category-body').slideUp();
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

// 카테고리 클릭
function ClickCategoryContent() {
    $(".category-modal").on("click", ".category-content", function() {
        var categoryId = $(this).data("category-id");
        window.location.href = "/";
    });
}

