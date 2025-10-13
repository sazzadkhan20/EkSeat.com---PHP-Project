<?php

    session_start();

    require_once 'query.php';
    require_once 'queryExecution.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $fname = $_POST['FirstName'];
        $lname = $_POST['LastName'];
        $name = $_POST['FirstName'].' '.$_POST['LastName'];
        $email = $_POST['Email'];
        $phone = $_POST['Phone'];
        $address = $_POST['Address'];

        $currentEmail = $_COOKIE['driver_email']; // current email (driver for update queries)
        $cookieExpiry = time() + (24 * 60 * 60); // 24 hours

        // update driver name if changed
        if ($name !== $_COOKIE['driver_name']) 
        {
            updateinfo($uqdriverinfotableforname, $name, $currentEmail);
            setcookie("driver_name", $name, $cookieExpiry, "/");
        }

        // update driver phone if changed
        if ($phone !== $_COOKIE['driver_phone']) 
        {
            updateinfo($uqdriverinfotableforphone, $phone, $currentEmail);
            setcookie("driver_phone", $phone, $cookieExpiry, "/");
        }

        // update driver address if changed
        if ($address !== $_COOKIE['driver_address']) 
        {
            updateinfo($uqdriverinfotableforaddress, $address, $currentEmail);
            setcookie("driver_address", $address, $cookieExpiry, "/");
        }

        // update driver email if changed
        if ($email !== $_COOKIE['driver_email']) 
        {
            updateinfo($uqdriverinfotableforemail, $email, $currentEmail);
            setcookie("driver_email", $email, $cookieExpiry, "/");
        }

        // Redirect to user profile page
        header("Location: ../View/driverSettings.php");
        exit();
    }
?>
