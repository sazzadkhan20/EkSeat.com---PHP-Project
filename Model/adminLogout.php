<?php

    session_start();

    // Unset (delete) all admin-related cookies
    setcookie("admin_email", "", time() - 3600, "/");
    setcookie("login_time", "", time() - 3600, "/");
    setcookie("admin_name", "", time() - 3600, "/");
    setcookie("admin_id", "", time() - 3600, "/");
    setcookie("admin_nid", "", time() - 3600, "/");
    setcookie("admin_phone", "", time() - 3600, "/");
    setcookie("admin_password", "", time() - 3600, "/");
    setcookie("admin_address", "", time() - 3600, "/");
    setcookie("admin_joiningDate", "", time() - 3600, "/");
    setcookie("admin_role", "", time() - 3600, "/");

    session_unset();
    session_destroy();

    // Redirect after clearing
    header("Location: ../View/signIn.php");
    exit();
?>
