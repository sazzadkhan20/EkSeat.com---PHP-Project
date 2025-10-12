<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e1e4e8;
        }
        
        .profile-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .profile-id {
            font-size: 16px;
            color: #7f8c8d;
            font-weight: 500;
        }
        
        .container {
            width: 1500px;          /* ✅ Fixed width of the entire main window */
            margin: 0 auto;
            padding: 20px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 300px 1fr;   /* ✅ Sidebar fixed, content flexible */
            gap: 30px;
            margin-top: 50px;
        }

        .sidebar {
            width: 300px;
            background-color: rgba(181, 189, 215, 0.3);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        .profile-info {
            display: grid;
            grid-template-columns: 1fr;   /* ✅ One info per row inside content */
            gap: 20px;
        }

        /* Profile Picture Section */
        .profile-picture-section {
            position: relative;
            margin-bottom: 40px;
        }
        
        .cover-photo {
            height: 200px;
            background-image: url('Resources/ProfileCover.png');
            border-radius: 10px 10px 0 0;
            position: relative;
        }
        
        .profile-picture-container {
            position: absolute;
            bottom: -50px;
            left: 30px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        
        .profile-picture-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
            color: #6c757d;
            font-size: 40px;
            border-radius: 50%;
        }
        
        .change-picture-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 14px;
            font-weight: 500;
            color: #3498db;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .change-picture-btn:hover {
            background-color: white;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }
        
        .nav-menu {
            list-style: none;
        }
        
        .nav-item {
            margin-bottom: 15px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #5a6c7d;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: #e8f4fd;
            color: #3498db;
        }
        
        .nav-link i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .content {
            background-color: rgba(240, 240, 240, 0.5);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }
        
        .section-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #2c3e50;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
            display: inline-block;  
            width: 900px;
        }
        
        .info-group {
            margin-bottom: 20px;
        }
        
        .info-label {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 3px;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            color: #2c3e50;
            font-weight: 500;
            padding: 5px 0 10px 0;
            border-bottom: 1px solid #eaeaea; /* optional separator */
        }

        
        .verified-badge {
            display: inline-flex;
            align-items: center;
            background-color: #e8f6ef;
            color: #27ae60;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            margin-top: 5px;
        }
        
        .verified-badge i {
            margin-right: 5px;
        }
        
        .edit-btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            margin-top: 20px;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .edit-btn:hover {
            background-color: #2980b9;
        }
        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'userNavBar.php'; ?>
    </header>
    
    <div class="container">
        
        <div class="main-content">
            <!-- Sidebar -->
            <div class="sidebar">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="userProfile.php" class="nav-link active    ">
                            <i class="fas fa-user"></i> My Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="editUserProfile.php" class="nav-link">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-certificate"></i> Wallet
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="userActivity.php" class="nav-link">
                            <i class="fas fa-book-open"></i> Activity
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="content">
                <!-- Profile Picture Section -->
                <div class="profile-picture-section">
                    <div class="cover-photo"></div>
                    <div class="profile-picture-container">
                        <div class="profile-picture-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                        <!-- Uncomment below and remove the placeholder when user uploads a picture -->
                        <!-- <img src="profile-picture.jpg" alt="Profile Picture" class="profile-picture"> -->
                    </div>
                    <button class="change-picture-btn">
                        <i class="fas fa-camera"></i> Change Picture
                    </button>
                </div>
                
                <h2 class="section-title">Personal Information</h2>
                <button class="edit-btn" onclick="window.location.href='editUserProfile.php'">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
                
                <div class="profile-info">
                    <div class="info-group">
                        <div class="info-label">Name</div>
                        <div class="info-value"><?php echo $_COOKIE['user_name'] ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo $_COOKIE['user_login'] ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Phone</div>
                        <div class="info-value"><?php echo $_COOKIE['user_phone'] ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">NID</div>
                        <div class="info-value"><?php echo $_COOKIE['user_nid'] ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Address</div>
                        <div class="info-value"><?php echo $_COOKIE['user_address'] ?></div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Date of Registration</div>
                        <div class="info-value"><?php echo $_COOKIE['user_registerDate'] ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.html'; ?>
</body>
</html>