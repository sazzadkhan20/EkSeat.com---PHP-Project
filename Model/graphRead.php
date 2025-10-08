<?php
// Set header for JSON response
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graph_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize main array
$graphArray = [];

// Query to get all graph data
$sql = "SELECT main_loc, connected_loc FROM graph_connections";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mainLocation = $row['main_loc'];
        $connectionsString = $row['connected_loc'];
        
        // Initialize sub-array for this main location if not exists
        if (!isset($graphArray[$mainLocation])) {
            $graphArray[$mainLocation] = [];
        }
        
        // Parse connections string (format: Location1%Distance1@Location2%Distance2)
        $connections = explode('@', $connectionsString);
        
        foreach ($connections as $connection) {
            // Split each connection into location and distance
            $parts = explode('%', $connection);
            
            if (count($parts) >= 2) {
                $connectedLocation = $parts[0];
                
                // Extract distance number (remove "km" if present)
                $distance = floatval(preg_replace('/[^0-9.]/', '', $parts[1]));
                
                // Add to sub-array as [connectedLocation, distance]
                $graphArray[$mainLocation][] = [$connectedLocation, $distance];
            }
        }
    }
}

// Close connection
$conn->close();

// Output as JSON
echo json_encode($graphArray);
?>