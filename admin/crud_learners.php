<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

require '../db_conn.php';

if (isset($_POST['delete_student_id']) && isset($_POST['delete_class_id'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['delete_student_id']);
    $class_id = mysqli_real_escape_string($conn, $_POST['delete_class_id']);

    // Perform the necessary delete operation using the $student_id and $class_id
    $deleteQuery = "DELETE FROM class_students WHERE student_id = '$student_id' AND class_id = '$class_id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        $_SESSION['message'] = "Student deleted successfully.";
    } else {
        $_SESSION['message_danger'] = "Error occurred while deleting the student.";
    }
}

// if (isset($_POST['add_learner'])) {
//     // Retrieve form data
//     $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
//     $class_id = $_SESSION['class_id'];
//                   $query = "SELECT school_year_id FROM class WHERE id IN (SELECT class_id FROM class_students WHERE class_id = '$class_id')";
//                   $result = mysqli_query($conn, $query);
//                   if ($result && mysqli_num_rows($result) > 0) {
//                       $row = mysqli_fetch_assoc($result);
//                       $school_year_id = $row['school_year_id'];
//                       echo '<input type="text" id="school_year_id" name="school_year_id" value="' . $school_year_id . '" required>';
//                       mysqli_free_result($result);
//                   }
//     $selected_students = $_POST['selected_students'];

//     // Loop through selected students and insert each one
//     foreach ($selected_students as $student_id) {
//         // Perform the database insertion
//         $query = "INSERT INTO class_students (class_id, student_id, school_year_id) VALUES ('$class_id', '$student_id', '$school_year_id')";
//         $result = mysqli_query($conn, $query);

//         if (!$result) {
//             // Error message
//             $_SESSION['message_danger'] = "Error occurred while adding learner(s).";
//             header('Location: class_students.php');
//             exit();
//         }
//     }

//     // Success message
//     $_SESSION['message'] = "Learner(s) added successfully.";
//     header('Location: class_students.php');
//     exit();
// }     


    if (isset($_POST['add_learner'])) {
    // Retrieve form data
    $class_id = mysqli_real_escape_string($conn, $_POST['class_id']);
    $class_id = $_SESSION['class_id'];
    // Select school_year_id from class table where id matches $class_id
    $query = "SELECT school_year_id FROM class WHERE id = '$class_id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $school_year_id = $row['school_year_id'];
        mysqli_free_result($result);
    } else {
        // If no school_year_id found, handle the error
        $_SESSION['message_danger'] = "Error occurred while adding learner(s). School year ID not found.";
        header('Location: class_students.php');
        exit();
    }

    $selected_students = $_POST['selected_students'];

    // Loop through selected students and insert each one
    foreach ($selected_students as $student_id) {
        // Check if the combination of class_id, student_id, and school_year_id already exists
        $check_query = "SELECT * FROM class_students WHERE student_id = '$student_id' AND school_year_id = '$school_year_id'";
        $check_result = mysqli_query($conn, $check_query);
        if ($check_result && mysqli_num_rows($check_result) > 0) {
            // If the combination already exists, set a message and skip insertion
            $_SESSION['message_danger'] = "Student already exists in this class for the current school year.";
            header('Location: class_students.php');
            exit();
        }

        // Perform the database insertion
        $insert_query = "INSERT INTO class_students (class_id, student_id, school_year_id) VALUES ('$class_id', '$student_id', '$school_year_id')";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding learner(s).";
            header('Location: class_students.php');
            exit();
        }
    }

    // Success message
    $_SESSION['message'] = "Learner(s) added successfully.";
    header('Location: class_students.php');
    exit();
}



// edit crew member
   if (isset($_POST['edit_class'])) {

        $class_id = mysqli_real_escape_string($conn, $_POST['edit_class_id']);
        $section = mysqli_real_escape_string($conn, $_POST['edit_section']);
        $gradeLevel = mysqli_real_escape_string($conn, $_POST['edit_gradeLevel']);
        $faculty_id = mysqli_real_escape_string($conn, $_POST['edit_faculty_id']);

        // Perform the database update
       $query = "UPDATE class SET 
            section='$section', 
            gradeLevel='$gradeLevel', 
            faculty_id='$faculty_id'
          WHERE id='$class_id'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Class updated successfully.";
            header('Location: class.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update class.";
            header('Location: class.php');
            exit();
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
