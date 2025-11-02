<?php
include_once('../connections/connections.php');
include_once('../controllers/roomcontroller.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['addRoom'])){
        $roomName = $_POST['roomName'];
        $capacity = $_POST['capacity'];
        $location = $_POST ['location'];

        $addroom = new Roomcontroller();
        $addroom->createRoom($roomName, $capacity, $location );
    }

      if(isset($_POST['updateRoom'])){
        $roomID = $_POST['roomID'];
        $roomName = $_POST['roomName'];
        $capacity = $_POST['capacity'];
        $location = $_POST ['location'];
        $roomStatus = $_POST['roomStatus'];

        $addroom = new Roomcontroller();
        $addroom->modifyRoom($roomID, $roomName, $capacity, $location, $roomStatus);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
     if (isset($_GET['deleteRoom'])) 
    { 
        $roomID = $_GET['deleteRoom'];
        $section =new Roomcontroller();
        $section->deleteRoom($roomID); 
    }
}
