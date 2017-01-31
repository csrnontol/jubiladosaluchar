<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 30/01/2017
 * Time: 22:37
 */
session_start();
if (isset($_SESSION['admin-id'])) {
    exit('<code>Contenido no disponible.</code>');
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo Administrador del Sistema</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/user-login.css">
</head>
<body>
<div class="no-script">
    Al parecer JavaScript está desactivado en el navegador.<br>
    La funcionalidad de esta página no estará disponible mientras JavaScript esté desactivado.<br>
    Se sugiere <a href="http://enable-javascript.com/es/" target="_blank">activar JavaScript</a> y volver a cargar esta página.
</div>
</body>
</html>
