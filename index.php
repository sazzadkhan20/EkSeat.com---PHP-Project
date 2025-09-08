<?php

$mysqli = new mysqli('localhost', 'root', '', 'ekseat_com');
if ($mysqli->connect_errno) {
  die('Database connection failed.');
}

// 2) Read form values
$email = $_POST['email'] ?? '';
$pass  = $_POST['password'] ?? '';

if ($email === '' || $pass === '') {
  die('Please enter email and password.');
}

// 3) Check email + password (plain text)
$stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ? AND password = ? LIMIT 1");
$stmt->bind_param("ss", $email, $pass);
$stmt->execute();
$stmt->store_result();

// 4) Redirect or show error
if ($stmt->num_rows === 1) {
  header("Location: Home.html");
  exit;
} else {
  echo "Invalid email or password.";
}

$stmt->close();
$mysqli->close();
