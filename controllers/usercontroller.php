<?php

include_once('../connections/connections.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class usercontroller {

  

public function login($email, $password) {
    global $connections;
    session_start();

    $stmt = $connections->prepare("SELECT id, email, password, username, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fetchedID = $row['id'];
        $fetchedPassword = $row['password'];
        $username = $row['username'];
        $fetchedrole = $row['role'];

        if (password_verify($password, $fetchedPassword)) {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['id'] = $fetchedID;
            $_SESSION['role'] = $fetchedrole;
            $_SESSION['verified'] = false; // 🚫 Not yet verified

            // Try to send OTP
            if ($this->sendOTP($email, $otp, $username)) {
                header("Location: ../verifyotp.php");
                exit();
            } else {
                return "Failed to send OTP. Please try again.";
            }
        } else {
            return "Incorrect password.";
        }
    } else {
        return "Email not found.";
    }

    $stmt->close();
}



public function sendOTP($email, $otp, $username) {
    $mail = new PHPMailer(true);
    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sms061606@gmail.com';
        $mail->Password = 'acyrljubsjddckom';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('sms061606@gmail.com', 'SMS');
        $mail->addAddress($email);

        // Email content with enhanced design
        $mail->isHTML(true);
        $mail->Subject = 'Your Login OTP - SMS Verification';
        
        // Professional HTML email template
        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    font-family: 'Arial', 'Helvetica', sans-serif;
                    background-color: #f4f7fc;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                }
                .header {
                    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
                    padding: 40px 20px;
                    text-align: center;
                }
                .logo {
                    width: 80px;
                    height: 80px;
                    background-color: #ffffff;
                    border-radius: 50%;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 15px;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                }
                .logo-text {
                    font-size: 32px;
                    font-weight: bold;
                    color: #1e3c72;
                }
                .header-title {
                    color: #ffffff;
                    font-size: 24px;
                    font-weight: 600;
                    margin: 0;
                }
                .content {
                    padding: 40px 30px;
                }
                .greeting {
                    color: #333333;
                    font-size: 18px;
                    margin-bottom: 20px;
                }
                .message {
                    color: #666666;
                    font-size: 15px;
                    line-height: 1.6;
                    margin-bottom: 30px;
                }
                .otp-container {
                    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
                    border-left: 4px solid #1e3c72;
                    border-radius: 8px;
                    padding: 30px;
                    text-align: center;
                    margin: 30px 0;
                }
                .otp-label {
                    color: #1e3c72;
                    font-size: 14px;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    margin-bottom: 15px;
                }
                .otp-code {
                    font-size: 36px;
                    font-weight: bold;
                    color: #1e3c72;
                    letter-spacing: 8px;
                    font-family: 'Courier New', monospace;
                    margin: 10px 0;
                }
                .expiry-notice {
                    background-color: #fff3cd;
                    border-left: 4px solid #ffc107;
                    padding: 15px;
                    border-radius: 4px;
                    margin: 20px 0;
                }
                .expiry-notice p {
                    margin: 0;
                    color: #856404;
                    font-size: 14px;
                }
                .security-notice {
                    background-color: #f8f9fa;
                    border-radius: 8px;
                    padding: 20px;
                    margin-top: 25px;
                }
                .security-notice h3 {
                    color: #1e3c72;
                    font-size: 16px;
                    margin-top: 0;
                    margin-bottom: 10px;
                }
                .security-notice ul {
                    margin: 10px 0;
                    padding-left: 20px;
                    color: #666666;
                    font-size: 14px;
                    line-height: 1.8;
                }
                .footer {
                    background-color: #f8f9fa;
                    padding: 30px;
                    text-align: center;
                    border-top: 1px solid #e9ecef;
                }
                .footer p {
                    color: #666666;
                    font-size: 13px;
                    margin: 5px 0;
                    line-height: 1.6;
                }
                .divider {
                    height: 1px;
                    background: linear-gradient(to right, transparent, #1e3c72, transparent);
                    margin: 30px 0;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <div class='logo'>
                        <span class='logo-text'>SMS</span>
                    </div>
                    <h1 class='header-title'>Email Verification</h1>
                </div>
                
                <div class='content'>
                    <p class='greeting'>Hello, <strong>" . htmlspecialchars($username) . "</strong>!</p>
                    
                    <p class='message'>
                        We received a request to verify your email address. To complete the verification process, 
                        please use the One-Time Password (OTP) below:
                    </p>
                    
                    <div class='otp-container'>
                        <div class='otp-label'>Your Verification Code</div>
                        <div class='otp-code'>" . htmlspecialchars($otp) . "</div>
                    </div>
                    
                    <div class='expiry-notice'>
                        <p>⏱️ <strong>Important:</strong> This OTP will expire in 10 minutes for your security.</p>
                    </div>
                    
                    <div class='divider'></div>
                    
                    <div class='security-notice'>
                        <h3>🔒 Security Tips</h3>
                        <ul>
                            <li>Never share this OTP with anyone, including SMS staff</li>
                            <li>We will never ask for your OTP via phone or email</li>
                            <li>If you didn't request this code, please ignore this email</li>
                            <li>Contact our support team if you notice any suspicious activity</li>
                        </ul>
                    </div>
                </div>
                
                <div class='footer'>
                    <p><strong>SMS Team</strong></p>
                    <p>This is an automated message, please do not reply to this email.</p>
                    <p>© " . date('Y') . " SMS. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";

        // Plain text alternative
        $mail->AltBody = "Hello $username,\n\n"
                       . "Your OTP is: $otp\n\n"
                       . "This code will expire in 10 minutes.\n\n"
                       . "If you didn't request this code, please ignore this email.\n\n"
                       . "SMS Team";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

   
public function register($username, $email, $password, $confirmPassword, $photo)
{
    global $connections;

    $errorMsg = "";
    $successMsg = "";

    // ✅ Basic field validation
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errorMsg = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Invalid email format.";
    } elseif ($password !== $confirmPassword) {
        $errorMsg = "Passwords do not match.";
    } else {
        // ✅ Check if username or email already exists
        $check = $connections->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $check->bind_param("ss", $username, $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $errorMsg = "Username or email already exists.";
        } else {
            // ✅ Handle Photo Upload
            $photoFileName = null;

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['photo']['tmp_name'];
                $fileName = $_FILES['photo']['name'];
                $fileSize = $_FILES['photo']['size'];
                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($fileExt, $allowedExtensions)) {
                    $errorMsg = "Only JPG, JPEG, PNG, and GIF files are allowed.";
               
                } else {
                    // ✅ Create uploads folder if not exists
                    $uploadDir = "../uploads/users/";
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    // ✅ Generate unique file name
                    $photoFileName = uniqid("IMG_", true) . "." . $fileExt;
                    $destPath = $uploadDir . $photoFileName;

                    // ✅ Move uploaded file
                    if (!move_uploaded_file($fileTmpPath, $destPath)) {
                        $errorMsg = "Failed to upload image.";
                    }
                }
            }

            // ✅ Only continue if no upload error
            if (empty($errorMsg)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // ✅ Insert new user into database
                $role = 'Student';
                $stmt = $connections->prepare("INSERT INTO users (username, email, password, photo, role) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $username, $email, $hashedPassword, $photoFileName, $role );

                if ($stmt->execute()) {
                    $successMsg = "Account created successfully! Redirecting to login...";
                     header("Location: ../login.php"); exit;
                } else {
                    $errorMsg = "Error saving user: " . $stmt->error;
                }

                $stmt->close();
            }
        }

        $check->close();
    }

    // ✅ Return messages to front-end
    return [
        'errorMsg' => $errorMsg,
        'successMsg' => $successMsg
    ];
}


public function verifyOTP($enteredOTP) {
    session_start();

    if (!isset($_SESSION['otp']) || !isset($_SESSION['id']) || !isset($_SESSION['role'])) {
        return "Session expired. Please log in again.";
    }

    $storedOTP = $_SESSION['otp'];

    if ($enteredOTP == $storedOTP) {
        // ✅ OTP is correct
        unset($_SESSION['otp']); // clear OTP once verified
        $_SESSION['verified'] = true;
        

        // Redirect based on role
        if ($_SESSION['role'] === 'Admin') {
           $_SESSION['greetings'] = "Welcome Back!";
            header("Location: ../admin/dashboard.php");
            exit;
        } elseif ($_SESSION['role'] === 'Student') {
             $_SESSION['greetings'] = "Welcome Back!";
            header("Location: ../student/dashboard.php");
            exit;
        }
        elseif ($_SESSION['role'] === 'Teacher') {
             $_SESSION['greetings'] = "Welcome Back!";
            header("Location: ../teacher/dashboard.php");
            exit;
        }
         else {
            // fallback for other roles
            header("Location: ../index.php");
            exit;
        }
    } else {
        // ❌ Wrong OTP
        return "Invalid OTP. Please try again.";
    }
}

public function auth($id){
     global $connections;

        $sql = "SELECT *FROM users WHERE id = $id "; 
        $result = mysqli_query($connections, $sql);

       

        if($result){
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $AuthData = [
                    'id'=> $row['id'],
                    'username' => $row['username'],
                    'email' => $row['email'],
                    'photo' => $row['photo'],
                    'role' => $row['role'],
                ];
               
            }
            return $AuthData;
        }
     
}

public function logout() {
    session_start();

    // Clear all session variables
    $_SESSION = [];

    // Destroy the session completely
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    // Redirect to login page
    header("Location: ../login.php");
    exit;
}
   
}







