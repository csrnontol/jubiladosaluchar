<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 03/02/2017
 * Time: 15:27
 */
if (!$do_step = $_POST['step']) {
    exit('<code>Contenido no disponible.</code>');
}
include_once '../../functions/connection.php';
$conn = dbconnection();
$row_id = base64_decode($_POST['key']);


/* step: load dialog window */
if ($do_step === 'load') {
    $sqlget_status = mysqli_query($conn, "SELECT active FROM article WHERE article_id = '$row_id'");
    $article_status = mysqli_fetch_assoc($sqlget_status);
    $article_status = $article_status['active'];
    $info_txt = $btn_txt = '';
    if ($article_status == 1) {
        $info_txt = "Al cambiar el estado a inactivo el artículo no será publicado en la página web.<br>";
        $info_txt .= "¿Cambiar el estado del artículo?";
        $btn_txt = "Cambiar";
    } elseif ($article_status == 0) {
        $info_txt = "Al cambiar el estado a activo el artículo será publicado en la página web.<br>";
        $info_txt .= "¿Publicar el artículo?";
        $btn_txt = "Publicar";
    }
    /*html output*/
    echo '<div class="mastercn-change-item-status--dialog _radius3px" data-key="'.$_POST['key'].'">';
    echo '<div class="dheader">';
    echo '<h3>Estado Artículo &ndash; Aviso de Evento</h3>';
    echo '</div>';
    echo '<div class="dbody">';
    echo '<div class="div-icon">';
    echo '<i class="fa fa-warning i-warning-item-status"></i>';
    echo '</div>';
    echo '<div class="div-content">';
    echo '<span>'.$info_txt.'</span>';
    echo '</div>';
    echo '</div>';
    echo '<div class="dfoot">';
    echo '<span class="change-article-status dialog-buttons do-step _noSelect">'.$btn_txt.'</span>';
    echo '<span class="dialog-buttons close-dialog _noSelect">Cancelar</span>';
    echo '</div>';
    echo '</div>';
}


/* step: record data */
elseif ($do_step === 'record') {
    $sqlup_status = "UPDATE article SET active = !active WHERE article_id = '$row_id'";
    if (mysqli_query($conn, $sqlup_status)) {
        $get_newstatus = mysqli_query($conn, "SELECT active FROM article WHERE article_id = '$row_id'");
        $newstatus = mysqli_fetch_assoc($get_newstatus);
        $newstatus = $newstatus['active'];
        $output_txt = '';
        if ($newstatus == 0) $output_txt = '<span class="inactive">Inactivo</span>';
        elseif ($newstatus == 1) $output_txt = '<span class="active">Publicado</span>';
        /*html output*/
        echo $output_txt;
    }
}
mysqli_close($conn);