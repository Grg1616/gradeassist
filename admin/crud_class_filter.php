<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

    require '../db_conn.php';

    if (isset($_POST['class_filter'])) {
        // Get and sanitize form data
        $school_year = mysqli_real_escape_string($conn, $_POST['school_year']);
        $semester = mysqli_real_escape_string($conn, $_POST['semester']);
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $quarter = mysqli_real_escape_string($conn, $_POST['quarter']);

        // Check if the user_id exists in the filter table
        $check_query = "SELECT * FROM filter WHERE user_id='$user_id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // If the user_id exists, update the filter
            $query = "UPDATE filter SET 
                        school_year='$school_year', 
                        semester='$semester',
                        quarter='$quarter'
                      WHERE user_id='$user_id'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Success message
                $_SESSION['message'] = "Filter applied successfully.";
                header('Location: class.php');
                exit();
            } else {
                // Error message
                $_SESSION['message_danger'] = "Failed to apply filter.";
                header('Location: class.php');
                exit();
            }
        } else {
            // If the user_id doesn't exist, insert a new record
            $insert_query = "INSERT INTO filter (user_id, school_year, semester, quarter) VALUES ('$user_id', '$school_year', '$semester', '$quarter')";
            $insert_result = mysqli_query($conn, $insert_query);

            if ($insert_result) {
                // Success message
                $_SESSION['message'] = "Filter inserted successfully.";
                header('Location: class.php');
                exit();
            } else {
                // Error message
                $_SESSION['message_danger'] = "Failed to insert filter.";
                header('Location: class.php');
                exit();
            }
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: class.php");
        exit();
    }

} else {
    header("Location: ../admin_login.php");
    exit();
}
?>
