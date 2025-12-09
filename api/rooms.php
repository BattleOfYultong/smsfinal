<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // optional

include "../connections/connections.php"; // adjust path to your DB connection

$response = [];
$sql = "SELECT * FROM room_tbl";
$result = mysqli_query($connections, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $rooms = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $rooms[] = $row;
        }

        echo json_encode([
            "status" => "success",
            "data" => $rooms
        ]);
        exit;
    } else {
        echo json_encode([
            "status" => "empty",
            "message" => "No data found"
        ]);
        exit;
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Query failed"
    ]);
    exit;
}
