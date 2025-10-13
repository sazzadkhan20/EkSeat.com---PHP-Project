<?php
    
    session_start();
    require_once "query.php";
    $email = $_COOKIE['driver_email'];
    $conn = new mysqli('localhost','root','','ekseat_com');
    if($conn->connect_error)
    die('Connection Failed : '.$conn->connect_error);
    else
    {
        // Prepare and execute safely
        $stmt = $conn->prepare($dqdriverinfotable);
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) 
            header("Location: driverLogout.php");
        else 
            header("Location: ../View/driverActivity.php");
        $stmt->close();
    }
    $conn->close();
?>