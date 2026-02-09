<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {

require '../db_conn.php';

if (isset($_POST['change_profile'])) {
    $id = $_SESSION['id'];

    // Getting the post values
    $ppic = $_FILES["image"]["name"];
    $oldppic = $_POST['oldpic'];
    $oldprofilepic = "../uploads" . "/" . $oldppic;

    // Get the image extension
    $extension = strtolower(substr($ppic, -4)); // Convert extension to lowercase

    // Allowed extensions
    $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

    if (!in_array($extension, $allowed_extensions)) {
        $_SESSION['message_danger'] = "Invalid format. Only jpg / jpeg / png / gif format allowed";
        header('Location: account_settings.php');
        exit();
    } else {
        // Rename the image file
        $imgnewfile = md5($ppic . time()) . $extension;

        // Code for moving image into directory
        move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $imgnewfile);

        // Set session for the new image
        $_SESSION['image'] = $imgnewfile;

        // Query for data insertion
        $query = mysqli_query($conn, "UPDATE users SET image='$imgnewfile' WHERE id='$id'");

        if ($query) {
            // Delete old pic
            unlink($oldprofilepic);
            $_SESSION['message'] = "Profile Picture updated successfully.";
            header('Location: account_settings.php');
            exit();
        } else {
            $_SESSION['message_danger'] = "Something Went Wrong. Please try again";
            header('Location: account_settings.php');
            exit();
        }
    }
}

if (isset($_POST['update_account_settings'])) {
    $new_username = mysqli_real_escape_string($conn, $_POST['username']);
    $new_email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_id = $_SESSION['id'];

    // Check if the new username already exists
    $check_username_query = "SELECT * FROM users WHERE username = '$new_username' AND id != $user_id";
    $username_result = $conn->query($check_username_query);
    if ($username_result->num_rows > 0) {
        $_SESSION['message_danger'] = "Username already exists. Please choose a different username.";
                header('Location: account_settings.php');
                exit();
    } else {
        // Check if the new email is not empty and already exists
        if (!empty($new_email)) {
            $check_email_query = "SELECT * FROM users WHERE email = '$new_email' AND id != $user_id";
            $email_result = $conn->query($check_email_query);
            if ($email_result->num_rows > 0) {
                $_SESSION['message_danger'] = "Email already exists. Please choose a different email address.";
                header('Location: account_settings.php');
                exit();
            } else {
                // Update the database
                $update_query = "UPDATE users SET username = '$new_username', email = '$new_email' WHERE id = $user_id";
                if ($conn->query($update_query) === TRUE) {
                     // Success message
                    $_SESSION['message'] = "Account information updated successfully.";
                    header('Location: account_settings.php');
                    exit();
                } else {
                    // Error message
                    $_SESSION['message_danger'] = "Failed to update academic calendar.";
                    header('Location: account_settings.php');
                    exit();
                }
            }
        } else {
            // Update the database if the email is empty
            $update_query = "UPDATE users SET username = '$new_username', email = NULL WHERE id = $user_id";
            if ($conn->query($update_query) === TRUE) {
                 $_SESSION['message'] = "Account information updated successfully.";
                header('Location: account_settings.php');
                exit();
            } else {
                $_SESSION['message_danger'] = "Failed to update academic calendar.";
                header('Location: account_settings.php');
                exit();
            }
        }
    }
}
    

if (isset($_POST['edit_password'])) {
    $current_password = md5($_POST['current_password']);
    $new_password = ($_POST['new_password']);
    $confirm_password = ($_POST['confirm_password']);

    $user_id = $_SESSION['id'];
    // Check if current password matches actual password in database
    $query = "SELECT * FROM users WHERE id='$user_id' AND password='$current_password'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows == 1) { // Check if current password is correct
      if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_#^+=(){}[\]|\\:;"\'<>,.~`]).{8,}$/',$new_password)) {
        // Check if new password and confirm password match
        if ($new_password === $confirm_password) {
          // Update user's password in database
          $new_password = md5($new_password);

          $query = "UPDATE users SET password='$new_password' WHERE id='$user_id'";
          mysqli_query($conn, $query);

          header("Location: ../admin-portal.php?success=Password updated successfully! Please log in with your new password.");
          exit(0);
        } else {
          $_SESSION['message_danger'] = "New Password and Confirm Password do not match";
          header("Location: account_settings.php");
          exit(0);
        }
      } else {
        $_SESSION['message_danger'] = "New Password must contain at least one uppercase letter, one lowercase letter, one number, and one of the following special characters: _ - # and be at least 8 characters long";
        header("Location: account_settings.php");
        exit(0);
      }
    } else {
        $_SESSION['message_danger'] = "Current Password is incorrect";
        header("Location: account_settings.php");
        exit(0);
    }
}

if (isset($_POST['edit_profile'])) {
    $faculty_id = $_SESSION['user_id'];
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($conn, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $rank = mysqli_real_escape_string($conn, $_POST['rank']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);

    // Perform the database update
    $query = "UPDATE faculty SET 
                firstName='$firstName', 
                middleName='$middleName', 
                lastName='$lastName', 
                gender='$gender', 
                rank='$rank', 
                designation='$designation', 
                department='$department', 
              WHERE id='$faculty_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Success message
        $_SESSION['message'] = "Profile updated successfully.";
        header('Location: account_settings.php');
        exit();
    } else {
        // Error message
        $_SESSION['message_danger'] = "Failed to update profile.";
        header('Location: account_settings.php');
        exit();
    }
} else {
    // Redirect to the appropriate page if the form is not submitted
    header("Location: account_settings.php");
    exit();
}

} else {
header("Location: ../admin_login.php");
exit();
}
?>