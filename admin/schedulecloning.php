
<?php
// auth 
include('components/global/auth.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Cloning Tool</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="../img/sms.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }
        
        .sidebar {
            transition: all 0.3s;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .progress-bar {
            height: 6px;
            border-radius: 3px;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <?php include('components/global/sidebar.php') ?>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Navigation -->
            <div class="bg-white border-b px-6 py-4 flex items-center justify-between">
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
<div class="relative z-[9999]">
  <button id="mailBtn" class="text-gray-500 hover:text-gray-700 focus:outline-none relative">
    <i class="fas fa-envelope"></i>
    <span id="mailBadge"
      class="hidden bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center absolute -top-2 -right-2">
      0
    </span>
  </button>

  <!-- 📥 Mail Inbox Box -->
  <div id="mailBox"
    class="hidden absolute right-0 mt-2 w-72 bg-white border border-gray-300 rounded-lg shadow-lg p-4 z-[9999]">
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

    // ✉️ Example mail messages (you can replace this later with PHP/MySQL)
    const mails = []; // ← add mail objects here like: [{ from: "Alice", subject: "Hello" }]

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
    } else {
      mailBadge.classList.add("hidden");
      mailList.innerHTML = `<li class="text-gray-400 italic">No new mails.</li>`;
    }

    // ✨ Toggle mail inbox
    mailBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      mailBox.classList.toggle("hidden");
    });

    // ❌ Close mail box when clicking outside
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
    class="hidden absolute right-0 mt-2 w-72 bg-white border border-gray-300 rounded-lg shadow-lg p-4 z-50">
    <h3 class="font-semibold text-gray-700 mb-2">Settings</h3>
    <ul class="text-sm text-gray-600 space-y-2">
      <li class="hover:bg-gray-100 p-2 rounded cursor-pointer">Profile</li>
      <li class="hover:bg-gray-100 p-2 rounded cursor-pointer">Preferences</li>
      <li class="hover:bg-gray-100 p-2 rounded cursor-pointer">Logout</li>
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
        </div>
            
            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Source Schedule Selector -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1" for="sourceSchedule">Source Schedule</label>
                        <div class="relative">
                            <select id="sourceSchedule" class="w-full border rounded px-3 py-2 pr-10 focus:outline-none">
                                <option value="">Select source schedule</option>
                                <option value="g10a">Grade 10 – Section A, SY 2025 – 1st Semester</option>
                                <option value="g9b">Grade 9 – Section B, SY 2025 – 1st Semester</option>
                            </select>
                            <span class="absolute right-3 top-2 text-gray-400 pointer-events-none">
                            </span>
                        </div>
                    </div>
                    <!-- Calendar/Timetable Preview -->
                    <div class="border rounded p-4 bg-gray-50">
                        <div class="font-semibold text-gray-700 mb-2">Preview:</div>
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-gray-500">
                                    <th class="text-left py-1">Day/Time</th>
                                    <th class="text-left py-1">Subject – Teacher</th>
                                    <th class="text-left py-1">Room</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-1">Mon 8–10 AM</td>
                                    <td>Math – Mr. Cruz</td>
                                    <td><i class="fas fa-door-closed mr-1"></i> Room 101</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Tue 1–3 PM</td>
                                    <td>Science – Ms. Lee</td>
                                    <td><i class="fas fa-flask mr-1"></i> Lab 1</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Wed 10–12 NN</td>
                                    <td>English – Ms. Reyes</td>
                                    <td><i class="fas fa-door-closed mr-1"></i> Room 102</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Target Schedule Options -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1" for="targetSection">Target Class/Section</label>
                        <div class="relative">
                            <select id="targetSection" class="w-full border rounded px-3 py-2 pr-10 focus:outline-none">
                                <option value="">Select target section</option>
                                <option value="g10b">Grade 10 – Section B</option>
                                <option value="g9a">Grade 9 – Section A</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 flex gap-4">
                        <div class="flex-1">
                            <label class="block text-gray-700 font-semibold mb-1" for="startDate">Start Date</label>
                            <div class="relative">
                                <input type="date" id="startDate" class="w-full border rounded px-3 py-2 focus:outline-none">
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="block text-gray-700 font-semibold mb-1" for="endDate">End Date</label>
                            <div class="relative">
                                <input type="date" id="endDate" class="w-full border rounded px-3 py-2 focus:outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cloning Preferences -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="font-semibold text-gray-700 mb-2">Options:</div>
                    <div class="flex flex-col gap-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" checked class="form-checkbox text-indigo-600 mr-2">
                            Clone all subjects
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" checked class="form-checkbox text-indigo-600 mr-2">
                            Include teacher assignments
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-indigo-600 mr-2">
                            Keep original rooms (allow reassigning)
                        </label>
                    </div>
                </div>

                <!-- Preview Before Apply -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="font-semibold text-gray-700 mb-2">Preview of cloned schedule</div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-gray-500">
                                    <th class="text-left py-1">Day/Time</th>
                                    <th class="text-left py-1">Subject – Teacher</th>
                                    <th class="text-left py-1">Room</th>
                                    <th class="text-left py-1">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Preview rows dynamically filled by JS -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-4">
                    <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded font-semibold hover:bg-gray-300">Cancel</button>
                    <button class="bg-indigo-600 text-white px-6 py-2 rounded font-semibold hover:bg-indigo-700">Clone Schedule</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard loaded');

    const cancelBtn = document.querySelector('button.bg-gray-200');
    const cloneBtn = document.querySelector('button.bg-indigo-600');
    const sourceSelect = document.getElementById('sourceSchedule');
    const targetSelect = document.getElementById('targetSection');
    const startDate = document.getElementById('startDate');
    const endDate = document.getElementById('endDate');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const previewTable = document.querySelector('.overflow-x-auto tbody');

    // Sample schedule data
    const schedules = {
        g10a: [
            { day: 'Mon 8–10 AM', subject: 'Math', teacher: 'Mr. Cruz', room: 'Room 101', conflict: false },
            { day: 'Tue 1–3 PM', subject: 'Science', teacher: 'Ms. Lee', room: 'Lab 1', conflict: true },
            { day: 'Wed 10–12 NN', subject: 'English', teacher: 'Ms. Reyes', room: 'Room 102', conflict: false },
        ],
        g9b: [
            { day: 'Mon 8–10 AM', subject: 'History', teacher: 'Mr. Santos', room: 'Room 103', conflict: false },
            { day: 'Tue 1–3 PM', subject: 'Biology', teacher: 'Ms. Tan', room: 'Lab 2', conflict: false },
            { day: 'Wed 10–12 NN', subject: 'Filipino', teacher: 'Ms. Cruz', room: 'Room 104', conflict: true },
        ]
    };

    // Function to render preview table
    function renderPreview() {
        const selectedSource = sourceSelect.value;
        const keepRooms = checkboxes[2].checked; // Keep original rooms
        if (!selectedSource) {
            previewTable.innerHTML = '';
            return;
        }

        const data = schedules[selectedSource];
        previewTable.innerHTML = '';

        data.forEach(row => {
            const tr = document.createElement('tr');

            // Day/Time
            const tdDay = document.createElement('td');
            tdDay.className = 'py-1';
            tdDay.textContent = row.day;
            tr.appendChild(tdDay);

            // Subject – Teacher
            const tdSub = document.createElement('td');
            tdSub.textContent = `${row.subject} – ${row.teacher}`;
            tr.appendChild(tdSub);

            // Room
            const tdRoom = document.createElement('td');
            tdRoom.innerHTML = `<i class="fas fa-door-closed mr-1"></i> ${keepRooms ? row.room : 'TBD'}`;
            tr.appendChild(tdRoom);

            // Status
            const tdStatus = document.createElement('td');
            if (row.conflict && keepRooms) {
                tdStatus.innerHTML = '<span class="text-red-600"><i class="fas fa-exclamation-triangle"></i> Room conflict</span>';
            } else {
                tdStatus.innerHTML = '<span class="text-green-600"><i class="fas fa-check-circle"></i> OK</span>';
            }
            tr.appendChild(tdStatus);

            previewTable.appendChild(tr);
        });
    }

    // Event listeners
    sourceSelect.addEventListener('change', renderPreview);
    checkboxes.forEach(cb => cb.addEventListener('change', renderPreview));

    cancelBtn.addEventListener('click', () => {
        sourceSelect.value = '';
        targetSelect.value = '';
        startDate.value = '';
        endDate.value = '';
        checkboxes.forEach(cb => cb.checked = false);
        previewTable.innerHTML = '';
        alert('All fields have been reset!');
    });

    cloneBtn.addEventListener('click', () => {
        const sourceText = sourceSelect.options[sourceSelect.selectedIndex]?.text || 'N/A';
        const targetText = targetSelect.options[targetSelect.selectedIndex]?.text || 'N/A';
        const start = startDate.value || 'N/A';
        const end = endDate.value || 'N/A';
        alert(`Schedule cloned from "${sourceText}" to "${targetText}"\nStart Date: ${start}\nEnd Date: ${end}`);
    });

    targetSelect.addEventListener('change', () => console.log('Target section selected:', targetSelect.value));
    startDate.addEventListener('change', () => console.log('Start date selected:', startDate.value));
    endDate.addEventListener('change', () => console.log('End date selected:', endDate.value));

    
    });
    </script>
</body>
</html>
