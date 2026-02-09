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

    <a href="admin_dashboard.php" class="logo align-items-center">
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
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?></span>
          </a><!-- End Profile Image Icon -->

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
                <h6 class="fw-bold mb-0 mt-2" style="color: #000;"><?php echo $_SESSION['username']?></h6>
                <h6 class="small mt-0 text-capitalize"><?php echo $_SESSION['userType']?></h6>
            </div>
        </div>



    </div>
  </div>

<hr>


      <li class="nav-item mt-3">
        <a class="nav-link collapsed" href="admin_dashboard.php">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-folder2-open"></i><span>File Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="faculty.php">
              <i class="bi bi-circle"></i><span>Faculty</span>
            </a>
          </li>
          <li>
            <a href="students.php">
              <i class="bi bi-circle"></i><span>Students</span>
            </a>
          </li>
          <li>
            <a href="subjects.php">
              <i class="bi bi-circle"></i><span>Subjects</span>
            </a>
          </li>
          <li>
            <a href="grading_system.php">
              <i class="bi bi-circle"></i><span>Grading System</span>
            </a>
          </li>
        </ul>
      </li><!-- End file Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#started-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Get Started!</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="started-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="set_calendar.php">
              <i class="bi bi-circle"></i><span>Setup Calendar</span>
            </a>
          </li>
          
          <li>
              <a href="class.php">
                  <i class="bi bi-circle"></i><span>Add Class</span>
              </a>
          </li>

             <?php
      require '../db_conn.php';

      // Check if academic calendar exists
      $query = "SELECT MAX(id) AS max_calendar_id FROM academic_calendar";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $max_calendar_id = $row['max_calendar_id'];

      // Check if classes exist for the latest academic year
      $query = "SELECT MAX(class.id) AS max_class_id
                FROM class
                WHERE class.school_year_id = (SELECT MAX(academic_calendar.id) FROM academic_calendar)";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $max_class_id = $row['max_class_id'];

      // Faculty Load link
      if ($max_calendar_id) {
          $query = "SELECT MAX(id) AS new_id FROM faculty";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          $faculty_id = isset($row['new_id']) ? $row['new_id'] : '';

          $faculty_load = "faculty_load.php?faculty_id=$faculty_id";
      } else {
          $faculty_load = "#";
      }

      // Class Load link
      if ($max_calendar_id && $max_class_id) {
          $class_load = "class_load.php?class_id=$max_class_id";
      } else {
          $class_load = "#";
      }
      ?>

      <!-- Faculty Loading link -->
      <li>
          <a href="<?php echo $faculty_load; ?>" <?php if (!$max_calendar_id) echo 'data-toggle="tooltip" title="Please setup Calendar and Add Class First"'; ?>>
              <i class="bi bi-circle"></i><span>Faculty Loading</span>
          </a>
      </li>

      <!-- Class Loading link -->
      <li>
          <a href="<?php echo $class_load; ?>" <?php if (!$max_calendar_id || !$max_class_id) echo 'data-toggle="tooltip" title="Please setup Calendar and Add Class First"'; ?>>
              <i class="bi bi-circle"></i><span>Class Loading</span>
          </a>
      </li>

        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="reports.php">
          <i class="bi bi-file-text"></i>
          <span>Reports</span>
        </a>
      </li><!-- End Tables Nav -->

      <li class="nav-heading">Others</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="manage_users.php">
          <i class="bi bi-people"></i>
          <span>Manage Users</span>
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

