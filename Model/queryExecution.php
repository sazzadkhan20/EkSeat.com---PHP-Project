<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function emailVerify($rquery, $condition)
    {
        $conn = new mysqli('localhost','root','','ekseat_com');
        if($conn->connect_error)
        die('Connection Failed : '.$conn->connect_error);
        else
        {
            $stmt = $conn->prepare($rquery);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
                exit();
            }
            $stmt->bind_param("s", $condition);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
            $stmt->close();
        }
        $conn->close();
    }
    
    function updateinfo($rquery,$condition,$email)
    {
        $conn = new mysqli('localhost','root','','ekseat_com');
        if($conn->connect_error)
            die('Connection Failed : '.$conn->connect_error);
        else
        {
            $stmt = $conn->prepare($rquery);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
                exit();
            }
            $stmt->bind_param("ss", $condition, $email);
            $stmt->execute();
            $stmt->close();
        }
        $conn->close();
    }

     function updateinfo_for_int($rquery,$condition,$email)
    {
        $conn = new mysqli('localhost','root','','ekseat_com');
        if($conn->connect_error)
            die('Connection Failed : '.$conn->connect_error);
        else
        {
            $stmt = $conn->prepare($rquery);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
                exit();
            }
            $stmt->bind_param("is", $condition, $email);
            $stmt->execute();
            $stmt->close();
        }
        $conn->close();
    }

     function updateinfo_for_image($rquery,$condition,$email)
    {
        $conn = new mysqli('localhost','root','','ekseat_com');
        if($conn->connect_error)
            die('Connection Failed : '.$conn->connect_error);
        else
        {
            $stmt = $conn->prepare($rquery);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
                exit();
            }
            $stmt->bind_param("bs", $condition, $email);
            $stmt->execute();
            $stmt->close();
        }
        $conn->close();
    }

     function updateinfo_for_float($rquery,$condition,$email)
    {
        $conn = new mysqli('localhost','root','','ekseat_com');
        if($conn->connect_error)
            die('Connection Failed : '.$conn->connect_error);
        else
        {
            $stmt = $conn->prepare($rquery);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
                exit();
            }
            $stmt->bind_param("ds", $condition, $email);
            $stmt->execute();
            $stmt->close();
        }
        $conn->close();
    }

    function unsetSession($message)
    {
        if (isset($_SESSION[$message]))
            unset($_SESSION[$message]);
    }
        
    function sendOTP()
    {
        //Load Composer's autoloader (created by composer, not included with PHPMailer)
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'ekseat.com@gmail.com';                     //SMTP username
            $mail->Password   = 'whlk xayd cceh qzrl';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('ekseat.com@gmail.com', 'Ekseat.com');
            $mail->addAddress($_SESSION['email'], ' ');     //Add a recipient

            $otp = (string) mt_rand(10000, 99999); //otp generation
            $_SESSION['otp'] = $otp;
            $mail->isHTML(true);
            $mail->Subject = 'OTP For EkSeat.com';
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
                    .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                    .header { text-align: center; color: #333; border-bottom: 2px solid #364160; padding-bottom: 20px; }
                    .otp-box { background: #364160; color: white; padding: 15px; border-radius: 5px; text-align: center; font-size: 24px; font-weight: bold; margin: 20px 0; }
                    .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 14px; }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>EkSeat.com</h1>
                        <h2>Your One-Time Password</h2>
                    </div>
                    
                    <p>Dear User,</p>
                    
                    <p>Here is your One-Time Password to securely log in to your Ekseat.com account:</p>
                    
                    <div class="otp-box">' . $_SESSION['otp'] . '</div>
                    
                    <p>Please do not share this OTP with anyone. It is valid for the next 10 minutes.</p>
                    
                    <p>If you did not request this OTP, please ignore this email.</p>
                    
                    <div class="footer">
                        <p>Thank you for choosing EkSeat.com</p>
                        <p>© ' . date('Y') . ' EkSeat.com. All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>
        ';

        $mail->send();
        } 
        catch (Exception $e) {
            header("Location: ../View/verifyOtp.php");
        }
    }
?>