<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            width: 1500px;
            margin: 0 auto;
            padding: 20px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 300px 1fr;
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
            width: 100%;
        }

        form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-top: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #7f8c8d;
            margin-bottom: 5px;
        }

        input, textarea {
            padding: 10px 15px;
            font-size: 16px;
            border: 1px solid #e1e4e8;
            border-radius: 6px;
            outline: none;
            transition: all 0.3s ease;
            background-color: white;
        }

        input:focus, textarea:focus {
            border: 1px solid #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        textarea {
            resize: none;
            height: 80px;
            font-family: inherit;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            min-width: 140px;
        }

        .btn-save {
            background-color: #3498db;
            color: #fff;
        }

        .btn-save:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-cancel {
            background-color: #e1e4e8;
            color: #5a6c7d;
        }

        .btn-cancel:hover {
            background-color: #d1d5da;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Fixed button icon and text alignment */
        .btn i {
            margin-right: 8px;
            font-size: 14px;
        }
        
        /* Profile Picture Section for Edit Page */
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
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .change-picture-btn:hover {
            background-color: white;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }
        
        .change-picture-btn i {
            margin-right: 5px;
        }
        .errorMessage {
        color: red;
        text-align: center;
        font-weight: bold;
        margin-top: 10px;
        font-size: 18px;
        }
    </style>
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
                        <a href="userProfile.php" class="nav-link">
                            <i class="fas fa-user"></i> My Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="editUserProfile.php" class="nav-link active">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="userWallet.php" class="nav-link">
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

            <!-- Content -->
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
                    <button type="button" class="change-picture-btn">
                        <i class="fas fa-camera"></i> Change Picture
                    </button>
                </div>
                
                <h2 class="section-title">Edit Personal Information</h2>

                <form action="../Model/updateUserProfile.php" method="POST" onsubmit="return ValidateUserProfile()">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="Name" name="Name" value= "<?php echo  $_COOKIE['user_name'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="Email" name="Email" value="<?php echo $_COOKIE['user_login'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="Phone" name="Phone" value="<?php echo $_COOKIE['user_phone'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nid">NID</label>
                        <input type="text" id="NID" name="NID" value="<?php echo $_COOKIE['user_nid'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="Address" name="Address" ><?php echo $_COOKIE['user_address'] ?></textarea>
                    </div>
                    <div>
                        <p class = "errorMessage" id="errorMessage" style="color: red;"></p>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" onclick="window.location.href='userProfile.php'">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="../Controller/userProfileEditValidation.js"></script>
    <?php include_once 'footer.html'; ?>
</body>
</html>