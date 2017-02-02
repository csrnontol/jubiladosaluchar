/**
 * Created by CYNR on 29/12/2016.
 */
var insertItemProcessingGif = document.querySelector(".insert-item--processing-gif");
$(document).ready(function () {
    var divbtnSubmitUsuario = document.getElementById("divbtn-submit-usuario");
    $(divbtnSubmitUsuario).on('click', function() {
        $(insertItemProcessingGif).fadeIn();
        var timer;
        clearTimeout(timer);
        timer = setTimeout(function () {
            validateSubmitNewUser();
        }, 800);
    });

    $(document).on('focusout', '#in-user-username, #in-user-email', function () {
        var rxEmail = /^[A-Za-z][A-Za-z0-9._-]*@[A-Za-z0-9_-]+\.[A-Za-z0-9_.]+[A-za-z]$/;
        var rxUsername = /^[a-zA-ZÀ-ú0-9 ]{2,20}$/;
        var elemValue = this.value, that = this;
        var doFlag = 0, requestMode, errmsg;
        if (this.id === 'in-user-username') {
            if (rxUsername.test(elemValue)) {
                requestMode = 'username';
                errmsg = 'usuario';
                doFlag = 1;
            }
        } else if (this.id === 'in-user-email') {
            if (rxEmail.test(elemValue)) {
                requestMode = 'email';
                errmsg = 'e-mail';
                doFlag = 1;
            }
        }
        if (doFlag) {
            $.post('../adminlogin/data/validateAdminUniqFields.php', {field: requestMode, value: elemValue})
                .done(function (data) {
                    that.setAttribute('data-unique', data);
                    var fieldId = that.id.split('-')[2];
                    var errElement = document.getElementById("error-"+fieldId);
                    /*check if request finds conflict*/
                    if (that.getAttribute('data-unique') === 'false') {
                        errElement.innerHTML = '<span>El '+errmsg+' ya está en uso.</span>';
                    }
                });
        }
    });

    /*dinamically hide input errors*/
    var formElements = document.getElementById("frm-nuevo-usuario").elements;
    $(formElements).on('input change', function() {
        if (this.type != 'checkbox') {
            var fieldId = this.id.split('-')[2];
            var errElement = document.getElementById("error-"+fieldId).querySelector("span");
            $(errElement).fadeOut();
        }
    });
});


function validateSubmitNewUser() {
    /* form elements */
    var inUserName = document.getElementById("in-user-name");
    var inUserUsername = document.getElementById("in-user-username");
    var inUserEmail = document.getElementById("in-user-email");
    var inUserPassword = document.getElementById("in-user-password");
    var inUserRepassword = document.getElementById("in-user-repassword");

    /* elements for tests */
    var dataUserName = inUserName.value.trim();
    var dataUserUsername = inUserUsername.value.trim();
    var dataUserEmail = inUserEmail.value.trim();
    var dataUserPassword = inUserPassword.value.trim();
    var dataUserRepassword = inUserRepassword.value.trim();

    /* elements for errors */
    var errorUserName = document.getElementById("error-name");
    var errorUserUsername = document.getElementById("error-username");
    var errorUserEmail = document.getElementById("error-email");
    var errorUserPassword = document.getElementById("error-password");
    var errorUserRepassword = document.getElementById("error-repassword");

    /* clearing error messages */
    errorUserName.innerHTML = '';
    if (inUserUsername.getAttribute('data-unique') === 'true') errorUserUsername.innerHTML = '';
    if (inUserEmail.getAttribute('data-unique') === 'true') errorUserEmail.innerHTML = '';
    errorUserPassword.innerHTML = '';
    errorUserRepassword.innerHTML = '';

    var errors = [], cont = 0;
    var rxEmail = /^[A-Za-z][A-Za-z0-9._-]*@[A-Za-z0-9_-]+\.[A-Za-z0-9_.]+[A-za-z]$/;
    var rxNames = /^[a-zA-ZÀ-ú ]{4,40}$/;
    var rxUsername = /^[a-zA-ZÀ-ú0-9 ]{2,20}$/;

    errors[0] = '<span>Ingresar un valor.</span>';
    errors[1] = '<span>Ingresar un valor válido.</span>';
    errors[2] = '<span>Ingresar mínimo 6 cacarteres.</span>';
    errors[3] = '<span>Las contraseñas no coinciden.</span>';

    /*validate user-name*/
    if (dataUserName === '') {
        cont++;
        errorUserName.innerHTML = errors[0];
        if (cont == 1) inUserName.focus();
    } else if (!rxNames.test(dataUserName)) {
        cont++;
        errorUserName.innerHTML = errors[1];
        if (cont == 1) inUserName.focus();
    }
    /*validate user-username*/
    if (dataUserUsername === '') {
        cont++;
        errorUserUsername.innerHTML = errors[0];
        if (cont == 1) inUserUsername.focus();
    } else if (!rxUsername.test(dataUserUsername)) {
        cont++;
        errorUserUsername.innerHTML = errors[1];
        if (cont == 1) inUserUsername.focus();
    } else if (inUserUsername.getAttribute('data-unique') === 'false') { /*validate usuario unique field*/
        cont++;
        if (cont == 1) inUserUsername.focus();
    }
    /*validate user-email*/
    if (dataUserEmail === '') {
        cont++;
        errorUserEmail.innerHTML = errors[0];
        if (cont == 1) inUserEmail.focus();
    } else if (!rxEmail.test(dataUserEmail)) {
        cont++;
        errorUserEmail.innerHTML = errors[1];
        if (cont == 1) inUserEmail.focus();
    } else if (inUserEmail.getAttribute('data-unique') === 'false') { /*validate email unique field*/
        cont++;
        if (cont == 1) inUserEmail.focus();
    }
    /*validate user-password*/
    if (dataUserPassword === '') {
        cont++;
        errorUserPassword.innerHTML = errors[0];
        if (cont == 1) inUserPassword.focus();
    } else if (dataUserPassword.length < 6) {
        cont++;
        errorUserPassword.innerHTML = errors[2];
        if (cont == 1) inUserPassword.focus();
    }
    /*validate user-repassword*/
    if (dataUserRepassword === '') {
        cont++;
        errorUserRepassword.innerHTML = errors[0];
        if (cont == 1) inUserRepassword.focus();
    } else if (dataUserRepassword != dataUserPassword) {
        cont++;
        errorUserRepassword.innerHTML = errors[3];
        if (cont == 1) inUserRepassword.focus();
    }

    /*perform main query*/
    if (cont > 0) {
        $(insertItemProcessingGif).fadeOut();
        return false;
    } else {
        var formNuevoUsuario = document.getElementById("frm-nuevo-usuario");
        formNuevoUsuario.submit();
    }
}