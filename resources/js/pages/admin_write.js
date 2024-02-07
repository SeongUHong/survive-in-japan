$(document).ready(function() {
    // 이미지 추가 버튼 클릭시 컨텐츠에 이미지 태그 추가
    $("#add_img_tab_btn").on("click", function() {
        var imagePath = $("#target_image").data("image-path");
        var imageTag = "<img src='{{ asset(" + imagePath + ") }}' alt=''>";
        $("#content").val($("#content").val() + imageTag);
    });

    // 이미지 저장 리퀘스트
    $("#upload_img_btn").on("click", function() {
        // 이미지 파일 가져오기
        var imageFile = $("#image_input")[0].files[0];
        var postId = $("#post_id").val();

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
                $("#img_box").append(makeImgHtml(response.path));
            },
            error: function(error) {
                console.error('Error saving image:', error);
            }
        });
    });
});

// 동적으로 생성된 요소에 클릭 이벤트 바인딩
$("#img_box").on("click", ".img-thumbnail", function() {
    // 다른 img-thumbnail 요소들의 클래스, ID를 삭제
    $(".img-thumbnail").not(this).removeClass("border border-primary border-3").removeAttr("id");
    // 현재 클릭한 img-thumbnail 요소에 클래스, ID를 추가 또는 제거
    $(this).toggleClass("border border-primary border-3");
    
    // ID가 없는 경우에만 ID 설정
    if (!$(this).attr("id")) {
        $(this).attr("id", "target_image");
    }
});

function makeImgHtml(imagePath) {
    var html =
        "<div class='col-sm-6 col-md-3'>" +
            "<a><img src='" + imagePath + "' class='img-thumbnail' data-image-path='" + imagePath + "' alt=''></a>" +
        "</div>";
    return html;
};