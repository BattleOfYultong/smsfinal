<?php
// auth 
include('components/global/auth.php');

// module and controllers

include_once('../controllers/sectionassignmentcontroller.php');


if (isset($_GET['student'])) {
    $studentID = $_GET['student'];

    $studentObj = new studentlist();
    $student = $studentObj->getstudent($studentID);

    if (!$student) {
        echo "Student not found.";
        exit;
    }
}

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
             <div class="flex-1 overflow-auto p-6 max-w-7xl mx-auto space-y-6">



    <!-- ========================================================= -->
    <!-- 🧩 Tables / Modules Grid -->
    <!-- ========================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
        <!-- Student List Module -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <?php include_once('components/sectionassignment/viewstudent.php') ?>
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
