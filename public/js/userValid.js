function validateForm () {

    var password1 = document.getElementById('userPassword1');
    var password2 = document.getElementById('userPassword2');
    if (password1.value !== password2.value) {
        alert('Паролі не співпадають');
        return false; 
    }
    // проверяем email
    var email = document.getElementById('userEmail');
    var email_regexp = /[0-9a-zа-я_A-ZА-Я]+@[0-9a-zа-я_A-ZА-Я^.]+\.[a-zа-яА-ЯA-Z]{2,4}/i;
    if (!email_regexp.test(email.value)) {
        alert('Некоректний email');
        return false;
    }
}