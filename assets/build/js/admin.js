/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/sass/admin.scss":
/*!*****************************!*\
  !*** ./src/sass/admin.scss ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

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
/************************************************************************/
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
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*************************!*\
  !*** ./src/js/admin.js ***!
  \*************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _sass_admin_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../sass/admin.scss */ "./src/sass/admin.scss");
// Styles

jQuery(document).ready(function ($) {
  $('body').on('click', '.wpbi-image-upload-btn', function (e) {
    e.preventDefault();
    var that = $(this);
    var image = wp.media({
      title: 'Upload Image',
      multiple: false
    }).open().on('select', function (e) {
      var uploaded_image = image.state().get('selection').first();
      var uploaded_url = uploaded_image.toJSON().url;
      uploaded_image = uploaded_image.toJSON().id;
      $(that).parent().find('.product_banner_bg_image').val(uploaded_image);
      $(that).parent().find('.wpbi-image-container').html('<img width="400" src="' + uploaded_url + '" ><span class="wpbi-image-remove">X</span>');
    });
  });
  $('body').on('click', '.wpbi-image-remove', function (e) {
    var that = $(this);
    $(that).parent().parent().find('.product_banner_bg_image').val('');
    $(that).parent().parent().find('.wpbi-image-container').html('');
  });
});
})();

/******/ })()
;
//# sourceMappingURL=admin.js.map