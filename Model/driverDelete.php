<?php
    session_start();
    require_once "query.php";
    require_once "queryExecution.php";

    $email = $_COOKIE['driver_email'];
    $result = deleteinfo($dqdriverinfotable,$email);
    if ($result) 
        header("Location: driverLogout.php");
    else 
        header("Location: ../View/driverActivity.php");
?>