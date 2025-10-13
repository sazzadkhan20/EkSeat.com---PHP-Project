<?php 
    session_start();
    require_once '../Model/checkCookie.php';

    // Check if user is logged in using cookies
    $isLoggedIn = checkAuthCookieForDriver();

    // Dynamic navigation bar based on login status
    if (!$isLoggedIn) 
        header("Location: ../View/signIn.php");

    $fullName = trim($_COOKIE["driver_name"]);
    $parts = explode(" ", $fullName);
    $firstName;
    $lastName;
    if (count($parts) > 1) 
    {
        // Last word is last name, rest is first name
        $lastName = array_pop($parts);
        $firstName = implode(" ", $parts);
    } 
    else 
    {
        // Only one word → treat as first name
        $firstName = $fullName;
        $lastName = "-";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - EkSeat.com</title>
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
            --success-color: #34a853;
            --danger-color: #ea4335;
            --warning-color: #fbbc05;
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
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .page-subtitle {
            color: var(--light-text);
            font-size: 16px;
        }
        
        /* Settings Content */
        .settings-content {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .content-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }
        
        /* Profile Section */
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            margin-right: 20px;
        }
        
        .profile-info h3 {
            font-size: 22px;
            margin-bottom: 5px;
        }
        
        .profile-info p {
            color: var(--light-text);
            margin-bottom: 10px;
        }
        
        .change-photo {
            color: var(--primary-color);
            font-weight: 500;
            cursor: pointer;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group.full-width {
            grid-column: span 2;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
            outline: none;
        }
        
        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 16px;
            background: white;
            cursor: pointer;
        }
        
        /* Toggle Switch */
        .toggle-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }
        
        .toggle-info h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .toggle-info p {
            font-size: 14px;
            color: var(--light-text);
        }
        
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .toggle-slider {
            background-color: var(--primary-color);
        }
        
        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }
        
        /* Payment Methods */
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .payment-method {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .payment-method:hover {
            border-color: var(--primary-color);
        }
        
        .payment-method.selected {
            border-color: var(--primary-color);
            background-color: rgba(26, 115, 232, 0.05);
        }
        
        .payment-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-color);
            font-size: 18px;
        }
        
        .payment-details {
            flex: 1;
        }
        
        .payment-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .payment-info {
            color: var(--light-text);
            font-size: 14px;
        }
        
        .add-payment {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--light-text);
        }
        
        .add-payment:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .add-payment i {
            margin-right: 10px;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }
        
        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-size: 16px;
        }
        
        .btn-primary {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background: #0d5bc2;
        }
        
        .btn-secondary {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }
        
        .btn-secondary:hover {
            background: var(--secondary-color);
        }
        
        /* Danger Zone */
        .danger-zone {
            border: 1px solid var(--danger-color);
            border-radius: 8px;
            padding: 20px;
            background: rgba(234, 67, 53, 0.05);
        }
        
        .danger-title {
            color: var(--danger-color);
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .danger-description {
            color: var(--light-text);
            margin-bottom: 15px;
        }
        
        .btn-danger {
            background: var(--danger-color);
            color: white;
        }
        
        .btn-danger:hover {
            background: #d32f2f;
        }
        
        /* Enhanced Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }
        
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .modal {
            background: white;
            border-radius: 20px;
            width: 90%;
            max-width: 480px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: translateY(30px) scale(0.95);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
        }
        
        .modal-overlay.active .modal {
            transform: translateY(0) scale(1);
        }
        
        .modal-header {
            padding: 30px 30px 20px;
            text-align: center;
            background: linear-gradient(135deg, #ff6b6b, var(--danger-color));
            color: white;
            position: relative;
        }
        
        .modal-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 36px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .modal-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .modal-subtitle {
            opacity: 0.9;
            font-size: 16px;
        }
        
        .modal-body {
            padding: 25px 30px;
        }
        
        .modal-message {
            margin-bottom: 25px;
            line-height: 1.6;
            text-align: center;
            color: var(--light-text);
        }
        
        .warning-box {
            background: rgba(251, 188, 5, 0.1);
            border: 1px solid rgba(251, 188, 5, 0.3);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        
        .warning-icon {
            color: var(--warning-color);
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }
        
        .warning-text {
            color: var(--text-color);
            font-size: 14px;
        }
        
        .confirmation-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .confirmation-input:focus {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 2px rgba(234, 67, 53, 0.2);
            outline: none;
        }
        
        .confirmation-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }
        
        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }
        
        .modal-btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            min-width: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .modal-btn-cancel {
            background: white;
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }
        
        .modal-btn-cancel:hover {
            background: var(--secondary-color);
            border-color: var(--light-text);
        }
        
        .modal-btn-confirm {
            background: var(--danger-color);
            color: white;
            box-shadow: 0 4px 6px rgba(234, 67, 53, 0.3);
        }
        
        .modal-btn-confirm:hover {
            background: #d32f2f;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(234, 67, 53, 0.4);
        }
        
        .modal-btn-confirm:disabled {
            background: #cccccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(234, 67, 53, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(234, 67, 53, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(234, 67, 53, 0);
            }
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 250px;
            }
            
            .main-content {
                margin-left: 250px;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-group.full-width {
                grid-column: span 1;
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
            
            .payment-methods {
                grid-template-columns: 1fr;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .modal {
                width: 95%;
                margin: 20px;
            }
            
            .modal-footer {
                flex-direction: column;
            }
            
            .modal-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
            <div class="logo">
            <a href="driverActivity.php"><img src="Resources/Logo.jpg" alt="Logo" style="height:30px;"/></a>
            </div>
            
            <div class="driver-profile">
                <div class="driver-avatar"><?php echo strtoupper(substr($_COOKIE["driver_name"], 0, 2)); ?></div>
                <div class="driver-details">
                    <h2><?php echo $_COOKIE["driver_name"]; ?></h2>
                    <p>Driver ID: <?php echo $_COOKIE["driver_id"]; ?></p>
                </div>
            </div>
            
            <div class="nav-menu">
                <a href="driverActivity.php" class="nav-item">
                <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="driverRide.php" class="nav-item">
                    <i class="fas fa-car"></i> Rides
                </a>
                <a href="driverEarnings.php" class="nav-item">
                    <i class="fas fa-chart-line"></i> Earnings
                </a>
                <a href="driverSettings.php" class="nav-item active">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <a href="driverHelp.php" class="nav-item">
                    <i class="fas fa-question-circle"></i> Help & Support
                </a>
                <a href="../Model/driverLogout.php" class="nav-item">
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
            <h1 class="page-title">Account Settings</h1>
            <p class="page-subtitle">Manage your account settings and preferences</p>
        </div>
        
        <!-- Settings Content -->
        <div class="settings-content">
            <!-- Profile Section -->
            <div class="content-section">
                <h2 class="section-title">Profile Information</h2>
                
                <div class="profile-header">
                    <div class="profile-avatar"><?php echo strtoupper(substr($_COOKIE["driver_name"], 0, 2)); ?></div>
                    <div class="profile-info">
                        <h3><?php echo $_COOKIE["driver_name"]; ?></h3>
                        <p>Driver ID: <?php echo $_COOKIE["driver_id"]; ?></p>
                        <span class="change-photo">Change Photo</span>
                    </div>
                </div>
                
                <form action="../Model/updateDriverProfile.php" method="POST" class="driver-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-input" Name = "FirstName" value="<?php echo $firstName; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-input" Name = "LastName" value="<?php echo $lastName; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-input" Name = "Email" value="<?php echo $_COOKIE["driver_email"]; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-input" Name = "Phone" value="<?php echo $_COOKIE["driver_phone"]; ?>">
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-input" Name = "Address" value="<?php echo $_COOKIE["driver_address"]; ?>">
                    </div>
                </div>
            </div>
            
            <!-- Notification Settings -->
            <div class="content-section">
                <h2 class="section-title">Notification Settings</h2>
                
                <div class="toggle-group">
                    <div class="toggle-info">
                        <h4>Ride Notifications</h4>
                        <p>Get notified about new ride requests</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                
                <div class="toggle-group">
                    <div class="toggle-info">
                        <h4>Promotions & Offers</h4>
                        <p>Receive special offers and promotions</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                
                <div class="toggle-group">
                    <div class="toggle-info">
                        <h4>Earnings Updates</h4>
                        <p>Get daily and weekly earnings summaries</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                
                <div class="toggle-group">
                    <div class="toggle-info">
                        <h4>App Updates</h4>
                        <p>Notifications about app features and updates</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
            
            <!-- Payment Methods -->
            <div class="content-section">
                <h2 class="section-title">Payment Methods</h2>
                
                <div class="payment-methods">
                    <div class="payment-method selected">
                        <div class="payment-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="payment-details">
                            <div class="payment-name">Bank Account</div>
                            <div class="payment-info">**** 4567</div>
                        </div>
                    </div>
                    
                    <div class="payment-method">
                        <div class="payment-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="payment-details">
                            <div class="payment-name">bKash</div>
                            <div class="payment-info"><?php echo $_COOKIE["driver_phone"]; ?></div>
                        </div>
                    </div>
                    
                    <div class="payment-method">
                        <div class="payment-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="payment-details">
                            <div class="payment-name">Nagad</div>
                            <div class="payment-info"><?php echo $_COOKIE["driver_phone"]; ?></div>
                        </div>
                    </div>
                    
                    <div class="add-payment">
                        <i class="fas fa-plus"></i> Add Payment Method
                    </div>
                </div>
            </div>
            
            <!-- Ride Preferences -->
            <div class="content-section">
                <h2 class="section-title">Ride Preferences</h2>
                
                <div class="form-group">
                    <label class="form-label">Default Vehicle Type</label>
                    <select class="form-select">
                        <option>Economy</option>
                        <option selected>Comfort</option>
                        <option>Premium</option>
                        <option>Bike</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Preferred Working Hours</label>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Start Time</label>
                            <input type="time" class="form-input" value="09:00">
                        </div>
                        <div class="form-group">
                            <label class="form-label">End Time</label>
                            <input type="time" class="form-input" value="17:00">
                        </div>
                    </div>
                </div>
                
                <div class="toggle-group">
                    <div class="toggle-info">
                        <h4>Auto-Accept Rides</h4>
                        <p>Automatically accept ride requests in preferred areas</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
            
            <!-- Danger Zone -->
            <div class="content-section">
                <h2 class="section-title">Danger Zone</h2>
                
                <div class="danger-zone">
                    <div class="danger-title">Delete Account</div>
                    <div class="danger-description">
                        Once you delete your account, there is no going back. This action is permanent and all your data will be erased.
                    </div>
                    <button type = "button" class="btn btn-danger" id="deleteAccountBtn">Delete My Account</button>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type = "button" class="btn btn-secondary">Cancel</button>
                <button type = "submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
    </form>
    
    <!-- Enhanced Delete Account Confirmation Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-icon pulse">
                    <i class="fas fa-exclamation"></i>
                </div>
                <h2 class="modal-title">Delete Your Account?</h2>
                <p class="modal-subtitle">This action cannot be undone</p>
            </div>
            <div class="modal-body">
                <p class="modal-message">
                    You are about to permanently delete your EkSeat driver account. 
                    This will remove all your data, including ride history, earnings, and personal information.
                </p>
                
                <div class="warning-box">
                    <div class="warning-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="warning-text">
                        <strong>Warning:</strong> This action is irreversible. Once deleted, you will not be able to recover your account or any associated data.
                    </div>
                </div>
                
                <label class="confirmation-label" for="confirmText">
                    Type <strong>DELETE</strong> to confirm:
                </label>
                <input type="text" class="confirmation-input" id="confirmText" placeholder="Type DELETE here">
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-cancel" id="cancelDelete">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button class="modal-btn modal-btn-confirm" id="confirmDelete" disabled>
                    <i class="fas fa-trash-alt"></i>
                    Delete Account
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toggle switch functionality
        document.querySelectorAll('.toggle-switch input').forEach(toggle => {
            toggle.addEventListener('change', function() {
                console.log('Toggle changed:', this.checked);
            });
        });
        
        // Payment method selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(m => {
                    m.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });
        
        // Add payment method
        document.querySelector('.add-payment').addEventListener('click', function() {
            alert('Add payment method functionality would open here.');
        });
        
        // Save changes button
        document.querySelector('.btn-primary').addEventListener('click', function() {
            //alert('Your settings have been saved successfully!');
        });
        
        // Delete account modal functionality
        const deleteAccountBtn = document.getElementById('deleteAccountBtn');
        const deleteModal = document.getElementById('deleteModal');
        const cancelDeleteBtn = document.getElementById('cancelDelete');
        const confirmDeleteBtn = document.getElementById('confirmDelete');
        const confirmText = document.getElementById('confirmText');
        
        // Show modal when delete account button is clicked
        deleteAccountBtn.addEventListener('click', function() {
            deleteModal.classList.add('active');
            confirmText.value = '';
            confirmDeleteBtn.disabled = true;
        });
        
        // Hide modal when cancel button is clicked
        cancelDeleteBtn.addEventListener('click', function() {
            deleteModal.classList.remove('active');
        });
        
        // Hide modal when clicking outside the modal
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                deleteModal.classList.remove('active');
            }
        });
        
        // Enable/disable confirm button based on input
        confirmText.addEventListener('input', function() {
            if (this.value.toUpperCase() === 'DELETE') {
                confirmDeleteBtn.disabled = false;
            } else {
                confirmDeleteBtn.disabled = true;
            }
        });
        
        // Redirect to driverDelete.php when confirm button is clicked
        confirmDeleteBtn.addEventListener('click', function() {
            if (!this.disabled) {
                // Add a loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                this.disabled = true;
                
                // Simulate a brief delay before redirecting
                setTimeout(() => {
                    window.location.href = '../Model/driverDelete.php';
                }, 1500);
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && deleteModal.classList.contains('active')) {
                deleteModal.classList.remove('active');
            }
        });
    </script>
</body>
</html>