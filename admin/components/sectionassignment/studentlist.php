<!-- STUDENT LIST -->
<div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Student List</h3>

        <div class="flex flex-col md:flex-row gap-3">
            <input id="searchInput" type="text" placeholder="Search student or course..."
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="studentTable" class="w-full text-sm text-left border border-gray-200">
            <thead class="text-xs uppercase bg-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-3">Student ID</th>
                    <th class="px-4 py-3">Student Name</th>
                    <th class="px-4 py-3">Year Level</th>
                    <th class="px-4 py-3">Course</th>
                    <th class="px-4 py-3">Section</th>
                    <th class="px-4 py-3">Adviser</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                <?php 
                $studentlist = new studentlist();
                $studentlist = $studentlist->studentlist();
                ?> 
                
                <?php foreach($studentlist as $student): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2"><?php echo htmlspecialchars($student['studentID']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($student['primaryName']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($student['yearLevel']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlentities($student['course']) ?> </td>
                      <td class="px-4 py-2"><?php echo htmlentities($student['sectionName']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlentities($student['adviserName']) ?></td>
                    <td class="px-4 py-2 text-center">
                        <a href="viewstudent.php?student=<?php echo htmlspecialchars($student['studentID']) ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            View Student
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>