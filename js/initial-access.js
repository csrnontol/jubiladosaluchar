/**
 * Created by CYNR on 30/01/2017.
 */
$(document).ready(function () {
    /*
     * Login Form
     */
    var loginButton = document.getElementById("btn-login");
    var errorsContainer = document.getElementById("errors-login-form");
    $(loginButton).on('click', function () {
        var usernameField = document.getElementById("usuario-login");
        var passwordField = document.getElementById("password-login");
        if (usernameField.value.trim() === '') {
            errorsContainer.innerHTML = 'El campo Usuario no debe quedar vacío.';
            usernameField.focus();
            return false;
        } else if (passwordField.value.trim() === '') {
            errorsContainer.innerHTML = 'Falta ingresar una Contraseña.';
            passwordField.focus();
            return false;
        }
    });


    /*
     * Forgot Pass Form
     */
    var btnForgotPass = document.getElementById("btn-forgot");
    $(btnForgotPass).on('click', function () {
        if ($(this).hasClass("_btnDisabled")) {
            return false;
        }
        var inEmail = document.getElementById("in-useremail");
        if (inEmail.value.trim() === '') {
            errorsContainer.innerHTML = 'El campo no debe quedar vacío.';
            inEmail.focus();
            return false;
        } else {
            $(btnForgotPass).addClass("_btnDisabled");
        }
    });


    /*
     * Reset Pass Form
     */
    var btnResetPass = document.getElementById("btn-resetp");
    $(btnResetPass).on('click', function () {
        if ($(this).hasClass("_btnDisabled")) {
            return false;
        }
        var inCurPass = document.getElementById("in-curpass");
        var inPass = document.getElementById("in-pass");
        var inRepass = document.getElementById("in-repass");
        if (inCurPass.value.trim() === '' || inPass.value.trim() === '' || inRepass.value.trim() === '') {
            errorsContainer.innerHTML = 'Por favor complete los campos.';
            $(this).addClass("_btnDisabled");
            if (inCurPass.value.trim() === '') inCurPass.focus();
            return false;
        } else if (inPass.value.trim() != inRepass.value.trim()) {
            errorsContainer.innerHTML = 'Las contraseñas no coinciden.';
            $(this).addClass("_btnDisabled");
            return false;
        }
    });
    var resetPassFields = document.querySelectorAll(".frm-user-forgot-reset input[type=password]");
    $(resetPassFields).on('input', function () {
        if (this.value.trim().length > 0) {
            $(btnResetPass).removeClass("_btnDisabled");
        }
    });
});