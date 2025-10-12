<?php 
session_start();
require_once '../Model/checkCookie.php';

// Check if user is logged in using cookies
$isLoggedIn = checkAuthCookie();
$userName = getUserFromCookie();

// Dynamic navigation bar based on login status
if ($isLoggedIn) {
    include_once 'userNavBar.php'; 
} else {
    include_once 'nevigationBar.html';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vehicle Rental Details | EkSeat.com</title>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    background-color: #f8f9fa;
    color: #333;
  }

  /* Header Banner */
  .banner {
    background: linear-gradient(135deg, #02172e, #033b6b);
    color: white;
    text-align: center;
    padding: 70px 20px;
    margin-top: 100px;
  }

  .banner h1 {
    font-size: 42px;
    margin-bottom: 10px;
  }

  .banner p {
    font-size: 18px;
    margin-top: 0;
  }

  /* Rental Section */
  .rental-section {
    padding: 60px 100px;
  }

  .rental-section h2 {
    text-align: center;
    font-size: 32px;
    margin-bottom: 40px;
    color: #02172e;
  }

.rental-cards {
  display: flex;
  justify-content: space-between;
  flex-wrap: nowrap;
  gap: 20px;
  overflow-x: auto; /* allows smooth scroll if needed */
  padding-bottom: 10px;
}

.rental-card {
  background: white;
  width: 250px; /* smaller width so 5 fit on large screens */
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  overflow: hidden;
  transition: transform 0.3s ease;
  flex-shrink: 0; /* prevent squishing */
}


  .rental-card:hover {
    transform: translateY(-8px);
  }

  .rental-card img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  .rental-info {
    padding: 20px;
  }

  .rental-info h3 {
    color: #033b6b;
    margin-bottom: 10px;
  }

  .rental-info p {
    margin: 5px 0;
    font-size: 15px;
  }

  .book-now {
    text-align: center;
    margin-top: 50px;
  }

  .book-btn {
    background-color: #02172e;
    color: white;
    padding: 14px 30px;
    border-radius: 8px;
    font-size: 16px;
    text-decoration: none;
    transition: 0.3s;
  }

  .book-btn:hover {
    background-color: #034078;
  }

  /* Footer */
  footer {
    background-color: #02172e;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 60px;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .rental-section {
      padding: 40px 20px;
    }

    .rental-cards {
      flex-direction: column;
      align-items: center;
    }

    .rental-card {
      width: 90%;
    }
  }
</style>
</head>
<body>

<!-- Banner Section -->
<div class="banner">
  <h1>Vehicle Rental Services</h1>
  <p>Find the perfect vehicle for your trip — car, bike, or van — at the best price.</p>
</div>

<!-- Rental Details Section -->
<section class="rental-section">
  <h2>Available Rentals</h2>

  <div class="rental-cards">

    <!-- Sedan -->
    <div class="rental-card">
      <img src="Resources/sedanCar.png" alt="Sedan Car">
      <div class="rental-info">
        <h3>Luxury Sedan</h3>
        <p>Elegant design and comfort for city or long rides.</p>
        <p><strong>Price:</strong> 1200 Tk/day</p>
        <p><strong>Features:</strong> AC, GPS, Bluetooth, Driver Included</p>
      </div>
    </div>

    <!-- SUV -->
    <div class="rental-card">
      <img src="Resources/suv.png" alt="SUV Car">
      <div class="rental-info">
        <h3>Family SUV</h3>
        <p>Spacious 7-seater for family or group travel.</p>
        <p><strong>Price:</strong> 1800 Tk/day</p>
        <p><strong>Features:</strong> AC, GPS, Child Seat, Luggage Space</p>
      </div>
    </div>

    <!-- Bike -->
    <div class="rental-card">
      <img src="Resources/motorbike.png" alt="Motorbike">
      <div class="rental-info">
        <h3>Motorbike</h3>
        <p>Perfect for quick rides and solo adventures.</p>
        <p><strong>Price:</strong> 400 Tk/day</p>
        <p><strong>Features:</strong> Helmet Provided, GPS Tracker</p>
      </div>
    </div>

    <!-- Scooter -->
    <div class="rental-card">
      <img src="Resources/scoter.png" alt="Electric Scooter">
      <div class="rental-info">
        <h3>Electric Scooter</h3>
        <p>Eco-friendly and easy to handle within the city.</p>
        <p><strong>Price:</strong> 300 Tk/day</p>
        <p><strong>Features:</strong> Helmet, Fast Charging, GPS Enabled</p>
      </div>
    </div>

    <!-- Microbus -->
    <div class="rental-card">
      <img src="Resources/micro.png" alt="Microbus">
      <div class="rental-info">
        <h3>Microbus</h3>
        <p>Perfect for group tours and long-distance travel.</p>
        <p><strong>Price:</strong> 2500 Tk/day</p>
        <p><strong>Features:</strong> 12-Seater, AC, Music System, Driver</p>
      </div>
    </div>

  </div>

  <div class="book-now">
    <a href="#" class="book-btn">Book Now</a>
  </div>
</section>

<?php include 'footer.html'; ?>

</body>
</html>
