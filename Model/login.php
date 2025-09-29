<?php
    session_start();
    include_once 'create.php';
    require_once 'query.php';
    $table_name = "userinfo";
    db_create($dbname); //Database creation
    table_create($dbname,$table_name,$cquserinfotable); //table creation

    $email = $_POST['email'];
    $password = $_POST['password'];
    require_once 'queryExecution.php';
    $result = emailVerify($adquserinfotable, $email);
    if ($row = $result->fetch_assoc()) 
    {
        if ($row['uPassword'] === $password)
            header("Location: ../View/home.php");
        else
        {
            $_SESSION['error'] = "Invalid Password";
            header("Location: ../View/signIn.php");
        }
    }
    else
    {
        $_SESSION['error'] = "Invalid E-mail/Phone";
        header("Location: ../View/signIn.php");
    }
?>