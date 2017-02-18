<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 30/01/2017
 * Time: 22:37
 */
ob_start();

session_start();
if (!isset($_SESSION['admin-id']) || $_SESSION['admin-master'] != 1) {
    exit('<code>Contenido no disponible.</code>');
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingresar Nuevo Administrador del Sistema</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/user-login.css">
</head>
<body>
<noscript class="no-script">
    Al parecer JavaScript está desactivado en el navegador.<br>
    La funcionalidad completa de esta página no estará disponible mientras JavaScript esté desactivado.<br>
    Se sugiere <a href="http://enable-javascript.com/es/" target="_blank">activar JavaScript</a> y volver a cargar esta página.
</noscript>
<div class="insert-new-item--div-container nuevo-usuario">
    <div class="div-special-header" style="width: 600px;">
        <div class="header-title">Crear Nueva Cuenta de Administrador</div>
        <div class="header-date"><?= strftime("(%d - %B - %Y)"); ?></div>
    </div>
    <section class="nuevo-usuario-section clearfix">
        <div class="back-to-index">
            <a href="../index.php" class="_hyperlink">&laquo; Ir a la página principal</a>
        </div>
        <main id="main-content" class="nuevo-usuario">
            <div style="position: relative;">
                <form id="frm-nuevo-usuario" method="post" action="" autocomplete="off">
                    <div class="name">
                        <div class="user-name" style="width: 380px;">
                            <label for="in-user-name">Nombres:</label>
                            <input type="text" name="in-user-name" id="in-user-name" maxlength="40">
                            <span id="error-name"></span>
                        </div>
                    </div>
                    <div class="email-username">
                        <div class="user-username">
                            <label for="in-user-username">Nombre de usuario:</label>
                            <input type="text" name="in-user-username" id="in-user-username" data-unique="true" maxlength="20">
                            <span id="error-username"></span>
                        </div>
                        <div class="user-email">
                            <label for="in-user-email">E-mail:</label>
                            <input type="email" name="in-user-email" id="in-user-email" data-unique="true">
                            <span id="error-email"></span>
                        </div>
                    </div>
                    <div class="pass-repass">
                        <div class="user-password">
                            <label for="in-user-password">Contraseña:</label>
                            <input type="password" name="in-user-password" id="in-user-password" maxlength="15">
                            <span id="error-password"></span>
                        </div>
                        <div class="user-repassword">
                            <label for="in-user-repassword">Repetir contraseña:</label>
                            <input type="password" name="in-user-repassword" id="in-user-repassword" maxlength="15">
                            <span id="error-repassword"></span>
                        </div>
                    </div>
                    <div class="button-section">
                        <span class="insert-item--processing-gif"></span>
                        <div id="divbtn-submit-usuario" class="_thin-btn _radius3px">Crear Cuenta</div>
                    </div>
                </form>
            </div>
        </main>
    </section>
</div>
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/admin/functions-admin.js"></script>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../functions/functions.php';
    require_once '../functions/connection.php';
    $conn = dbconnection();

    /* post form data */
    $user_name = mb_convert_case(mysqli_real_escape_string($conn, testInput($_POST['in-user-name'])), MB_CASE_TITLE, "UTF-8");
    $user_username = mysqli_real_escape_string($conn, testInput($_POST['in-user-username']));
    $user_email = $_POST['in-user-email'];
    $user_password = password_hash($_POST['in-user-password'], PASSWORD_DEFAULT);

    /* insert admin query */
    $sqlin_admin = "INSERT INTO admin (name, email, username, password) 
    VALUES ('$user_name', '$user_email', '$user_username', '$user_password')";
    if (mysqli_query($conn, $sqlin_admin)) {
        header('Location: new-user-result.php?queryresult=success');
    } else {
        header('Location: new-user-result.php?queryresult=error');
    }
    exit();
}
ob_end_flush();
