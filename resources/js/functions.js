
window.pasteImg = function (name) {
    let image_url_wrapper = document.getElementById('image_url');
    image_url_wrapper.value = name;
}

window.copyToClipBoard = function (index) {
    let copyText = document.getElementsByClassName("copy")[index];
    copyText.select();
    navigator.clipboard.writeText(copyText.value);
}

// Zaznaczania i Odznaczanie checkbox'ów na stornie zarządzania
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
    })
}
