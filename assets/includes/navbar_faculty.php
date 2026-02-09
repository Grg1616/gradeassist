  <!-- Sign Out Confirmation Modal -->
    <div class="modal fade" id="signOutModal" tabindex="-1" aria-labelledby="signOutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signOutModalLabel">Confirm Log Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-success" href="../logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">

    <a href="faculty_dashboard.php" class="logo align-items-center">
        <div class="row align-items-center px-3">
            <div class="col-2 d-flex justify-content-center align-items-center ml-3">
                <img class="mt-3" src="../assets/img/icon.png" alt="">
            </div>
            <div class="col-10">
                <div class="row">
                  <span class="mt-3" style="color: #FF8A00;">GradeAssist</span>

                </div>
                <div class="row">
                    <span class="d-none d-lg-block small text-dark" style="margin-left: 1px; font-size: 7px;">Web-based Grade Entry & Reporting System</span>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="d-none d-lg-block text-dark small mb-3" id="clock"></div>
        </div>
    </a>

<script>
function updateClock() {
    var now = new Date();
    var month = now.toLocaleString('en-US', { month: 'long' });
    var day = now.getDate();
    var year = now.getFullYear();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds(); // Add seconds
    var ampm = hour >= 12 ? 'pm' : 'am';
    hour = hour % 12;
    hour = hour ? hour : 12; // Handle midnight
    minute = minute < 10 ? '0' + minute : minute; // Add leading zero to minutes if necessary
    second = second < 10 ? '0' + second : second; // Add leading zero to seconds if necessary
    var currentTime = month + ' ' + day + ', ' + year + ' | ' + hour + ':' + minute + ':' + second + ' ' + ampm; // Include seconds
    document.getElementById('clock').textContent = currentTime;
}

// Update the clock every second
setInterval(updateClock, 1000);

// Initial call to display the clock immediately
updateClock();
</script>





      <i class="bi bi-list toggle-sidebar-btn"></i>




    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        

        

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img 
                  src="<?php echo isset($_SESSION['image']) && !empty($_SESSION['image']) ? '../uploads/' . $_SESSION['image'] : '../assets/img/user.png'; ?>" 
                  alt="Profile Picture" 
                  class="rounded-circle"
                  width="30" style="width:30px; height: 30px;"
                  onerror="this.onerror=null;this.src='../assets/img/user.png';"
              >
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username']?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
           <!--  <li>
              <hr class="dropdown-divider">
            </li> -->

            <li>
              <a class="dropdown-item d-flex align-items-center" href="account_settings.php">
                <i class="bi bi-person"></i>
                <span>Account</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../logout.php" data-bs-toggle="modal" data-bs-target="#signOutModal">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Log Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">



        <div class="row">
            <div class="col-md-4 col-auto align-self-center d-flex justify-content-center px-0">
                <img 
                  src="<?php echo isset($_SESSION['image']) && !empty($_SESSION['image']) ? '../uploads/' . $_SESSION['image'] : '../assets/img/user.png'; ?>" 
                  alt="Profile Picture" 
                  class="img-fluid rounded-circle px-0" 
                  width="50" style="width:50px; height: 50px;"
                  onerror="this.onerror=null;this.src='../assets/img/user.png';"
              >
            </div>

            <div class="col-md-8 col-auto align-self-center px-0">
                <?php
                require '../db_conn.php';
                $user_id = $_SESSION['user_id'];

                $query = "SELECT firstName, middleName, lastName, designation FROM faculty WHERE id = $user_id";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $faculty = mysqli_fetch_assoc($result);
                        // Display the faculty information
                        echo "<h6 class='fw-bold mb-0 mt-2' style='color: #000;'>{$faculty['firstName']} {$faculty['middleName'][0]}. {$faculty['lastName']}</h6>";

                        echo "<h6 class='small mt-0'>{$faculty['designation']}</h6>";
                    } else {
                        echo "<h6 class='fw-bold mb-0 mt-2' style='color: #000;'>User Full Name</h6>";
                        echo "<h6 class='small mt-0'>Designation</h6>";
                    }
                } else {
                    echo "Error executing query: " . mysqli_error($conn);
                }
                ?>
            </div>
        </div>



    </div>
  </div>

<hr>


      <li class="nav-item mt-3">
        <a class="nav-link collapsed" href="faculty_dashboard.php">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Profile Page Nav -->

      


   <?php 
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['userType'];

    // Assuming you have already created a connection to the database in $conn
    $query = "SELECT faculty_id FROM loads WHERE faculty_id = $user_id";
    $result = $conn->query($query);
    $show_reports = $result && $result->num_rows > 0; // Check if query was successful and returned rows
?>
<?php if ($show_reports): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="class.php">
            <i class="bi bi-book"></i>
            <span>Classes</span>
        </a>
    </li>
<?php endif; ?>



      <li class="nav-item">
        <a class="nav-link collapsed" href="reports.php">
          <i class="bi bi-file-text"></i>
          <span>Reports</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="downloads.php">
          <i class="bi bi-download"></i>
          <span>Downloads</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="account_settings.php">
          <i class="bi bi-gear"></i>
          <span>Account Settings</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-bs-toggle="modal" data-bs-target="#signOutModal">
          <i class="bi bi-box-arrow-right"></i>
          <span>Logout</span>
        </a>

      </li><!-- End Contact Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

