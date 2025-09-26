<?php include_once 'nevigationBar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="../Controller/emailOTP.js"></script> -->
    <link rel="stylesheet" href="style.css" />
    <title>Sign Up</title>
  </head>
  <body>
    <section id="signup">
      <img src="Resources/logo2.jpg" alt="Logo" class="box-logo" />
      <!-- Email input -->
      <input type="text" id="email" placeholder="Enter your email/phone" class="input-box" />
      <p id="errorMessage_SignUp" style="color: red; display: none;"></p>
      <!-- Verify button -->
      <button class="btn" type="button" onclick="SentOTP()">Send OTP</button>
    </section>

   <?php include 'footer.html'; ?>
  </body>
</html>
