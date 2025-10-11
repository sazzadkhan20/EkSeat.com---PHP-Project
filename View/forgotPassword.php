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
    <form action = "../Model/resetPassword.php" method = "POST" id = "forgetPassword" onsubmit="return validatePasswordForm()">
    <img src="Resources/logo2.jpg" alt="Logo1" class="box-logo" />

      <input type="password" name="newpassword" placeholder="New Password" class="input-box" id="newpassword" required/>
      <input type="password" name="confirmpassword" placeholder="Confirm Password" class="input-box" id="confirmpassword" required/>
      <div style="margin-top: 5px; margin-bottom: 10px; width: 100%; text-align: left;">
        <input type="checkbox" id="showPasswordUser" style="margin-right:5px;">
        <label for="showPasswordUser" style="font-size: 14px;">Show Password</label>
     </div>
     <div>
        <p id="errorMessage" style="color: red; text-decoration: none;"></p>
     </div>

      <button type="submit" class="btn">Confirm</button>
    </form>
  </section>

  <script>
    function validatePasswordForm() {
      const password = document.getElementById("newpassword").value;
      const confirmPassword = document.getElementById("confirmpassword").value;
      const errorE1 = document.getElementById("errorMessage");

      if (password !== confirmPassword) {
        errorE1.textContent = "Passwords do not match.";
        return false;
      }

      if (password.length < 8) {
        errorE1.textContent = "Password must be at least 8 characters long.";
        return false;
      }
      // ✅ Password strength check
      if (!password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/)) {
          errorE1.textContent ="Password must be at least 8 characters long and include uppercase, lowercase, numbers, and special characters.";
          return false;
      }
      return true;

    }
      document.getElementById('showPasswordUser').addEventListener('change', function() {
      const newPwd = document.querySelector('input[name="newpassword"]');
      const confirmPwd = document.querySelector('input[name="confirmpassword"]');
      const type = this.checked ? 'text' : 'password';
      newPwd.type = type;
      confirmPwd.type = type;
  });

  </script>
   <?php include 'footer.html'; ?>

  </body>
</html>
