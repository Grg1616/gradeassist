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
    if (isset($_POST['add_academic'])) {
        // Retrieve form data
        $class_start = mysqli_real_escape_string($conn, $_POST['class_start']);
        $class_end = mysqli_real_escape_string($conn, $_POST['class_end']);

        // $checkQuery = "SELECT * FROM crew_members WHERE phone = '$phone'";
        // $checkResult = mysqli_query($conn, $checkQuery);
        // if (mysqli_num_rows($checkResult) > 0) {
        //     $_SESSION['message_danger'] = "Crew Member with phone number $phone already exists.";
        //     header('Location: crew_members.php');
        //     exit();
        // }

        // Perform the database insertion
        $query = "INSERT INTO academic_calendar (class_start, class_end) 
                  VALUES ('$class_start', '$class_end')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "New academic calendar created successfully.";
            header('Location: set_calendar.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while creating new academic calendar.";
            header('Location: set_calendar.php');
            exit();
        }
    }
    
// edit crew member
  if (isset($_POST['edit_calendar'])) {
    $calendar_id = mysqli_real_escape_string($conn, $_POST['calendar_id']);
    $class_start = mysqli_real_escape_string($conn, $_POST['class_start']);
    $class_end = mysqli_real_escape_string($conn, $_POST['class_end']);
    $_1semester_start = mysqli_real_escape_string($conn, $_POST['1semester_start']);
    $_1semester_end = mysqli_real_escape_string($conn, $_POST['1semester_end']);
    $_2semester_start = mysqli_real_escape_string($conn, $_POST['2semester_start']);
    $_2semester_end = mysqli_real_escape_string($conn, $_POST['2semester_end']);
    $_1quarter_start = mysqli_real_escape_string($conn, $_POST['1quarter_start']);
    $_1quarter_end = mysqli_real_escape_string($conn, $_POST['1quarter_end']);
    $_2quarter_start = mysqli_real_escape_string($conn, $_POST['2quarter_start']);
    $_2quarter_end = mysqli_real_escape_string($conn, $_POST['2quarter_end']);
    $_3quarter_start = mysqli_real_escape_string($conn, $_POST['3quarter_start']);
    $_3quarter_end = mysqli_real_escape_string($conn, $_POST['3quarter_end']);
    $_4quarter_start = mysqli_real_escape_string($conn, $_POST['4quarter_start']);
    $_4quarter_end = mysqli_real_escape_string($conn, $_POST['4quarter_end']);

    // Perform the database update
    $query = "UPDATE academic_calendar SET 
        class_start='$class_start', 
        class_end='$class_end', 
        1semester_start='$_1semester_start', 
        1semester_end='$_1semester_end', 
        2semester_start='$_2semester_start', 
        2semester_end='$_2semester_end', 
        1quarter_start='$_1quarter_start', 
        1quarter_end='$_1quarter_end', 
        2quarter_start='$_2quarter_start', 
        2quarter_end='$_2quarter_end', 
        3quarter_start='$_3quarter_start', 
        3quarter_end='$_3quarter_end', 
        4quarter_start='$_4quarter_start', 
        4quarter_end='$_4quarter_end'
    WHERE id='$calendar_id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $school_year_id = $_POST['school_year_id'];
        foreach ($_POST['daysInMonth'] as $monthId => $daysInMonth) {
            // Ensure data integrity
            $safeMonthId = (int)$monthId; // cast to int for security
            $safeDaysInMonth = mysqli_real_escape_string($conn, $daysInMonth);

            $updateDaysQuery = "UPDATE months 
                                SET daysInMonth = '$safeDaysInMonth' 
                                WHERE id = $safeMonthId 
                                AND school_year_id = $school_year_id";
            $updateResult = mysqli_query($conn, $updateDaysQuery);
            if (!$updateResult) {
                // Error message
                $_SESSION['message_danger'] = "Failed to update academic calendar.";
                header('Location: set_calendar.php');
                exit();
            }
        }
        // Success message
        $_SESSION['message'] = "Academic calendar updated successfully.";
        header('Location: set_calendar.php');
        exit();
    } else {
        // Error message
        $_SESSION['message_danger'] = "Failed to update academic calendar.";
        header('Location: set_calendar.php');
        exit();
    }
} else {
    // Redirect to the appropriate page if the form is not submitted
    header("Location: set_calendar.php");
    exit();
}


    } else {
    header("Location: ../admin_login.php");
    exit();
    }
    ?>
