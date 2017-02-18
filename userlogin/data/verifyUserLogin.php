<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 04/02/2017
 * Time: 22:42
 */
session_start();
if (!$table = $_POST['table']) {
    exit("<code>not available: no data received.</code>");
}
require_once '../../functions/functions.php';
require_once '../../functions/connection.php';
$conn = dbconnection();
require_once '../../functions/class.user.php';
$newDatabase = new Database();
$newDatabase = $newDatabase->classdbconnection();
$user_value = mysqli_real_escape_string($conn, testInput($_POST['user']));
$pass_value = mysqli_real_escape_string($conn, testInput($_POST['pass']));

/*get data and verify*/
$sql = $newDatabase->prepare("SELECT * FROM $table WHERE username = ? OR email = ?");
$sql->bind_param('ss', $user_value, $user_value);
if ($sql->execute()) {
    $res = $sql->get_result();
    $row = $res->fetch_assoc();
    if ($res->num_rows == 1) {
        /*verify valid password*/
        if (password_verify($pass_value, $row['password'])) {
            /*verify if user is active*/
            if ($row['active'] == 1) {
                $_SESSION['user-id'] = $row['user_id'];
                $_SESSION['user-name'] = $row['name'];
                $_SESSION['user-surname'] = $row['surname'];
                $_SESSION['user-email'] = $row['email'];
                $_SESSION['user-username'] = $row['username'];
                $_SESSION['user-picture'] = $row['picture'];
                echo 'true';
            } else {
                echo 'inactive';
            }
        } else {
            echo 'false';
        }
    } else {
        echo 'false';
    }
} else {
    echo 'error';
}