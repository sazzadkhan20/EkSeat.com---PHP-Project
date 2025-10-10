<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Database configuration
$host = 'localhost';
$dbname = 'graph_db';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to fetch locations
    $stmt = $pdo->query("SELECT DISTINCT main_loc FROM graph_connections ORDER BY main_loc ASC");
    $locations = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo json_encode($locations);
    
} catch (PDOException $e) {
    // Log error and return empty array
    error_log("Database error: " . $e->getMessage());
    echo json_encode([]);
}
?>