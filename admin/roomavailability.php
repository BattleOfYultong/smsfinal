<?php
// auth 
include('components/global/auth.php')

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Room Availability Checker</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="../img/sms.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary: #4f46e5;
      --success: #10b981;
      --danger: #ef4444;
      --warning: #f59e0b;
      --info: #3b82f6;
    }

    .sidebar { transition: all 0.3s ease; }
    .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .card-hover:hover { transform: translateY(-4px); box-shadow: 0 8px 18px rgba(0,0,0,0.1); }
    .notification-badge { position: absolute; top: -6px; right: -6px; }

    /* Map specific */
    .floor-map { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    .room-card { border-radius: 0.5rem; padding: 0.75rem; cursor: pointer; border: 1px solid rgba(0,0,0,0.06); transition: transform 0.12s, box-shadow 0.12s; display: flex; align-items: center; justify-content: space-between; }
    .room-card:hover { transform: translateY(-4px); box-shadow: 0 8px 18px rgba(0,0,0,0.06); }
    .status-dot { width: 12px; height: 12px; border-radius: 9999px; display: inline-block; margin-right: 0.5rem; border: 2px solid rgba(255,255,255,0.6); }
    .status-unknown { background: #9CA3AF; } /* gray */
    .status-available { background: #10B981; } /* green */
    .status-occupied { background: #EF4444; } /* red */
    .legend-dot { width: 12px; height: 12px; border-radius: 9999px; display:inline-block; margin-right: 0.5rem; }

    @media (max-width: 768px) { .floor-map { grid-template-columns: 1fr; } }

    .fade-in { animation: fadeIn 0.25s ease-in-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

    /* toast */
    .toast { position: fixed; right: 20px; bottom: 24px; z-index: 60; padding: 12px 16px; border-radius: 8px; box-shadow: 0 6px 18px rgba(0,0,0,0.12); display: flex; gap: 8px; align-items: center; }
  </style>
</head>

<body class="bg-gray-100 font-sans">

  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <?php 
    include_once('components/global/sidebar.php')
  ?>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
      <!-- Top Bar -->
      <div class="bg-white border-b px-6 py-4 flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Room Availability Checker</h1>
        <div class="flex items-center space-x-4">
          <!-- Notification -->
          <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-bell text-lg"></i></button>
          <!-- Mail -->
          <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-envelope text-lg"></i></button>
          <!-- Settings -->
          <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-cog text-lg"></i></button>
        </div>
      </div>

      <!-- Page Content -->
      <div class="p-6 space-y-6">
        <!-- Form -->
        <div class="bg-white rounded-lg shadow-md p-6 card-hover">
          <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
            <i class="fas fa-door-open text-indigo-600 mr-2"></i> Check Room Availability
          </h2>

          <div class="grid md:grid-cols-3 gap-4 mb-4">
            <div>
              <label class="block text-gray-700 font-medium mb-1">Select Room</label>
              <select id="room" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                <option value="">Choose room...</option>
                <option value="101">Room 101</option>
                <option value="102">Room 102</option>
                <option value="Auditorium">Auditorium</option>
                <option value="Lab1">Computer Lab 1</option>
                <option value="201">Room 201</option>
                <option value="202">Room 202</option>
              </select>
            </div>

            <div>
              <label class="block text-gray-700 font-medium mb-1">Select Date</label>
              <input type="date" id="date" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>

            <div>
              <label class="block text-gray-700 font-medium mb-1">Select Time Slot</label>
              <select id="time" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                <option value="">Choose time slot...</option>
                <option value="8-10">8–10 AM</option>
                <option value="10-12">10–12 NN</option>
                <option value="1-3">1–3 PM</option>
                <option value="3-5">3–5 PM</option>
                <option value="custom">Custom...</option>
              </select>
              <input type="text" id="customTime" class="w-full border rounded px-3 py-2 mt-2 hidden" placeholder="e.g., 2:30–4:00 PM">
            </div>
          </div>

          <button id="checkBtn" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded mt-2 hover:bg-indigo-700 disabled:opacity-50 transition">Check Availability</button>
        </div>

        <!-- Floor Map -->
        <div class="bg-white rounded-lg shadow-md p-6 card-hover">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Building Map (Clickable)</h3>
            <div class="text-sm text-gray-600 flex items-center space-x-3">
              <div class="flex items-center"><span class="legend-dot" style="background:#10B981"></span><span>Available</span></div>
              <div class="flex items-center"><span class="legend-dot" style="background:#EF4444"></span><span>Occupied</span></div>
              <div class="flex items-center"><span class="legend-dot" style="background:#9CA3AF"></span><span>Unknown</span></div>
            </div>
          </div>

          <div class="floor-map">
            <!-- First Floor -->
            <div>
              <h4 class="text-sm font-medium text-gray-700 mb-2">1st Floor</h4>
              <div class="space-y-2">
                <div class="room-card bg-white" data-room="101" data-floor="1" title="Room 101 - click to select">
                  <div class="flex items-center">
                    <span class="status-dot status-unknown" data-dot="101"></span>
                    <div>
                      <div class="font-semibold text-gray-700">Room 101</div>
                      <div class="text-xs text-gray-500">Capacity: 40</div>
                    </div>
                  </div>
                  <div class="text-xs text-gray-500">1F</div>
                </div>

                <div class="room-card bg-white" data-room="102" data-floor="1" title="Room 102 - click to select">
                  <div class="flex items-center">
                    <span class="status-dot status-unknown" data-dot="102"></span>
                    <div>
                      <div class="font-semibold text-gray-700">Room 102</div>
                      <div class="text-xs text-gray-500">Capacity: 30</div>
                    </div>
                  </div>
                  <div class="text-xs text-gray-500">1F</div>
                </div>

                <div class="room-card bg-white" data-room="Auditorium" data-floor="1" title="Auditorium - click to select">
                  <div class="flex items-center">
                    <span class="status-dot status-unknown" data-dot="Auditorium"></span>
                    <div>
                      <div class="font-semibold text-gray-700">Auditorium</div>
                      <div class="text-xs text-gray-500">Capacity: 200</div>
                    </div>
                  </div>
                  <div class="text-xs text-gray-500">1F</div>
                </div>
              </div>
            </div>

            <!-- Second Floor -->
            <div>
              <h4 class="text-sm font-medium text-gray-700 mb-2">2nd Floor</h4>
              <div class="space-y-2">
                <div class="room-card bg-white" data-room="Lab1" data-floor="2" title="Computer Lab 1 - click to select">
                  <div class="flex items-center">
                    <span class="status-dot status-unknown" data-dot="Lab1"></span>
                    <div>
                      <div class="font-semibold text-gray-700">Computer Lab 1</div>
                      <div class="text-xs text-gray-500">Capacity: 25</div>
                    </div>
                  </div>
                  <div class="text-xs text-gray-500">2F</div>
                </div>

                <div class="room-card bg-white" data-room="201" data-floor="2" title="Room 201 - click to select">
                  <div class="flex items-center">
                    <span class="status-dot status-unknown" data-dot="201"></span>
                    <div>
                      <div class="font-semibold text-gray-700">Room 201</div>
                      <div class="text-xs text-gray-500">Capacity: 35</div>
                    </div>
                  </div>
                  <div class="text-xs text-gray-500">2F</div>
                </div>

                <div class="room-card bg-white" data-room="202" data-floor="2" title="Room 202 - click to select">
                  <div class="flex items-center">
                    <span class="status-dot status-unknown" data-dot="202"></span>
                    <div>
                      <div class="font-semibold text-gray-700">Room 202</div>
                      <div class="text-xs text-gray-500">Capacity: 28</div>
                    </div>
                  </div>
                  <div class="text-xs text-gray-500">2F</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Result Section -->
        <div id="resultCard" class="hidden bg-white rounded-lg shadow-md p-6 card-hover">
          <div id="resultStatus" class="flex items-center p-4 rounded-lg mb-4"></div>
          <div id="resultActions"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- toast container -->
  <div id="toastContainer"></div>

  <!-- Script -->
  <script>
    const room = document.getElementById('room');
    const date = document.getElementById('date');
    const time = document.getElementById('time');
    const customTime = document.getElementById('customTime');
    const checkBtn = document.getElementById('checkBtn');
    const resultCard = document.getElementById('resultCard');
    const resultStatus = document.getElementById('resultStatus');
    const resultActions = document.getElementById('resultActions');

    // Map elements
    const roomCards = Array.from(document.querySelectorAll('.room-card'));
    const statusDots = Array.from(document.querySelectorAll('.status-dot'));

    // bookings saved in localStorage under key 'roomBookings'
    function loadBookings() {
      try {
        const raw = localStorage.getItem('roomBookings');
        return raw ? JSON.parse(raw) : [];
      } catch (e) { return []; }
    }
    function saveBookings(list) { localStorage.setItem('roomBookings', JSON.stringify(list)); }

    function bookingKey(roomId, dateStr, timeVal) {
      return `${roomId}||${dateStr}||${timeVal}`;
    }

    function isRoomBooked(roomId, dateStr, timeVal) {
      if (!roomId || !dateStr || !timeVal) return false;
      const list = loadBookings();
      const key = bookingKey(roomId, dateStr, timeVal);
      return list.some(b => b.key === key);
    }

    function addBooking(roomId, dateStr, timeVal) {
      const list = loadBookings();
      const key = bookingKey(roomId, dateStr, timeVal);
      if (list.some(b => b.key === key)) return false;
      list.push({ key, room: roomId, date: dateStr, time: timeVal, created: new Date().toISOString() });
      saveBookings(list);
      return true;
    }

    function removeBooking(roomId, dateStr, timeVal) {
      let list = loadBookings();
      const key = bookingKey(roomId, dateStr, timeVal);
      const before = list.length;
      list = list.filter(b => b.key !== key);
      saveBookings(list);
      return list.length < before;
    }

    // Hardcoded busy example (kept for backward compatibility with your original logic)
    function isRoomBusyRule(roomId, dateStr, timeVal) {
      if (!roomId || !dateStr || !timeVal) return false;
      return (roomId === '101' && dateStr === '2025-08-20' && timeVal === '8-10');
    }

    // Enable custom input if "Custom" selected
    time.addEventListener('change', () => {
      customTime.classList.toggle('hidden', time.value !== 'custom');
      validateForm(); updateMapHighlights();
    });

    [room, date, time, customTime].forEach(el => el.addEventListener('input', () => { validateForm(); updateMapHighlights(); }));

    function validateForm() {
      let valid = room.value && date.value && time.value;
      if (time.value === 'custom') valid = valid && customTime.value.trim();
      checkBtn.disabled = !valid;

      [room, date, time, customTime].forEach(el => el.classList.remove('border-red-500'));
      if (!room.value) room.classList.add('border-red-500');
      if (!date.value) date.classList.add('border-red-500');
      if (!time.value) time.classList.add('border-red-500');
      if (time.value === 'custom' && !customTime.value.trim()) customTime.classList.add('border-red-500');
    }

    // Clicking a map card selects room + optionally book/unbook if date/time present
    roomCards.forEach(card => {
      card.addEventListener('click', () => {
        const r = card.dataset.room;
        room.value = r;
        card.classList.add('ring-2', 'ring-indigo-200');
        setTimeout(() => card.classList.remove('ring-2', 'ring-indigo-200'), 500);

        document.querySelector('.card-hover').scrollIntoView({ behavior: 'smooth', block: 'center' });
        date.focus();
        validateForm(); updateMapHighlights();

        // If user has chosen date & time, toggle booking via map click
        if (date.value && time.value) {
          const timeValue = time.value;
          if (isRoomBooked(r, date.value, timeValue) || isRoomBusyRule(r, date.value, timeValue)) {
            // if booked, confirm unbook
            if (confirm(`This room appears booked for the selected slot. Unbook it?`)) {
              const removed = removeBooking(r, date.value, timeValue);
              if (removed) showToast('Booking removed');
              updateMapHighlights();
              updateResultCardIfMatchesSelected();
            }
          } else {
            // ask to confirm booking action
            if (confirm(`Book ${r} for ${formatDate(date.value)} (${humanTimeLabel(time)})?`)) {
              addBooking(r, date.value, timeValue);
              showToast('Successfully Booked');
              updateMapHighlights();
              updateResultCardIfMatchesSelected();
            }
          }
        }
      });
    });

    // Check availability button logic
    checkBtn.addEventListener('click', () => {
      const originalText = checkBtn.innerHTML;
      checkBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Checking...';
      checkBtn.disabled = true;

      const selectedRoomText = room.options[room.selectedIndex].text;
      const selectedDateText = formatDate(date.value);
      const selectedTimeText = time.value === 'custom' ? customTime.value : time.options[time.selectedIndex].text;
      const timeValue = time.value;

      setTimeout(() => {
        const busyByRule = isRoomBusyRule(room.value, date.value, timeValue);
        const booked = isRoomBooked(room.value, date.value, timeValue) || busyByRule;

        resultCard.classList.remove('hidden');
        resultCard.classList.add('fade-in');
        resultCard.scrollIntoView({ behavior: 'smooth' });

        if (!booked) {
          resultStatus.className = "flex items-center p-4 rounded-lg mb-4 bg-green-50 border border-green-200";
          resultStatus.innerHTML = `\n            <i class="fas fa-check-circle text-green-600 text-2xl mr-3"></i>\n            <span class="font-semibold text-green-700">${selectedRoomText} is <b>Available</b> (${selectedTimeText}, ${selectedDateText})</span>\n          `;
          resultActions.innerHTML = `\n            <button id="bookBtn" class="bg-green-600 text-white px-4 py-2 rounded font-semibold hover:bg-green-700 transition">\n              <i class="fas fa-calendar-plus mr-2"></i>Book Room\n            </button>\n          `;
        } else {
          resultStatus.className = "flex items-center p-4 rounded-lg mb-4 bg-red-50 border border-red-200";
          resultStatus.innerHTML = `\n            <i class="fas fa-times-circle text-red-600 text-2xl mr-3"></i>\n            <span class="font-semibold text-red-700">${selectedRoomText} is <b>NOT Available</b> (${selectedTimeText}, ${selectedDateText})</span>\n          `;
          resultActions.innerHTML = `\n            <p class="text-sm text-gray-700 mb-2">Try these alternative slots:</p>\n            <div class="flex flex-wrap gap-2">\n              <button class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded hover:bg-indigo-200">10–12 NN</button>\n              <button class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded hover:bg-indigo-200">1–3 PM</button>\n            </div>\n          `;
        }

        updateMapHighlights();

        checkBtn.innerHTML = originalText;
        checkBtn.disabled = false;
      }, 600);
    });

    // Delegate booking button (result actions) clicks
    document.addEventListener('click', (e) => {
      const btn = e.target.closest('#bookBtn');
      if (!btn) return;
      const r = room.value;
      const d = date.value;
      const t = time.value;
      if (!r || !d || !t) { alert('Please select room, date and time first.'); return; }

      if (isRoomBooked(r, d, t) || isRoomBusyRule(r, d, t)) {
        alert('This slot is already booked.'); return;
      }

      const added = addBooking(r, d, t);
      if (added) {
        showToast('Successfully Booked');
        updateMapHighlights();
        updateResultCardIfMatchesSelected();
      } else {
        alert('Could not save booking (it may already exist).');
      }
    });

    // Update map colors according to bookings & hardcoded busy rule
    function updateMapHighlights() {
      const currentDate = date.value;
      const currentTime = time.value;

      statusDots.forEach(dot => dot.className = 'status-dot status-unknown');

      // If date & time chosen, mark each room available/occupied
      if (currentDate && currentTime) {
        statusDots.forEach(dot => {
          const r = dot.dataset.dot;
          if (isRoomBooked(r, currentDate, currentTime) || isRoomBusyRule(r, currentDate, currentTime)) {
            dot.className = 'status-dot status-occupied';
          } else {
            dot.className = 'status-dot status-available';
          }
        });
      } else {
        // if no date/time, only highlight selected room as unknown
        if (room.value) {
          statusDots.forEach(dot => { if (dot.dataset.dot === room.value) dot.className = 'status-dot status-unknown'; });
        }

        // also mark any bookings that exist for any date/time as occupied (optional UX: lets admin see booked rooms overall)
        const allBookings = loadBookings();
        if (allBookings.length) {
          const bookedRooms = new Set(allBookings.map(b => b.room));
          statusDots.forEach(dot => { if (bookedRooms.has(dot.dataset.dot)) dot.className = 'status-dot status-occupied'; });
        }
      }
    }

    function updateResultCardIfMatchesSelected() {
      // If the result card is visible and matches the currently selected slot, refresh it
      if (resultCard.classList.contains('hidden')) return;
      const selectedRoomText = room.options[room.selectedIndex].text;
      const selectedDateText = formatDate(date.value);
      const selectedTimeText = time.value === 'custom' ? customTime.value : time.options[time.selectedIndex].text;
      const t = time.value;
      const booked = isRoomBooked(room.value, date.value, t) || isRoomBusyRule(room.value, date.value, t);

      if (!booked) {
        resultStatus.className = "flex items-center p-4 rounded-lg mb-4 bg-green-50 border border-green-200";
        resultStatus.innerHTML = `\n          <i class="fas fa-check-circle text-green-600 text-2xl mr-3"></i>\n          <span class="font-semibold text-green-700">${selectedRoomText} is <b>Available</b> (${selectedTimeText}, ${selectedDateText})</span>\n        `;
        resultActions.innerHTML = `\n          <button id="bookBtn" class="bg-green-600 text-white px-4 py-2 rounded font-semibold hover:bg-green-700 transition">\n            <i class="fas fa-calendar-plus mr-2"></i>Book Room\n          </button>\n        `;
      } else {
        resultStatus.className = "flex items-center p-4 rounded-lg mb-4 bg-red-50 border border-red-200";
        resultStatus.innerHTML = `\n          <i class="fas fa-times-circle text-red-600 text-2xl mr-3"></i>\n          <span class="font-semibold text-red-700">${selectedRoomText} is <b>NOT Available</b> (${selectedTimeText}, ${selectedDateText})</span>\n        `;
        resultActions.innerHTML = `\n          <p class="text-sm text-gray-700 mb-2">Try these alternative slots:</p>\n          <div class="flex flex-wrap gap-2">\n            <button class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded hover:bg-indigo-200">10–12 NN</button>\n            <button class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded hover:bg-indigo-200">1–3 PM</button>\n          </div>\n        `;
      }
    }

    function formatDate(dateStr) { if (!dateStr) return ''; const d = new Date(dateStr); return d.toLocaleDateString(undefined, { month: 'short', day: 'numeric', year: 'numeric' }); }
    function humanTimeLabel(timeSelectEl) { return timeSelectEl.value === 'custom' ? customTime.value : timeSelectEl.options[timeSelectEl.selectedIndex].text; }

    // toast helper
    function showToast(text, color = '#10B981') {
      const id = 'toast-' + Date.now();
      const el = document.createElement('div');
      el.id = id;
      el.className = 'toast';
      el.style.background = '#fff';
      el.innerHTML = `<div style=\"width:12px;height:12px;border-radius:6px;background:${color};\"></div><div class=\"text-sm font-medium\">${text}</div>`;
      document.getElementById('toastContainer').appendChild(el);
      setTimeout(() => { el.style.opacity = '0'; el.style.transform = 'translateY(8px)'; setTimeout(()=>el.remove(), 400); }, 1800);
    }

    // initialize UI from localStorage
    validateForm(); updateMapHighlights();
  </script>
</body>
</html>