<?php 


class StudentController {
   // Fetch subjects for a specific student
  public function fetchSubjectsForStudent($studentID) {
    global $connections;

    $sql = "
        SELECT 
            sst.student_subject_id,
            sub.subjectName,
            u.username AS teacherName,
            sec.sectionName,
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
        WHERE sst.studentID = '$studentID'
        ORDER BY sa.day, sa.startTime ASC
    ";

    $result = mysqli_query($connections, $sql);
    $subjects = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $subjects[] = $row;
        }
    }

    return $subjects;
}

public function getStudentSectionInfo($studentID) {
    global $connections;

    $sql = "
        SELECT 
            s.sectionName,
            s.yearLevel,
            s.course,
            s.schoolYear,
            s.semester,
            a.username AS adviserName
        FROM section_list_tbl sl
        INNER JOIN section_tbl s ON sl.sectionID = s.sectionID
        INNER JOIN users a ON s.adviserID = a.id
        WHERE sl.studentuserID = '$studentID'
        LIMIT 1
    ";

    $result = mysqli_query($connections, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return [
        'sectionName' => 'N/A',
        'yearLevel' => 'N/A',
        'course' => 'N/A',
        'schoolYear' => 'N/A',
        'semester' => 'N/A',
        'adviserName' => 'N/A'
    ];
}

}