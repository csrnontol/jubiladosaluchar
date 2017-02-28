<?php
/**
 * Created by PhpStorm.
 * User: Kinsky
 * Date: 29/01/2017
 * Time: 11:05 PM
 */
session_start();
if (isset($_SESSION['user-id'])) {
    header('Location: ../index.php');
    exit();
}
require_once '../functions/class.user.php';
$newUser = new User();

/* check if aditional page code is set (from articulos) */
if (isset($_GET['post']) && !empty($_GET['post'])) {
    $request_code = $_GET['post'];
    $request_code = '?post='.$request_code;
} else $request_code = '';
?>
<!doctype html>
<html lang="es-PE">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión de Usuario &bull; Jubilados a Luchar</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/user-login.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive.css">
</head>
<body class="body-dark-bg">
<?php
include_once '../tools/main-header.php';

/* validate and do user login */
$username = $password = $sesion_error = '';
$username_err = $password_err = '';
if (isset($_POST['btn-user-login'])) {
    $username = trim($_POST['in-username']);
    $password = trim($_POST['in-password']);
    $errors = 0;

    if (empty($username)) {
        $errors++;
        $username_err = 'El campo usuario no debe quedar vacío. Por favor intente de nuevo.';
    }
    if (empty($password)) {
        $errors++;
        $password_err = 'Falta ingresar una contraseña. Por favor intente de nuevo.';
    }

    if ($errors == 0) {
        if (!$newUser->doLogin('user', $username, $username, $password)) {
            $sesion_error = 'Usuario y/o Contraseña incorrecto(s).';
        } else {
            $getuser = $newUser->runQuery("SELECT * FROM user WHERE username = ? OR email = ?");
            $getuser->bind_param('ss', $username, $username);
            $getuser->execute();
            $userresult = $getuser->get_result();
            $userrow = $userresult->fetch_assoc();
            if ($userrow['active'] == 0) {
                $sesion_error = 'Usuario inactivo. Por favor verifique su e-mail o consulte al administrador.';
            } else {
                $_SESSION['user-id'] = $userrow['user_id'];
                $_SESSION['user-name'] = $userrow['name'];
                $_SESSION['user-surname'] = $userrow['surname'];
                $_SESSION['user-email'] = $userrow['email'];
                $_SESSION['user-username'] = $userrow['username'];
                $_SESSION['user-picture'] = $userrow['picture'];
                if (isset($_GET['redirect']))
                    header('Location: ' . $_GET['redirect'] . $request_code);
                else
                    header('Location: ../index.php');
                exit();
            }
        }
    }
}
?>
<main class="user-session-page">
    <div class="form--logo-slogan">
        <div>
            <a href="../index.php">
                <img src="../img/logo.png" alt="Logo de la Organización">
                <h2 class="slogan">jubiladosaluchar.com</h2>
            </a>
        </div>
    </div>
    <div class="sesion-usuario session-page main _formGrayShadow">
        <div class="session-container main _radius3px">
            <div class="header">
                <h3 class="title">Sesión del usuario</h3>
                <p class="title-text">Inicie sesión y acceda a la zona de usuarios para participar en los temas de interés.</p>
            </div>
            <div class="content">
                <form id="form-user-login" method="post" class="sesion-fields" action="">
                    <div class="username-field">
                        <input type="text" id="in-user-username" name="in-username" value="<?= $username;?>"
                               title="Ingresar nombre de usuario o e-mail" autofocus
                               placeholder="nombre de usuario o e-mail">
                        <input type="hidden" id="hdn-valid-username" value="undef">
                        <span class="sesion-icons"><i class="fa fa-user fa-fw i-user"></i></span>
                        <span class="error-username input-fields-value-error"><?= $username_err;?></span>
                    </div>
                    <div class="password-field">
                        <input type="password" id="in-user-password" name="in-password" value="<?= $password;?>"
                               title="Ingresar contraseña" placeholder="contraseña">
                        <span class="sesion-icons"><i class="fa fa-key fa-fw i-key"></i></span>
                        <span class="error-password input-fields-value-error"><?= $password_err;?></span>
                    </div>
                    <div class="button-field">
                        <div class="div-session-error-msg"><?= $sesion_error;?></div>
                        <button id="btn-user-login" name="btn-user-login" class="_btnUserLogin" value="undef">
                            <i class="fa fa-sign-in"></i>
                            <span>Iniciar sesión</span>
                        </button>
                        <br>
                        <a href="forgotpass.php" class="forgotpass _hyperlink">¿Olvidó su contraseña?</a>
                    </div>
                </form>
                <div class="register-fields">
                    <h4>¿Nuevo aquí?</h4>
                    <a href="nuevo-usuario.php" class="_hyperlink">
                        <i class="fa fa-user-plus"></i>
                        <span>Registrarse ahora</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once '../tools/main-footer.php';
?>
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/global-functions.js"></script>
<script>
    /* Check if Tag is Empty */
    if ($("#login-events").is(':empty')){
        $("#login-events").css({'margin-bottom': 0});
    }
</script>
</body>
</html>