<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saiful Islam Oni - Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
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
        
        .main-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }
        
        .sidebar {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 25px;
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
            background-color: white;
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
        }
        
        .profile-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .info-group {
            margin-bottom: 20px;
        }
        
        .info-label {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .info-value {
            font-size: 16px;
            color: #2c3e50;
            font-weight: 500;
            padding: 8px 0;
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
        
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .profile-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'userNavBar.php'; ?>
    
    <div class="container">
        
        <div class="main-content">
            <div class="sidebar">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-user"></i> My Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-certificate"></i> Wallet
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-book-open"></i> Activity   
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="content">
                <h2 class="section-title">Personal Information</h2>
                
                <div class="profile-info">
                    <div class="info-group">
                        <div class="info-label">Name</div>
                        <div class="info-value">Saiful Islam Oni</div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Email</div>
                        <div class="info-value">saifulislamoni06@gmail.com</div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Phone</div>
                        <div class="info-value">01794272292</div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">NID</div>
                        <div class="info-value">-</div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Address</div>
                        <div class="info-value">-</div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Date of Registration</div>
                        <div class="info-value">2003-09-04</div>
                    </div>
                </div>
                
                <button class="edit-btn">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>
</body>
</html>