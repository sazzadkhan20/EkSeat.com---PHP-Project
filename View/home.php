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
    <link rel="stylesheet" href="style.css">
    <title>EkSeat.com</title>
</head>
<body>
    <main>
       <table style="padding: 80px 20px 20px 50px;">
        <tr>
            <td style="padding-right: 149px;">
                <h2>Enjoy your ride with EkSeat.com</h2>
                <form action="ride.php" method="post" onsubmit="return validateHomePageRequest()">
                    <input type="text" id="pickup" placeholder="Enter pickup location" class="input-box">
                    <br>
                    <input type="text" id="dropOff" placeholder="Enter drop-off location" class="input-box">
                    <br>
                    <p id="error-message" style="color: red;"></p>
                    <button class="btn" type="submit">Search Ride</button>
                </form>
            </td>
            <td style="padding-left: 150px;">
                <?php include 'slideShow.html'; ?>
            </td>
        </tr>
        </table>
    </main>
    <?php include 'footer.html'; ?>
    <script src="http://localhost/EkSeat.com---PHP-Project/Controller/rideValidation.js"></script>
</body>
</html>
