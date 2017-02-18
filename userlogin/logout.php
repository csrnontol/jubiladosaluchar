<?php
/**
 * Created by PhpStorm.
 * User: CYNR
 * Date: 07/02/2017
 * Time: 20:32
 */
session_start();
if (!isset($_SESSION['user-id'])) {
    header('Location: login.php');
    exit();
}

/* remove all session variables */
session_unset();
/* destroy the session */
session_destroy();
header('Location: ../index.php');
exit();