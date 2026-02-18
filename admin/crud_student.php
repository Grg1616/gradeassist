<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

require '../db_conn.php';

    if (isset($_POST['delete_student_id'])) {
        $student_id = mysqli_real_escape_string($conn, $_POST['delete_student_id']);

        // Perform the necessary delete operation using the $student_id
        $deleteQuery = "DELETE FROM students WHERE id = $student_id";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Student deleted successfully.";
        } else {
            $_SESSION['message_danger'] = "Error occurred while deletng the student.";
        }
    }

    // Add student
    if (isset($_POST['add_student'])) {
    // Retrieve form data
    $sr_code = mysqli_real_escape_string($conn, $_POST['sr_code']);
    $lrn = mysqli_real_escape_string($conn, $_POST['lrn']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($conn, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $homeAddress = mysqli_real_escape_string($conn, $_POST['homeAddress']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $fatherName = mysqli_real_escape_string($conn, $_POST['fatherName']);
    $fatherOccupation = mysqli_real_escape_string($conn, $_POST['fatherOccupation']);
    $fatherContact = mysqli_real_escape_string($conn, $_POST['fatherContact']);
    $fatherEmail = mysqli_real_escape_string($conn, $_POST['fatherEmail']);
    $motherName = mysqli_real_escape_string($conn, $_POST['motherName']);
    $motherOccupation = mysqli_real_escape_string($conn, $_POST['motherOccupation']);
    $motherContact = mysqli_real_escape_string($conn, $_POST['motherContact']);
    $motherEmail = mysqli_real_escape_string($conn, $_POST['motherEmail']);
    $guardianName = mysqli_real_escape_string($conn, $_POST['guardianName']);
    $guardianOccupation = mysqli_real_escape_string($conn, $_POST['guardianOccupation']);
    $guardianContact = mysqli_real_escape_string($conn, $_POST['guardianContact']);
    $guardianEmail = mysqli_real_escape_string($conn, $_POST['guardianEmail']);
    // remove optional date fields; they aren't used in insertion
    // $dateCreated and $dateUpdated are not expected in the add form

    // trim and normalize the key fields
    $sr_code = trim($sr_code);
    $lrn = trim($lrn);
    $firstName = trim($firstName);
    $lastName = trim($lastName);

    // check for duplicate sr_code
    if ($sr_code !== '' ) {
        $q = "SELECT 1 FROM students WHERE sr_code='$sr_code' LIMIT 1";
        $r = mysqli_query($conn, $q);
        if ($r && mysqli_num_rows($r) > 0) {
            $_SESSION['message_danger'] = "A student with SR code $sr_code already exists.";
            header('Location: students.php');
            exit();
        }
    }

    // check for duplicate lrn
    if ($lrn !== '') {
        $q = "SELECT 1 FROM students WHERE lrn='$lrn' LIMIT 1";
        $r = mysqli_query($conn, $q);
        if ($r && mysqli_num_rows($r) > 0) {
            $_SESSION['message_danger'] = "A student with LRN $lrn already exists.";
            header('Location: students.php');
            exit();
        }
    }

    // check for duplicate name pair
    if ($firstName !== '' && $lastName !== '') {
        $q = "SELECT 1 FROM students WHERE firstName='$firstName' AND lastName='$lastName' LIMIT 1";
        $r = mysqli_query($conn, $q);
        if ($r && mysqli_num_rows($r) > 0) {
            $_SESSION['message_danger'] = "A student named $firstName $lastName already exists.";
            header('Location: students.php');
            exit();
        }
    }

    // Perform the database insertion for students
    $query = "INSERT INTO students 
              (sr_code, lrn, firstName, middleName, lastName, gender, birthday, contactNumber, homeAddress, email, religion, fatherName, fatherOccupation, fatherContact, fatherEmail, motherName, motherOccupation, motherContact, motherEmail, guardianName, guardianOccupation, guardianContact, guardianEmail)
              VALUES 
              ('$sr_code', '$lrn', '$firstName', '$middleName', '$lastName', '$gender', '$birthday', '$contactNumber', '$homeAddress', '$email', '$religion', '$fatherName', '$fatherOccupation', '$fatherContact', '$fatherEmail', '$motherName', '$motherOccupation', '$motherContact', '$motherEmail', '$guardianName', '$guardianOccupation', '$guardianContact', '$guardianEmail')";
              
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Retrieve the last inserted student ID
        $id = mysqli_insert_id($conn);

        // Generate student and parent passwords
        $sr_code_numeric = preg_replace('/[^0-9]/', '', $sr_code);
        $student_password = $sr_code_numeric . strtoupper(substr($firstName, 0, 1)) . strtoupper(substr($lastName, 0, 1));
        $student_hash_password = md5($student_password);

        $parent_password = $sr_code_numeric;
        $parent_hash_password = md5($parent_password);

        $userTypeStudent = "student";
        $userTypeParent = "parent";

        // Insert student account into users table
        $query_student = "INSERT INTO users 
                          (username, password, email, userType, user_id, status, online_status) 
                          VALUES 
                          ('$sr_code', '$student_hash_password', '$email', '$userTypeStudent', '$id', 'enabled', 'offline')";
        $result_student = mysqli_query($conn, $query_student);

        // Insert parent account into users table
        $query_parent = "INSERT INTO users 
                         (username, password, email, userType, user_id, status, online_status) 
                         VALUES 
                         ('$sr_code', '$parent_hash_password', '$email', '$userTypeParent', '$id', 'enabled', 'offline')";
        $result_parent = mysqli_query($conn, $query_parent);

        if ($result_student && $result_parent) {
            // Success message
            $_SESSION['message'] = "Student and account added successfully.";
        } else {
            // Error message for account creation
            $_SESSION['message_danger'] = "Student added, but account creation failed.";
        }
        header('Location: students.php');
        exit();
    } else {
        // Error message
        $_SESSION['message_danger'] = "Error occurred while adding the student.";
        header('Location: students.php');
        exit();
    }
}
    
    // edit student
    if (isset($_POST['edit_student'])) {
            // Get and sanitize form data
            $student_id = mysqli_real_escape_string($conn, $_POST['edit_student_id']);
            $sr_code = mysqli_real_escape_string($conn, $_POST['edit_sr_code']);
            $lrn = mysqli_real_escape_string($conn, $_POST['edit_lrn']);
            $firstName = mysqli_real_escape_string($conn, $_POST['edit_firstName']);
            $middleName = mysqli_real_escape_string($conn, $_POST['edit_middleName']);
            $lastName = mysqli_real_escape_string($conn, $_POST['edit_lastName']);
            $gender = mysqli_real_escape_string($conn, $_POST['edit_gender']);
            $birthday = mysqli_real_escape_string($conn, $_POST['edit_birthday']);
            $contactNumber = mysqli_real_escape_string($conn, $_POST['edit_contactNumber']);
            $homeAddress = mysqli_real_escape_string($conn, $_POST['edit_homeAddress']);
            $email = mysqli_real_escape_string($conn, $_POST['edit_email']);
            $religion = mysqli_real_escape_string($conn, $_POST['edit_religion']);
            $fatherName = mysqli_real_escape_string($conn, $_POST['edit_fatherName']);
            $fatherOccupation = mysqli_real_escape_string($conn, $_POST['edit_fatherOccupation']);
            $fatherContact = mysqli_real_escape_string($conn, $_POST['edit_fatherContact']);
            $fatherEmail = mysqli_real_escape_string($conn, $_POST['edit_fatherEmail']);
            $motherName = mysqli_real_escape_string($conn, $_POST['edit_motherName']);
            $motherOccupation = mysqli_real_escape_string($conn, $_POST['edit_motherOccupation']);
            $motherContact = mysqli_real_escape_string($conn, $_POST['edit_motherContact']);
            $motherEmail = mysqli_real_escape_string($conn, $_POST['edit_motherEmail']);
            $guardianName = mysqli_real_escape_string($conn, $_POST['edit_guardianName']);
            $guardianOccupation = mysqli_real_escape_string($conn, $_POST['edit_guardianOccupation']);
            $guardianContact = mysqli_real_escape_string($conn, $_POST['edit_guardianContact']);
            $guardianEmail = mysqli_real_escape_string($conn, $_POST['edit_guardianEmail']);

            // prevent duplicates when editing (ignore current record)
            $checkQuery = "SELECT * FROM students WHERE (lrn = '$lrn' OR sr_code = '$sr_code' OR (firstName = '$firstName' AND lastName = '$lastName')) AND id <> '$student_id'";
            $checkResult = mysqli_query($conn, $checkQuery);
            if (mysqli_num_rows($checkResult) > 0) {
                $_SESSION['message_danger'] = "Another student with the same SR code, LRN, or name already exists.";
                header('Location: students.php');
                exit();
            }

            // Perform the database update
            $query = "UPDATE students SET 
                        sr_code='$sr_code', 
                        lrn='$lrn', 
                        firstName='$firstName', 
                        middleName='$middleName', 
                        lastName='$lastName', 
                        gender='$gender', 
                        birthday='$birthday', 
                        contactNumber='$contactNumber', 
                        homeAddress='$homeAddress', 
                        email='$email', 
                        religion='$religion', 
                        fatherName='$fatherName', 
                        fatherOccupation='$fatherOccupation', 
                        fatherContact='$fatherContact', 
                        fatherEmail='$fatherEmail', 
                        motherName='$motherName', 
                        motherOccupation='$motherOccupation', 
                        motherContact='$motherContact', 
                        motherEmail='$motherEmail', 
                        guardianName='$guardianName', 
                        guardianOccupation='$guardianOccupation', 
                        guardianContact='$guardianContact', 
                        guardianEmail='$guardianEmail'
                      WHERE id='$student_id'";
                      
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Success message
                $_SESSION['message'] = "Student updated successfully.";
                header('Location: students.php');
                exit();
            } else {
                // Error message
                $_SESSION['message_danger'] = "Failed to update student.";
                header('Location: students.php');
                exit();
            }
        } else {
            // Redirect to the appropriate page if the form is not submitted
            header("Location: students.php");
            exit();
        }


    } else {
    header("Location: ../admin_login.php");
    exit();
    }
    ?>
