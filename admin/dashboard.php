<?php
// auth 
include('components/global/auth.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="../img/sms.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
       <?php include('components/global/sidebar.php') ?>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
           <?php include('components/global/nav.php') ?>  
           
            
            <!-- Dashboard Content -->
            <div class="p-6">
                <?php include('components/global/greetings.php') ?>
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Enrollment -->
                    <div class="bg-white rounded-lg shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Enrollment</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">2,458</h3>
                            </div>
                            <div class="bg-indigo-100 text-indigo-800 p-3 rounded-lg">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-green-500 font-medium">
                                <i class="fas fa-arrow-up mr-1"></i>
                                12.5%
                            </p>
                            <p class="text-sm text-gray-500">vs last semester</p>
                        </div>
                    </div>
                    
                    <!-- Payments -->
                    <div class="bg-white rounded-lg shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Payments</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">₱4.2M</h3>
                            </div>
                            <div class="bg-green-100 text-green-800 p-3 rounded-lg">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-green-500 font-medium">
                                <i class="fas fa-arrow-up mr-1"></i>
                                8.2%
                            </p>
                            <p class="text-sm text-gray-500">vs last month</p>
                        </div>
                    </div>
                    
                    <!-- Courses -->
                    <div class="bg-white rounded-lg shadow-sm p 6 card-hover transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Courses</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">98</h3>
                            </div>
                            <div class="bg-blue-100 text-blue-800 p-3 rounded-lg">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-green-500 font-medium">
                                <i class="fas fa-arrow-up mr-1"></i>
                                3.5%
                            </p>
                            <p class="text-sm text-gray-500">vs last year</p>
                        </div>
                    </div>
                    
                    <!-- Faculty -->
                    <div class="bg-white rounded-lg shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Faculty</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">184</h3>
                            </div>
                            <div class="bg-purple-100 text-purple-800 p-3 rounded-lg">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-green-500 font-medium">
                                <i class="fas fa-arrow-up mr-1"></i>
                                5.1%
                            </p>
                            <p class="text-sm text-gray-500">vs last year</p>
                        </div>
                    </div>
                </div>
                
          <!-- Main Dashboard Content -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Enrollment Chart -->
                   <div class="bg-white rounded-xl shadow-sm p-6 lg:col-span-2 card-hover">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Enrollment Trends</h2>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-xs bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors" id="semesterBtn">Semester</button>
            <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors" id="yearBtn">Year</button>
            <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors" id="programBtn">Program</button>
        </div>
    </div>
    <div class="h-64 flex items-center justify-center">
        <img src="graph.png" alt="Enrollment Graph" class="w-full h-full object-cover rounded-lg hover:scale-105 transition-transform duration-300">
    </div>
</div>

                    
                     <!-- Recent Activities -->
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-semibold text-gray-800">Recent Activities</h2>
                            <button class="text-indigo-600 text-sm font-medium hover:text-indigo-800 transition-colors">View All</button>
                        </div>
                        <div class="space-y-4">
                            <div class="activity-item flex items-start p-2 rounded-lg cursor-pointer">
                                <div class="bg-indigo-100 text-indigo-800 p-2 rounded-lg mr-3 mt-1">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">12 new enrollments</p>
                                    <p class="text-xs text-gray-500">Today, 9:42 AM</p>
                                </div>
                            </div>
                            <div class="activity-item flex items-start p-2 rounded-lg cursor-pointer">
                                <div class="bg-green-100 text-green-800 p-2 rounded-lg mr-3 mt-1">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">32 tuition payments processed</p>
                                    <p class="text-xs text-gray-500">Today, 11:30 AM</p>
                                </div>
                            </div>
                            <div class="activity-item flex items-start p-2 rounded-lg cursor-pointer">
                                <div class="bg-yellow-100 text-yellow-800 p-2 rounded-lg mr-3 mt-1">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Faculty meeting scheduled</p>
                                    <p class="text-xs text-gray-500">Yesterday, 3:15 PM</p>
                                </div>
                            </div>
                            <div class="activity-item flex items-start p-2 rounded-lg cursor-pointer">
                                <div class="bg-purple-100 text-purple-800 p-2 rounded-lg mr-3 mt-1">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Class schedules updated</p>
                                    <p class="text-xs text-gray-500">Yesterday, 5:45 PM</p>
                                </div>
                            </div>
                            <div class="activity-item flex items-start p-2 rounded-lg cursor-pointer">
                                <div class="bg-blue-100 text-blue-800 p-2 rounded-lg mr-3 mt-1">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">3 new research proposals</p>
                                    <p class="text-xs text-gray-500">2 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Second Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                    <!-- Accreditation Status -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-6">Accreditation Status</h2>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Computer Science</span>
                                    <span class="text-sm font-medium text-green-500">Level IV</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Business Administration</span>
                                    <span class="text-sm font-medium text-green-500">Level III</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-400 h-2 rounded-full" style="width: 90%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Engineering</span>
                                    <span class="text-sm font-medium text-yellow-500">Level II</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 70%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Education</span>
                                    <span class="text-sm font-medium text-blue-500">In Progress</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 45%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Class Scheduling -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-semibold text-gray-800">Class Scheduling</h2>
                            <button class="text-indigo-600 text-sm font-medium">View All</button>
                        </div>
                        <div class="space-y-4">
                            <div class="border rounded-lg p-3 hover:border-indigo-300 transition-colors">
                                <div class="flex justify-between">
                                    <p class="font-medium">CS 101 - Introduction</p>
                                    <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full">MW 8:00-9:30</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Room 302, Dr. Smith</p>
                            </div>
                            <div class="border rounded-lg p-3 hover:border-indigo-300 transition-colors">
                                <div class="flex justify-between">
                                    <p class="font-medium">MATH 202 - Calculus II</p>
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">TTh 10:00-11:30</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Room 205, Dr. Johnson</p>
                            </div>
                            <div class="border rounded-lg p-3 hover:border-indigo-300 transition-colors">
                                <div class="flex justify-between">
                                    <p class="font-medium">ENGL 101 - Composition</p>
                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">MWF 1:00-2:00</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Room 101, Prof. Williams</p>
                            </div>
                            <div class="border rounded-lg p-3 hover:border-indigo-300 transition-colors">
                                <div class="flex justify-between">
                                    <p class="font-medium">PHYS 210 - Physics Lab</p>
                                    <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded-full">F 2:00-5:00</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Science Bldg., Dr. Brown</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Online Learning -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-6">Online Learning Status</h2>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Active Courses</span>
                                    <span class="text-sm font-medium">78%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-500 h-2 rounded-full" style="width: 78%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Completed Assignments</span>
                                    <span class="text-sm font-medium">62%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 62%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium">Student Engagement</span>
                                    <span class="text-sm font-medium">89%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 89%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold mb-1">4,325</div>
                                <div class="text-xs text-gray-500">Active Students</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold mb-1">168</div>
                                <div class="text-xs text-gray-500">Online Instructors</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Third Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    <!-- Co-curricular Activities -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-semibold text-gray-800">Co-curricular Activities</h2>
                            <button class="text-indigo-600 text-sm font-medium">View All</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-3">
                                    <div class="bg-red-100 text-red-800 p-2 rounded-lg mr-3">
                                        <i class="fas fa-headphones"></i>
                                    </div>
                                    <h3 class="font-medium">Music Club</h3>
                                </div>
                                <p class="text-xs text-gray-500 mb-2">Meets every Wednesday at 4 PM</p>
                                <div class="flex justify-between text-xs">
                                    <span class="text-gray-500">42 Members</span>
                                    <span class="text-indigo-600 font-medium">Active</span>
                                </div>
                            </div>
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-3">
                                    <div class="bg-green-100 text-green-800 p-2 rounded-lg mr-3">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <h3 class="font-medium">Coding Club</h3>
                                </div>
                                <p class="text-xs text-gray-500 mb-2">Meets every Friday at 3 PM</p>
                                <div class="flex justify-between text-xs">
                                    <span class="text-gray-500">36 Members</span>
                                    <span class="text-indigo-600 font-medium">Active</span>
                                </div>
                            </div>
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-3">
                                    <div class="bg-blue-100 text-blue-800 p-2 rounded-lg mr-3">
                                        <i class="fas fa-futbol"></i>
                                    </div>
                                    <h3 class="font-medium">Football Team</h3>
                                </div>
                                <p class="text-xs text-gray-500 mb-2">Practices Mon-Thu at 5 PM</p>
                                <div class="flex justify-between text-xs">
                                    <span class="text-gray-500">24 Members</span>
                                    <span class="text-indigo-600 font-medium">Active</span>
                                </div>
                            </div>
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center mb-3">
                                    <div class="bg-yellow-100 text-yellow-800 p-2 rounded-lg mr-3">
                                        <i class="fas fa-microscope"></i>
                                    </div>
                                    <h3 class="font-medium">Science Club</h3>
                                </div>
                                <p class="text-xs text-gray-500 mb-2">Meets every Tuesday at 4:30 PM</p>
                                <div class="flex justify-between text-xs">
                                    <span class="text-gray-500">28 Members</span>
                                    <span class="text-indigo-600 font-medium">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Research Projects -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-semibold text-gray-800">CRAD Research Projects</h2>
                            <button class="text-indigo-600 text-sm font-medium">View All</button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start border-b pb-4">
                                <div class="bg-indigo-100 text-indigo-800 p-2 rounded-lg mr-3 mt-1">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between">
                                        <h3 class="font-medium">AI in Education</h3>
                                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Active</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Dr. Rodriguez, Budget: ₱250,000</p>
                                </div>
                            </div>
                            <div class="flex items-start border-b pb-4">
                                <div class="bg-blue-100 text-blue-800 p-2 rounded-lg mr-3 mt-1">
                                    <i class="fas fa-atom"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between">
                                        <h3 class="font-medium">Renewable Energy</h3>
                                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Active</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Dr. Chen, Budget: ₱350,000</p>
                                </div>
                            </div>
                            <div class="flex items-start border-b pb-4">
                                <div class="bg-purple-100 text-purple-800 p-2 rounded-lg mr-3 mt-1">
                                    <i class="fas fa-seedling"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between">
                                        <h3 class="font-medium">Sustainable Agriculture</h3>
                                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Pending</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Dr. Garcia, Budget: ₱180,000</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-orange-100 text-orange-800 p-2 rounded-lg mr-3 mt-1">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between">
                                        <h3 class="font-medium">Health Informatics</h3>
                                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">Completed</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Dr. Wong, Budget: ₱210,000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Responsive sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            // In a real implementation, you would fetch data here
            console.log('Dashboard loaded');
            
            // Example of adding interactivity to cards
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    console.log(`Clicked on ${this.querySelector('h3').textContent}`);
                });
            });
        });
    </script>
</body>
</html>
