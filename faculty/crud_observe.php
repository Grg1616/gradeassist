<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {

    require '../db_conn.php';

    // Check if the form is submitted
    if (isset($_POST['edit_observe'])) {
        // Get submitted data
        $student_id = $_POST['student_id'];
        $class_id = $_POST['class_id'];
        $load_id = $_POST['load_id'];
        $school_year = $_POST['school_year'];
        $quarter = $_POST['quarter'];
        $quarter_values = $_POST['quarter_values'];

        // Loop through quarter values and update database
        foreach ($quarter_values as $core_value => $data) {
            foreach ($data as $behavior_statement_index => $ovquarter) {
                $quarter_1 = $ovquarter[1];
                $quarter_2 = $ovquarter[2];
                $quarter_3 = $ovquarter[3];
                $quarter_4 = $ovquarter[4];

                // Prepare and execute update query
                $update_query = "UPDATE observe_values_sh SET 
                                    quarter_1 = '$quarter_1',
                                    quarter_2 = '$quarter_2',
                                    quarter_3 = '$quarter_3',
                                    quarter_4 = '$quarter_4'
                                WHERE student_id = '$student_id' 
                                AND class_id = '$class_id' 
                                AND school_year_id = '$school_year' 
                                AND core_value = '$core_value' 
                                AND behavior_statement = '$behavior_statement_index'";

                // Execute the query
                $update_result = $conn->query($update_query);

                // Check if the update was successful
                if (!$update_result) {
                    // Error message if the update failed
                    $_SESSION['message_danger'] = "Failed to update Learners observed values.";
                    header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
                    exit();
                }
            }
        }

        // Success message after all updates
        $_SESSION['message'] = "Learners observed values updated successfully.";
        header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
        exit();
    }


 if (isset($_POST['edit_observe_k'])) {

        $class_id = $_POST['class_id'];
        $load_id = $_POST['load_id'];
        $school_year = $_POST['school_year'];
        $quarter = $_POST['quarter'];
        // Loop through the submitted values
        foreach ($_POST as $key => $value) {
            // Check if the key starts with 'quarter_'
            if (strpos($key, 'quarter_') === 0) {
                // Extract value, quarter, and student_id from the key
                $parts = explode('_', $key);
                $value_id = $parts[2];
                $quarter = $parts[1];
                $student_id = $_POST['student_id'];

                // Update the database with the new value for the specific quarter and value_id
                $update_query = "UPDATE observe_values_k 
                                 SET quarter_" . $quarter . " = '" . $value . "' 
                                 WHERE value = '" . $value_id . "' 
                                 AND student_id = '" . $student_id . "'";
                $update_result = $conn->query($update_query);

                // Check if the update was successful
                if (!$update_result) {
                    $_SESSION['message_danger'] = "Failed to update observed values.";
                    header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
                    exit();
                }
            }
        }

        // Success message after all updates
        $_SESSION['message'] = "Learners observed values updated successfully.";
        header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
        exit();
    } else {
        // If the form is not submitted, redirect to an error page or do something else
        header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
        exit();
    }

} else {
    // Redirect if user is not logged in
    header("Location: ../admin_login.php");
    exit();
}
?>
