<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }
        
        .sidebar-transition {
            transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-slide-in {
            animation: slideIn 0.3s ease-out forwards;
        }
        
        .menu-item {
            transition: all 0.2s ease;
        }
        
        .menu-item:hover {
            transform: translateX(4px);
        }
        
        @keyframes pulse-soft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .notification-badge {
            animation: pulse-soft 2s infinite;
        }
        
        .collapsed-sidebar {
            width: 5rem;
        }
        
        .collapsed-sidebar .sidebar-text {
            display: none;
        }
        
        .collapsed-sidebar .logo-text {
            display: none;
        }
        
        .tooltip {
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .menu-item:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-indigo-600 text-white rounded-lg shadow-lg hover:bg-indigo-700 transition-colors">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <!-- Overlay for mobile -->
    <div id="sidebar-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar-transition fixed top-0 left-0 h-screen bg-white shadow-xl z-40 w-72 -translate-x-full lg:translate-x-0 flex flex-col">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <div class="logo-text">
                        <h4 class="font-bold text-gray-800 text-lg leading-tight">Student<br>Management</h4>
                    </div>
                </div>
                <!-- Desktop Toggle -->
                <button id="collapse-btn" class="hidden lg:block p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-angles-left text-gray-600"></i>
                </button>
                <!-- Mobile Close -->
                <button id="mobile-close-btn" class="lg:hidden p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-times text-gray-600"></i>
                </button>
            </div>
            
            <!-- Search Bar -->
            <div class="relative sidebar-text">
                <input type="text" id="menu-search" placeholder="Search menu..." class="w-full px-4 py-2 pl-10 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto px-4 py-6 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
            <!-- Main Section -->
            <div class="mb-6 animate-slide-in">
                <p class="sidebar-text text-xs font-semibold text-gray-500 uppercase tracking-wider px-2 mb-3">Main</p>
                <a href="dashboard.php" class="menu-item flex items-center px-3 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-xl text-white font-medium shadow-md hover:shadow-lg relative group">
                    <i class="fas fa-tachometer-alt mr-3 text-lg w-6 text-center"></i>
                    <span class="sidebar-text">Dashboard</span>
                    <span class="ml-auto">
                        <span class="notification-badge flex items-center justify-center w-6 h-6 text-xs bg-red-500 text-white rounded-full">3</span>
                    </span>
                    <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                        Dashboard
                    </div>
                </a>
            </div>
            
            <!-- Management Section -->
            <div class="mb-6 animate-slide-in" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between px-2 mb-3">
                    <p class="sidebar-text text-xs font-semibold text-gray-500 uppercase tracking-wider">Management</p>
                    <button class="sidebar-text text-gray-400 hover:text-gray-600" onclick="toggleSection('management')">
                        <i id="management-icon" class="fas fa-chevron-down text-xs transition-transform"></i>
                    </button>
                </div>
                <div id="management-section" class="space-y-1">
                    <a href="sectionassignment.php" class="menu-item flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg group relative">
                        <i class="fas fa-user-graduate mr-3 w-6 text-center"></i>
                        <span class="sidebar-text text-sm">Section Assignment</span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                            Section Assignment Tool
                        </div>
                    </a>
                    <a href="teachershedmap.php" class="menu-item flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg group relative">
                        <i class="fas fa-clipboard-list mr-3 w-6 text-center"></i>
                        <span class="sidebar-text text-sm">Schedule Mapping</span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                            Teacher Schedule Mapping
                        </div>
                    </a>
                    <a href="examtimetable.php" class="menu-item flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg group relative">
                        <i class="fas fa-calendar-alt mr-3 w-6 text-center"></i>
                        <span class="sidebar-text text-sm">Exam Timetable</span>
                        <span class="sidebar-text ml-auto">
                            <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">New</span>
                        </span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                            Exam Timetable Generator
                        </div>
                    </a>
                    <a href="subtitute.php" class="menu-item flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg group relative">
                        <i class="fas fa-user-clock mr-3 w-6 text-center"></i>
                        <span class="sidebar-text text-sm">Substitute Tracker</span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                            Substitute Assignment Tracker
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Tools Section -->
            <div class="mb-6 animate-slide-in" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between px-2 mb-3">
                    <p class="sidebar-text text-xs font-semibold text-gray-500 uppercase tracking-wider">Tools</p>
                    <button class="sidebar-text text-gray-400 hover:text-gray-600" onclick="toggleSection('tools')">
                        <i id="tools-icon" class="fas fa-chevron-down text-xs transition-transform"></i>
                    </button>
                </div>
                <div id="tools-section" class="space-y-1">
                    <a href="../cons/specialss.html" class="menu-item flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg group relative">
                        <i class="fas fa-chalkboard-teacher mr-3 w-6 text-center"></i>
                        <span class="sidebar-text text-sm">Special Scheduler</span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                            Special Class Scheduler
                        </div>
                    </a>
                    <a href="roomavailability.php" class="menu-item flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg group relative">
                        <i class="fas fa-door-open mr-3 w-6 text-center"></i>
                        <span class="sidebar-text text-sm">Room Checker</span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                            Room Availability Checker
                        </div>
                    </a>
                    <a href="../cons/schedule.html" class="menu-item flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg group relative">
                        <i class="fas fa-clone mr-3 w-6 text-center"></i>
                        <span class="sidebar-text text-sm">Schedule Clone</span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                            Schedule Cloning Tool
                        </div>
                    </a>
                    <a href="../cons/timeblock.html" class="menu-item flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg group relative">
                        <i class="fas fa-clock mr-3 w-6 text-center"></i>
                        <span class="sidebar-text text-sm">Time Blocks</span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                            Time Block Customizer
                        </div>
                    </a>
                    <a href="../cons/calendar.html" class="menu-item flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg group relative">
                        <i class="fas fa-calendar-check mr-3 w-6 text-center"></i>
                        <span class="sidebar-text text-sm">Calendar Sync</span>
                        <div class="tooltip absolute left-full ml-2 px-3 py-1 bg-gray-900 text-white text-sm rounded-lg whitespace-nowrap">
                            Calendar Integration
                        </div>
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="sidebar-text mb-6 animate-slide-in" style="animation-delay: 0.3s">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-2 mb-3">Quick Actions</p>
                <div class="grid grid-cols-2 gap-2">
                    <button class="p-3 bg-blue-50 hover:bg-blue-100 rounded-lg text-center transition-colors group">
                        <i class="fas fa-plus text-blue-600 text-lg mb-1"></i>
                        <p class="text-xs text-gray-600 font-medium">Add New</p>
                    </button>
                    <button class="p-3 bg-green-50 hover:bg-green-100 rounded-lg text-center transition-colors group">
                        <i class="fas fa-file-export text-green-600 text-lg mb-1"></i>
                        <p class="text-xs text-gray-600 font-medium">Export</p>
                    </button>
                </div>
            </div>
        </nav>

        <!-- User Profile Footer -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 cursor-pointer group">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=818cf8&color=fff" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md">
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></span>
                    </div>
                    <div class="sidebar-text">
                        <p class="text-sm font-semibold text-white">Admin User</p>
                        <p class="text-xs text-indigo-200">Administrator</p>
                    </div>
                </div>
                <a href="../routes/logout.php" class="text-white hover:text-indigo-200 transition-colors duration-200 p-2 hover:bg-white/10 rounded-lg" title="Logout">
                    <i class="fas fa-sign-out-alt text-lg"></i>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content Area (Demo) -->
    <div class="lg:ml-72 p-8 transition-all duration-300" id="main-content">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Dashboard</h1>
            <p class="text-gray-600">Welcome to your Student Management System. Use the sidebar to navigate through different sections.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                        <span class="text-sm text-green-600 font-medium">+12%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">1,234</h3>
                    <p class="text-gray-600 text-sm">Total Students</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                        </div>
                        <span class="text-sm text-green-600 font-medium">+5%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">87</h3>
                    <p class="text-gray-600 text-sm">Active Teachers</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book text-purple-600 text-xl"></i>
                        </div>
                        <span class="text-sm text-green-600 font-medium">+8%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">42</h3>
                    <p class="text-gray-600 text-sm">Active Courses</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script>
        // Sidebar functionality
        const sidebar = document.getElementById('sidebar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileCloseBtn = document.getElementById('mobile-close-btn');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const collapseBtn = document.getElementById('collapse-btn');
        const mainContent = document.getElementById('main-content');
        const menuSearch = document.getElementById('menu-search');

        // Mobile menu toggle
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        });

        mobileCloseBtn.addEventListener('click', closeMobileMenu);
        sidebarOverlay.addEventListener('click', closeMobileMenu);

        function closeMobileMenu() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }

        // Desktop collapse toggle
        let isCollapsed = false;
        collapseBtn.addEventListener('click', () => {
            isCollapsed = !isCollapsed;
            const icon = collapseBtn.querySelector('i');
            
            if (isCollapsed) {
                sidebar.classList.add('collapsed-sidebar');
                sidebar.classList.remove('w-72');
                mainContent.classList.remove('lg:ml-72');
                mainContent.classList.add('lg:ml-20');
                icon.classList.remove('fa-angles-left');
                icon.classList.add('fa-angles-right');
            } else {
                sidebar.classList.remove('collapsed-sidebar');
                sidebar.classList.add('w-72');
                mainContent.classList.remove('lg:ml-20');
                mainContent.classList.add('lg:ml-72');
                icon.classList.remove('fa-angles-right');
                icon.classList.add('fa-angles-left');
            }
        });

        // Section toggle
        function toggleSection(sectionId) {
            const section = document.getElementById(`${sectionId}-section`);
            const icon = document.getElementById(`${sectionId}-icon`);
            
            if (section.classList.contains('hidden')) {
                section.classList.remove('hidden');
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-down');
            } else {
                section.classList.add('hidden');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-right');
            }
        }

        // Menu search functionality
        menuSearch.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const menuItems = document.querySelectorAll('.menu-item');
            
            menuItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    item.style.display = 'flex';
                    item.classList.add('animate-slide-in');
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Active link highlighting
        const currentPage = window.location.pathname.split('/').pop();
        const menuItems = document.querySelectorAll('.menu-item');
        
        menuItems.forEach(item => {
            if (item.getAttribute('href') === currentPage) {
                item.classList.add('bg-indigo-50', 'text-indigo-700', 'font-medium');
            }
        });

        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>