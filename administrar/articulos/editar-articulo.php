<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 28/01/2017
 * Time: 13:20
 */
session_start();
if (!isset($_SESSION['admin-id']) || !isset($_GET['code'])) {
    exit('<code>Contenido no disponible.</code>');
}
require_once '../../functions/class.user.php';
$newDatabase = new Database();
$newDatabase = $newDatabase->classdbconnection();
$article_id = base64_decode($_GET['code']);

/* select current data from article */
$sqlget_article = $newDatabase->prepare("SELECT * FROM article WHERE article_id = ?");
$sqlget_article->bind_param('i', $article_id);
$sqlget_article->execute();
$res = $sqlget_article->get_result();
$article = $res->fetch_assoc();
$article_title = $article['title'];
$article_content = $article['content'];
$article_source = $article['source'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_SESSION['admin-id'];

    /* get form data */
    $in_article_title = trim($_POST['in-title']);
    $in_article_content = trim($_POST['txt-content']);
    $in_article_source = trim($_POST['txt-source']);

    /* insert data */
    $stmt = $newDatabase->prepare("UPDATE article SET admin_id = ?, title = ?, content = ?, source = ?
    WHERE article_id = ?");
    $stmt->bind_param('isssi', $admin_id, $in_article_title, $in_article_content, $in_article_source, $article_id);
    if ($stmt->execute()) {
        header('Location: editar-articulo-result.php?queryresult=success');
        exit();
    } else {
        header('Location: editar-articulo-result.php?queryresult=error');
        exit();
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <title>Actualizar Información de Artículo de Interés</title>
    <link rel="stylesheet" href="../../css/global.css">
    <link rel="stylesheet" href="../../css/master.css">
    <link rel="stylesheet" href="../../css/administrar.css">
    <!-- include text editor files -->
    <!-- <link rel="stylesheet" href="../../tools/widgEditor/css/info.css"> -->
    <link rel="stylesheet" href="../../tools/widgEditor/css/main.css">
    <link rel="stylesheet" href="../../tools/widgEditor/css/widgEditor.css">
    <script type="text/javascript" src="../../tools/widgEditor/scripts/widgEditor.js"></script>
</head>
<body>
<div class="div-nuevo-articulo">
    <div style="text-align: center;">
        <a href="../articulos.php" class="_hyperlink">Regresar al Administrador de Artículos</a>
    </div>
    <h2 class="titulo">Actualizar Información de Artículo</h2>
    <form id="articulo-form" action="" method="post">
        <div class="div-title">
            <label for="article-title">Título del artículo:</label>
            <input type="text" id="article-title" name="in-title" value="<?= $article_title;?>">
            <span id="title-error" class="input-fields-value-error"></span>
        </div>
        <div class="div-content">
            <label for="article-content">Contenido del artículo:</label>
            <textarea name="txt-content" id="article-content" class="widgEditor nothing"><?= $article_content;?></textarea>
            <span id="content-error" class="input-fields-value-error"></span>
        </div>
        <div class="div-source">
            <label for="article-source">Fuente del contenido:</label>
            <textarea name="txt-source" id="article-source" rows="4"><?= $article_source;?></textarea>
            <span id="source-error" class="input-fields-value-error"></span>
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