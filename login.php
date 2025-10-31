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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

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

<body class="bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center font-sans"
  style="background-image: linear-gradient(rgba(250, 250, 250, 0.937), rgba(8, 52, 117, 0.942)), url('img.jpg');">

  <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl max-w-5xl w-full mx-4 flex flex-col md:flex-row overflow-hidden border border-gray-200">

    <!-- Left Panel -->
    <div class="md:w-1/2 p-10 flex flex-col justify-center items-center text-center bg-gradient-to-br from-white via-blue-50 to-blue-100 text-gray-800 relative">
      <img src="sms.png" alt="sms.png" class="w-32 h-32 mb-6 rounded-full shadow-lg border-4 border-white" />

      <h1 class="text-4xl md:text-5xl font-extrabold mb-3 tracking-tight text-blue-900">Welcome to</h1>
      <h2 class="text-5xl font-extrabold mb-4 text-blue-700 drop-shadow-md">School Management System</h2>
      <p class="text-gray-700 mb-8 max-w-md leading-relaxed font-medium">
        Empowering education through a unified academic management system that enhances learning, streamlines processes, and connects the academic community.
      </p>
      <a
        href="sms.html"
        class="bg-blue-700 hover:bg-blue-800 text-white font-extrabold px-6 py-3 rounded-lg shadow-md transition-all duration-300"
      >
        Learn More
      </a>
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
 
    <div class="mb-6"> 
      <label class="block text-gray-700 text-sm font-semibold mb-2">Password</label> 
      <input 
        type="password" 
        name="password" 
        required 
        placeholder="Enter your password"
        class="w-full border border-gray-300 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
      > 
    </div> 
 
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
