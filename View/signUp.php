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
    <div id="signup">
    <form action="../Model/emailVerify.php" method="post">
    
      <img src="Resources/logo2.jpg" alt="Logo" class="box-logo" />
      <!-- Email input -->
      <input type="text" id="email" name = 'email' placeholder="Enter your email/phone" class="input-box" />
       <p id="errorMessage" style="color: red; <?php echo (!isset($_SESSION['errorSignUp'])) ? 'display: none;' : ''; ?>">
    <?php
    if (isset($_SESSION['errorSignUp'])) {
        echo htmlspecialchars($_SESSION['errorSignUp']);
        unset($_SESSION['errorSignUp']);
    }
    ?>
    </p>
      <!-- Verify button -->
      <button class="btn" type="submit">Send OTP</button>
    
    </form>
    </div>
   <footer><?php include 'footer.html'; ?></footer>
  </body>
</html>
