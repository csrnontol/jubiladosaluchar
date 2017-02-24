<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 04/02/2017
 * Time: 0:47
 */
session_start();
if (isset($_SESSION['user-id'])) {
    header('Location: ../index.php');
    exit();
}
require_once '../functions/class.user.php';
$newUser = new User();

$user_email = '';
if (isset($_POST['btn-forgot'])) {
    $user_email = trim($_POST['in-useremail']);

    $stmt = $newUser->runQuery("SELECT user_id, hash FROM user WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $user_email);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    if ($res->num_rows == 1) {
        $user_id = base64_encode($row['user_id']);
        $user_hash = $row['hash'];

        $mailSubject = "Jubilados a Luchar - Restablecimiento de Contraseña";
        $mailSubject = "=?UTF-8?B?" . base64_encode($mailSubject) . "?=";
        $mailHeadings = array();
        $mailHeadings[] = "MIME-Version: 1.0";
        $mailHeadings[] = "Content-type: text/html; charset=ISO-8859-1";
        $mailHeadings[] = "Content-Type: text/html; charset=UTF-8";
        $mailHeadings[] = "From: Asociación Jubilados a Luchar";
        $mailBody = "Hola, $user_email<br><br>Recibimos una solicitud para resestablecer su contraseña de usuario en el sitio web Jubilados a Luchar.";
        $mailBody .= "<br>Para restablecer su contraseña continúe haciendo clic en el siguiente enlace:<br><br>";
        $mailBody .= "<a href='http://localhost/jubiladosaluchar/userlogin/resetpass.php?code=$user_id&token=$user_hash'>Restablecer Contraseña</a><br><br>Gracias.";
        $mailBody .= "<br><br><br>Atte.:<br>Sistema Web (jubiladosaluchar.com)";
        $mailBody .= "<br><br><br><span style='font-size: 13px'>Si usted desconoce sobre esta actividad por favor simplemente ignore este e-mail y nada pasará.</span>";

        if (mail($user_email, $mailSubject, $mailBody, implode("\r\n", $mailHeadings))) {
            $_SESSION['inuser-email'] = $user_email;
            header('Location: forgotpass-result.php?result=success');
            exit();
        } else {
            $msg = "No fue posible enviar el e-mail de restablecimiento de contraseña. Por favor intente nuevamente.";
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
    <title>Contraseña de Usuario | Jubilados a Luchar</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/user-login.css">
</head>
<body class="body-dark-bg">
<?php
include_once '../tools/main-header.php';
?>
<div class="main-container-login">
    <?php echoFormLogo(); ?>
    <form class="frm-user-forgot-reset _radius3px" method="post" action="" autocomplete="off">
        <h3 class="titles">¿Olvidó su contraseña?</h3>
        <p class="str-info">Para restablecer su contraseña proporcione su dirección de correo con la que creó su cuenta de usuario.</p>
        <div class="div-user-icon"><i class="fa fa-user"></i></div>
        <div id="errors-login-form"><?php if (isset($msg)) echo $msg;?></div>
        <div class="div-fields">
            <label for="in-useremail">Ingrese su e-mail:</label>
            <input type="text" id="in-useremail" name="in-useremail" maxlength="100" value="<?= $user_email;?>" placeholder="e-mail asociado a su cuenta" autofocus>
        </div>
        <button id="btn-forgot" name="btn-forgot">
            <i class="fa fa-mail-forward"></i>
            <span>Enviar un enlace por e-mail</span>
        </button>
    </form>
</div>
<?php
include_once '../tools/main-footer.php';
?>
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/initial-access.js"></script>
</body>
</html>