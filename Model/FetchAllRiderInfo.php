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
$sql = "SELECT * FROM driverinfo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start the HTML table
    echo "<table border='1'>
            <tr>
                <th>Driver NID</th>
                <th>Driver Name</th>
                <th>Driver Phone</th>
                <th>Driver Email</th>
            </tr>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['dNID'] . "</td>
                <td>" . $row['dName'] . "</td>
                <td>" . $row['dPhone'] . "</td>
                <td>" . $row['dEmail'] . "</td>
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
