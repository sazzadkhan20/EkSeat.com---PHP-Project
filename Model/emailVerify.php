<?php
    session_start();
    $email = $_POST['email'];

    //Email validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid E-mail/Phone";
        header("Location: ../View/signUp.php");
        exit();
    }
    include_once 'create.php';
    require_once 'query.php';
    $table_name = "userinfo";
    db_create($dbname); //Database creation
    table_create($dbname,$table_name,$cquserinfotable); //table creation
    require_once 'queryExecution.php';
    $result = emailVerify($adquserinfotable, $email);
    if($_SESSION['otp_action'] === "signup") {
        if ($row = $result->fetch_assoc()) 
        {
            $_SESSION['error'] = "E-mail/Phone already registered";
            header("Location: ../View/signUp.php");
        } 
        else 
        {
            $_SESSION['email'] = $email;
            header("Location: ../View/verifyOtp.php");
        }
    }
    elseif($_SESSION['otp_action'] === "forgot") {
        if ($row = $result->fetch_assoc()) 
        {
            header("Location: ../View/verifyOtp.php");
        } 
        else 
        {
            $_SESSION['error'] = "E-mail/Phone not registered";
            header("Location: ../View/signUp.php");
        }
    } 
    else 
    {
        $_SESSION['error'] = "Invalid action";
        header("Location: ../View/signUp.php");
    }

?>