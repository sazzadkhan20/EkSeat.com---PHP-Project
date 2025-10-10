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
    <div style="text-align: center; padding: 50px;">
        <h2>Safety Guidelines</h2>
        <p>At EkSeat.com, your safety is our top priority. Please follow these guidelines:</p>
    </div>
    <table>
        <tr>
            <td><img src="Resources/verify.png" alt="Verify Your Driver or Delivery Agent" height="200" width="200" style="border-radius: 20px;"></td>
            <td style="padding-left: 50px;"><h3>Verify Your Driver or Delivery Agent</h3>
            <p>Before starting your trip or receiving a delivery, always verify the driver or delivery agent’s name, photo, and vehicle details to ensure your safety.</p></td>


            <td><img src="Resources/share location.png" alt="Share Trip or Delivery Details" height="200" width="200" style="border-radius: 20px;"></td>
            <td style="padding-left: 50px;"><h3>Share Trip or Delivery Details</h3>
            <p>Share your ride or delivery details with a trusted friend or family member so they can track your journey in real-time for added security.</p></td>
        </tr>
        <tr>
            <td><img src="Resources/traffic.png" alt="Follow Traffic and Road Safety Rules" height="200" width="200" style="border-radius: 20px;"></td>
            <td style="padding-left: 50px;"><h3>Follow Traffic and Road Safety Rules</h3>
            <p>Always follow traffic signals, wear seat belts, and avoid distractions during your ride to ensure a safe travel experience.</p></td>
        

            <td><img src="Resources/emergency.png" alt="Contact Support in Case of Emergency" height="200" width="200" style="border-radius: 20px;"></td>
            <td style="padding-left: 50px;"><h3>Contact Support in Case of Emergency</h3>
            <p>If you feel unsafe or face an emergency, contact our support team or use the in-app emergency button immediately.</p></td>
        </tr>
        <tr>
            <td><img src="Resources/tracking.png" alt="All Rides and Parcels Are Tracked for Security" height="200" width="200" style="border-radius: 20px;"></td>
            <td style="padding-left: 50px;"><h3>All Rides and Parcels Are Tracked for Security</h3>
            <p>Every ride and parcel delivery is monitored through GPS tracking to maintain transparency and enhance user safety.</p></td>
        

            <td><img src="Resources/show update.png" alt="Check App and Website Updates Regularly" height="200" width="200" style="border-radius: 20px;"></td>
            <td style="padding-left: 50px;"><h3>Check App and Website Updates Regularly</h3>
            <p>Stay informed by checking our app and website for updated safety measures, guidelines, and important announcements.</p></td>
        </tr>
    </table>
    <?php include 'footer.html'; ?>