<?php
include('connections/connections.php');
session_start();
$errorMsg = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']); // clear message after showing
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>School Management System</title>
  <link rel="icon" type="image/png" href="../img/sms.png" />
  <link rel="stylesheet" href="../css/sms(1).css">
   <?php include('landingheader.php') ?>

  <style>
    .role-box {
      width: 230px;
      height: 230px;
      transition: all 0.3s ease;
    }
    .role-box:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }
  
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-10px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>

<body class="bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center font-sans p-5"
  style="background-image: linear-gradient(rgba(250, 250, 250, 0.937), rgba(8, 52, 117, 0.942)), url('img.jpg');">

  <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl max-w-5xl w-full mx-4 flex flex-col md:flex-row overflow-hidden border border-gray-200">

    <!-- Left Panel -->
    <div class="md:w-1/2 p-10 flex flex-col justify-center items-center text-center bg-gradient-to-br from-white via-blue-50 to-blue-100 text-gray-800 relative">
      <img src="sms.png" alt="sms.png" class="w-32 h-32 mb-6 rounded-full shadow-lg border-4 border-white" />

      <h1 class="text-4xl md:text-5xl font-extrabold mb-3 tracking-tight text-blue-900">Welcome to</h1>
      <h2 class="text-5xl font-extrabold mb-4 text-blue-700 drop-shadow-md">School Management System</h2>
     
     
    </div>

    <!-- Right Panel -->
    <div class="md:w-1/2 bg-white p-10 flex flex-col justify-center items-center text-center">
      <div class="mb-8 text-center">
        <h1 class="text-4xl font-black bg-gradient-to-r from-blue-800 to-blue-600 bg-clip-text text-transparent mb-1">
          CLASS SCHEDULING SYSTEM
        </h1>
      </div>

      <!-- ADMIN BUTTON -->


      <!-- HIDDEN LOGIN FORM -->
      <!-- Login Form -->
<div id="loginSection" class="w-full max-w-md  p-8 text-left"> 
  <!-- Header -->
  <div class="mb-6 text-center">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome Back</h2>
    <p class="text-gray-600 text-sm">Sign in to your account</p>
  </div>

  <?php if (!empty($errorMsg)): ?> 
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm" role="alert">
      <span class="block sm:inline"><?= htmlspecialchars($errorMsg) ?></span>
    </div>
  <?php endif; ?> 
 
  <form action="routes/userroutes.php" method="POST"> 
    <div class="mb-5"> 
      <label class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label> 
      <input 
        type="email" 
        name="email" 
        required 
        placeholder="you@example.com"
        class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
      > 
    </div> 
 
    <div class="mb-6 relative"> 
  <label class="block text-gray-700 text-sm font-semibold mb-2">Password</label> 

  <div class="relative">
    <input 
      id="password"
      type="password" 
      name="password" 
      required 
      placeholder="Enter your password"
      class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition pr-10"
    > 

    <!-- Eye icon button -->
    <button 
      type="button" 
      onclick="togglePassword()" 
      class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none"
    >
      <!-- Default: eye (hidden password) -->
      <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      </svg>
    </button>
  </div>
</div>

<script>
  function togglePassword() {
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (password.type === 'password') {
      password.type = 'text';
      eyeIcon.innerHTML = `
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.978 9.978 0 012.302-3.982m3.107-2.45A9.963 9.963 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.978 9.978 0 01-4.043 5.132M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3l18 18" />
      `;
    } else {
      password.type = 'password';
      eyeIcon.innerHTML = `
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      `;
    }
  }
</script>
 
    <button 
      type="submit" 
      name="login" 
      class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 shadow-md hover:shadow-lg"
    >
      Sign In
    </button> 
  </form>

  <!-- Divider -->
  <div class="relative my-6">
    <div class="absolute inset-0 flex items-center">
      <div class="w-full border-t border-gray-300"></div>
    </div>
    <div class="relative flex justify-center text-sm">
      <span class="px-2 bg-white text-gray-500">OR</span>
    </div>
  </div>

  <!-- Sign Up Link -->
  <div class="text-center">
    <p class="text-gray-600 text-sm">
      Don't have an account? 
      <a href="signup.php" class="text-blue-600 font-semibold hover:text-blue-700 hover:underline transition">
        Sign up
      </a>
    </p>
  </div>

  <!-- Optional: Forgot Password Link -->
  <div class="text-center mt-4">
    <a href="forgot-password.php" class="text-sm text-gray-500 hover:text-gray-700 hover:underline transition">
      Forgot your password?
    </a>
  </div>
</div>

<!-- OTP Form -->


    </div>
  </div>


</body>
</html>



</html>
