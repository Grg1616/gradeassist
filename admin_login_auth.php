<?php
session_start();
include("db_conn.php");

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $_SESSION['uname'] = $uname;
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: admin-portal.php?error=Username and password are required!");
        exit();
    } else {

        // Hashing the password
        $pass = md5($pass);

        // Modify SQL query to check for enabled status and admin userType
        $sql = "SELECT * FROM users WHERE username = '$uname' AND password='$pass' AND userType='admin'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['status'] === 'enabled') {
                    // Update user's online status to 'online'
                    $userId = $row['id'];
                    $updateSql = "UPDATE users SET online_status = 'online' WHERE id = $userId";
                    mysqli_query($conn, $updateSql);

                    // Set session variables
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['image'] = $row['image'];
                    $_SESSION['userType'] = $row['userType'];
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['message'] = "You have successfully logged in.";
                    
                    if (!empty($row['email'])) {
                        $_SESSION['message'] = "You have successfully logged in.";
                        header("Location: admin/admin_dashboard.php");
                        exit();
                    } else {
                        $_SESSION['email_completion'] = "Please provide your email address to complete your account setup.";
                        header("Location: admin/admin_dashboard.php");
                        exit();
                    }
                } else {
                    header("Location: admin-portal.php?error=Your account is disabled. Please contact the administrator.");
                    exit();
                }
            } else {
                header("Location: admin-portal.php?error=Incorrect username or password.");
                exit();
            }
        } else {
            header("Location: admin-portal.php?error=Database error. Please try again later.");
            exit();
        }
    }
} else {
    header("Location: admin-portal.php?error");
    exit();
}
?>
