<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "../connections/connections.php";


$sql = "
SELECT 
    sst.student_subject_id AS id,

    sub.subjectID,
    sub.subjectName,

    u.id AS teacherID,
    u.username AS teacherName,

    sec.sectionID,
    sec.sectionName,

    r.roomID,
    r.roomName,

    sa.day,
    sa.startTime,
    sa.endTime,
    sa.notes

FROM student_subject_tbl sst
INNER JOIN section_assignments sa ON sst.assignmentID = sa.assignmentID
INNER JOIN subject_tbl sub ON sa.subjectID = sub.subjectID
INNER JOIN users u ON sa.teacherID = u.id AND u.role = 'Teacher'
INNER JOIN section_tbl sec ON sa.sectionID = sec.sectionID
INNER JOIN room_tbl r ON sa.roomID = r.roomID
ORDER BY sa.day, sa.startTime ASC
";

$result = mysqli_query($connections, $sql);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($connections)
    ]);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
exit;