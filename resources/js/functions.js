
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

// MANAGE FUNCTION
window.initSort = function () {
    var minuses = document.getElementsByClassName('minus');
    var position = document.getElementsByClassName('position');
    var pluses = document.getElementsByClassName('plus');

    for (let i = 0; i < position.length; i++) {
        minuses[i].addEventListener('click', () => {
            let value = position[i].value;
            if (value > 0) {
                position[i].value = --value;
            }
        })

        pluses[i].addEventListener('click', () => {
            let value = position[i].value;
            position[i].value = ++value;
        })
    }
}
