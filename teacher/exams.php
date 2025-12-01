<?php
$id = include('components/global/auth.php'); // now $id is defined

include_once('../controllers/timetablecontroller.php');




?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Dashboard</title>
    <?php include_once('components/global/header.php') ?>
    
 
</head>
<body class="bg-white font-sans">
    <section class="flex h-screen overflow-hidden">
      <?php include_once('components/global/sidebar.php') ?>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white content-transition lg:ml-72" id="main-content">
            <section class="min-h-screen p-4 sm:p-6 lg:p-8 transition-all duration-300">
               <div class="flex-1 overflow-auto p-6 max-w-7xl mx-auto space-y-6">           

                <div class="mb-8 bg-gradient-to-r from-blue-50 to-white rounded-xl shadow-lg p-6 sm:p-8 border border-blue-100">
                        <h1 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">View Exams</h1>
                 </div>




            <?php 
            $examTimetable = new ExamTimetable();
            $dashboardData = $examTimetable->fetchtimetableCounts();
            ?>

               
               <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Exams Card -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Exams</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $dashboardData['totalExams'] ?></p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-file-alt text-blue-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                <i class="fas fa-arrow-up mr-1"></i> 
            </span>
        </div>
    </div>

    <!-- Upcoming Exams Card -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Upcoming Exams</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $dashboardData['upcomingExams'] ?></p>
            </div>
            <div class="p-3 bg-purple-100 rounded-full">
                <i class="fas fa-calendar-alt text-purple-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                <i class="fas fa-arrow-up mr-1"></i> 
            </span>
        </div>
    </div>

    <!-- Exam Rooms Card -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Available Rooms</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $dashboardData['availableRooms'] ?> </p>
            </div>
            <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-door-open text-green-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                <i class="fas fa-arrow-up mr-1"></i> 
            </span>
        </div>
    </div>

    <!-- Assigned Proctors Card -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Assigned Proctors</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $dashboardData['assignedProctors'] ?></p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-user-tie text-yellow-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                <i class="fas fa-arrow-up mr-1"></i> 
            </span>
        </div>
    </div>
                </div>


  <!-- ========================================================= -->
  <!-- 🧩 Exam Timetable Table -->
  <!-- ========================================================= -->
  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b">
      <h2 class="text-xl font-semibold text-gray-800">Exams</h2>
      
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full border-collapse">
        <thead class="bg-blue-600 text-white uppercase text-sm">
          <tr>
            <th class="px-6 py-3 text-left">Date</th>
            <th class="px-6 py-3 text-left">Subject</th>
            <th class="px-6 py-3 text-left">Section</th>
            <th class="px-6 py-3 text-left">Room</th>
            <th class="px-6 py-3 text-left">Time</th>
            <th class="px-6 py-3 text-left">Invigilator</th>
           
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-gray-800">
          <!-- Example Row -->
           <?php
      $exam = new ExamTimetable();
      $examSchedules = $exam->fetch(); // fetch() should return mysqli_result
                  ?>
                    
                    <?php foreach ($examSchedules as $schedule): ?>
                      <tr>
                     <td class="px-6 py-3">
<?php 
    if (!empty($schedule['examDate'])) {
        // Display day name and full date
        echo date('l, F j, Y', strtotime($schedule['examDate'])); 
        // Example output: Monday, November 10, 2025
    } else {
        echo '-';
    }
?>
</td>
            <td class="px-6 py-3"><?php echo htmlspecialchars($schedule['subjectName']) ?></td>
            <td class="px-6 py-3"><?php echo htmlspecialchars($schedule['sectionName']) ?></td>
            <td class="px-6 py-3"><?php echo htmlspecialchars($schedule['roomName']) ?></td>
            <td class="px-6 py-3">
    <?php 
        if (!empty($schedule['startTime']) && !empty($schedule['endTime'])) {
            echo date("g:i A", strtotime($schedule['startTime'])) . " - " . date("g:i A", strtotime($schedule['endTime']));
        } else {
            echo '-';
        }
    ?>
</td>
            <td class="px-6 py-3"><?php echo htmlspecialchars($schedule['invigilator']) ?></td>
           
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>


  <!-- ========================================================= -->
  <!-- 🧩 Flowbite Modal: Create Exam -->
  <!-- ========================================================= -->

<?php include_once('components/examtimetable/calendar.php') ?>







</div>

            </section>
        </main>
    </section>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="../javascript/sidebar.js">

    </script>
</body>
</html>