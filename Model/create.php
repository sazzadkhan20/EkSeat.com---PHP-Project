<?php
    function db_create($dbname)
    {
        $conn = new mysqli('localhost','root','');
        if($conn->connect_error)
        {
            die("MySQL Connection Failed".$conn->connect_error);
            exit();
        }
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        if($conn->query($sql) === false)
        {
            die("Error creating database: ".$conn->error);
            exit();
        }
        $conn->close();
    }

    function table_create($dbname, $tablename, $sql)
    {
        $conn = new mysqli('localhost','root','',''.$dbname);
        if($conn->connect_error)
        {
            die("MySQL Connection Failed".$conn->connect_error);
            exit();
        }
        $sql = "CREATE TABLE IF NOT EXISTS ".$tablename." (".$sql.")";
        if($conn->query($sql) === false)
        {
            die("Error creating table: ".$conn->error);
            exit();
        }
        $conn->close();
    }

?>