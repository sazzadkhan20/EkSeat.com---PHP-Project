<?php
    session_start();
    require_once '../Model/userRideHistory.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride History | EkSeat.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        :root {
            --primary: #000000;
            --secondary: #3d3d3d;
            --accent: #42a5f5;
            --light: #f5f5f5;
            --gray: #e0e0e0;
            --success: #4caf50;
            --warning: #ff9800;
            --danger: #f44336;
            --card-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        
        /* Enhanced Logo Styles */
.logo-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo {
    font-size: 40px;
    font-weight: 800;
    background: linear-gradient(135deg, #7cb8dd 0%, #7cb8dd 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    position: relative;
    letter-spacing: -1px;
    transition: all 0.3s ease;
}

.logo:hover {
    transform: translateY(-2px);
    text-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.logo::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, #7badc4, #3a7a95);
    border-radius: 2px;
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.logo:hover::after {
    transform: scaleX(1);
}

/* Alternative logo design with icon */
.logo-with-icon {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
}

.logo-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #364160 0%, #364160 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.logo-icon i {
    transform: rotate(-10deg);
}

.logo-with-icon:hover .logo-icon {
    transform: rotate(-5deg) scale(1.05);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.logo-text {
    font-size: 32px;
    font-weight: 800;
    background: linear-gradient(135deg, #7badc4 0%, #3a7a95 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -1px;
    transition: all 0.3s ease;
}

.logo-with-icon:hover .logo-text {
    transform: translateY(-2px);
}

/* Modern badge-style logo */
    .logo-badge {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #77b6dd 0%, #3a7a95 100%);
        color: white;
        padding: 8px 20px 8px 15px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 28px;
        box-shadow: 0 4px 12px rgba(123, 173, 196, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .logo-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .logo-badge:hover::before {
        left: 100%;
    }

    .logo-badge:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(123, 173, 196, 0.4);
    }

    .logo-badge i {
        margin-right: 10px;
        font-size: 24px;
    }
        
        .nav-links {
            display: flex;
            gap: 25px;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--secondary);
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover, .nav-links a.active {
            color: var(--primary);
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            overflow: hidden;
        }
        
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .stats-section {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.12);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-size: 20px;
        }
        
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--secondary);
            font-size: 14px;
        }
        
        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .left-section {
            padding: 20px 0;
        }
        
        .right-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .image-card {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 14px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: relative;
        }
        
        .image-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.1);
        }
        
        .image-card i {
            font-size: 48px;
            margin-bottom: 15px;
            z-index: 1;
        }
        
        .image-card p {
            z-index: 1;
        }
        
        .map-card {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        }
        
        .driver-card {
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
        }
        
        h1 {
            font-size: 36px;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .subtitle {
            font-size: 18px;
            color: var(--secondary);
            margin-bottom: 30px;
        }
        
        .cta-button {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .cta-button:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }
        
        .tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--gray);
            padding-bottom: 10px;
        }
        
        .tab {
            padding: 10px 0;
            font-weight: 500;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }
        
        .tab.active {
            border-bottom: 2px solid var(--primary);
            font-weight: 600;
        }
        
        .tab:hover {
            color: var(--primary);
        }
        
        .filter-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .filter-label {
            font-weight: 600;
            font-size: 16px;
        }
        
        .filter-select {
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid var(--gray);
            background-color: white;
            font-size: 14px;
            min-width: 180px;
            cursor: pointer;
            transition: border-color 0.3s;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: var(--accent);
        }
        
        .history-section {
            margin-top: 10px;
        }
        
        .history-title {
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .history-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .history-item {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s;
        }
        
        .history-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .trip-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .trip-route {
            font-weight: 600;
            font-size: 16px;
        }
        
        .trip-date {
            color: var(--secondary);
            font-size: 14px;
        }
        
        .trip-price {
            font-weight: 600;
            font-size: 18px;
        }
        
        .trip-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-completed {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--success);
        }
        
        .status-upcoming {
            background-color: rgba(255, 152, 0, 0.1);
            color: var(--warning);
        }
        
        .status-cancelled {
            background-color: rgba(244, 67, 54, 0.1);
            color: var(--danger);
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--secondary);
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }
        
        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            color: var(--gray);
        }
        
        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: var(--secondary);
        }
        
        .empty-state p {
            margin-bottom: 25px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        
        .book-ride-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .book-ride-btn:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        }
        
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .right-section {
                order: -1;
            }
            
            h1 {
                font-size: 28px;
            }
            
            .stats-section {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .nav-links {
                display: none;
            }
            
            .filter-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    
    <div class="container">
        <header>
            <div>
                <a href="home.php" class = 'logo' >EkSeat.com</a>
            </div>
            <div class="nav-links">
                <a href="home.php" class="active">Home</a>
                <a href="ride.php">Rides</a>
                <a href="userActivity.php">Activity</a>
                <a href="#">Wallet</a>
                <a href="#">Manage Account</a>
                <a href="#">Help</a>
            </div>
            <div class="user-profile">
                <div class="user-avatar">
                    <?php if(isset($user['uImage']) && !empty($user['uImage'])): ?>
                        <img src="images/<?php echo htmlspecialchars($user['uImage']); ?>" alt="Profile Image">
                    <?php else: ?>
                        <?php echo substr($user['uName'], 0, 1); ?>
                    <?php endif; ?>
                </div>
                <span><?php echo htmlspecialchars($user['uName']); ?></span>
            </div>
        </header>
        
        <!-- Dynamic Stats Section -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(66, 165, 245, 0.2); color: #42a5f5;">
                    <i class="fas fa-car"></i>
                </div>
                <div class="stat-value" id="totalRides"><?php echo $has_rides ? $total_rides : 0; ?></div>
                <div class="stat-label">Total Rides</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(76, 175, 80, 0.2); color: #4caf50;">
                    <i class="fas fa-road"></i>
                </div>
                <div class="stat-value" id="totalDistance"><?php echo $has_rides ? round($total_distance) : 0; ?></div>
                <div class="stat-label">Distance (km)</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(255, 152, 0, 0.2); color: #ff9800;">
                    <i class="fa-solid fa-coins"></i>
                </div>
                <div class="stat-value" id="totalPoints"><?php echo $has_rides ? $total_points : '1000'; ?></div>
                <div class="stat-label">Points</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(156, 39, 176, 0.2); color: #9c27b0;">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-value" id="totalSpent"><?php echo $has_rides ? number_format($total_spent, 2) : '0.00'; ?></div>
                <div class="stat-label">Total Transaction</div>
            </div>
        </div>
        
        <div class="main-content">
            <div class="left-section">
                <h1>Your Rides</h1>
                <p class="subtitle">Manage your trips and book new rides</p>
                <button class="cta-button" onclick="window.location.href='ride.php'">
                    <i class="fas fa-car"></i>
                    Book a Ride Now
                </button>
                
                <?php if($has_rides): ?>
                <div class="tabs">
                    <div class="tab active" data-tab="all">All Trips</div>
                    <div class="tab" data-tab="business">Personal</div>
                    <div class="tab" data-tab="personal">Bussiness</div>
                </div>
                
                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="filter-label">Filter by:</div>
                    <select class="filter-select" id="timeFilter">
                        <option value="all">All Time</option>
                        <option value="30days">Last 30 Days</option>
                        <option value="lastMonth">Previous Month</option>
                        <option value="3months">Last 3 Months</option>
                    </select>
                </div>
                <?php endif; ?>
                
                <div class="history-section">
                    <h2 class="history-title">Recent Trips</h2>
                    <div class="history-list" id="historyList">
                        <?php if($has_rides): ?>
                            <!-- History items will be dynamically added here -->
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-car"></i>
                                <h3>No Ride History Yet</h3>
                                <p>You haven't taken any rides yet. Your journey begins with that first trip!</p>
                                <button class="book-ride-btn" onclick="window.location.href='ride.php'">
                                    Book Your First Ride
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="right-section">
                <div class="image-card map-card">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>Your Ride History Map</p>
                    <p><?php echo $has_rides ? 'Interactive visualization of your trips' : 'Your ride map will appear here'; ?></p>
                </div>
                <div class="image-card driver-card">
                    <i class="fas fa-user-tie"></i>
                    <p>Your Favorite Drivers</p>
                    <p><?php echo $has_rides ? 'Drivers you\'ve rated 5 stars' : 'Rate drivers to see your favorites here'; ?></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ride history data from PHP
        const rideHistory = <?php echo $has_rides ? json_encode($ride_history) : '[]'; ?>;
        const hasRides = <?php echo $has_rides ? 'true' : 'false'; ?>;
        
        // Get current and previous month names
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const currentDate = new Date();
        const currentMonth = months[currentDate.getMonth()];
        const previousMonth = months[(currentDate.getMonth() - 1 + 12) % 12];
        
        // Update the select option with the previous month name
        document.addEventListener('DOMContentLoaded', function() {
            if (hasRides) {
                const timeFilter = document.getElementById('timeFilter');
                timeFilter.innerHTML = `
                    <option value="all">All Time</option>
                    <option value="30days">Last 30 Days</option>
                    <option value="lastMonth">${previousMonth}</option>
                    <option value="3months">Last 3 Months</option>
                `;
                
                // Initialize the page with all rides
                renderRideHistory('all', 'all');
                
                // Initialize stats animation
                updateStats();
            }
        });

        // Function to filter rides based on selected time period
        function filterRidesByTime(timePeriod) {
            const now = Math.floor(Date.now() / 1000); // Current timestamp in seconds
            let filteredRides = [];
            
            switch (timePeriod) {
                case 'all':
                    filteredRides = rideHistory;
                    break;
                case '30days':
                    const thirtyDaysAgo = now - (30 * 24 * 60 * 60);
                    filteredRides = rideHistory.filter(ride => {
                        // Convert ride date to timestamp
                        const rideDate = new Date(ride.rideDate).getTime() / 1000;
                        return rideDate >= thirtyDaysAgo;
                    });
                    break;
                case 'lastMonth':
                    const firstDayOfCurrentMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getTime() / 1000;
                    const firstDayOfLastMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1).getTime() / 1000;
                    filteredRides = rideHistory.filter(ride => {
                        const rideDate = new Date(ride.rideDate).getTime() / 1000;
                        return rideDate >= firstDayOfLastMonth && rideDate < firstDayOfCurrentMonth;
                    });
                    break;
                case '3months':
                    const threeMonthsAgo = now - (90 * 24 * 60 * 60);
                    filteredRides = rideHistory.filter(ride => {
                        const rideDate = new Date(ride.rideDate).getTime() / 1000;
                        return rideDate >= threeMonthsAgo;
                    });
                    break;
                default:
                    filteredRides = rideHistory;
            }
            
            return filteredRides;
        }
        
        // Function to filter rides by trip type
        function filterRidesByType(rides, tripType) {
            if (tripType === 'all') {
                return rides;
            }
            return rides.filter(ride => {
                // For demo purposes, let's assume trips with higher prices are business
                // In real application, you would have a tripType field in your database
                return tripType === 'business' ? ride.rent > 20 : ride.rent <= 20;
            });
        }
        
        // Function to render ride history
        function renderRideHistory(tripType = 'all', timePeriod = 'all') {
            const historyList = document.getElementById('historyList');
            let filteredRides = filterRidesByTime(timePeriod);
            filteredRides = filterRidesByType(filteredRides, tripType);
            
            if (filteredRides.length === 0) {
                let emptyMessage = "";
                let emptyTitle = "";
                if(tripType === 'personal') tripType = 'business';
                else if(tripType === 'business') tripType = 'personal';
                if (tripType !== 'all' && timePeriod !== 'all') {
                    emptyTitle = `No ${tripType} Rides in Selected Period`;
                    emptyMessage = `You don't have any ${tripType} rides in the selected time period.`;
                } else if (tripType !== 'all') {
                    emptyTitle = `No ${tripType} Rides`;
                    emptyMessage = `You don't have any ${tripType} rides in your history.`;
                } else if (timePeriod !== 'all') {
                    switch (timePeriod) {
                        case '30days':
                            emptyTitle = "No Rides in the Last 30 Days";
                            emptyMessage = "You haven't taken any rides in the past 30 days. Ready to book your next trip?";
                            break;
                        case 'lastMonth':
                            emptyTitle = `No Rides in ${previousMonth}`;
                            emptyMessage = `You didn't take any rides during ${previousMonth}. Time to explore new destinations?`;
                            break;
                        case '3months':
                            emptyTitle = "No Recent Rides";
                            emptyMessage = "You haven't taken any rides in the last 3 months. Your ride history is waiting for new adventures!";
                            break;
                        default:
                            emptyTitle = "No Ride History Yet";
                            emptyMessage = "You haven't taken any rides yet. Your journey begins with that first trip!";
                    }
                } else {
                    emptyTitle = "No Ride History Yet";
                    emptyMessage = "You haven't taken any rides yet. Your journey begins with that first trip!";
                }
                
                historyList.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-car"></i>
                        <h3>${emptyTitle}</h3>
                        <p>${emptyMessage}</p>
                        <button class="book-ride-btn" onclick="window.location.href='ride.php'">
                            Book Your First Ride
                        </button>
                    </div>
                `;
            } else {
                historyList.innerHTML = filteredRides
                    .map(ride => `
                        <div class="history-item">
                            <div class="trip-info">
                                <div class="trip-route">${ride.pickupLocation} → ${ride.destination}</div>
                                <div class="trip-date">${formatDate(ride.rideDate)}</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="trip-price">${ride.rent} TK</div>
                                <div class="trip-status status-completed">Completed</div>
                            </div>
                        </div>
                    `)
                    .join('');
            }
        }
        
        // Helper function to format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric', 
                year: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
        }
        
        // Function to update stats with animation
function updateStats() {
    // Animate total rides
    animateValue("totalRides", 0, <?php echo $has_rides ? $total_rides : 0; ?>, 1500);
    
    // Animate total distance
    animateValue("totalDistance", 0, <?php echo $has_rides ? round($total_distance) : 0; ?>, 1500);
    
    // Animate points (no decimal places)
    animateValue("totalPoints", 0, <?php echo $has_rides ? $total_points : '1000'; ?>, 1500);
    
    // Animate total spent (with 2 decimal places)
    animateValue("totalSpent", 0, <?php echo $has_rides ? $total_spent : 0; ?>, 1500, true);
}

// Function to animate value changes
function animateValue(id, start, end, duration, isCurrency = false) {
    const obj = document.getElementById(id);
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        
        if (isCurrency) {
            // For currency, show 2 decimal places
            const value = (progress * (end - start) + start).toFixed(2);
            obj.innerHTML = "BDT " + value ;
        } else if (id === "totalPoints") {
            // For points (totalPoints element), show as integer
            const value = Math.floor(progress * (end - start) + start);
            obj.innerHTML = value;
        } else {
            // For other integers (rides, distance)
            const value = Math.floor(progress * (end - start) + start);
            obj.innerHTML = value;
        }
        
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}
        
        // Tab switching functionality
        if (hasRides) {
            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    document.querySelectorAll('.tab').forEach(t => {
                        t.classList.remove('active');
                    });
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Get the selected trip type
                    const tripType = this.getAttribute('data-tab');
                    
                    // Get the current time filter
                    const timeFilter = document.getElementById('timeFilter').value;
                    
                    // Render the filtered rides
                    renderRideHistory(tripType, timeFilter);
                });
            });
            
            // Filter change functionality
            document.getElementById('timeFilter').addEventListener('change', function() {
                // Get the current tab
                const activeTab = document.querySelector('.tab.active');
                const tripType = activeTab ? activeTab.getAttribute('data-tab') : 'all';
                
                // Render the filtered rides
                renderRideHistory(tripType, this.value);
            });
        }
    </script>
</body>
</html>