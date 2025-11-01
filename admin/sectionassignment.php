<?php
// auth 
include('components/global/auth.php')

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Section Assignment Tool</title>
  <?php include_once('components/global/header.php') ?>
<style>
  :root {
    --primary: #4f46e5;
    --secondary: #10b981;
  }
  .sidebar { transition: all 0.3s; }
  tr.selected { background-color: #dbeafe; }
  @media print {
    body * { visibility: hidden; }
    #certificateContent, #certificateContent * { visibility: visible; }
    #certificateContent { position: absolute; top: 0; left: 0; width: 100%; }
  }
  .certificate {
    width: 100%;
    max-width: 800px;
    margin: 20px auto;
    padding: 40px;
    border: 5px solid var(--primary);
    text-align: center;
    position: relative;
    background: #fff;
  }
  .certificate table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  .certificate table, .certificate th, .certificate td {
    border: 1px solid #333;
  }
  .certificate th, .certificate td {
    padding: 6px;
    text-align: center;
    font-size: 0.9rem;
  }
</style>
</head>
<body class="bg-gray-100 font-sans">
<div class="flex h-screen overflow-hidden">

  <!-- Sidebar -->
  <?php 
    include_once('components/global/sidebar.php')
  ?>

  <!-- Main Content -->
 <!-- Main Content Wrapper -->
<div class="flex-1 overflow-auto p-6 max-w-7xl mx-auto space-y-10">
  <!-- ========================================================= -->
  <!-- 🧑‍🎓 Student List Module -->
  <!-- ========================================================= -->
  <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 space-y-3 md:space-y-0">
      <h3 class="text-lg font-semibold text-gray-800">Student List</h3>

      <!-- Search + Add Button -->
      <div class="flex items-center gap-2 relative w-full md:w-auto">
        <div class="relative w-full md:w-64">
          <input
            id="courseInput"
            type="text"
            placeholder="Type course or 'ALL' to view all"
            class="block w-full text-sm rounded-lg border border-gray-300 p-2.5 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
            autocomplete="off"
          />
          <ul
            id="autocompleteList"
            class="absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg mt-1 max-h-40 overflow-y-auto hidden z-50"
          ></ul>
        </div>

        <button
          data-modal-target="studentModal"
          data-modal-toggle="studentModal"
          class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all"
        >
          Add Student
        </button>
      </div>
    </div>

    <!-- Student Table -->
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left border border-gray-200">
        <thead class="text-xs uppercase bg-indigo-600 text-white">
          <tr>
            <th scope="col" class="px-4 py-3">ID</th>
            <th scope="col" class="px-4 py-3">Name</th>
            <th scope="col" class="px-4 py-3">Gender</th>
            <th scope="col" class="px-4 py-3">Program</th>
            <th scope="col" class="px-4 py-3">Year & Course</th>
            <th scope="col" class="px-4 py-3">Adviser</th>
            <th scope="col" class="px-4 py-3">Room</th>
            <th scope="col" class="px-4 py-3 text-center">Action</th>
          </tr>
        </thead>
        <tbody id="studentTableBody" class="divide-y divide-gray-100">
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-2">2025-001</td>
            <td class="px-4 py-2">Juan Dela Cruz</td>
            <td class="px-4 py-2">Male</td>
            <td class="px-4 py-2">BSIT</td>
            <td class="px-4 py-2">4th Year</td>
            <td class="px-4 py-2">Mr. Santos</td>
            <td class="px-4 py-2">Lab 203</td>
            <td class="px-4 py-2 text-center space-x-2">
              <button
                data-modal-target="assignSectionModal"
                data-modal-toggle="assignSectionModal"
                class="text-blue-600 hover:text-blue-800 font-medium"
              >
                Assign Section
              </button>
              <button class="text-red-600 hover:text-red-800 font-medium">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div id="studentModal" tabindex="-1" aria-hidden="true"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
         justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-2xl max-h-full">
    <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">
      
      <!-- Header -->
      <div class="flex justify-between items-center p-5 bg-blue-600">
        <h3 class="text-lg font-semibold text-white">Add New Student</h3>
        <button type="button" data-modal-hide="studentModal"
          class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
          ✕
        </button>
      </div>

      <!-- Body -->
      <form class="p-6 space-y-6 text-blue-900">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block mb-2 font-semibold">Student ID</label>
            <input type="text" placeholder="e.g. 2025-001" 
              class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block mb-2 font-semibold">Full Name</label>
            <input type="text" placeholder="e.g. Juan Dela Cruz" 
              class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block mb-2 font-semibold">Gender</label>
            <select class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="">Select Gender</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
          <div>
            <label class="block mb-2 font-semibold">Program</label>
            <input type="text" placeholder="e.g. BSIT" 
              class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block mb-2 font-semibold">Year & Course</label>
            <input type="text" placeholder="e.g. 4th Year" 
              class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block mb-2 font-semibold">Adviser</label>
            <input type="text" placeholder="e.g. Mr. Santos" 
              class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        <div>
          <label class="block mb-2 font-semibold">Room</label>
          <input type="text" placeholder="e.g. Lab 203" 
            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Footer Buttons -->
        <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
          <button type="button" data-modal-hide="studentModal"
            class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
            Cancel
          </button>
          <button type="submit"
            class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
            Save Student
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
  <!-- ========================================================= -->
  <!-- 🧩 Section Assignment List Module -->
  <!-- ========================================================= -->
  <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-800">Section Assignments</h3>
      <button
        data-modal-target="assignSectionModal"
        data-modal-toggle="assignSectionModal"
        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all"
      >
        + New Assignment
      </button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left border border-gray-200">
        <thead class="text-xs uppercase bg-blue-600 text-white">
          <tr>
            <th class="px-4 py-3">Instructor</th>
            <th class="px-4 py-3">Subject</th>
            <th class="px-4 py-3">Section</th>
            <th class="px-4 py-3">Room</th>
            <th class="px-4 py-3">Schedule</th>
            <th class="px-4 py-3">Notes</th>
            <th class="px-4 py-3 text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-2">Prof. Dela Cruz</td>
            <td class="px-4 py-2">Web Development</td>
            <td class="px-4 py-2">BSIT-401</td>
            <td class="px-4 py-2">Lab 201</td>
            <td class="px-4 py-2">MWF 9:00–10:30AM</td>
            <td class="px-4 py-2">Capstone project supervision</td>
            <td class="px-4 py-2 text-center">
              <button class="text-blue-600 hover:text-blue-800 font-medium">Edit</button>
              <button class="text-red-600 hover:text-red-800 font-medium">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- ========================================================= -->
<!-- 🧾 Flowbite Assign Section Modal -->
<!-- ========================================================= -->
<div id="assignSectionModal" tabindex="-1" aria-hidden="true"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
         justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-3xl max-h-full">
    <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">
      <!-- Header -->
      <div class="flex justify-between items-center p-5 bg-blue-600">
        <h3 class="text-lg font-semibold text-white">Assign Section</h3>
        <button type="button" data-modal-hide="assignSectionModal"
          class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
          ✕
        </button>
      </div>

      <!-- Modal Body -->
      <form class="p-6 space-y-6 text-blue-900">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block mb-2 font-semibold">Instructor Name</label>
            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block mb-2 font-semibold">Subject</label>
            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label class="block mb-2 font-semibold">Section</label>
            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block mb-2 font-semibold">Room</label>
            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div>
            <label class="block mb-2 font-semibold">Schedule</label>
            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        <div>
          <label class="block mb-2 font-semibold">Additional Notes</label>
          <textarea rows="3" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
          <button type="button" data-modal-hide="assignSectionModal"
            class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
            Cancel
          </button>
          <button type="submit"
            class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
            Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>



<script>
const courseInput = document.getElementById('courseInput');
const autocompleteList = document.getElementById('autocompleteList');
const tableBody = document.getElementById('studentTableBody');
const courses = ["BSIT", "BSCRIM", "BSTOURISM", "BSED", "BSBA", "ALL"];
let students = JSON.parse(localStorage.getItem('students') || '[]');
students.forEach(addStudentToTable);

// Modals
const openModalBtn = document.getElementById('openModalBtn');
const modal = document.getElementById('studentModal');
const cancelBtn = document.getElementById('cancelBtn');
const studentForm = document.getElementById('studentForm');



// Certificate Modal Logic
const certModal = document.getElementById('certificateModal');
const closeCert = document.getElementById('closeCertificate');
const certName = document.getElementById('certName');
const certSection = document.getElementById('certSection');
const certRoom = document.getElementById('certRoom');
const certAdviser = document.getElementById('certAdviser');
const certSchedule = document.getElementById('certSchedule');
const printCertModalBtn = document.getElementById('printCertificateModal');

function openCertificateModal(student) {
  certName.textContent = student.name;
  certSection.textContent = "Section: " + student.yearCourse;
  certRoom.textContent = "Room: " + student.room;
  certAdviser.textContent = "Adviser: " + student.adviser;

  const scheduleData = student.schedule || [
    { day: 'Mon', time: '08:00-09:00', subject: 'Math' },
    { day: 'Tue', time: '09:00-10:00', subject: 'English' },
    { day: 'Wed', time: '10:00-11:00', subject: 'Science' }
  ];

  certSchedule.innerHTML = '';
  scheduleData.forEach(s => {
    const tr = document.createElement('tr');
    tr.innerHTML = `<td class="border border-gray-700 px-3 py-1">${s.day}</td>
                    <td class="border border-gray-700 px-3 py-1">${s.time}</td>
                    <td class="border border-gray-700 px-3 py-1">${s.subject}</td>`;
    certSchedule.appendChild(tr);
  });

  certModal.classList.remove('hidden');
}

printCertModalBtn.addEventListener('click', () => {
  window.print();
});

closeCert.addEventListener('click', () => certModal.classList.add('hidden'));
</script>
</body>
</html>
