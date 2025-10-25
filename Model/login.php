<?php
    session_start();

    require_once 'create.php';
    require_once 'query.php';
    require_once 'queryExecution.php';
    $table_name = "userinfo";
    db_create($dbname); //Database creation
    table_create($dbname,$table_name,$cquserinfotable); //table creation

    // Helper function: if value is null, empty, or '-', store "N/A"
    function valueOrNA($value) {
        return (empty($value) || $value === '-' || $value === null) ? 'N/A' : $value;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = emailVerify($adquserinfotable, $email);
    // Set cookies for 24 hours
    $login_time = time();
    $cookie_expiry = time() + 24*60*60; // 24 hours
    if ($row = $result->fetch_assoc()) 
    {
        // User Panel
        if ($row['uPassword'] === $password)
        {
            //Set session variables
            $_SESSION['user_email'] = $email;
            
            // Set Cookies for User
            setcookie("user_login", $email, $cookie_expiry, "/");
            setcookie("login_time", $login_time, $cookie_expiry, "/");
            setcookie("user_name", $row['uName'], $cookie_expiry, "/");
            setcookie("user_phone",$row['uPhone'], $cookie_expiry, "/");
            setcookie("user_nid", $row['uNID'], $cookie_expiry, "/");
            setcookie("user_address", valueOrNA($row['uAddress'] ?? ''), $cookie_expiry, "/");
            setcookie("user_totalTransaction", $row['uTransactionAmount'], $cookie_expiry, "/");
            setcookie("user_registerDate", $row['uregisterDate'], $cookie_expiry, "/");
            setcookie("user_points", $row['uPoints'], $cookie_expiry, "/");

            header("Location: ../View/home.php");
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
        // Driver Panel
        $result = emailVerify($adqdriverinfotable, $email);
        if($row = $result->fetch_assoc())
        {
            if ($row['dPassword'] === $password)
            {
                header("Location: ../View/driverActivity.php");
                // Set session variables
                $_SESSION['driver_email'] = $email;
                
                // Set Cookies for Driver
                setcookie("driver_email", $email, $cookie_expiry, "/");
                setcookie("login_time", $login_time, $cookie_expiry, "/");
                setcookie("driver_name", $row['dName'], $cookie_expiry, "/");
                setcookie("driver_id", $row['dID'], $cookie_expiry, "/");
                setcookie("driver_nid", $row['dNID'], $cookie_expiry, "/");
                setcookie("driver_phone", $row['dPhone'], $cookie_expiry, "/");
                setcookie("driver_password", $row['dPassword'], $cookie_expiry, "/");
                setcookie("driver_address", $row['dAddress'], $cookie_expiry, "/");
                setcookie("driver_vechileType", $row['dVehicleType'], $cookie_expiry, "/");
                setcookie("driver_transactionAmount", $row['dTransactionAmount'], $cookie_expiry, "/");
                setcookie("driver_registerDate", $row['dregisterDate'], $cookie_expiry, "/");
                setcookie("driver_points", $row['dPoints'], $cookie_expiry, "/");
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
            // Admin Panel
            $result = emailVerify($adqadmininfotable, $email);
            if($row = $result->fetch_assoc())
            {
                if ($row['aPassword'] === $password)
                {
                    header("Location: ../View/adminDashboard.php");
                    $_SESSION['admin_email'] = $email;
                
                    // Set Cookies for Admin
                    setcookie("admin_email", $email, $cookie_expiry, "/");
                    setcookie("login_time", $login_time, $cookie_expiry, "/");
                    setcookie("admin_name", $row['aName'], $cookie_expiry, "/");
                    setcookie("admin_id", $row['aID'], $cookie_expiry, "/");
                    setcookie("admin_nid", $row['aNID'], $cookie_expiry, "/");
                    setcookie("admin_phone", $row['aPhone'], $cookie_expiry, "/");
                    setcookie("admin_password", $row['aPassword'], $cookie_expiry, "/");
                    setcookie("admin_address", $row['aAddress'], $cookie_expiry, "/");
                    setcookie("admin_joiningDate", $row['aJoiningDate'], $cookie_expiry, "/");
                    setcookie("admin_role", $row['aRole'], $cookie_expiry, "/");
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
   }
?>