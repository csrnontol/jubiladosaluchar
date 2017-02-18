/**
 * Created by Kinsky on 24/01/2017.
 */
$(document).ready(function () {

    /*
     * Show/hide user session options
     */
    var divToggleOptions = document.querySelector(".session-container .toggle-options .trigger");
    var divUserControls = document.getElementById("div-user-controls");
    $(divToggleOptions).on('click', function () {
        if (!$(divUserControls).is(':visible')) {
            $(divUserControls).slideDown('fast');
            $(".user-toggle-icon").removeClass("fa-chevron-down").addClass("fa-chevron-up");
            $(this).prop('title', "Ocultar opciones");
        } else {
            $(divUserControls).slideUp('fast');
            $(".user-toggle-icon").removeClass("fa-chevron-up").addClass("fa-chevron-down");
            $(this).prop('title', "Mostrar opciones");
        }
    });


    /*
     * User Login Form
     */
    var pathName = window.location.pathname;
    var pageName = pathName.split("/").pop();
    var formUserLogin = document.getElementById("form-user-login");
    var btnUserLogin = document.getElementById("btn-user-login");
    if (formUserLogin != null && pageName != 'login.php') {
        formUserLogin.onsubmit = function () {
            return false;
        };
    }
    $(btnUserLogin).on('click', function () {
        if ($(this).hasClass("_btnDisabled")) {
            return false;
        }
        $(this).addClass("_btnDisabled");
        var inUsername = document.getElementById("in-user-username");
        var inPassword = document.getElementById("in-user-password");
        var usernameVal = inUsername.value.trim();
        var passwordVal = inPassword.value.trim();
        var usernameError = document.getElementsByClassName("error-username")[0];
        var passwordError = document.getElementsByClassName("error-password")[0];
        usernameError.innerHTML = '';
        passwordError.innerHTML = '';
        var cont = 0, $this = $(this);

        /*validate username and password*/
        if (usernameVal === '') {
            cont++;
            usernameError.innerHTML = 'El campo usuario no debe quedar vacío. Por favor intente de nuevo.';
            if (cont == 1) inUsername.focus();
            $this.removeClass("_btnDisabled");
            return false;
        }
        verifyUsername(usernameVal, function () {
            var hdnValidUsername = document.getElementById("hdn-valid-username");
            if (hdnValidUsername.value === 'false') {
                cont++;
                usernameError.innerHTML = 'Usuario o e-mail no encontrado. Por favor intente de nuevo.';
                if (cont == 1) inUsername.focus();
            } else if (passwordVal === '') {
                cont++;
                passwordError.innerHTML = 'Falta ingresar una contraseña. Por favor intente de nuevo.';
                if (cont == 1) inPassword.focus();
            }
            if (cont > 0) {
                $this.removeClass("_btnDisabled");
                return false;
            } else {
                if (pageName != 'login.php') {
                    verifyUserLogin(usernameVal, passwordVal, function () {
                        if ($this.val() === 'true') {
                            setTimeout(function () {
                                location.reload(); // login succes
                            }, 500);
                        } else if (($this.val() === 'inactive')) {
                            usernameError.innerHTML = 'Usuario inactivo. Por favor verifique su e-mail o consulte al administrador.';
                            $this.removeClass("_btnDisabled");
                            return false;
                        } else {
                            passwordError.innerHTML = 'Contraseña incorrecta. Por favor intente de nuevo.';
                            $this.removeClass("_btnDisabled");
                            return false;
                        }
                    });
                } else {
                    return true; // login.php self validation
                }
            }
        });
    });
});


/* function to verify valid username or e-mail */
function verifyUsername(value, callback) {
    $.ajax({
        url: '/jubiladosaluchar/userlogin/data/verifyUsername.php',
        type: 'POST',
        data: {
            table: 'user',
            value: value
        },
        success: function (html) {
            var hdnValidUsername = document.getElementById("hdn-valid-username");
            hdnValidUsername.value = html;
            callback(); // see $.when, promise()
        }
    });
}


/* function to verify valid user session */
function verifyUserLogin(user, pass, callback) {
    $.ajax({
        url: '/jubiladosaluchar/userlogin/data/verifyUserLogin.php',
        type: 'POST',
        data: {
            table: 'user',
            user: user,
            pass: pass
        },
        success: function (html) {
            var btnUserLogin = document.getElementById("btn-user-login");
            btnUserLogin.value = html;
            callback(); // see $.when, promise()
        }
    });
}