
window.pasteImg = function (name) {
    image_url_wrapper = document.getElementById('image_url');
    image_url_wrapper.value = name;
}

window.copyToClipBoard = function (index) {
    let copyText = document.getElementsByClassName("copy")[index];
    copyText.select();
    navigator.clipboard.writeText(copyText.value);
}
