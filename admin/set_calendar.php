<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';
?>
<style>
  /* Selected tab text color */
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #0d6efd;
    background-color: var(--bs-nav-tabs-link-active-bg);
    border-color: var(--bs-nav-tabs-link-active-border-color);
  }
  /* Non-selected tab text color */
  .nav-link:not(.active) {
    color: black;
  }
</style>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Set Up Calendar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Get Started</li>
          <li class="breadcrumb-item active">Set Up Calendar</li>
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


       <!--  add academic calendar -->
        <div class="modal fade" id="add_academic" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi bi-calendar-plus"></i>&nbsp; Add New Academic Calendar
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->
                 <form action="crud_academic.php" method="POST">

                  <p>Note: Creating a new academic calendar disables editing of previous academic calendar data.</p>

                  <div class="row">
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                            <input type="date" class="form-control" id="class_start" name="class_start" placeholder="Your Name" required>
                            <label for="class_start">Class Start</label>
                          </div>
                      </div>

                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                            <input type="date" class="form-control" id="class_end" name="class_end" placeholder="Your Name" required>
                            <label for="class_end">Class End</label>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_academic" class="btn btn-success">Save changes</button>
              </div>

              </form>

            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="delete_calendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editFacultyLabel" style="font-weight: bold;">
                 <i class="bi bi-trash"></i></i>&nbsp; Delete Faculty
              </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <form id="delete_faculty_form" action="crud_faculty.php" method="POST">
              <div class="modal-body">
                <span class="text-danger font-weight-bold">Warning! </span><span>Deleting the faculty <span class="fw-bold" id="delete_faculty_fullname"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                <p>Are you sure you want to proceed with the deletion?</p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="confirm_delete_btn" class="btn btn-primary">Confirm</button>
                <input type="hidden" id="delete_faculty_id" name="delete_faculty_id">
              </div>
               </form>
            </div>
          </div>
        </div>


<section class="section">
    <div class="row">
        <div class="col-lg-12 col-sm-12">
           
            <!-- <small class="text-muted">Note: Previous academic year details cannot be edited after creating a new one.</small> -->
            <div class="card shadow">
                <div class="card-header text-dark py-0 mb-0 d-flex justify-content-between align-items-center" style="background-color: #EDEDED;">
    
                  <a data-bs-toggle="modal" data-bs-target="#add_academic" class="btn btn-default text-primary">
                      <span class="bi bi-calendar-plus fa-sm me-1 d-inline d-sm-none">&nbsp; Create New </span>
                      <span class="bi bi-calendar-plus fa-sm me-1 d-none d-sm-inline">&nbsp; Create New Academic Calendar</span>
                  </a>


                    <nav class="">
                        <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-summary-tab" data-bs-toggle="tab" data-bs-target="#nav-summary" type="button" role="tab" aria-controls="nav-summary" aria-selected="true">Summary</button>
                            <button class="nav-link" id="nav-update-tab" data-bs-toggle="tab" data-bs-target="#nav-update" type="button" role="tab" aria-controls="nav-update" aria-selected="false">Update</button>
                        </div>
                    </nav>
                </div>
                <div class="card-body py-0 mb-0">

                  <!-- Navigation Start -->
                    <div class="tab-content" id="nav-tabContent">
                      <!--  summary Navigation -->
                        <div class="tab-pane fade show active" id="nav-summary" role="tabpanel" aria-labelledby="nav-summary-tab">

                         <?php
                        $no = 1;
                        $query = "SELECT * FROM academic_calendar ORDER BY id DESC LIMIT 1";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $class_start = $row['class_start'];
                                $class_end = $row['class_end'];

                                $semester1_start = $row['1semester_start'];
                                $semester1_end = $row['1semester_end'];
                                $semester2_start = $row['2semester_start'];
                                $semester2_end = $row['2semester_end'];

                                $quarter1_start = $row['1quarter_start'];
                                $quarter1_end = $row['1quarter_end'];

                                $quarter2_start = $row['2quarter_start'];
                                $quarter2_end = $row['2quarter_end'];

                                $quarter3_start = $row['3quarter_start'];
                                $quarter3_end = $row['3quarter_end'];

                                $quarter4_start = $row['4quarter_start'];
                                $quarter4_end = $row['4quarter_end'];

                                $calendar_id = $row['id'];
                        ?>
                        <!-- row start -->
                        <div class="row mt-3">
                            <!-- Academic Year -->
                            <div class="col-lg-12 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                        <span class="fw-bold">Academic Year</span>
                                    </div>
                                    <div class="card-body py-0 px-2 mb-0">
                                        <table class="table table-bordered mb-0">
                                            <tr>
                                                <td style="width: 400px;">Class Start :</td>
                                                <td style="width: 400px;"><?= $row['class_start'] ? date('F j, Y', strtotime($row['class_start'])) : '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Class End :</td>
                                                <td><?= $row['class_end'] ? date('F j, Y', strtotime($row['class_end'])) : '-'; ?></td>
                                            </tr>
                                        </table>
                                        <div class="card-footer mt-0 d-flex justify-content-end py-1">
                                            <!-- additional content can go here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Semestral Period -->
                            <div class="col-lg-12 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                        <span class="fw-bold">Semestral Period</span>
                                    </div>
                                    <div class="card-body py-0 px-2 mb-0">
                                        <table class="table table-bordered mb-0">
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">First Semester :</div>
                                                    </div>
                                                </td>
                                                <td style="width: 400px;">
                                                    <?php 
                                                    if (!empty($row['1semester_start']) && $row['1semester_start'] !== '0000-00-00' && !empty($row['1semester_end']) && $row['1semester_end'] !== '0000-00-00') {
                                                        $start_date = date('F j, Y', strtotime($row['1semester_start']));
                                                        $end_date = date('F j, Y', strtotime($row['1semester_end']));
                                                        echo "$start_date - $end_date";
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-6">Second Semester :</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if (!empty($row['2semester_start']) && $row['2semester_start'] !== '0000-00-00' && !empty($row['2semester_end']) && $row['2semester_end'] !== '0000-00-00') {
                                                        $start_date = date('F j, Y', strtotime($row['2semester_start']));
                                                        $end_date = date('F j, Y', strtotime($row['2semester_end']));
                                                        echo "$start_date - $end_date";
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-footer mt-0 d-flex justify-content-end py-1">
                                            <!-- additional content can go here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quarterly Period -->
                            <div class="col-lg-12 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                        <span class="fw-bold">Quarterly Period</span>
                                    </div>
                                    <div class="card-body py-0 px-2 mb-0">
                                        <table class="table table-bordered mb-0">
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">First Quarter :</div>
                                                    </div>
                                                </td>
                                                <td style="width: 400px;">
                                                    <?php 
                                                    if (!empty($row['1quarter_start']) && $row['1quarter_start'] !== '0000-00-00' && !empty($row['1quarter_end']) && $row['1quarter_end'] !== '0000-00-00') {
                                                        $start_date = date('F j, Y', strtotime($row['1quarter_start']));
                                                        $end_date = date('F j, Y', strtotime($row['1quarter_end']));
                                                        echo "$start_date - $end_date";
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">Second Quarter :</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if (!empty($row['2quarter_start']) && $row['2quarter_start'] !== '0000-00-00' && !empty($row['2quarter_end']) && $row['2quarter_end'] !== '0000-00-00') {
                                                        $start_date = date('F j, Y', strtotime($row['2quarter_start']));
                                                        $end_date = date('F j, Y', strtotime($row['2quarter_end']));
                                                        echo "$start_date - $end_date";
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">Third Quarter :</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if (!empty($row['3quarter_start']) && $row['3quarter_start'] !== '0000-00-00' && !empty($row['3quarter_end']) && $row['3quarter_end'] !== '0000-00-00') {
                                                        $start_date = date('F j, Y', strtotime($row['3quarter_start']));
                                                        $end_date = date('F j, Y', strtotime($row['3quarter_end']));
                                                        echo "$start_date - $end_date";
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">Fourth Quarter :</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if (!empty($row['4quarter_start']) && $row['4quarter_start'] !== '0000-00-00' && !empty($row['4quarter_end']) && $row['4quarter_end'] !== '0000-00-00') {
                                                        $start_date = date('F j, Y', strtotime($row['4quarter_start']));
                                                        $end_date = date('F j, Y', strtotime($row['4quarter_end']));
                                                        echo "$start_date - $end_date";
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-footer mt-0 d-flex justify-content-end py-1">
                                            <!-- additional content can go here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                                $no++;
                            }
                        } else {
                        ?>
                        <!-- row start (default values) -->
                        <div class="row mt-3">
                            <!-- Academic Year -->
                            <div class="col-lg-12 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                        <span class="fw-bold">Academic Year</span>
                                    </div>
                                    <div class="card-body py-0 px-2 mb-0">
                                        <table class="table table-bordered mb-0">
                                            <tr>
                                                <td style="width: 400px;">Class Start :</td>
                                                <td style="width: 400px;"></td>
                                            </tr>
                                            <tr>
                                                <td>Class End :</td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <div class="card-footer mt-0 d-flex justify-content-end py-1">
                                            <!-- additional content can go here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Semestral Period -->
                            <div class="col-lg-12 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                        <span class="fw-bold">Semestral Period</span>
                                    </div>
                                    <div class="card-body py-0 px-2 mb-0">
                                        <table class="table table-bordered mb-0">
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">First Semester :</div>
                                                    </div>
                                                </td>
                                                <td style="width: 400px;"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-6">Second Semester :</div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <div class="card-footer mt-0 d-flex justify-content-end py-1">
                                            <!-- additional content can go here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quarterly Period -->
                            <div class="col-lg-12 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                        <span class="fw-bold">Quarterly Period</span>
                                    </div>
                                    <div class="card-body py-0 px-2 mb-0">
                                        <table class="table table-bordered mb-0">
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">First Quarter :</div>
                                                    </div>
                                                </td>
                                                <td style="width: 400px;"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">Second Quarter :</div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">Third Quarter :</div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 400px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">Fourth Quarter :</div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <div class="card-footer mt-0 d-flex justify-content-end py-1">
                                            <!-- additional content can go here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>








<?php

// Query to get the newest value of class_start and class_end and id columns in academic_calendar table
$sql = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row1 = $result->fetch_assoc();
    $academic_calendar_id = $row1["id"];
    $class_start = $row1["class_start"];
    $class_end = $row1["class_end"];

    // Get months between class_start and class_end
    $start = new DateTime($class_start);
    $end = new DateTime($class_end);
    $interval = new DateInterval('P1M');
    $period = new DatePeriod($start, $interval, $end);

    // Get existing months for the academic year
    $existing_months = [];
    $sql_existing_months = "SELECT monthName FROM months WHERE school_year_id = $academic_calendar_id";
    $result_existing_months = $conn->query($sql_existing_months);
    if ($result_existing_months->num_rows > 0) {
        while ($row2 = $result_existing_months->fetch_assoc()) {
            $existing_months[] = $row2['monthName'];
        }
    }

    // Check if months exist in months table
    foreach ($period as $date) {
        $month = $date->format('F');
        $key = array_search($month, $existing_months);
        if ($key !== false) {
            // Remove existing month from array
            unset($existing_months[$key]);
        } else {
            // Insert month into months table if it doesn't exist
            $sql_insert_month = "INSERT INTO months (monthName, school_year_id) VALUES ('$month', $academic_calendar_id)";
            $conn->query($sql_insert_month);
        }
    }

    // Delete months not in the period
    foreach ($existing_months as $month) {
        $sql_delete_month = "DELETE FROM months WHERE monthName = '$month' AND school_year_id = $academic_calendar_id";
        $conn->query($sql_delete_month);
    }
} else {
    echo "";
}

?>


<div class="col-lg-12 col-sm-12">
    <div class="card shadow">
        <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
<span class="fw-bold">Attendance</span>
</div>
<div class="card-body py-0 px-2 mb-0">
    <table class="table table-bordered mb-0">
        <thead>
            <tr class="text-center">
                <?php
                $query_academic_calendar = "SELECT MAX(id) AS newest_year_id FROM academic_calendar";
                $query_run_academic_calendar = mysqli_query($conn, $query_academic_calendar);

                $months_data = [];

                if ($query_run_academic_calendar && mysqli_num_rows($query_run_academic_calendar) > 0) {
                    $row_academic_calendar = mysqli_fetch_assoc($query_run_academic_calendar);
                    $newest_year_id = $row_academic_calendar['newest_year_id'];

                    if (!empty($newest_year_id)) {
                        // Query to get the class start month
                        $query_class_start_month = "SELECT class_start FROM academic_calendar WHERE id = $newest_year_id";
                        $query_run_class_start_month = mysqli_query($conn, $query_class_start_month);

                        if ($query_run_class_start_month && mysqli_num_rows($query_run_class_start_month) > 0) {
                            $row_class_start_month = mysqli_fetch_assoc($query_run_class_start_month);
                            $class_start_month = date("F", strtotime($row_class_start_month['class_start']));

                            // Build months order array
                            $months = array($class_start_month);
                            for ($i = 1; $i < 12; $i++) {
                                $months[] = date("F", strtotime("$class_start_month + $i month"));
                            }

                            $orderClause = "FIELD(monthName, '" . implode("', '", $months) . "')";

                            // Query to get months + days
                            $query = "SELECT m.monthName, m.daysInMonth
                                      FROM months m
                                      INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
                                      WHERE ac.id = $newest_year_id
                                      ORDER BY $orderClause";
                            $query_run = mysqli_query($conn, $query);

                            if ($query_run && mysqli_num_rows($query_run) > 0) {
                                while ($row1 = mysqli_fetch_assoc($query_run)) {
                                    $months_data[] = $row1;
                                }
                            }
                        } else {
                            echo "<th>No class start month found for the current academic year.</th>";
                        }
                    } else {
                        echo "<th>No data available.</th>";
                    }
                } else {
                    echo "<th>No academic calendar year found.</th>";
                }

                // Print header (month names)
                if (!empty($months_data)) {
                    foreach ($months_data as $row1) {
                        echo "<th>" . $row1["monthName"] . "</th>";
                    }
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr class="text-center">
                <?php
                if (!empty($months_data)) {
                    foreach ($months_data as $row1) {
                        echo "<td style='height: 40px;'>" . $row1["daysInMonth"] . "</td>";
                    }
                }
                ?>
            </tr>
        </tbody>
    </table>
            <div class="card-footer mt-0 d-flex justify-content-end py-1">
                <!-- additional content can go here -->
            </div>
        </div>
    </div>
</div>








 

                        </div>
                       <!-- row end -->


                       <!--  Update Navigation -->
                        <div class="tab-pane fade" id="nav-update" role="tabpanel" aria-labelledby="nav-update-tab">

                          <form action="crud_academic.php" method="POST">

                           <div class="row mt-3">        
                              <div class="col-lg-12 col-sm-12">
                                  <div class="card shadow">
                                      <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                          <span class="fw-bold">Academic Year</span>
                                      </div>
                                      <div class="card-body py-0 px-2 mb-0">
                                          <table class="table table-bordered mb-0">
                                              <tr>
                                                  <td style="width: 600px;">Class Start : </td>
                                                  <td>
                                                    <div>
                                                      <input type="date" class="form-control" name="class_start" id="class_start_1" value="<?= $class_start ?>">
                                                    </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>Class End :</td>
                                                  <td>
                                                    <div>
                                                      <input type="date" class="form-control" name="class_end" id="class_end_1" value="<?= $class_end ?>">
                                                    </div>
                                                  </td>
                                              </tr>
                                          </table>
                                          <div class="card-footer mt-0 d-flex justify-content-end py-2">
                                              <!-- <span>Total number of days:</span> -->
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-lg-12 col-sm-12">
                                  <div class="card shadow">
                                      <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                          <span class="fw-bold">Semestral Period</span>
                                      </div>
                                      <div class="card-body py-0 px-2 mb-0">
                                          <table class="table table-bordered mb-0">
                                              <tr>
                                                  <td style="width: 600px;">First Semester :</td>
                                                  <td>
                                                    <div class="row">
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="1semester_start" id="1semester_start" value="<?= $semester1_start ?>">
                                                          <label for="floatingPassword">Start</label>
                                                        </div>
                                                      </div>
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="1semester_end" value="<?= $semester1_end ?>" id="floatingPassword">
                                                          <label for="floatingPassword">End</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>Second Semester :</td>
                                                  <td>
                                                    <div class="row">
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="2semester_start" value="<?= $semester2_start ?>" id="floatingPassword">
                                                          <label for="floatingPassword">Start</label>
                                                        </div>
                                                      </div>
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="2semester_end" id="2semester_end" value="<?= $semester2_end ?>">
                                                          <label for="floatingPassword">End</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </td>
                                              </tr>
                                          </table>
                                          <div class="card-footer mt-0 d-flex justify-content-end py-1">
                                            
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-lg-12 col-sm-12 mb-0">
                                  <div class="card shadow">
                                      <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                          <span class="fw-bold">Quarterly Period</span>
                                      </div>
                                      <div class="card-body py-0 px-2 mb-0">
                                          <table class="table table-bordered mb-0">
                                              <tr>
                                                  <td style="width: 600px;">First Quarter :</td>
                                                  <td>
                                                    <div class="row">
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="1quarter_start" id="1quarter_start" value="<?= $quarter1_start ?>">
                                                          <label for="floatingPassword">Start</label>
                                                        </div>
                                                      </div>
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="1quarter_end" value="<?= $quarter1_end ?>" id="floatingPassword">
                                                          <label for="floatingPassword">End</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>Second Quarter :</td>
                                                  <td>
                                                    <div class="row">
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="2quarter_start" value="<?= $quarter2_start ?>" id="floatingPassword">
                                                          <label for="floatingPassword">Start</label>
                                                        </div>
                                                      </div>
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="2quarter_end" value="<?= $quarter2_end ?>" id="floatingPassword">
                                                          <label for="floatingPassword">End</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>Third Quarter :</td>
                                                  <td>
                                                    <div class="row">
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="3quarter_start" value="<?= $quarter3_start ?>" id="floatingPassword">
                                                          <label for="floatingPassword">Start</label>
                                                        </div>
                                                      </div>
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="3quarter_end" value="<?= $quarter3_end ?>" id="floatingPassword">
                                                          <label for="floatingPassword">End</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>Fourth Quarter :</td>
                                                  <td>
                                                    <div class="row">
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="4quarter_start" value="<?= $quarter4_start ?>" id="floatingPassword">
                                                          <label for="floatingPassword">Start</label>
                                                        </div>
                                                      </div>
                                                      <div class="col">
                                                        <div class="form-floating">
                                                          <input type="date" class="form-control" name="4quarter_end" id="4quarter_end" value="<?= $quarter4_end ?>">
                                                          <label for="floatingPassword">End</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </td>
                                              </tr>
                                          </table>
                                          <div class="card-footer mt-0 d-flex justify-content-end py-1">
                                             
                                          </div>
                                      </div>
                                  </div>
                              </div>

                                   <input type="hidden" id="calendar_id" name="calendar_id" value="<?= $calendar_id ?>">


                                    <div class="col-lg-12 col-sm-12">
                                        <div class="card shadow">
                                            <div class="card-header text-dark py-1" style="background-color: #EDEDED;">
                                                <span class="fw-bold">Attendance</span>
                                            </div>
                                            <div class="card-body py-0 px-2 mb-0">
                                                <table class="table table-bordered mb-0">
                                                    <thead>
                                                        <tr class="text-center">
                                <?php
                                $query_academic_calendar = "SELECT MAX(id) AS newest_year_id FROM academic_calendar";
                                $query_run_academic_calendar = mysqli_query($conn, $query_academic_calendar);
                                $row_academic_calendar = mysqli_fetch_assoc($query_run_academic_calendar);
                                $newest_year_id = $row_academic_calendar['newest_year_id'];

                                if ($newest_year_id) {
                                    $query_class_start_month = "SELECT class_start FROM academic_calendar WHERE id = $newest_year_id";
                                    $query_run_class_start_month = mysqli_query($conn, $query_class_start_month);
                                    $row_class_start_month = mysqli_fetch_assoc($query_run_class_start_month);
                                    $class_start_month = date("F", strtotime($row_class_start_month['class_start']));

                                    $months = array($class_start_month);
                                    for ($i = 1; $i < 12; $i++) {
                                        $months[] = date("F", strtotime("$class_start_month + $i month"));
                                    }

                                    $orderClause = "FIELD(monthName, '" . implode("', '", $months) . "')";

                                    $query = "SELECT m.id AS month_id, m.monthName, m.daysInMonth 
                                              FROM months m
                                              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
                                              WHERE ac.id = $newest_year_id
                                              ORDER BY $orderClause";

                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($query_run)) {
                                            echo "<th>" . $row1["monthName"] . "</th>";
                                        }
                                    } else {
                                        // Handle case when no months are found
                                        echo "<th>No months found for the academic year.</th>";
                                    }
                                } else {
                                    // Handle case when no academic year ID is found
                                    echo "<th>No data available.</th>";
                                }
                                ?>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="text-center">
                                                            <?php
                                                            $query_run = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                                while ($row1 = mysqli_fetch_assoc($query_run)) {
                                                                    echo "<td><input type='text' class='form-control text-center' name='daysInMonth[" . $row1["month_id"] . "]' value='" . $row1["daysInMonth"] . "' size='2'></td>";
                                                                }
                                                            }
                                                            ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <input type='hidden' name='school_year_id' value="<?php echo $newest_year_id; ?>">
                                                <div class="card-footer mt-0 d-flex justify-content-end py-1">
                                                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   <div class="d-flex justify-content-end mb-2">
                                        <button type="submit" name="edit_calendar" class="btn btn-sm btn-success" style="padding: 5px 10px;">
                                            <i class="bi bi-save me-2"></i> Save Changes
                                        </button>

                                    </div>

                                    </form>

                          </div>
                        </div>
                        <!-- Navigation end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  </main><!-- End #main -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
  // Get references to the input elements
  const classStartInput = document.getElementById('class_start_1');
  const semesterStartInput = document.getElementById('1semester_start');
  const quarterStartInput = document.getElementById('1quarter_start');

  // Function to update other inputs with the same value
  function syncInputs(event) {
    const value = event.target.value;
    classStartInput.value = value;
    semesterStartInput.value = value;
    quarterStartInput.value = value;
  }

  // Add event listeners to all inputs
  classStartInput.addEventListener('change', syncInputs);
  semesterStartInput.addEventListener('change', syncInputs);
  quarterStartInput.addEventListener('change', syncInputs);
</script>

<script>
  // Get references to the input elements
  const classEndInput = document.getElementById('class_end_1');
  const semesterEndInput = document.getElementById('2semester_end');
  const quarterEndInput = document.getElementById('4quarter_end');

  // Function to update other inputs with the same value
  function syncEndInputs(event) {
    const value = event.target.value;
    classEndInput.value = value;
    semesterEndInput.value = value;
    quarterEndInput.value = value;
  }

  // Add event listeners to all inputs
  classEndInput.addEventListener('change', syncEndInputs);
  semesterEndInput.addEventListener('change', syncEndInputs);
  quarterEndInput.addEventListener('change', syncEndInputs);
</script>


<?php 
 }else{
    header("Location: ../admin-portal.php");
    exit();
 }
 ?>
<?php
include('../assets/includes/footer.php');
?>


