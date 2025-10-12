<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            width: 1000px;
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
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: border 0.2s ease;
        }

        input:focus, textarea:focus {
            border: 1px solid #3498db;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-save {
            background-color: #3498db;
            color: #fff;
        }

        .btn-save:hover {
            background-color: #2980b9;
        }

        .btn-cancel {
            background-color: #bdc3c7;
            color: #2c3e50;
        }

        .btn-cancel:hover {
            background-color: #95a5a6;
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

            <!-- Content -->
            <div class="content">
                <h2 class="section-title">Edit Personal Information</h2>

                <form action="updateUserInfoProcess.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="Saiful Islam Oni" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="saifulislamoni06@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" value="01794272292" required>
                    </div>

                    <div class="form-group">
                        <label for="nid">NID</label>
                        <input type="text" id="nid" name="nid" value="-" >
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" required>189/1 Amtola west Manikdi, Dhaka Cantontment, Dhaka 1206.</textarea>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel" onclick="window.location.href='userProfile.php'">Cancel</button>
                        <button type="submit" class="btn btn-save">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once 'footer.html'; ?>
</body>
</html>
