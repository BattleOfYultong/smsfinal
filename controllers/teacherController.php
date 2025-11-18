<?php

class TeacherController{
public function fetchSubjectsForTeacher($teacherID) {
    global $connections;

    $sql = "
        SELECT 
            sa.assignmentID,
            sub.subjectName,
            sec.sectionName,
            r.roomName,
            sa.day,
            sa.startTime,
            sa.endTime,
            sec.sectionID,

            -- Correct student count (by assignmentID)
            (
                SELECT COUNT(*) 
                FROM student_subject_tbl sst
                WHERE sst.assignmentID = sa.assignmentID
            ) AS studentCount

        FROM section_assignments sa
        INNER JOIN subject_tbl sub ON sa.subjectID = sub.subjectID
        INNER JOIN section_tbl sec ON sa.sectionID = sec.sectionID
        INNER JOIN room_tbl r ON sa.roomID = r.roomID
        WHERE sa.teacherID = '$teacherID'
        ORDER BY sa.day, sa.startTime ASC
    ";

    $result = mysqli_query($connections, $sql);
    $subjects = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $subjects[] = $row;
    }

    return $subjects;
}


public function getTeacherSectionInfo($teacherID) {
    global $connections;

    $sql = "
        SELECT 
            s.sectionName,
            s.yearLevel,
            s.course,
            s.schoolYear,
            s.semester
        FROM section_tbl s
        WHERE s.adviserID = '$teacherID'
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
        'semester' => 'N/A'
    ];
}

public function getAdvisorySections($teacherID) {
    global $connections;

    $sql = "
        SELECT sectionID, sectionName, yearLevel, schoolYear
        FROM section_tbl
        WHERE adviserID = '$teacherID'
    ";

    $result = mysqli_query($connections, $sql);
    $sections = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $sections[] = $row;
    }

    return $sections;
}


public function fetchsubjectforstudent($assignmentID){   
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

        WHERE sst.assignmentID = '$assignmentID'
    ";

    return mysqli_query($connections, $sql);
}
}