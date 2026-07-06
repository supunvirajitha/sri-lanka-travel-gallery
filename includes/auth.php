<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
    Admin Login Details

    Username: admin
    Password: admin123

    You can change these values later.
*/
define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "admin123");

function is_admin_logged_in() {
    return isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true;
}

function require_admin_login() {
    if (!is_admin_logged_in()) {
        header("Location: admin-login.php");
        exit;
    }
}

?>
