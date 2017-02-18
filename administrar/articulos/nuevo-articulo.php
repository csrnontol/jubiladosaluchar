<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 28/01/2017
 * Time: 13:20
 */
ob_start();

session_start();
if (!isset($_SESSION['admin-id'])) {
    exit('<code>Contenido no disponible.</code>');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_SESSION['admin-id'];
    require_once '../../functions/class.user.php';
    $newDatabase = new Database();
    $newDatabase = $newDatabase->classdbconnection();

    /* get form data */
    $article_title = trim($_POST['in-title']);
    $article_content = trim($_POST['txt-content']);
    $article_source = trim($_POST['txt-source']);
    $article_source = preg_replace('/\r\n|\r|\n/', '<br>', $article_source);
    $do_post = 0;
    if (isset($_POST['check-post'])) {
        $do_post = 1;
    }

    /* insert data */
    $stmt = $newDatabase->prepare("INSERT INTO article (admin_id, title, content, source, date, active) 
    VALUES (?, ?, ?, ?, now(), ?)");
    $stmt->bind_param('isssi', $admin_id, $article_title, $article_content, $article_source, $do_post);
    if ($stmt->execute()) {
        header('Location: nuevo-articulo-result.php?queryresult=success');
        exit();
    } else {
        header('Location: nuevo-articulo-result.php?queryresult=error');
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
    <title>Ingresar Nuevo Artículo de Interés</title>
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
    <h2 class="titulo">Nuevo Ingreso de Artículo</h2>
    <form id="articulo-form" action="" method="post">
        <div class="div-title">
            <label for="article-title">Título del artículo:</label>
            <input type="text" id="article-title" name="in-title">
            <span id="title-error" class="input-fields-value-error"></span>
        </div>
        <div class="div-content">
            <label for="article-content">Contenido del artículo:</label>
            <textarea name="txt-content" id="article-content" class="widgEditor nothing"></textarea>
            <span id="content-error" class="input-fields-value-error"></span>
        </div>
        <div class="div-source">
            <label for="article-source">Fuente del contenido:</label>
            <textarea name="txt-source" id="article-source" rows="4"></textarea>
            <span id="source-error" class="input-fields-value-error"></span>
        </div>
        <div class="div-post" style="margin-top: 40px;">
            <input type="checkbox" id="post-article" name="check-post" value="1">
            <label for="post-article">Publicar artículo automáticamente</label>
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
<?php
ob_end_flush();