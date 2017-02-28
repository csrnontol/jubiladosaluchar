<?php
/**
 * Created by PhpStorm.
 * User: Kinsky
 * Date: 26/02/2017
 * Time: 1:15 PM
 */
error_reporting(E_ALL ^ E_NOTICE);
if (!$result_type = $_GET['result']) {
    exit('<code>Content not available...</code>');
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mensaje de Contacto &bull; Jubilados a Luchar</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link rel="stylesheet" type="text/css" href="css/basics.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body class="body-dark-bg">
<?php
include_once 'tools/main-header.php';
echoFormLogo();
?>
<div class="query-message--container <?= $result_type;?>">
    <h3 class="qm-head">Mensaje desde Formulario de Contacto</h3>
    <div class="qm-body" style="text-align: center;">
        <?php
        if ($result_type == 'success') {
            ?>
            <p>
                <b>Mensaje enviado con éxito.</b><br><br>
                Su mensaje ha sido enviado correctamente. Gracias por contactar con nosotros; le responderemos tan pronto sea posible.
            </p>
            <?php
        } elseif ($result_type == 'notsent') {
            ?>
            <p>
                <b>Error.</b><br><br>
                No fue posible enviar el e-mail; esto puede deberse a un problema de red. Por favor intente nuevamente.
            </p>
            <?php
        }
        ?>
    </div>
    <div class="qm-foot">
        <?php
        if ($result_type == 'success') {
            echo '<a href="/">Ir a la Página Principal</a>';
        } elseif ($result_type == 'notsent') {
            echo '<a href="contacto.php">Ir a la página de contacto</a>';
        } ?>
    </div>
</div>
<?php
include_once 'tools/main-footer.php';
?>
</body>
</html>