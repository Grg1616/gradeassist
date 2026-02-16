<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && $_SESSION['userType'] === 'admin') {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Backup & Restore</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Backup and Restore</li>
      </ol>
    </nav>
  </div>

<script>
<?php
if (isset($_SESSION['message'])) {
    echo "Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{$_SESSION['message']}',
        showConfirmButton: false,
        timer: 2000
    });";
    unset($_SESSION['message']);
}

if (isset($_SESSION['message_danger'])) {
    echo "Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{$_SESSION['message_danger']}',
        showConfirmButton: false,
        timer: 2000
    });";
    unset($_SESSION['message_danger']);
}
?>
</script>

<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-md-12">

      <div class="card shadow-sm border-0" >
        <div class="card-body p-4">

          <h5 class="card-title text-center fw-bold mb-4">
            Backup & Restore Database
          </h5>

          <!-- Backup Button -->
          <button class="btn btn-success w-100 mb-4" onclick="backupDatabase()">
            Backup Database
          </button>

          <!-- Restore Form -->
          <form action="backup_process.php" method="post" enctype="multipart/form-data">

            <!-- File input -->
            <div class="mb-3">
              <label class="form-label text-muted small">Select SQL File:</label>
              <input type="file" name="sql_file" id="sql_file" accept=".sql" class="form-control" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
              <input type="password" name="admin_password" class="form-control" placeholder="Enter Password" required>
            </div>

            <!-- Restore Button -->
            <button type="submit" class="btn btn-primary w-100">
              Restore Database
            </button>

          </form>

        </div>
      </div>

    </div>
  </div>
</section>

</main>

<style>
.card {
  border-radius: 6px;
}
.card-title {
  font-size: 18px;
}
.btn {
  height: 42px;
  font-weight: 500;
}
</style>

<script>
function backupDatabase() {
    window.location.href = "backup_process.php";
}
</script>

<?php 
} else {
    header("Location: ../admin-portal.php");
    exit();
}
include('../assets/includes/footer.php');
?>
