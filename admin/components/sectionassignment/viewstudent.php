<!-- STUDENT LIST -->


<div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Subjects for <?php echo htmlspecialchars($student['username'])  ?> </h3>

        <div class="flex flex-col md:flex-row gap-3">
            <input id="searchInput" type="text" placeholder="Search student or course..."
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">

    <button data-modal-target="addSubjectModal" data-modal-toggle="addSubjectModal"
    class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
    + Add Subject
</button>
        </div>
    </div>

    

   <div class="overflow-x-auto">
    <table id="studentTable" class="w-full text-sm text-left border border-gray-200">
        <thead class="text-xs uppercase bg-indigo-600 text-white">
            <tr>
             <thead class="text-xs uppercase bg-indigo-600 text-white">
    <tr>
        <th class="px-4 py-3">Subject</th>
        <th class="px-4 py-3">Teacher</th>
        <th class="px-4 py-3">Section</th>
        <th class="px-4 py-3">Room</th>
        <th class="px-4 py-3">Schedule</th>
        <th class="px-4 py-3">Notes</th>
        <th class="px-4 py-3 text-center">Actions</th>
    </tr>
</thead>
            </tr>
        </thead>

    <tbody class="divide-y divide-gray-100">
<?php
$subjects = $studentObj->fetchsubjectforstudent($studentID);

if ($subjects && mysqli_num_rows($subjects) > 0) {
    while($row = mysqli_fetch_assoc($subjects)){ ?>
        <tr class="hover:bg-gray-50">
            <td class="px-4 py-2"><?= htmlspecialchars($row['subjectName']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['teacherName']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['sectionName']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['roomName']) ?></td>
            <td class="px-4 py-2">
                <?= htmlspecialchars($row['day']) ?> 
                (<?= htmlspecialchars($row['startTime']) ?> - <?= htmlspecialchars($row['endTime']) ?>)
            </td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['notes']) ?></td>

            <td class="px-4 py-2 text-center flex justify-center gap-3">
    <button data-modal-target="viewSubjectModal<?= $row['student_subject_id'] ?>" data-modal-toggle="viewSubjectModal<?= $row['student_subject_id'] ?>"
        class="text-indigo-600 hover:text-indigo-800 font-medium">
        View
    </button>

    <button  type="button"
    data-id ="<?= $row['student_subject_id'] ?>"
        class="text-red-600 hover:text-red-800 font-medium deleteBtnsubjectassign">
        Remove
    </button>
</td>

        </tr>
<?php } 
} else { ?>
    <tr>
        <td colspan="7" class="text-center py-4 text-gray-500">
            No subjects assigned yet.
        </td>
    </tr>
<?php } ?>
</tbody>
    </table>
</div>

</div>

<?php 
mysqli_data_seek($subjects, 0); // Reset pointer so we can loop again for modals
while($row = mysqli_fetch_assoc($subjects)) { 
    $start = date("g:i A", strtotime($row['startTime']));
    $end   = date("g:i A", strtotime($row['endTime']));
?>
<div id="viewSubjectModal<?= $row['student_subject_id'] ?>" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
        <h3 class="text-lg font-semibold mb-3"><?= htmlspecialchars($row['subjectName']) ?></h3>

        <p><strong>Teacher:</strong> <?= htmlspecialchars($row['teacherName']) ?></p>
        <p><strong>Section:</strong> <?= htmlspecialchars($row['sectionName']) ?></p>
        <p><strong>Room:</strong> <?= htmlspecialchars($row['roomName']) ?></p>
        <p><strong>Schedule:</strong> <?= htmlspecialchars($row['day']) ?> (<?= $start ?> - <?= $end ?>)</p>
        <p><strong>Notes:</strong> <?= nl2br(htmlspecialchars($row['notes'])) ?></p>

        <div class="mt-5 flex justify-end">
            <button data-modal-hide="viewSubjectModal<?= $row['student_subject_id'] ?>"
                class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                Close
            </button>
        </div>
    </div>
</div>
<?php } ?>

<!-- Add Subject Modal -->
<div id="addSubjectModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-screen bg-black/40 backdrop-blur-sm">
    <div class="relative w-full max-w-lg mx-auto">

        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow p-6">

            <!-- Modal header -->
            <div class="flex items-start justify-between">
                <h3 class="text-lg font-semibold">Assign Subject</h3>
                <button type="button" data-modal-hide="addSubjectModal"
                    class="text-gray-400 hover:text-gray-600 text-xl">
                    &times;
                </button>
            </div>

            <!-- Modal body -->
            <form action="../routes/subjectassign.php?student=<?php echo htmlspecialchars( $studentID) ?>" method="POST" class="mt-4">
                <input type="hidden" name="studentID" value="<?= $studentID ?>">

                <label class="block text-sm font-medium mb-1">Select Subject</label>
               <select name="assignmentID" required
    class="w-full border border-gray-300 rounded-lg px-3 py-2 mb-4 focus:ring-indigo-500 focus:border-indigo-500">

    <option value="" disabled selected>-- Choose Subject --</option>

    <?php 
    $subjectlistObj = new studentlist();
    $assignments = $subjectlistObj->getAllAssignments();

    if (!empty($assignments)) {
        foreach ($assignments as $row) { 

            // Format time in friendly format (e.g., 08:00 AM)
            $start = date("g:i A", strtotime($row['startTime']));
            $end   = date("g:i A", strtotime($row['endTime']));
    ?>
        <option value="<?= $row['assignmentID'] ?>">
            <?= htmlspecialchars($row['subjectName']) ?> —
            <?= htmlspecialchars($row['username']) ?>
            (<?= htmlspecialchars($row['sectionName']) ?> • <?= htmlspecialchars($row['roomName']) ?>)
            — <?= htmlspecialchars($row['day']) ?> (<?= $start ?> - <?= $end ?>)
        </option>
    <?php 
        }
    } else { 
    ?>
        <option value="" disabled>No assignments available</option>
    <?php 
    } 
    ?>
</select>


                <!-- Modal footer -->
                <div class="flex justify-end gap-3 mt-3">
                    <button type="button" data-modal-hide="addSubjectModal"
                        class="px-4 py-2 border rounded-lg text-sm">
                        Cancel
                    </button>

                    <button name="assignSubject" type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                        Assign
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>


<script>
document.querySelectorAll('.deleteBtnsubjectassign').forEach(btn => {
    btn.addEventListener('click', () => {
        const student_subject_id = btn.dataset.id;
        Swal.fire({
            title: 'Remove this Subject?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/subjectassign.php?deletestudentsubject=' + student_subject_id;
            }
        });
    });
});
    </script>