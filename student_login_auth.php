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
    //$recaptcha_response = $_POST['g-recaptcha-response'];

    if (empty($uname) || empty($pass)) {
        header("Location: admin-portal.php?error=Username and password are required!");
        exit();
    } else {

        // Verify reCAPTCHA
        //$secretKey = "6LfAFesqAAAAANf3bTW8ePEzt1dfCtTWhoUHh7rZ";
        //$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $recaptcha_response);
        //$responseData = json_decode($verifyResponse);

        //if (!$responseData->success) {
            // reCAPTCHA verification failed
        //    header("Location: index.php?error=Invalid reCAPTCHA. Please try again.");
        //    exit();
        //}

        // Hashing the password
        $pass = md5($pass);

        // Modify SQL query to check for enabled status and userType
        $sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$pass' AND (userType = 'student' OR userType = 'parent')";

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
                    $_SESSION['userType'] = $row['userType'];
                    $_SESSION['user_id'] = $row['user_id'];

                    if (!empty($row['email'])) {
                        $_SESSION['message'] = "You have successfully logged in.";
                        header("Location: student/student_dashboard.php");
                        exit();
                    } else {
                        $_SESSION['email_completion'] = "Please provide your email address to complete your account setup.";
                        header("Location: student/student_dashboard.php");
                        exit();
                    }
                } else {
                    header("Location: index.php?error=Your account is disabled. Please contact the administrator.");
                    exit();
                }
            } else {
                header("Location: index.php?error=Incorrect username or password!");
                exit();
            }
        } else {
            header("Location: index.php?error=Database error. Please try again later.");
            exit();
        }
    }
} else {
    header("Location: index.php?error");
    exit();
}
?>
