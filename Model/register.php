<?php
  session_start();
  include_once 'create.php';
  require_once 'query.php';
  $table_name = "userinfo";
  db_create($dbname); //Database creation
  table_create($dbname,$table_name,$cquserinfotable); //table creation

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
    $stmt = $conn->prepare($iquserinfotable);
    $stmt->bind_param("sssss",$nid,$name,$phone,$email,$password);
    $stmt->execute();
    header("Location: ../View/signIn.php");
    $stmt->close();
    $conn->close();
  }

?>