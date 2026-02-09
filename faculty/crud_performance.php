<?php
session_start();
require '../db_conn.php';


if (isset($_POST['pt_score'])) {
    $load_id = mysqli_real_escape_string($conn, $_POST['load_id']);
    $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
    $school_year = mysqli_real_escape_string($conn, $_POST['school_year']);
    $quarter = mysqli_real_escape_string($conn, $_POST['quarter']);
    $pt_id = mysqli_real_escape_string($conn, $_POST['pt_id']);

    // Ensure that the $_POST['student_id'] is an array
    $student_ids = is_array($_POST['student_id']) ? $_POST['student_id'] : array($_POST['student_id']);

    // Loop through each student
    foreach ($student_ids as $student_id) {
        // Fetch the posted values for pt1 to pt10
        $pt_values = array();
        for ($i = 1; $i <= 10; $i++) {
            // Check if $_POST['pt'.$i] is set and is an array
            if (isset($_POST['pt'.$i]) && is_array($_POST['pt'.$i])) {
                // Check if the $student_id exists in $_POST['pt'.$i] array
                if (isset($_POST['pt'.$i][$student_id])) {
                    $pt_values[] = mysqli_real_escape_string($conn, $_POST['pt'.$i][$student_id]);
                } else {
                    $pt_values[] = ''; // Assign an empty string if $student_id doesn't exist
                }
            } else {
                $pt_values[] = ''; // Assign an empty string if $_POST['pt'.$i] is not set or is not an array
            }
        }

        // Check if the record exists in pt_score
        $query = "SELECT id FROM pt_score WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter' AND pt_id = '$pt_id'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Record exists, update the columns pt1-pt10
            $update_query = "UPDATE pt_score SET ";
            for ($i = 0; $i < 10; $i++) {
                $update_query .= "pt" . ($i + 1) . " = '{$pt_values[$i]}'";
                if ($i < 9) {
                    $update_query .= ", ";
                }
            }
            $update_query .= " WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter' AND pt_id = '$pt_id'";
            mysqli_query($conn, $update_query);
        } else {
            // Record doesn't exist, insert the values
            $insert_query = "INSERT INTO pt_score (pt_id, student_id, load_id, school_year_id, quarter, pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8, pt9, pt10) VALUES ('$pt_id', '$student_id', '$load_id', '$school_year', '$quarter',";
            foreach ($pt_values as $key => $value) {
                $insert_query .= " '" . $value . "'";
                if ($key < 9) {
                    $insert_query .= ",";
                }
            }
            $insert_query .= ")";
            mysqli_query($conn, $insert_query);
        }
    }

    // Redirect after processing all students
    $_SESSION['message'] = "Records updated successfully.";
    header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
    exit();
}


// Handle add class request
if (isset($_POST['pt'])) {
    // Retrieve form data
    $performance_task = $_POST['performance_task'];
    $load_id = mysqli_real_escape_string($conn, $_POST['load_id']);
    $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
    $school_year = mysqli_real_escape_string($conn, $_POST['school_year']);
    $quarter = mysqli_real_escape_string($conn, $_POST['quarter']);

    // Check if class_id, school_year, and quarter exist
    if ($load_id && $school_year && $quarter) {
        // Check if record already exists in performance_tasks table
        $query = "SELECT * FROM performance_task WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Update existing record
            $updateQuery = "UPDATE performance_task SET ";
            foreach ($performance_task as $key => $value) {
                $updateQuery .= "pps" . ($key + 1) . " = '" . mysqli_real_escape_string($conn, $value) . "'";
                if ($key < count($performance_task) - 1) {
                    $updateQuery .= ", ";
                }
            }
            $updateQuery .= " WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
            mysqli_query($conn, $updateQuery);
        } else {
            // Insert new record
            $insertQuery = "INSERT INTO performance_task (load_id, school_year_id, quarter, ";
            $values = "'" . $load_id . "', '" . $school_year . "', '" . $quarter . "', ";
            foreach ($performance_task as $key => $value) {
                $insertQuery .= "pps" . ($key + 1);
                $values .= "'" . mysqli_real_escape_string($conn, $value) . "'";
                if ($key < count($performance_task) - 1) {
                    $insertQuery .= ", ";
                    $values .= ", ";
                }
            }
            $insertQuery .= ") VALUES (" . $values . ")";
            mysqli_query($conn, $insertQuery);
        }

        // Redirect to a page after operation (e.g., success page)
        $_SESSION['message'] = "Records updated successfully.";
        header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
        exit();
    } else {
        // Handle missing parameters
        $_SESSION['message_danger'] = "Error occurred while updating records.";
        header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
        exit();
    }
}


// If code execution reaches here without any POST request, redirect with a success message
$_SESSION['message'] = "No action performed.";
header("Location: class_details.php");
exit();
?>
