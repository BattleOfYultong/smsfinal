<?php
// auth 
include('components/global/auth.php');

// module and controllers

include_once('../controllers/sectionassignmentcontroller.php');

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
<body class="bg-white font-sans">
    <section class="flex h-screen overflow-hidden">
      <?php include_once('components/global/sidebar.php') ?>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white content-transition lg:ml-72" id="main-content">
            <section class="min-h-screen p-4 sm:p-6 lg:p-8 transition-all duration-300">
                <!--  -->
 <!-- Main Content Wrapper -->
<div class="flex-1 overflow-auto p-6 max-w-7xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-white border-b px-6 py-4 flex items-center justify-between">
        <h1 class="text-xl font-bold text-gray-800">Dashboard Overview</h1>
    </div>

    <!-- Main Section -->
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Substitute Assignment Tracker</h2>
                <p class="text-xs text-gray-500 mt-1">Dashboard > Scheduling > Substitute Assignments</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <!-- Add Request -->
                <button data-modal-target="addRequestModal" data-modal-toggle="addRequestModal"
                    class="bg-emerald-600 text-white px-6 py-2 rounded font-semibold hover:bg-emerald-700">
                    Add Request
                </button>

                <!-- Assign Substitute -->
                <button data-modal-target="assignModal" data-modal-toggle="assignModal"
                    class="bg-indigo-600 text-white px-6 py-2 rounded font-semibold hover:bg-indigo-700">
                    Assign Substitute
                </button>
            </div>
        </div>

        <!-- Absence Requests Table -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Absence Requests / Vacancies</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Time</th>
                            <th class="px-4 py-2">Subject</th>
                            <th class="px-4 py-2">Original Teacher</th>
                            <th class="px-4 py-2">Section</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-2">Aug 20, 2025</td>
                            <td class="px-4 py-2">9:00–10:30 AM</td>
                            <td class="px-4 py-2">Math 101</td>
                            <td class="px-4 py-2">Mr. Cruz</td>
                            <td class="px-4 py-2">Grade 10 – A</td>
                            <td class="px-4 py-2"><span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-xs">Pending</span></td>
                            <td class="px-4 py-2"><button data-modal-toggle="assignModal" class="bg-green-500 text-white px-2 py-1 rounded text-xs">Assign</button></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2">Aug 20, 2025</td>
                            <td class="px-4 py-2">1:00–2:30 PM</td>
                            <td class="px-4 py-2">English 2</td>
                            <td class="px-4 py-2">Ms. Reyes</td>
                            <td class="px-4 py-2">Grade 11 – B</td>
                            <td class="px-4 py-2"><span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">Assigned</span></td>
                            <td class="px-4 py-2"><button class="bg-blue-500 text-white px-2 py-1 rounded text-xs">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Assignment Logs -->
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Assignment Logs</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Time</th>
                            <th class="px-4 py-2">Subject</th>
                            <th class="px-4 py-2">Section</th>
                            <th class="px-4 py-2">Substitute</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2">Aug 18, 2025</td>
                            <td class="px-4 py-2">1:00–2:30 PM</td>
                            <td class="px-4 py-2">Science 1</td>
                            <td class="px-4 py-2">Grade 9 – C</td>
                            <td class="px-4 py-2">Mr. Santos</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- modal -->
<div id="addRequestModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Add Absence Request</h3>

        <form>
            <label class="block mb-2 text-sm">Teacher</label>
            <input type="text" class="w-full border rounded px-3 py-2 mb-3">

            <label class="block mb-2 text-sm">Subject</label>
            <input type="text" class="w-full border rounded px-3 py-2 mb-3">

            <label class="block mb-2 text-sm">Date</label>
            <input type="date" class="w-full border rounded px-3 py-2 mb-3">

            <label class="block mb-2 text-sm">Reason</label>
            <textarea class="w-full border rounded px-3 py-2 mb-4"></textarea>

            <div class="flex justify-end gap-2">
                <button data-modal-hide="addRequestModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button class="px-4 py-2 bg-emerald-600 text-white rounded">Submit</button>
            </div>
        </form>
    </div>
</div>



<div id="assignModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">

        <h3 class="text-lg font-semibold mb-4 text-gray-800">Assign Substitute Teacher</h3>

        <label class="block mb-2 text-sm">Select Substitute</label>
        <select class="w-full border rounded px-3 py-2 mb-4">
            <option>Mr. Santos (Math)</option>
            <option>Ms. Dela Cruz (English)</option>
        </select>

        <div class="flex justify-end gap-2 mt-4">
            <button data-modal-hide="assignModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Assign</button>
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
