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

if ($result->num_rows > 0) {
    // Start the HTML table
    echo "<table border='1'>
            <tr>
                <th>User NID</th>
                <th>User Name</th>
                <th>User Phone</th>
                <th>User Email</th>
                <th>Actions</th>
            </tr>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['uNID'] . "</td>
                <td>" . $row['uName'] . "</td>
                <td>" . $row['uPhone'] . "</td>
                <td>" . $row['uEmail'] . "</td>
                <td>
                    <a href='http://localhost/EkSeat.com---PHP-Project/View/updateUserInfo.php?id=" . $row['uNID'] . "'> 📝Edit</a>
                </td>
              </tr>";
    }

    // Close the table
    echo "</table>";
} else {
    echo "0 results";
}

// Close the connection
$conn->close();

?>
