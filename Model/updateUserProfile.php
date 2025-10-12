<?php
session_start();

require_once 'query.php';
require_once 'queryExecution.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name = $_POST['Name'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $nid = $_POST['NID'];
    $address = $_POST['Address'];

    $currentEmail = $_COOKIE['user_login']; // current email (used for update queries)
    $cookieExpiry = time() + (24 * 60 * 60); // 24 hours

    // update user name if changed
    if ($name !== $_COOKIE['user_name']) 
    {
        updateinfo($uquserinfotableforname, $name, $currentEmail);
        setcookie("user_name", $name, $cookieExpiry, "/");
    }

    // update user NID if changed
    if ($nid !== $_COOKIE['user_nid']) 
    {
        updateinfo($uquserinfotablefornid, $nid, $currentEmail);
        setcookie("user_nid", $nid, $cookieExpiry, "/");
    }

    // update user phone if changed
    if ($phone !== $_COOKIE['user_phone']) 
    {
        updateinfo($uquserinfotableforphone, $phone, $currentEmail);
        setcookie("user_phone", $phone, $cookieExpiry, "/");
    }

    // update user address if changed
    if ($address !== $_COOKIE['user_address']) 
    {
        updateinfo($uquserinfotableforaddress, $address, $currentEmail);
        setcookie("user_address", $address, $cookieExpiry, "/");
    }

    // update user email if changed
    if ($email !== $_COOKIE['user_login']) 
    {
        updateinfo($uquserinfotableforemail, $email, $currentEmail);
        setcookie("user_login", $email, $cookieExpiry, "/");
    }

    // Redirect to user profile page
    header("Location: ../View/userProfile.php");
    exit();
}
?>
