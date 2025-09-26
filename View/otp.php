<?php 
    session_start();

    if ($_SESSION['otp_action'] === "forgot") {
        header("Location: forgotPassword.php");
        exit;
    } elseif ($_SESSION['otp_action'] === "signup") {
        header("Location: userRegister.php");
        exit;
   }
?>