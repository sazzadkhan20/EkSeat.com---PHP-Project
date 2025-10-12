<?php
    session_start();
    require_once 'create.php';
    require_once 'query.php';
    require_once 'queryExecution.php';

    $tablename = "ridebookinghistory";
    db_create($dbname);
    table_create($dbname, $tablename, $cqridebookinghistorytable);

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $pickup = $_POST['pickup'] ?? '';
        $destination = $_POST['destination'] ?? '';
        $distance = $_POST['distance'] ?? '';
        $service_type = $_POST['service_type'] ?? '';
        $vehicle_type = $_POST['vehicle_type'] ?? '';
        $rent = $_POST['price'] ?? '';
        $transactionID =  strtoupper(bin2hex(random_bytes(16))).date("ymd");
        date_default_timezone_set("Asia/Dhaka"); // Set timezone
        $booking_date = date("M d, Y h:i A");
        $email = $_SESSION['user_email'] ?? '';
        
        // Sanitize data (basic sanitization)
        $pickup = htmlspecialchars($pickup);
        $destination = htmlspecialchars($destination);
        $distance = floatval($distance);
        $rent = floatval($rent);
        
        $conn = new mysqli('localhost', 'root', '', $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $stmt = $conn->prepare($iqridebookinghistorytable);
        $stmt->bind_param("sssssddss", $transactionID, $email, $vehicle_type, $pickup, $destination, $rent, $distance, $service_type, $booking_date);
        
        if ($stmt->execute()) 
        {
            //update points for user 100
            $result = emailVerify($adquserinfotable, $email);
            if($row = $result->fetch_assoc())
                updateinfo_for_int($uquserinfotableforpoints,(int)$row['uPoints']+100,$email);
            // Show success popup instead of redirecting immediately
            showSuccessPopup($pickup, $destination, $vehicle_type, $rent, $transactionID);
        } else {
            header("Location: ../View/ride.php?error=" . urlencode("Failed to book ride. Please try again."));
            exit();
        }
        
        $stmt->close();
        $conn->close();
    }

        function showSuccessPopup($pickup, $destination, $vehicle_type, $price, $transactionID) 
        {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Ride Booking Successful</title>
                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                        min-height: 100vh;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
                    
                    .popup-overlay {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0,0,0,0.8);
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        z-index: 10000;
                    }
                    
                    .popup-content {
                        background: white;
                        padding: 40px;
                        border-radius: 15px;
                        text-align: center;
                        max-width: 500px;
                        width: 90%;
                        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                        animation: popupFadeIn 0.5s ease-out;
                    }
                    
                    @keyframes popupFadeIn {
                        from { opacity: 0; transform: scale(0.9); }
                        to { opacity: 1; transform: scale(1); }
                    }
                    
                    .emoji {
                        font-size: 60px;
                        margin-bottom: 20px;
                        color: #27ae60;
                    }
                    
                    .title {
                        color: #27ae60;
                        margin-bottom: 10px;
                        font-size: 28px;
                    }
                    
                    .subtitle {
                        color: #2c3e50;
                        margin-bottom: 20px;
                        font-size: 20px;
                    }
                    
                    .booking-details {
                        background: #f8f9fa;
                        padding: 20px;
                        border-radius: 10px;
                        margin: 20px 0;
                        text-align: left;
                    }
                    
                    .detail-row {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 10px;
                        padding: 5px 0;
                    }
                    
                    .detail-row:last-child {
                        margin-bottom: 0;
                    }
                    
                    .price {
                        color: #27ae60;
                        font-weight: bold;
                    }
                    
                    .transaction-id {
                        font-size: 12px;
                        color: #666;
                        margin-top: 5px;
                    }
                    
                    .instruction {
                        color: #666;
                        margin-bottom: 25px;
                        line-height: 1.5;
                        font-size: 16px;
                    }
                    
                    .confirm-btn {
                        background: #27ae60;
                        color: white;
                        border: none;
                        padding: 15px 40px;
                        font-size: 16px;
                        border-radius: 8px;
                        cursor: pointer;
                        font-weight: bold;
                        transition: all 0.3s;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                    }
                    
                    .confirm-btn:hover {
                        background: #219a52;
                        transform: translateY(-2px);
                        box-shadow: 0 6px 8px rgba(0,0,0,0.15);
                    }
                </style>
            </head>
            <body>
                <div class="popup-overlay">
                    <div class="popup-content">
                        <div class="emoji">🎉</div>
                        <h2 class="title">Congratulations!</h2>
                        <h3 class="subtitle">Your Ride is Ready!</h3>
                        
                        <div class="booking-details">
                            <div class="detail-row">
                                <strong>From:</strong>
                                <span><?php echo htmlspecialchars($pickup); ?></span>
                            </div>
                            <div class="detail-row">
                                <strong>To:</strong>
                                <span><?php echo htmlspecialchars($destination); ?></span>
                            </div>
                            <div class="detail-row">
                                <strong>Vehicle:</strong>
                                <span><?php echo htmlspecialchars($vehicle_type); ?></span>
                            </div>
                            <div class="detail-row">
                                <strong>Total Fare:</strong>
                                <span class="price"><?php echo number_format($price, 2); ?> TK</span>
                            </div>
                            <div class="transaction-id">
                                Transaction ID: <?php echo htmlspecialchars($transactionID); ?>
                            </div>
                        </div>
                        
                        <p class="instruction">Your ride is confirmed! Your driver is on the way. Tap "Awesome! Let’s Go" to return to the main page and track your trip.</p>
                        
                        <button class="confirm-btn" onclick="redirectToRidePage()">
                            Awesome! Let's Go
                        </button>
                    </div>
                </div>

                <script>
                    function redirectToRidePage() {
                        window.location.href = "../View/home.php";
                    }
                    
                    // Optional: Close popup when clicking outside
                    document.querySelector('.popup-overlay').addEventListener('click', function(e) {
                        if (e.target === this) {
                            redirectToRidePage();
                        }
                    });
                    
                    // Optional: Close with Escape key
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') {
                            redirectToRidePage();
                        }
                    });
                </script>
            </body>
            </html>
            <?php
            exit();
        }
?>