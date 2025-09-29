<?php 
    session_start();
    include_once 'nevigationBar.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>sign In</title>
</head>

<body>
  <section>
    <form action = "../Model/login.php" method = "POST" id = "login">
    <img src="Resources/logo2.jpg" alt="Logo1" class="box-logo" />

      <input type="text" name="email" placeholder="email/phone" class="input-box" required/>
      <input type="password" name="password" placeholder="password" class="input-box" required/>
      <p id="errorMessage" style="color: red; <?php echo (!isset($_SESSION['errorSignIn'])) ? 'display: none;' : ''; ?>">
    <?php
    if (isset($_SESSION['errorSignIn'])) {
        echo htmlspecialchars($_SESSION['errorSignIn']);
        unset($_SESSION['errorSignIn']);
    }
    ?>
    </p>

      <button type="submit" class="btn">Sign in</button><br/>
      <a href="signUp.php?action=forgot" class="forgot">Forgot Password?</a><br />
      <small>Don't have an account? <a href="signUp.php?action=signup">Sign up</a></small>
    </form>
  </section>
 <?php include 'footer.html'; ?>
</body>

</html>