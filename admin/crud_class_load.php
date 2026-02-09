<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

require '../db_conn.php';

if (isset($_POST['delete_classload_id'])) {
    $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
    $school_year_id = mysqli_real_escape_string($conn, $_POST['school_year_id']);
    $subject_id = mysqli_real_escape_string($conn, $_POST['delete_classload_id']);

    // Prepare and execute the DELETE query
    $deleteQuery = "DELETE FROM loads WHERE subject_id = $subject_id AND class_id = $class_id AND school_year_id = $school_year_id";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    // Check if the deletion was successful
    if ($deleteResult) {
        $_SESSION['message'] = "Class load deleted successfully.";
    } else {
        $_SESSION['message_danger'] = "Error occurred while deleting the class load.";
    }
}

    // Add crew member
    // Add crew member
if (isset($_POST['add_class_load'])) {
    // Retrieve form data
    $subject_id = mysqli_real_escape_string($conn, $_POST['subject_id']);
    $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
    $hours_per_week = mysqli_real_escape_string($conn, $_POST['hours_per_week']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
    $school_year_id = mysqli_real_escape_string($conn, $_POST['school_year_id']);

    // Fetch courseCode from subjects table
    $courseCode_query = "SELECT courseCode FROM subjects WHERE id = '$subject_id'";
    $courseCode_result = mysqli_query($conn, $courseCode_query);
    if ($courseCode_row = mysqli_fetch_assoc($courseCode_result)) {
        $courseCode = $courseCode_row['courseCode'];
        if (strpos($courseCode, 'MAPEH') !== false) {
            // Extract numerical value from courseCode
            preg_match('/\d+/', $courseCode, $matches);
            $numerical_value = $matches[0];

            // Perform the database insertion for MAPEH subjects
            $mapeh_names = ['Music', 'Arts', 'Physical Education', 'Health'];
            $mapeh_with_numerical_value = array_map(function($mapeh_name) use ($numerical_value) {
                return $mapeh_name . ' ' . $numerical_value;
            }, $mapeh_names);

            foreach ($mapeh_with_numerical_value as $mapeh_name) {
                $query = "INSERT INTO loads (subject_id, class_id, semester, hours_per_week, faculty_id, school_year_id, mapeh_name) 
                          VALUES ('$subject_id', '$class_id', '$semester', '$hours_per_week', '$faculty_id', '$school_year_id', '$mapeh_name')";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    // Error message
                    $_SESSION['message_danger'] = "Error occurred while adding the class load for $mapeh_name.";
                    header("Location: class_load.php?class_id=" . $class_id);
                    exit();
                }
            }
            // Success message
            $_SESSION['message'] = "Class loads for MAPEH subjects added successfully.";
            header("Location: class_load.php?class_id=" . $class_id);
            exit();
        }
    }
    // If not MAPEH subject, insert single row into loads table
    $query = "INSERT INTO loads (subject_id, class_id, semester, hours_per_week, faculty_id, school_year_id) 
              VALUES ('$subject_id', '$class_id', '$semester', '$hours_per_week', '$faculty_id', '$school_year_id')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Success message
        $_SESSION['message'] = "Class load added successfully.";
        header("Location: class_load.php?class_id=" . $class_id);
        exit();
    } else {
        // Error message
        $_SESSION['message_danger'] = "Error occurred while adding the class load.";
        header("Location: class_load.php?class_id=" . $class_id);
        exit();
    }
}


    
// edit crew member
   if (isset($_POST['edit_class_load'])) {
        // Get and sanitize form data
        $classload_id = mysqli_real_escape_string($conn, $_POST['edit_classload_id']);
        $subject_id = mysqli_real_escape_string($conn, $_POST['edit_subject_id']);
        $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
        $semester = mysqli_real_escape_string($conn, $_POST['edit_semester']);
        $hours_per_week = mysqli_real_escape_string($conn, $_POST['edit_hours_per_week']);
        $faculty_id = mysqli_real_escape_string($conn, $_POST['edit_faculty_id']);

        // Perform the database update
        $query = "UPDATE loads SET 
                    subject_id='$subject_id', 
                    faculty_id='$faculty_id', 
                    semester='$semester',
                    hours_per_week='$hours_per_week'
                  WHERE id='$classload_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Class load updated successfully.";
            header("Location: class_load.php?class_id=" . $class_id);
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update class load.";
            header("Location: class_load.php?class_id=" . $class_id);
            exit();
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: class_load.php?class_id=" . $class_id);
        exit();
    }

    } else {
    header("Location: ../admin_login.php");
    exit();
    }
    ?>
