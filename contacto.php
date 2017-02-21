<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 12/02/2017
 * Time: 23:46
 */
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
?>
<main class="_main-container">
    <section class="content-mainsection contacto-form">
        <div class="contacto-ubicacion">
            <div id="contactanos">
                <form id="contact_form" action="#" method="post">
                    <div class="row">
                        <label for="name">Nombre:&nbsp;&nbsp;</label>
                        <img src="img/default-avatar.png">
                        <br/>
                        <input id="name" class="input" name="name" type="text" value="" /><br />
                    </div>
                    <div class="row">
                        <label for="email">Email:&nbsp;&nbsp;</label>
                        <img src="img/email.png">
                        <br/>
                        <input id="email" class="input" name="email" type="text" value=""  /><br />
                    </div>
                    <div class="row">
                        <label for="message">Mensaje:&nbsp;&nbsp;</label>
                        <img src="img/contact.png">
                        <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />
                    </div>
                    </br>
                    <input id="submit_button" type="submit" value="Enviar" />
                </form>
            </div>
        </div>
        <aside class="sesion-usuario">
            <?php include_once 'tools/user-aside-login.php'; ?>
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
