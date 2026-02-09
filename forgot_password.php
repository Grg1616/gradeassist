<?php
session_start();
include("db_conn.php");

// Include PHPMailer library
require 'assets/vendor/autoload.php';

use phpmailer\phpmailer\phpmailer;
use phpmailer\phpmailer\Exception;
use phpmailer\phpmailer\SMTP;

require 'assets/vendor/phpmailer/src/phpmailer.php'; 
require 'assets/vendor/phpmailer/src/Exception.php'; 
require 'assets/vendor/phpmailer/src/SMTP.php'; 

// Function to generate a random 6-digit OTP
function generateOTP() {
    return sprintf("%06d", rand(0, 999999));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['send_otp'])) {
        $email = $_POST['email'];
        $uname = isset($_SESSION['uname']) ? $_SESSION['uname'] : ''; // Check if uname is set, if not, assign an empty string
        $uname = isset($_POST['username']) ? $_POST['username'] : $uname; // Use username input if provided

        $sql = "SELECT email FROM users WHERE email = '$email' AND  username = '$uname' ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Email exists, generate and store OTP in session
            $otp = generateOTP();
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;

            // Create a new PHPMailer instance
            $mail = new phpmailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'garbagegomenrolian@gmail.com'; // Change to your SMTP username
                $mail->Password = 'cwsj yowg seot eyhr'; // Change to your SMTP password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Sender information
                $mail->setFrom('garbagegomenrolian@gmail.com', 'MENROLIAN GARBAGEGO');
                
                // Recipient
                $mail->addAddress($email);

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'One-Time Password (OTP)';
                $mail->Body = 'Your OTP is: ' . $otp;

                $mail->send();

                unset($_SESSION['uname']);
                header("Location: verify_otp.php?success=Please verify the OTP that was sent to your email!");
                exit;
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } else {
            // Check if the email exists in the system
            $sql_check_email = "SELECT email FROM users WHERE email = '$email'";
            $result_check_email = $conn->query($sql_check_email);

            if ($result_check_email->num_rows > 0) {
                // Email exists but does not match the provided username
                header("Location: forgot_password.php?error=The email provided does not match the one linked to your account. ");
            } else {
                // Email not found in the system
                header("Location: forgot_password.php?error=Email not found. Please make sure to use the email address that is linked to your account!");
            }
        }

        $conn->close(); // Close the database connection
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GradeAssist - Admin Portal</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/icon.png" rel="icon">
  <link href="assets/img/icon.png" rel="apple-touch-icon">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Favicons -->
  <link href="../assets/img/icon.png" rel="icon">
  <link href="../assets/img/icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
</head>

<body>

<style>
     a {
    text-decoration: none;
}
</style>

<?php
// Check for error and success messages in the URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo '<script>
            window.onload = function() {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "' . $errorMessage . '",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK"
                });
            };
        </script>';
} else if (isset($_GET['success'])) {
    $successMessage = $_GET['success'];
    echo '<script>
            window.onload = function() {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "' . $successMessage . '",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            };
        </script>';
} else if (isset($_SESSION['message'])) {
    $successMessage = $_GET['message'];
    echo '<script>
            window.onload = function() {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "' . $successMessage . '",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            };
        </script>';
} else if (isset($_SESSION['message_danger'])) {
    $successMessage = $_GET['message_danger'];
    echo '<script>
            window.onload = function() {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "' . $successMessage . '",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            };
        </script>';
}
?>

 <div class="container mt-5 px-1"> 
    <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-12">
            <div class="card shadow">
                <img src="assets/img/header1.png" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="assets/img/logo.png" class="image-left mb-3" style="width: 57px; height: 43px;">
                        </div>
                        <div class="col">
                            <div class="col-10">
                                <div class="row mr-2">
                                    <span style="font-size: 20px; font-weight: bold; color: #FF8A00;">GradeAssist</span> 
                                </div>
                                <div class="row">
                                    <span class="small text-dark" style="margin-left: 1px; font-size: 9px; margin-bottom: 23px;">Web-based Grade Entry & Reporting System</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 30px;">
                        <h3>Forgot Password?</h3>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <small>Please provide the email associated with your account to receive a verification code.</small>
                </div>
                <div class="card-footer" style="background-color: #FFFFFF">
                    <div class="row justify-content-center">
                        <div class="col-sm-9 mt-5 mb-5" style="background-color: #FFFFFF;"> <!-- Adjusted for small devices -->
                            <div class="card mb-3 shadow px-0">
                                <div class="card-body">
                                    <div class="pt-0 pb-0">
                                        <h6 class="card-title pb-0 fs-5" style="color: #1F1F1F; font-weight: 400;">Forgot Password?</h6>
                                    </div>
                                    <hr>
                                     <form class="user"  method="POST">

                                        <?php if (!isset($_SESSION['uname'])) : ?>
                                        <div class="col-12 mt-3">
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" placeholder="Enter username" class="form-control" id="username" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-12 mt-3">
                                            <div class="input-group has-validation">
                                                <input type="email" name="email" placeholder="Enter email" class="form-control" id="email" required>
                                                <div class="invalid-feedback">Please enter your email.</div>
                                            </div>
                                        </div>

                                         <div class="col-12 mt-3 d-flex justify-content-center">
                                            <button type="submit" name="send_otp" id="signInButton" class="btn btn-sm btn-primary px-3" style="background-color: #4CAF50; border-color: #4CAF50; font-size: 14px; font-weight: normal; border-radius: 20px;">
                                                Send OTP
                                            </button>
                                        </div>
                                        
                                        <hr>
                                        <!-- <div class="col-12">
                                            Already have an account? 
                                            <a href="index.php" class=" text-success">
                                             Login
                                            </a>
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End #main -->

  <!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>




