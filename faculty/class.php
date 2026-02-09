<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_faculty.php');
require '../db_conn.php';
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Classes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="faculty_dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Classes</li>
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
                        timer: 1000,
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
                        timer: 1000,
                        customClass: {
                            popup: 'my-sweetalert',
                        }
                    });";
                unset($_SESSION['message_danger']); // Clear the session message after displaying it
            }
            ?>
        </script>


        <!-- add class -->
        <div class="modal fade" id="add_class" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                          <i class="bi bi-plus-circle"></i>&nbsp; Add Class
                      </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_class.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="section" name="section" placeholder="Section Name" required>
                                <label for="section">Section Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <span>Grade Offering</span>
                                <div class="row px-2 mt-2">
                                    <?php
                                    $grades = ["Kinder", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6", "Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12"];
                                    
                                    // Split grades into two arrays for two columns
                                    $first_column_grades = array_slice($grades, 0, 7);
                                    $second_column_grades = array_slice($grades, 7);
                                    
                                    // Function to generate radio buttons
                                    function generateRadioButtons($grades) {
                                        foreach ($grades as $grade) {
                                            echo '<div class="col">';
                                            echo '<div class="form-check">';
                                            echo '<input class="form-check-input" type="radio" name="gradeLevel" id="' . strtolower(str_replace(' ', '', $grade)) . '" value="' . $grade . '" required>';
                                            echo '<label class="form-check-label" for="' . strtolower(str_replace(' ', '', $grade)) . '">' . $grade . '</label>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                    
                                    // Generate first column
                                    echo '<div class="col">';
                                    generateRadioButtons($first_column_grades);
                                    echo '</div>';
                                    
                                    // Generate second column
                                    echo '<div class="col">';
                                    generateRadioButtons($second_column_grades);
                                    echo '</div>';
                                    ?>
                                </div>
                                <div class="invalid-feedback">
                                    Please select a valid grade level
                                </div>
                            </div>


                            <div class="form-floating mb-3">
                               <select id="faculty_id" name="faculty_id" class="form-select" aria-label="Select Adviser">
                                  <option disabled selected>Select Adviser</option>
                                  <?php
                                  $query_faculty = "SELECT id, firstName, middleName, lastName FROM faculty";
                                  $query_run_faculty = mysqli_query($conn, $query_faculty);
                                  if (mysqli_num_rows($query_run_faculty) > 0) {
                                      while ($row = mysqli_fetch_assoc($query_run_faculty)) {
                                          $firstName = $row['firstName'];
                                          $middleName = $row['middleName'];
                                          $lastName = $row['lastName'];

                                          // Construct the full name with spaces before initials
                                          $facultyLabel = $firstName . ($middleName ? ' ' . strtoupper(substr($middleName, 0, 1)) . '. ' : '') . strtoupper(substr($lastName, 0, 1)) . substr($lastName, 1);

                                          echo '<option value="' . $row['id'] . '">' . $facultyLabel . '</option>';
                                      }
                                  }
                                  ?>
                               </select>
                                <label for="faculty_id">Adviser</label>
                               
                            </div>

                            <input type="hidden" id="school_year_id" name="school_year_id">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_class" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>   

        <!-- edit class -->
        <div class="modal fade" id="edit_class" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFacultyLabel">Class Settings</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_class.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="edit_section" name="edit_section" placeholder="Section Name" required>
                                <label for="edit_section">Section Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <span>Grade Offering</span>
                                <div class="row px-2 mt-2">
                                          <div class="col">
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel_kinder" value="Kinder" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Kinder</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 1" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 1</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 2" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 2</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 3" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 3</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 4" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 4</label>
                                              </div>
                                          </div>
                                          <div class="col">
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 5" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 5</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 6" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 6</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 7" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 7</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 8" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 8</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 9" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 9</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 10" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 10</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 11" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 11</label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="edit_gradeLevel" id="edit_gradeLevel" value="Grade 12" required>
                                                  <label class="form-check-label" for="edit_gradeLevel">Grade 12</label>
                                              </div>
                                          </div>
                                      </div>
                                <div class="invalid-feedback">
                                    Please select a valid grade level
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <select id="edit_faculty_id" name="edit_faculty_id" class="form-select" aria-label="Select Adviser">
                                    <option disabled selected>Select Adviser</option>
                                    <?php
                                    $query_faculty = "SELECT id, firstName, middleName, lastName FROM faculty";
                                    $query_run_faculty = mysqli_query($conn, $query_faculty);
                                    if (mysqli_num_rows($query_run_faculty) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run_faculty)) {
                                            $firstName = $row['firstName'];
                                            $middleName = $row['middleName'];
                                            $lastName = $row['lastName'];
                                            $facultyLabel = $firstName . ($middleName ? ' ' . strtoupper(substr($middleName, 0, 1)) . '. ' : '') . strtoupper(substr($lastName, 0, 1)) . substr($lastName, 1);
                                            echo '<option value="' . $row['id'] . '">' . $facultyLabel . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="edit_faculty_id">Adviser</label>
                                <div class="invalid-feedback">
                                    Please select a valid adviser.
                                </div>
                            </div>

                            <input type="hidden" id="edit_class_id" name="edit_class_id">
                            <input type="hidden" id="school_year_id" name="school_year_id" value="<?php echo isset($_GET['school_year']) ? $_GET['school_year'] : ''; ?>">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="edit_class" class="btn btn-primary">Update changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="delete_class" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editFacultyLabel" style="font-weight: bold;">
                 <i class="bi bi-trash"></i></i>&nbsp; Remove Class
              </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <form id="delete_class_form" action="crud_class.php" method="POST">
              <div class="modal-body">
                <span class="text-danger font-weight-bold">Warning! </span><span>Removing the Class <span class="fw-bold" id="delete_class_name"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                <p>Are you sure you want to proceed with the deletion?</p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="confirm_delete_btn" class="btn btn-primary">Confirm</button>
                <input type="hidden" id="delete_class_id" name="delete_class_id">
              </div>
               </form>
            </div>
          </div>
        </div>


        <!-- filter -->
        <div class="modal fade" id="filter" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title text-dark" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-funnel"></i>&nbsp; Filter Option
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->
                 <form action="crud_class_filter.php" method="POST">
                  <div class="form-floating mb-3">
                              <select class="form-select" id="school_year" name="school_year" aria-label="State" required>
                                  <option selected disabled value>Select Academic Year</option>
                                  <?php
                                    $selectedOption = isset($_GET['school_year']) ? $_GET['school_year'] : '';

                                    $query_drivers = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY class_start DESC";
                                    $query_run_drivers = mysqli_query($conn, $query_drivers);

                                    if (mysqli_num_rows($query_run_drivers) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run_drivers)) {
                                            $startYear = date('Y', strtotime($row['class_start']));
                                            $endYear = date('Y', strtotime($row['class_end']));
                                            $academicYearLabel = "$startYear-$endYear";

                                            $selected = ($selectedOption == $row['id']) ? 'selected' : '';

                                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $academicYearLabel . '</option>';
                                        }
                                    }
                                    ?>
                              </select>
                              <label for="school_year">Academic Year</label>
                              <div class="invalid-feedback">
                                Please select a valid academic year.
                              </div>
                          </div>
                          <h6 class=" text-dark mt-2 small">Aplied on senior high school only</h6>
                          <div class="form-floating mb-3">
                              <select class="form-select" id="semester" name="semester" aria-label="State" required>
                                  <option selected disabled value>Select Semester (For Senior High School)</option>
                                  <option value="1">First Semester</option>
                                  <option value="2">Second Semester</option>
                              </select>
                              <label for="semester">Semester</label>
                              <div class="invalid-feedback">
                                Please select a valid semester.
                              </div>
                          </div>
                          <input type="hidden" id="quarter" name="quarter">

                          <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']; ?>">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="class_filter" class="btn btn-success">Apply Filter</button>
              </div>

              </form>

            </div>
          </div>
        </div>


<section class="section">

<div class="card shadow">
<div class="card-header justify-content-between px-4">
    <div class="row">
        <div class="col-lg-6 mt-1 col-sm-6 col">
            <form action="" method="GET">
                <div class="d-flex align-items-end justify-content-start"> 
<?php
$user_id = mysqli_real_escape_string($conn, $_SESSION['id']);
$adviser_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

// Check if there's a value of school_year in the filter table for the given faculty_id
$check_query = "SELECT school_year FROM filter WHERE user_id = '$user_id'";
$check_result = mysqli_query($conn, $check_query);

if ($check_result && mysqli_num_rows($check_result) > 0) {
    // If there's a value in the filter table, use the original query
    $sql = "SELECT ac.class_start, ac.class_end, f.school_year, 
                   (SELECT COUNT(DISTINCT subject_id)
                    FROM loads 
                    WHERE school_year_id = f.school_year AND faculty_id = '$adviser_id') AS num_rows
                   
            FROM academic_calendar AS ac
            JOIN filter AS f ON ac.id = f.school_year
            WHERE f.user_id = '$user_id'";
} else {
    // If there's no value in the filter table, use the newest value in academic_calendar
    $sql = "SELECT ac.class_start, ac.class_end, ac.id AS school_year,
                   (SELECT COUNT(DISTINCT subject_id)
                    FROM loads 
                    WHERE school_year_id = ac.id AND faculty_id = '$adviser_id') AS num_rows
                   
            FROM academic_calendar AS ac
            ORDER BY ac.id DESC
            LIMIT 1";
}


$result = mysqli_query($conn, $sql);

$num_ids = 0; // Initialize $num_ids
$school_year_display = "";

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Fetch and process data here
        while ($row = mysqli_fetch_assoc($result)) {

            $num_ids += $row['num_rows']; // Update $num_ids
            $class_start_year = date('Y', strtotime($row['class_start']));
            $class_end_year = date('Y', strtotime($row['class_end']));
            $school_year_display = $class_start_year . '-' . $class_end_year;
            $school_year = $row['school_year'];
        }
    } else {
        // echo "No results found.";
    }
} else {
    // Handle query error
    echo "Error executing query: " . mysqli_error($conn);
}

mysqli_free_result($result);
?>

<h6 class="text-dark mt-2">Total of <span class="fw-bold"><?php echo $num_ids; ?></span> Classes for AY <span class="fw-bold"><?php echo $school_year_display; ?></span></h6>

                </div>
            </form>
        </div>
        <div class="col-lg-6 col-sm-6 mt-1 col">
            
            <div class="d-flex align-items-center justify-content-end"> <!-- Adjusted justify-content-end -->

                <button class="btn btn-sm btn-outline-default shadow-sm text-primary mx-1 edit-filter-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#filter" 
                         <?php
                        $query = "SELECT * FROM filter WHERE user_id = '{$_SESSION['id']}'";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { // Fetch each row from the result set
                                ?>

                                    data-id="<?= $row['id']; ?>" 
                                    data-school-year="<?= $row['school_year']; ?>"
                                    data-semester="<?= $row['semester']; ?>"
                                    data-user_id="<?= $row['user_id']; ?>"
                                    data-quarter="<?= $row['quarter']; ?>"
                                <?php
                            }
                        } else {
                            // Handle case where no rows are returned
                            echo "No data found";
                        }
                        ?>
                        data-bs-tooltip="tooltip" 
                        data-placement="top" 
                        title="Edit">
                    <i class="bi bi-funnel"></i> Filter Option
                </button>
            </div>
        </div>
    </div>
</div>

    <div class="card-body">

      <h5 class="font-weight-bold text-dark mt-3">List of Classes</h5>
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
<!-- Navigation tabs -->
<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
    <!-- List View tab -->
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-list-view-tab" data-bs-toggle="tab" data-bs-target="#pills-list-view" type="button" role="tab" aria-controls="pills-list-view" aria-selected="true">
            <i class="bi bi-list-ul"></i> List View
        </button>
    </li>
    <!-- Table View tab -->
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-table-view-tab" data-bs-toggle="tab" data-bs-target="#pills-table-view" type="button" role="tab" aria-controls="pills-table-view" aria-selected="false">
            <i class="bi bi-table"></i> Table View
        </button>
    </li>
</ul>

<script>
    document.addEventListener("DOMContentLoaded", function() {
  const listViewTab = document.getElementById('pills-list-view-tab');
  const tableViewTab = document.getElementById('pills-table-view-tab');

  [listViewTab, tableViewTab].forEach(tab => {
    tab.addEventListener('click', function() {
      localStorage.setItem('selectedTab', tab.getAttribute('id'));
    });
  });

  const selectedTab = localStorage.getItem('selectedTab');
  if (selectedTab) {
    document.getElementById(selectedTab).click();
  }
});
</script>

<!-- Tab content -->
<div class="tab-content" id="myTabContent">
    <!-- List View tab content -->
   <div class="tab-pane fade show active" id="pills-list-view" role="tabpanel" aria-labelledby="pills-list-view-tab">
        <!-- Card inside List View tab -->
        <div class="card shadow">
            <div class="card-body">
                <?php
                if (!empty($school_year)) {
                // Fetch total number of records
                $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
                $school_year = mysqli_real_escape_string($conn, $school_year);
                $total_query = "SELECT COUNT(*) as total FROM loads 
                                LEFT JOIN class ON loads.class_id = class.id
                                WHERE loads.faculty_id = '$user_id' AND loads.school_year_id = '$school_year'";
                $total_result = mysqli_query($conn, $total_query);
                $total_row = mysqli_fetch_assoc($total_result);
                $total_records = $total_row['total'];

                // Define the number of records per page
                $records_per_page = 8;
                $total_pages = ceil($total_records / $records_per_page);

                // Get the current page from the URL, if not present default to 1
                $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                if($current_page < 1) $current_page = 1;
                if($current_page > $total_pages) $current_page = $total_pages;

                // Calculate the starting record of the current page
                // Calculate the starting record of the current page
    $start_from = ($current_page - 1) * $records_per_page;
    if ($start_from < 0) {
        $start_from = 0;
    }

    // Fetch records for the current page
    $query = "SELECT class.id as class_id, class.*, faculty.firstName, faculty.middleName, faculty.lastName, subjects.courseCode, subjects.courseTitle, loads.id as load_id, loads.mapeh_name
              FROM loads 
              LEFT JOIN class ON loads.class_id = class.id
              LEFT JOIN faculty ON class.faculty_id = faculty.id
              LEFT JOIN subjects ON loads.subject_id = subjects.id
              WHERE loads.faculty_id = '$user_id' AND loads.school_year_id = '$school_year'
              LIMIT $start_from, $records_per_page";


                $query_run = mysqli_query($conn, $query);

                if (!$query_run) {
                    // Query execution failed
                    echo "Error: " . mysqli_error($conn);
                } else {
                    // Query executed successfully
                    if (mysqli_num_rows($query_run) > 0) {
                        $count = 0; // Initialize counter
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            if ($count % 4 == 0) {
                                // Start a new row every four columns
                                echo "<div class='row mt-3'>";
                                $_SESSION['class_id'] = $row['id'];
                                $_SESSION['school_year'] = $school_year;
                            }
                            ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card shadow">
                                <div class="card-header text-white fw-bold bg-secondary" style="background-color: #EDEDED;">
                                    <h6 class="fw-bold text-start text-truncate mb-0" title="<?php 
                                        if(isset($row['courseCode']) && $row['courseCode'] != '') {
                                            if(isset($row['mapeh_name']) && $row['mapeh_name'] != '') {
                                                echo $row['courseCode'] . ' - ' . $row['mapeh_name'];
                                            } else {
                                                echo $row['courseCode'] . ' - ' . $row['courseTitle'];
                                            }
                                        } else {
                                            echo isset($row['courseTitle']) ? $row['courseTitle'] : '-';
                                        }
                                    ?>">
                                        <?php 
                                        if(isset($row['courseCode']) && $row['courseCode'] != '') {
                                            if(isset($row['mapeh_name']) && $row['mapeh_name'] != '') {
                                                echo $row['courseCode'] . ' - ' . $row['mapeh_name'];
                                            } else {
                                                echo $row['courseCode'] . ' - ' . $row['courseTitle'];
                                            }
                                        } else {
                                            echo isset($row['courseTitle']) ? $row['courseTitle'] : '-';
                                        }
                                        ?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-2">
                                        <div class="col-lg-8 col">
                                            <h6 class=" small fw-bold text-start text-dark mb-0 mt-3 text-uppercase" style="color: #5C5C5C;"><?= $row['gradeLevel'] ?: '-' ?> - <?= $row['section'] ?: '-' ?></h6>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <h1 class="fw-bold text-end mb-0 text-danger">
                                                <?php
                                                $class_id = $row['id']; // Assuming $row['id'] contains the class_id
                                                $sql = "SELECT COUNT(student_id) AS total_students FROM class_students WHERE class_id = $class_id";
                                                // Execute query
                                                $result_students = mysqli_query($conn, $sql);
                                                if ($result_students && mysqli_num_rows($result_students) > 0) {
                                                    $row_students = mysqli_fetch_assoc($result_students);
                                                    echo $row_students["total_students"];
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                            </h1>
                                        </div>
                                    </div>
                                    <h6 class="small text-start mb-0" style="color: <?= ($row['firstName'] && $row['middleName'] && $row['lastName']) ? 'gray' : 'white' ?>">
                                        <?php
                                        if ($row['firstName'] && $row['middleName'] && $row['lastName']) {
                                            echo $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName'];
                                        } else {
                                            echo 'Your default text here';
                                        }
                                        ?>
                                    </h6>
                                    <hr>
                                    <!-- Second Row -->
                                    <div class="row mt-3">
                                        <div class="col-md-12 col">
                                                <a href="class_details.php?load_id=<?= $row['load_id'] ?>&class_id=<?= $row['id'] ?>&school_year=<?= $school_year ?>" class="btn btn-outline-secondary float-end">View Class</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $count++; // Increment counter
                            if ($count % 4 == 0) {
                                // Close row after every four columns
                                echo "</div>";
                            }
                        }
                        // Close row if the loop ended with an open row
                        if ($count % 4 != 0) {
                            echo "</div>";
                        }
                    } else {
                        echo '<div style="text-align: center;">';
                        echo '<div class="h4 mt-4">No records found</div>';
                        echo '<img src="../assets/img/no_data.png" alt="No data available" style="max-width: 300px; max-height: 300px;" />';
                        echo '</div>';
                    }
                }
            } else {
                        echo '<div style="text-align: center;">';
                        echo '<div class="h4 mt-4">No records found</div>';
                        echo '<img src="../assets/img/no_data.png" alt="No data available" style="max-width: 300px; max-height: 300px;" />';
                        echo '</div>';
                    }
                ?>
<?php if (isset($total_pages)): ?> 
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $current_page - 1 ?>" tabindex="-1" aria-disabled="<?= ($current_page == 1) ? 'true' : 'false' ?>">Previous</a>
                        </li>
                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= ($current_page == $i) ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $current_page + 1 ?>">Next</a>
                        </li>
                    </ul>
                </nav>
 <?php endif; ?>                
            </div>
        </div>
    </div>

    <!-- Table View tab content -->
    <div class="tab-pane fade" id="pills-table-view" role="tabpanel" aria-labelledby="pills-table-view-tab">
        <!-- Card inside Table View tab -->
        <div class="card shadow">
            <div class="card-body">
               <?php
               if (!empty($school_year)) {
                $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
                $school_year = mysqli_real_escape_string($conn, $school_year);

                $query = "SELECT class.id AS class_id, 
                                 class.*, 
                                 faculty.firstName, 
                                 faculty.middleName, 
                                 faculty.lastName, 
                                 subjects.courseCode, 
                                 subjects.courseTitle,
                                 loads.id as load_id,
                                 loads.mapeh_name,
                                 academic_calendar.* 
                          FROM loads 
                          LEFT JOIN class ON loads.class_id = class.id
                          LEFT JOIN faculty ON class.faculty_id = faculty.id
                          LEFT JOIN subjects ON loads.subject_id = subjects.id
                          LEFT JOIN academic_calendar ON loads.school_year_id = academic_calendar.id
                          WHERE loads.faculty_id = '$user_id' 
                          AND loads.school_year_id = '$school_year'";

                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                    if (mysqli_num_rows($query_run) > 0) {

                ?>
                        <div class="table-responsive mt-3">
                            <table class="table table-hover table-bordered" style="width: 100%;">
                                <thead>
                                    <tr style="white-space: nowrap;">
                                        <th class="text-center">#</th>
                                        <th class="text-center">School Year</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Grade Level</th>
                                        <th class="text-center">Section</th>
                                        <th>Faculty/Adviser</th>
                                        <th class="text-center">Total Students</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1; // Initialize counter variable
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $class_id = $row['class_id'];
                                        $sql = "SELECT COUNT(student_id) AS total_students FROM class_students WHERE class_id = $class_id";
                                        $result_students = mysqli_query($conn, $sql);
                                        $total_students = ($result_students && mysqli_num_rows($result_students) > 0) ? mysqli_fetch_assoc($result_students)["total_students"] : 0;
                                        $_SESSION['class_id'] = $row['class_id'];
                                        $_SESSION['school_year'] = $school_year;
                                        ?>
                                        <tr class="text small" style="white-space: nowrap;">
                                            <td class="text-center"><?php echo $counter++; ?></td> <!-- Display and increment counter -->
                                            <td class="text-left"><?php echo date('Y', strtotime($row['class_start'])) . '-' . date('Y', strtotime($row['class_end'])); ?></td>
                                            <td class="text-left">
                                                <?php 
                                            if(isset($row['courseCode']) && $row['courseCode'] != '') {
                                                if(isset($row['mapeh_name']) && $row['mapeh_name'] != '') {
                                                    echo $row['courseCode'] . ' - ' . $row['mapeh_name'];
                                                } else {
                                                    echo $row['courseCode'] . ' - ' . $row['courseTitle'];
                                                }
                                            } else {
                                                echo isset($row['courseTitle']) ? $row['courseTitle'] : '-';
                                            }
                                            ?>
                                            </td>
                                            <td class="text-left"><?php echo $row['gradeLevel'] ?: '-'; ?></td>
                                            <td class="text-left"><?php echo $row['section'] ?: '-'; ?></td>
                                            <td ><?php echo ($row['firstName'] && $row['middleName'] && $row['lastName']) ? ($row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName']) : 'Your default text here'; ?>
                                            </td>
                                            <td class="text-center"><?php echo $total_students; ?></td>
                                            <td class="text-center">
                                                <a type="button" href="class_details.php?load_id=<?= $row['load_id'] ?>&class_id=<?= $row['class_id'] ?>&school_year=<?= $school_year ?>" class="btn btn-sm btn-outline-secondary">
                                                    <span class="bi bi-folder"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table> 
                        </div>
                <?php
                    } else {
                        echo '<div style="text-align: center;">';
                        echo '<div class="h4 mt-4">No records found</div>';
                        echo '<img src="../assets/img/no_data.png" alt="No data available" style="max-width: 300px; max-height: 300px;" />';
                        echo '</div>';
                    }
                } else {
                    // Handle query execution failure
                    echo "Error executing query: " . mysqli_error($conn);
                }
            } else {
                        echo '<div style="text-align: center;">';
                        echo '<div class="h4 mt-4">No records found</div>';
                        echo '<img src="../assets/img/no_data.png" alt="No data available" style="max-width: 300px; max-height: 300px;" />';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>




  </div>
</section>



  </main><!-- End #main -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- edit truck function -->

<script>
  $(document).ready(function() {
    $('.add-class-btn').click(function() {
      var school_year_id = $(this).data('id');

      $('#school_year_id').val(school_year_id);
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('.edit-filter-btn').click(function() {
      var filter_id = $(this).data('id');
      var school_year = $(this).data('school-year');
      var semester = $(this).data('semester');
      var quarter = $(this).data('quarter');
      
      $('#filter_id').val(filter_id);
      $('#school_year').val(school_year);
      $('#semester').val(semester);
      $('#quarter').val(quarter);
    });
  });
</script>


<!-- delete truck function -->
</i> <script>
    $(document).ready(function() {
        $('.delete-class-btn').click(function() {
            var class_id = $(this).data('id');
            var gradeLevel = $(this).data('gradelevel');
            var section = $(this).data('section');
           
            $('#delete_class_id').val(class_id);
            $('#delete_class_name').text(gradeLevel + ' - ' + section);
        });

        $('#delete_class_form').submit(function(e) {
            e.preventDefault();
            var class_id = $('#delete_class_id').val();
            $.ajax({
                type: "POST",
                url: "crud_class.php",
                data: {
                    delete_class_id: class_id
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + class_id).hide();

                    // Show a success message with SweetAlert2 toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The class has been deleted successfully.',
                        showConfirmButton: false,
                        timer: 2000, // 2 seconds duration for the toast
                        customClass: {
                            popup: 'my-sweetalert',
                        }
                    });

                    // Refresh the page after a delay (e.g., 2 seconds)
                    setTimeout(function() {
                        location.reload();
                    }, 2000); // 2000 milliseconds = 2 seconds
                },
                error: function(error) {
                    // Handle the error response if needed
                    console.log("Delete error:", error);
                }
            });
        });
    });
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


