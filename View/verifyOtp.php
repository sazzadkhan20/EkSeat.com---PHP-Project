<?php include_once 'nevigationBar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css " />
    <title>OTP Verification</title>
  </head>
  <body>
    <section id="otp-verification">
      <h2>Enter OTP</h2>
      <input
        type="text"
        id="verify_OTP"
        placeholder="Enter OTP"
        class="input-box"
      />
      <button class="btn"><a href="userRegister.php">Verify</a></button>
      <button class="btn"><a href="signUp.php">Resend OTP</a></button>
      <p id="errorMessage_OTP" style="color: red; display: none;"></p>
    </section>

    <?php include 'footer.html'; ?>
  </body>
</html>
