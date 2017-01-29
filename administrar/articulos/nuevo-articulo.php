<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 28/01/2017
 * Time: 13:20
 */
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/administrar.css">
    <!-- include text editor files -->
    <!-- <link rel="stylesheet" href="../../tools/widgEditor/css/info.css"> -->
    <link rel="stylesheet" href="../../tools/widgEditor/css/main.css">
    <link rel="stylesheet" href="../../tools/widgEditor/css/widgEditor.css">
    <script type="text/javascript" src="../../tools/widgEditor/scripts/widgEditor.js"></script>
</head>
<body>
<div class="div-nuevo-articulo">
    <h2 class="titulo">Nuevo ingreso de Artículo</h2>
    <form id="alumno-form" action="" method="get">
        <div class="div-title">
            <label for="article-title">Título del artículo:</label>
            <input type="text" id="article-title" name="in-title">
            <span id="title-error"></span>
        </div>
        <div class="div-content">
            <label for="article-content">Contenido del artículo:</label>
            <textarea name="txt-content" id="article-content" class="widgEditor nothing"></textarea>
            <span id="content-error"></span>
        </div>
        <div class="div-source">
            <label for="article-source">Fuente del contenido:</label>
            <textarea name="txt-source" id="article-source" rows="4"></textarea>
            <span id="source-error"></span>
        </div>
        <div class="div-button">
            <div class="general-errors"></div>
            <input type="submit" name="btn-submit" value="Ingresar Artículo" class="manage _gradientBtn">
        </div>
    </form>
</div>
<script type="text/javascript" src="../../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../../js/administrar-articulos.js"></script>
</body>
</html>
