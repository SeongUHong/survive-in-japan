$(document).ready(function() {
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

    $("#post-view-content").find('h1, h2, h3').each(function() {
        // 헤딩 레벨 가져오기 (h1: 1, h2: 2, h3: 3) (10진수)
        var level = parseInt(this.tagName.substring(1), 10);
        sectionId++;

        // 해당 해딩 태그에 id를 부여
        $(this).attr('id', 'section' + sectionId);

        // li태그 생성
        var liElement = $('<li><a href="#section' + sectionId + '">' + $(this).text() + '</a></li>');
        liElement.attr('data-section-id')

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
