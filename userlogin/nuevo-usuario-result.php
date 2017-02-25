<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 06/02/2017
 * Time: 22:45
 */
error_reporting(E_ALL ^ E_NOTICE);
if (!$result_type = $_GET['queryresult']) {
    exit('<code>Content not available...</code>');
}
session_start();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Nuevo Usuario | Jubilados a Luchar</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/basics.css">
</head>
<body>
<?php
include_once '../tools/main-header.php';
echoFormLogo();
?>
<div class="query-message--container <?= $result_type;?>">
    <h3 class="qm-head">Registro de Usuario</h3>
    <div class="qm-body" style="text-align: center;">
        <?php
        if ($result_type == 'success') {
            $inuser_email = $_SESSION['inuser-email'];
        ?>
            <p>
                <b>Registro completado con éxito.</b><br><br>
                Por favor revise su e-mail <b><?= $inuser_email;?></b>; se ha enviado un mensaje con un enlace de activación de la cuenta.
            </p>
        <?php
        } elseif ($result_type == 'inserted') {
            echo '<p>El registro fue completado con éxito, sin embargo no fue posible enviar el e-mail de activación.</p>';
            echo '<p>Por favor pongase en contacto con el administrador del sistema para la activación de su cuenta.</p>';
        } elseif ($result_type == 'error') {
            echo '<p>Ocurrió un error al guardar los datos. El registro no fue realizado.</p>';
        } ?>
</div>
<div class="qm-foot">
    <?php
    if ($result_type == 'success' || $result_type == 'inserted') {
        echo '<a href="../index.php">Ir a la Página Principal</a>';
    } elseif ($result_type == 'error') {
        echo '<a href="nuevo-usuario.php">Intentar registro nuevamente.</a>';
    } ?>
</div>
</div>
</body>
</html>