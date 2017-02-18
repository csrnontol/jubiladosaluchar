<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 04/02/2017
 * Time: 13:32
 */
if (!$table = $_POST['table']) {
    exit("<code>not available: no data received.</code>");
}
require_once '../../functions/functions.php';
require_once '../../functions/connection.php';
$conn = dbconnection();
require_once '../../functions/class.user.php';
$newDatabase = new Database();
$newDatabase = $newDatabase->classdbconnection();
$field_value = mysqli_real_escape_string($conn, testInput($_POST['value']));

/*get data and verify*/
$sql = $newDatabase->prepare("SELECT COUNT(*) FROM $table WHERE username = ? OR email = ?");
$sql->bind_param('ss', $field_value, $field_value);
if ($sql->execute()) {
    $res = $sql->get_result();
    $row = $res->fetch_row();
    $row = $row[0];
    if ($row == 1) echo 'true';
    else echo 'false';
} else {
    echo 'error';
}