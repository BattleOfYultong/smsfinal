<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "../connections/connections.php";




$sql = "
SELECT 
    s.sectionID,
    s.sectionName,
    s.yearLevel,
    s.course,
    s.schoolYear,
    s.semester,

    a.id AS adviserID,
    a.username AS adviserName,

    sl.studentID AS rowID,
    u.id AS studentID,
    u.userid AS studentUserID,
    u.username AS studentName,
    sl.gender

FROM section_list_tbl sl
INNER JOIN section_tbl s ON sl.sectionID = s.sectionID
LEFT JOIN users u ON sl.studentuserID = u.id
LEFT JOIN users a ON s.adviserID = a.id
ORDER BY u.username ASC
";

$result = mysqli_query($connections, $sql);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($connections)
    ]);
    exit;
}

$students = [];

while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $students
]);

exit;
