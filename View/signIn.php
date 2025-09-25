<?php include_once 'nevigationBar.html'; ?>
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

      <button type="submit" class="btn">Sign in</button>

      <a href="#" class="forgot">Forgot Password?</a><br />
      <small>Don't have an account? <a href="signUp.php">Sign up</a></small>
  </section>
  </form>
</body>

</html>