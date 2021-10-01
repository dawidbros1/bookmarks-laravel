/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/pageEdit.js ***!
  \**********************************/
var category = document.getElementById('select-category');
var subcategoriesOption = document.getElementsByClassName('subcategory-option');
var defaultOption = document.getElementById('default');
category.addEventListener('change', function () {
  for (var i = 0; i < subcategoriesOption.length; i++) {
    var so = subcategoriesOption[i];
    if (parseInt(so.dataset.categoryId) == this.value) so.classList.remove('hidden');else so.classList.add('hidden');
  }

  defaultOption.selected = "selected";
});
/******/ })()
;