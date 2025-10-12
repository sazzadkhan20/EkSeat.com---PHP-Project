in this code i want to add 2 images on the top

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


<table style="width:100%; border-collapse: separate; border-spacing: 0 50px; padding: 50px 50px 20px 200px;">
<tr>
<td>
<img src="Resources/ride2.png" alt="Log in to see your account details" height="400" width="500" style="border-radius: 20px;">
</td>
<td style="padding-right: 200px; padding-top: 70px; vertical-align: top;">
<h2>Ride with EkSeat.com</h2>
  <p>Experience smooth and reliable rides across the city.</p>
  <p>Affordable fares, verified drivers, and real-time tracking.</p>
  <p>Book your ride anytime, anywhere — we’re just one tap away!</p>
<button style="width: 150px; height: 40px; font-size: 16px; border-radius: 6px; background-color: #02172e; color: white; border: none; cursor: pointer; margin-right: 10px;" onclick="window.location.href='ride.php'">Book a ride</button>
</td>
</tr>
</table>
<?php include 'footer.html'; ?>