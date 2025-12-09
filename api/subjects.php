<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // optional CORS

include "../connections/connections.php"; // adjust path

$sql = "SELECT * FROM subject_tbl";
$result = mysqli_query($connections, $sql);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => "Query failed"
    ]);
    exit;
}

if (mysqli_num_rows($result) === 0) {
    echo json_encode([
        "status" => "empty",
        "message" => "No data found"
    ]);
    exit;
}

$subjects = [];
while ($row = mysqli_fetch_assoc($result)) {
    $subjects[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $subjects
]);

exit;
