<?php 
session_start();
require_once '../Model/checkCookie.php';

// Navigation bar check
$isLoggedIn = checkAuthCookie();
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
  <title>Ride with EkSeat.com - Safe & Affordable Transportation</title>
  <style>
    /* ---------- BASIC STYLE ---------- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #f8f9fa;
      color: #333;
      line-height: 1.6;
    }

    /* ---------- HERO SECTION ---------- */
    .hero {
      width: 90%;
      height: 500px;
      background: linear-gradient(135deg, #02172e, #0a2a4a);
      color: white;
      padding: 80px 0;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 80px auto 20px;
    }

    .hero-container {
      width: 90%;
      max-width: 1300px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 40px;
    }

    .hero-text {
      flex: 1;
      min-width: 280px;
    }

    .hero-text h1 {
      font-size: 2.8rem;
      margin-bottom: 15px;
    }

    .hero-text p {
      font-size: 1.1rem;
      margin-bottom: 8px;
      opacity: 0.9;
    }

    .hero img {
      flex: 1;
      width: 100%;
      max-width: 400px;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    }

    /* ---------- BUTTON ---------- */
    .btn {
      display: inline-block;
      padding: 10px 24px;
      border-radius: 30px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 15px;
    
    }

    .btn-primary {
      background-color: #ff5722;
      color: white;
      box-shadow: 0 4px 15px rgba(255, 87, 34, 0.3);
    }

    .btn-primary:hover {
      background-color: #e64a19;
      transform: translateY(-2px);
    }

    .btn-secondary {
      background-color: #1e88e5;
      color: white;
    }

    .btn-secondary:hover {
      background-color: #1565c0;
      transform: translateY(-2px);
    }

    /* ---------- SECTION TITLE ---------- */
    .section-title {
      text-align: center;
      margin: 50px 0 30px;
      font-size: 2rem;
      color: #02172e;
    }

    .section-title::after {
      content: '';
      display: block;
      width: 80px;
      height: 4px;
      background-color: #ff5722;
      margin: 12px auto 0;
      border-radius: 2px;
    }

    /* ---------- FEATURES ---------- */
    .features {
      max-width: 1100px;
      margin: auto;
      padding: 0 20px 50px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 25px;
    }

    .feature {
      background-color: white;
      text-align: center;
      padding: 25px 20px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: all 0.3s;
    }

    .feature:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .feature i {
      font-size: 1.8rem;
      color: #1e88e5;
      margin-bottom: 10px;
    }

    .feature h3 {
      color: #02172e;
      margin-bottom: 8px;
    }

    .feature p {
      color: #6c757d;
      font-size: 0.95rem;
    }

    /* ---------- SERVICES ---------- */
    .services {
      width: 90%;
      max-width: 1300px;
      margin: auto;
      padding: 0 20px 60px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
      gap: 25px;
    }

    .service {
      background-color: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: all 0.3s;
    }

    .service:hover {
      transform: translateY(-4px);
    }

    .service img {
      width: 100%;
      height: 300px; /* customized uniform height */
      object-fit: cover;
      border-bottom: 3px solid #1e88e5;
      transition: all 0.4s;
    }

    .service:hover img {
      transform: scale(1.05);
      border-color: #ff5722;
    }

    .service-content {
      padding: 20px;
    }

    .service-content h3 {
      color: #02172e;
      margin-bottom: 10px;
    }

    .service-content p {
      color: #6c757d;
      margin-bottom: 15px;
    }

    /* ---------- CTA SECTION ---------- */
    .cta {
      background: linear-gradient(135deg, #eaedf0ff, #ccd6e2ff);
      text-align: center;
      padding: 40px 20px;
      margin: 40px auto 100px;
    }

    .cta h2 {
      font-size: 2.2rem;
      margin-bottom: 12px;
      color: #02172e;
    }

    .cta p {
      font-size: 1.05rem;
      opacity: 0.9;
      margin-bottom: 20px;
      color: #02172e;
    }

    /* ---------- RESPONSIVE ---------- */
    @media (max-width: 768px) {
      .hero-container {
        flex-direction: column;
        text-align: center;
      }

      .hero-text h1 {
        font-size: 2rem;
      }

      .services {
        grid-template-columns: 1fr;
      }

      .service img {
        height: 250px;
      }
    }
  </style>
</head>

<body>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-container">
      <div class="hero-text">
        <h1>Ride with EkSeat.com</h1>
        <p>Experience smooth and reliable rides across the city.</p>
        <p>Affordable fares, verified drivers, and real-time tracking.</p>
        <p>Book your ride anytime, anywhere — we're just one tap away!</p>
        <button class="btn btn-primary" onclick="window.location.href='ride.php'">Book a Ride</button>
      </div>
      <img src="Resources/ride2.png" alt="Ride with EkSeat.com">
    </div>
  </section>

  <!-- Features -->
  <section>
    <h2 class="section-title">Why Choose EkSeat?</h2>
    <div class="features">
      <div class="feature"><i>🚗</i><h3>Verified Drivers</h3><p>All drivers are background-checked and trained for your safety and comfort.</p></div>
      <div class="feature"><i>💰</i><h3>Affordable Fares</h3><p>Enjoy fair pricing with no hidden fees. Know your fare before booking.</p></div>
      <div class="feature"><i>📍</i><h3>Real-time Tracking</h3><p>Track your ride live and share details with your loved ones.</p></div>
      <div class="feature"><i>🛡️</i><h3>Safety First</h3><p>24/7 support and emergency response for complete peace of mind.</p></div>
    </div>
  </section>

  <!-- Services -->
  <section>
    <h2 class="section-title">Our Services</h2>
    <div class="services">
      <div class="service">
        <img src="Resources/ride3.png" alt="Ride Service">
        <div class="service-content">
          <h3>Personal Rides</h3>
          <p>Comfortable rides for individuals or groups with multiple vehicle options.</p>
          <button class="btn btn-secondary" onclick="window.location.href='ride.php'">Book Now</button>
        </div>
      </div>

      <div class="service">
        <img src="Resources/parcel.png" alt="Parcel Delivery">
        <div class="service-content">
          <h3>Parcel Delivery</h3>
          <p>Fast and secure package delivery. Same-day delivery in most areas.</p>
          <button class="btn btn-secondary" onclick="window.location.href='ride.php'">Send Parcel</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Call To Action -->
  <section class="cta">
    <h2>Ready to Ride?</h2>
    <p>Download the EkSeat app today and experience the future of city rides.</p>
    <button class="btn btn-primary" onclick="window.location.href='ride.php'">Get Started</button>
  </section>

  <?php include 'footer.html'; ?>

</body>
</html>
