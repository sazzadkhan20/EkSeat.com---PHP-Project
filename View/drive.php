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
<title>Drive</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0; padding: 0;
    line-height: 1.6;
    color: #333;
}
h2 { text-align: center; margin: 40px 0 20px; font-size: 32px; }

.hero {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 50px;
    padding: 50px 20px;
    background: #f5f5f5;
}

.hero img {
    width: 25%;
    border-radius: 10px;
    object-fit: cover;
    margin-top: 50px;
}

.hero-text {
    width: 40%;
    text-align: left;
}

.hero-text h3 {
    font-size: 36px;
    margin-bottom: 15px;
}

.hero-text p {
    font-size: 18px;
    margin-bottom: 20px;
}

.hero .btn {
    background: #02172e;
    color: white;
    border-radius: 8px;
    border: none;
    padding: 12px 30px;
    font-size: 16px;
}


section { padding: 50px 20px; }
.benefits, .testimonials { background: #f9f9f9; }

.cards, .testimonial-cards { 
    display: flex; 
    flex-wrap: wrap; 
    justify-content: center; 
    gap: 20px;
}

.card, .testimonial { 
    background: #fff; 
    border-radius: 10px; 
    padding: 20px; 
    width: 250px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1); 
    text-align: center;
}

.card img, .testimonial img {
    width: 100%;
    border-radius: 10px;
    margin-bottom: 15px;
}

/* New section: Testimonials + Requirements side by side */
.testimonial-requirements {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 60px;
    background: #f9f9f9;
    padding: 60px 100px;
}

.testimonials {
    flex: 1;
}

.requirements-text {
    flex: 1;
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}

.requirements-text h2 {
    text-align: left;
    margin-top: 0;
}

.requirements-text p {
    font-size: 18px;
    line-height: 1.8;
}

.join {
    text-align: center;
    background: #a1c3c7ff;
    padding: 50px;
}

.join .btn { 
    background: #fff; 
    color: #6b80aaff;
    padding: 10px 20px; 
    border-radius: 5px; 
    text-decoration: none; 
    font-weight: bold; 
}
</style>
</head>

<body>

<!-- Hero Section -->
<header class="hero">
    <img src="Resources/joinDrive.png" alt="Drive with EkSeat">
    <div class="hero-text">
        <h3>Drive on Your Schedule</h3>
        <p>Flexible rides and deliveries, earning made easy.</p>
        <a href="#join" class="btn">Become a Driver</a>
    </div>
</header>

<!-- Benefits Section -->
<section class="benefits">
    <h2>Why Drive with EkSeat.com</h2>
    <div class="cards">
        <div class="card">
            <img src="Resources/flexibleHours.png" alt="Flexible Hours">
            <h3>Flexible Hours</h3>
            <p>Work anytime you want.</p>
        </div>
        <div class="card">
            <img src="Resources/secure.png" alt="Secure Rides">
            <h3>Safe & Secure</h3>
            <p>Verified passengers, live tracking.</p>
        </div>
        <div class="card">
            <img src="Resources/fastPayment.png" alt="Fast Payments">
            <h3>Fast Payments</h3>
            <p>Direct weekly payouts.</p>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works">
    <h2>How It Works</h2>
    <div class="cards">
        <div class="card">
            <img src="Resources/signupdrive.png" alt="Sign Up">
            <h3>Sign Up</h3>
            <p>Register and upload documents.</p>
        </div>
        <div class="card">
            <img src="Resources/varificationDrive.png" alt="Verify">
            <h3>Get Verified</h3>
            <p>Vehicle & background checks.</p>
        </div>
        <div class="card">
            <img src="Resources/drivingDrive.png" alt="Start">
            <h3>Start Driving</h3>
            <p>Accept rides & deliveries.</p>
        </div>
    </div>
</section>

<!-- Testimonials and Requirements Side by Side -->
<section class="testimonial-requirements">
    <div class="testimonials">
        <h2>Driver Testimonials</h2>
        <div class="testimonial-cards">
            <div class="testimonial">
                <p>“EkSeat helped me earn on my own schedule.”</p>
                <span>- Riyad, Chandpur</span>
            </div>
            <div class="testimonial">
                <p>“Payments are fast, and I feel secure every trip.”</p>
                <span>- Shamim, Dhaka</span>
            </div>
        </div>
    </div>

    <div class="requirements-text">
        <h2>Requirements</h2>
        <p>To become an EkSeat driver, you need to be at least 18 years old, hold a valid driving license, and own a registered vehicle (car, bike etc). You'll also need a smartphone with internet access for navigation and ride updates.</p>
    </div>
</section>

<!-- Join Section -->
<section class="join" id="join">
    <h2>Ready to Drive?</h2>
    <p>Join EkSeat.com and start earning today.</p>
    <a href="signUp.php" class="btn">Become a Driver</a>
</section>

<?php include 'footer.html'; ?>
</body>
</html>
