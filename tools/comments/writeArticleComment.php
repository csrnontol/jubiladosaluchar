<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 15/02/2017
 * Time: 12:57
 */
session_start();
error_reporting(E_ALL ^ E_NOTICE);
if (!$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' || !isset($_SESSION['user-id'])) {
    exit('<code>Content not available.</code>');
}
$postData = json_decode(file_get_contents("php://input"));
$do_step = $postData->step;

/*
 * step: load comment form
 */
if ($do_step === 'load-form') {
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
            <textarea id="txt-new-comment" placeholder="Escriba su respuesta..."></textarea>
            <div class="div-buttons">
                <button class="btn-cancel-reply">Cancelar</button>
                <button id="btn-submit-comment" class="_btnDisabled">Responder</button>
            </div>
        </div>
    </div>
    <?php
}


/*
 * step: record comment
 */
elseif ($do_step === 'record') {
    require_once '../../functions/functions.php';
    require_once '../../functions/connection.php';
    $conn = dbconnection();
    require_once '../../functions/class.user.php';
    $newDatabase = new Database();
    $newDatabase = $newDatabase->classdbconnection();

    $article_id = base64_decode($postData->articleKey);
    $user_id = $_SESSION['user-id'];
    $comment_content = trim($postData->commentContent);
    $comment_content = htmlspecialchars($comment_content);
    $comment_content = preg_replace('/\r\n|\r|\n/', '<br>', $comment_content);
    $reference_flag = $postData->referenceFlag == 'true';
    $parent_comment = isset($postData->parentComment) ? base64_decode($postData->parentComment) : null;
    $reference_comment = $reference_flag && isset($postData->referenceComment) ? base64_decode($postData->referenceComment) : null;

    /* comment record statement */
    $stmt = $newDatabase->prepare("INSERT INTO comment (article_id, user_id, parent_comment_id, reference_comment_id, content, date) 
    VALUES (?, ?, ?, ?, ?, now())");
    $stmt->bind_param('iiiis', $article_id, $user_id, $parent_comment, $reference_comment, $comment_content);
    /* record comment */
    if ($stmt->execute()) {
        $comment_id = $stmt->insert_id;
        /* get inserted comment */
        $get_comment = "SELECT CMT.*, CONCAT(USR.name, ' ', USR.surname) AS user_name,
        USR.picture AS user_picture, USR.username AS user_username
        FROM comment CMT INNER JOIN user USR ON CMT.user_id = USR.user_id
        WHERE CMT.comment_id = '$comment_id'";
        $get_comment = mysqli_query($conn, $get_comment);
        $comment = mysqli_fetch_assoc($get_comment);

        $comment_id = base64_encode($comment['comment_id']);
        $comment_content = $comment['content'];
        $comment_date = convertLastVisitDate($comment['date']);
        $comment_date_txt = convertDateTime($comment['date']);
        $user_name = $comment['user_name'];
        $user_username = $comment['user_username'];
        $user_picture = $comment['user_picture'];

        /*** html output ***/
        if ($parent_comment) {
            if ($reference_flag) {
                /* get the replied comment user name */
                $get_ref_name = mysqli_query($conn, "SELECT CONCAT(USR.name, ' ', USR.surname) AS user_name
                FROM comment CMT
                INNER JOIN user USR ON CMT.user_id = USR.user_id
                WHERE CMT.comment_id = '$reference_comment'");
                $ref_user_name = mysqli_fetch_assoc($get_ref_name);
                $ref_user_name = $ref_user_name['user_name'];
            }
            ?>
            <div data-key="<?= $comment_id;?>" class="comment-first">
                <div class="comment-second clearfix">
                    <div class="user-picture">
                        <img src="/jubiladosaluchar/img/user/<?= $user_picture;?>" title="<?= $user_username;?>">
                    </div>
                    <div class="comment-third">
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
                        </div>
                        <div class="comment-body"><?= $comment_content;?></div>
                        <div class="rate-reply">
                            <a class="reply-comment-links" href="javascript:">Responder</a>
                            <span class="rate-comment">
                                <span class="up-votes"></span><i class="fa fa-thumbs-up"></i>
                                <span class="down-votes"></span><i class="fa fa-thumbs-down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="comment-form"></div>
            </div>
            <?php
        } else { // if comment is not a reply
            ?>
            <div data-key="<?= $comment_id;?>" class="main-comment-div">
                <div class="comment-and-replies">
                    <div data-key="<?= $comment_id;?>" class="comment-first">
                        <div class="comment-second clearfix">
                            <div class="user-picture">
                                <img src="/jubiladosaluchar/img/user/<?= $user_picture;?>" title="<?= $user_username;?>">
                            </div>
                            <div class="comment-third">
                                <div class="user-and-date">
                                    <span class="user"><?= $user_name;?></span>
                                    <span class="date" title="<?= $comment_date;?>"><?= $comment_date_txt;?></span>
                                </div>
                                <div class="comment-body"><?= $comment_content;?></div>
                                <div class="rate-reply">
                                    <a class="reply-comment-links" href="javascript:">Responder</a>
                                    <span class="rate-comment">
                                        <span class="up-votes"></span><i class="fa fa-thumbs-up"></i>
                                <span class="down-votes"></span><i class="fa fa-thumbs-down"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="comment-form"></div>
                    </div>
                    <div class="div-comment-replies"></div>
                </div>
            </div>
            <?php
        }
    } else {
        echo '<div class="insert-error">Error al ingresar el comentario. Por favor intente nuevamente.</div>';
    }
}