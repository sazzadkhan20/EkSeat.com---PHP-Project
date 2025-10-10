<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "ekseat_com"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Write a query to get all user data
$sql = "SELECT * FROM userinfo";
$result = $conn->query($sql);
echo "<h1>" . $result->num_rows . "</h1>";
echo "<p>Number of Riders</p>";

// Close the connection
$conn->close();

?>
    