<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 15/02/2017
 * Time: 12:54
 */
session_start();
error_reporting(E_ALL ^ E_NOTICE);
if (!$article_key = base64_decode($_POST['key'])) {
    exit('<code>Content not available.</code>');
}
require_once '../../functions/functions.php';
require_once '../../functions/connection.php';
$conn = dbconnection();

/* check user and admin sesion */
$onsession = isset($_SESSION['user-id']) ? 'true' : 'false';
$usersession = isset($_SESSION['user-id']);
$adminsession = isset($_SESSION['admin-id']);

$get_comments = "SELECT CMT.*, CONCAT(USR.name, ' ', USR.surname) AS user_name,
USR.picture AS user_picture, USR.username AS user_username, USR.user_id AS u_user_id
FROM comment CMT
INNER JOIN article ART ON CMT.article_id = ART.article_id
INNER JOIN user USR ON CMT.user_id = USR.user_id
WHERE ART.article_id = '$article_key' AND CMT.parent_comment_id IS NULL
ORDER BY CMT.date DESC";
$get_comments = mysqli_query($conn, $get_comments);

while ($comments = mysqli_fetch_assoc($get_comments)) {
    $comment_id = base64_encode($comments['comment_id']);
    $comment_content = $comments['content'];
    $comment_date = convertLastVisitDate($comments['date']);
    $comment_date_txt = convertDateTime($comments['date']);
    $user_id = $comments['u_user_id'];
    $user_name = $comments['user_name'];
    $user_username = $comments['user_username'];
    $user_picture = $comments['user_picture'];
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
                            <span class="date" title="<?= $comment_date_txt;?>"><?= $comment_date;?></span>
                            <?php
                            if ($usersession || $adminsession) {
                                echo '<div class="actions">';
                                if ($usersession && $user_id == $_SESSION['user-id']) {
                                    echo '<a class="edit-comment-links"><i class="fa fa-edit"></i></a>';
                                }
                                if ($adminsession || $user_id == $_SESSION['user-id']) {
                                    echo '<a class="delete-comment-links"><i class="fa fa-remove"></i></a>';
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="comment-body"><?= $comment_content;?></div>
                        <div class="rate-reply" data-onsession="<?= $onsession;?>">
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
            <div class="div-comment-replies">
                <?php
                /* find comment replies */
                $current_comment_id = base64_decode($comment_id);
                $get_replies = "SELECT CMT.*, CONCAT(REPLYUSR.name, ' ', REPLYUSR.surname) AS user_name,
                REPLYUSR.picture AS user_picture, REPLYUSR.username AS user_username, REPLYUSR.user_id AS u_user_id
                FROM comment CMT
                INNER JOIN user REPLYUSR ON CMT.user_id = REPLYUSR.user_id
                WHERE parent_comment_id = '$current_comment_id'
                ORDER BY CMT.date";
                $get_replies = mysqli_query($conn, $get_replies);
                while ($comment_replies = mysqli_fetch_assoc($get_replies)) {
                    $rep_comment_reference = $comment_replies['reference_comment_id'];
                    $rep_comment_id = base64_encode($comment_replies['comment_id']);
                    $rep_comment_content = $comment_replies['content'];
                    $rep_comment_date = convertLastVisitDate($comment_replies['date']);
                    $rep_comment_date_txt = convertDateTime($comment_replies['date']);
                    $rep_user_id = $comment_replies['u_user_id'];
                    $rep_user_name = $comment_replies['user_name'];
                    $rep_user_username = $comment_replies['user_username'];
                    $rep_user_picture = $comment_replies['user_picture'];
                    $rep_feferenceFlag = $rep_comment_reference != null || $rep_comment_reference != '';
                    /*verify if comment has reference*/
                    if ($rep_feferenceFlag) {
                        $get_ref_user = "SELECT CONCAT(REFUSER.name, ' ', REFUSER.surname) AS user_name
                        FROM comment CMT
                        INNER JOIN user REFUSER ON CMT.user_id = REFUSER.user_id
                        WHERE CMT.comment_id = '$rep_comment_reference'";
                        $get_ref_user = mysqli_query($conn, $get_ref_user);
                        $ref_user = mysqli_fetch_assoc($get_ref_user);
                        $ref_user = $ref_user['user_name'];
                    }
                    ?>
                    <div data-key="<?= $rep_comment_id;?>" class="comment-first">
                        <div class="comment-second clearfix">
                            <div class="user-picture">
                                <img src="/jubiladosaluchar/img/user/<?= $rep_user_picture;?>" title="<?= $rep_user_username;?>">
                            </div>
                            <div class="comment-third">
                                <div class="user-and-date">
                                    <span class="user">
                                        <?php
                                        echo $rep_user_name;
                                        if ($rep_feferenceFlag) {
                                            echo  ' <b>&rbarr;</b> <span class="ref-username">' . $ref_user . '</span> ';
                                        }
                                        ?>
                                    </span>
                                    <span class="date" title="<?= $rep_comment_date_txt;?>"><?= $rep_comment_date;?></span>
                                    <?php
                                    if ($usersession || $adminsession) {
                                        echo '<div class="actions">';
                                        if ($usersession && $rep_user_id == $_SESSION['user-id']) {
                                            echo '<a class="edit-comment-links"><i class="fa fa-edit"></i></a>';
                                        }
                                        if ($adminsession || $rep_user_id == $_SESSION['user-id']) {
                                            echo '<a class="delete-comment-links"><i class="fa fa-remove"></i></a>';
                                        }
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                                <div class="comment-body"><?= $rep_comment_content;?></div>
                                <div class="rate-reply" data-onsession="<?= $onsession;?>">
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
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}