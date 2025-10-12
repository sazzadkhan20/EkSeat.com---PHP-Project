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
  <title>Intercity Service</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 50px;
      background-color: #f9f9f9;
    }

    .top-images {
      display: flex;
      justify-content: center; /* centers images horizontally */
      gap: 300px; /* space between images */
      margin-bottom: 30px; /* space below images */
    }

    .top-images img {
      width: 500px;
      height: 400px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      margin-top: 10%;
    }

    .details {
      max-width: 900px;
      margin: 0 auto; /* centers content */
      text-align: left;
      font-size: 18px;
    }

    .details h2 {
      text-align: center;
      color: #304b66;
      margin-bottom: 20px;
    }

    .details ul {
      margin-left: 20px;
    }
  </style>
</head>
<body>

  <!-- Two top images -->
  <div class="top-images">
    <img src="Resources/intercity1.png" alt="Intercity 1">
    <img src="Resources/ride1.png" alt="Intercity 2">
  </div>

  <!-- Text Details -->
  <div class="details">
    <h2>Welcome to Our Service</h2>
    <p>EkSeat Intercity connects cities with comfortable, reliable, and affordable transportation. Travel between urban centers without the hassle of bus stations or train schedules.</p>
    
    <h3>Key Features:</h3>
    <ul>
      <li>Travel between major cities and suburbs</li>
      <li>Comfortable vehicles for longer journeys</li>
      <li>Fixed pricing between city pairs</li>
      <li>Multiple pickup and drop-off locations</li>
      <li>Professional drivers familiar with intercity routes</li>
    </ul>
    
    <h3>Popular Routes:</h3>
    <ul>
      <li>Downtown to suburban business districts</li>
      <li>Airport transfers to neighboring cities</li>
      <li>University towns to metropolitan areas</li>
      <li>Weekend getaways to nearby tourist destinations</li>
    </ul>
    
    <p><strong>🏷️Pricing:</strong> Fixed fares between city pairs starting at Taka 1,500. Book in advance for the best rates.</p><br></br>
  </div>

<?php include 'footer.html'; ?>
</body>
</html>
