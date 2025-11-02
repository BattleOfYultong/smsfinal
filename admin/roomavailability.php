<?php
// auth 
include('components/global/auth.php');
include('../controllers/roomcontroller.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Room Availability Checker</title>
  <?php include('components/global/header.php') ?>

 
</head>

<body class="bg-gray-100 font-sans">

  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <?php 
    include_once('components/global/sidebar.php')
  ?>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto p-5">
        <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6 mt-5 ">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 space-y-3 md:space-y-0">
        <h3 class="text-lg font-semibold text-gray-800">Room List</h3>

        <!-- Search + Add Button -->
        <div class="flex items-center gap-2 w-full md:w-auto">
            <div class="relative w-full md:w-64">
                <input
                    id="roomInput"
                    type="text"
                    placeholder="Type room name or 'ALL' to view all"
                    class="block w-full text-sm rounded-lg border border-gray-300 p-2.5 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    autocomplete="off"
                />
                <ul
                    id="autocompleteList"
                    class="absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg mt-1 max-h-40 overflow-y-auto hidden z-50"
                ></ul>
            </div>

            <button
                data-modal-target="roomModal"
                data-modal-toggle="roomModal"
                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all"
            >
                Add Room
            </button>
        </div>
    </div>

    <!-- Room Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border border-gray-200">
            <thead class="text-xs uppercase bg-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-3">Room ID</th>
                    <th class="px-4 py-3">Room Name</th>
                    <th class="px-4 py-3">Capacity</th>
                    <th class="px-4 py-3">Location</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody id="roomTableBody" class="divide-y divide-gray-100">
                <!-- Example dynamic rows (replace with server-side loop) -->
                 <?php 
                  $roomlist = new Roomcontroller();
                  $roomlist = $roomlist->fetchRoom();
                 
                 ?>

                 <?php foreach($roomlist as $rooms): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2"><?php echo htmlspecialchars($rooms['roomID']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($rooms['roomName']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($rooms['capacity']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($rooms['location']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($rooms['roomStatus']) ?></td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <button
                            data-modal-target="editroomModal<?php echo htmlspecialchars($rooms['roomID']) ?>"
                            data-modal-toggle="editroomModal<?php echo htmlspecialchars($rooms['roomID']) ?>"
                            class="text-blue-600 hover:text-blue-800 font-medium"
                        >
                            Edit
                        </button>
                        <button data-id ='<?php echo htmlspecialchars($rooms['roomID']) ?>' class="text-red-600 hover:text-red-800 font-medium deleteBtnRoom">
                            Delete
                        </button>
                    </td>
                </tr>
                <?php endforeach ?>
               
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Form -->
 <!-- create -->
<div id="roomModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">
            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-blue-600">
                <h3 class="text-lg font-semibold text-white">Add Room</h3>
                <button type="button" data-modal-hide="studentModal"
                    class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <form action="../routes/roomroutes.php" method="POST" class="p-6 space-y-6 text-blue-900" id="roomForm">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                   
                    <div>
                        <label class="block mb-2 font-semibold">Room Name</label>
                        <input type="text" name="roomName" placeholder="e.g. Lab 203"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Capacity</label>
                        <input type="number" name="capacity" placeholder="e.g. 30"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Location</label>
                        <input type="text" name="location" placeholder="e.g. 2nd Floor"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

               

                <!-- Footer Buttons -->
                <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
                    <button type="button" data-modal-hide="studentModal"
                        class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
                        Cancel
                    </button>
                    <button name="addRoom" type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
                        Save Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit -->
  <?php foreach($roomlist as $rooms): ?>
 <div id="editroomModal<?php echo htmlspecialchars($rooms['roomID']) ?>" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">
            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-blue-600">
                <h3 class="text-lg font-semibold text-white">Add Room</h3>
                <button type="button" data-modal-hide="editroomModal<?php echo htmlspecialchars($rooms['roomID']) ?>"
                    class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <form action="../routes/roomroutes.php" method="POST" class="p-6 space-y-6 text-blue-900" id="roomForm">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div hidden>
                        <label class="block mb-2 font-semibold">Room ID</label>
                        <input value="<?php echo htmlspecialchars($rooms['roomID']) ?>" type="text" name="roomID" placeholder="e.g. Lab 203"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                   
                    <div>
                        <label class="block mb-2 font-semibold">Room Name</label>
                        <input value="<?php echo htmlspecialchars($rooms['roomName']) ?>" type="text" name="roomName" placeholder="e.g. Lab 203"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Capacity</label>
                        <input value="<?php echo htmlspecialchars($rooms['capacity']) ?>" type="number" name="capacity" placeholder="e.g. 30"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Location</label>
                        <input value="<?php echo htmlspecialchars($rooms['location']) ?>" type="text" name="location" placeholder="e.g. 2nd Floor"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                  <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div>
                      <label class="block mb-2 font-semibold">Room Status</label>
                      <select name="roomStatus"
                          class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                          <option value="">Select Status</option>
                          <option value="Available" <?php if ($rooms['roomStatus'] == 'Available') echo 'selected'; ?>>Available</option>
                          <option value="Occupied" <?php if ($rooms['roomStatus'] == 'Occupied') echo 'selected'; ?>>Occupied</option>
                          <option value="Maintenance" <?php if ($rooms['roomStatus'] == 'Maintenance') echo 'selected'; ?>>Maintenance</option>
                      </select>
                  </div>

                  </div>

               

                <!-- Footer Buttons -->
                <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
                    <button type="button" data-modal-hide="editroomModal<?php echo htmlspecialchars($rooms['roomID']) ?>"
                        class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
                        Cancel
                    </button>
                    <button name="updateRoom" type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
                        Save Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach ?>



    </div>


  <!-- toast container -->
<script>
        document.querySelectorAll('.deleteBtnRoom').forEach(btn => {
    btn.addEventListener('click', () => {
        const roomID = btn.dataset.id;
        Swal.fire({
            title: 'Delete this section?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/roomroutes.php?deleteRoom=' + roomID;
            }
        });
    });
});
    </script>
 
</body>
</html>