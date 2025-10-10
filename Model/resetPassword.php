<?php
    require_once 'queryExecution.php';
    require_once 'query.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $newpassword = $_POST['newpassword'];
        if($_SESSION['user_type'] === "user")
            updateinfo($uquserinfotable, $newpassword, $_SESSION['email']);
        else if($_SESSION['user_type'] === "driver")
            updateinfo($uqdriverinfotable, $newpassword, $_SESSION['email']);
        else
        {
            //Admin Panel
            header("Location: ../View/forgotPassword.php");
        }
        unset($_SESSION['email']);
        unset($_SESSION['user_type']);
        header("Location: ../View/signIn.php");
    }
?>