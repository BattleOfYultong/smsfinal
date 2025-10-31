<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>School Management System</title>
    
  <link rel="stylesheet" href="../css/sms(1).css">
  <link rel="icon" type="image/png" href="../img/sms.png" />
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
    @keyframes fade-in {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 1s ease forwards; }
    .animate-fade-in-delayed { animation: fadeIn 1s ease-out 0.3s both; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-5px); }
      to { opacity: 1; transform: translateY(0); }
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
        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-2">
          
        </p>
        <p class="text-sm text-gray-600 italic">
          
        </p>
      </div>

      <!-- ADMIN BUTTON -->
<div class="flex justify-center w-full">
  <a href="login.php"
    class="bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white flex flex-col items-center justify-center rounded-2xl shadow-lg p-8 text-center transform hover:scale-105 transition-all duration-300">
    <div class="bg-blue-500 p-4 rounded-full mb-4 shadow-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
    </div>
    <span class="text-xl font-semibold">Administrator</span>
    <span class="text-sm opacity-90 mt-2">Access admin dashboard</span>
  </a>
</div>

    </div>
  </div>
    </div>
  </div>
</body>
</html>
