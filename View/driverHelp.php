<?php 
    session_start();
    require_once '../Model/checkCookie.php';

    // Check if user is logged in using cookies
    $isLoggedIn = checkAuthCookieForDriver();

    // Dynamic navigation bar based on login status
    if (!$isLoggedIn) 
        header("Location: ../View/signIn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support - EkSeat.com</title>
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
        
        /* Help & Support Content */
        .help-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .help-section {
            background: white;
            border-radius: 12px;
            padding: 28px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            transition: all 0.3s;
        }
        
        .help-section:hover {
            transform: translateY(-3px);
            box-shadow: var(--hover-shadow);
        }
        
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .section-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-color);
            font-size: 22px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-color);
        }
        
        .help-links {
            list-style: none;
        }
        
        .help-link {
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s;
        }
        
        .help-link:last-child {
            border-bottom: none;
        }
        
        .help-link a {
            display: flex;
            align-items: center;
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .help-link a:hover {
            color: var(--primary-color);
        }
        
        .help-link i {
            margin-right: 10px;
            color: var(--primary-color);
            width: 20px;
            text-align: center;
        }
        
        /* Contact Section */
        .contact-section {
            background: white;
            border-radius: 12px;
            padding: 28px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        
        .contact-card {
            background: var(--secondary-color);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s;
        }
        
        .contact-card:hover {
            background: var(--primary-light);
            transform: translateY(-3px);
        }
        
        .contact-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 24px;
        }
        
        .contact-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .contact-info {
            color: var(--light-text);
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .contact-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .contact-btn:hover {
            background: var(--primary-dark);
        }
        
        /* FAQ Section */
        .faq-section {
            background: white;
            border-radius: 12px;
            padding: 28px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
        }
        
        .faq-item {
            margin-bottom: 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .faq-question {
            padding: 16px 20px;
            background: var(--secondary-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .faq-question:hover {
            background: var(--primary-light);
        }
        
        .faq-question h3 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }
        
        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .faq-answer.active {
            padding: 20px;
            max-height: 500px;
        }
        
        .faq-answer p {
            margin: 0;
            color: var(--light-text);
            line-height: 1.6;
        }
        
        /* Emergency Section */
        .emergency-section {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            border-radius: 12px;
            padding: 28px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(238, 90, 82, 0.3);
        }
        
        .emergency-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .emergency-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 22px;
        }
        
        .emergency-title {
            font-size: 22px;
            font-weight: 700;
        }
        
        .emergency-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .emergency-info p {
            margin-bottom: 10px;
            opacity: 0.9;
        }
        
        .emergency-btn {
            background: white;
            color: #ee5a52;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        
        .emergency-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .help-container {
                grid-template-columns: 1fr;
            }
            
            .contact-grid {
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
            
            .contact-grid {
                grid-template-columns: 1fr;
            }
            
            .emergency-content {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
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
                 <a href="driverActivity.php" class="nav-item ">
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
                <a href="driverHelp.php" class="nav-item active">
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
            <div class="header">
                <h1 class="page-title">Help & Support</h1>
            </div>
            
            <!-- Emergency Section -->
            <div class="emergency-section">
                <div class="emergency-header">
                    <div class="emergency-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h2 class="emergency-title">Emergency Assistance</h2>
                </div>
                <div class="emergency-content">
                    <div class="emergency-info">
                        <p>If you're in an emergency situation or need immediate assistance, our support team is available 24/7.</p>
                        <p><strong>Emergency Hotline: 999</strong></p>
                    </div>
                    <button class="emergency-btn">
                        <i class="fas fa-phone-alt"></i> Call Emergency Support
                    </button>
                </div>
            </div>
            
            <!-- Help Container -->
            <div class="help-container">
                <!-- Getting Started -->
                <div class="help-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <h2 class="section-title">Getting Started</h2>
                    </div>
                    <ul class="help-links">
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-book"></i>
                                Driver Onboarding Guide
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-car"></i>
                                Vehicle Requirements
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-id-card"></i>
                                Document Verification
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-cog"></i>
                                App Setup & Configuration
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Account & Payments -->
                <div class="help-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h2 class="section-title">Account & Payments</h2>
                    </div>
                    <ul class="help-links">
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-money-check"></i>
                                Payment Methods & Withdrawals
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-receipt"></i>
                                Understanding Your Earnings
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-user-edit"></i>
                                Updating Account Information
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-shield-alt"></i>
                                Account Security
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Ride Management -->
                <div class="help-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-road"></i>
                        </div>
                        <h2 class="section-title">Ride Management</h2>
                    </div>
                    <ul class="help-links">
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-map-marker-alt"></i>
                                Navigation & Routes
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-star"></i>
                                Rating System Explained
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-times-circle"></i>
                                Handling Cancellations
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-comments"></i>
                                Communication with Riders
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Technical Support -->
                <div class="help-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h2 class="section-title">Technical Support</h2>
                    </div>
                    <ul class="help-links">
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-mobile-alt"></i>
                                App Troubleshooting
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-wifi"></i>
                                Connectivity Issues
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-sync"></i>
                                App Updates & Features
                            </a>
                        </li>
                        <li class="help-link">
                            <a href="#">
                                <i class="fas fa-bug"></i>
                                Report a Bug
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Contact Section -->
            <div class="contact-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h2 class="section-title">Contact Support</h2>
                </div>
                <div class="contact-grid">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 class="contact-title">Phone Support</h3>
                        <p class="contact-info">Available 24/7 for urgent issues</p>
                        <p class="contact-info"><strong>+880 XXXX-XXXXXX</strong></p>
                        <button class="contact-btn">Call Now</button>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="contact-title">Email Support</h3>
                        <p class="contact-info">Response within 24 hours</p>
                        <p class="contact-info"><strong>support@ekseat.com</strong></p>
                        <button class="contact-btn">Send Email</button>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3 class="contact-title">Live Chat</h3>
                        <p class="contact-info">Available 8AM - 12AM</p>
                        <p class="contact-info"><strong>Instant response</strong></p>
                        <button class="contact-btn">Start Chat</button>
                    </div>
                </div>
            </div>
            
            <!-- FAQ Section -->
            <div class="faq-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <h2 class="section-title">Frequently Asked Questions</h2>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>How do I reset my password?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>To reset your password, go to Settings > Account > Change Password. You'll receive a verification code on your registered email or phone number to complete the process.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>When will I receive my payments?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Payments are processed weekly every Monday. It may take 1-3 business days to reflect in your account depending on your bank. You can track your payments in the Earnings section.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>What should I do if a rider cancels the ride?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>If a rider cancels before you arrive, you'll receive a cancellation fee if applicable. If they cancel after you've arrived, make sure to wait for at least 5 minutes before marking the ride as cancelled to be eligible for the cancellation fee.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>How can I improve my driver rating?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Maintain a clean vehicle, drive safely, follow navigation routes, be polite to riders, and avoid cancellations. You can also ask satisfied riders to rate you at the end of the trip.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <h3>What documents do I need to keep driving with EkSeat?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>You need a valid driver's license, vehicle registration, and insurance documents. These need to be updated annually in the app. You'll receive notifications 30 days before any document expires.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle driver status
        const statusToggle = document.getElementById('statusToggle');
        
        statusToggle.addEventListener('click', function() {
            this.classList.toggle('offline');
            if (this.classList.contains('offline')) {
                this.innerHTML = '<i class="fas fa-circle"></i> Offline';
            } else {
                this.innerHTML = '<i class="fas fa-circle"></i> Online';
            }
        });
        
        // FAQ toggle functionality
        function toggleFAQ(element) {
            const answer = element.nextElementSibling;
            const icon = element.querySelector('i');
            
            // Close all other FAQs
            document.querySelectorAll('.faq-answer').forEach(item => {
                if (item !== answer) {
                    item.classList.remove('active');
                }
            });
            
            document.querySelectorAll('.faq-question i').forEach(item => {
                if (item !== icon) {
                    item.className = 'fas fa-chevron-down';
                }
            });
            
            // Toggle current FAQ
            answer.classList.toggle('active');
            icon.className = answer.classList.contains('active') ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
        }
        
        // Contact button functionality
        document.querySelectorAll('.contact-btn').forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.contact-card');
                const title = card.querySelector('.contact-title').textContent;
                alert(`Connecting you to ${title}...`);
            });
        });
        
        // Emergency button functionality
        document.querySelector('.emergency-btn').addEventListener('click', function() {
            if (confirm('Are you sure you want to call emergency support? This should only be used for genuine emergencies.')) {
                alert('Connecting to emergency support... Please stay on the line.');
            }
        });
    </script>
</body>
</html>