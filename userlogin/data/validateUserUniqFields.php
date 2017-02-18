<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 06/02/2017
 * Time: 11:25
 */
if (!$table = $_POST['table']) {
    exit("<code>not available: no data received.</code>");
}
include_once '../../functions/functions.php';
include_once '../../functions/connection.php';
$conn = dbconnection();
require_once '../../functions/class.user.php';
$newDatabase = new Database();
$newDatabase = $newDatabase->classdbconnection();

/*get post data*/
$table_field = $_POST['field'];
$field_value = mysqli_real_escape_string($conn, testInput($_POST['value']));

/*find conflicts with unique-index fields if any*/
$sql = $newDatabase->prepare("SELECT COUNT(*) FROM $table WHERE $table_field = ?");
$sql->bind_param('s', $field_value);
if ($sql->execute()) {
    $res = $sql->get_result();
    $row = $res->fetch_row();
    $conflicts = $row[0];
    /*output*/
    if ($conflicts > 0) echo 'false'; // false for form hdn flag
    else echo 'true'; // no conflicts
} else {
    echo 'true'; // no conflicts
}
$newDatabase->close();