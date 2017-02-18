/**
 * Created by CYNR on 05/02/2017.
 */
var insertItemProcessingGif = document.querySelector(".insert-item--processing-gif");
$(document).ready(function () {
    var formNuevoUsuario = document.getElementById("frm-nuevo-usuario");
    $(formNuevoUsuario).on('submit', function() {
        $(insertItemProcessingGif).fadeIn();
        return validateSubmitNewUser();
    });

    $(document).on('focusout', '#in-user-username, #in-user-email', function () {
        var rxEmail = /^[A-Za-z][A-Za-z0-9._-]*@[A-Za-z0-9_-]+\.[A-Za-z0-9_.]+[A-za-z]$/;
        var rxUsername = /^[a-zA-ZÀ-ú0-9]{2,15}$/;
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
            $.post('../userlogin/data/validateUserUniqFields.php', {table: 'user', field: requestMode, value: elemValue})
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
    var inUserSurname = document.getElementById("in-user-surname");
    var inUserEmail = document.getElementById("in-user-email");
    var inUserUsername = document.getElementById("in-user-username");
    var inUserPassword = document.getElementById("in-user-password");
    var inUserRepassword = document.getElementById("in-user-repassword");

    /* elements for tests */
    var dataUserName = inUserName.value.trim();
    var dataUserSurname = inUserSurname.value.trim();
    var dataUserEmail = inUserEmail.value.trim();
    var dataUserUsername = inUserUsername.value.trim();
    var dataUserPassword = inUserPassword.value.trim();
    var dataUserRepassword = inUserRepassword.value.trim();

    /* elements for errors */
    var errorUserName = document.getElementById("error-name");
    var errorUserSurname = document.getElementById("error-surname");
    var errorUserEmail = document.getElementById("error-email");
    var errorUserUsername = document.getElementById("error-username");
    var errorUserPassword = document.getElementById("error-password");
    var errorUserRepassword = document.getElementById("error-repassword");

    /* clearing error messages */
    errorUserName.innerHTML = '';
    errorUserSurname.innerHTML = '';
    if (inUserEmail.getAttribute('data-unique') === 'true') errorUserEmail.innerHTML = '';
    if (inUserUsername.getAttribute('data-unique') === 'true') errorUserUsername.innerHTML = '';
    errorUserPassword.innerHTML = '';
    errorUserRepassword.innerHTML = '';

    var cont = 0;
    var rxEmail = /^[A-Za-z][A-Za-z0-9._-]*@[A-Za-z0-9_-]+\.[A-Za-z0-9_.]+[A-za-z]$/;
    var rxNames = /^[a-zA-ZÀ-ú ]{3,40}$/;
    var rxUsername = /^[a-zA-ZÀ-ú0-9]{2,15}$/;

    /*validate user-name*/
    if (dataUserName === '') {
        cont++;
        errorUserName.innerHTML = '<span>Nombre es requerido.</span>';
        if (cont == 1) inUserName.focus();
    } else if (!rxNames.test(dataUserName)) {
        cont++;
        errorUserName.innerHTML = '<span>Sólo letras y espacios en un mínimo de tres.</span>';
        if (cont == 1) inUserName.focus();
    }
    /*validate user-surname*/
    if (dataUserSurname === '') {
        cont++;
        errorUserSurname.innerHTML = '<span>Apellido es requerido.</span>';
        if (cont == 1) inUserSurname.focus();
    } else if (!rxNames.test(dataUserSurname)) {
        cont++;
        errorUserSurname.innerHTML = '<span>Sólo letras y espacios en un mínimo de tres.</span>';
        if (cont == 1) inUserSurname.focus();
    }
    /*validate user-email*/
    if (dataUserEmail === '') {
        cont++;
        errorUserEmail.innerHTML = '<span>E-mail es requerido.</span>';
        if (cont == 1) inUserEmail.focus();
    } else if (!rxEmail.test(dataUserEmail)) {
        cont++;
        errorUserEmail.innerHTML = '<span>Formato de e-mail no válido.</span>';
        if (cont == 1) inUserEmail.focus();
    } else if (inUserEmail.getAttribute('data-unique') === 'false') { /*validate email unique field*/
        cont++;
        if (cont == 1) inUserEmail.focus();
    }
    /*validate user-username*/
    if (dataUserUsername === '') {
        cont++;
        errorUserUsername.innerHTML = '<span>Nombre de usuario es requerido.</span>';
        if (cont == 1) inUserUsername.focus();
    } else if (!rxUsername.test(dataUserUsername)) {
        cont++;
        errorUserUsername.innerHTML = '<span>Entre 2 y 15 letras o números sin espacios.</span>';
        if (cont == 1) inUserUsername.focus();
    } else if (inUserUsername.getAttribute('data-unique') === 'false') { /*validate usuario unique field*/
        cont++;
        if (cont == 1) inUserUsername.focus();
    }
    /*validate password and repassword*/
    if (dataUserPassword === '') {
        cont++;
        errorUserPassword.innerHTML = '<span>Ingresar una contraseña.</span>';
        if (cont == 1) inUserPassword.focus();
    } else if (dataUserPassword.length < 6) {
        cont++;
        errorUserPassword.innerHTML = '<span>Cree una contraseña entre 6 y 15 caracteres.</span>';
        if (cont == 1) inUserPassword.focus();
    }else if (dataUserRepassword === '') {
        cont++;
        errorUserRepassword.innerHTML = '<span>Ingrese su contraseña nuevamente.</span>';
        if (cont == 1) inUserRepassword.focus();
    } else if (dataUserRepassword != dataUserPassword) {
        cont++;
        errorUserRepassword.innerHTML = '<span>Las contraseñas no coinciden.</span>';
        if (cont == 1) inUserRepassword.focus();
    }

    /*perform main query*/
    if (cont > 0) {
        $(insertItemProcessingGif).fadeOut();
        return false;
    } else {
        return true;
    }
}