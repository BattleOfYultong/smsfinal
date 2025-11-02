<?php 
include_once('../connections/connections.php');
include_once('../controllers/sectionassignmentcontroller.php');



$assignment = new professorAssign();

// Handle POST requests (Add / Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['addAssignment'])) {
        $teacherID = $_POST['teacherID'];
        $subjectID = $_POST['subjectID'];
        $sectionID = $_POST['sectionID'];
        $roomID = $_POST['roomID'];
        $day = $_POST['day'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $notes = $_POST['notes'];

        $assignment->createAssignment($teacherID, $subjectID, $sectionID, $roomID, $day, $startTime, $endTime, $notes);
    }

    // ✏️ Update existing assignment
    if (isset($_POST['updateAssignment'])) {
        $assignmentID = $_POST['assignmentID'];
        $teacherID = $_POST['teacherID'];
        $subjectID = $_POST['subjectID'];
        $sectionID = $_POST['sectionID'];
        $roomID = $_POST['roomID'];
        $day = $_POST['day'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $notes = $_POST['notes'];

        $assignment->updateAssignment($assignmentID, $teacherID, $subjectID, $sectionID, $roomID, $day, $startTime, $endTime, $notes);
    }
}

// Handle GET requests (Delete)
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['deleteAssignment'])) {
        $assignmentID = $_GET['deleteAssignment'];
        $assignment->deleteAssignment($assignmentID);
    }
}


