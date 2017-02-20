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