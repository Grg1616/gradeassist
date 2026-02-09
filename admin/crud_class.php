<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

require '../db_conn.php';

    if (isset($_POST['delete_class_id'])) {
        $class_id = mysqli_real_escape_string($conn, $_POST['delete_class_id']);

        // Perform the necessary delete operation using the $class_id
        $deleteQuery = "DELETE FROM class WHERE id = $class_id";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Grading system deleted successfully.";
        } else {
            $_SESSION['message_danger'] = "Error occurred while deletng the grading system.";
        }
    }

    // Add crew member
    if (isset($_POST['add_class'])) {
        // Retrieve form data
        $section = mysqli_real_escape_string($conn, $_POST['section']);
        $gradeLevel = mysqli_real_escape_string($conn, $_POST['gradeLevel']);
        $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
        $school_year_id = mysqli_real_escape_string($conn, $_POST['school_year_id']);

        // $checkQuery = "SELECT * FROM crew_members WHERE phone = '$phone'";
        // $checkResult = mysqli_query($conn, $checkQuery);
        // if (mysqli_num_rows($checkResult) > 0) {
        //     $_SESSION['message_danger'] = "Crew Member with phone number $phone already exists.";
        //     header('Location: crew_members.php');
        //     exit();
        // }

        // Perform the database insertion
        $query = "INSERT INTO class (section, gradeLevel, faculty_id, school_year_id) VALUES ('$section', '$gradeLevel', '$faculty_id', '$school_year_id')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Class created successfully.";
            header("Location: class.php");
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while creating class.";
            header("Location: class.php");
            exit();
        }
    }
    
    // edit crew member
    if (isset($_POST['edit_class'])) {

        $class_id = mysqli_real_escape_string($conn, $_POST['edit_class_id']);
        $section = mysqli_real_escape_string($conn, $_POST['edit_section']);
        $gradeLevel = mysqli_real_escape_string($conn, $_POST['edit_gradeLevel']);
        $faculty_id = mysqli_real_escape_string($conn, $_POST['edit_faculty_id']);
        $school_year_id = mysqli_real_escape_string($conn, $_POST['school_year_id']);

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
            header("Location: class.php");
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update class.";
            header("Location: class.php");
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
