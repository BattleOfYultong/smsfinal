<?php
// auth 
include('components/global/auth.php');
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Dashboard</title>
    <?php include_once('components/global/header.php') ?>
    
 
</head>
<body class="bg-white font-sans">
    <section class="flex h-screen overflow-hidden">
      <?php include_once('components/global/sidebar.php') ?>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white content-transition lg:ml-72" id="main-content">
            <section class="min-h-screen p-4 sm:p-6 lg:p-8 transition-all duration-300">
                <?php include_once('components/global/greetings.php') ?>
                <div class="max-w-7xl mx-auto">
                    <!-- Header -->
                    <div class="mb-8">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
                        <p class="text-gray-600 text-sm sm:text-base">Welcome back! Here's what's happening today.</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                        <!-- Card 1 -->
                        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow border-l-4 border-blue-900">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-blue-900 text-xl"></i>
                                </div>
                                <span class="text-sm text-green-600 font-medium">+12%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">1,234</h3>
                            <p class="text-gray-600 text-sm">Total Students</p>
                        </div>
                        
                        <!-- Card 2 -->
                        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow border-l-4 border-green-600">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                                </div>
                                <span class="text-sm text-green-600 font-medium">+5%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">87</h3>
                            <p class="text-gray-600 text-sm">Active Teachers</p>
                        </div>
                        
                        <!-- Card 3 -->
                        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow border-l-4 border-purple-600">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-book text-purple-600 text-xl"></i>
                                </div>
                                <span class="text-sm text-green-600 font-medium">+8%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">42</h3>
                            <p class="text-gray-600 text-sm">Active Courses</p>
                        </div>

                        <!-- Card 4 -->
                        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow border-l-4 border-yellow-600">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-door-open text-yellow-600 text-xl"></i>
                                </div>
                                <span class="text-sm text-green-600 font-medium">+3%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">28</h3>
                            <p class="text-gray-600 text-sm">Classrooms</p>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <!-- Recent Activity Card -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                                <button class="text-blue-900 hover:text-blue-700 text-sm font-medium">View All</button>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3 pb-4 border-b border-gray-100">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user-plus text-blue-900"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-800 font-medium">New student enrolled</p>
                                        <p class="text-xs text-gray-500 truncate">John Doe joined Grade 10-A</p>
                                        <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3 pb-4 border-b border-gray-100">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-800 font-medium">Schedule updated</p>
                                        <p class="text-xs text-gray-500 truncate">Math class rescheduled</p>
                                        <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-calendar text-purple-600"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-800 font-medium">Exam scheduled</p>
                                        <p class="text-xs text-gray-500 truncate">Final exams for Grade 12</p>
                                        <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Links Card -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Quick Links</h3>
                                <button class="text-blue-900 hover:text-blue-700 text-sm font-medium">Customize</button>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <a href="sectionassignment.php" class="p-4 bg-blue-50 hover:bg-blue-100 rounded-lg text-center transition-colors group">
                                    <i class="fas fa-user-graduate text-blue-900 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-700 font-medium">Section Assignment</p>
                                </a>
                                <a href="teachershedmap.php" class="p-4 bg-green-50 hover:bg-green-100 rounded-lg text-center transition-colors group">
                                    <i class="fas fa-clipboard-list text-green-600 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-700 font-medium">Schedule Mapping</p>
                                </a>
                                <a href="examtimetable.php" class="p-4 bg-purple-50 hover:bg-purple-100 rounded-lg text-center transition-colors group">
                                    <i class="fas fa-calendar-alt text-purple-600 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-700 font-medium">Exam Timetable</p>
                                </a>
                                <a href="roomavailability.php" class="p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg text-center transition-colors group">
                                    <i class="fas fa-door-open text-yellow-600 text-2xl mb-2"></i>
                                    <p class="text-sm text-gray-700 font-medium">Room Checker</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Upcoming Events</h3>
                            <button class="text-blue-900 hover:text-blue-700 text-sm font-medium">Add Event</button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-blue-900">
                                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Event</th>
                                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 hidden sm:table-cell">Date</th>
                                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 hidden md:table-cell">Time</th>
                                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors">
                                        <td class="py-3 px-4 text-sm text-gray-800 font-medium">Parent-Teacher Meeting</td>
                                        <td class="py-3 px-4 text-sm text-gray-600 hidden sm:table-cell">Nov 15, 2025</td>
                                        <td class="py-3 px-4 text-sm text-gray-600 hidden md:table-cell">2:00 PM</td>
                                        <td class="py-3 px-4"><span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full font-medium">Confirmed</span></td>
                                    </tr>
                                    <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors">
                                        <td class="py-3 px-4 text-sm text-gray-800 font-medium">Science Fair</td>
                                        <td class="py-3 px-4 text-sm text-gray-600 hidden sm:table-cell">Nov 20, 2025</td>
                                        <td class="py-3 px-4 text-sm text-gray-600 hidden md:table-cell">9:00 AM</td>
                                        <td class="py-3 px-4"><span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full font-medium">Pending</span></td>
                                    </tr>
                                    <tr class="hover:bg-blue-50 transition-colors">
                                        <td class="py-3 px-4 text-sm text-gray-800 font-medium">Sports Day</td>
                                        <td class="py-3 px-4 text-sm text-gray-600 hidden sm:table-cell">Nov 25, 2025</td>
                                        <td class="py-3 px-4 text-sm text-gray-600 hidden md:table-cell">8:00 AM</td>
                                        <td class="py-3 px-4"><span class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full font-medium">Scheduled</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </section>

    <script src="../javascript/sidebar.js">

    </script>
</body>
</html>