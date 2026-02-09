<?php
session_start();
require '../db_conn.php';

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['status'])) {
    // Prepare and execute SQL statement to update status
    $user_id = $_POST['user_id'];
    $status = ($_POST['status'] == '1') ? 'enabled' : 'disabled';

    // Escaping user input to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $status = mysqli_real_escape_string($conn, $status);

    $sql = "UPDATE users SET status='$status' WHERE id='$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Success message
        $_SESSION['message'] = "Account Status updated successfully.";
    } else {
        // Error message
        $_SESSION['message_danger'] = "Error occurred while updating account status.";
    }

    // Redirect to the appropriate page
    header("Location: manage_users.php");
    exit();
}
?>
