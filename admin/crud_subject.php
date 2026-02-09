<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

require '../db_conn.php';

    if (isset($_POST['delete_subject_id'])) {
        $subject_id = mysqli_real_escape_string($conn, $_POST['delete_subject_id']);

        // Perform the necessary delete operation using the $subject_id
        $deleteQuery = "DELETE FROM subjects WHERE id = $subject_id";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Subject deleted successfully.";
        } else {
            $_SESSION['message_danger'] = "Error occurred while deletng the subject.";
        }
    }

    // Add crew member
    if (isset($_POST['add_subject'])) {
        // Retrieve form data
        $courseCode = mysqli_real_escape_string($conn, $_POST['courseCode']);
        $courseTitle = mysqli_real_escape_string($conn, $_POST['courseTitle']);
        $gradeLevel = mysqli_real_escape_string($conn, $_POST['gradeLevel']);
        $semester = mysqli_real_escape_string($conn, $_POST['semester']);
        $subjectType = mysqli_real_escape_string($conn, $_POST['subjectType']);
        $subjectArea = mysqli_real_escape_string($conn, $_POST['subjectArea']);
        $contactHours = mysqli_real_escape_string($conn, $_POST['contactHours']);

        // $checkQuery = "SELECT * FROM crew_members WHERE phone = '$phone'";
        // $checkResult = mysqli_query($conn, $checkQuery);
        // if (mysqli_num_rows($checkResult) > 0) {
        //     $_SESSION['message_danger'] = "Crew Member with phone number $phone already exists.";
        //     header('Location: crew_members.php');
        //     exit();
        // }

        // Perform the database insertion
        $query = "INSERT INTO subjects (courseCode, courseTitle, gradeLevel, semester, subjectType, subjectArea, contactHours) 
                  VALUES ('$courseCode', '$courseTitle', '$gradeLevel', '$semester', '$subjectType', '$subjectArea', '$contactHours')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Subject added successfully.";
            header('Location: subjects.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding the subjects.";
            header('Location: subjects.php');
            exit();
        }
    }
    
// edit crew member
   if (isset($_POST['edit_subject'])) {
        // Get and sanitize form data
        $subject_id = mysqli_real_escape_string($conn, $_POST['edit_subject_id']);
        $courseCode = mysqli_real_escape_string($conn, $_POST['edit_courseCode']);
        $courseTitle = mysqli_real_escape_string($conn, $_POST['edit_courseTitle']);
        $gradeLevel = mysqli_real_escape_string($conn, $_POST['edit_gradeLevel']);
        $semester = mysqli_real_escape_string($conn, $_POST['edit_semester']);
        $subjectType = mysqli_real_escape_string($conn, $_POST['edit_subjectType']);
        $subjectArea = mysqli_real_escape_string($conn, $_POST['edit_subjectArea']);
        $contactHours = mysqli_real_escape_string($conn, $_POST['edit_contactHours']);

        // Perform the database update
        $query = "UPDATE subjects SET 
                    courseCode='$courseCode', 
                    courseTitle='$courseTitle', 
                    courseTitle='$courseTitle', 
                    gradeLevel='$gradeLevel', 
                    semester='$semester', 
                    subjectType='$subjectType', 
                    subjectArea='$subjectArea', 
                    contactHours='$contactHours'
                  WHERE id='$subject_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Subject updated successfully.";
            header('Location: subjects.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update subject.";
            header('Location: subjects.php');
            exit();
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: subjects.php");
        exit();
    }

    } else {
    header("Location: ../admin_login.php");
    exit();
    }
    ?>
