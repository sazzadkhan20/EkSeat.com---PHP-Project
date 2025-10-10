<?php 
session_start();
require_once '../Model/checkCookie.php';

// Check if user is logged in using cookies
$isLoggedIn = checkAuthCookie();
$userName = getUserFromCookie();


// Dynamic navigation bar based on login status
    if ($isLoggedIn) {
        include_once 'userNavBar.php'; 
    } else {
        include_once 'nevigationBar.html';
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Forgot Password</title>
  </head>
  <body>
    <section class="forgetPassword">
    <form action = "../Model/resetPassword.php" method = "POST" id = "forgetPassword">
    <img src="Resources/logo2.jpg" alt="Logo1" class="box-logo" />

      <input type="password" name="newpassword" placeholder="New Password" class="input-box" required/>
      <input type="password" name="confirmpassword" placeholder="Confirm Password" class="input-box" required/>

      <button type="submit" class="btn">Confirm</button>
    </form>
  </section>

   <?php include 'footer.html'; ?>

  </body>
</html>
