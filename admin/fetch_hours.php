<?php
require '../db_conn.php';

// expects: class_id, subject_id, school_year_id, optional semester
$class_id = isset($_POST['class_id']) ? intval($_POST['class_id']) : 0;
$subject_id = isset($_POST['subject_id']) ? intval($_POST['subject_id']) : 0;
$school_year_id = isset($_POST['school_year_id']) ? intval($_POST['school_year_id']) : 0;
$semester = isset($_POST['semester']) && $_POST['semester'] !== '' ? intval($_POST['semester']) : null;

$hours = '';
if ($class_id && $subject_id && $school_year_id) {
    $sql = "SELECT hours_per_week FROM loads WHERE class_id = $class_id AND subject_id = $subject_id AND school_year_id = $school_year_id";
    if ($semester !== null) {
        $sql .= " AND semester = $semester";
    }
    $sql .= " LIMIT 1";

    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $hours = $row['hours_per_week'];
    }
}

// if we didn't find a value yet, fallback to the contactHours of the subject
if ($hours === '' && $subject_id) {
    $q2 = "SELECT contactHours FROM subjects WHERE id = $subject_id LIMIT 1";
    $r2 = mysqli_query($conn, $q2);
    if ($r2 && mysqli_num_rows($r2) > 0) {
        $hrow = mysqli_fetch_assoc($r2);
        $hours = $hrow['contactHours'];
    }
}

// respond with JSON
header('Content-Type: application/json');
echo json_encode(['hours' => $hours]);
