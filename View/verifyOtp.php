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
    <link rel="stylesheet" href="style.css " />
    <title>OTP Verification</title>
  </head>
  <body>
    <form action="../Controller/sendOtp.php" method="post"> 
    <section id="otp-verification">
      <h2>Enter OTP</h2>
      <input
        type="text"
        id="verify_OTP"
        name = "verify_OTP"
        placeholder="Enter OTP"
        class="input-box"
      />
      <p id="errorMessage" style="color: red; <?php echo (!isset($_SESSION['errorVerify'])) ? 'display: none;' : ''; ?>">
    <?php
    if (isset($_SESSION['errorVerify'])) {
        echo htmlspecialchars($_SESSION['errorVerify']);
        unset($_SESSION['errorVerify']);
    }
    ?>
    </p>
      <button type="submit" name="action" value="verify" class="btn">Verify</button>
    <button type="submit" name="action" value="resend" class="btn">Resend OTP</button>
    </section>
    </form>
    <?php include 'footer.html'; ?>
  </body>
</html>
