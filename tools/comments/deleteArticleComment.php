<?php
/**
 * Created by PhpStorm.
 * User: Kinsky
 * Date: 21/02/2017
 * Time: 7:15 PM
 */
if (!$do_step = $_POST['step']) {
    exit('<code>Content not available.</code>');
}

/*
 * step: load comment form
 */
if ($do_step === 'load') {
    /*html output*/
    echo '<div data-key="'.$_POST['key'].'" class="mastercn-change-item-status--dialog _radius3px">';
    echo '<div class="dheader">';
    echo '<h3>Eliminar Comentario</h3>';
    echo '</div>';
    echo '<div class="dbody">';
    echo '<div class="div-content">';
    echo '<span>Está a punto de eliminar el comentario.<br>¿Realmente desea continuar?</span>';
    echo '</div>';
    echo '</div>';
    echo '<div class="dfoot">';
    echo '<span class="lnk-delete-article-comment dialog-buttons do-step _noSelect">Eliminar</span>';
    echo '<span class="dialog-buttons close-dialog _noSelect">Cancelar</span>';
    echo '</div>';
    echo '</div>';
}


/*
 * step: update comment
 */
elseif ($do_step === 'delete') {
    require_once '../../functions/functions.php';
    require_once '../../functions/connection.php';
    $conn = dbconnection();
    $comment_id = base64_decode($_POST['key']);

    $sql_deleted = "UPDATE comment SET deleted = 1 WHERE comment_id = '$comment_id'";
    if (mysqli_query($conn, $sql_deleted)) {
        $get_user = "SELECT CONCAT(USR.name, ' ', USR.surname) AS user_name, CMT.date
        FROM comment CMT
        INNER JOIN user USR ON CMT.user_id = USR.user_id
        WHERE CMT.comment_id = '$comment_id'";
        $get_user = mysqli_query($conn, $get_user);
        $comment = mysqli_fetch_assoc($get_user);
        $user_name = $comment['user_name'];
        $comment_date = convertLastVisitDate($comment['date']);
        $comment_date_txt = convertDateTime($comment['date']);
        /*html output*/
        ?>
        <div class="user-and-date">
            <span class="user"><?= $user_name; ?></span>
            <span class="date" title="<?= $comment_date_txt;?>"><?= $comment_date;?></span>
        </div>
        <div class="comment-body"><em class="deleted">Comentario eliminado</em></div>
        <?php
    }
}