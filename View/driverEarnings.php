<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings - EkSeat.com</title>
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
            --text-color: #333;
            --light-text: #666;
            --border-color: #e0e0e0;
            --primary-light: #e8f0fe;
            --secondary-color: #f8f9fa;
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
        
        .period-selector {
            display: flex;
            align-items: center;
            background: white;
            padding: 8px 15px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .period-selector select {
            border: none;
            background: transparent;
            outline: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        /* Earnings Overview */
        .earnings-overview {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .earnings-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }
        
        .earnings-card.main {
            grid-column: span 2;
            background: linear-gradient(135deg, var(--primary-color), #0d5bc2);
            color: white;
        }
        
        .card-title {
            font-size: 16px;
            color: var(--light-text);
            margin-bottom: 10px;
        }
        
        .earnings-card.main .card-title {
            color: rgba(255,255,255,0.8);
        }
        
        .card-value {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .card-change {
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .positive {
            color: var(--success-color);
        }
        
        .earnings-card.main .positive {
            color: rgba(255,255,255,0.9);
        }
        
        .negative {
            color: var(--danger-color);
        }
        
        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .chart-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .chart-title {
            font-size: 18px;
            font-weight: bold;
        }
        
        .chart-actions {
            display: flex;
            gap: 10px;
        }
        
        .chart-btn {
            background: var(--secondary-color);
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .chart-btn.active {
            background: var(--primary-color);
            color: white;
        }
        
        .chart-container {
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-text);
        }
        
        .chart-placeholder {
            text-align: center;
        }
        
        .chart-placeholder i {
            font-size: 48px;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        /* Summary Stats */
        .summary-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }
        
        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 15px;
            background: var(--secondary-color);
            border-radius: 8px;
        }
        
        .stat-value {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 14px;
            color: var(--light-text);
        }
        
        /* Transactions Section */
        .transactions-section {
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
        
        .section-actions {
            display: flex;
            gap: 10px;
        }
        
        .filter-btn {
            background: var(--secondary-color);
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .filter-btn.active {
            background: var(--primary-color);
            color: white;
        }
        
        .transactions-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .transactions-table th {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid var(--border-color);
            color: var(--light-text);
            font-weight: normal;
        }
        
        .transactions-table td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .transaction-ride {
            font-weight: bold;
        }
        
        .transaction-details {
            color: var(--light-text);
            font-size: 14px;
        }
        
        .transaction-amount {
            font-weight: bold;
        }
        
        .transaction-positive {
            color: var(--success-color);
        }
        
        .transaction-negative {
            color: var(--danger-color);
        }
        
        .transaction-status {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-completed {
            background: rgba(52, 168, 83, 0.1);
            color: var(--success-color);
        }
        
        .status-pending {
            background: rgba(249, 171, 0, 0.1);
            color: var(--warning-color);
        }
        
        .status-cancelled {
            background: rgba(234, 67, 53, 0.1);
            color: var(--danger-color);
        }
        
        /* Withdrawal Section */
        .withdrawal-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .withdrawal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .withdrawal-balance {
            display: flex;
            flex-direction: column;
        }
        
        .balance-label {
            font-size: 16px;
            color: var(--light-text);
            margin-bottom: 5px;
        }
        
        .balance-amount {
            font-size: 28px;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .withdrawal-actions {
            display: flex;
            gap: 15px;
        }
        
        .withdrawal-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .withdrawal-btn:hover {
            background: #0d5bc2;
        }
        
        .withdrawal-btn.secondary {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }
        
        .withdrawal-btn.secondary:hover {
            background: var(--secondary-color);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 250px;
            }
            
            .main-content {
                margin-left: 250px;
            }
            
            .earnings-overview {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .earnings-card.main {
                grid-column: span 2;
            }
            
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .summary-stats {
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
            
            .earnings-overview {
                grid-template-columns: 1fr;
            }
            
            .earnings-card.main {
                grid-column: span 1;
            }
            
            .summary-stats {
                grid-template-columns: 1fr;
            }
            
            .withdrawal-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
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
                <a href="driverRide.php" class="nav-item">
                    <i class="fas fa-car"></i> Rides
                </a>
                <a href="driverEarnings.php" class="nav-item active">
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
            <h1 class="page-title">Earnings</h1>
            <div class="period-selector">
                <i class="fas fa-calendar-alt" style="margin-right: 8px; color: var(--light-text);"></i>
                <select id="periodSelect">
                    <option>This Week</option>
                    <option>Last Week</option>
                    <option selected>This Month</option>
                    <option>Last Month</option>
                    <option>Last 3 Months</option>
                    <option>This Year</option>
                    <option>Custom Range</option>
                </select>
            </div>
        </div>
        
        <!-- Earnings Overview -->
        <div class="earnings-overview">
            <div class="earnings-card main">
                <div class="card-title">Total Earnings</div>
                <div class="card-value">BDT 12,540.00</div>
                <div class="card-change positive">
                    <i class="fas fa-arrow-up"></i> 12.5% from last month
                </div>
            </div>
            <div class="earnings-card">
                <div class="card-title">Completed Rides</div>
                <div class="card-value">44</div>
                <div class="card-change positive">
                    <i class="fas fa-arrow-up"></i> 8.2% from last month
                </div>
            </div>
            <div class="earnings-card">
                <div class="card-title">Average per Ride</div>
                <div class="card-value">BDT 285</div>
                <div class="card-change positive">
                    <i class="fas fa-arrow-up"></i> 4.1% from last month
                </div>
            </div>
            <div class="earnings-card">
                <div class="card-title">Online Hours</div>
                <div class="card-value">36.5</div>
                <div class="card-change negative">
                    <i class="fas fa-arrow-down"></i> 2.3% from last month
                </div>
            </div>
        </div>
        
        <!-- Charts Section -->
        <div class="charts-section">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Earnings Trend</h3>
                    <div class="chart-actions">
                        <button class="chart-btn active">Daily</button>
                        <button class="chart-btn">Weekly</button>
                        <button class="chart-btn">Monthly</button>
                    </div>
                </div>
                <div class="chart-container">
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-line"></i>
                        <p>Earnings trend chart visualization</p>
                        <p style="font-size: 14px; margin-top: 10px;">Showing daily earnings for the current month</p>
                    </div>
                </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Earnings by Type</h3>
                </div>
                <div class="chart-container">
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-pie"></i>
                        <p>Earnings distribution chart</p>
                        <p style="font-size: 14px; margin-top: 10px;">Breakdown by ride type</p>
                    </div>
                </div>
                <div class="summary-stats">
                    <div class="stat-item">
                        <div class="stat-value">65%</div>
                        <div class="stat-label">Economy</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">22%</div>
                        <div class="stat-label">Comfort</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">13%</div>
                        <div class="stat-label">Premium</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Transactions Section -->
        <div class="transactions-section">
            <div class="section-header">
                <h2 class="section-title">Recent Transactions</h2>
                <div class="section-actions">
                    <button class="filter-btn active">All</button>
                    <button class="filter-btn">Completed</button>
                    <button class="filter-btn">Pending</button>
                    <button class="filter-btn">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>
            
            <table class="transactions-table">
                <thead>
                    <tr>
                        <th>Ride Details</th>
                        <th>Date & Time</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="transaction-ride">Banani to Gulshan</div>
                            <div class="transaction-details">Ride #7892 • 4.2 km</div>
                        </td>
                        <td>Today, 10:30 AM</td>
                        <td class="transaction-amount transaction-positive">BDT 120</td>
                        <td><span class="transaction-status status-completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="transaction-ride">Uttara to Airport</div>
                            <div class="transaction-details">Ride #7891 • 8.7 km</div>
                        </td>
                        <td>Today, 9:15 AM</td>
                        <td class="transaction-amount transaction-positive">BDT 210</td>
                        <td><span class="transaction-status status-completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="transaction-ride">Dhanmondi to Motijheel</div>
                            <div class="transaction-details">Ride #7890 • 6.3 km</div>
                        </td>
                        <td>Yesterday, 5:45 PM</td>
                        <td class="transaction-amount transaction-positive">BDT 150</td>
                        <td><span class="transaction-status status-completed">Completed</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="transaction-ride">Mirpur to Farmgate</div>
                            <div class="transaction-details">Ride #7889 • 5.1 km</div>
                        </td>
                        <td>Yesterday, 2:20 PM</td>
                        <td class="transaction-amount transaction-positive">BDT 130</td>
                        <td><span class="transaction-status status-pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="transaction-ride">Gulshan to Bashundhara</div>
                            <div class="transaction-details">Ride #7888 • 7.5 km</div>
                        </td>
                        <td>Oct 12, 3:40 PM</td>
                        <td class="transaction-amount transaction-negative">- BDT 25</td>
                        <td><span class="transaction-status status-cancelled">Cancelled</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Withdrawal Section -->
        <div class="withdrawal-section">
            <div class="withdrawal-header">
                <div class="withdrawal-balance">
                    <div class="balance-label">Available Balance</div>
                    <div class="balance-amount">BDT 8,750.00</div>
                </div>
                <div class="withdrawal-actions">
                    <button class="withdrawal-btn secondary">
                        <i class="fas fa-history"></i> Transaction History
                    </button>
                    <button class="withdrawal-btn">
                        <i class="fas fa-money-bill-wave"></i> Withdraw Funds
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Period selector change handler
        document.getElementById('periodSelect').addEventListener('change', function() {
            console.log('Period changed to:', this.value);
        });
        
        // Chart buttons functionality
        document.querySelectorAll('.chart-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.querySelectorAll('.chart-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
                console.log('Chart timeframe changed to:', this.textContent);
            });
        });
        
        // Filter buttons functionality
        document.querySelectorAll('.filter-btn').forEach(button => {
            if (!button.querySelector('.fa-download')) {
                button.addEventListener('click', function() {
                    this.parentElement.querySelectorAll('.filter-btn').forEach(btn => {
                        if (!btn.querySelector('.fa-download')) {
                            btn.classList.remove('active');
                        }
                    });
                    this.classList.add('active');
                    console.log('Filter changed to:', this.textContent);
                });
            }
        });
        
        // Withdraw funds button
        document.querySelector('.withdrawal-btn:not(.secondary)').addEventListener('click', function() {
            alert('Withdrawal functionality would open here.');
        });
        
        // Transaction history button
        document.querySelector('.withdrawal-btn.secondary').addEventListener('click', function() {
            alert('Transaction history would open here.');
        });
    </script>
</body>
</html>