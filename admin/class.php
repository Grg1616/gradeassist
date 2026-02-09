<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';

unset($_SESSION['class_id']);
?>

<?php
$sql = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the latest row
    $row = $result->fetch_assoc();
    $newest_AY = $row["id"];
    $start_year = date('Y', strtotime($row['class_start']));
    $end_year = date('Y', strtotime($row['class_end']));
    $academic_year = " | AY $start_year - $end_year";
} else {
    $newest_AY = ""; // Set default value if no rows found
}
?>

<?php
$user_id = mysqli_real_escape_string($conn, $_SESSION['id']);

$check_query = "SELECT * FROM filter WHERE user_id = '$user_id'";

$result = mysqli_query($conn, $check_query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $school_year = $row['school_year'];
        $semester = $row['semester'];
        $quarter = $row['quarter'];

    } else {
        $school_year = $newest_AY;
        $semester = 1;
        $quarter = 1;
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

mysqli_free_result($result);
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Class</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Get Started</li>
          <li class="breadcrumb-item active">Add Class</li>
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
                        <button type="submit" name="add_class" class="btn btn-success">Save changes</button>
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
                            <input type="hidden" id="school_year_id" name="school_year_id" value="<?php echo isset($school_year) ? htmlspecialchars($school_year) : ''; ?>">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="edit_class" class="btn btn-success">Update changes</button>
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
                <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Confirm</button>
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
                              <select class="form-select" id="semester" name="semester" aria-label="State">
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
<div class="card-header justify-content-between px-2">
    <div class="row">
        <div class="col-lg-6 mt-1 col-sm-6 col">
            <form action="" method="GET">
                <div class="d-flex align-items-end justify-content-start px-2"> <!-- Adjusted justify-content-start -->
                    <a class="btn btn-sm btn-outline-default shadow-sm text-primary add-class-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#add_class"
                        data-id="<?= isset($school_year) ? $school_year : ''; ?>">
                        <span class="bi bi-plus-circle fa-sm me-1"></span> Create Class
                    </a>
                </div>
            </form>
        </div>
        <div class="col-lg-6 col-sm-6 mt-1 col">
            
            <div class="d-flex align-items-center justify-content-end"> <!-- Adjusted justify-content-end -->
                <div id="spinner-container" style="display: flex; align-items: center;">
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
                                    data-faculty-id="<?= $row['user_id']; ?>"
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
</div>



    <div class="card-body">

<?php
if (isset($school_year) && !empty($school_year)) {
    $school_year = mysqli_real_escape_string($conn, $school_year);
    $sql = "SELECT id, class_start, class_end FROM academic_calendar WHERE id = $school_year ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $start_year = date('Y', strtotime($row['class_start']));
            $end_year = date('Y', strtotime($row['class_end']));
            $academic_year = "AY $start_year - $end_year";
        } else {
            $academic_year = 'Not Specified';
        }
    } else {
        $academic_year = 'Error fetching data';
    }
    
} else {
    $academic_year = 'AY 0000-0000';
}
?>

<h5 class="font-weight-bold text-dark mt-3 mb-3">List of Class | <?= $academic_year ?> </h5>

<?php
// Check if a school year is selected
if(isset($school_year)) {
    // Sanitize the input to prevent SQL injection
    $selected_school_year = mysqli_real_escape_string($conn, $school_year);
    
    // Query to select classes based on the selected school year
    $query = "SELECT class.*, faculty.firstName, faculty.middleName, faculty.lastName 
              FROM class 
              LEFT JOIN faculty ON class.faculty_id = faculty.id
              WHERE class.school_year_id = '$selected_school_year'";
    
    $query_run = mysqli_query($conn, $query);

    $total_rows = mysqli_num_rows($query_run); // Get total rows
    $rows_per_page = 8; // 2 rows with 4 columns each
    $total_pages = ceil($total_rows / $rows_per_page); // Calculate total pages

    // Get current page from URL parameter
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $rows_per_page; // Calculate offset for pagination

    // Fetch only the required rows for the current page
    $query .= " LIMIT $offset, $rows_per_page";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $count = 0; // Initialize counter
        while ($row = mysqli_fetch_assoc($query_run)) {
            if ($count % 4 == 0) {
                // Start a new row every four columns
                echo "<div class='row'>";
            }
?>
<div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-header text-white fw-bold py-2 bg-secondary " style="background-color: #EDEDED;">
            <h6 class="fw-bold text-start mb-0"><?= $row['gradeLevel'] ?: '-' ?></h6>
        </div>
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-lg-8 col">
                    <h5 class="fw-bold text-start text-dark mb-0 mt-3 text-uppercase" style="color: #5C5C5C;"><?= $row['section'] ?: '-' ?></h5>
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
                    <div class="btn-group float-end" role="group" aria-label="Button group with nested dropdown">
                       <a href="class_students.php?class_id=<?= $row['id'] ?>&school_year=<?= $school_year ?>" class="btn btn-outline-secondary">View Class</a>

                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                               <li><a class="dropdown-item" href="class_students.php?class_id=<?= $row['id'] ?>&school_year=<?= $school_year ?>"><i class="bi bi-person-plus"></i> Add/Import Learners</a></li>
                                <li><a class="dropdown-item edit-class-btn" href="#" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#edit_class"
                                    data-id="<?= $row['id']; ?>" 
                                    data-gradelevel="<?= $row['gradeLevel']; ?>" 
                                    data-section="<?= $row['section']; ?>"
                                    data-facultyid="<?= $row['faculty_id']; ?>" >
                                    <i class="bi bi-gear"></i> Class Settings
                                   </a>
                               </li>
                                <li><a class="dropdown-item delete-class-btn" href="#" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#delete_class"
                                    data-id="<?= $row['id']; ?>" 
                                    data-gradelevel="<?= $row['gradeLevel']; ?>" 
                                    data-section="<?= $row['section']; ?>" >
                                    <i class="bi bi-trash"></i> Remove Class
                                   </a>
                               </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
            if ($count % 4 == 3 || $count == mysqli_num_rows($query_run) - 1) {
                // Close the row after every four columns or at the end of the loop
                echo "</div>";
            }

            $count++;
        }

        // Calculate pagination
        $prev_page = $current_page - 1;
        $next_page = $current_page + 1;

        // Pagination HTML
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination justify-content-end">';
        if ($current_page > 1) {
            echo "<li class='page-item'><a class='page-link' href='?page=$prev_page'>Previous</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link'>Previous</span></li>";
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li class='page-item " . ($current_page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
        }
        if ($current_page < $total_pages) {
            echo "<li class='page-item'><a class='page-link' href='?page=$next_page'>Next</a></li>";
        } else {
            echo "<li class='page-item disabled'><span class='page-link'>Next</span></li>";
        }
        echo '</ul>';
        echo '</nav>';
    } else {
        // No classes found for the selected school year
        echo '<div style="text-align: center;">';
        echo '<div class="h4 mt-4">No classes found for the selected school year.</div>';
        echo '<img src="../assets/img/no_data.png" alt="No data available" style="max-width: 300px; max-height: 300px;" />';
        echo '</div>';
    }
}
?>


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
    $('.edit-class-btn').click(function() {
      var class_id = $(this).data('id');
      var gradeLevel = $(this).data('gradelevel');
      var section = $(this).data('section');
      var faculty_id = $(this).data('facultyid');
      
      $('#edit_class_id').val(class_id);
      $('input[name="edit_gradeLevel"]').prop('checked', false);
        
        // Check the radio button with the corresponding value
        $('input[name="edit_gradeLevel"][value="' + gradeLevel + '"]').prop('checked', true);
      $('#edit_section').val(section);
      $('#edit_faculty_id').val(faculty_id);
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

<script>
  $(document).ready(function() {
    $('.edit-filter-btn').click(function() {
      var filter_id = $(this).data('id');
      var school_year = $(this).data('school-year');
      var semester = $(this).data('semester');
      var quarter = $(this).data('quarter');
      var class_id = $(this).data('class-id');
      
      $('#filter_id').val(filter_id);
      $('#school_year').val(school_year);
      $('#semester').val(semester);
      $('#quarter').val(quarter);
      $('#class_id').val(class_id);
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


