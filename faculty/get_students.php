<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

require '../db_conn.php';

// Get class_id or load_id from request. If load_id supplied, resolve its class_id.
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;
$load_id = isset($_GET['load_id']) ? intval($_GET['load_id']) : 0;
$school_year_id = isset($_GET['school_year_id']) ? intval($_GET['school_year_id']) : 0;

if ($load_id > 0) {
    // Resolve class_id from loads and verify faculty access
    $load_q = "SELECT class_id, faculty_id FROM loads WHERE id = $load_id LIMIT 1";
    $load_r = mysqli_query($conn, $load_q);
    if (!$load_r || mysqli_num_rows($load_r) === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid load ID']);
        exit();
    }
    $load_row = mysqli_fetch_assoc($load_r);
    if ($load_row['faculty_id'] != $_SESSION['user_id']) {
        echo json_encode(['success' => false, 'message' => 'Access denied for this load']);
        exit();
    }
    $class_id = intval($load_row['class_id']);
}

if ($class_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid class ID']);
    exit();
}

// Verify that the faculty member has access to this class (fallback if class_id provided)
// Verify that the faculty member has access to this class (adviser OR subject teacher)
$access_check = "SELECT c.id 
                 FROM class c
                 LEFT JOIN loads l ON l.class_id = c.id AND l.faculty_id = {$_SESSION['user_id']}
                 WHERE c.id = $class_id 
                   AND (c.faculty_id = {$_SESSION['user_id']} OR l.id IS NOT NULL)
                 LIMIT 1";
$access_result = mysqli_query($conn, $access_check);

if (mysqli_num_rows($access_result) === 0) {
    echo json_encode(['success' => false, 'message' => 'Access denied']);
    exit();
}


// Fetch students in the class
$query = "SELECT DISTINCT 
            students.id as student_id,
            students.sr_code,
            students.lrn,
            students.firstName,
            students.middleName,
            students.lastName,
            students.email,
            students.contactNumber as phone,
            students.gender
          FROM students
          JOIN class_students ON class_students.student_id = students.id
          WHERE class_students.class_id = $class_id
          AND class_students.school_year_id = $school_year_id
          ORDER BY
                        CASE
                            WHEN TRIM(LOWER(students.gender)) IN ('male','m') THEN 0
                            WHEN TRIM(LOWER(students.gender)) IN ('female','f') THEN 1
                            ELSE 2
                        END,
                        students.lastName ASC,
                        students.firstName ASC";

$query_run = mysqli_query($conn, $query);

if (!$query_run) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
    exit();
}

$students = [];
while ($student = mysqli_fetch_assoc($query_run)) {
    $students[] = $student;
}

echo json_encode([
    'success' => true,
    'students' => $students,
    'count' => count($students)
]);

mysqli_close($conn);
?>