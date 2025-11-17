<?php
session_start();
include_once('../connections/connections.php');
include_once('../controllers/usercontroller.php');

// ✅ Check if user is logged in AND OTP verified
if (isset($_SESSION['id']) && isset($_SESSION['verified']) && $_SESSION['verified'] === true) {
    $id = $_SESSION['id'];
    $auth = new usercontroller();
    $authUser = $auth->Auth($id);  
     return $id;
} else {
    // 🚫 Not logged in or not verified — redirect to 401 error or login
    echo "<script>window.location.href='../errors/401.php';</script>";
    exit();
}
?>