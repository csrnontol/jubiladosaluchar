<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 07/02/2017
 * Time: 17:59
 */
if (!(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token']))) {
    exit('<code>not available: no data received.</code>');
}
require_once '../functions/class.user.php';
$newUser = new User();
$newDatabase = new Database();
$newDatabase = $newDatabase->classdbconnection();

/*get the data*/
$email = $_GET['email'];
$token = $_GET['token'];
$statusY = 1;

/*perform data search*/
$search = $newUser->runQuery("SELECT user_id, active FROM user WHERE email = ? AND hash = ? LIMIT 1");
$search->bind_param('ss', $email, $token);
$search->execute();
$result = $search->get_result();

/*check data validity*/
if ($search->execute() && $result->num_rows > 0) {
    $userRow = $result->fetch_assoc();
    $user_id = $userRow['user_id'];
    $user_status = $userRow['active'];
    // for invalidate the same url request again
    $newhash = md5(uniqid(rand()));

    if ($user_status == 0) {
        $setactive = $newDatabase->prepare("UPDATE user SET active = ?, hash = ? WHERE user_id = ?");
        $setactive->bind_param('isi', $statusY, $newhash, $user_id);
        if ($setactive->execute()) {
            $msg = '<div class="successAlert">¡Su cuenta ha sido activada! Ahora ya puede <a href="login.php" class="_hyperlink">iniciar sesión</a>.</div>';
        } else {
            $msg = '<div class="errorAlert">No ha sido posible activar su cuenta. Intente más tarde.</div>';
        }
    } else {
        $msg = '<div class="infoAlert">Su cuenta actualmente está activada. Puede <a href="login.php" class="_hyperlink">iniciar sesión</a>.</div>';
    }

} else {
    $msg = '<div class="grayAlert">La dirección URL es inválida o es posible que haya espirado.</div>';
}
?>
<!doctype html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de Cuenta de Usuario &bull; Jubilados a Luchar</title>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/user-login.css">
    <link rel="stylesheet" type="text/css" href="../css/responsive.css">
</head>
<body>
<?php
include_once '../tools/main-header.php';
echoFormLogo();
?>
<div class="account-confirmation--container">
    <div class="confirmation-message">
        <?php if(isset($msg)) { echo $msg; } ?>
    </div>
</div>
<?php
include_once '../tools/main-footer.php';
?>
</body>
</html>