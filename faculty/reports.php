<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_faculty.php');
require '../db_conn.php';


// Unset 'page' from $_GET array
unset($_GET['page']);

// Unset 'page' from $_SESSION array
unset($_SESSION['page']);

?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Reports</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="navbar_faculty.php">Home</a></li>
          <li class="breadcrumb-item active">Reports</li>
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
            ?>
        </script>

        <style>
@media (max-width: 576px) {
    .card {
        max-width: 100%; /* Set max width to 100% for smaller screens */
    }
} 
.card-link:hover .card {
  background-color: #f6f9ff; /* Background color */
  box-shadow: 0 0 10px rgb(108 117 125); /* Add box-shadow */
}

.card-link:hover .card-text {
  color: #DC3545; /* Text color */
}
.card-link:hover #folderIcon {
  color: #DC3545; /* Icon color */
}


</style>
<section class="section">

  <div class="row align-items-top">
    <div class="col-lg-12 col-sm-12">
      <!-- Card with header and footer -->
      <div class="card shadow mb-4">
        <div class="card-body">
          <h5 class="card-title">Reports Menu</h5>

          <div class="row">


            <div class="col-lg-3 col-sm-12 col-md-6 px-1">
              <div class="card shadow">
                <div class="card-body d-flex">
                  <div class="text-start me-auto mt-3">
                    <!-- Added "me-auto" class to push this div to the start of the flex container -->
                    <h6 class="small mb-4">Summary of Final Grades<br>&nbsp;</h6>
                    <a href="report_filter.php?page=Summary_of_Final_Grades.php" class="btn btn-outline-secondary btn-sm">
                      <i class="bi bi-file-earmark-arrow-down me-2"></i>Generate Report</a>
                  </div>
                  <img src="../assets/img/Fgrades.png" class="align-self-end ms-auto" alt="Image" style="width: 65px; height: auto;">
                  <!-- Added "ms-auto" class to push this image to the end of the flex container -->
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-12 col-md-6 px-1">
              <div class="card shadow">
                <div class="card-body d-flex">
                  <div class="text-start me-auto mt-3">
                    <!-- Added "me-auto" class to push this div to the start of the flex container -->
                    <h6 class="small mb-4">List of Learners <br>with Academic Excellence</h6>
                    <a href="report_filter.php?page=List_of_Learners_with_Academic_Excellence.php" class="btn btn-outline-secondary btn-sm">
                      <i class="bi bi-file-earmark-arrow-down me-2"></i>Generate Report</a>
                  </div>
                  <img src="../assets/img/excellence.png" class="align-self-end ms-auto" alt="Image" style="width: 57px; height: auto;">
                  <!-- Added "ms-auto" class to push this image to the end of the flex container -->
                </div>
              </div>
            </div>

<?php 
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['userType'];

    // Assuming you have already created a connection to the database in $conn
    $query = "SELECT faculty_id FROM loads WHERE faculty_id = $user_id";
    $result = $conn->query($query);
    $show_reports = $result && $result->num_rows > 0; // Check if query was successful and returned rows
?>

<?php if ($show_reports || $user_type !== 'registrar'): ?>
    <div class="col-lg-3 col-sm-12 col-md-6 px-1">
        <div class="card shadow">
            <div class="card-body d-flex">
                <div class="text-start me-auto mt-3">
                    <!-- Added "me-auto" class to push this div to the start of the flex container -->
                    <h6 class="small mb-4">List of Learners <br>Subject for Probation</h6>
                    <a href="report_filter.php?page=List_of_Learners_Subject_for_Probation.php" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-file-earmark-arrow-down me-2"></i>Generate Report
                    </a>
                </div>
                <img src="../assets/img/probation.png" class="align-self-end ms-auto" alt="Image" style="width: 57px; height: auto;">
                <!-- Added "ms-auto" class to push this image to the end of the flex container -->
            </div>
        </div>
    </div>
<?php endif; ?>


            <div class="col-lg-3 col-sm-12 col-md-6 px-1">
              <div class="card shadow">
                <div class="card-body d-flex">
                  <div class="text-start me-auto mt-3">
                    <!-- Added "me-auto" class to push this div to the start of the flex container -->
                    <h6 class="small mb-4">Learner’s Report Card <br>(Form 138)</h6>
                    <a href="report_filter.php?page=Form_138.php" class="btn btn-outline-secondary btn-sm">
                      <i class="bi bi-file-earmark-arrow-down me-2"></i>Generate Report</a>
                  </div>
                  <img src="../assets/img/f138.png" class="align-self-end ms-auto" alt="Image" style="width: 57px; height: auto;">
                  <!-- Added "ms-auto" class to push this image to the end of the flex container -->
                </div>
              </div>
            </div>

            <?php
for ($i = 0; $i < 17; $i++) {
    echo "<br>";
}
?>


          </div>

        </div>
      </div>
    </div>
  </div>

</section>


  </main><!-- End #main -->


<?php 
 }else{
    header("Location: ../faculty-portal.php");
    exit();
 }
 ?>
<?php
include('../assets/includes/footer.php');
?>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll('.nav-link');

    tabs.forEach(tab => {
      tab.addEventListener('click', function() {
        const selectedTabId = this.getAttribute('id');
        const selectedTab = document.getElementById(selectedTabId);
        const tabContentId = selectedTab.getAttribute('data-bs-target').substring(1);
        const tabContent = document.getElementById(tabContentId);

        // Deselect all tabs
        tabs.forEach(tab => {
          tab.classList.remove('active');
          tab.setAttribute('aria-selected', 'false');
        });

        // Hide all tab contents
        document.querySelectorAll('.tab-pane').forEach(content => {
          content.classList.remove('active', 'show');
        });

        // Select the clicked tab
        selectedTab.classList.add('active');
        selectedTab.setAttribute('aria-selected', 'true');

        // Show the corresponding tab content
        tabContent.classList.add('active', 'show');

        // Store selected tab in local storage
        localStorage.setItem('selectedTab', selectedTabId);
      });
    });

    // Retrieve and select the last active tab from local storage
    const selectedTabId = localStorage.getItem('selectedTab');
    if (selectedTabId) {
      const selectedTab = document.getElementById(selectedTabId);
      if (selectedTab) {
        selectedTab.click();
      }
    }
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  var cardLinks = document.querySelectorAll('.card-link');

  cardLinks.forEach(function(cardLink) {
    var folderIcon = cardLink.querySelector('.bi');

    cardLink.addEventListener("mouseover", function() {
      folderIcon.classList.remove('bi-folder2');
      folderIcon.classList.add('bi-folder2-open');
    });

    cardLink.addEventListener("mouseout", function() {
      folderIcon.classList.remove('bi-folder2-open');
      folderIcon.classList.add('bi-folder2');
    });
  });
});
</script>