<?php
/**
 * Created by PhpStorm.
 * User: Kinsky
 * Date: 24/01/2017
 * Time: 11:44 PM
 */

function dbconnection() {
    $server = 'localhost';
    $database = 'jubiladosaluchar';
    $username = 'root';
    $password = '';

    $conn = mysqli_connect($server, $username, $password);

    if (mysqli_connect_errno()) {
        die("Error al establecer la conexión: " . mysqli_connect_error());
    }
    mysqli_select_db($conn, $database);

    mysqli_set_charset($conn, 'utf8');

    return $conn;
}