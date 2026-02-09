<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

require '../db_conn.php';

    if (isset($_POST['delete_faculty_id'])) {
        $faculty_id = mysqli_real_escape_string($conn, $_POST['delete_faculty_id']);

        // Perform the necessary delete operation using the $faculty_id
        $deleteQuery = "DELETE FROM faculty WHERE id = $faculty_id";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Faculty deleted successfully.";
        } else {
            $_SESSION['message_danger'] = "Error occurred while deletng the faculty.";
        }
    }


if (isset($_POST['addFaculty'])) {
    // Retrieve form data
    $emp_number = mysqli_real_escape_string($conn, $_POST['emp_number']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($conn, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $rank = mysqli_real_escape_string($conn, $_POST['rank']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Perform the database insertion for faculty
    $query_faculty = "INSERT INTO faculty (emp_number, firstName, middleName, lastName, gender, rank, designation, department, status) 
              VALUES ('$emp_number', '$firstName', '$middleName', '$lastName', '$gender', '$rank', '$designation', '$department', '$status')";
    $result_faculty = mysqli_query($conn, $query_faculty);

    if ($result_faculty) {
        // Get the ID of the inserted row
        $id = mysqli_insert_id($conn);

        // Success message for faculty insertion
        $_SESSION['message'] = "Faculty added successfully.";
        
        // Generate password
        $password = $emp_number . $firstName[0] . $lastName[0];
        $hashed_password = md5($password);

        // Convert designation to lowercase
        $designation_lower = strtolower($designation);
        
        // Now, insert into users table with lowercase designation
        $query_users = "INSERT INTO users (username, password, userType, user_id, status, online_status) VALUES ('$emp_number', '$hashed_password', '$designation_lower', '$id', 'enabled', 'offline')";
        $result_users = mysqli_query($conn, $query_users);
        
        if ($result_users) {
            // Success message for users insertion
            $_SESSION['message'] .= " User account created successfully.";
        } else {
            // Error message for users insertion
            $_SESSION['message_danger'] = "Error occurred while creating user account for the faculty.";
        }
        header('Location: faculty.php');
        exit();
    } else {
        // Error message for faculty insertion
        $_SESSION['message_danger'] = "Error occurred while adding the faculty.";
        header('Location: faculty.php');
        exit();
    }
}


    
// edit crew member
   if (isset($_POST['edit_faculty'])) {
        // Get and sanitize form data
        $faculty_id = mysqli_real_escape_string($conn, $_POST['edit_faculty_id']);
        $emp_number = mysqli_real_escape_string($conn, $_POST['edit_emp_number']);
        $firstName = mysqli_real_escape_string($conn, $_POST['edit_firstName']);
        $middleName = mysqli_real_escape_string($conn, $_POST['edit_middleName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['edit_lastName']);
        $gender = mysqli_real_escape_string($conn, $_POST['edit_gender']);
        $rank = mysqli_real_escape_string($conn, $_POST['edit_rank']);
        $designation = mysqli_real_escape_string($conn, $_POST['edit_designation']);
        $department = mysqli_real_escape_string($conn, $_POST['edit_department']);
        $status = mysqli_real_escape_string($conn, $_POST['edit_status']);

        // Perform the database update
        $query = "UPDATE faculty SET 
                    emp_number='$emp_number', 
                    firstName='$firstName', 
                    middleName='$middleName', 
                    lastName='$lastName', 
                    gender='$gender', 
                    rank='$rank', 
                    designation='$designation', 
                    department='$department', 
                    status='$status'
                  WHERE id='$faculty_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Faculty updated successfully.";
            header('Location: faculty.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update faculty.";
            header('Location: faculty.php');
            exit();
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: faculty.php");
        exit();
    }

    } else {
    header("Location: ../admin_login.php");
    exit();
    }
    ?>
