<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['verify_otp'])) {
        $userEnteredOTP = $_POST['otp'];

        // Check if the userEnteredOTP matches the stored OTP
        if (isset($_SESSION['otp']) && $_SESSION['otp'] === $userEnteredOTP) {
            // Retrieve the email from the session
            $email = $_SESSION['email'];
            
            // Unset the OTP from the session after successful verification
            unset($_SESSION['otp']);

            // Pass the email to the reset_password.php page using a query parameter
            header('Location: reset_password.php?email=' . urlencode($email) . '&success=OTP verification successful. You can now reset your password!');
            exit;
        } else {
            header("Location: verify_otp.php?error=Invalid One-Time Password. Please try again.");
        }
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
                        <h3>Verification</h3>
                    </div>
                </div>
                <div class="card-footer text-secondary text-center">
                    <small>We have send you a code to verify your email address</small>
                </div>
                <div class="card-footer" style="background-color: #FFFFFF">
                    <div class="row justify-content-center">
                        <div class="col-sm-9 mt-5 mb-5" style="background-color: #FFFFFF;"> <!-- Adjusted for small devices -->
                            <div class="card mb-3 shadow px-0">
                                <div class="card-body">
                                    <div class="pt-0 pb-0">
                                        <h6 class="card-title pb-0 fs-5" style="color: #1F1F1F; font-weight: 400;">Verification</h6>
                                    </div>
                                    <hr>
                                     <form class="user"  method="POST">

                                        <div class="col-12 mt-1">
                                            <div class="input-group has-validation">
                                                <input type="text" name="otp" placeholder="Enter One-Time Password" class="form-control" id="otp" required>
                                                <div class="invalid-feedback">Please enter One-Time Password</div>
                                            </div>
                                        </div>

                                         <div class="col-12 mt-3 d-flex justify-content-center">
                                            <button type="submit" name="verify_otp" id="signInButton" class="btn btn-sm btn-primary px-3" style="background-color: #4CAF50; border-color: #4CAF50; font-size: 14px; font-weight: normal; border-radius: 20px;">
                                                </i> Validate
                                            </button>
                                        </div>
                                        
                                        <hr>
                                        <div class="col-12">
                                            Don't receive the otp? 
                                            <a href="forgot_password.php" class=" text-success">
                                             Resend
                                            </a>
                                        </div>
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


