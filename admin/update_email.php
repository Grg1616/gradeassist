<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && $_SESSION['userType'] === 'admin') {

    require '../db_conn.php';

    if (isset($_POST['update_email'])) {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $user_id = mysqli_real_escape_string($conn, $_SESSION['id']);

        // Check if the email already exists
        $check_query = "SELECT * FROM users WHERE email='$email' AND id != '$user_id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Email already exists, show error message
            $_SESSION['email_exist'] = "Email address is already in use. Please choose a different one.";
            header("Location: admin_dashboard.php");
            exit();
        }

        // Perform the database update
        $query = "UPDATE users SET 
                    email='$email'
                  WHERE id='$user_id'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            unset($_SESSION['email_completion']); // Clear the session message after displaying it
            $_SESSION['message'] = "Email added successfully.";
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to add your email.";
            header("Location: admin_dashboard.php");
            exit();
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: admin_dashboard.php");
        exit();
    }

} else {
    header("Location: ../admin-portal.php");
    exit();
}
?>
