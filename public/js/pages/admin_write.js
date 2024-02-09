/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/pages/admin_write.js":
/*!*******************************************!*\
  !*** ./resources/js/pages/admin_write.js ***!
  \*******************************************/
/***/ (() => {

$(document).ready(function () {
  // 프리뷰 영역 숨기기
  $("#content-preview-box").hide();

  // Preview 클릭시 작성 프리뷰 영역을 표시하고 작성중인 글을 렌더링함
  $("#content-preview-btn").on("click", function () {
    $("#content-preview-box").html($("#content").val());
    $("#content").hide();
    $("#content-preview-box").show();
  });

  // Edit 클릭시 텍스트 에리어를 표시함
  $("#content-edit-btn").on("click", function () {
    $("#content-preview-box").hide();
    $("#content").show();
  });

  // 이미지 추가 버튼 클릭시 컨텐츠에 이미지 태그 추가
  $("#add-img-tab-btn").on("click", function () {
    var imagePath = $("#target-image").data("image-path");
    var imageTag = "<img src='" + imagePath + "' alt=''>";
    $("#content").val($("#content").val() + imageTag);
  });

  // 이미지 저장 리퀘스트
  $("#upload-img-btn").on("click", function () {
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
      success: function success(response) {
        $("#img-box").append(makeImgHtml(response.path));
      },
      error: function error(_error) {
        console.error('Error saving image:', _error);
      }
    });
  });

  // 컨텐츠 에리어에서 포커스를 잃었을때 포스트를 저장함
  $("#content").blur(function () {
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
      success: function success(response) {},
      error: function error(_error2) {
        console.error(_error2);
      }
    });
  });

  // 공개 실행
  $("#edit-exec-btn").on("click", function () {
    var jpCategoryId = $("#jp-category-id").val();
    var krCategoryId = $("#kr-category-id").val();
    if (jpCategoryId == '' && krCategoryId == '') {
      alert("カテゴリーを選択してないじゃん！！");
      return false;
    }
    var title = $("#title").val();
    if (title == '') {
      alert("タイトルを入力してないじゃん！！");
      return false;
    }
    var content = $("#content").val();
    if (content == '') {
      alert("内容を入力してないじゃん！！");
      return false;
    }
    var categoryId = jpCategoryId ? jpCategoryId : krCategoryId;
    var postId = $("#post-id").val();
    var formData = new FormData();
    formData.append('id', postId);
    formData.append('title', title);
    formData.append('category_id', categoryId);
    formData.append('content', content);

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
      success: function success(response) {
        alert("公開したよ！");
      },
      error: function error(_error3) {
        console.error(_error3);
        alert("公開失敗…");
      }
    });
  });

  // 보관 실행
  $("#store-exec-btn").on("click", function () {
    var categoryId = '';
    if ($('#japanese').hasClass('active')) {
      categoryId = $("#jp-category-id").val();
    }
    if ($('#korean').hasClass('active')) {
      categoryId = $("#kr-category-id").val();
    }
    var title = $("#title").val();
    var content = $("#content").val();
    var postId = $("#post-id").val();
    var formData = new FormData();
    formData.append('id', postId);
    formData.append('title', title);
    formData.append('category_id', categoryId);
    formData.append('content', content);

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
      success: function success(response) {
        alert("保管したよ！");
      },
      error: function error(_error4) {
        console.error(_error4);
        alert("保管失敗…");
      }
    });
  });
});

// 동적으로 생성된 요소에 클릭 이벤트 바인딩
$("#img-box").on("click", ".img-thumbnail", function () {
  // 다른 img-thumbnail 요소들의 클래스, ID를 삭제
  $(".img-thumbnail").not(this).removeClass("border border-primary border-3").removeAttr("id");
  // 현재 클릭한 img-thumbnail 요소에 클래스, ID를 추가 또는 제거
  $(this).toggleClass("border border-primary border-3");

  // ID가 없는 경우에만 ID 설정
  if (!$(this).attr("id")) {
    $(this).attr("id", "target-image");
  }
});
function makeImgHtml(imagePath) {
  var html = "<div class='col-sm-6 col-md-3'>" + "<a><img src='" + imagePath + "' class='img-thumbnail' data-image-path='" + imagePath + "' alt=''></a>" + "</div>";
  return html;
}
;

/***/ }),

/***/ "./resources/sass/pages/main.scss":
/*!****************************************!*\
  !*** ./resources/sass/pages/main.scss ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/pages/admin_write": 0,
/******/ 			"css/pages/main": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/pages/main"], () => (__webpack_require__("./resources/js/pages/admin_write.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/pages/main"], () => (__webpack_require__("./resources/sass/pages/main.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;