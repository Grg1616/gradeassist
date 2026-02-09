<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && $_SESSION['userType'] === 'admin') {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';
?>
 <?php
if (isset($_SESSION['id'])) {
    // Check if session variable 'id' is set
    $user_id = $_SESSION['id'];

    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $admin = mysqli_fetch_assoc($result);
            // Change $row to $admin
            if (!isset($admin['image']) || empty($admin['image'])) {
                $profile_picture = "../assets/img/user.png";
            } else {
                $profile_picture = "../uploads/" . $admin['image'];
            }
        }
    }
}
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Account Settings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Account Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

<script>
        <?php
        // Check if the session message exists and show it as a SweetAlert
        if (isset($_SESSION['message'])) {
            echo "Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{$_SESSION['message']}',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        popup: 'my-sweetalert',
                    }
                });";
            unset($_SESSION['message']); // Clear the session message after displaying it
        }

        if (isset($_SESSION['message_danger'])) {
            echo "Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{$_SESSION['message_danger']}',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        popup: 'my-sweetalert',
                    }
                });";
            unset($_SESSION['message_danger']); // Clear the session message after displaying it
        }
        ?>
    </script>

<div class="modal fade" id="change_image" tabindex="-1" aria-labelledby="changeImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="changeImageLabel" style="font-weight: bold;">
                    <i class="bi bi-funnel"></i>&nbsp; Filter Option
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form method="POST" enctype="multipart/form-data" id="imageForm" action="crud_account.php">
                    <?php
                    $id = $_SESSION['id'];
                    $ret = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
                    while ($row = mysqli_fetch_array($ret)) {
                        $profile_picture = empty($row['image']) ? "../assets/img/user.png" : "../uploads/" . $row['image'];
                    ?>
                        <input type="hidden" name="oldpic" value="<?php echo $row['image']; ?>">
                        <div class="form-group text-center">
                            <img id="previewImage" src="<?= $profile_picture ?>" alt="Profile Picture" class="rounded-circle" width="300" style="border-radius: 50%; width: 300px; height: 300px;">
                        </div>
                        <div class="form-group px-4">
                            <div class="form-group mt-2 col-md-12">
                                <input type="file" id="image" name="image" class="form-control" id="customFile" placeholder=" " onchange="previewFile()" required>
                                <span style="color:red; font-size:12px;">Only jpg / jpeg / png / gif format allowed.</span>
                            </div>
                        </div>
                    <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="change_profile" class="btn btn-success">Apply Filter</button>
            </div>
            </form>
        </div>
    </div>
</div>
    
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <div style="position: relative;">
                  <img src="<?= isset($profile_picture) ? $profile_picture : '../assets/img/user.png' ?>" alt="Profile Picture" class="rounded-circle mb-3" 
                  width="100" style="border-radius: 50%; width: 100px; height: 100px;">
              </div>
              <span>
                  <h2>
                      <?php
                      require '../db_conn.php';

                      if(isset($_SESSION['id'])) { // Check if session variable 'id' is set
                          $user_id = $_SESSION['id'];

                          $query = "SELECT * FROM users WHERE id = $user_id";
                          $result = mysqli_query($conn, $query);

                          if ($result) {
                              if (mysqli_num_rows($result) > 0) {
                                  $admin = mysqli_fetch_assoc($result);
                                  // Display the faculty information
                      ?>
                                  <h2 class='fw-bold mb-0 mt-2' style='color: #000;'><?php echo $admin['username']; ?></h2>

                                  <!-- Wrap the designation in a div and apply CSS to center it -->
                                  <div style='text-align: center;'>
                                      <h3 class='small mt-0'><?php echo $admin['userType']; ?></h3>
                                  </div>
                      <?php
                              } else {
                      ?>
                                  <h6 class='fw-bold mb-0 mt-2' style='color: #000;'>User Full Name</h6>
                                  <h3 class='small mt-0'>Designation</h3>
                      <?php
                              }
                          } else {
                              echo "Error executing query: " . mysqli_error($conn);
                          }
                      } else {
                          echo "Session variable 'id' is not set.";
                      }
                      ?>
                  </h2>
              </span>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
           <ul class="nav nav-tabs nav-tabs-bordered">
<!--               <li class="nav-item">
                <button id="profile-overview-tab" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li> -->
              <li class="nav-item">
                <button id="profile-edit-tab" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
              <li class="nav-item">
                <button id="profile-settings-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li>
              <li class="nav-item">
                <button id="profile-change-password-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>
            </ul>


              <div class="tab-content pt-2">


                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form>
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                      
                        <div style="position: relative;">
                           <img src="<?= isset($profile_picture) ? $profile_picture : '../assets/img/user.png' ?>" alt="Profile Picture" class="img-thumbnail" width="100" style="width: 100px; height: 100px;">
                        </div>

                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#change_image" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

<?php
$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
    $email = $row["email"];
} else {
    $username = '';
    $email = '';
}
?>
<form action="crud_account.php" method="POST">
<div class="row mb-3">
    <label for="username" class="col-md-4 col-lg-4 col-form-label">Username</label>
    <div class="col-md-8 col-lg-8">
        <input name="username" type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($username); ?>">
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-md-4 col-lg-4 col-form-label">Email</label>
    <div class="col-md-8 col-lg-8">
        <input name="email" type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>">
    </div>
</div>

<div class="text-center">
    <button type="submit" name="update_account_settings" class="btn btn-success">Save Changes</button>
</div>
</form>


                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="crud_account.php" method="POST">

                    <div class="row">
                      <label for="currentPassword" class="col-md-4 col-lg-4 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-8">
                        <div class="input-group">
                            <input type="password" name="current_password" id="current_password" placeholder="Enter current password" class="form-control" required>
                            <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="current_password" style="border-color: #dee2e6;">
                                <i class="bi bi-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <label for="new_password" class="col-md-4 col-lg-4 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-8">
                        <div class="input-group">
                            <input type="password" name="new_password" id="new_password" placeholder="Enter new password" class="form-control" required onkeyup="checkPasswordStrength()">
                            <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="new_password" style="border-color: #dee2e6;">
                                <i class="bi bi-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                        <div id="password-strength" class="password-strength"></div>
                         <div id="password-suggestions" class="password-suggestions"></div>
                      </div>
                    </div>
                    

                    <div class="row mt-2">
                      <label for="confirm_password" class="col-md-4 col-lg-4 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-8">
                        <div class="input-group">
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" class="form-control" required onkeyup="checkPasswordMatch()">
                            <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="confirm_password" style="border-color: #dee2e6;">
                                <i class="bi bi-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                        <div id="password-match-message" class="password-confirm"></div>
                      </div>
                    </div>

                    <span class="text-secondary small mt-2">Please note that you will need to log in again after changing your password.</span> 

                    <div class="text-center">
                      <button type="submit" name="edit_password" class="btn btn-success mt-3">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php 
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: ../faculty-portal.php");
    exit();
}
 ?>
<?php
include('../assets/includes/footer.php');
?>
<style>
  .password-strength {
    margin-top: 5px;
    font-size: 12px;
  }
   .password-confirm {
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
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const editTab = document.getElementById('profile-edit-tab');
    const settingsTab = document.getElementById('profile-settings-tab');
    const changePasswordTab = document.getElementById('profile-change-password-tab');

    const tabItems = [editTab, settingsTab, changePasswordTab];

    tabItems.forEach(tab => {
      tab.addEventListener('click', function() {
        const selectedTabId = tab.getAttribute('id');
        localStorage.setItem('selectedProfileTab', selectedTabId);

        // Remove active class from all tabs
        tabItems.forEach(item => {
          item.classList.remove('active');
        });

        // Add active class to the clicked tab
        tab.classList.add('active');
      });
    });

    const selectedProfileTab = localStorage.getItem('selectedProfileTab');
    if (selectedProfileTab) {
      const selectedTab = document.getElementById(selectedProfileTab);
      if (selectedTab) {
        selectedTab.click(); // Trigger click event to set active tab
      }
    }
  });
</script>

<script>
function previewFile() {
    const preview = document.getElementById('previewImage');
    const fileInput = document.getElementById('image');
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>

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