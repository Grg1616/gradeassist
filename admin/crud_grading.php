<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

require '../db_conn.php';

    if (isset($_POST['delete_grading_id'])) {
        $grading_id = mysqli_real_escape_string($conn, $_POST['delete_grading_id']);

        // Perform the necessary delete operation using the $grading_id
        $deleteQuery = "DELETE FROM grading_system WHERE id = $grading_id";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Grading system deleted successfully.";
        } else {
            $_SESSION['message_danger'] = "Error occurred while deletng the grading system.";
        }
    }

    // Add crew member
    if (isset($_POST['add_grading_system'])) {
        // Retrieve form data
        $written = mysqli_real_escape_string($conn, $_POST['written']);
        $performance = mysqli_real_escape_string($conn, $_POST['performance']);
        $assessment = mysqli_real_escape_string($conn, $_POST['assessment']);
        $subjectArea = mysqli_real_escape_string($conn, $_POST['subjectArea']);
        $level = mysqli_real_escape_string($conn, $_POST['level']);

        // $checkQuery = "SELECT * FROM crew_members WHERE phone = '$phone'";
        // $checkResult = mysqli_query($conn, $checkQuery);
        // if (mysqli_num_rows($checkResult) > 0) {
        //     $_SESSION['message_danger'] = "Crew Member with phone number $phone already exists.";
        //     header('Location: crew_members.php');
        //     exit();
        // }

        // Perform the database insertion
        $query = "INSERT INTO grading_system (written, performance , assessment, subjectArea, level) 
                  VALUES ('$written', '$performance' , '$assessment', '$subjectArea', '$level')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Grading system added successfully.";
            header('Location: grading_system.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding the grading system.";
            header('Location: grading_system.php');
            exit();
        }
    }
    
// edit crew member
  if (isset($_POST['edit_grading_system'])) {
        // Get and sanitize form data
        $grading_id = mysqli_real_escape_string($conn, $_POST['edit_grading_id']);
        $written = mysqli_real_escape_string($conn, $_POST['edit_written']);
        $performance = mysqli_real_escape_string($conn, $_POST['edit_performance']);
        $assessment = mysqli_real_escape_string($conn, $_POST['edit_assessment']);
        $subjectArea = mysqli_real_escape_string($conn, $_POST['edit_subjectArea']);
        $level = mysqli_real_escape_string($conn, $_POST['edit_level']);

        // Perform the database update
        $query = "UPDATE grading_system SET 
                    written='$written', 
                    performance='$performance', 
                    assessment='$assessment', 
                    subjectArea='$subjectArea', 
                    level='$level'
                  WHERE id='$grading_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Grading system updated successfully.";
            header('Location: grading_system.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update grading system.";
            header('Location: grading_system.php');
            exit();
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: grading_system.php");
        exit();
    }


    } else {
    header("Location: ../admin_login.php");
    exit();
    }
    ?>
