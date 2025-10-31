<?php

session_start();
include_once('../connections/connections.php');
include_once('../controllers/usercontroller.php');
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $auth = new usercontroller();
    $authUser = $auth->Auth($id);  

}
else{
    echo "no session found";
}
