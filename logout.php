<?php
session_start();
include("db_conn.php");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Fetch user details from the database
    $userId = $_SESSION['id'];
    $userQuery = "SELECT userType FROM users WHERE id = $userId";
    $userResult = mysqli_query($conn, $userQuery);
    if ($userResult) {
        $userData = mysqli_fetch_assoc($userResult);
        $userType = $userData['userType'];
        
        // Update the user's online status to 'offline' in the database
        $updateSql = "UPDATE users SET online_status = 'offline' WHERE id = $userId";
        mysqli_query($conn, $updateSql);
        
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();

        // Redirect based on userType
        switch ($userType) {
            case 'student':
            case 'parent':
                header("Location: index.php");
                exit();
            case 'admin':
                header("Location: admin-portal.php");
                exit();
            case 'faculty':
            case 'registrar':
            case 'principal':
            case 'chairperson':
                header("Location: faculty-portal.php");
                exit();
            default:
                header("Location: index.php");
                exit();
        }
    }
}
?>
