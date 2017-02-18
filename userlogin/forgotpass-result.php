<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 08/02/2017
 * Time: 20:18
 */
error_reporting(E_ALL ^ E_NOTICE);
if (!$result = $_GET['result']) {
    exit('<code>Content not available...</code>');
}
session_start();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña de usuario | Jubilados a Luchar</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/basics.css">
</head>
<body>
<div class="query-message--container <?= $result;?>">
    <h3 class="qm-head">Restablecimiento de Contraseña</h3>
    <div class="qm-body" style="text-align: center;">
        <?php
        if ($result == 'success') {
            $inuser_email = $_SESSION['inuser-email'];
            ?>
            <p>
                <b>Listos para restablecer su contraseña.</b><br><br>
                Por favor revise su e-mail (<b><?= $inuser_email;?></b>). Se ha enviado un enlace para restablecer su contraseña.
            </p>
            <?php
        } ?>
    </div>
    <div class="qm-foot">
        <?php
        if ($result == 'success') {
            echo '<a href="../index.php">Ir a la Página Principal</a>';
        } ?>
    </div>
</div>
</body>
</html>