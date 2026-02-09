<?php
session_start();
require '../db_conn.php';

// Handle update score request
if (isset($_POST['ww_score'])) {
    $load_id = mysqli_real_escape_string($conn, $_POST['load_id']);
    $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
    $school_year = mysqli_real_escape_string($conn, $_POST['school_year']);
    $quarter = mysqli_real_escape_string($conn, $_POST['quarter']);
    $ww_id = mysqli_real_escape_string($conn, $_POST['ww_id']);

    // Ensure that the $_POST['student_id'] is an array
    $student_ids = is_array($_POST['student_id']) ? $_POST['student_id'] : array($_POST['student_id']);

    // Loop through each student
    foreach ($student_ids as $student_id) {
        // Fetch the posted values for w1 to w10
        $w_values = array();
        for ($i = 1; $i <= 10; $i++) {
            // Check if $_POST['w'.$i] is set and is an array
            if (isset($_POST['w'.$i]) && is_array($_POST['w'.$i])) {
                // Check if the $student_id exists in $_POST['w'.$i] array
                if (isset($_POST['w'.$i][$student_id])) {
                    $w_values[] = mysqli_real_escape_string($conn, $_POST['w'.$i][$student_id]);
                } else {
                    $w_values[] = ''; // Assign an empty string if $student_id doesn't exist
                }
            } else {
                $w_values[] = ''; // Assign an empty string if $_POST['w'.$i] is not set or is not an array
            }
        }

        // Check if the record exists in ww_score
        $query = "SELECT id FROM ww_score WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter' AND ww_id = '$ww_id'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Record exists, update the columns w1-w10
            $update_query = "UPDATE ww_score SET ";
            for ($i = 0; $i < 10; $i++) {
                $update_query .= "w" . ($i + 1) . " = '{$w_values[$i]}'";
                if ($i < 9) {
                    $update_query .= ", ";
                }
            }
            $update_query .= " WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter' AND ww_id = '$ww_id'";
            mysqli_query($conn, $update_query);
        } else {
            // Record doesn't exist, insert the values
            $insert_query = "INSERT INTO ww_score (ww_id, student_id, load_id, school_year_id, quarter, w1, w2, w3, w4, w5, w6, w7, w8, w9, w10) VALUES ('$ww_id', '$student_id', '$load_id', '$school_year', '$quarter',";
            foreach ($w_values as $key => $value) {
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
    header("Location: class_details.php?class_id=$class_id&school_year=$school_year&load_id=$load_id&quarter=$quarter");
    exit();
}

// Handle add class request
if (isset($_POST['ww'])) {
    // Retrieve form data
    $written_work = $_POST['written_work'];
    $load_id = mysqli_real_escape_string($conn, $_POST['load_id']);
    $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
    $school_year = mysqli_real_escape_string($conn, $_POST['school_year']);
    $quarter = mysqli_real_escape_string($conn, $_POST['quarter']);

    // Check if load_id, school_year, and quarter exist
    if ($load_id && $school_year && $quarter) {
        // Check if record already exists in written_works table
        $query = "SELECT * FROM written_works WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Update existing record
            $updateQuery = "UPDATE written_works SET ";
            foreach ($written_work as $key => $value) {
                $updateQuery .= "wps" . ($key + 1) . " = '" . mysqli_real_escape_string($conn, $value) . "'";
                if ($key < count($written_work) - 1) {
                    $updateQuery .= ", ";
                }
            }
            $updateQuery .= " WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
            mysqli_query($conn, $updateQuery);
        } else {
            // Insert new record
            $insertQuery = "INSERT INTO written_works (load_id, school_year_id, quarter, ";
            $values = "'" . $load_id . "', '" . $school_year . "', '" . $quarter . "', ";
            foreach ($written_work as $key => $value) {
                $insertQuery .= "wps" . ($key + 1);
                $values .= "'" . mysqli_real_escape_string($conn, $value) . "'";
                if ($key < count($written_work) - 1) {
                    $insertQuery .= ", ";
                    $values .= ", ";
                }
            }
            $insertQuery .= ") VALUES (" . $values . ")";
            mysqli_query($conn, $insertQuery);
        }

        // Redirect to a page after operation (e.g., success page)
        $_SESSION['message'] = "Records updated successfully.";
        header("Location: class_details.php?class_id=$class_id&school_year=$school_year&load_id=$load_id&quarter=$quarter");
        exit();
    } else {
        // Handle missing parameters
        $_SESSION['message_danger'] = "Error occurred while updating records.";
        header("Location: class_details.php?class_id=$class_id&school_year=$school_year&load_id=$load_id&quarter=$quarter");
        exit();
    }
}

// If code execution reaches here without any POST request, redirect with a success message
$_SESSION['message'] = "No action performed.";
header("Location: class_details.php");
exit();
?>
