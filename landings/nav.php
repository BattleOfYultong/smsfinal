<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md shadow-md border-b-2 border-blue-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">
      <!-- Logo & Brand -->
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-lg">
          <img src="img/sms.png" alt="SMS Logo" class="w-10 h-10 object-contain">
        </div>
        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent hidden sm:block">
          Student Management System
        </span>
        <span class="text-lg font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent sm:hidden">
          SMS
        </span>
      </div>

      <!-- Desktop Navigation -->
      <div class="hidden lg:flex items-center gap-8">
        <a href="#" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">Home</a>
        <a href="#features" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">Features</a>
        <a href="#about-us" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">About Us</a>
        <a href="#contact" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">Contact</a>
      </div>

      <!-- CTA Button (Desktop) -->
      <div class="hidden lg:block">
        <a href="login.php" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
          <span>Sign In</span>
          <i class="fas fa-arrow-right text-sm"></i>
        </a>
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-btn" class="lg:hidden w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center hover:bg-blue-200 transition-colors">
        <i class="fas fa-bars text-blue-600 text-xl"></i>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200 shadow-lg">
    <div class="px-4 py-6 space-y-4">
      <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-home w-6 text-blue-600"></i> Home
      </a>
      <a href="#features" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-star w-6 text-blue-600"></i> Features
      </a>
   
      <a href="#about-us" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-info-circle w-6 text-blue-600"></i> About Us
      </a>
      <a href="#contact" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-envelope w-6 text-blue-600"></i> Contact
      </a>
      <a href="login.php" class="block px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-full shadow-lg text-center hover:shadow-xl transform hover:scale-105 transition-all">
        Go to Portal <i class="fas fa-arrow-right ml-2"></i>
      </a>
    </div>
  </div>
</nav>
