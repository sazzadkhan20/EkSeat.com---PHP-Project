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
<!-- Top Section: Two images side by side -->
<table style="width:100%; border-collapse: separate; border-spacing: 50px; padding: 50px;">
<tr>
  <td style="text-align:center;">
    <img src="Resources/ride3.png" alt="Top Image 1" height="400" width="500" style="border-radius: 10px;">
  </td>
  <td style="text-align:center;">
    <img src="Resources/parcel.png" alt="Top Image 2" height="400" width="500" style="border-radius: 10px;">
  </td>
</tr>
</table>

<!-- Hero Section: Text on the left, image on the right -->
<table style="width:100%; border-collapse: separate; border-spacing: 0 50px; padding: 50px 100px;">
<tr>
  <!-- Left side text -->
  <td style="padding-left: 100px; padding-top: 70px; vertical-align: top;">
    <h2>Ride with EkSeat.com</h2>
    <p>Experience smooth and reliable rides across the city.</p>
    <p>Affordable fares, verified drivers, and real-time tracking.</p>
    <p>Book your ride anytime, anywhere — we’re just one tap away!</p>
    <button style="width: 150px; height: 40px; font-size: 16px; border-radius: 6px; background-color: #02172e; color: white; border: none; cursor: pointer; margin-top: 10px;" onclick="window.location.href='ride.php'">Book a ride</button>
  </td>

  <!-- Right side image -->
  <td style="padding-right: 100px;">
    <img src="Resources/ride2.png" alt="Ride with EkSeat.com" height="400" width="500" style="border-radius: 20px;">
  </td>
</tr>
</table>

<?php include 'footer.html'; ?>
