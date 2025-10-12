<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rides - EkSeat.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        :root {
            --primary-color: #052c5fff;
            --primary-dark: #072347ff;
            --secondary-color: #f8f9fa;
            --text-color: #333;
            --light-text: #666;
            --border-color: #e0e0e0;
            --danger-color: #ea4335;
            --primary-light: #e8f0fe;
            --text-color: #202124;
            --light-text: #5f6368;
            --border-color: #dadce0;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
            --hover-shadow: 0 4px 6px rgba(0,0,0,0.07), 0 1px 3px rgba(0,0,0,0.06);
        }
        
        body {
            background-color: #f8fafc;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }
        
        .logo {
            padding: 24px;
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i {
            font-size: 22px;
        }
        
        .driver-profile {
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }
        
        .driver-avatar {
             width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 22px;
            color: white;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(26, 115, 232, 0.2);
        }
        
        .driver-details h2 {
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .driver-details p {
            color: var(--light-text);
            font-size: 14px;
            background: var(--secondary-color);
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        
        .nav-menu {
            flex: 1;
            padding: 20px 0;
        }
        
        .nav-item {
            padding: 14px 24px;
            display: flex;
            align-items: center;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s;
            margin: 4px 12px;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .nav-item:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
        }
        
        .nav-item.active {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 2px 6px rgba(26, 115, 232, 0.3);
        }
        
        .nav-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 18px;
        }
        
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: bold;
        }
        
        .status-toggle {
            margin: 20px;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            box-shadow: 0 2px 6px rgba(26, 115, 232, 0.3);
        }
        .status-toggle:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(26, 115, 232, 0.4);
        }
        
        .status-toggle.offline {
            background: linear-gradient(135deg, #5f6368, #3c4043);
            box-shadow: 0 2px 6px rgba(95, 99, 104, 0.3);
        }
        
        .status-toggle.offline:hover {
            box-shadow: 0 4px 8px rgba(95, 99, 104, 0.4);
        }
        
        .status-toggle i {
            margin-right: 8px;
            font-size: 12px;
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            text-align: center;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--light-text);
            font-size: 14px;
        }
        
        /* Rides Section */
        .rides-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: bold;
        }
        
        .filter-options {
            display: flex;
            gap: 10px;
        }
        
        .filter-btn {
            background: var(--secondary-color);
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
        }
        
        .filter-btn.active {
            background: var(--primary-color);
            color: white;
        }
        
        .rides-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .rides-table th {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
            color: var(--light-text);
            font-weight: normal;
        }
        
        .rides-table td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .ride-route {
            font-weight: bold;
        }
        
        .ride-details {
            color: var(--light-text);
            font-size: 14px;
        }
        
        .ride-earnings {
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .ride-status {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-completed {
            background: rgba(52, 168, 83, 0.1);
            color: var(--success-color);
        }
        
        .status-ongoing {
            background: rgba(26, 115, 232, 0.1);
            color: var(--primary-color);
        }
        
        .status-cancelled {
            background: rgba(234, 67, 53, 0.1);
            color: var(--danger-color);
        }
        
        /* Current Ride */
        .current-ride {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .ride-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .info-card {
            background: var(--secondary-color);
            padding: 15px;
            border-radius: 8px;
        }
        
        .info-label {
            font-size: 14px;
            color: var(--light-text);
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 18px;
            font-weight: bold;
        }
        
        .ride-actions {
            display: flex;
            gap: 15px;
        }
        
        .action-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .btn-primary {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-secondary {
            background: var(--secondary-color);
            color: var(--text-color);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 250px;
            }
            
            .main-content {
                margin-left: 250px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
                z-index: 1000;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .ride-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="Resources/Logo.jpg" alt="Logo" style="height:30px;"/>
         </div>
            
            <div class="driver-profile">
                <div class="driver-avatar">M</div>
                <div class="driver-details">
                    <h2>Md. Sazzad Khan</h2>
                    <p>Driver ID: DRV-7892</p>
                </div>
            </div>
        
        <div class="nav-menu">
                <a href="driverActivity.php" class="nav-item ">
                <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="driverRides.php" class="nav-item active">
                    <i class="fas fa-car"></i> Rides
                </a>
                <a href="driverEarnings.php" class="nav-item">
                    <i class="fas fa-chart-line"></i> Earnings
                </a>
                <a href="driverSettings.php" class="nav-item">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <a href="driverHelp.php" class="nav-item">
                    <i class="fas fa-question-circle"></i> Help & Support
                </a>
                <a href="home.php" class="nav-item">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                
            </div>
            <button class="status-toggle" id="statusToggle">
                <i class="fas fa-circle"></i> Online
            </button>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Rides</h1>
            <button class="status-toggle">
                <i class="fas fa-circle"></i> Online
            </button>
        </div>
        
        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">44</div>
                <div class="stat-label">Total Rides</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">1900</div>
                <div class="stat-label">Distance (km)</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">4.8</div>
                <div class="stat-label">Rating</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">BDT 2070</div>
                <div class="stat-label">Today's Earnings</div>
            </div>
        </div>
        
        <!-- Current Ride -->
        <div class="current-ride">
            <h2 class="section-title">Current Ride</h2>
            <div class="ride-info">
                <div class="info-card">
                    <div class="info-label">Passenger</div>
                    <div class="info-value">Kamal Hossain</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Route</div>
                    <div class="info-value">Gulshan to Banani</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Distance</div>
                    <div class="info-value">4.2 km</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Estimated Fare</div>
                    <div class="info-value">BDT 120</div>
                </div>
            </div>
            <div class="ride-actions">
                <button class="action-btn btn-secondary">Cancel Ride</button>
                <button class="action-btn btn-primary">Navigate</button>
            </div>
        </div>
        
        <!-- Recent Rides -->
        <div class="rides-section">
            <div class="section-header">
                <h2 class="section-title">Recent Rides</h2>
                <div class="filter-options">
                    <button class="filter-btn active">All</button>
                    <button class="filter-btn">Today</button>
                    <button class="filter-btn">This Week</button>
                </div>
            </div>
            
            <table class="rides-table">
                <thead>
                    <tr>
                        <th>Ride Details</th>
                        <th>Date & Time</th>
                        <th>Earnings</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="ride-route">Banani to Gulshan</div>
                            <div class="ride-details">Rider: Kamal H.</div>
                        </td>
                        <td>Today, 10:30 AM</td>
                        <td class="ride-earnings">BDT 120</td>
                        <td><span class="ride-status status-completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ride-route">Uttara to Airport</div>
                            <div class="ride-details">Rider: Fatima B.</div>
                        </td>
                        <td>Today, 9:15 AM</td>
                        <td class="ride-earnings">BDT 210</td>
                        <td><span class="ride-status status-completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ride-route">Dhanmondi to Motijheel</div>
                            <div class="ride-details">Rider: Rajib K.</div>
                        </td>
                        <td>Yesterday, 5:45 PM</td>
                        <td class="ride-earnings">BDT 150</td>
                        <td><span class="ride-status status-completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ride-route">Mirpur to Farmgate</div>
                            <div class="ride-details">Rider: Nusrat J.</div>
                        </td>
                        <td>Yesterday, 2:20 PM</td>
                        <td class="ride-earnings">BDT 130</td>
                        <td><span class="ride-status status-completed">Completed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Toggle online status
        const statusToggle = document.querySelector('.status-toggle');
        statusToggle.addEventListener('click', function() {
            const isOnline = this.innerHTML.includes('Online');
            if (isOnline) {
                this.innerHTML = '<i class="fas fa-circle"></i> Offline';
                this.style.background = '#666';
            } else {
                this.innerHTML = '<i class="fas fa-circle"></i> Online';
                this.style.background = 'var(--primary-color)';
            }
        });
        
        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>