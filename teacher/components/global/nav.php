 <nav class="bg-white border-b px-6 py-4 flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-800">Dashboard Overview</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <!-- Notification Button -->
<div class="relative">
  <!-- 🔔 Notification Button -->
  <button id="notifBtn" class="text-gray-500 hover:text-gray-700 focus:outline-none relative">
    <i class="fas fa-bell"></i>
    <!-- 🔴 Notification Badge -->
    <span id="notifBadge"
      class="hidden bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center absolute -top-2 -right-2">
      0
    </span>
  </button>

  <!-- 📦 Notification Box -->
  <div id="notifBox"
    class="hidden absolute right-0 mt-2 w-64 bg-white border border-gray-300 rounded-lg shadow-lg p-4 z-[9999]">
    <h3 class="font-semibold text-gray-700 mb-2">Notifications</h3>
    <ul id="notifList" class="text-sm text-gray-600 space-y-2"></ul>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const notifBtn = document.getElementById("notifBtn");
    const notifBox = document.getElementById("notifBox");
    const notifBadge = document.getElementById("notifBadge");
    const notifList = document.getElementById("notifList");

    // Example notifications (you can make this dynamic via PHP later)
    const notifications = []; // ← try empty array to test “no notifications”

    // Update badge and list
    if (notifications.length > 0) {
      notifBadge.textContent = notifications.length;
      notifBadge.classList.remove("hidden");

      // Add notifications to the list
      notifications.forEach(note => {
        const li = document.createElement("li");
        li.textContent = note;
        notifList.appendChild(li);
      });
    } else {
      notifBadge.classList.add("hidden");
      notifList.innerHTML = `<li class="text-gray-400 italic">No new notifications.</li>`;
    }

    // ✅ Always allow opening of notification box
    notifBtn.addEventListener("click", (e) => {
      e.stopPropagation(); // prevent closing immediately
      notifBox.classList.toggle("hidden");
    });

    // Close notification box when clicking outside
    window.addEventListener("click", (e) => {
      if (!notifBox.contains(e.target) && !notifBtn.contains(e.target)) {
        notifBox.classList.add("hidden");
      }
    });
  });
</script>
</div>

                   <!-- ✉️ Mail Button -->
<div class="relative">
  <button id="mailBtn" class="text-gray-500 hover:text-gray-700 focus:outline-none relative">
    <i class="fas fa-envelope"></i>
    <span id="mailBadge"
      class="hidden bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center absolute -top-2 -right-2">
      0
    </span>
  </button>

  <!-- 📥 Mail Inbox Box -->
  <div id="mailBox"
    class="hidden absolute right-0 mt-2 w-72 bg-white border border-gray-300 rounded-lg shadow-lg p-4 z-50">
    <h3 class="font-semibold text-gray-700 mb-2">Mail Inbox</h3>
    <ul id="mailList" class="text-sm text-gray-600 space-y-2"></ul>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const mailBtn = document.getElementById("mailBtn");
    const mailBox = document.getElementById("mailBox");
    const mailBadge = document.getElementById("mailBadge");
    const mailList = document.getElementById("mailList");

    // ✉️ Example mail messages (you can later replace this with PHP + MySQL)
    const mails = []; // ← try empty array to test “no mails”

    // ✅ Show badge only if there are mails
    if (mails.length > 0) {
      mailBadge.textContent = mails.length;
      mailBadge.classList.remove("hidden");

      mails.forEach(mail => {
        const li = document.createElement("li");
        li.innerHTML = `
          <div class="p-2 hover:bg-gray-100 rounded cursor-pointer transition">
            <p class="font-semibold text-gray-800">${mail.from}</p>
            <p class="text-gray-600 text-sm">${mail.subject}</p>
          </div>`;
        mailList.appendChild(li);
      });
    }else {
      mailBadge.classList.add("hidden");
      mailList.innerHTML = `<li class="text-gray-400 italic">No new mails.</li>`;
    }
    

    // ✨ Toggle mail inbox
    mailBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      mailBox.classList.toggle("hidden");
    });

    // Close mail box when clicking outside
    window.addEventListener("click", (e) => {
      if (!mailBox.contains(e.target) && !mailBtn.contains(e.target)) {
        mailBox.classList.add("hidden");
      }
    });
  });
</script>

        <!-- SETTINGS BUTTON -->
<div class="relative inline-block text-left">
  <button id="settingsBtn" class="text-gray-500 hover:text-gray-700">
    <i class="fas fa-cog"></i>
  </button>

  <!-- SETTINGS PANEL -->
  <div id="settingsBox"
  class="hidden absolute right-0 mt-3 w-64 bg-white border border-gray-200 rounded-xl shadow-lg p-3 z-50">
  
  <h3 class="font-semibold text-gray-800 text-sm px-3 mb-2">Settings</h3>
  
  <ul class="text-sm text-gray-700 divide-y divide-gray-100">
    <li>
      <a href="#profile" 
         class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-150">
        <i class="fa-regular fa-user text-gray-500"></i>
        Profile
      </a>
    </li>
    <li>
      <a href="#preferences" 
         class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-150">
        <i class="fa-solid fa-gear text-gray-500"></i>
        Preferences
      </a>
    </li>
    <li>
      <a href="../routes/logout.php" 
         class="flex items-center gap-2 px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 transition-colors duration-150">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
      </a>
    </li>
  </ul>
</div>
</div>

<!-- SCRIPT -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const settingsBtn = document.getElementById("settingsBtn");
    const settingsBox = document.getElementById("settingsBox");

    // Toggle settings panel
    settingsBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      settingsBox.classList.toggle("hidden");
    });

    // Close settings panel when clicking outside
    window.addEventListener("click", (e) => {
      if (!settingsBox.contains(e.target) && !settingsBtn.contains(e.target)) {
        settingsBox.classList.add("hidden");
      }
    });
  });
</script>

                </div>
            </nav>