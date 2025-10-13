<?php
    session_start();
    require_once "query.php";
    require_once "queryExecution.php";

    $email = $_COOKIE['user_login'];
    $result = deleteinfo($dquserinfotable,$email);
    $ride_result = deleteinfo($dqridebookinghistorytable,$email);
    if ($result && $ride_result) 
        header("Location: userLogout.php");
    else 
        header("Location: ../View/userProfile.php");
?>