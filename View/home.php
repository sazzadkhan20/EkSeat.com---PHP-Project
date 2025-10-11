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
       <table style="padding: 125px 20px 20px 100px;">
        <tr>
            <td style="padding-right: 100px; width:500px;">
                <h1 style="font-size: 50px;">Worried to pay the whole fare?</h1>
                <p >Enjoy your shared trip with reduced prices at EkSeat.com</p>
                <form action="ride.php" method="post" onsubmit="return validateHomePageRequest()" style="margin: 50px 0px; width: 300px;">
                    <input type="text" id="pickup" placeholder="Enter pickup location ᯓ➤" class="input-box">
                    <br>
                    <input type="text" id="dropOff" placeholder="Enter drop-off location 📍" class="input-box">
                    <br>
                    <p id="error-message" style="color: red;"></p>
                    <button class="btn" type="submit">See Available Rides</button>
                </form>
            </td>
            <td style="padding-left: 150px;">
                <?php include 'slideShow.html'; ?>
            </td>
        </tr>
        </table>
    </main>
    
     <?php include 'imageHome.html'; ?>
    <?php include 'suggestion.html'; ?>
    <?php include 'footer.html'; ?>
    
    <script src="http://localhost/EkSeat.com---PHP-Project/Controller/rideValidation.js"></script>
</body>
</html>
