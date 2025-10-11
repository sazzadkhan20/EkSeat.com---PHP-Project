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
  <title>About EkSeat</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      margin: 0;
      background-color: #fafafa;
      color: #333;
    }

    /* Banner Section */
.banner {
  position: relative;
  text-align: center;
  color: white;
   margin-top: 80px;
}

.banner-img {
  width: 1000px;;
  height: 400px; /* Customize this height */
  object-fit: cover;
  filter: brightness(60%); /* Dark overlay effect */
}

.banner-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


    /* Company Details */
    #company-details {
      background-color: #dce6e9ff;
      padding: 60px 20px 80px;
    }

    #company-details .content {
      max-width: 1000px;
      margin: auto;
      text-align: left;
    }

    #company-details h2 {
      font-size: 30px;
      color: #111;
      margin-bottom: 20px;
      text-align: center;
    }

    #company-details p {
      font-size: 16px;
      color: #444;
      line-height: 1.8;
      margin-bottom: 20px;
      text-align: justify;
    }

    /* Info Cards */
    .info-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 24px;
      margin-top: 40px;
    }

    .card {
      background-color: #b9c2cd;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
    }

    .card h3 {
      color: #222;
      font-size: 20px;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 15px;
      color: #555;
      line-height: 1.6;
    }

    /* Responsive Footer Margin */
    footer {
      margin-top: 40px;
    }
  </style>
</head>
<body>

<section class="banner">
  <img src="Resources/banner.png" alt="EkSeat Banner" class="banner-img">
  <div class="banner-text">
    <h1>About EkSeat</h1>
    <p>Connecting people, drivers, and businesses through smart, safe, and sustainable mobility solutions.</p>
  </div>
</section>

  <!-- Company Details Section -->
  <section id="company-details">
    <div class="content">
      <h2>Who We Are</h2>
      <p><strong>EkSeat.com</strong> is a next-generation ride-sharing and delivery platform built to make everyday travel and transport simple, safe, and efficient. We connect people, drivers, and businesses through technology that ensures smooth rides, reliable deliveries, and trustworthy service — all in one place.</p>

      <p>Our mission is to empower both passengers and drivers by offering flexible earning opportunities and convenient travel options. Whether you’re booking a ride, sending a parcel, or managing business deliveries, EkSeat ensures transparency, affordability, and comfort at every step.</p>

      <p>Founded with a vision to redefine urban mobility, EkSeat continues to expand its network, enhance technology, and promote eco-friendly travel solutions. We believe in creating a connected world — one seat at a time.</p>



      <div class="info-cards">
        <div class="card">
          <h3>Our Mission</h3>
          <p>To make transportation and delivery accessible, affordable, and sustainable for everyone.</p>
        </div>

        <div class="card">
          <h3>Our Vision</h3>
          <p>To build a reliable platform that connects people and businesses through smart mobility and innovation.</p>
        </div>

        <div class="card">
          <h3>Our Values</h3>
          <p>Safety, transparency, sustainability, and respect — the core values that drive everything we do.</p>
        </div>
      </div>
    </div>
  </section>

  <?php include 'footer.html'; ?>

</body>
</html>
