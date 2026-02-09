<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GradeAssist - Faculty Portal</title>
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
echo "<script>";
echo "localStorage.clear();"; // This line clears all data from local storage
echo "</script>";
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
                        <h3>Faculty Portal</h3>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <small>Faculty Portal Login</small>
                </div>
                <div class="card-footer" style="background-color: #FFFFFF">
                    <div class="row justify-content-center">
                        <div class="col-sm-9 mt-5 mb-5" style="background-color: #FFFFFF;"> <!-- Adjusted for small devices -->
                            <div class="card mb-3 shadow px-0">
                                <div class="card-body">
                                    <div class="pt-0 pb-0">
                                        <h6 class="card-title pb-0 fs-5" style="color: #1F1F1F; font-weight: 400;">Please Login</h6>
                                    </div>
                                    <hr>
                                     <form class="user" action="faculty_login_auth.php" method="post" id="login-form">
                                        <div class="col-12 mt-1">
                                            <div class="input-group has-validation">
                                                <input type="text" name="uname" placeholder="Username" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="input-group">
                                                <input type="password" name="password" placeholder="Password" class="form-control" id="yourPassword" required>
                                                <button class="btn btn-outline-secondary" type="button" id="passwordToggle" style="border-color: #dee2e6;">
                                                    <i id="passwordIcon" class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <span class="mt-1" style=" font-size: 10px;">* Password is case sensitive</span>

                                        <div class="col-12 mt-3 d-flex justify-content-center">
                                            <button type="submit" id="signInButton" class="btn btn-sm btn-primary px-3" style="background-color: #FFC700; border-color: #FFC700; font-size: 14px; font-weight: normal; border-radius: 20px;" disabled>
                                                <i class="bi bi-box-arrow-in-right mr-2"></i> Sign in
                                            </button>
                                        </div>

                                        <hr>
                                        <div class="col-12">
                                            <button type="button" onclick="window.location.href='forgot_password.php'" class="btn btn-sm btn-outline-default text-success" style="background-color: #F1F1F1;">
                                                <i class="bi bi-question-square mr-2"></i> Forgot Password? Click here
                                            </button>
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
<script>
document.getElementById('passwordToggle').addEventListener('click', function () {
    var passwordInput = document.getElementById('yourPassword');
    var passwordIcon = document.getElementById('passwordIcon');

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
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const signInButton = document.getElementById('signInButton');
    const usernameInput = document.getElementById('yourUsername');
    const passwordInput = document.getElementById('yourPassword');

    function checkInputs() {
        const usernameValue = usernameInput.value.trim();
        const passwordValue = passwordInput.value.trim();

        if (usernameValue !== '' && passwordValue !== '') {
            signInButton.disabled = false;
            signInButton.style.backgroundColor = '#4CAF50';
            signInButton.style.borderColor = '#4CAF50';
        } else {
            signInButton.disabled = true;
            signInButton.style.backgroundColor = '#FFC700';
            signInButton.style.borderColor = '#FFC700';
        }
    }

    usernameInput.addEventListener('input', checkInputs);
    passwordInput.addEventListener('input', checkInputs);
});
</script>
</body>

</html>


