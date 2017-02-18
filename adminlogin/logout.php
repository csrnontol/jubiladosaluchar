<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 01/02/2017
 * Time: 2:19
 */
session_start();
if (!isset($_SESSION['admin-id'])) {
    header('Location: login.php');
    exit();
}

/* remove all admin session variables */
unset($_SESSION['admin-id']);
if (isset($_SESSION['admin-name'])) {
    unset($_SESSION['admin-name']);
}
if (isset($_SESSION['admin-username'])) {
    unset($_SESSION['admin-username']);
}
if (isset($_SESSION['admin-email'])) {
    unset($_SESSION['admin-email']);
}
if (isset($_SESSION['admin-master'])) {
    unset($_SESSION['admin-master']);
}

header('Location: ../index.php');
exit();