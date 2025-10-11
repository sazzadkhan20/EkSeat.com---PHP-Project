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
    <title>Ride Book</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Initial state - centered search */
        .initial-search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 150px;
        }
        
        .centered-search-box {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 350px; 
            max-width: 350px;
            animation: fadeIn 0.5s ease-in;
        }
        
        .centered-search-box h2 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .centered-search-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .centered-input-group {
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .centered-input-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
            font-size: 1.1rem;
        }
        
        .centered-input-group input {
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .centered-input-group input:focus {
            outline: none;
            border-color: #08293fff;
            box-shadow: 0 0 0 3px rgba(8, 41, 63, 0.2);
        }
        
        .centered-search-btn {
            background: linear-gradient(to right, #08293fff, #2c3e50);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .centered-search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        
        .centered-search-btn:disabled {
            background: #bdc3c7;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        /* Autocomplete dropdown styles */
        .autocomplete-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 0 0 8px 8px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
        }
        
        .autocomplete-item {
            padding: 12px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
        }
        
        .autocomplete-item:hover {
            background-color: #f5f7fa;
        }
        
        .autocomplete-item:last-child {
            border-bottom: none;
        }
        
        /* After search - your original layout */
        .main-content {
            flex: 1;
            display: flex;
            padding: 70px;
            gap: 20px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
        }
        
        .container {
            width: 100%;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            min-height: 80vh;
        }
        
        .content-wrapper {
            display: flex;
            width: 100%;
            min-height: 600px;
        }
        
        .search-container {
            flex: 0 0 400px;
            background: #f8f9fa;
            padding: 30px;
            border-right: 1px solid #eaeaea;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 20px;
            height: fit-content;
            max-height: calc(100vh - 40px);
            overflow-y: auto;
        }
        
        .results-container {
            flex: 1;
            padding: 40px;
            display: none;
            background: white;
            animation: fadeIn 0.5s ease-in;
            min-height: 600px;
        }
        
        .search-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .input-group {
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .input-group h3 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .input-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
            font-size: 1.1rem;
        }
        
        .input-group input {
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .input-group input:focus {
            outline: none;
            border-color: #08293fff;
            box-shadow: 0 0 0 3px rgba(8, 41, 63, 0.2);
        }
        
        .search-btn {
            background: linear-gradient(to right, #08293fff, #2c3e50);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        
        .search-btn:disabled {
            background: #bdc3c7;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .loading {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
            font-size: 1.2rem;
        }
        
        .services-tabs {
            display: flex;
            margin-bottom: 25px;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .tab-btn {
            padding: 15px 25px;
            background: none;
            border: none;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
            color: #7f8c8d;
        }
        
        .tab-btn.active {
            color: #364160;
            border-bottom: 3px solid #364160;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease-in;
        }
        
        .tab-title {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .ride-options {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .ride-option {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 25px;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }
        
        .ride-option:hover {
            border-color: #364160;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .ride-option.selected {
            border-color: #364160;
            background: #f0f8ff;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.2);
        }
        
        .ride-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .ride-type {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2c3e50;
        }
        
        .ride-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #27ae60;
        }
        
        .ride-details {
            color: #7f8c8d;
            font-size: 1rem;
            line-height: 1.5;
        }
        
        .rental-features {
            margin-top: 12px;
            padding-left: 20px;
        }
        
        .rental-features li {
            margin-bottom: 8px;
            color: #555;
        }
        
        .price-breakdown {
            font-size: 0.9rem;
            color: #95a5a6;
            margin-top: 8px;
            font-style: italic;
        }
        
        .confirm-btn-container {
            display: none;
            margin-top: 30px;
            text-align: center;
        }
        
        .confirm-btn {
            background: linear-gradient(to right, #08293fff, #2c3e50);
            color: white;
            padding: 18px 40px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .confirm-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        
        .hidden {
            display: none;
        }
        
        .distance-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 5px solid #364160;
        }
        
        .distance-info h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.3rem;
        }
        
        .distance-info p {
            color: #7f8c8d;
            margin: 5px 0;
            font-size: 1.1rem;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Popup Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 40px;
            border-radius: 15px;
            width: 450px;
            max-width: 90%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            font-family: Arial, sans-serif;
            position: relative;
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .modal-message {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .continue-btn {
            background: linear-gradient(to right, #08293fff, #2c3e50);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .continue-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }

        .blur-background {
            filter: blur(5px);
            pointer-events: none;
            user-select: none;
        }
        
        /* Footer styling */
        footer {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
            margin-top: auto;
        }
        
        /* Responsive design */
        @media (max-width: 1024px) {
            .main-content {
                padding: 15px;
            }
            
            .container {
                flex-direction: column;
            }
            
            .search-container {
                flex: none;
                position: static;
                max-height: none;
                border-right: none;
                border-bottom: 1px solid #eaeaea;
            }
            
            .results-container {
                padding: 30px;
            }
        }
        
        @media (max-width: 768px) {
            .search-container, .results-container {
                padding: 20px;
            }
            
            .services-tabs {
                flex-direction: column;
            }
            
            .tab-btn {
                text-align: center;
                border-bottom: 1px solid #e0e0e0;
            }
            
            .ride-option {
                padding: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .main-content {
                padding: 10px;
            }
            
            .search-container, .results-container {
                padding: 15px;
            }
            
            .ride-option {
                padding: 15px;
            }
            
            .confirm-btn {
                padding: 15px 30px;
                font-size: 16px;
            }
            
            .centered-search-box {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Login Popup Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="modal-title">Log in to see ride options</div>
            <div class="modal-message">
                Please take a moment to quickly log in or sign up so we can show you your ride options
            </div>
            <button class="continue-btn" id="continueBtn">Continue</button>
        </div>
    </div>
    
    <!-- Initial state - centered search box -->
    <div class="initial-search-container" id="initialSearchContainer">
        <div class="centered-search-box">
            <h2>Get Your Ride</h2>
            <div class="centered-search-form">
                <div class="centered-input-group">
                    <input type="text" id="initial-pickup" placeholder="Enter pickup location" autocomplete="off">
                    <div class="autocomplete-dropdown" id="initial-pickup-dropdown"></div>
                </div>
                
                <div class="centered-input-group">
                    <input type="text" id="initial-destination" placeholder="Enter destination" autocomplete="off">
                    <div class="autocomplete-dropdown" id="initial-destination-dropdown"></div>
                </div>
                
                <button class="centered-search-btn" id="initialSearchBtn" disabled>Search Rides</button>
            </div>
        </div>
    </div>
    
    <!-- After search - your original layout -->
    <div class="main-content" id="mainContent" style="display: none;">
        <div class="container">
            <div class="content-wrapper">
                <!-- Left Side - Fixed Search Box -->
                <div class="search-container">
                    <div class="search-form">
                        <div class="input-group">
                            <h3>Get Your Ride</h3>
                            <label for="pickup">Pickup Location</label>
                            <input type="text" id="pickup" placeholder="Enter pickup location" autocomplete="off">
                            <div class="autocomplete-dropdown" id="pickup-dropdown"></div>
                        </div>
                        
                        <div class="input-group">
                            <label for="destination">Destination</label>
                            <input type="text" id="destination" placeholder="Enter destination" autocomplete="off">
                            <div class="autocomplete-dropdown" id="destination-dropdown"></div>
                        </div>
                        
                        <button class="search-btn" id="searchBtn" disabled>Search Rides</button>
                    </div>
                    
                    <!-- Loading Indicator -->
                    <div class="loading hidden" id="loading">
                        <p>Calculating best routes and prices...</p>
                        <div style="margin-top: 20px;">
                            <div style="display: inline-block; width: 20px; height: 20px; border-radius: 50%; border: 3px solid #f3f3f3; border-top: 3px solid #3498db; animation: spin 1s linear infinite;"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Side - Expanded Results Area -->
                <div class="results-container" id="resultsContainer">
                    <!-- Distance Information -->
                    <div class="distance-info" id="distanceInfo" style="display: none;">
                        <h3>Route Information</h3>
                        <p>Distance: <span id="distanceValue">0</span> km</p>
                        <p>From: <span id="fromLocation">-</span> to: <span id="toLocation">-</span></p>
                    </div>
                    
                    <!-- Ride Tab Content -->
                    <div id="ride-tab" class="tab-content active">
                        <h3 class="tab-title">Choose a Ride</h3>
                        <div class="ride-options" id="rideOptions">
                            <!-- Ride options will be inserted here -->
                        </div>
                    </div>
                    
                    <!-- Confirm Button -->
                    <div class="confirm-btn-container" id="confirmBtnContainer">
                        <button class="confirm-btn" id="confirmBtn">
                            Request Car Ride
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden form for data submission -->
    <form id="bookingForm" action="../Model/bookingRide.php" method="POST" style="display: none;">
        <input type="hidden" name="pickup" id="formPickup">
        <input type="hidden" name="destination" id="formDestination">
        <input type="hidden" name="distance" id="formDistance">
        <input type="hidden" name="service_type" id="formServiceType">
        <input type="hidden" name="vehicle_type" id="formVehicleType">
        <input type="hidden" name="price" id="formPrice">
        <input type="hidden" name="booking_type" id="formBookingType">
    </form>
    
    
    <!-- JavaScript Files -->
    <script>
        // Pass PHP variable to JavaScript
        const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
    </script>
    <script src="../Controller/graphDevelop_RideCalculation.js"></script>
    <script src="rideBookTransition.js"></script>
    <script src="../Controller/locationSearch.js"></script>
    <script src="authPopup.js"></script>

    <!-- Footer at the bottom -->
    <?php include 'footer.html'; ?>
</body>
</html>