<?php
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    //Database connection
    $conn = new mysqli('localhost','root','','ekseat_com');
    if($conn->connect_error)
    die('Connection Failed : '.$conn->connect_error);
    else
    {
        $query = "SELECT * FROM userinfo WHERE uEmail='$email'";
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
        if($row >= 1)
        {
            if($row['uPassword'] == $password)
                header("Location: home.html");
            else
            {
                echo "Invalid Password";
                //header("Location: signIn.html");
            }
        }
        else
        {
            echo "Invalid Email";
        }
        $conn->close();
  }
?>