  
  
  
<div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 space-y-3 md:space-y-0">
        <h3 class="text-lg font-semibold text-gray-800">Student List For Section <?php echo  $section['sectionName'] ?></h3>

        <!-- Search + Add Button + PDF Button -->
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

           

            <!-- Changed to Preview PDF Button -->
            <button
                id="previewPdfBtn"
                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all"
            >
                Preview PDF
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
                    
                </tr>
            </thead>
        <tbody id="studentTableBody" class="divide-y divide-gray-100">
<?php 
    $studentObj = new student();
    $students = $studentObj->studentlistinsection($sectionID);

    if (!empty($students)) {
        foreach ($students as $row) {
?>
<tr class="hover:bg-gray-50">
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['studentID']); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['primaryName']); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['gender']); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['course'] ?? '—'); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['yearLevel'] ?? '—'); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['adviserName'] ?? '—'); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= $section['roomName'] ?></td>

    
</tr>

<!-- ✅ EDIT MODAL MUST BE INSIDE FOREACH -->
<div id="editModal<?= $row['primarytableID']; ?>" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Student</h3>

        <form action="../routes/addstudentroute.php?section=<?= $_GET['section']; ?>" method="POST">
            <input type="hidden" name="primarytableID" value="<?= $row['primarytableID']; ?>">

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Student Name</label>
                <input type="text" name="studentName" value="<?= htmlspecialchars($row['primaryName']); ?>"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300">
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="Male" <?= ($row['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($row['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Course</label>
                <input type="text" name="course" value="<?= htmlspecialchars($row['course']); ?>"
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Year Level</label>
                <input type="text" name="yearLevel" value="<?= htmlspecialchars($row['yearLevel']); ?>"
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button"
                    onclick="document.getElementById('editModal<?= $row['primarytableID']; ?>').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg">
                    Cancel
                </button>
                <button name="modifyStudent" type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white hover:bg-indigo-700 rounded-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<?php
        }
    } else {
        echo '<tr><td colspan="8" class="px-4 py-6 text-center text-gray-500">No students found.</td></tr>';
    }
?>
</tbody>

        </table>
    </div>
</div>



<!-- New PDF Preview Modal -->
<div id="pdfPreviewModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
        justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            
            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-gray-600">
                <h3 class="text-lg font-semibold text-white">PDF Preview - Student List for Section <?php echo $section['sectionName']; ?></h3>
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


<!-- EDIT MODAL FOR THIS STUDENT -->
 




<script>
    document.querySelectorAll('.deleteBtnSectionStudent').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        Swal.fire({
            title: 'Delete this student?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/addstudentroute.php?deleteStudent=' + id;
            }
        });
    });
});

// PDF Preview Functionality
document.getElementById('previewPdfBtn').addEventListener('click', () => {
    // Clone the table to modify for preview
    const originalTable = document.querySelector('table');
    const tableClone = originalTable.cloneNode(true);
    
    // Remove the Action column (last column)
    const headers = tableClone.querySelectorAll('th');
    const rows = tableClone.querySelectorAll('tr');
    headers[headers.length - 1].remove(); // Remove Action header
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 0) {
            cells[cells.length - 1].remove(); // Remove Action cell
        }
    });
    
    // Create preview content
    const previewContainer = document.createElement('div');
    previewContainer.style.fontSize = '10px'; // Smaller font for more data
    previewContainer.style.width = '100%';
    previewContainer.innerHTML = `
        <h2 style="text-align: center; margin-bottom: 10px;">Student List for Section <?php echo $section['sectionName']; ?></h2>
        <div style="overflow-x: auto;">${tableClone.outerHTML}</div>
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
        filename: 'Student_List_Section_<?php echo $section['sectionName']; ?>.pdf',
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

</script>