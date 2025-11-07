<?php

include('../connections/connections.php');
include('../controllers/sectionassignmentcontroller.php');


$subjectassign = new studentlist();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $studentID = $_POST['student'] ?? $_GET['student'];
    if(isset($_POST['assignSubject'])){
            $assignmentID = $_POST['assignmentID'];
            $studentID = $_POST['studentID'];
            $subjectassign->assignsubject($assignmentID, $studentID);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if (isset($_GET['deletestudentsubject'])) { 

        $student_subject_id = $_GET['deletestudentsubject'];

        $subjectassign = new studentlist(); // call the class object
        $subjectassign->removesubject($student_subject_id); // run delete
    }
}
