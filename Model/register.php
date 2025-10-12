<?php
  session_start();
  
  require_once 'create.php';
  require_once 'query.php';

  db_create($dbname); //Database creation

  $user_type = $_POST['user_type'];
  $name = $_POST['Name'];
  $phone = $_POST['Phone'];
  $email = $_SESSION['email'];
  $nid = $_POST['NID'];
  $password = $_POST['password'];
  unset($_SESSION['email']);

  //Database connection
  $conn = new mysqli('localhost','root','','ekseat_com');
  if($conn->connect_error)
    die('Connection Failed : '.$conn->connect_error);
  else
  {
    if($user_type == "driver")
    {
          table_create($dbname,'driverinfo',$cqdriverinfotable); //table creation
          $address = $_POST['address'];
          $vehicleType = $_POST['vehicle_type'];
          // Prepare and bind
          $stmt = $conn->prepare($iqdriverinfotable);
          $stmt->bind_param("sssssss",$nid,$name,$phone,$email,$password,$address,$vehicleType);
          $stmt->execute();
          header("Location: ../View/drive.php");
          $stmt->close();
          $conn->close();
          exit();
    }
    else
    {
        table_create($dbname,'userinfo',$cquserinfotable); //table creation
        $stmt = $conn->prepare($iquserinfotable);
        $stmt->bind_param("sssss",$nid,$name,$phone,$email,$password);
        $stmt->execute();
        header("Location: ../View/signIn.php");
        $stmt->close();
        $conn->close();
        exit();
    }
  }

?>