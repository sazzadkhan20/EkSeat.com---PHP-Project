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
  <title>Details with Image Shadow Box</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 50px;
      background-color: #f9f9f9;
    }

 table {
  width: 100%;
  border-spacing: 0;
  border-collapse: collapse;

}

    /* td {
       vertical-align: top;  
      
    } */

   .details {
  width: 60%;
  padding-left: 100px;
  /* margin-top: 20px; */
}

.details h2 {
  text-align: center;
  color: #304b66ff;
  margin-top: 5%;
 
}

    .image-box {
  width: 30%;
  text-align: left;
  padding-left: 0;
}

    .shadow-box {
      display: inline-block;
      background-color: #c0dde6;
      padding: 10px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .shadow-box img {
      border-radius: 10px;
      width: 400px;
      height: 300px;
    }
  </style>
</head>
<body>

  <table>
    <tr>
      <!-- Left side details -->
      <td class="details">
        <h2>Welcome to Our Service</h2>
      <p>EkSeat Bike offers fast, affordable motorcycle rides for when you need to beat traffic and get to your destination quickly.</p>
      <p>Our trained bike partners are ready to get you moving. Just book a ride through the EkSeat app, and you'll be on your way in minutes.</p>
      
      <h3>Key Features:</h3>
      <ul>
        <li>Fastest way through city traffic</li>
        <li>Most affordable EkSeat option</li>
        <li>Helmets provided for safety</li>
        <li>Ideal for short to medium distances</li>
        <li>Available in high-traffic urban areas</li>
      </ul>
      
      <h3>Safety First:</h3>
      <ul>
        <li>All drivers are licensed and trained</li>
        <li>Regular vehicle maintenance checks</li>
        <li>GPS tracking for every trip</li>
        <li>24/7 customer support</li>
        <li>Insurance coverage for all rides</li>
      </ul>
      
      <p><strong>Pricing:</strong> Base fare starts at Tk 50 + Tk 15 per km. The most budget-friendly option for solo travelers.</p>
      </td>

      <!-- Right side image in shadow box -->
      <td class="image-box">
        <div class="shadow-box">
          <img src="Resources/bike.png" alt="Travel Image">
        </div>
      </td>
    </tr>
  </table>

<?php include 'footer.html'; ?>
</body>
</html>
