<?php include_once 'nevigationBar.html'; ?>

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
            color: #3498db;
            border-bottom: 3px solid #3498db;
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
            border-color: #3498db;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .ride-option.selected {
            border-color: #3498db;
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
            font-size: 1.3rem;
            font-weight: 600;
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
            border-left: 5px solid #3498db;
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
        }
    </style>
</head>
<body>
    <!-- Navigation is included at the top -->
    
    <div class="main-content">
        <div class="container">
            <div class="content-wrapper">
                <!-- Left Side - Fixed Search Box -->
                <div class="search-container">
                    <div class="search-form">
                        <div class="input-group">
                            <h3>Get a Ride</h3>
                            <label for="pickup">Pickup Location</label>
                            <input type="text" id="pickup" placeholder="Enter pickup location">
                        </div>
                        
                        <div class="input-group">
                            <label for="destination">Destination</label>
                            <input type="text" id="destination" placeholder="Enter destination">
                        </div>
                        
                        <button class="search-btn" id="searchBtn">Search Rides & Rentals</button>
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
                    
                    <!-- Tabs for Ride vs Rental -->
                    <!-- <div class="services-tabs">
                        <button class="tab-btn active" onclick="showTab('ride')">🚗 Rides</button>
                        <button class="tab-btn" onclick="showTab('rental')">📦 Rentals</button>
                    </div> -->
                    
                    <!-- Ride Tab Content -->
                    <div id="ride-tab" class="tab-content active">
                        <h3 class="tab-title">One-Way Rides</h3>
                        <div class="ride-options" id="rideOptions">
                            <!-- Ride options will be inserted here -->
                        </div>
                    </div>
                    
                    <!-- Rental Tab Content -->
                    <div id="rental-tab" class="tab-content">
                        <h3 class="tab-title">Rental Packages (Full Day - 8 Hours)</h3>
                        <div class="ride-options" id="rentalOptions">
                            <!-- Rental options will be inserted here -->
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

    <script src="../Controller/graphDevelop_RideCalculation.js"></script>
    
    <!-- Footer at the bottom -->
    <?php include 'footer.html'; ?>
</body>
</html>