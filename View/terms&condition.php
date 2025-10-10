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
  <title>Terms and Conditions | RideLink</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
      color: #333;
      line-height: 1.6;
    }

    .container {
      max-width: 100%;
      margin: 70px auto;
      background: #fcfeffc3;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #1c3f6eff;
      margin-bottom: 30px;
    }

    h2 {
      color: #395998ff;
      border-left: 5px solid #395998ff;
      padding-left: 10px;
      margin-top: 30px;
    }

    p {
      text-align: justify;
      margin-bottom: 15px;
    }

    .contact {
      background: #e0f2f1;
      padding: 15px;
      border-radius: 8px;
      margin-top: 20px;
    }

    @media (max-width: 600px) {
      .container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Terms and Conditions</h1>
    <p>
      Please read these Terms and Conditions carefully before using our services. 
      By accessing or using our platform, you agree to be bound by these terms.
    </p>

    <h2>1. Acceptance of Terms</h2>
    <p>
      By accessing or using RideLink’s services, you agree to comply with these Terms and Conditions. 
      If you disagree with any part, you may not access the service.
    </p>

    <h2>2. User Responsibilities</h2>
    <p>
      Users must provide accurate information, follow safety guidelines, and respect other users and drivers. 
      Any misuse of the platform may result in account suspension or legal action.
    </p>

    <h2>3. Booking and Payments</h2>
    <p>
      All bookings are subject to availability. Payments must be completed through the official payment methods listed on our platform. 
      Any fraudulent activity will result in immediate termination of services.
    </p>

    <h2>4. Cancellation and Refund Policy</h2>
    <p>
      Users can cancel rides or deliveries under specific conditions mentioned in our app. 
      Refunds (if applicable) will follow the policy outlined in our support section.
    </p>

    <h2>5. Safety and Conduct</h2>
    <p>
      Users are expected to behave respectfully and comply with all safety instructions during rides or deliveries. 
      RideLink reserves the right to take action against any form of misconduct.
    </p>

    <h2>6. Privacy Policy</h2>
    <p>
      Your personal data is protected under our Privacy Policy. 
      We collect only essential information to provide and improve our services.
    </p>

    <h2>7. Limitation of Liability</h2>
    <p>
      RideLink is not responsible for delays, damages, or losses caused by external factors such as traffic, weather, or third-party actions.
    </p>

    <h2>8. Updates to Terms</h2>
    <p>
      We may modify these Terms and Conditions at any time. 
      Updated terms will be posted on our website and app, effective immediately upon publication.
    </p>

    <h2>9. Contact Information</h2>
    <div class="contact">
      <p>If you have any questions about these Terms, contact us at:</p>
      <p><strong>Email:</strong> support@ekseat.com</p>
    </div>
  </div>


  <?php include 'footer.html'; ?>

</body>
</html>
