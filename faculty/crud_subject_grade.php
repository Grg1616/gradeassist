<?php
session_start();
require '../db_conn.php';

if (isset($_POST['update_grade'])) {
    $load_id = mysqli_real_escape_string($conn, $_POST['load_id']);
    $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
    $school_year = mysqli_real_escape_string($conn, $_POST['school_year']);
    $quarter = mysqli_real_escape_string($conn, $_POST['quarter']);
    $transmuted_grades = $_POST['transmuted_grade'];
    $student_ids = $_POST['student_id'];
    $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']); // Get faculty id from session

    // Iterate through each student ID and transmuted grade
    foreach ($student_ids as $index => $student_id) {
        $transmuted_grade = mysqli_real_escape_string($conn, $transmuted_grades[$student_id]);

        // Check if all necessary data is provided for each student
        if (!empty($load_id) && !empty($school_year) && !empty($quarter) && !empty($student_id) && !empty($transmuted_grade)) {
            // Prepare the SQL statement
            $sql = "SELECT * FROM subject_grades WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND student_id = '$student_id'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                // No existing record found, so insert a new record
                $insert_sql = "INSERT INTO subject_grades (load_id, school_year_id, student_id, ";
                switch ($quarter) {
                    case 1:
                        $insert_sql .= "q1_grade";
                        break;
                    case 2:
                        $insert_sql .= "q2_grade";
                        break;
                    case 3:
                        $insert_sql .= "q3_grade";
                        break;
                    case 4:
                        $insert_sql .= "q4_grade";
                        break;
                    default:
                        // Invalid quarter value
                        break;
                }
                $insert_sql .= ") VALUES ('$load_id', '$school_year', '$student_id', '$transmuted_grade')";
                mysqli_query($conn, $insert_sql);
            } else {
                // Record found, update the appropriate quarter grade
                switch ($quarter) {
                    case 1:
                        $update_sql = "UPDATE subject_grades SET q1_grade = '$transmuted_grade' WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND student_id = '$student_id'";
                        break;
                    case 2:
                        $update_sql = "UPDATE subject_grades SET q2_grade = '$transmuted_grade' WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND student_id = '$student_id'";
                        break;
                    case 3:
                        $update_sql = "UPDATE subject_grades SET q3_grade = '$transmuted_grade' WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND student_id = '$student_id'";
                        break;
                    case 4:
                        $update_sql = "UPDATE subject_grades SET q4_grade = '$transmuted_grade' WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND student_id = '$student_id'";
                        break;
                    default:
                        // Invalid quarter value
                        break;
                }
                mysqli_query($conn, $update_sql);
            }
        }
    }

    // Check if the load_id exists in submit_grades table for this quarter and faculty
    $check_sql = "SELECT * FROM submit_grades WHERE load_id = '$load_id' AND quarter = '$quarter' AND faculty_id = '$user_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) == 0) {
        // Insert a new record in submit_grades if no record exists for this load/quarter/faculty
        $submit_sql = "INSERT INTO submit_grades (load_id, faculty_id, status, quarter) VALUES ('$load_id', '$user_id', 'submit', '$quarter')";
        mysqli_query($conn, $submit_sql);
    }

    // Set success message
    $_SESSION['message'] = "Grades submitted successfully!";
    header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
    exit();
} else {
    $_SESSION['message_danger'] = "Failed to submit grades.";
    header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
    exit();
}
?>
