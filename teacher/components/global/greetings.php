<?php if (isset($_SESSION['greetings'])): ?>
<div id="greetingToast" class="fixed top-5 right-5 z-50 w-80 bg-white rounded-xl shadow-xl p-4 transform translate-x-32 opacity-0 transition-all duration-500">
    <!-- Close Button -->
    <button onclick="closeGreetingToast()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 font-bold text-lg">×</button>

    <!-- Profile Photo -->
    <div class="flex items-center mb-3">
        <div class="w-14 h-14 rounded-full border-2 border-blue-500 overflow-hidden mr-3">
            <img src="../uploads/users/<?php echo htmlspecialchars($authUser['photo']) ?>" alt="User Photo" class="w-full h-full object-cover">
        </div>
        <div>
            <h2 class="text-md font-bold text-gray-800"><?php echo htmlspecialchars($authUser['username']) ?></h2>
            <p class="text-sm text-blue-600 font-semibold"><?php echo htmlspecialchars($authUser['role']) ?></p>
        </div>
    </div>

    <!-- Greeting Message -->
    <p class="text-gray-700 text-sm mb-2">
        <?php echo $_SESSION['greetings']; ?>
    </p>

    <!-- Continue Button -->
    <button onclick="closeGreetingToast()" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1.5 rounded-lg transition-all duration-300">
        Continue
    </button>
</div>

<script>
    // Slide-in toast
    window.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('greetingToast');
        setTimeout(() => {
            toast.classList.remove('translate-x-32','opacity-0');
            toast.classList.add('translate-x-0','opacity-100');
        }, 100);

        // Auto-close after 5 seconds
        setTimeout(closeGreetingToast, 5000);
    });

    function closeGreetingToast() {
        const toast = document.getElementById('greetingToast');
        toast.classList.add('translate-x-32','opacity-0');
        setTimeout(() => toast.remove(), 500);
    }
</script>

<?php unset($_SESSION['greetings']); ?>
<?php endif; ?>
