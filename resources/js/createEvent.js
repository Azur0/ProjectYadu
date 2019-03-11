window.onload = function() {
    var textarea = document.getElementById('desc');
    var text = document.getElementById('title');
    var len_d = parseInt(textarea.getAttribute("maxlength"), 10);
    var len_t = parseInt(text.getAttribute("maxlength"), 10);
    document.getElementById('chars_desc').innerHTML = len_d - textarea.value.length;
    document.getElementById('chars_title').innerHTML = len_t - text.value.length;
}

function update_counter_title(text) {
    var len = parseInt(text.getAttribute("maxlength"), 10);
    document.getElementById('chars_title').innerHTML = len - text.value.length;
}

function update_counter_desc(textarea) {
    var len = parseInt(textarea.getAttribute("maxlength"), 10);
    document.getElementById('chars_desc').innerHTML = len - textarea.value.length;
}