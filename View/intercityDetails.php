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
  <title>Intercity Service | EkSeat - City-to-City Travel</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    html, body {
      height: 100%;
    }

    body {
      background-color: #f8fafc;
      color: #333;
      line-height: 1.6;
      margin: 0;
      padding-top: 80px;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .main-content {
      flex: 1 0 auto;
      width: 100%;
    }

    .compact-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 20px;
      /* REMOVED: height: 500px; */
    }

    /* Hero Section - More compact */
    .compact-hero {
      background: linear-gradient(135deg, #02172e 0%, #0a2a4a 100%);
      color: white;
      padding: 50px 0;
      margin-bottom: 40px;
      border-radius: 0 0 12px 12px;
      width: 90%;
      /* REMOVED: height: 500px; */
      margin-left: auto;
      margin-right: auto;
    }

    .compact-hero-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 30px;
      min-height: 400px;
    }

    .compact-hero-text {
      flex: 1;
    }

    .compact-hero-text h1 {
      font-size: 2.5rem;
      margin-bottom: 15px;
      font-weight: 700;
    }

    .compact-hero-text p {
      font-size: 1.1rem;
      margin-bottom: 25px;
      opacity: 0.9;
    }

    .compact-hero-image {
      flex: 1;
      text-align: center;
    }

    .compact-hero-image img {
      max-width: 100%;
      max-height: 400px;
      border-radius: 8px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Button Styles */
    .btn {
      display: inline-block;
      padding: 12px 28px;
      border-radius: 6px;
      font-weight: 600;
      font-size: 1rem;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      border: none;
      text-decoration: none;
    }

    .btn-primary {
      background-color: #ff5722;
      color: white;
      box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
    }

    .btn-primary:hover {
      background-color: #e64a19;
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(255, 87, 34, 0.4);
    }

    /* Section Headers - More compact */
    .compact-section-header {
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .compact-section-header h2 {
      font-size: 1.8rem;
      color: #02172e;
      font-weight: 700;
    }

    .compact-divider {
      height: 3px;
      flex-grow: 1;
      background: #ff5722;
      margin-left: 15px;
      border-radius: 2px;
    }

    /* Features Grid - More compact */
    .compact-features {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin-bottom: 50px;
    }

    .compact-feature-card {
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: center;
    }

    .compact-feature-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .compact-feature-icon {
      font-size: 2rem;
      margin-bottom: 15px;
      color: #1e88e5;
    }

    .compact-feature-card h3 {
      font-size: 1.1rem;
      margin-bottom: 10px;
      color: #02172e;
    }

    .compact-feature-card p {
      color: #6c757d;
      font-size: 0.9rem;
    }

    /* Services - Side by side */
    .compact-services {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 25px;
      margin-bottom: 50px;
    }

    .compact-service-card {
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
      display: flex;
      flex-direction: column;
    }

    .compact-service-card:hover {
      transform: translateY(-3px);
    }

    .compact-service-image {
      height: auto;
      overflow: hidden;
    }

    .compact-service-image img {
      width: 100%;
      height: auto;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .compact-service-card:hover .compact-service-image img {
      transform: scale(1.05);
    }

    .compact-service-content {
      padding: 20px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .compact-service-content h3 {
      font-size: 1.3rem;
      margin-bottom: 10px;
      color: #02172e;
    }

    .compact-service-content p {
      color: #6c757d;
      margin-bottom: 15px;
      flex-grow: 1;
    }

    /* Pricing - Compact layout */
    .compact-pricing {
      background: #f1f5f9;
      padding: 40px 0;
      margin-bottom: 50px;
      border-radius: 8px;
    }

    .compact-pricing-cards {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .compact-pricing-card {
      background: white;
      border-radius: 8px;
      padding: 25px 20px;
      text-align: center;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
      position: relative;
    }

    .compact-pricing-card:hover {
      transform: translateY(-3px);
    }

    .compact-pricing-card.popular {
      border: 2px solid #ff5722;
      transform: scale(1.02);
    }

    .compact-popular-badge {
      position: absolute;
      top: -10px;
      left: 50%;
      transform: translateX(-50%);
      background: #ff5722;
      color: white;
      padding: 4px 15px;
      border-radius: 15px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .compact-price {
      font-size: 2.2rem;
      font-weight: 700;
      color: #02172e;
      margin: 15px 0;
    }

    .compact-price span {
      font-size: 0.9rem;
      color: #6c757d;
    }

    .compact-pricing-features {
      list-style: none;
      margin: 20px 0;
    }

    .compact-pricing-features li {
      padding: 6px 0;
      color: #6c757d;
      font-size: 0.9rem;
    }

    .compact-pricing-features li::before {
      content: "✓";
      color: #4caf50;
      font-weight: bold;
      margin-right: 8px;
    }

    /* Routes - Compact grid */
    .compact-routes {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      margin-bottom: 50px;
    }

    .compact-route-card {
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }

    .compact-route-card:hover {
      transform: translateY(-3px);
    }

    .compact-route-card h3 {
      font-size: 1.2rem;
      margin-bottom: 10px;
      color: #02172e;
      display: flex;
      align-items: center;
    }

    .compact-route-card h3::before {
      content: "📍";
      margin-right: 8px;
    }

    .compact-route-card p {
      color: #6c757d;
      font-size: 0.9rem;
    }



    /* Footer fix */
    footer {
      flex-shrink: 0;
      width: 100%;
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
      .compact-features {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 992px) {
      .compact-hero-content {
        flex-direction: column;
        text-align: center;
      }

      .compact-services {
        grid-template-columns: 1fr;
      }

      .compact-routes {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      .compact-hero-text h1 {
        font-size: 2rem;
      }

      .compact-features {
        grid-template-columns: 1fr;
      }

      .compact-pricing-cards {
        grid-template-columns: 1fr;
      }

      .compact-pricing-card.popular {
        transform: scale(1);
      }
    }
  </style>
</head>
<body>

  <div class="main-content">
    <!-- Compact Hero Section -->
    <section class="compact-hero">
      <div class="compact-container">
        <div class="compact-hero-content">
          <div class="compact-hero-text">
            <h1>Intercity Travel Made Simple</h1>
            <p>Experience comfortable, reliable, and affordable transportation between cities. Travel without the hassle of bus stations or train schedules.</p>
            <a href="ride.php" class="btn btn-primary">Book Intercity Ride</a>
          </div>
          <div class="compact-hero-image">
            <img src="Resources/intercity1.png" alt="EkSeat Intercity Service">
          </div>
        </div>
      </div>
    </section>

    <div class="compact-container">
      <!-- Features Section -->
      <section>
        <div class="compact-section-header">
          <h2>Why Choose EkSeat Intercity?</h2>
          <div class="compact-divider"></div>
        </div>

        <div class="compact-features">
          <div class="compact-feature-card">
            <div class="compact-feature-icon">🚗</div>
            <h3>Verified Drivers</h3>
            <p>Background-checked professionals trained for safe long-distance travel.</p>
          </div>
          <div class="compact-feature-card">
            <div class="compact-feature-icon">💰</div>
            <h3>Fixed Pricing</h3>
            <p>Know your exact fare upfront with no hidden charges or surge pricing.</p>
          </div>
          <div class="compact-feature-card">
            <div class="compact-feature-icon">📍</div>
            <h3>Multiple Locations</h3>
            <p>Flexible pickup and drop-off points across all major city locations.</p>
          </div>
          <div class="compact-feature-card">
            <div class="compact-feature-icon">⏱️</div>
            <h3>Punctual Service</h3>
            <p>On-time arrivals and departures with real-time tracking.</p>
          </div>
        </div>
      </section>

      <!-- Services Section -->
      <section>
        <div class="compact-section-header">
          <h2>Our Intercity Services</h2>
          <div class="compact-divider"></div>
        </div>

        <div class="compact-services">
          <div class="compact-service-card">
            <div class="compact-service-image">
              <img src="Resources/ride1.png" alt="Standard Intercity Ride">
            </div>
            <div class="compact-service-content">
              <h3>Standard Intercity</h3>
              <p>Comfortable rides for individuals or small groups with multiple vehicle options. Perfect for business trips or personal travel between cities.</p>
              <a href="ride.php" class="btn btn-primary" style="align-self: flex-start;">Book Now</a>
            </div>
          </div>

          <div class="compact-service-card">
            <div class="compact-service-image">
              <img src="Resources/parcel.png" alt="Intercity Parcel Delivery">
            </div>
            <div class="compact-service-content">
              <h3>Intercity Parcel Delivery</h3>
              <p>Fast and secure package delivery between cities. Same-day delivery available for urgent shipments with real-time tracking.</p>
              <a href="ride.php" class="btn btn-primary" style="align-self: flex-start;">Send Parcel</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Pricing Section -->
      <section class="compact-pricing">
        <div class="compact-container">
          <div class="compact-section-header">
            <h2>Transparent Pricing</h2>
            <div class="compact-divider"></div>
          </div>

          <div class="compact-pricing-cards">
            <div class="compact-pricing-card">
              <h3>Economy</h3>
              <div class="compact-price">৳1,500<span>/trip</span></div>
              <ul class="compact-pricing-features">
                <li>Up to 100 km distance</li>
                <li>4-seater compact car</li>
                <li>Standard comfort</li>
                <li>Basic insurance</li>
              </ul>
              <a href="ride.php" class="btn btn-primary">Select Plan</a>
            </div>

            <div class="compact-pricing-card popular">
              <div class="compact-popular-badge">MOST POPULAR</div>
              <h3>Comfort</h3>
              <div class="compact-price">৳2,200<span>/trip</span></div>
              <ul class="compact-pricing-features">
                <li>Up to 200 km distance</li>
                <li>4-seater sedan</li>
                <li>Enhanced comfort</li>
                <li>Comprehensive insurance</li>
                <li>Priority booking</li>
              </ul>
              <a href="ride.php" class="btn btn-primary">Select Plan</a>
            </div>

            <div class="compact-pricing-card">
              <h3>Premium</h3>
              <div class="compact-price">৳3,500<span>/trip</span></div>
              <ul class="compact-pricing-features">
                <li>Up to 300 km distance</li>
                <li>Luxury vehicle</li>
                <li>Premium comfort</li>
                <li>Full insurance coverage</li>
                <li>Flexible cancellation</li>
              </ul>
              <a href="ride.php" class="btn btn-primary">Select Plan</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Popular Routes Section -->
      <section>
        <div class="compact-section-header">
          <h2>Popular Intercity Routes</h2>
          <div class="compact-divider"></div>
        </div>

        <div class="compact-routes">
          <div class="compact-route-card">
            <h3>City Center to Suburbs</h3>
            <p>Connect downtown areas with suburban business districts and residential areas.</p>
          </div>
          <div class="compact-route-card">
            <h3>Airport Transfers</h3>
            <p>Seamless transfers from airports to neighboring cities and towns.</p>
          </div>
          <div class="compact-route-card">
            <h3>University Routes</h3>
            <p>Connect university towns with metropolitan areas and student hubs.</p>
          </div>
          <div class="compact-route-card">
            <h3>Weekend Getaways</h3>
            <p>Travel to nearby tourist destinations and recreational spots.</p>
          </div>
        </div>
      </section>

    </div>
  </div>

  <?php include_once 'footer.html'; ?>
</body>
</html>