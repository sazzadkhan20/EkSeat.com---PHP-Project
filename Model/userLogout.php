<?php
    session_start();

    // Clear all cookies by setting expiration to past time
    setcookie("user_login", "", time() - 3600, "/");
    setcookie("login_time", "", time() - 3600, "/");
    setcookie("user_name", "", time() - 3600, "/");
    setcookie("user_phone","", time() - 3600, "/");
    setcookie("user_nid","", time() - 3600, "/");
    setcookie("user_address","", time() - 3600, "/");
    setcookie("user_totalTransaction","", time() - 3600, "/");
    setcookie("user_registerDate","", time() - 3600, "/");
    setcookie("user_points","", time() - 3600, "/");

    // Clear any session data
    session_unset();
    session_destroy();

    // Redirect to home page
    header("Location: ../View/home.php");
    exit();
?>