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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EkSeat Bike Details</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f9fb;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: flex-start;
      gap: 20px;
      padding: 60px 80px;
      margin-top: 50px;
    }

    .bike-image {
      flex: 1;
      min-width: 320px;
      text-align: center;
    }

    .bike-image img {
      width: 100%;
      max-width: 550px;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

  .image-gallery {
  display: flex;
  justify-content: center;  /* center horizontally */
  flex-wrap: wrap;
  gap: 30px;
  margin: 50px auto;        /* spacing above/below and centered */
  max-width: 900px;         /* optional: prevent it from stretching too wide */
  text-align: center;
}
.image-gallery img {
  width: 180px;
  height: 200px;
  object-fit: cover;
  border-radius: 10px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
  transition: transform 0.3s ease;
  cursor: pointer;
}
.image-gallery img:hover {
  transform: scale(1.05);
}


    .bike-details {
      flex: 1;
      min-width: 320px;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .bike-details h2 {
      color: #0d3251ff;
      margin-bottom: 10px;
    }

    .bike-details p {
      line-height: 1.6;
      color: #555;
     
    }

    ul {
      margin-top: 15px;
      padding-left: 20px;
    }

    li {
      margin-bottom: 8px;
    }

    .book-btn {
      display: inline-block;
      background-color: #0a0d32ff;
      color: white;
      border: none;
      padding: 12px 28px;
      border-radius: 8px;
      margin-top: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .book-btn:hover {
      background-color: #03081fff;
    }

    .how-it-works {
      text-align: center;
      background-color: #fff;
      padding: 50px 20px;
      margin: 40px 0;
    }

    .how-it-works h2 {
      color: #0d3251ff;
      margin-bottom: 10px;
    }

    .steps {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 25px;
      margin-top: 30px;
    }

    .step {
      background-color: #f2f7f3;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
      width: 220px;
      transition: 0.3s;
    }

    .step:hover {
      transform: translateY(-5px);
    }

    .step h3 {
      color: #0d3251ff;
    }
  </style>
</head>
<body>

 <div class="container">
  <div class="bike-image">
    <img src="Resources/bike.png" alt="EkSeat Bike" />
  </div>

  <div class="bike-details">
    <h2>EkSeat Bike Ride</h2>
    <p>Fast, affordable motorcycle rides to beat city traffic and get to your destination quickly. Book now for a smooth, safe, and budget-friendly ride experience with trained drivers and regular vehicle maintenance.</p>

    <ul>
      <li>✅ Fastest way through city traffic</li>
      <li>✅ Most affordable solo ride option</li>
      <li>✅ Helmet provided for every trip</li>
      <li>✅ 24/7 customer support</li>
      <li>✅ GPS tracking for safety</li>
    </ul>

    <p><strong>Price:</strong> Starts at Tk 50 + Tk 15 per km</p>

    <button class="book-btn" onclick="window.location.href='ride.php'">Book Now</button>
  </div>
</div>

<!-- Image gallery OUTSIDE the container for full width -->
<div class="image-gallery">
  <img src="Resources/sidebike.png" alt="Bike Side View">
  <img src="Resources/bike2.png" alt="Bike on Road">
  <img src="Resources/helmet.png" alt="Helmet Safety">
  <img src="Resources/urban.png" alt="Urban Ride">
</div>


  <section class="how-it-works">
    <h2>How It Works</h2>
    <div class="steps">
      <div class="step">
        <h3>1. Book a Ride</h3>
        <p>Enter your destination and confirm pickup location.</p>
      </div>
      <div class="step">
        <h3>2. Get Matched</h3>
        <p>We connect you with a nearby trained bike partner.</p>
      </div>
      <div class="step">
        <h3>3. Ride Safely</h3>
        <p>Track your trip and enjoy the journey.</p>
      </div>
      <div class="step">
        <h3>4. Arrive & Pay</h3>
        <p>Hop off and pay automatically through the app.</p>
      </div>
    </div>
  </section>
<?php include 'footer.html'; ?>
</body>
</html>
