<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 01/02/2017
 * Time: 0:40
 */
if (!$table_field = $_POST['field']) {
    exit("<code>not available: no data received.</code>");
}
include_once '../../functions/functions.php';
include_once '../../functions/connection.php';
$conn = dbconnection();
$field_value = mysqli_real_escape_string($conn, testInput($_POST['value']));

/*find conflicts with unique-index fields if any*/
$sql = "SELECT COUNT(*) FROM admin WHERE $table_field = '$field_value'";
$sql = mysqli_query($conn, $sql);
$conflicts = mysqli_fetch_row($sql);
$conflicts = $conflicts[0];

/*output*/
if ($conflicts > 0) echo 'false'; // false for form hdn flag
else echo 'true'; // no conflicts

mysqli_close($conn);