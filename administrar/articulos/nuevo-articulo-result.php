<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 01/02/2017
 * Time: 23:34
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
    <title>Ingreso de Nuevo Artículo</title>
    <link rel="stylesheet" type="text/css" href="../../css/global.css">
    <link rel="stylesheet" type="text/css" href="../../css/basics.css">
</head>
<body>
<div class="query-message--container <?= $result_type;?>">
    <h3 class="qm-head">Ingreso de Nuevo Artículo</h3>
    <div class="qm-body" style="text-align: center;">
        <?php
        if ($result_type === 'success')
            echo '<p>¡El registro fue realizado con éxito!</p>';
        elseif ($result_type === 'error')
            echo '<p>Ocurrió un error. No fue posible realizar el registro.</p>';
        ?>
    </div>
    <div class="qm-foot">
        <?php
        if ($result_type === 'success') {
            echo '<a href="../../index.php" class="_hyperlink">Ir a la Página Principal</a><br><br>';
            echo '<a href="nuevo-articulo.php" class="_hyperlink">Regresar al formulario de ingreso</a>';
        } elseif ($result_type === 'error')
            echo '<a href="nuevo-articulo.php" class="_hyperlink">Regresar al formulario de ingreso</a>';
        ?>
    </div>
</div>
</body>
</html>