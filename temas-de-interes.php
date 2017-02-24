<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 27/01/2017
 * Time: 23:59
 */
session_start();
require_once 'functions/functions.php';
require_once 'functions/connection.php';
$conn = dbconnection();

if (isset($_GET['post']) && !empty($_GET['post'])) {
    $post_id = base64_decode($_GET['post']);
    /* get the default article to show */
    $get_article = "SELECT ART.*, ADM.name AS admin_name
    FROM article ART 
    INNER JOIN admin ADM ON ART.admin_id = ADM.admin_id
    WHERE ART.article_id = '$post_id'";
} else {
    /* get the current article to show */
    $get_article = "SELECT ART.*, ADM.name AS admin_name
    FROM article ART 
    INNER JOIN admin ADM ON ART.admin_id = ADM.admin_id
    WHERE ART.active = 1 ORDER BY ART.date DESC LIMIT 1";
}
$get_article = mysqli_query($conn, $get_article);
$current_article = mysqli_fetch_assoc($get_article);
$current_article_id = $current_article['article_id'];
$current_article_title = $current_article['title'];
$current_article_content = $current_article['content'];
$current_article_source = $current_article['source'];
$current_article_date = convertDate($current_article['date'], 4);
$current_article_date .= ' (' . convertHourMeridiem($current_article['date']) . ')';
$current_article_author = $current_article['admin_name'];

/* get comments num for the current article */
$current_article_numcomments = "SELECT COUNT(CMT.comment_id) AS comments_num
FROM comment CMT
INNER JOIN article ART ON CMT.article_id = ART.article_id
WHERE ART.article_id = '$current_article_id'";
$current_article_numcomments = mysqli_query($conn, $current_article_numcomments);
$current_article_numcomments = mysqli_fetch_assoc($current_article_numcomments);
$current_article_numcomments = $current_article_numcomments['comments_num'];

/* get all articles for aside section */
$get_allarticles = "SELECT article_id, title FROM article 
WHERE article_id != '$current_article_id'";
$get_allarticles = mysqli_query($conn, $get_allarticles);
$allarticles_num = mysqli_num_rows($get_allarticles);
?>
<!doctype html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jubilación en el País &bull; Jubilados a Luchar</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body class="_bgi">
<?php
include_once 'tools/main-header.php';
echoMainHeader();
include_once 'tools/menu-and-user-login.php';
?>
<main class="_main-container articulos-main-section">
    <section class="content-mainsection article-sesion">
        <div data-key="<?= base64_encode($current_article_id);?>" class="_main-content article-container">
            <article class="article">
                <h2 class="atitle"><?= $current_article_title; ?></h2>
                <p class="adate">Fecha de publicación: <?= $current_article_date; ?></p>
                <div>
                    <div class="abody">
                        <?= $current_article_content; ?>
                    </div>
                    <div class="afuente">
                        <p style="margin: 0;"><b>Fuente:</b></p>
                        <?= $current_article_source; ?>
                    </div>
                </div>
            </article>
            <div class="div-articles-list secondary-list">
                <h4>Otras publicaciones: <?= $allarticles_num; ?></h4>
                <?php
                while ($allarticles = mysqli_fetch_assoc($get_allarticles)) {
                    $article_code = base64_encode($allarticles['article_id']);
                    $article_title = $allarticles['title'];
                    echo '<a href="'.$_SERVER['PHP_SELF'].'?post='.$article_code.'"> '. $article_title .'</a>';
                }
                ?>
            </div>
            <div class="div-share-article">
                <div>
                    <h4>Compartir este artículo: </h4>
                    <ul class="ul-share-article">
                        <li>
                            <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=">
                                <span>Compartir en Facebook</span>
                            </a>
                        </li>
                        <li>
                            <a class="twitter" href="https://twitter.com/home?status=">
                                <span>Compartir en Twitter</span>
                            </a>
                        </li>
                        <li>
                            <a class="googlep" href="https://plus.google.com/share?url=">
                                <span>Compartir en Google+</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <section class="article-comments">
                <div class="ccantidad">
                    <p>
                        <?php
                        if ($current_article_numcomments > 0) {
                            printf("Comentarios (%02d)", $current_article_numcomments);
                        } else {
                            echo "Sea el primero en comentar.";
                        }
                        ?>
                    </p>
                </div>
                <div class="comentarios">
                    <div id="div-write-comment">
                        <?php
                        include_once 'tools/write-comment-mode.php';
                        ?>
                    </div>
                    <div id="div-comments-list"></div>
                </div>
            </section>
        </div>
        <aside class="sesion-usuario">
            <?php include_once 'tools/aside-user-login.php'; ?>
            <div class="div-articles-list">
                <h4>Otras publicaciones: <?= $allarticles_num; ?></h4>
                <?php
                mysqli_data_seek($get_allarticles, 0);
                while ($allarticles = mysqli_fetch_assoc($get_allarticles)) {
                    $article_code = base64_encode($allarticles['article_id']);
                    $article_title = $allarticles['title'];
                    echo '<a href="'.$_SERVER['PHP_SELF'].'?post='.$article_code.'"> '. $article_title .'</a>';
                }
                ?>
            </div>
        </aside>
    </section>
</main>
<!-- dialog windows and overlay -->
<div class="mastercn-flexible-dialog--container _radius3px" style="display: none"></div>
<div class="mastercn-dialog-overlay" style="display: none"></div>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/global-functions.js"></script>
<script type="text/javascript" src="js/articles-functions.js"></script>
</body>
</html>