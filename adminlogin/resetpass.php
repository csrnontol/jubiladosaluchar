<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 01/02/2017
 * Time: 13:01
 */
session_start();
if (!isset($_SESSION['admin-id'])) {
    exit('<code>Contenido no disponible.</code>');
}
$admin_id = $_SESSION['admin-id'];
include_once '../functions/connection.php';
$conn = dbconnection();
require_once '../functions/class.user.php';
$newUser = new User();

$successful = null;
$input_pass = $repeat_pass = $current_pass = '';
if (isset($_POST['btn-resetp'])) {
    /* vars for verify current password */
    $sqlget_pass = mysqli_query($conn, "SELECT password FROM admin WHERE admin_id = '$admin_id'");
    $sql_pass = mysqli_fetch_assoc($sqlget_pass);
    $sql_pass = $sql_pass['password'];
    $current_pass = trim($_POST['in-curpass']);
    $input_pass = trim($_POST['in-pass']);
    $repeat_pass = trim($_POST['in-repass']);
    /* if passwords matches */
    if (password_verify($current_pass, $sql_pass)) {
        if (strlen($input_pass) < 6) {
            $msg = "Ingresar mínimo 6 caracteres para la nueva contraseña.";
        } elseif ($input_pass != $repeat_pass) {
            $msg = "Las contraseñas no coinciden.";
        } else  {
            /* insert new password */
            $new_pass = password_hash($repeat_pass, PASSWORD_DEFAULT);
            $sqlin_newpass = $newUser->runQuery("UPDATE admin SET password = ? WHERE admin_id = ?");
            $sqlin_newpass->bind_param('si', $new_pass, $admin_id);
            if ($sqlin_newpass->execute()) {
                $msg = '<span style="color: #4a8ecd">¡La contraseña fue restablecida!</span>';
                $successful = true;
                header('refresh: 4; ../index.php');
            } else {
                $msg = "No ha sido posible cambiar la contraseña. Por favor vuelva a intentar.";
            }
        }
    } else {
        $msg = "Su contraseña actual no coincide.";
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nueva Contraseña de Usuario Administrador</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/user-login.css">
</head>
<body>
<?php
include_once '../tools/main-header.php';
?>
<div class="main-container-login">
    <form class="frm-user-forgot-reset _radius3px" method="post" action="" autocomplete="off">
        <h3 class="titles">Actualizar Contraseña</h3>
        <p class="str-info">Por favor ingrese los siguientes datos para cambiar la contraseña de su cuenta.</p>
        <div class="div-user-icon"><i class="fa fa-user"></i></div>
        <div id="errors-login-form"><?php if (isset($msg)) echo $msg;?></div>
        <?php if (!$successful) { ?>
            <div class="div-fields">
                <label for="in-pass">Contraseña actual:</label>
                <input type="password" id="in-curpass" name="in-curpass" maxlength="15" value="<?= $current_pass;?>" autofocus>
                <br>
                <label for="in-pass">Nueva contraseña:</label>
                <input type="password" id="in-pass" name="in-pass" maxlength="15" value="<?= $input_pass;?>" style="margin-bottom: 6px">
                <label for="in-repass">Repetir contraseña:</label>
                <input type="password" id="in-repass" name="in-repass" maxlength="15" value="<?= $repeat_pass;?>">
            </div>
            <button id="btn-admin-resetp" name="btn-resetp" class="_btnDisabled">Restablecer</button>
        <?php } ?>
    </form>
</div>
<footer class="main-footer">
    <div class="content">
        <div class="system-description">
            <hr>
            <div>
                <span class="version">jubiladosaluchar.com <span style="margin: 0 5px;">&vert;</span> 2016 &ndash; <?= date("Y");?>, Trujillo - Perú</span>
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
</body>
</html>