<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

require '../db_conn.php';

// Get class ID from request
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;

if ($class_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid class ID']);
    exit();
}

// Verify that the faculty member has access to this class
$access_check = "SELECT id FROM class 
                 WHERE id = $class_id 
                 AND faculty_id = {$_SESSION['user_id']}";
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