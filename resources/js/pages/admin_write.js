$(document).ready(function() {
    // 프리뷰 영역 숨기기
    $("#content-preview-box").hide();

    // Preview 클릭시 작성 프리뷰 영역을 표시하고 작성중인 글을 렌더링함
    $("#content-preview-btn").on("click", function() {
        $("#content-preview-box").html($("#content").val());
        $("#content").hide();
        $("#content-preview-box").show();
    });

    // Edit 클릭시 텍스트 에리어를 표시함
    $("#content-edit-btn").on("click", function() {
        $("#content-preview-box").hide();
        $("#content").show();
    });

    // 이미지 추가 버튼 클릭시 컨텐츠에 이미지 태그 추가
    $("#add-img-tab-btn").on("click", function() {
        var imagePath = $("#target-image").data("image-path");
        var imageTag = "<img src='" + imagePath + "' alt=''>";
        $("#content").val($("#content").val() + imageTag);
    });

    // 이미지 저장 리퀘스트
    $("#upload-img-btn").on("click", function() {
        // 이미지 파일 가져오기
        var imageFile = $("#image-input")[0].files[0];
        var postId = $("#post-id").val();

        // FormData 객체 생성 및 이미지 추가
        var formData = new FormData();
        formData.append('id', postId);
        formData.append('image', imageFile);

        // CSRF 토큰 가져오기
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (imageFile == null) {
            alert("追加する画像を選択して！");
        }

        // Ajax 요청 보내기
        $.ajax({
            url: '/admin_post_image_upload',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $("#img-box").append(makeImgHtml(response.path));
            },
            error: function(error) {
                console.error('Error saving image:', error);
            }
        });
    });

    // 썸네일 저장 리퀘스트
    $("#upload-thumb-btn").on("click", function() {
        // 이미지 파일 가져오기
        var imageFile = $("#thumb-input")[0].files[0];
        var postId = $("#post-id").val();

        // FormData 객체 생성 및 이미지 추가
        var formData = new FormData();
        formData.append('id', postId);
        formData.append('image', imageFile);

        // CSRF 토큰 가져오기
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (imageFile == null) {
            alert("追加する画像を選択して！");
        }

        // Ajax 요청 보내기
        $.ajax({
            url: '/admin_post_thumb_upload',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $("#thumb-box").html(makeThumbHtml(response.path));
            },
            error: function(error) {
                console.error('Error saving thumb:', error);
            }
        });
    });

    // 컨텐츠 에리어에서 포커스를 잃었을때 포스트를 저장함
    $("#content").blur(function() {
        var content = $(this).val();
        var title = $("#title").val();
        var postId = $("#post-id").val();
        
        var formData = new FormData();
        formData.append('id', postId);
        formData.append('title', title);
        formData.append('content', content);

        // CSRF 토큰 가져오기
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Ajax 요청 보내기
        $.ajax({
            url: '/admin_post_auto_edit_exec',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
            },
            error: function(error) {
                console.error(error);
            }
        });
    });

    // 공개 실행
    $("#edit-exec-btn").on("click", function() {
        var formMap = getForm();

        if (formMap.get('category_id') == '') {
            alert("カテゴリーを選択してないじゃん！！");
            return false;
        }

        if (formMap.get('title') == '') {
            alert("タイトルを入力してないじゃん！！");
            return false;
        }

        if (formMap.get('content') == '') {
            alert("内容を入力してないじゃん！！");
            return false;
        }

        var formData = new FormData();
        formMap.forEach((value, key) => {
            formData.append(key, value);
        });

        // CSRF 토큰 가져오기
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Ajax 요청 보내기
        $.ajax({
            url: '/admin_post_edit_exec',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                alert("公開したよ！");
            },
            error: function(error) {
                console.error(error);
                alert("公開失敗…");
            }
        });
    });

    // 보관 실행
    $("#store-exec-btn").on("click", function() {
        var formMap = getForm();

        var formData = new FormData();
        formMap.forEach((value, key) => {
            formData.append(key, value);
        });

        // CSRF 토큰 가져오기
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Ajax 요청 보내기
        $.ajax({
            url: '/admin_post_store_exec',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                alert("保管したよ！");
            },
            error: function(error) {
                console.error(error);
                alert("保管失敗…");
            }
        });
    });
});

// 동적으로 생성된 요소에 클릭 이벤트 바인딩
$("#img-box").on("click", ".img-thumbnail", function() {
    // 다른 img-thumbnail 요소들의 클래스, ID를 삭제
    $(".img-thumbnail").not(this).removeClass("border border-primary border-3").removeAttr("id");
    // 현재 클릭한 img-thumbnail 요소에 클래스, ID를 추가 또는 제거
    $(this).toggleClass("border border-primary border-3");
    
    // ID가 없는 경우에만 ID 설정
    if (!$(this).attr("id")) {
        $(this).attr("id", "target-image");
    }
});

function getForm() {
    var categoryId = '';
    // 활성화 된 탭에서 카테고리ID를 취득
    if ($('#japanese').hasClass('active')) {
        categoryId = $("#jp-category-id").val();
    }
    if ($('#korean').hasClass('active')) {
        categoryId = $("#kr-category-id").val();
    }
    // 그래도 카테고리ID가 없다면 기존 카테고리ID 취득
    if (categoryId == '') {
        var jpCategoryId = $("#jp-category-id").val();
        var krCategoryId = $("#kr-category-id").val();
        categoryId = jpCategoryId == '' ? krCategoryId : krCategoryId;
    }

    var title = $("#title").val();
    var content = $("#content").val();
    var postId = $("#post-id").val();
    
    var map = new Map();
    map.set('id', postId);
    map.set('category_id', categoryId);
    map.set('title', title);
    map.set('content', content);

    return map;
}

function makeImgHtml(imagePath) {
    var html =
        "<div class='col-sm-6 col-md-3'>" +
            "<a><img src='" + imagePath + "' class='img-thumbnail' data-image-path='" + imagePath + "' alt=''></a>" +
        "</div>";
    return html;
};

function makeThumbHtml(imagePath) {
    var html =
            "<img src='" + imagePath + " alt=''>";
    return html;
};
