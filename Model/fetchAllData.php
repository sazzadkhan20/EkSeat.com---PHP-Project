<?php

    require_once "query.php";

    function fetch_data($rquery)
    {
        $conn = new mysqli("localhost" ,"root", "", "ekseat_com");
        // Check connection
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        // Write a query to get all user data
        $result = $conn->query($rquery);
        return $result;
    }
?>