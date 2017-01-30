<?php
/**
 * Created by PhpStorm.
 * User: Kinsky
 * Date: 29/01/2017
 * Time: 11:05 PM
 */
session_start();
if (isset($_SESSION['admin-id'])) {
    header('Location: ../index.php');
    exit();
}
include_once '../functions/connection.php';
$conn = dbconnection();
require_once '../functions/class.user.php';
$newUser = new User();

error_reporting(E_ALL ^ E_NOTICE);
/* define warning type */
$event_type = $_GET['warning'];
if (!$event_type)
    $warning = '';
else if (!$_POST['btn-login']) {
    if ($event_type === 'login')
        $warning = 'Es necesario iniciar sesión para acceder a la página.';
    else $warning = 'O.O';
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Iniciar Sesión - Usuario del Sistema</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/user-login.css">
</head>
<body>
<?php
include_once '../tools/main-header.php';

$user = $pass = $sesion_error = $missed_pass = '';
if (isset($_POST['btn-login'])) {
    $usuario = mysqli_real_escape_string($conn, trim($_POST['usuario-login']));
    $senha = mysqli_real_escape_string($conn, trim($_POST['password-login']));

    if (!$usuario)
        $sesion_error = 'El campo Usuario no debe quedar vacío.';
    elseif (!$senha) {
        $user = $usuario;
        $sesion_error = 'Falta ingresar una Contraseña.';
    } else {
        $user = $usuario; $pass = $senha;
        if (!$newUser->doLogin('admin', $user, $user, $pass)) {
            $sesion_error = 'Usuario y/o Contraseña incorrecto(s).';
            $missed_pass = '<a href="forgotpass.php" class="_hyperlink">¿Olvidó su contraseña?</a>';
        } else {
            $admin_data = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$user' OR email = '$user'");
            $admin_data = mysqli_fetch_assoc($admin_data);
            if ($admin_data['active'] == 0) {
                $sesion_error = 'Usuario no activado. Consulte al administrador.';
            } else {
                /*get admin data and do login*/
                $admin_id = $_SESSION['admin-id'] = $admin_data['admin_id'];
                $_SESSION['admin-name'] = $admin_data['name'];
                $_SESSION['admin-username'] = $admin_data['username'];
                $_SESSION['admin-email'] = $admin_data['email'];
                /*redirect page*/
                mysqli_close($conn);
                if (isset($_GET['redirect'])) header('Location: ' . $_GET['redirect']);
                else header('Location:../index.php');
                exit();
            }
        }
    }
}
?>
<div class="main-container-login">
    <div class="div-sesion-header">
        <div class="div-sesion-header-title">Iniciar Sesión: Usuario del Sistema</div>
        <div class="div-sesion-header-date"><?php echo strftime("(%d - %B - %Y)"); ?></div>
    </div>
    <div id="login-events"><?php echo $warning; ?></div>
    <fieldset class="fieldset-login-section _radius5px">
        <legend class="_radius10px">Iniciar sesión para ingresar al sistema</legend>
        <form id="admin-login-form" method="post" action="" autocomplete="off">
            <div id="errors-login-form"><?php echo $sesion_error; ?></div>
            <label for="usuario-login"><span>Usuario:</span></label>
            <div class="login-form--user-name">
                <input type="text" id="usuario-login" name="usuario-login" maxlength="100" value="<?= $user;?>" placeholder="nombre de usuario o e-mail" autofocus>
                <span><i class="fa fa-user fa-fw i-user"></i></span>
            </div>
            <label for="password-login"><span>Contraseña:</span></label>
            <div class="login-form--password">
                <input type="password" id="password-login" name="password-login" maxlength="15" value="<?= $pass;?>" placeholder="contraseña de administrador">
                <span><i class="fa fa-key fa-fw i-key"></i></span>
            </div>
            <button id="btn-login" name="btn-login">Ingresar</button>
            <div id="missed-password--div-events"><?= $missed_pass;?></div>
        </form>
    </fieldset>
</div>
<footer class="main-footer no-print-this">
    <div class="content">
        <div class="system-description">
            <hr>
            <div>
                <span class="version">CRC-Academics 1.0 <span style="margin: 0 5px;">&vert;</span> 2016 &ndash; <?= date("Y");?>, Trujillo - Perú</span>
                <div class="sponsors">
                    <span>Compatible con: </span>&nbsp;&nbsp;<span>Chrome <i class="chrome-logo"></i></span>
                    <span>Firefox <i class="firefox-logo"></i></span>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/initial-access.js"></script>
<script>
    /* Check if Tag is Empty */
    if ($("#login-events").is(':empty')){
        $("#login-events").css({'margin-bottom': 0});
    }
    if ($("#errors-login-form").is(':empty')){
        $("#errors-login-form").css({'padding-bottom': 0, 'padding-top': 0});
    }
</script>
</body>
</html>
<?php mysqli_close($conn); ?>