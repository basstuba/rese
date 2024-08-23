const textarea = document.querySelector('.comment-area');

const string_count = document.querySelector('.string-count');

textarea.addEventListener('keyup', onKeyUp);

function onKeyUp() {
    var inputText = textarea.value;

    string_count.innerText = inputText.length;
}