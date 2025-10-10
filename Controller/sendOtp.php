<?php 
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            // Handle OTP verification
            if ($action === 'verify') 
            {
                if (!isset($_POST['verify_OTP']) || empty(trim($_POST['verify_OTP']))) {
                    $_SESSION['errorVerify'] = "OTP is required";
                    header("Location: ../View/verifyOtp.php");
                }
                else
                {
                    $input_otp = trim($_POST['verify_OTP']);
                    if ($input_otp === $_SESSION['otp']) 
                    {
                        unset($_SESSION['otp']);
                        if ($_SESSION['otp_action'] === "forgot") 
                        {
                            unset($_SESSION['otp_action']);
                            header("Location: ../View/forgotPassword.php");
                        }
                        else 
                        {
                            unset($_SESSION['otp_action']);
                            unset($_SESSION['user_type']);
                            header("Location: ../View/userRegister.php");
                        }
                    } 
                    else 
                    {
                        $_SESSION['errorVerify'] = "Invalid OTP. Please try again.";
                        header("Location: ../View/verifyOtp.php");
                    }
                }
                
            } 
            else
            {
                require_once '../Model/queryExecution.php';
                // Handle OTP resend
                sendOTP();
                header("Location: ../View/verifyOtp.php");
            }
        }
    }
?>