<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_faculty.php');
require '../db_conn.php';
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
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
              timer: 2000,
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
              timer: 2000,
              customClass: {
                  popup: 'my-sweetalert',
              }
          });";
      unset($_SESSION['message_danger']); // Clear the session message after displaying it
  }
  if (isset($_SESSION['email_completion'])) {
    echo "Swal.fire({
            icon: 'info',
            title: 'Email Completion!',
            text: '{$_SESSION['email_completion']}',
            showCancelButton: true,
            confirmButtonText: 'Update Email',
            cancelButtonText: 'Close',
            customClass: {
                popup: 'my-sweetalert'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#updateEmailModal').modal('show'); // Show the modal
            }
        });";

}

  if (isset($_SESSION['email_exist'])) {
    echo "Swal.fire({
            icon: 'error',
            title: 'Email Already Exist!',
            text: '{$_SESSION['email_exist']}',
            showCancelButton: true,
            confirmButtonText: 'Try Again',
            cancelButtonText: 'Close',
            customClass: {
                popup: 'my-sweetalert'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#updateEmailModal').modal('show'); // Show the modal
            }
        });";
    unset($_SESSION['email_exist']); // Clear the session message after displaying it
}
?>
</script>

<!-- Update Modal -->
<div class="modal fade" id="updateEmailModal" tabindex="-1" aria-labelledby="updateEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title" id="updateEmailModalLabel">
                    <i class="bi bi-envelope-at"></i></i>&nbsp; Update Email
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="change_password_form" action="update_email.php" method="POST">
            <div class="modal-body">
                <div class="mb-3">
                    <div class="input-group has-validation">
                        <input type="email" name="email" placeholder="Enter your email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                    </div>
                </div>
            </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="update_email" class="btn btn-success">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

    <section class="section">
      <div class="row align-items-top">

        <div class="col-lg-4 col-sm-12">
          <!-- Card with header and footer -->
          <div class="card">
            <div class="card-body bg-primary rounded-top">
              <div class="row mt-3">
                <div class="col-lg-4 col">
                  <img src="../assets/img/subjects.png" alt="Profile" class="img-fluid" style="width:80px; height: 80px;">
                </div>
                <div class="col-lg-8 col mt-1">
                  <h1 class="fw-bold text-white text-end mb-0" style="color: #012970;">
                  <?php
                  $query = "SELECT subjects.id FROM subjects 
                  JOIN loads ON loads.subject_id = subjects.id 
                  WHERE loads.faculty_id = {$_SESSION['user_id']} ORDER BY subjects.id";
                  $query_run = mysqli_query($conn, $query);
                  $row = mysqli_num_rows($query_run);
                  echo mysqli_num_rows($query_run) ?: "0";
                  ?>
                  </h1>
                  <h5 class="text-white text-end mb-0">Subjects</h5>
                </div>
              </div>
            </div>
            <?php
              require '../db_conn.php';
              $query = "SELECT MAX(id) AS newest_id FROM academic_calendar";
              $result = mysqli_query($conn, $query);
              if ($result) {
                  $row = mysqli_fetch_assoc($result);
                  $school_year = $row['newest_id'];
              } else {
                  $school_year = '';
              }
              $school_year = "class.php?school_year=$school_year";
              ?>
            <a href="<?php echo $school_year; ?>">
            <div class="card-footer">
                <h5 class="text-primary small mb-0 d-inline">View Details</h5>
                   <i class="bi bi-arrow-right-circle text-primary float-end"></i>
            </div>
            </a>

          </div><!-- End Card with header and footer -->
        </div>


         <div class="col-lg-4 col-sm-12">
          <!-- Card with header and footer -->
          <div class="card">
            <div class="card-body bg-danger rounded-top">
              <div class="row mt-3">
                <div class="col-lg-4 col">
                  <img src="../assets/img/students.png" alt="Profile" class="img-fluid" style="width:80px; height: 80px;">
                </div>
                <div class="col-lg-8 col mt-1">
                  <h1 class="fw-bold text-white text-end mb-0" style="color: #012970;">
                  <?php
                  $query = "SELECT DISTINCT students.id FROM students 
                      JOIN class_students ON class_students.student_id = students.id 
                      JOIN loads ON loads.class_id = class_students.class_id 
                      WHERE loads.faculty_id = {$_SESSION['user_id']} ORDER BY students.id";
                  $query_run = mysqli_query($conn, $query);
                  echo mysqli_num_rows($query_run) ?: "0";
                  ?>
                  </h1>
                  <h5 class="text-white text-end mb-0">Students</h5>
                </div>
              </div>
            </div>
            <?php
              require '../db_conn.php';
              $query = "SELECT MAX(id) AS newest_id FROM academic_calendar";
              $result = mysqli_query($conn, $query);
              if ($result) {
                  $row = mysqli_fetch_assoc($result);
                  $school_year = $row['newest_id'];
              } else {
                  $school_year = '';
              }
              $school_year = "class.php?school_year=$school_year";
              ?>
            <a href="<?php echo $school_year; ?>">
            <div class="card-footer">
                <h5 class="text-danger small mb-0 d-inline">View Details</h5>
                   <i class="bi bi-arrow-right-circle text-danger float-end"></i>
            </div>
            </a>

          </div><!-- End Card with header and footer -->
        </div>

          <div class="col-lg-4 col-sm-12">
          <!-- Card with header and footer -->
          <div class="card">
            <div class="card-body bg-success rounded-top">
              <div class="row mt-3">
                <div class="col-lg-4 col">
                  <img src="../assets/img/classes.png" alt="Profile" class="img-fluid" style="width:80px; height: 80px;">
                </div>
                <div class="col-lg-8 col mt-1">
                  <h1 class="fw-bold text-white text-end mb-0" style="color: #012970;">
                    <?php
                    $query = "SELECT id FROM loads WHERE faculty_id = {$_SESSION['user_id']} ORDER BY id";
                    $query_run = mysqli_query($conn, $query);
                    $row = mysqli_num_rows($query_run);
                    echo mysqli_num_rows($query_run) ?: "0";
                    ?>
                  </h1>
                  <h5 class="text-white text-end mb-0">Classes</h5>
                  
                </div>
              </div>
            </div>
            <?php
              require '../db_conn.php';
              $query = "SELECT MAX(id) AS newest_id FROM academic_calendar";
              $result = mysqli_query($conn, $query);
              if ($result) {
                  $row = mysqli_fetch_assoc($result);
                  $school_year = $row['newest_id'];
              } else {
                  $school_year = '';
              }
              $school_year = "class.php?school_year=$school_year";
              ?>
            <a href="<?php echo $school_year; ?>">
            <div class="card-footer">
                <h5 class="text-success small mb-0 d-inline">View Details</h5>
                   <i class="bi bi-arrow-right-circle text-success float-end"></i>
            </div>
            </a>

          </div><!-- End Card with header and footer -->
        </div>

      </div>

<?php
if ($_SESSION['userType'] == 'principal') {
    include('analytics.php');
}
?>

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

