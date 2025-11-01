<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>401 - Unauthorized Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }
            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }

        .shake-animation {
            animation: shake 0.5s ease-in-out;
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-5xl w-full">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="grid lg:grid-cols-2 gap-0">
                <!-- Left Side - Visual/Illustration -->
                <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-700 p-8 flex flex-col items-center justify-center relative overflow-hidden">
                    <!-- Decorative circles -->
                    <div class="absolute top-6 left-6 w-20 h-20 bg-white/10 rounded-full float-animation"></div>
                    <div class="absolute bottom-6 right-6 w-16 h-16 bg-white/10 rounded-full float-animation" style="animation-delay: 1s;"></div>
                    
                    <!-- Logo with pulse effect -->
                    <div class="mb-4 relative z-10">
                        <div class="absolute inset-0  bg-white rounded-full opacity-20"></div>
                        <div class=" rounded-xl bg-white p-4 ">
                            <img src="../sms.png" alt="Student Management System Logo" class="h-50 w-auto object-contain">
                        </div>
                    </div>

                  

                    <!-- Large Error Code -->
                    <h1 class="text-7xl font-bold text-white mb-2 relative z-10">401</h1>
                    <p class="text-white/90 text-lg font-medium relative z-10">Unauthorized Access</p>
                </div>

                <!-- Right Side - Content -->
                <div class="p-8 flex flex-col justify-center">
                    <!-- Header -->
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800 mb-3">Access Denied</h2>
                        <p class="text-gray-600 text-base leading-relaxed">
                            You don't have permission to access this page. Please log in with appropriate credentials.
                        </p>
                    </div>

                    <!-- Error Details Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 mb-6 border border-blue-100">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                                <i class="fas fa-shield-alt text-lg" style="color: var(--primary);"></i>
                            </div>
                            <div class="text-left">
                                <h3 class="font-bold text-gray-800 mb-2">Common Reasons:</h3>
                                <ul class="text-sm text-gray-700 space-y-1.5">
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-circle text-xs mt-1" style="color: var(--primary);"></i>
                                        <span>You are not logged in</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-circle text-xs mt-1" style="color: var(--primary);"></i>
                                        <span>Your session has expired</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-circle text-xs mt-1" style="color: var(--primary);"></i>
                                        <span>Insufficient permissions</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3 mb-6">
                        <a href="../login.php" class="group px-6 py-3 rounded-xl font-semibold text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2" style="background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);">
                            <i class="fas fa-sign-in-alt group-hover:translate-x-[-4px] transition-transform"></i>
                            <span>Go to Login Page</span>
                        </a>
                        
                        <a href="../index.php" class="px-6 py-3 bg-white border-2 border-gray-200 rounded-xl font-semibold text-gray-700 hover:border-blue-500 hover:text-blue-600 transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                            <i class="fas fa-home"></i>
                            <span>Return to Home</span>
                        </a>
                    </div>

                    <!-- Contact Support -->
                    <div class="pt-4 border-t border-gray-200">
                        <p class="text-gray-500 text-xs mb-2 font-medium">Need help? Contact support:</p>
                        <div class="flex flex-col gap-2">
                            <a href="mailto:support@sms.edu" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors text-sm">
                                <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-envelope text-xs text-blue-600"></i>
                                </div>
                                <span>support@sms.edu</span>
                            </a>
                            <a href="tel:+1234567890" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors text-sm">
                                <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone text-xs text-blue-600"></i>
                                </div>
                                <span>(123) 456-7890</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden z-0">
        <div class="absolute top-20 left-10 w-20 h-20 bg-blue-200 rounded-full opacity-20 float-animation"></div>
        <div class="absolute top-40 right-20 w-32 h-32 bg-purple-200 rounded-full opacity-20 float-animation" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-indigo-200 rounded-full opacity-20 float-animation" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-40 right-1/3 w-16 h-16 bg-pink-200 rounded-full opacity-20 float-animation" style="animation-delay: 0.5s;"></div>
    </div>
</body>
</html>