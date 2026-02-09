<?php
require '../db_conn.php';

// Retrieve selected grade level and semester
$gradeLevel = isset($_POST['gradeLevel']) ? $_POST['gradeLevel'] : ''; // Check if gradeLevel is set
$semester = isset($_POST['semester']) ? $_POST['semester'] : null; // Initialize semester as null if not set

// If grade level is not Grade 11 or Grade 12, query subjects without considering semester
if ($gradeLevel !== 'Grade 11' && $gradeLevel !== 'Grade 12') {
    $query_subjects = "SELECT id, courseCode, courseTitle FROM subjects WHERE gradeLevel = '$gradeLevel'";
} else {
    $query_subjects = "SELECT id, courseCode, courseTitle FROM subjects WHERE gradeLevel = '$gradeLevel' AND semester = $semester";
}

$query_run_subjects = mysqli_query($conn, $query_subjects);

// Build options for subject dropdown
$options = '<option disabled selected>Select Subject</option>'; // Add the default option
if (mysqli_num_rows($query_run_subjects) > 0) {
    while ($row = mysqli_fetch_assoc($query_run_subjects)) {
        $courseCode = $row['courseCode'];
        $courseTitle = $row['courseTitle'];
        $subjectLabel = $courseCode ? $courseCode . '&nbsp;&nbsp;-&nbsp;&nbsp;' . $courseTitle : $courseTitle;
        $options .= '<option value="' . $row['id'] . '">' . $subjectLabel . '</option>';
    }
}

echo $options;
?>

