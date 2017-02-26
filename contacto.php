<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 12/02/2017
 * Time: 23:46
 */
session_start();
$contact_errors = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact_name = trim($_POST['in-name']);
    $contact_email = trim($_POST['in-email']);
    $contact_message = trim($_POST['txt-message']);

    /* regular expressions */
    $namesRx = "/^[a-zA-ZÀ-ú ]{3,100}$/";
    $errors = 0;

    if (empty($contact_name)) {
        $errors++;
        $contact_errors = '<span>- Nombre es requerido.</span>';
    } elseif (!preg_match($namesRx, $contact_name)) {
        $errors++;
        $contact_errors = '<span>- Sólo letras y espacios en un mínimo de tres.</span>';
    }
    if (empty($contact_email)) {
        $errors++;
        $contact_errors .= '<span>- E-mail es requerido para enviar una respuesta.</span>';
    } elseif (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
        $errors++;
        $contact_errors .= '<span>- El formato del e-amil ingresado no es válido.</span>';
    }
    if (empty($contact_message)) {
        $errors++;
        $contact_errors .= '<span>- Mensaje es requerido.</span>';
    } elseif (strlen($contact_message) < 10) {
        $errors++;
        $contact_errors .= '<span>- Por favor especifique su mensaje.</span>';
    }

    if ($errors == 0) {
        $contact_message = preg_replace('/\r\n|\r|\n/', '<br>', $contact_message);
        $contact_message = wordwrap($contact_message, 70, "\r\n");
        /*vars for confirmation email*/
        $mailSubject = "Jubilados a Luchar - Mensaje de Contacto";
        $mailSubject = "=?UTF-8?B?" . base64_encode($mailSubject) . "?=";
        $mailHeadings = array();
        $mailHeadings[] = "MIME-Version: 1.0";
        $mailHeadings[] = "Content-type: text/html; charset=ISO-8859-1";
        $mailHeadings[] = "Content-Type: text/html; charset=UTF-8";
        $mailHeadings[] = "From: Asociación Jubilados a Luchar";
        $mailBody = "Se ha recibido un nuevo mensaje de la página de contacto de Jubilados a Luchar:<br><br>";
        $mailBody .= "<b>Nombres:</b> $contact_name<br>";
        $mailBody .= "<b>E-mail:</b> $contact_email<br>";
        $mailBody .= "<b>Mensaje:</b> $contact_message<br>";
        $mailBody .= "<br><br><br>Atte.:<br>Sistema Web (jubiladosaluchar.com)";
        /*send confirmation mail*/
        if (mail('cormas14@hotmail.com', $mailSubject, $mailBody, implode("\r\n", $mailHeadings))) {
            header('Location: contacto-result.php?result=success');
            exit();
        } else {
            header('Location: contacto-result.php?result=notsent');
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
    <title>Página de Contacto &bull; Jubilados a Luchar</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body class="_bgi">
<?php
include_once 'tools/main-header.php';
echoMainHeader();
include_once 'tools/menu-and-user-login.php';
?>
<main class="_main-container">
    <section class="content-mainsection contacto-form">
        <div class="contacto-ubicacion clear-content-div">
            <div id="contactanos">
                <form id="contact_form" action="" method="post">
                    <h2 class="contact-title">Formulario de contacto</h2>
                    <div class="row">
                        <label for="contact-name"><i class="fa fa-user"></i> Nombres: <span>(Requerido)</span></label>
                        <input id="contact-name" class="input" name="in-name" type="text" value="" />
                    </div>
                    <div class="row">
                        <label for="contact-email"><i class="fa fa-envelope"></i> E-mail: <span>(Requerido)</span></label>
                        <input id="contact-email" class="input" name="in-email" type="email" value="" />
                    </div>
                    <div class="row">
                        <label for="contact-message"><i class="fa fa-pencil"></i> Mensaje: <span>(Requerido)</span></label>
                        <textarea id="contact-message" class="input" name="txt-message" rows="7" cols="30"></textarea>
                    </div>
                    <div class="div-button row">
                        <div class="contact-errors"><?= $contact_errors; ?></div>
                        <div class="loading-request--gif" style="display: none;"></div>
                        <button type="submit" class="_btnDisabled" name="btn-send-contact" id="btn-send-contact">
                            <i class="fa fa-paper-plane"></i> Enviar mensaje
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <aside class="sesion-usuario">
            <?php include_once 'tools/aside-user-login.php'; ?>
        </aside>
    </section>
</main>
<br>
<?php
include_once 'tools/main-footer.php';
?>
</body>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/global-functions.js"></script>
</html>
