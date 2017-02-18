<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 03/02/2017
 * Time: 19:50
 */
error_reporting(E_ALL ^ E_NOTICE);
if (!$result_type = $_GET['queryresult']) {
    exit('<code>Content not available...</code>');
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualización de Artículo</title>
    <link rel="stylesheet" type="text/css" href="../../css/global.css">
    <link rel="stylesheet" type="text/css" href="../../css/basics.css">
</head>
<body>
<div class="query-message--container <?= $result_type;?>">
    <h3 class="qm-head">Actualización de Información de Artículo</h3>
    <div class="qm-body" style="text-align: center;">
        <?php
        if ($result_type === 'success')
            echo '<p>¡El registro fue actualizado con éxito!</p>';
        elseif ($result_type === 'error')
            echo '<p>Ocurrió un error. No fue posible actualizar el registro.</p>';
        ?>
    </div>
    <div class="qm-foot">
        <?php
        if ($result_type === 'success') {
            echo '<a href="../../index.php" class="_hyperlink">Ir a la Página Principal</a><br><br>';
            echo '<a href="../articulos.php" class="_hyperlink">Regresar al Administrador de Artículos</a>';
        } elseif ($result_type === 'error')
            echo '<a href="../articulos.php" class="_hyperlink">Regresar al Administrador de Artículos</a>';
        ?>
    </div>
</div>
</body>
