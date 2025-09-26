<?php include_once 'nevigationBar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Sign Up</title>
  </head>
  <body>
    <form action="verifyOtp.php" method="post">
    <section id="signup">
      <img src="Resources/logo2.jpg" alt="Logo" class="box-logo" />
      <!-- Email input -->
      <input type="text" id="email" placeholder="Enter your email/phone" class="input-box" />
      <p id="errorMessage_SignUp" style="color: red; display: none;"></p>
      <!-- Verify button -->
      <button class="btn" type="submit">Send OTP</button>
    </section>
    </form>
   <?php include 'footer.html'; ?>
  </body>
</html>
