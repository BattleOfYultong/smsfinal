<?php
session_start();
include_once('../connections/connections.php');
include_once('../controllers/usercontroller.php');

header('Content-Type: application/json');

// Ensure user is logged in
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$uid = $_SESSION['id'];

// Fetch user email and name from DB
$stmt = $connections->prepare("SELECT email, username FROM users WHERE id = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit();
}

// Generate new OTP and save in session
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;

// Send OTP email
$userCtrl = new usercontroller();
if ($userCtrl->sendOTP($user['email'], $otp, $user['username'])) {
    echo json_encode(['success' => true, 'message' => 'OTP resent successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to send OTP']);
}
exit;
?>
