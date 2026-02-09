<?php
session_start();
include("db_conn.php");

function redirectToLogin($errorMsg) {
    header("Location: login.php?error=" . urlencode($errorMsg));
    exit;
}

if (!isset($_SESSION['email'])) {
    redirectToLogin("Session expired or invalid. Please log in again.");
}

$email = $_SESSION['email'];

$sql = "SELECT userType FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    redirectToLogin("Failed to retrieve userType.");
}

$row = mysqli_fetch_assoc($result);
$userType = $row['userType'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        header("Location: reset_password.php?error=Passwords do not match.");
        exit;
    }

    $hashedPassword = md5($newPassword);

    $sql = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";

    if (!mysqli_query($conn, $sql)) {
        $errorMsg = "Password update failed: " . mysqli_error($conn);
        redirectToLogin($errorMsg);
    }

    unset($_SESSION['email']);

    $redirectMessage = "Password reset was successful! You can now log in using your new password.";

    switch ($userType) {
        case 'admin':
            header("Location: admin-portal.php?success=" . urlencode($redirectMessage));
            exit;
        case 'principal':
        case 'faculty':
        case 'registrar':
            header("Location: faculty-portal.php?success=" . urlencode($redirectMessage));
            exit;
        case 'student':
        case 'parent':
            header("Location: index.php?success=" . urlencode($redirectMessage));
            exit;
        default:
            redirectToLogin("Unknown userType.");
    }
}

mysqli_close($conn);
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
                        <h3>Reset Password</h3>
                    </div>
                </div>
                <div class="card-footer text-secondary text-center">
                    <small>New password must not match previous passwords.</small>
                </div>
                <div class="card-footer" style="background-color: #FFFFFF">
                    <div class="row justify-content-center">
                        <div class="col-sm-9 mt-5 mb-5" style="background-color: #FFFFFF;"> <!-- Adjusted for small devices -->
                            <div class="card mb-3 shadow px-0">
                                <div class="card-body">
                                    <div class="pt-0 pb-0">
                                        <h6 class="card-title pb-0 fs-5" style="color: #1F1F1F; font-weight: 400;">Reset Password</h6>
                                    </div>
                                    <hr>
                                     <form class="user"  method="POST">
                                        <input type="hidden" name="email" id="email" class="form-control form-control-user" value="<?php echo $email; ?>" readonly>
                                        <div class="col-12 mt-2">
                                            <div class="input-group">
                                                <input type="password" name="new_password" id="new_password" placeholder="Enter new password" class="form-control" required onkeyup="checkPasswordStrength()">
                                                <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="new_password" style="border-color: #dee2e6;">
                                                    <i class="bi bi-eye" id="passwordIcon"></i>
                                                </button>
                                            </div>
                                            <div id="password-strength" class="password-strength ml-5"></div>
                                            <div id="password-suggestions" class="password-suggestions"></div>
                                            <div class="invalid-feedback">Please enter your new password!</div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="input-group">
                                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" class="form-control" required onkeyup="checkPasswordMatch()">
                                                <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="confirm_password" style="border-color: #dee2e6;">
                                                    <i class="bi bi-eye" id="passwordIcon"></i>
                                                </button>
                                            </div>
                                            <div id="password-match-message" class="small"></div>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                         <div class="col-12 mt-3 d-flex justify-content-center">
                                            <button type="submit" name="reset_password" id="signInButton" class="btn btn-sm btn-primary px-3" style="background-color: #4CAF50; border-color: #4CAF50; font-size: 14px; font-weight: normal; border-radius: 20px;">
                                                </i> Reset Password
                                            </button>
                                        </div>
                                        
                                        <hr>
                                        <!-- <div class="col-12">
                                            Don't receive the otp? 
                                            <a href="forgot_password.php" class=" text-success">
                                             Resend
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

 <style>
  .password-strength {
    margin-top: 5px;
    font-size: 12px;
  }
  .weak {
    color: #dc3545; /* Bootstrap 4 danger color */
  }
  .medium {
    color: #ffc107; /* Bootstrap 4 warning color */
  }
  .strong {
    color: #28a745; /* Bootstrap 4 success color */
  }
  .password-suggestions {
    margin-top: 8px;
    font-size: 13px;
  }
</style>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>

 <script>
    function checkPasswordStrength() {
        var password = document.getElementById("new_password").value;
        var passwordStrength = document.getElementById("password-strength");
        var passwordSuggestions = document.getElementById("password-suggestions");

        var weakRegex = /^.{0,5}$/;
        var mediumRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;
        var strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_#^+=(){}[\]|\\:;"'<>,.~`]).{8,}$/;

        if (strongRegex.test(password)) {
            passwordStrength.textContent = "Strong password";
            passwordStrength.className = "password-strength strong";
            passwordSuggestions.innerHTML = "";
        } else if (mediumRegex.test(password)) {
            passwordStrength.textContent = "Medium password";
            passwordStrength.className = "password-strength medium";
            passwordSuggestions.innerHTML = "<ul><li>Add special characters, uppercase, and lowercase letters</li></ul>";
        } else if (weakRegex.test(password)) {
            passwordStrength.textContent = "Weak password";
            passwordStrength.className = "password-strength weak";
            passwordSuggestions.innerHTML = "<ul><li>Make it longer, include numbers, uppercase and lowercase letters, and special characters</li></ul>";
        } else {
            passwordStrength.textContent = "Password is too short";
            passwordStrength.className = "password-strength";
            passwordSuggestions.innerHTML = "<ul><li>Make it at least 8 characters long, include uppercase and lowercase letters, numbers, and special characters</li></ul>";
        }
    }

    function checkPasswordMatch() {
        var password = document.getElementById("new_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        var matchMessage = document.getElementById("password-match-message");

        if (password === confirmPassword) {
            matchMessage.innerHTML = "Passwords match";
            matchMessage.style.color = "#28a745"; 
        } else {
            matchMessage.innerHTML = "Passwords do not match";
            matchMessage.style.color = "#dc3545"; 
        }
    }

    var passwordToggleButtons = document.querySelectorAll('.password-toggle-btn');

    passwordToggleButtons.forEach(function(button) {
        button.addEventListener('click', function () {
            var targetId = this.getAttribute('data-target');
            var passwordInput = document.getElementById(targetId);
            var passwordIcon = this.querySelector('i'); // Change class name from '.password-icon' to 'i'

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        });
    });
</script>
</body>

</html>