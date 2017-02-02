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

/* remove all session variables */
session_unset();
/* destroy the session */
session_destroy();
header('Location: ../index.php');