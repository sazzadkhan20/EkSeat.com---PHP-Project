<?php

    session_start();

    // Unset (delete) all driver-related cookies
    setcookie("driver_email", "", time() - 3600, "/");
    setcookie("login_time", "", time() - 3600, "/");
    setcookie("driver_name", "", time() - 3600, "/");
    setcookie("driver_id", "", time() - 3600, "/");
    setcookie("driver_nid", "", time() - 3600, "/");
    setcookie("driver_phone", "", time() - 3600, "/");
    setcookie("driver_password", "", time() - 3600, "/");
    setcookie("driver_address", "", time() - 3600, "/");
    setcookie("driver_vechileType", "", time() - 3600, "/");
    setcookie("driver_transactionAmount", "", time() - 3600, "/");
    setcookie("driver_registerDate", "", time() - 3600, "/");
    setcookie("driver_points", "", time() - 3600, "/");

    session_unset();
    session_destroy();

    // Redirect after clearing
    header("Location: ../View/home.php");
    exit();
?>
