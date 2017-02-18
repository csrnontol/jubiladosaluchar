<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 14/02/2017
 * Time: 21:45
 */
$article_id = base64_encode($current_article_id);
if (isset($_SESSION['user-id'])) {
    $user_username = $_SESSION['user-username'];
    $user_fullname = $_SESSION['user-name'] . ' ' . $_SESSION['user-surname'];
    $user_picture = $_SESSION['user-picture'];
    ?>
    <div class="clearfix">
        <label for="txt-new-comment">
            <img src="/jubiladosaluchar/img/user/<?= $user_picture;?>" title="<?= $user_username;?>">
            <br><span><?= $user_fullname;?></span>
        </label>
        <div class="text-and-button">
            <textarea id="txt-new-comment" placeholder="Escriba su comentario..."></textarea>
            <button id="btn-submit-comment" class="_btnDisabled">Comentar</button>
        </div>
    </div>
    <?php
} else { ?>
    <div style="text-align: center;">
        Debe
        <a class="_hyperlink" href="/jubiladosaluchar/userlogin/login.php?redirect=<?= $_SERVER['PHP_SELF'].'&post='.$article_id;?>">
            <i class="fa fa-sign-in"></i> Iniciar Sesión</a> para comentar.<br>
        &mdash; ó &mdash;<br>
        <a class="_hyperlink" href="/jubiladosaluchar/userlogin/nuevo-usuario.php">
            <i class="fa fa-user-plus"></i> Registrarse</a>
    </div>
    <?php
}