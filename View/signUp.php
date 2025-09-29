<?php 
    include_once 'nevigationBar.html'; 
    session_start();
    $action = $_GET['action'] ?? '';

    if ($action === "forgot") {
        // Store somewhere (session or hidden field)
        $_SESSION['otp_action'] = "forgot";
    } elseif ($action === "signup") {
        $_SESSION['otp_action'] = "signup";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Sign Up</title>
  </head>
  <body>
    <form action="../Model/emailVerify.php" method="post">
    <section id="signup">
      <img src="Resources/logo2.jpg" alt="Logo" class="box-logo" />
      <!-- Email input -->
      <input type="text" id="email" name = 'email' placeholder="Enter your email/phone" class="input-box" />
       <p id="errorMessage" style="color: red; <?php echo (!isset($_SESSION['error'])) ? 'display: none;' : ''; ?>">
    <?php
    if (isset($_SESSION['error'])) {
        echo htmlspecialchars($_SESSION['error']);
        unset($_SESSION['error']);
    }
    ?>
    </p>
      <!-- Verify button -->
      <button class="btn" type="submit">Send OTP</button>
    </section>
    </form>
   <?php include 'footer.html'; ?>
  </body>
</html>
