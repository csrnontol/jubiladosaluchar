<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 19/02/2017
 * Time: 22:39
 */
if (!$do_step = $_POST['step']) {
    exit('<code>Content not available.</code>');
}
require_once '../../functions/functions.php';
require_once '../../functions/connection.php';
$conn = dbconnection();
$commentKey = base64_decode($_POST['key']);

/*
 * step: load comment form
 */
if ($do_step === 'load') {
    $get_comment = mysqli_query($conn, "SELECT content FROM comment WHERE comment_id = '$commentKey'");
    $get_comment = mysqli_fetch_assoc($get_comment);
    $comment = $get_comment['content'];
    $comment = str_replace('<br>', "\n", $comment);
    ?>
    <div class="edit-comment-container">
        <textarea class="txt-edit-comment" title="Modificación de comentario"><?= $comment; ?></textarea>
        <div class="div-buttons">
            <button class="btn-cancel-edit">Cancelar</button>
            <button class="btn-edit-comment _btnDisabled">Editar</button>
        </div>
        <input type="hidden" class="hdn-edit-comment-value" value="<?= $comment; ?>">
    </div>
    <?php
}

/*
 * step: update comment
 */
elseif ($do_step === 'update') {
    require_once '../../functions/class.user.php';
    $newDatabase = new Database();
    $newDatabase = $newDatabase->classdbconnection();
    $commentContent = trim($_POST['content']);
    $commentContent = htmlspecialchars($commentContent);
    $commentContent = preg_replace('/\r\n|\r|\n/', '<br>', $commentContent);
    /* comment update statement */
    $stmt = $newDatabase->prepare("UPDATE comment SET content = ?, edited = 1 WHERE comment_id = ?");
    $stmt->bind_param('si', $commentContent, $commentKey);
    if ($stmt->execute()) {
        /* get inserted comment */
        $get_comment = "SELECT CMT.*, CONCAT(USR.name, ' ', USR.surname) AS user_name
        FROM comment CMT INNER JOIN user USR ON CMT.user_id = USR.user_id
        WHERE CMT.comment_id = '$commentKey'";
        $get_comment = mysqli_query($conn, $get_comment);
        $comment = mysqli_fetch_assoc($get_comment);

        $comment_content = $comment['content'];
        $comment_date = convertLastVisitDate($comment['date']);
        $comment_date_txt = convertDateTime($comment['date']);
        $comment_timestamp = convertDateTime($comment['timestamp']);
        $user_name = $comment['user_name'];

        $comment_reference = $comment['reference_comment_id'];
        $reference_flag = !($comment_reference == null || $comment_reference == '');
        if ($reference_flag) {
            /* get the replied comment user name */
            $get_ref_name = mysqli_query($conn,
            "SELECT CONCAT(USR.name, ' ', USR.surname) AS user_name
            FROM comment CMT
            INNER JOIN user USR ON CMT.user_id = USR.user_id
            WHERE CMT.comment_id = '$comment_reference'");
            $ref_user_name = mysqli_fetch_assoc($get_ref_name);
            $ref_user_name = $ref_user_name['user_name'];
        }
        ?>
        <div class="user-and-date">
            <span class="user">
                <?php
                echo $user_name;
                if ($reference_flag){
                    echo  ' <b>&rbarr;</b> <span class="ref-username">' . $ref_user_name . '</span> ';
                }
                ?>
            </span>
            <span class="date" title="<?= $comment_date_txt;?>"><?= $comment_date;?></span>
            <span title="<?= $comment_timestamp;?>">[editado]</span>
        </div>
        <div class="comment-body"><?= $comment_content;?></div>
        <div class="rate-reply">
            <a class="reply-comment-links" href="javascript:">Responder</a>
            <span class="rate-comment">
                <span class="up-votes"></span><i class="fa fa-thumbs-up"></i>
                <span class="down-votes"></span><i class="fa fa-thumbs-down"></i>
            </span>
            <div class="actions">
                <a class="edit-comment-links" title="Editar comentario"><i class="fa fa-edit"></i></a>
                <a class="delete-comment-links" title="Eliminar comentario"><i class="fa fa-remove"></i></a>
            </div>
        </div>
        <?php
    }
}