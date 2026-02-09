<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {

    require '../db_conn.php';

    if (isset($_POST['edit_attendance'])) {
        // Loop through each submitted form field
        $school_year = mysqli_real_escape_string($conn, $_POST['school_year_id']);
        $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
        $load_id = mysqli_real_escape_string($conn, $_POST['load_id']);
        $quarter = mysqli_real_escape_string($conn, $_POST['quarter']);
        $month_id = mysqli_real_escape_string($conn, $_POST['month_id']);
        
        foreach ($_POST as $key => $value) {
            // Check if the field name follows the pattern for daysPresent fields
            if (strpos($key, 'days_present_') !== false) {
                // Extract student ID and month name from the field name
                $parts = explode('_', $key);
                $student_id = $parts[2];
                $month_id = $parts[3];

                // Sanitize the input
                $daysPresent = mysqli_real_escape_string($conn, $value);

                // Construct the update query
                $update_query = "UPDATE attendance 
                                 SET daysPresent = '$daysPresent' 
                                 WHERE student_id = '$student_id' 
                                 AND class_id = '$class_id' 
                                 AND school_year_id = '$school_year' 
                                 AND month_id = '$month_id' ";

                // Execute the update query
                if (mysqli_query($conn, $update_query)) {
                    $_SESSION['message'] = "Attendance updated successfully";
                } else {
                    $_SESSION['message_danger'] = "Failed to update attendance.";
                }
            }
        }
        header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
        exit();
    } else {
        header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
        exit();
    }
} else {
    header("Location: ../admin_login.php");
    exit();
}
?>
