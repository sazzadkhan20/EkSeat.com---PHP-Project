<?php
    include_once 'create.php';
    require_once 'query.php';
    $table_name = "userinfo";
    db_create($dbname); //Database creation
    table_create($dbname,$table_name,$cquserinfotable); //table creation

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    //Database connection
    $conn = new mysqli('localhost','root','','ekseat_com');
    if($conn->connect_error)
    die('Connection Failed : '.$conn->connect_error);
    else
    {
        $stmt = $conn->prepare($adquserinfotable);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
            exit();
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) 
        {
           if ($row['uPassword'] === $password)
                header("Location: ../View/home.php");
            else
                echo "Invalid Password";
        }
        else
            echo "Invalid Email";
        $stmt->close();
    }
    $conn->close();
?>