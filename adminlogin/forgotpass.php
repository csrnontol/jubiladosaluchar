<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 01/02/2017
 * Time: 11:11
 */
session_start();
if (isset($_SESSION['admin-id'])) {
    header('Location: ../index.php');
    exit();
}
include '../functions/connection.php';
$conn = dbconnection();
require_once '../functions/class.user.php';
$newUser = new User();

$successful = null;
$user_email = $error_sesion = '';
if (isset($_POST['btn-forgot'])) {
    $user_email = mysqli_real_escape_string($conn, trim($_POST['in-useremail']));

    $stmt = $newUser->runQuery("SELECT admin_id, name FROM admin WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $user_email);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    if ($res->num_rows == 1) {
        $admin_id = $row['admin_id'];
        $admin_name = $row['name'];
        $admin_new_pass = substr(md5(uniqid(rand())), 7, 6);
        $admin_new_pass_db = password_hash($admin_new_pass, PASSWORD_DEFAULT);

        /* insert new generated password */
        $sqlin_pass = "UPDATE admin SET password = '$admin_new_pass_db' WHERE admin_id = '$admin_id'";
        if (mysqli_query($conn, $sqlin_pass)) {
            /* send mail to user with new password */
            $mailSubject = "Jubilados a Luchar - Nueva Contraseña de Acceso";
            $mailSubject = "=?UTF-8?B?" . base64_encode($mailSubject) . "?=";
            $mailHeadings = array();
            $mailHeadings[] = "MIME-Version: 1.0";
            $mailHeadings[] = "Content-type: text/html; charset=ISO-8859-1";
            $mailHeadings[] = "Content-Type: text/html; charset=UTF-8";
            $mailHeadings[] = "From: Jubilados a Luchar";
            $mailBody = "Hola, $admin_name<br><br>De acuerdo a lo solicitado, su nueva conraseña para ingresar al sistema es: <b>$admin_new_pass</b>";
            $mailBody .= "<br><br><br>Atte.:<br>Sistema Web (jubiladosaluchar.com)";
            if (mail($user_email, $mailSubject, $mailBody, implode("\r\n", $mailHeadings))) {
                $msg = "<span style='color: #4a8ecd'>Por favor revise su e-mail ($user_email). Se ha enviado un mensaje con información de su contraseña.";
                $successful = true;
            }
        }
    } else {
        $msg = "La dirección de e-mail no fue encontrada.";
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Contraseña de Usuario Administrador</title>
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
        <h3 class="titles">¿Olvidó su contraseña?</h3>
        <p class="str-info">Para restablecer su contraseña proporcione su dirección de correo con la que creó su cuenta de usuario.</p>
        <div class="div-user-icon"><i class="fa fa-user"></i></div>
        <div id="errors-login-form"><?php if (isset($msg)) echo $msg;?></div>
        <?php if (!$successful) { ?>
            <div class="div-fields">
                <label for="in-useremail">Ingrese su e-mail:</label>
                <input type="text" id="in-useremail" name="in-useremail" maxlength="100" value="<?= $user_email;?>" placeholder="e-mail asociado a su cuenta" autofocus>
            </div>
            <button id="btn-forgot" name="btn-forgot">Continuar</button>
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
<?php mysqli_close($conn); ?>