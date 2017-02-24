<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 07/02/2017
 * Time: 23:34
 */
session_start();
if (isset($_SESSION['user-id'])) {
    header('Location: ../index.php');
    exit();
}
if (!(isset($_GET['code']) && !empty($_GET['code']) AND isset($_GET['token']) && !empty($_GET['token']))) {
    exit('<code>not available: no data received.</code>');
}
require_once '../functions/class.user.php';
$newUser = new User();
$newDatabase = new Database();
$newDatabase = $newDatabase->classdbconnection();

$urlcode = base64_decode($_GET['code']);
$urlhash = $_GET['token'];

/*perform data search*/
$stmt = $newUser->runQuery("SELECT user_id, name FROM user WHERE user_id = ? AND hash = ?");
$stmt->bind_param('is', $urlcode, $urlhash);
$stmt->execute();
$result = $stmt->get_result();

$successful = null;
$pass = $repass = '';
/*check data validity*/
if ($stmt->execute() && $result->num_rows > 0) {
    $userRow = $result->fetch_assoc();
    $user_id = $userRow['user_id'];
    $user_name = $userRow['name'];
    // for invalidate the same url request again
    $newhash = md5(uniqid(rand()));

    if (isset($_POST['btn-resetp'])) {
        $pass = trim($_POST['in-pass']);
        $repass = trim($_POST['in-repass']);
        if (strlen($pass) < 6) {
            $msg = "Ingresar mínimo 6 caracteres para la nueva contraseña.";
        } elseif ($pass != $repass) {
            $msg = "Las contraseñas no coinciden.";
        } else {
            $password = password_hash($repass, PASSWORD_DEFAULT);
            $stmt = $newDatabase->prepare("UPDATE user SET password = ?, hash = ? WHERE user_id = ?");
            $stmt->bind_param('ssi', $password, $newhash, $user_id);
            if ($stmt->execute()) {
                $msg = '<span style="color: #4a8ecd">¡La contraseña fue restablecida!</span>';
                $successful = true;
                header('refresh: 4; login.php');
            } else {
                $msg = "No ha sido posible cambiar la contraseña. Por favor vuelva a intentar.";
            }
        }
    }
} else {
    exit('<div style="margin: 50px 0; text-align: center;">La dirección URL es inválida o es posible que haya espirado.</div>');
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Restablecer Contraseña de Usuario | Jubilados a Luchar</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/user-login.css">
</head>
<body>
<?php
include_once '../tools/main-header.php';
?>
<div class="main-container-login">
    <form class="frm-user-forgot-reset _radius3px" method="post" action="" autocomplete="off">
        <h3 class="titles">Restablecer Contraseña</h3>
        <p class="str-info">Hola, <?= $user_name;?>. Ingrese una nueva contraseña para su cuenta.</p>
        <div class="div-user-icon"><i class="cn user"></i></div>
        <div id="errors-login-form"><?php if (isset($msg)) echo $msg;?></div>
        <?php if (!$successful) { ?>
            <div class="div-fields">
                <label for="in-pass"><span class="_lbl-mode">Nueva contraseña:</span></label>
                <input type="password" id="in-pass" name="in-pass" maxlength="15" value="<?= $pass;?>" autofocus style="margin-bottom: 6px">
                <label for="in-repass"><span class="_lbl-mode">Repetir contraseña:</span></label>
                <input type="password" id="in-repass" name="in-repass" maxlength="15" value="<?= $repass;?>">
            </div>
            <button id="btn-resetp" name="btn-resetp" class="_btnDisabled">
                <i class="fa fa-angle-double-right"></i>
                <span>Restablecer</span>
            </button>
        <?php } ?>
    </form>
</div>
<?php
include_once '../tools/main-footer.php';
?>
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/initial-access.js"></script>
</body>
</html>