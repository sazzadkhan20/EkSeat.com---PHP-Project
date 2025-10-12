<?php

    session_start();

    // Create connection
    $conn = new mysqli('localhost','root','','ekseat_com');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user email (in real application, this would come from session/login)
    $user_email = $_COOKIE['user_login']; // Replace with actual user email from session

    // Fetch user data
    $user_sql = "SELECT * FROM userinfo WHERE uEmail = ?";
    $user_stmt = $conn->prepare($user_sql);
    $user_stmt->bind_param("s", $user_email);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    $user = $user_result->fetch_assoc();

    // Fetch ride history
    $rides_sql = "SELECT * FROM ridebookinghistory WHERE uEmail = ? ORDER BY rideDate DESC";
    $rides_stmt = $conn->prepare($rides_sql);
    $rides_stmt->bind_param("s", $user_email);
    $rides_stmt->execute();
    $rides_result = $rides_stmt->get_result();
    $ride_history = [];
    $total_rides = 0;
    $total_spent = 0.0;
    $total_distance = 0.0;

    while($row = $rides_result->fetch_assoc()) {
        $ride_history[] = $row;
        $total_rides++;
        $total_distance += $row['distance'];
        $total_spent += $row['rent'];
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Ride History</title>
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
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary);
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
        
        .secondary-button {
            background-color: var(--light);
            color: var(--primary);
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 auto;
        }
        
        .secondary-button:hover {
            background-color: var(--gray);
            transform: translateY(-2px);
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
            <div class="logo">RideApp</div>
            <div class="nav-links">
                <a href="#" class="active">Home</a>
                <a href="#">Rides</a>
                <a href="#">History</a>
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
                <div class="stat-value" id="totalRides"><?php echo $total_rides; ?></div>
                <div class="stat-label">Total Rides</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(76, 175, 80, 0.2); color: #4caf50;">
                    <i class="fas fa-road"></i>
                </div>
                <div class="stat-value" id="totalDistance"><?php echo round($total_distance); ?></div>
                <div class="stat-label">Distance (km)</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(255, 152, 0, 0.2); color: #ff9800;">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-value" id="avgRating">4.8</div>
                <div class="stat-label">Avg. Rating</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background-color: rgba(156, 39, 176, 0.2); color: #9c27b0;">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-value" id="totalSpent"><?php echo number_format($total_spent, 2) ; ?></div>
                <div class="stat-label">Total Spent</div>
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
                
                <div class="tabs">
                    <div class="tab active">Personal</div>
                    <div class="tab">Business</div>
                    <div class="tab active">All Trips</div>
                </div>
                
                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="filter-label">Filter by:</div>
                    <select class="filter-select" id="timeFilter">
                        <option value="all">All Trips</option>
                        <option value="30days">Last 30 Days</option>
                        <option value="lastMonth">Previous Month</option>
                        <option value="3months">Last 3 Months</option>
                    </select>
                </div>
                
                <div class="history-section">
                    <h2 class="history-title">Recent Trips</h2>
                    <div class="history-list" id="historyList">
                        <?php if(count($ride_history) > 0): ?>
                            <?php foreach($ride_history as $ride): ?>
                                <div class="history-item">
                                    <div class="trip-info">
                                        <div class="trip-route"><?php echo htmlspecialchars($ride['pickupLocation']); ?> → <?php echo htmlspecialchars($ride['destination']); ?></div>
                                        <div class="trip-date"><?php echo date('M j, Y g:i A', strtotime($ride['rideDate'])); ?></div>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <div class="trip-price">$<?php echo $ride['rent']; ?></div>
                                        <div class="trip-status status-<?php echo completed; ?>"><?php echo completed; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-car-side"></i>
                                <h3>No Ride History Yet</h3>
                                <p>You haven't taken any rides yet. Your journey begins with that first trip!</p>
                                <button class="secondary-button" onclick="window.location.href='ride.php'">
                                    <i class="fas fa-car"></i>
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
                    <p>Interactive visualization of your trips</p>
                </div>
                <div class="image-card driver-card">
                    <i class="fas fa-user-tie"></i>
                    <p>Your Favorite Drivers</p>
                    <p>Drivers you've rated 5 stars</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get current and previous month names
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const currentDate = new Date();
        const currentMonth = months[currentDate.getMonth()];
        const previousMonth = months[(currentDate.getMonth() - 1 + 12) % 12];
        
        // Update the select option with the previous month name
        document.addEventListener('DOMContentLoaded', function() {
            const timeFilter = document.getElementById('timeFilter');
            timeFilter.innerHTML = `
                <option value="all">All Trips</option>
                <option value="30days">Last 30 Days</option>
                <option value="lastMonth">${previousMonth}</option>
                <option value="3months">Last 3 Months</option>
            `;
        });

        // Filter change functionality
        document.getElementById('timeFilter').addEventListener('change', function() {
            // In a real application, this would make an AJAX call to filter results
            alert('Filtering by: ' + this.value + '\nIn a real app, this would reload data from server');
        });
        
        // Button click handlers
        document.querySelector('.cta-button').addEventListener('click', function() {
            alert('Booking functionality would go here');
        });
        
        // Animation for stats
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats counting up
            const statValues = document.querySelectorAll('.stat-value');
            statValues.forEach(stat => {
                const finalValue = parseFloat(stat.textContent.replace('$', ''));
                let startValue = 0;
                const duration = 1500;
                const increment = finalValue / (duration / 16);
                
                const updateStat = () => {
                    startValue += increment;
                    if (startValue < finalValue) {
                        if (stat.textContent.includes('$')) {
                            stat.textContent = '$' + Math.floor(startValue);
                        } else {
                            stat.textContent = Math.floor(startValue);
                        }
                        setTimeout(updateStat, 16);
                    } else {
                        if (stat.textContent.includes('$')) {
                            stat.textContent = '$' + finalValue;
                        } else {
                            stat.textContent = finalValue;
                        }
                    }
                };
                
                updateStat();
            });
        });
    </script>
</body>
</html>