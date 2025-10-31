<?php

include_once('../connections/connections.php');
include('../controllers/usercontroller.php');

$errorMsg = "";
$successMsg = "";


if($_SERVER['REQUEST_METHOD'] === 'POST'){

   if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $loginUser = new usercontroller();
        $errorMsg = $loginUser->login($email, $password);

        // ✅ Store error message in session to show in the page
        $_SESSION['login_error'] = $errorMsg;

        // Go back to the login page
        header("Location: ../login.php");
        exit;
    }

  if (isset($_POST['register'])) {
      $username = trim($_POST["username"]);
      $email = trim($_POST["email"]);
      $password = trim($_POST["password"]);
      $confirmPassword = trim($_POST["confirmPassword"]);
      $photo = $_FILES['photo'] ?? null;

      $registerUser = new usercontroller();
      $response = $registerUser->register($username, $email, $password, $confirmPassword, $photo);

      $errorMsg = $response['errorMsg'];
      $successMsg = $response['successMsg'];
  }




   if (isset($_POST['verify_otp'])) {
        $enteredOTP = $_POST['otp'];

        $verifyUser = new usercontroller();
        $errorMsg = $verifyUser->verifyOTP($enteredOTP);

        $_SESSION['login_error'] = $errorMsg;
        header("Location: ../verifyotp.php");
        exit;
    }


}

