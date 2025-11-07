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
<title>Teacher Mapping</title>
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

<!-- modals alert -->




<!--  -->
 <!-- Main Content Wrapper -->
<div class="flex-1 overflow-auto p-6 max-w-7xl mx-auto space-y-6">

    <!-- ========================================================= -->
    <!-- 📊 Metric Cards Grid -->
    <!-- ========================================================= -->
 
    <!-- ========================================================= -->
    <!-- 🧩 Tables / Modules Grid -->
    <!-- ========================================================= -->

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
        <!-- Student List Module -->
     

        

        <!-- Section Assignment List Module -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <?php include_once('components/sectionassignment/sectionassign.php') ?>
        </div>

  
        <div class="bg-white rounded-xl shadow-md p-4">
            <?php include_once('components/sectionassignment/addsubject.php') ?>
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
