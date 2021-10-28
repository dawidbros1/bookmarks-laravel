/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/functions.js ***!
  \***********************************/
window.pasteImg = function (name) {
  var image_url_wrapper = document.getElementById('image_url');
  image_url_wrapper.value = name;
};

window.copyToClipBoard = function (index) {
  var copyText = document.getElementsByClassName("copy")[index];
  copyText.select();
  navigator.clipboard.writeText(copyText.value);
}; // Zaznaczania i Odznaczanie checkbox'ów na stornie zarządzania


window.initCheckboxButton = function (name) {
  var checkboxButton = document.getElementById(name + 'CheckboxButton');
  var checkboxItems = document.getElementsByClassName(name + 'Checkbox');
  var status = false;
  var counter = 0;

  for (var i = 0; i < checkboxItems.length; i++) {
    if (checkboxItems[i].checked == true) counter++;
  }

  if (checkboxItems.length == counter) {
    status = true;
    checkboxButton.checked = true;
  }

  checkboxButton.addEventListener('click', function () {
    status = !status;

    for (var i = 0; i < checkboxItems.length; i++) {
      checkboxItems[i].checked = status;
    }
  });
}; // MANAGE FUNCTION


window.initOrder = function () {
  var minuses = document.getElementsByClassName('minus');
  var orders = document.getElementsByClassName('order');
  var pluses = document.getElementsByClassName('plus');

  var _loop = function _loop(i) {
    minuses[i].addEventListener('click', function () {
      var value = orders[i].value;

      if (value > 0) {
        orders[i].value = --value;
      }
    });
    pluses[i].addEventListener('click', function () {
      var value = orders[i].value;
      orders[i].value = ++value;
    });
  };

  for (var i = 0; i < orders.length; i++) {
    _loop(i);
  }
};
/******/ })()
;