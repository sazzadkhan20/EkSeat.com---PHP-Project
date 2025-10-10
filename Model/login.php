<?php
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
        {
            //Set session variables
            $_SESSION['user_email'] = $email;
            // Set cookies for 24 hours
            $login_time = time();
            $cookie_expiry = time() + (24 * 60 * 60); // 24 hours
            
            setcookie("user_login", $email, $cookie_expiry, "/");
            setcookie("login_time", $login_time, $cookie_expiry, "/");
            setcookie("user_name", $row['uName'], $cookie_expiry, "/"); // User's display name
            header("Location: ../View/home.php");
            exit();
        }
    }
    else
    {
        $result = emailVerify($adqdriverinfotable, $email);
        if($row = $result->fetch_assoc())
        {
            if ($row['dPassword'] === $password)
            {
                echo "Driver login - To be implemented";
                // //Set session variables
                // $_SESSION['user_email'] = $email;
                // // Set cookies for 24 hours
                // $login_time = time();
                // $cookie_expiry = time() + (24 * 60 * 60); // 24 hours
                
                // setcookie("user_login", $email, $cookie_expiry, "/");
                // setcookie("login_time", $login_time, $cookie_expiry, "/");
                // setcookie("user_name", $row['uName'], $cookie_expiry, "/"); // User's display name
                // header("Location: ../View/home.php");
                exit();
            }
            else
            {
                $_SESSION['errorSignIn'] = "Invalid Password";
                 header("Location: ../View/signIn.php");
            }
        }
        else
        {
            $_SESSION['errorSignIn'] = "Invalid E-mail/Phone";
            header("Location: ../View/signIn.php");
        }
    }
?>