<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';

$sql = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the latest row
    $row = $result->fetch_assoc();
    $newest_AY = $row["id"];
    $start_year = date('Y', strtotime($row['class_start']));
    $end_year = date('Y', strtotime($row['class_end']));
    $academic_year = "AY $start_year - $end_year";
} else {
    $newest_AY = ""; // Set default value if no rows found
}
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Faculty Loads</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Get Started</li>
          <li class="breadcrumb-item active">Faculty Loads</li>
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


          <!--  add faculty -->
          <div class="modal fade" id="add_faculty_load" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
          <i class="bi bi-plus-circle"></i>&nbsp; Add Faculty Load
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form action="crud_faculty_load.php" method="POST">

          <!-- Class Dropdown -->
          <div class="form-floating mb-3">
            <select id="class_id" name="class_id" class="form-select" aria-label="Select Class" required>
              <option disabled selected>Select Class</option>
              <?php
              $query_class = "SELECT class.id, class.gradeLevel, class.section
                              FROM class
                              JOIN academic_calendar ON class.school_year_id = academic_calendar.id
                              WHERE academic_calendar.id = (SELECT MAX(id) FROM academic_calendar)";
              $query_run_class = mysqli_query($conn, $query_class);
              if (mysqli_num_rows($query_run_class) > 0) {
                  while ($row = mysqli_fetch_assoc($query_run_class)) {
                      $classLabel = $row['gradeLevel'] . ' - ' . $row['section'];
                      echo '<option value="' . $row['id'] . '">' . $classLabel . '</option>';
                  }
              }
              ?>
            </select>
            <label for="class_id">Class</label>
          </div>

          <!-- Subject Dropdown -->
          <div class="form-floating mb-3">
            <select id="subject_id" name="subject_id" class="form-select" aria-label="Select Subject" required>
              <option disabled selected>Select Subject</option>
              <?php
              // ✅ include contactHours here
              $query_subjects = "SELECT id, courseCode, courseTitle, contactHours FROM subjects";
              $query_run_subjects = mysqli_query($conn, $query_subjects);
              if (mysqli_num_rows($query_run_subjects) > 0) {
                  while ($row = mysqli_fetch_assoc($query_run_subjects)) {
                      $subjectLabel = $row['courseCode'] . ' - ' . $row['courseTitle'];
                      echo '<option value="' . $row['id'] . '" data-hours="' . $row['contactHours'] . '">' . $subjectLabel . '</option>';
                  }
              }
              ?>
            </select>
            <label for="subject_id">Subject</label>
          </div>

          <!-- Hours Auto-filled -->
          <div class="form-floating mb-3">
            <input type="number" step="0.01" class="form-control" id="hours_per_week" name="hours_per_week" readonly required>
            <label for="hours_per_week">Hours/Week</label>
          </div>

          <!-- Hidden Fields -->
          <input type="hidden" id="faculty_id" name="faculty_id" value="<?php echo isset($_GET['faculty_id']) ? $_GET['faculty_id'] : ''; ?>">
          <input type="hidden" id="school_year_id" name="school_year_id" value="<?php echo $newest_AY; ?>">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add_faculty_load" class="btn btn-success">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- ✅ JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const subjectSelect = document.getElementById("subject_id");
    const hoursInput    = document.getElementById("hours_per_week");

    // Paste hours when subject changes
    subjectSelect.addEventListener("change", function() {
        const selected = this.options[this.selectedIndex];
        const hours = selected.getAttribute("data-hours");
        hoursInput.value = hours ? hours : "";
        console.log("Hours auto-filled:", hours); // debug
    });

    // Ensure when class changes, subject resets
    const classSelect = document.getElementById("class_id");
    classSelect.addEventListener("change", function() {
        subjectSelect.selectedIndex = 0; // reset subject dropdown
        hoursInput.value = ""; // clear hours
    });
});
</script>

        <!--  edit faculty -->
          <div class="modal fade" id="edit_faculty_load" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                 <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                    <i class="bi bi-pencil-square"></i>&nbsp; Edit Faculty Load
                </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Form -->
                  <form action="crud_faculty_load.php" method="POST">
                
                    <div class="form-floating mb-3">
                        <select id="edit_class_id" name="edit_class_id" class="form-select" aria-label="Select Class">
                            <option disabled selected>Select Class</option>
                            <?php
                            $query_class = "SELECT class.id, class.gradeLevel, class.section
                                              FROM class
                                              JOIN academic_calendar ON class.school_year_id = academic_calendar.id
                                              WHERE academic_calendar.id = (SELECT MAX(id) FROM academic_calendar)";

                            $query_run_class = mysqli_query($conn, $query_class);
                            if (mysqli_num_rows($query_run_class) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run_class)) {
                                    $gradeLevel = $row['gradeLevel'];
                                    $section = $row['section'];
                                    $classLabel = $gradeLevel . ' - ' . $section;
                                    echo '<option value="' . $row['id'] . '" data-grade="' . $gradeLevel . '">' . $classLabel . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <label for="edit_class_id">Class</label>
                    </div>

                    <div class="form-floating mb-3" id="edit_semesterSelect" style="display: none;">
                        <select class="form-select" id="edit_semester" name="edit_semester" aria-label="Subject Area">
                            <option selected disabled value>Select Semester</option>
                            <option value="1" data-semester="1">First Semester</option>
                            <option value="2" data-semester="2">Second Semester</option>
                        </select>
                        <label for="edit_semester">Semester</label>
                    </div>


                    <div class="form-floating mb-3">
                        <select id="edit_subject_id" name="edit_subject_id" class="form-select" aria-label="Select Subject">
                            <option disabled selected>Select Subject</option>
                            <?php
                            $query_subjects = "SELECT id, courseCode, courseTitle FROM subjects";
                            $query_run_subjects = mysqli_query($conn, $query_subjects);
                            if (mysqli_num_rows($query_run_subjects) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run_subjects)) {
                                    $courseCode = $row['courseCode'];
                                    $courseTitle = $row['courseTitle'];
                                    $subjectLabel = $courseCode ? $courseCode . '&nbsp;&nbsp;-&nbsp;&nbsp;' . $courseTitle : $courseTitle;
                                    echo '<option value="' . $row['id'] . '">' . $subjectLabel . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <label for="edit_subject_id">Subject</label>
                    </div>


                     <div class="form-floating  mb-3">
                      <input type="number" step="0.01" class="form-control" id="edit_hours_per_week" name="edit_hours_per_week" placeholder="Your Name" required>
                      <label for="edit_hours_per_week">Hours/Week</label>
                    </div>

                    <input type="hidden" id="faculty_id" name="faculty_id" value="<?php echo isset($_GET['faculty_id']) ? $_GET['faculty_id'] : ''; ?>">
                    <input type="hidden" id="school_year_id" name="school_year_id" value="<?php echo $newest_AY; ?>">
                    <input type="hidden" id="edit_facultyload_id" name="edit_facultyload_id">
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="edit_faculty_load" class="btn btn-success">Update changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>



        <!-- delete faculty load -->
        <div class="modal fade" id="delete_faculty_load" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editFacultyLabel" style="font-weight: bold;">
                 <i class="bi bi-trash"></i></i>&nbsp; Delete Faculty Load
              </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <form id="delete_facultyload_form" action="crud_faculty_load.php" method="POST">
              <div class="modal-body">
                <span class="text-danger font-weight-bold">Warning! </span><span>Deleting the faculty load for <span class="fw-bold" id="delete_faculty_loadname"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                <p>Are you sure you want to proceed with the deletion?</p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Confirm</button>
                <input type="hidden" id="delete_facultyload_id" name="delete_facultyload_id">
              </div>
               </form>
            </div>
          </div>
        </div>


<section class="section">
  <div class="row align-items-top">
    <div class="col-lg-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-0">
                <div class="d-flex justify-content-end align-items-center py-2">
                    <div class="d-flex align-items-center">
                        <form class="d-flex ms-auto" id="filterForm" action="" method="GET">
                            <select class="form-select me-1" aria-label="Filter Grade Level" name="faculty_id" id="facultySelect">
                                <?php
                                // Fetch faculty data from the "faculty" table ordered by ID in descending order
                                $query_faculty = "SELECT * FROM faculty ORDER BY id DESC";
                                $query_run_faculty = mysqli_query($conn, $query_faculty);

                                if (mysqli_num_rows($query_run_faculty) > 0) {
                                    while ($faculty_member = mysqli_fetch_assoc($query_run_faculty)) {
                                        // Combine first name, middle name, and last name with proper formatting
                                        $fullName = $faculty_member['firstName'] . ' ';
                                        if (!empty($faculty_member['middleName'])) {
                                            $fullName .= substr($faculty_member['middleName'], 0, 1) . '. ';
                                        }
                                        $fullName .= $faculty_member['lastName'];

                                        // Check if the current faculty member ID matches the one in the GET request
                                        $selected = (isset($_GET['faculty_id']) && $_GET['faculty_id'] == $faculty_member['id']) ? 'selected' : '';

                                        // Output the formatted name as the option value with the "selected" attribute
                                        echo '<option value="' . $faculty_member['id'] . '" ' . $selected . '>' . $fullName . '</option>';
                                    }
                                } else {
                                    // If there are no classes available for the current academic year, display a disabled option
                                    echo '<option value="" disabled selected>No faculty found</option>';
                                }
                                ?>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        <div class="card-body">
          <?php
$faculty_id = isset($_GET['faculty_id']) ? intval($_GET['faculty_id']) : null;
$no = 1;

// Connect to your database (assuming $conn is already initialized)

if ($faculty_id !== null && $faculty_id > 0) {
    // Sanitize the input to prevent SQL injection
    $faculty_id = mysqli_real_escape_string($conn, $faculty_id);
    // Construct the query
    $query = "SELECT * FROM faculty WHERE id = $faculty_id";
} else {
    // No faculty_id provided, fetch the latest record
    $query = "SELECT * FROM faculty ORDER BY id DESC LIMIT 1";
}

// Execute the query
$query_run = mysqli_query($conn, $query);

// Check if there are any results
if (mysqli_num_rows($query_run) > 0) {
    // Fetch data and display
    while ($row = mysqli_fetch_assoc($query_run)) {
?>
<div class="row">
    <div class="col-lg-8 mt-2">
        <div class="card shadow">
            <div class="card-header py-2 bg-secondary">
                <h5 class="card-title py-1 mb-0 text-white">
                    <?= $row['lastName'] ?: '-' ?>, <?= $row['firstName'] ?: '-' ?> <?= $row['middleName'] ? $row['middleName'][0] . '.' : ''; ?> | 
                    <?php echo $academic_year; ?>
                </h5>
            </div>
            <div class="card-body mb-0">
                <p class="card-text mt-2">Rank/Position: <?= $row['rank'] ?: '-'; ?></p>
            </div>
        </div>
    </div>

<?php
$sql = "SELECT COUNT(DISTINCT subject_id) AS num_ids, 
               SUM(hours_per_week) AS total_hours_per_week 
        FROM (SELECT DISTINCT subject_id, hours_per_week 
              FROM loads 
              WHERE faculty_id = $faculty_id 
              AND school_year_id = $newest_AY) AS subquery";
$result = mysqli_query($conn, $sql);

$regular_hours = 0;

if ($result) {
    $row = mysqli_fetch_assoc($result);
    // Get the number of IDs in class
    $num_ids = $row['num_ids'];
    // Calculate Regular and Overload hours
    $regular_hours = min($row['total_hours_per_week'], 18);
    $overload_hours = max($row['total_hours_per_week'] - 18, 0);
} else {
    // Handle query error
    echo "Error executing query: " . mysqli_error($conn);
}

// Free result set
mysqli_free_result($result);
?>


    <div class="col-lg-4 mt-2">
        <div class="card shadow">
            <div class="card-body text-center mt-1 py-2">
                <h6 class="m-0 text-dark small">No. of Teaching Loads</h6>
                <h6 class="m-0 fw-bold text-dark"><?php echo $num_ids; ?></h6>
                <hr class="py-0 m-1">
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 text-dark small">Regular</h6>
                        <h6 class="m-0 fw-bold text-success"><?php echo $regular_hours ?: '0'; ?></h6>
                    </div>
                    <div class="col">
                        <h6 class="m-0 text-dark small">Overload</h6>
                        <h6 class="m-0 fw-bold text-danger"><?php echo $overload_hours ?: '0'; ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
        $no++;
    }
} else {
    echo "<h5>No Record Found</h5>";
}
?>


<div class="card shadow">
              <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Faculty Loads</h6>
                    <div class="ms-auto"> <!-- 'ms-auto' class pushes the content to the right -->
                        <a data-bs-toggle="modal" data-bs-target="#add_faculty_load" class="btn btn-sm btn-outline-default shadow-sm text-primary">
                            <span class="bi bi-plus-circle fa-sm me-1"></span> 
                            Add
                        </a>
                    </div>
                </div>
            </div>

             <div class="card-body">
              <div class="table-responsive mt-2">
                <table id="example"  class="table table-sm table-hover table-bordered display nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th class="">No.</th>
                      <th class="">Course Code</th>
                      <th class="">Course Description</th>
                      <th class="">Hours/Week</th>
                      <th class="">Grade Level</th>
                      <th class="">Section</th>
                      <th class="">No. of Learners</th>
                      <th class="no-export">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  
<?php
$faculty_id = isset($_GET['faculty_id']) ? $_GET['faculty_id'] : null;
$no = 1;

// Check if $newest_AY is not empty
if (!empty($newest_AY)) {
    if ($faculty_id !== null) {
        $whereClause = "WHERE loads.faculty_id = $faculty_id AND loads.school_year_id = '$newest_AY'";
    } else {
        $whereClause = "WHERE loads.faculty_id = (SELECT faculty_id FROM loads ORDER BY id DESC LIMIT 1) AND loads.school_year_id = '$newest_AY'";
    }

    $query = "SELECT loads.*, subjects.courseCode, subjects.courseTitle, class.gradeLevel, class.section, loads.subject_id as subject_id,
                     (SELECT COUNT(*) FROM class_students WHERE class_students.class_id = class.id) AS student_count
              FROM loads
              JOIN subjects ON loads.subject_id = subjects.id
              JOIN class ON loads.class_id = class.id
              $whereClause";

    $query_run = mysqli_query($conn, $query);

    $subject_ids = array();

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $row) {
                if (!in_array($row['subject_id'], $subject_ids)) {
                    // Add subject_id to the array
                    $subject_ids[] = $row['subject_id'];
                    ?>
                                <tr class="small" style="white-space: nowrap; text-align:left;">
                                    <td><?= $no; ?></td>
                                    <td><?= $row['courseCode'] ?: '-'; ?></td>
                                    <td><?= $row['courseTitle'] ?: '-'; ?></td>
                                    <td><?= $row['hours_per_week'] ?: '-'; ?></td>
                                    <td>
                                        <?= $row['gradeLevel'] ?: '-'; ?>
                                        <?php if ($row['semester'] == 1): ?>
                                            (1st Semester)
                                        <?php elseif ($row['semester'] == 2): ?>
                                            (2nd Semester)
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['section'] ?: '-'; ?></td>
                                    <td><?= isset($row['student_count']) ? $row['student_count'] : '-'; ?></td>
                                    <td class="d-flex justify-content-center">
                                        <?php if (strpos($row['courseCode'], 'MAPEH') === false) { ?>
                                            <button class="btn btn-outline-primary btn-sm mx-1 edit-facultyload-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#edit_faculty_load" 
                                                    data-id="<?= $row['id']; ?>" 
                                                    data-subject-id="<?= $row['subject_id']; ?>"
                                                    data-gradelevel="<?= $row['gradeLevel']; ?>"
                                                    data-class-id="<?= $row['class_id']; ?>"
                                                    data-semester="<?= $row['semester']; ?>"
                                                    data-hours-per-week="<?= $row['hours_per_week']; ?>"
                                                    data-bs-tooltip="tooltip" 
                                                    data-placement="top" 
                                                    title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        <?php } ?>
                                        <button class="btn btn-outline-danger btn-sm mx-1 delete-facultyload-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#delete_faculty_load" 
                                                data-id="<?= $row['subject_id']; ?>" 
                                                data-coursecode="<?= $row['courseCode']; ?>"
                                                data-coursetitle="<?= $row['courseTitle']; ?>"
                                                data-gradelevel="<?= $row['gradeLevel']; ?>"
                                                data-section="<?= $row['section']; ?>"
                                                data-classid="<?= $row['class_id']; ?>"
                                                data-schoolyearid="<?= $newest_AY; ?>"
                                                data-bs-tooltip="tooltip" 
                                                data-placement="top" 
                                                title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                  <?php
                    // Increment the row number only if the subject_id is unique
                    $no++;
                }
            }
        } else {
            echo "<h5> No Record Found </h5>";
        }
    } else {
        echo "Query execution failed: " . mysqli_error($conn);
    }
} else {
    echo "<h5> No Record Found </h5>";
}
?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>



  </main><!-- End #main -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Add event listener for select change
    document.getElementById('facultySelect').addEventListener('change', function() {
        document.getElementById('filterForm').submit(); // Submit the form on change
    });
</script>

<script>


$(document).ready(function() {
    $('.edit-facultyload-btn').click(function() {
        var facultyload_id = $(this).data('id');
        var subject_id = $(this).data('subject-id');
        var class_id = $(this).data('class-id');
        var semester = $(this).data('semester');
        var gradeLevel = $(this).data('gradelevel');
        var hours_per_week = $(this).data('hours-per-week');

        $('#edit_facultyload_id').val(facultyload_id);
        $('#edit_subject_id').val(subject_id); // Set the selected subject
        $('#edit_class_id').val(class_id);
        $('#edit_gradeLevel').val(gradeLevel);
        $('#edit_hours_per_week').val(hours_per_week);

        if (gradeLevel === "Grade 11" || gradeLevel === "Grade 12") {
            $('#edit_semesterSelect').show();
            $('#edit_semester').val(semester);
        } else {
            $('#edit_semesterSelect').hide();
            $('#edit_semester').val("");
        }

        // Event listener for class select dropdown
document.getElementById('edit_class_id').addEventListener('change', function() {
    var selectedGradeLevel = this.options[this.selectedIndex].getAttribute('data-grade');
    var semesterElement = document.getElementById('edit_semester');
    var selectedSemester = semesterElement.value;

    console.log("Selected Grade Level: ", selectedGradeLevel);
    console.log("Selected Semester: ", selectedSemester);

    // Show/hide semester select based on grade level
    if (selectedGradeLevel === 'Grade 11' || selectedGradeLevel === 'Grade 12') {
        document.getElementById('edit_semesterSelect').style.display = 'block';
    } else {
        document.getElementById('edit_semesterSelect').style.display = 'none';
        semesterElement.value = ''; // Clear the semester value
        selectedSemester = ''; // Update selectedSemester to empty string
    }

    // Fetch subjects based on selected grade level and semester
    fetchSubjects(selectedGradeLevel, selectedSemester);
});

// Event listener for semester select dropdown
document.getElementById('edit_semester').addEventListener('change', function() {
    var selectedGradeLevel = document.getElementById('edit_class_id').options[document.getElementById('edit_class_id').selectedIndex].getAttribute('data-grade');
    var selectedSemester = this.value;

    console.log("Selected Grade Level: ", selectedGradeLevel);
    console.log("Selected Semester: ", selectedSemester);

    // Fetch subjects based on selected grade level and semester
    fetchSubjects(selectedGradeLevel, selectedSemester);
});

// Function to fetch subjects based on selected grade level and semester
function fetchSubjects(selectedGradeLevel, selectedSemester) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_subjects.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('edit_subject_id').innerHTML = xhr.responseText;
        }
    };
    xhr.send('gradeLevel=' + encodeURIComponent(selectedGradeLevel) + '&semester=' + encodeURIComponent(selectedSemester));
}
    });
});
</script>

<script>
// Event listener for class select dropdown
document.getElementById('class_id').addEventListener('change', function() {
    var selectedGradeLevel = this.options[this.selectedIndex].getAttribute('data-grade');
    var semesterElement = document.getElementById('semester');
    var selectedSemester = semesterElement.value; // Get selected value directly

    console.log("Selected Grade Level: ", selectedGradeLevel);
    console.log("Selected Semester: ", selectedSemester);

    // Show/hide semester select based on grade level
    if (selectedGradeLevel === 'Grade 11' || selectedGradeLevel === 'Grade 12') {
        document.getElementById('semesterSelect').style.display = 'block';
    } else {
        document.getElementById('semesterSelect').style.display = 'none';
        semesterElement.value = ''; // Remove the value of the semester
        selectedSemester = ''; // Update selectedSemester to empty string
    }

    // Send AJAX request to fetch subjects based on selected grade level and semester
    fetchSubjects(selectedGradeLevel, selectedSemester);
});

// Event listener for semester select dropdown
document.getElementById('semester').addEventListener('change', function() {
    var selectedGradeLevel = document.getElementById('class_id').options[document.getElementById('class_id').selectedIndex].getAttribute('data-grade');
    var selectedSemester = this.value; // Get selected value directly

    console.log("Selected Grade Level: ", selectedGradeLevel);
    console.log("Selected Semester: ", selectedSemester);

    // Send AJAX request to fetch subjects based on selected grade level and semester
    fetchSubjects(selectedGradeLevel, selectedSemester);
});

// Function to fetch subjects based on selected grade level and semester
function fetchSubjects(selectedGradeLevel, selectedSemester) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_subjects.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('subject_id').innerHTML = xhr.responseText;
        }
    };
    xhr.send('gradeLevel=' + encodeURIComponent(selectedGradeLevel) + '&semester=' + encodeURIComponent(selectedSemester));
}
</script>


<!-- delete truck function -->
</i> <script>
    $(document).ready(function() {
        $('.delete-facultyload-btn').click(function() {
            var facultyload_id = $(this).data('id');
            var courseCode = $(this).data('coursecode');
            var courseTitle = $(this).data('coursetitle');
            var gradeLevel = $(this).data('gradelevel');
            var section = $(this).data('section');
           
            $('#delete_facultyload_id').val(facultyload_id);
            $('#delete_faculty_loadname').text(courseCode + ' - ' + courseTitle + ' for ' + gradeLevel + ' - ' + section);
        });

        $('#delete_facultyload_form').submit(function(e) {
            e.preventDefault();
            var facultyload_id = $('#delete_facultyload_id').val();
            $.ajax({
                type: "POST",
                url: "crud_faculty_load.php",
                data: {
                    delete_facultyload_id: facultyload_id
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + facultyload_id).hide();

                    // Show a success message with SweetAlert2 toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The faculty load has been deleted successfully.',
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
        $('.delete-facultyload-btn').click(function() {
            var facultyload_id = $(this).data('id');
            var courseCode = $(this).data('coursecode');
            var courseTitle = $(this).data('coursetitle');
            var gradeLevel = $(this).data('gradelevel');
            var section = $(this).data('section');
            var firstName = $(this).data('firstname');
            var middleName = $(this).data('middlename');
            var lastName = $(this).data('lastname');
            var class_id = $(this).data('classid');
            var school_year_id = $(this).data('schoolyearid');

            $('#delete_facultyload_id').val(facultyload_id);
            $('#class_id').val(class_id);
            $('#school_year_id').val(school_year_id);
            $('#delete_faculty_loadname').text(courseCode + ' - ' + courseTitle + ' for ' + gradeLevel + ' - ' + section);
        });

        $('#delete_facultyload_form').submit(function(e) {
            e.preventDefault();
            var facultyload_id = $('#delete_facultyload_id').val();
            var class_id = $('#class_id').val();
            var school_year_id = $('#school_year_id').val();
            $.ajax({
                type: "POST",
                url: "crud_faculty_load.php",
                data: {
                    delete_facultyload_id: facultyload_id,
                    class_id: class_id,
                    school_year_id: school_year_id
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + facultyload_id).hide();

                    // Show a success message with SweetAlert2 toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The class load has been deleted successfully.',
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


