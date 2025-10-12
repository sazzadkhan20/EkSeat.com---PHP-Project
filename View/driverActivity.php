<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EkSeat.com - Driver Dashboard</title>
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
            --primary-light: #e8f0fe;
            --secondary-color: #f8f9fa;
            --text-color: #202124;
            --light-text: #5f6368;
            --border-color: #dadce0;
            --success-color: #34a853;
            --warning-color: #f9ab00;
            --danger-color: #ea4335;
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
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 30px;
            margin-left: 280px;
            overflow-y: auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-color);
        }
        
        .date-filter {
            display: flex;
            align-items: center;
            background: white;
            padding: 10px 16px;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            transition: all 0.3s;
        }
        
        .date-filter:hover {
            box-shadow: var(--hover-shadow);
        }
        
        .date-filter select {
            border: none;
            background: transparent;
            outline: none;
            cursor: pointer;
            font-weight: 500;
            color: var(--text-color);
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
            transition: all 0.3s;
            border: 1px solid transparent;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
            border-color: var(--primary-light);
        }
        
        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            color: var(--primary-color);
            font-size: 24px;
        }
        
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-color);
        }
        
        .stat-label {
            color: var(--light-text);
            font-size: 15px;
            font-weight: 500;
        }
        
        /* Dashboard Sections */
        .dashboard-section {
            background: white;
            border-radius: 12px;
            padding: 28px;
            margin-bottom: 30px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-color);
        }
        
        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
        }
        
        .view-all:hover {
            gap: 10px;
        }
        
        /* Earnings Section */
        .earnings-display {
            text-align: center;
            padding: 20px 0;
        }
        
        .earnings-amount {
            font-size: 42px;
            font-weight: 700;
            color: var(--primary-color);
            margin: 10px 0;
        }
        
        .earnings-period {
            color: var(--light-text);
            font-size: 16px;
            font-weight: 500;
        }
        
        /* Quick Actions */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
        
        .action-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 20px 16px;
            font-size: 15px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            box-shadow: 0 2px 6px rgba(26, 115, 232, 0.2);
        }
        
        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(26, 115, 232, 0.3);
        }
        
        .action-btn.secondary {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }
        
        .action-btn.secondary:hover {
            background: var(--primary-light);
            box-shadow: var(--hover-shadow);
        }
        
        .action-btn i {
            font-size: 24px;
            margin-bottom: 12px;
        }
        
        /* Recent Rides */
        .rides-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .rides-table th {
            text-align: left;
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            color: var(--light-text);
            font-weight: 500;
            font-size: 14px;
        }
        
        .rides-table td {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .rides-table tr:last-child td {
            border-bottom: none;
        }
        
        .rides-table tr:hover td {
            background-color: var(--primary-light);
        }
        
        .ride-route {
            font-weight: 600;
            margin-bottom: 4px;
        }
        
        .ride-details {
            color: var(--light-text);
            font-size: 14px;
        }
        
        .ride-earnings {
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .rating {
            color: #ffc107;
            font-size: 16px;
        }
        
        /* Map Section */
        .map-container {
            height: 300px;
            background: linear-gradient(135deg, #e8f0fe, #f1f3f4);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-text);
            margin-top: 20px;
            border: 1px dashed var(--border-color);
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .stats-grid, .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            .sidebar {
                width: 240px;
            }
            
            .main-content {
                margin-left: 240px;
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            
            .stats-grid, .actions-grid {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .date-filter {
                align-self: stretch;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
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
                <a href="driverActivity.php" class="nav-item active">
                <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="driverRide.php" class="nav-item ">
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
            <div class="header">
                <h1 class="page-title">Driver Dashboard</h1>
                <div class="date-filter">
                    <i class="fas fa-calendar-alt" style="margin-right: 8px; color: var(--light-text);"></i>
                    <select>
                        <option>Today</option>
                        <option>This Week</option>
                        <option>This Month</option>
                        <option>Custom Range</option>
                    </select>
                </div>
            </div>
            
            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="stat-value">44</div>
                    <div class="stat-label">Total Rides</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-road"></i>
                    </div>
                    <div class="stat-value">1900</div>
                    <div class="stat-label">Distance (km)</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-value">4.8</div>
                    <div class="stat-label">Rating</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="stat-value">BDT 2070</div>
                    <div class="stat-label">Today's Earnings</div>
                </div>
            </div>
            
            <!-- Earnings Section -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">Earnings Overview</h2>
                    <a href="#" class="view-all">View Report <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="earnings-display">
                    <div class="earnings-amount">BDT 12,540.00</div>
                    <div class="earnings-period">This Week • 5% increase from last week</div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">Quick Actions</h2>
                </div>
                <div class="actions-grid">
                    <button class="action-btn">
                        <i class="fas fa-play-circle"></i>
                        Go Online
                    </button>
                    <button class="action-btn secondary">
                        <i class="fas fa-calendar"></i>
                        Set Schedule
                    </button>
                    <button class="action-btn secondary">
                        <i class="fas fa-map-marked-alt"></i>
                        My Routes
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-file-invoice-dollar"></i>
                        Earnings Report
                    </button>
                </div>
            </div>
            
            <!-- Recent Rides -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">Recent Rides</h2>
                    <a href="#" class="view-all">View All <i class="fas fa-chevron-right"></i></a>
                </div>
                <table class="rides-table">
                    <thead>
                        <tr>
                            <th>Route</th>
                            <th>Date & Time</th>
                            <th>Distance</th>
                            <th>Earnings</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="ride-route">Banani to Gulshan</div>
                                <div class="ride-details">Rider: Kamal H.</div>
                            </td>
                            <td>Today, 10:30 AM</td>
                            <td>4.2 km</td>
                            <td class="ride-earnings">BDT 120</td>
                            <td class="rating">★★★★★</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="ride-route">Uttara to Airport</div>
                                <div class="ride-details">Rider: Fatima B.</div>
                            </td>
                            <td>Today, 9:15 AM</td>
                            <td>8.7 km</td>
                            <td class="ride-earnings">BDT 210</td>
                            <td class="rating">★★★★☆</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="ride-route">Dhanmondi to Motijheel</div>
                                <div class="ride-details">Rider: Rajib K.</div>
                            </td>
                            <td>Yesterday, 5:45 PM</td>
                            <td>6.3 km</td>
                            <td class="ride-earnings">BDT 150</td>
                            <td class="rating">★★★★★</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="ride-route">Mirpur to Farmgate</div>
                                <div class="ride-details">Rider: Nusrat J.</div>
                            </td>
                            <td>Yesterday, 2:20 PM</td>
                            <td>5.1 km</td>
                            <td class="ride-earnings">BDT 130</td>
                            <td class="rating">★★★★☆</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Activity Map -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">Your Activity Map</h2>
                </div>
                <div class="map-container">
                    <i class="fas fa-map-marked-alt" style="font-size: 48px; margin-right: 15px; color: var(--primary-color);"></i>
                    <div>
                        <p style="font-size: 18px; font-weight: 500; margin-bottom: 8px;">Interactive Activity Map</p>
                        <p style="font-size: 14px;">Showing your recent ride routes and hotspots</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle driver status
        const statusToggle = document.getElementById('statusToggle');
        const goOnlineBtn = document.querySelector('.action-btn');
        
        statusToggle.addEventListener('click', function() {
            this.classList.toggle('offline');
            if (this.classList.contains('offline')) {
                this.innerHTML = '<i class="fas fa-circle"></i> Offline';
                goOnlineBtn.innerHTML = '<i class="fas fa-play-circle"></i> Go Online';
            } else {
                this.innerHTML = '<i class="fas fa-circle"></i> Online';
                goOnlineBtn.innerHTML = '<i class="fas fa-pause-circle"></i> Go Offline';
            }
        });
        
        // Update Go Online button text when clicked
        goOnlineBtn.addEventListener('click', function() {
            if (this.innerHTML.includes('Go Online')) {
                statusToggle.classList.remove('offline');
                statusToggle.innerHTML = '<i class="fas fa-circle"></i> Online';
                this.innerHTML = '<i class="fas fa-pause-circle"></i> Go Offline';
            } else {
                statusToggle.classList.add('offline');
                statusToggle.innerHTML = '<i class="fas fa-circle"></i> Offline';
                this.innerHTML = '<i class="fas fa-play-circle"></i> Go Online';
            }
        });
        
        // Add hover effects to table rows
        document.querySelectorAll('.rides-table tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.2s ease';
            });
        });
    </script>
</body>
</html>