<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 28/01/2017
 * Time: 13:01
 */
session_start();
if (!isset($_SESSION['admin-id'])) {
    header('Location: ../adminlogin/login.php?warning=login&redirect=' . $_SERVER['PHP_SELF']);
    exit();
}
include_once '../functions/connection.php';
include_once '../functions/functions.php';
$conn = dbconnection();

/* obtener todos los articulos */
$get_articulos = mysqli_query($conn, "SELECT * FROM article ORDER BY date DESC");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrar Artículos</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/master.css">
    <link rel="stylesheet" href="../css/administrar.css">
</head>
<body>
<header class="manage-header">
    //
</header>
<main class="_main-container manage-body">
    <h2 class="_main-blue-title">Administrar Temas de Interés (artículos)</h2>
    <div class="manage-item--content">
        <div class="new-item-link">
            <a href="articulos/nuevo-articulo.php" class="_hyperlink">Ingresar nuevo artículo</a>
        </div>
        <table>
            <thead>
            <tr>
                <th>Nro.</th>
                <th>Fecha de registro</th>
                <th>Título del artículo</th>
                <th>Estado</th>
                <th>Última modificación</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            while ($articulos = mysqli_fetch_assoc($get_articulos)) {
                $article_id = base64_encode($articulos['article_id']);
                $article_title = $articulos['title'];
                $article_active = $articulos['active'] ? '<span class="active">Publicado</span>' : '<span class="inactive">Inactivo</span>';
                $article_date = convertDate($articulos['date'], 3);
                $article_timestamp = convertDateTime($articulos['timestamp'], 2);
            ?>
            <tr class="article-row" data-key="<?= $article_id;?>">
                <td class="anum"><?= $i;?></td>
                <td class="adate"><?= $article_date;?></td>
                <td class="atitle"><a href="../temas-de-interes.php?post=<?= $article_id;?>" target="_blank"><?= $article_title;?></a></td>
                <td class="aactive"><a href="javascript:" class="article-status-links" title="Clic para cambiar estado"><?= $article_active;?></a></td>
                <td class="atimestamp"><?= $article_timestamp;?></td>
                <td class="aedit"><a href="articulos/editar-articulo.php?code=<?= $article_id;?>" class="edit-article-links">Editar</a></td>
            </tr>
            <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</main>
<!-- dialog windows -->
<div class="mastercn-change-item-status--container _radius3px" style="display: none"></div>
<!-- dialog windows tools -->
<div class="loading-dialog-gif" style="display: none"></div>
<div class="mastercn-dialog-overlay" style="display: none"></div>
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/administrar-articulos.js"></script>
</body>
</html>
