var btn = document.querySelector('#show-ho-hide');
var divLogin = document.querySelector('#login');
var divRegister = document.querySelector('#register');

btn.addEventListener('click', function() {
    if (divLogin.style.display == 'flex') {
        divLogin.style.display = 'none';
        divRegister.style.display = 'flex';
    } else {
        divLogin.style.display = 'flex';
        divRegister.style.display = 'none';
    }
});
    