<?php
  $name = $_POST['Name'];
  $phone = $_POST['Phone'];
  $email = $_POST['Email'];
  $nid = $_POST['NID'];
  $password = $_POST['password'];

  //Database connection
  $conn = new mysqli('localhost','root','','ekseat_com');
  if($conn->connect_error)
    die('Connection Failed : '.$conn->connect_error);
  else
  {
    $stmt = $conn->prepare("insert into userinfo(uNID,uName,uPhone,uEmail,uPassword) 
    values(?,?,?,?,?)");
    $stmt->bind_param("sssss",$nid,$name,$phone,$email,$password);
    $stmt->execute();
    header("Location: signIn.html");
    $stmt->close();
    $conn->close();
  }

?>