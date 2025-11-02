<?php
include('../connections/connections.php');

if (!isset($_GET['roomName'])) {
    echo json_encode(['success' => false, 'message' => 'No room name provided.']);
    exit;
}

$roomName = mysqli_real_escape_string($connections, $_GET['roomName']);
$sql = "SELECT * FROM room_tbl WHERE roomName LIKE '%$roomName%'";
$result = mysqli_query($connections, $sql);

if (mysqli_num_rows($result) > 0) {
    $room = mysqli_fetch_assoc($result);
    echo json_encode([
        'success' => true,
        'roomName' => $room['roomName'],
        'status' => $room['roomStatus']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'No matching room found.']);
}
?>
