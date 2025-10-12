<?php
    session_start();
    $email = $_POST['email'];

    //Email validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid E-mail/Phone";
        header("Location: ../View/signUp.php");
        exit();
    }
    require_once 'create.php';
    require_once 'query.php';
    require_once 'queryExecution.php';
    
    $table_name = "userinfo";
    db_create($dbname); //Database creation
    table_create($dbname,$table_name,$cquserinfotable); //table creation
    $result = emailVerify($adquserinfotable, $email);
    if($_SESSION['otp_action'] === "forgot")
    {
        if ($row = $result->fetch_assoc()) 
        {
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = "user";
            sendOTP();
            header("Location: ../View/verifyOtp.php");
        } 
        else 
        {
            $result = emailVerify($adqdriverinfotable, $email);
            if ($row = $result->fetch_assoc()) 
            {
                $_SESSION['email'] = $email;
                $_SESSION['user_type'] = "driver";
                sendOTP();
                header("Location: ../View/verifyOtp.php");
            } 
            else
            {
                $_SESSION['errorSignUp'] = "E-mail/Phone not registered";
                unsetSession('email');
                header("Location: ../View/signUp.php");
            }
        }
    }
    else
    {
        if ($row = $result->fetch_assoc())
        {
            $_SESSION['errorSignUp'] = "E-mail/Phone already registered";
            unsetSession('email');
            header("Location: ../View/signUp.php");
        } 
        else 
        {
            $_SESSION['email'] = $email;
            sendOTP();
            header("Location: ../View/verifyOtp.php");
        }
    }

?>