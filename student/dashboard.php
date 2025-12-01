<?php
$id = include('components/global/auth.php'); // now $id is defined
include_once('../controllers/studentController.php');


$studentController = new StudentController();
$studentSubjects = $studentController->fetchSubjectsForStudent($id);

// 2. Get section + adviser info
$studentInfo = $studentController->getStudentSectionInfo($id);

// Summary values:
$totalSubjects = count($studentSubjects);
$sectionName = $studentInfo['sectionName'];
$adviserName = $studentInfo['adviserName'];
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


<section class="min-h-screen p-4 sm:p-6 lg:p-8 ">
    <?php include_once('components/global/greetings.php') ?>
    <div class="max-w-7xl mx-auto">

        <!-- Dashboard Header -->
        <div class="mb-8 bg-gradient-to-r from-blue-50 to-white rounded-xl shadow-lg p-6 sm:p-8 border border-blue-100">
            <h1 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">Dashboard</h1>
            <p class="text-gray-500">Overview of your subjects, section, and adviser.</p>
        </div>

        <!-- Summary Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Subjects -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-100 rounded-full -mr-10 -mt-10 opacity-50 group-hover:scale-150 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Subjects</p>
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <p class="text-4xl font-bold text-gray-800"><?= $totalSubjects ?></p>
                </div>
            </div>

            <!-- Section -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -mr-10 -mt-10 opacity-50 group-hover:scale-150 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Section</p>
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($sectionName) ?></p>
                </div>
            </div>

            <!-- Adviser -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-amber-100 rounded-full -mr-10 -mt-10 opacity-50 group-hover:scale-150 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Adviser</p>
                        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($adviserName) ?></p>
                </div>
            </div>
        </div>

        <!-- Subjects Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Your Subjects</h2>
            <p class="text-gray-600">View all your enrolled subjects and schedules</p>
        </div>

        
<!-- Add Preview PDF Button (place this near the cards, e.g., above or below) -->
<div class="mt-6 mb-5">
    <button
        id="previewPdfBtn"
        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">
        Print Schedules
    </button>
</div>

        <!-- Subjects Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach($studentSubjects as $subj): ?>
    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-2 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
        
        <div class="mb-4">
            <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors"><?= htmlspecialchars($subj['subjectName']) ?></h3>
        </div>

        <div class="space-y-3">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Room</p>
                    <p class="text-sm text-gray-800 font-medium"><?= htmlspecialchars($subj['roomName']) ?></p>
                </div>
            </div>

            <div class="flex items-start">
                <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Teacher</p>
                    <p class="text-sm text-gray-800 font-medium"><?= htmlspecialchars($subj['teacherName']) ?></p>
                </div>
            </div>

            <div class="flex items-start">
                <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Schedule</p>
                    <p class="text-sm text-gray-800 font-medium"><?= $subj['day'] ?></p>
                    <p class="text-sm text-gray-600"><?= date("g:i A", strtotime($subj['startTime'])) ?> - <?= date("g:i A", strtotime($subj['endTime'])) ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>


<!-- PDF Preview Modal -->
<div id="pdfPreviewModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
        justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            
            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-gray-600">
                <h3 class="text-lg font-semibold text-white">PDF Preview - Subjects for <?php echo htmlspecialchars($authUser['username']) ?></h3>
                <button type="button" id="closePreviewModal"
                    class="text-white hover:bg-gray-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>

            <!-- Body - Preview Content -->
            <div id="previewContent" class="p-6 overflow-y-auto max-h-96">
                <!-- Preview will be inserted here -->
            </div>

            <!-- Footer Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t border-gray-100 p-6">
                <button type="button" id="cancelPreview"
                    class="px-4 py-2 rounded-lg border border-gray-400 text-gray-700 font-medium hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button id="generatePdfFromPreview"
                    class="px-4 py-2 rounded-lg bg-red-700 text-white font-medium hover:bg-red-800 shadow-md transition">
                    Generate PDF
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// PDF Preview Functionality - Generate table from $studentSubjects
document.getElementById('previewPdfBtn').addEventListener('click', () => {
    // Create table HTML from PHP data
    const tableHTML = `
        <table style="width: 100%; border-collapse: collapse; font-size: 10px;">
            <thead>
                <tr style="background-color: #4f46e5; color: white;">
                    <th style="border: 1px solid #ccc; padding: 4px;">Subject</th>
                    <th style="border: 1px solid #ccc; padding: 4px;">Room</th>
                    <th style="border: 1px solid #ccc; padding: 4px;">Teacher</th>
                    <th style="border: 1px solid #ccc; padding: 4px;">Schedule</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($studentSubjects as $subj): ?>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 4px;"><?= htmlspecialchars($subj['subjectName']) ?></td>
                    <td style="border: 1px solid #ccc; padding: 4px;"><?= htmlspecialchars($subj['roomName']) ?></td>
                    <td style="border: 1px solid #ccc; padding: 4px;"><?= htmlspecialchars($subj['teacherName']) ?></td>
                    <td style="border: 1px solid #ccc; padding: 4px;">
                        <?= htmlspecialchars($subj['day']) ?> (<?= date("g:i A", strtotime($subj['startTime'])) ?> - <?= date("g:i A", strtotime($subj['endTime'])) ?>)
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    `;
    
    // Create preview content
    const previewContainer = document.createElement('div');
    previewContainer.style.fontSize = '10px'; // Smaller font for more data
    previewContainer.style.width = '100%';
    previewContainer.innerHTML = `
        <h2 style="text-align: center; margin-bottom: 10px;">Subjects for <?php echo htmlspecialchars($authUser['username']) ?></h2>
        <div style="overflow-x: auto;">${tableHTML}</div>
    `;
    
    // Insert into preview modal
    const previewContent = document.getElementById('previewContent');
    previewContent.innerHTML = '';
    previewContent.appendChild(previewContainer);
    
    // Show the modal
    document.getElementById('pdfPreviewModal').classList.remove('hidden');
});

// Close preview modal
document.getElementById('closePreviewModal').addEventListener('click', () => {
    document.getElementById('pdfPreviewModal').classList.add('hidden');
});

document.getElementById('cancelPreview').addEventListener('click', () => {
    document.getElementById('pdfPreviewModal').classList.add('hidden');
});

// Generate PDF from preview
document.getElementById('generatePdfFromPreview').addEventListener('click', () => {
    const previewContainer = document.querySelector('#previewContent > div');
    const opt = {
        margin: 0.5,
        filename: 'Subjects_for_<?php echo htmlspecialchars($authUser['username']) ?>.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 1.5 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    
    html2pdf().set(opt).from(previewContainer).save().then(() => {
        document.getElementById('pdfPreviewModal').classList.add('hidden'); // Close modal after generation
    });
});
</script>

<!-- Include html2pdf.js library (add this before the closing </body> tag in your HTML) -->


    </div>
</section>

        </main>
    </section>

    
   

    <script src="../javascript/sidebar.js">

    </script>
</body>
</html>