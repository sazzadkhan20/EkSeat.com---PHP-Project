<?php
// process_booking.php

// Start session if needed
session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $pickup = $_POST['pickup'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $distance = $_POST['distance'] ?? '';
    $service_type = $_POST['service_type'] ?? '';
    $vehicle_type = $_POST['vehicle_type'] ?? '';
    $price = $_POST['price'] ?? '';
    $booking_type = $_POST['booking_type'] ?? '';
    
    // Validate required fields
    if (empty($pickup) || empty($destination) || empty($price)) {
        die("Error: Required fields are missing.");
    }
    
    // Sanitize data (basic sanitization)
    $pickup = htmlspecialchars($pickup);
    $destination = htmlspecialchars($destination);
    $distance = floatval($distance);
    $price = floatval($price);
    
    // Here you would typically:
    // 1. Save to database
    // 2. Send confirmation email
    // 3. Process payment
    // 4. etc
    echo "Booking Details:<br>";
    echo "Pickup: $pickup<br>"; 
    echo "Destination: $destination<br>";
    echo "Distance: $distance km<br>";
    echo "Service Type: $service_type<br>";
    echo "Vehicle Type: $vehicle_type<br>";
    echo "Price: $$price<br>";
    echo "Booking Type: $booking_type<br>";
    echo "Booking successful!";
}