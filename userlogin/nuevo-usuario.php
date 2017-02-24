<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 04/02/2017
 * Time: 0:47
 */
$user_name = $user_surname = $user_email = '';
$user_username = $user_password = $user_repassword = '';
$name_err = $surname_err = $email_err = '';
$username_err = $pass_err = $repass_err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../functions/class.user.php';
    $newDatabase = new Database();
    $newDatabase = $newDatabase->classdbconnection();

    /* post form data */
    $user_name = mb_convert_case(trim($_POST['in-user-name']), MB_CASE_TITLE, "UTF-8");
    $user_surname = mb_convert_case(trim($_POST['in-user-surname']), MB_CASE_TITLE, "UTF-8");
    $user_username = trim($_POST['in-user-username']);
    $user_email = trim($_POST['in-user-email']);
    $user_password = trim($_POST['in-user-password']);
    $user_repassword = trim($_POST['in-user-repassword']);

    /* regular expressions */
    $namesRx = "/^[a-zA-ZÀ-ú ]{3,40}$/"; // "/^[a-zA-Z ]*$/" ('*' = repeat)
    $usernameRx = "/^[a-zA-ZÀ-ú0-9]{2,15}$/";
    $errors = 0;

    /*validate name*/
    if (empty($user_name)) {
        $errors++;
        $name_err = 'Nombre es requerido.';
    } elseif (!preg_match($namesRx, $user_name)) {
        $errors++;
        $name_err = 'Sólo letras y espacios en un mínimo de tres.';
    }
    /*validate surname*/
    if (empty($user_surname)) {
        $errors++;
        $surname_err = 'Apellido es requerido.';
    } elseif (!preg_match($namesRx, $user_surname)) {
        $errors++;
        $surname_err = 'Sólo letras y espacios en mínimo de tres.';
    }
    /*validate username*/
    if (empty($user_username)) {
        $errors++;
        $username_err = 'Nombre de usuario es requerido.';
    } elseif (!preg_match($namesRx, $user_surname)) {
        $errors++;
        $username_err = 'Entre 2 y 15 letras o números sin espacios.';
    }
    /*validate email*/
    if (empty($user_email)) {
        $errors++;
        $email_err = 'E-mail es requerido.';
    } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $errors++;
        $username_err = 'Formato de e-mail no válido.';
    }
    /*validate password and repassword*/
    if (empty($user_password)) {
        $errors++;
        $pass_err = 'Ingresar una contraseña.';
    } elseif (strlen($user_password) < 6) {
        $errors++;
        $pass_err = 'Cree una contraseña entre 6 y 15 caracteres.';
    } elseif (empty($user_repassword)) {
        $errors++;
        $repass_err = 'Ingrese su contraseña nuevamente.';
    } elseif ($user_password != $user_repassword) {
        $errors++;
        $repass_err = 'Las contraseñas no coinciden.';
    }

    /* insert admin query */
    if ($errors == 0) {
        $record_hash = md5(uniqid(rand()));
        $user_password = password_hash($user_password, PASSWORD_DEFAULT);
        $sql = $newDatabase->prepare("INSERT INTO user (name, surname, email, username, password, hash, reg_date) 
        VALUES (?, ?, ?, ?, ?, ?, now())");
        $sql->bind_param('ssssss', $user_name, $user_surname, $user_email, $user_username, $user_password, $record_hash);
        if ($sql->execute()) {
            /*vars for confirmation email*/
            $mailSubject = "Jubilados a Luchar - Confirmación de Cuenta";
            $mailSubject = "=?UTF-8?B?" . base64_encode($mailSubject) . "?=";
            $mailHeadings = array();
            $mailHeadings[] = "MIME-Version: 1.0";
            $mailHeadings[] = "Content-type: text/html; charset=ISO-8859-1";
            $mailHeadings[] = "Content-Type: text/html; charset=UTF-8";
            $mailHeadings[] = "From: Asociación Jubilados a Luchar";
            $mailBody = "Hola, $user_name<br><br>Para activar su cuenta de usuario en Jubilados a Luchar por favor continue mediante el siguiente enlace:<br><br>";
            $mailBody .= "<a href='http://localhost/jubiladosaluchar/userlogin/confirm.php?email=$user_email&token=$record_hash'>http://localhost/jubiladosaluchar/userlogin/confirm.php?email=$user_email&token=$record_hash</a>";
            $mailBody .= "<br><br><br>Atte.:<br>Sistema Web (jubiladosaluchar.com)";
            $mailBody .= "<br><br><br><span style='font-size: 13px'>Si usted no solicitó un registro de cuenta o desconoce el motivo de este mensaje por favor ignore el e-mail.</span>";
            /*send confirmation mail*/
            if (mail($user_email, $mailSubject, $mailBody, implode("\r\n", $mailHeadings))) {
                session_start();
                $_SESSION['inuser-email'] = $user_email;
                header('Location: nuevo-usuario-result.php?queryresult=success');
                exit();
            } else {
                header('Location: nuevo-usuario-result.php?queryresult=inserted');
                exit();
            }
        } else {
            header('Location: nuevo-usuario-result.php?queryresult=error');
            exit();
        }
    }
}
?>
<!doctype html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de Nuevo Usuario | Jubilados a Luchar</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/user-login.css">
</head>
<body>
<?php
include_once '../tools/main-header.php';
echoMainHeader();
?>
<div class="insert-new-item--div-container nuevo-usuario">
    <h2 style="text-align: center;">Registro de nuevo usuario</h2>
    <section class="nuevo-usuario-section">
        <main id="main-content" class="nuevo-usuario user">
            <div style="position: relative;">
                <form id="frm-nuevo-usuario" method="post" action="" autocomplete="off">
                    <div class="name-surname">
                        <div class="user-name">
                            <label for="in-user-name">Nombres:</label>
                            <input type="text" name="in-user-name" id="in-user-name" maxlength="40" value="<?= $user_name;?>">
                            <span id="error-name"><span><?= $name_err;?></span></span>
                        </div>
                        <div class="user-surname">
                            <label for="in-user-surname">Apellidos:</label>
                            <input type="text" name="in-user-surname" id="in-user-surname" maxlength="40" value="<?= $user_surname;?>">
                            <span id="error-surname"><span><?= $surname_err;?></span></span>
                        </div>
                    </div>
                    <div class="email-username">
                        <div class="user-email">
                            <label for="in-user-email">E-mail:</label>
                            <input type="email" name="in-user-email" id="in-user-email" data-unique="true" value="<?= $user_email;?>">
                            <span id="error-email"><span><?= $email_err;?></span></span>
                        </div>
                        <div class="user-username">
                            <label for="in-user-username">Nombre de usuario:</label>
                            <input type="text" name="in-user-username" id="in-user-username" data-unique="true" maxlength="15" <?= $user_username;?>>
                            <span id="error-username"><span><?= $username_err;?></span></span>
                        </div>
                    </div>
                    <div class="pass-repass">
                        <div class="user-password">
                            <label for="in-user-password">Contraseña:</label>
                            <input type="password" name="in-user-password" id="in-user-password" maxlength="15" value="<?= $user_password;?>">
                            <span id="error-password"><span><?= $pass_err;?></span></span>
                        </div>
                        <div class="user-repassword">
                            <label for="in-user-repassword">Repetir contraseña:</label>
                            <input type="password" name="in-user-repassword" id="in-user-repassword" maxlength="15" value="<?= $user_repassword;?>">
                            <span id="error-repassword"><span><?= $repass_err;?></span></span>
                        </div>
                    </div>
                    <div class="button-section">
                        <span class="insert-item--processing-gif"></span>
                        <button type="submit" id="btn-submit-usuario" class="_thin-btn _radius3px"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<span>Crear Cuenta</span></button>
                    </div>
                </form>
            </div>
        </main>
    </section>
</div>
<?php
include_once '../tools/main-footer.php';
?>
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/user/functions-user.js"></script>
</body>
</html>