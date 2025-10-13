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
        
        /* Delete Account Section */
        .delete-account-section {
            margin-top: 40px;
            padding: 25px;
            background-color: #fff5f5;
            border: 1px solid #fed7d7;
            border-radius: 10px;
        }
        
        .delete-title {
            font-size: 20px;
            font-weight: 600;
            color: #e53e3e;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .delete-description {
            color: #718096;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .delete-btn {
            background-color: #e53e3e;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .delete-btn:hover {
            background-color: #c53030;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(229, 62, 62, 0.3);
        }
        
        /* Modal Styles */
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
            background: linear-gradient(135deg, #ff6b6b, #e53e3e);
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
            color: #4a5568;
        }
        
        .warning-box {
            background: rgba(251, 211, 141, 0.2);
            border: 1px solid rgba(237, 137, 54, 0.3);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        
        .warning-icon {
            color: #ed8936;
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }
        
        .warning-text {
            color: #4a5568;
            font-size: 14px;
        }
        
        .confirmation-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .confirmation-input:focus {
            border-color: #e53e3e;
            box-shadow: 0 0 0 2px rgba(229, 62, 62, 0.2);
            outline: none;
        }
        
        .confirmation-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2d3748;
        }
        
        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #e2e8f0;
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
            color: #4a5568;
            border: 1px solid #e2e8f0;
        }
        
        .modal-btn-cancel:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
        }
        
        .modal-btn-confirm {
            background: #e53e3e;
            color: white;
            box-shadow: 0 4px 6px rgba(229, 62, 62, 0.3);
        }
        
        .modal-btn-confirm:hover {
            background: #c53030;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(229, 62, 62, 0.4);
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
                box-shadow: 0 0 0 0 rgba(229, 62, 62, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(229, 62, 62, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(229, 62, 62, 0);
            }
        }
        
        @media (max-width: 768px) {
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
                
                <!-- Delete Account Section -->
                <div class="delete-account-section">
                    <div class="delete-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Delete Account
                    </div>
                    <div class="delete-description">
                        Once you delete your account, there is no going back. This action is permanent and all your data will be erased.
                    </div>
                    <button class="delete-btn" id="deleteAccountBtn">
                        <i class="fas fa-trash-alt"></i>
                        Delete My Account
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Account Confirmation Modal -->
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
                    You are about to permanently delete your EkSeat account. 
                    This will remove all your data, including ride history, personal information, and wallet balance.
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

<script src="../Controller/userProfileEditValidation.js"></script>
    <?php include_once 'footer.html'; ?>
    
    <script>
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
        
        // Redirect to userDelete.php when confirm button is clicked
        confirmDeleteBtn.addEventListener('click', function() {
            if (!this.disabled) {
                // Add a loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                this.disabled = true;
                
                // Simulate a brief delay before redirecting
                setTimeout(() => {
                    window.location.href = '../Model/userDelete.php';
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