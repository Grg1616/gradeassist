<?php
session_start();
require '../db_conn.php';


if (isset($_POST['qa_score'])) {
    // Extract form data (accept POST or fallback to GET)
    $raw_load_id = $_POST['load_id'] ?? $_GET['load_id'] ?? '';
    $raw_class_id = $_POST['class_id'] ?? $_GET['class_id'] ?? '';
    $raw_school_year = $_POST['school_year'] ?? $_GET['school_year'] ?? '';
    $raw_quarter = $_POST['quarter'] ?? $_GET['quarter'] ?? '';
    $raw_qa_id = $_POST['qa_id'] ?? '';

    // Cast numeric IDs to integers to avoid empty-string -> 0 conversion in DB
    $load_id = intval($raw_load_id);
    $class_id = intval($raw_class_id);
    $school_year = intval($raw_school_year);
    $quarter = intval($raw_quarter);
    $qa_id = mysqli_real_escape_string($conn, $raw_qa_id);

    // Validate required numeric inputs
    if ($load_id <= 0 || $school_year <= 0 || $quarter <= 0) {
        $_SESSION['message_danger'] = "Missing or invalid identifiers: load_id='{$raw_load_id}', school_year='{$raw_school_year}', quarter='{$raw_quarter}'";
        $redirect = "class_details.php?" . http_build_query(['load_id'=>$raw_load_id,'school_year'=>$raw_school_year,'class_id'=>$raw_class_id,'quarter'=>$raw_quarter]);
        header("Location: $redirect");
        exit();
    }
    
    // Ensure that the $_POST['score'] is an array
    $scores = is_array($_POST['score']) ? $_POST['score'] : array();
    
    // Loop through each score
    foreach ($scores as $student_id => $score) {
        // Sanitize input
        $student_id = mysqli_real_escape_string($conn, $student_id);
        $score = mysqli_real_escape_string($conn, $score);
        
        // Check if the record exists in qa_score
        $query = "SELECT id FROM qa_score WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter' AND qa_id = '$qa_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Record exists, update the score
            $update_query = "UPDATE qa_score SET score = '$score' WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter' AND qa_id = '$qa_id'";
            if (!mysqli_query($conn, $update_query)) {
                $_SESSION['message_danger'] = "DB Error (update qa_score): " . mysqli_error($conn);
            }
        } else {
            // Record doesn't exist, insert the score
            $insert_query = "INSERT INTO qa_score (student_id, load_id, school_year_id, quarter, qa_id, score) VALUES ('$student_id', '$load_id', '$school_year', '$quarter', '$qa_id', '$score')";
            if (!mysqli_query($conn, $insert_query)) {
                $_SESSION['message_danger'] = "DB Error (insert qa_score): " . mysqli_error($conn);
            }
        }
    }

    // Redirect after processing all students
    $_SESSION['message'] = "Records updated successfully.";
    header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
    exit();
}


// Ensure the form data is posted
if (isset($_POST['qa'])) {
    // Retrieve form data (accept POST or fallback to GET)
    $ps = mysqli_real_escape_string($conn, $_POST['ps'] ?? '');
    $raw_load_id = $_POST['load_id'] ?? $_GET['load_id'] ?? '';
    $raw_class_id = $_POST['class_id'] ?? $_GET['class_id'] ?? '';
    $raw_school_year = $_POST['school_year'] ?? $_GET['school_year'] ?? '';
    $raw_quarter = $_POST['quarter'] ?? $_GET['quarter'] ?? '';

    // Cast numeric IDs to integers to avoid empty-string -> 0 conversion in DB
    $load_id = intval($raw_load_id);
    $class_id = intval($raw_class_id);
    $school_year = intval($raw_school_year);
    $quarter = intval($raw_quarter);

    // Validate required numeric inputs
    if ($load_id <= 0 || $school_year <= 0 || $quarter <= 0) {
        $_SESSION['message_danger'] = "Missing or invalid identifiers: load_id='{$raw_load_id}', school_year='{$raw_school_year}', quarter='{$raw_quarter}'";
        $redirect = "class_details.php?" . http_build_query(['load_id'=>$raw_load_id,'school_year'=>$raw_school_year,'class_id'=>$raw_class_id,'quarter'=>$raw_quarter]);
        header("Location: $redirect");
        exit();
    }

    // Check if class_id, school_year, and quarter exist
    if ($load_id && $school_year && $quarter) {
        // Check if record already exists in quarterly_assessment table
        $query = "SELECT * FROM quarterly_assessment WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Update existing record
                $updateQuery = "UPDATE quarterly_assessment SET ps = '$ps' WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
                if (!mysqli_query($conn, $updateQuery)) {
                    $_SESSION['message_danger'] = "DB Error (update quarterly_assessment): " . mysqli_error($conn);
                }
            } else {
                // Insert new record
                $insertQuery = "INSERT INTO quarterly_assessment (load_id, school_year_id, quarter, ps) VALUES ('$load_id', '$school_year', '$quarter', '$ps')";
                if (!mysqli_query($conn, $insertQuery)) {
                    $_SESSION['message_danger'] = "DB Error (insert quarterly_assessment): " . mysqli_error($conn);
                }
            }

            // Redirect to a page after operation (e.g., success page)
            if (!isset($_SESSION['message_danger'])) {
                $_SESSION['message'] = "Quarterly assessment updated successfully.";
            }
            header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
            exit();
        } else {
            // Handle database error
            $_SESSION['message_danger'] = "Error occurred while querying database: " . mysqli_error($conn);
            header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
            exit();
        }
    } else {
        // Handle missing parameters
        $_SESSION['message_danger'] = "Error occurred while updating quarterly assessment.";
        header("Location: class_details.php?load_id=$load_id&school_year=$school_year&class_id=$class_id&quarter=$quarter");
        exit();
    }
}



// If code execution reaches here without any POST request, redirect with a success message
$_SESSION['message'] = "No action performed.";
header("Location: class_details.php");
exit();
?>
