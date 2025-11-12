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

<body class="bg-cover bg-center p-5 bg-no-repeat min-h-screen flex items-center justify-center font-sans"
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
<div id="loginSection" class="w-full max-w-sm md:max-w-md lg:max-w-lg   p-6 sm:p-8 text-left mx-auto">
  <?php if (!empty($errorMsg)): ?>
    <p class="text-red-600 text-sm mb-4 text-center"><?= htmlspecialchars($errorMsg) ?></p>
  <?php endif; ?>

  <?php if (isset($_SESSION['otp'])): ?>
  <div id="otpSection" class="w-full  p-6 sm:p-8 mt-6 mx-auto">
    <!-- Header -->
    <div class="text-center mb-6">
      <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
      </div>
      <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Verify Your Email</h2>
      <p class="text-gray-600 text-xs sm:text-sm">We've sent a 6-digit code to your email</p>
    </div>

    <!-- Timer Display -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4 mb-6 text-center">
      <div class="flex flex-col sm:flex-row items-center justify-center space-x-0 sm:space-x-2">
        <svg class="w-5 h-5 text-blue-600 mb-1 sm:mb-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="text-sm font-semibold text-gray-700">Code expires in:</span>
      </div>
      <div id="timer" class="text-2xl sm:text-3xl font-bold text-blue-600 mt-2">10:00</div>
      <div id="expiredMessage" class="hidden text-red-600 text-sm font-semibold mt-2">
        ⚠️ Code has expired. Please request a new one.
      </div>
    </div>

    <!-- OTP Form -->
    <form method="POST" action="routes/userroutes.php" id="otpForm">
      <label class="block text-gray-700 text-sm font-semibold mb-3 text-center sm:text-left">Enter Verification Code</label>
      
      <!-- OTP Input Fields -->
      <div class="flex justify-center sm:justify-between flex-wrap gap-2 mb-6">
        <input type="text" maxlength="1" class="otp-input w-10 h-12 sm:w-12 sm:h-14 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" data-index="0">
        <input type="text" maxlength="1" class="otp-input w-10 h-12 sm:w-12 sm:h-14 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" data-index="1">
        <input type="text" maxlength="1" class="otp-input w-10 h-12 sm:w-12 sm:h-14 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" data-index="2">
        <input type="text" maxlength="1" class="otp-input w-10 h-12 sm:w-12 sm:h-14 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" data-index="3">
        <input type="text" maxlength="1" class="otp-input w-10 h-12 sm:w-12 sm:h-14 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" data-index="4">
        <input type="text" maxlength="1" class="otp-input w-10 h-12 sm:w-12 sm:h-14 text-center text-xl sm:text-2xl font-bold border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" data-index="5">
      </div>

      <!-- Hidden input -->
      <input type="hidden" name="otp" id="otpValue">

      <button type="submit" name="verify_otp" id="verifyBtn" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 sm:py-3.5 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
        Verify Code
      </button>
    </form>

    <!-- Resend Section -->
    <div class="mt-6 text-center">
      <p class="text-gray-600 text-sm mb-2">Didn't receive the code?</p>
      <button id="resendBtn" class="text-blue-600 font-semibold text-sm hover:text-blue-700 hover:underline transition-all" disabled>
        Resend Code (<span id="resendTimer">60</span>s)
      </button>
    </div>

    <!-- Help Text -->
    <div class="mt-6 bg-gray-50 rounded-lg p-3 sm:p-4">
      <p class="text-xs sm:text-sm text-gray-600 text-center">
        <svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
            clip-rule="evenodd"></path>
        </svg>
        Check your spam folder if you don't see the email
      </p>
    </div>
  </div>

  <script>
    // OTP Timer (10 minutes = 600 seconds)
    let timeLeft = 600;
    let timerInterval;
    let resendTimeLeft = 60;
    let resendInterval;

    const timerDisplay = document.getElementById('timer');
    const expiredMessage = document.getElementById('expiredMessage');
    const verifyBtn = document.getElementById('verifyBtn');
    const otpForm = document.getElementById('otpForm');
    const resendBtn = document.getElementById('resendBtn');
    const resendTimerDisplay = document.getElementById('resendTimer');

    // Format time as MM:SS
    function formatTime(seconds) {
      const mins = Math.floor(seconds / 60);
      const secs = seconds % 60;
      return `${mins}:${secs.toString().padStart(2, '0')}`;
    }

    // Main OTP Timer
    function startTimer() {
      timerInterval = setInterval(() => {
        timeLeft--;
        timerDisplay.textContent = formatTime(timeLeft);

        // Change color as time runs out
        if (timeLeft <= 60) {
          timerDisplay.classList.add('text-red-600');
          timerDisplay.classList.remove('text-blue-600');
        }

        if (timeLeft <= 0) {
          clearInterval(timerInterval);
          timerDisplay.classList.add('hidden');
          expiredMessage.classList.remove('hidden');
          verifyBtn.disabled = true;
          verifyBtn.classList.add('opacity-50', 'cursor-not-allowed');
          
          // Disable all OTP inputs
          document.querySelectorAll('.otp-input').forEach(input => {
            input.disabled = true;
            input.classList.add('bg-gray-100');
          });
        }
      }, 1000);
    }

    // Resend Timer
    function startResendTimer() {
      resendTimeLeft = 60;
      resendBtn.disabled = true;
      resendBtn.classList.add('opacity-50', 'cursor-not-allowed');
      
      resendInterval = setInterval(() => {
        resendTimeLeft--;
        resendTimerDisplay.textContent = resendTimeLeft;

        if (resendTimeLeft <= 0) {
          clearInterval(resendInterval);
          resendBtn.disabled = false;
          resendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
          resendBtn.innerHTML = 'Resend Code';
        }
      }, 1000);
    }

    // OTP Input Handling
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpValue = document.getElementById('otpValue');

    otpInputs.forEach((input, index) => {
      // Auto-focus next input
      input.addEventListener('input', (e) => {
        const value = e.target.value;
        
        // Only allow numbers
        if (!/^\d*$/.test(value)) {
          e.target.value = '';
          return;
        }

        // Update hidden input with complete OTP
        updateOTPValue();

        // Move to next input
        if (value.length === 1 && index < otpInputs.length - 1) {
          otpInputs[index + 1].focus();
        }

        // Auto-submit when all fields are filled
        if (index === otpInputs.length - 1 && value.length === 1) {
          if (isOTPComplete()) {
            // Optional: Auto-submit
            // otpForm.submit();
          }
        }
      });

      // Handle backspace
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && !e.target.value && index > 0) {
          otpInputs[index - 1].focus();
        }
      });

      // Handle paste
      input.addEventListener('paste', (e) => {
        e.preventDefault();
        const pastedData = e.clipboardData.getData('text').slice(0, 6);
        
        if (!/^\d+$/.test(pastedData)) return;

        pastedData.split('').forEach((char, i) => {
          if (otpInputs[i]) {
            otpInputs[i].value = char;
          }
        });

        updateOTPValue();
        otpInputs[Math.min(pastedData.length, 5)].focus();
      });
    });

    function updateOTPValue() {
      const otp = Array.from(otpInputs).map(input => input.value).join('');
      otpValue.value = otp;
    }

    function isOTPComplete() {
      return Array.from(otpInputs).every(input => input.value.length === 1);
    }

    // Form validation
    otpForm.addEventListener('submit', (e) => {
      if (!isOTPComplete()) {
        e.preventDefault();
        alert('Please enter the complete 6-digit code');
        return;
      }

      if (timeLeft <= 0) {
        e.preventDefault();
        alert('This code has expired. Please request a new one.');
        return;
      }
    });

    // Resend button (you'll need to implement the actual resend logic)
    resendBtn.addEventListener('click', () => {
  fetch('../php/routes/resendotp.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ resend: true })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('A new code has been sent to your email!');
      startResendTimer();
      timeLeft = 600;
      timerDisplay.classList.remove('hidden', 'text-red-600');
      timerDisplay.classList.add('text-blue-600');
      expiredMessage.classList.add('hidden');
      verifyBtn.disabled = false;
      verifyBtn.classList.remove('opacity-50', 'cursor-not-allowed');
      otpInputs.forEach(input => {
        input.disabled = false;
        input.classList.remove('bg-gray-100');
        input.value = '';
      });
      otpInputs[0].focus();
    } else {
      alert(data.message || 'Failed to resend OTP.');
    }
  })
  .catch(err => {
    console.error(err);
    alert('An error occurred while resending OTP.');
  });
});


    // Initialize
    startTimer();
    startResendTimer();
    otpInputs[0].focus();
  </script>

<?php else: ?>
  <div class="w-full max-w-md mx-auto bg-yellow-50 border border-yellow-200 rounded-lg shadow-md p-6 mt-6">
    <div class="flex items-center justify-center mb-4">
      <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
      </svg>
    </div>
    <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">No OTP Session Found</h3>
    <p class="text-gray-600 text-sm text-center mb-4">
      Please log in first to receive your verification code.
    </p>
    <a href="login.php" class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all">
      Go to Login
    </a>
  </div>
<?php endif; ?>

</div>

<!-- OTP Form -->

    </div>
  </div>


</body>
</html>



</html>
