<?php
    session_start();
    
    function emailVerify($rquery, $condition)
    {
        $conn = new mysqli('localhost','root','','ekseat_com');
        if($conn->connect_error)
        die('Connection Failed : '.$conn->connect_error);
        else
        {
            $stmt = $conn->prepare($rquery);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
                exit();
            }
            $stmt->bind_param("s", $condition);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
            $stmt->close();
        }
        $conn->close();
    }
?>