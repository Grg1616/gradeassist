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
    $academic_year = "A.Y $start_year - $end_year";
} else {
    $newest_AY = ""; // Set default value if no rows found
}
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Class Loads</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Get Started</li>
          <li class="breadcrumb-item active">Class Loads</li>
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
          <div class="modal fade" id="add_class_load" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                 <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                    <i class="bi bi-plus-circle"></i>&nbsp; Add Class Load
                </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Form -->
                  <form action="crud_class_load.php" method="POST">
                   <div class="form-floating mb-3">
                        <select id="subject_id" name="subject_id" class="form-select" aria-label="Select Subject" required>
                            <option selected disabled value>Select Subject</option>
                            <?php
                            // Assuming $conn is the mysqli connection object

                            // Check if class_id is provided and is a valid integer
                            if (isset($_GET['class_id']) && is_numeric($_GET['class_id'])) {
                                $class_id = intval($_GET['class_id']);

                                // Fetch gradeLevel based on class_id
                                $class_query = "SELECT gradeLevel FROM class WHERE id = $class_id";
                                $class_result = mysqli_query($conn, $class_query);

                                if ($class_result && mysqli_num_rows($class_result) > 0) {
                                    $class_row = mysqli_fetch_assoc($class_result);
                                    $gradeLevel = $class_row['gradeLevel'];

                                    // Fetch subjects based on gradeLevel but exclude ones already loaded for this class/year
                                    // first gather exclusion list
                                    $excludeIds = [];
                                    $exclude_sql = "SELECT subject_id FROM loads WHERE class_id = $class_id AND school_year_id = $newest_AY";
                                    $exclude_res = mysqli_query($conn, $exclude_sql);
                                    if ($exclude_res && mysqli_num_rows($exclude_res) > 0) {
                                        while ($er = mysqli_fetch_assoc($exclude_res)) {
                                            $excludeIds[] = intval($er['subject_id']);
                                        }
                                    }

                                    $query_subjects = "SELECT id, courseCode, courseTitle FROM subjects WHERE gradeLevel = '$gradeLevel'";
                                    if (!empty($excludeIds)) {
                                        $query_subjects .= " AND id NOT IN (" . implode(',', $excludeIds) . ")";
                                    }

                                    $query_run_subjects = mysqli_query($conn, $query_subjects);

                                    if ($query_run_subjects && mysqli_num_rows($query_run_subjects) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run_subjects)) {
                                            $courseCode = $row['courseCode'];
                                            $courseTitle = $row['courseTitle'];
                                            $subjectLabel = $courseCode ? $courseCode . '&nbsp;&nbsp;-&nbsp;&nbsp;' . $courseTitle : $courseTitle;
                                            echo '<option value="' . $row['id'] . '">' . $subjectLabel . '</option>';
                                        }
                                    } else {
                                        echo "No subjects found for the provided grade level.";
                                    }
                                } else {
                                    echo "No class found for the provided class ID.";
                                }
                            } else {
                                echo "Invalid or missing class ID.";
                            }
                            ?>
                        </select>
                        <label for="subject_id">Subject</label>
                        <div class="invalid-feedback">
                            Please select a valid Subject.
                        </div>
                    </div>

                    <?php
                    $class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : null;

                    // Query to fetch gradeLevel based on class_i
                    $query = "SELECT gradeLevel FROM class WHERE id = $class_id";

                    // Execute the query
                    $result = mysqli_query($conn, $query);

                    // Check if query executed successfully
                    if ($result) {
                        // Fetch the gradeLevel
                        $row = mysqli_fetch_assoc($result);
                        $gradeLevel = $row['gradeLevel'];
                        
                        // Check if gradeLevel is Grade 11 or 12 to decide whether to display the select or not
                        if ($gradeLevel == "Grade 11" || $gradeLevel == "Grade 12") {
                            $displaySemesterSelect = true;
                        } else {
                            $displaySemesterSelect = false;
                        }
                    } else {
                        // Handle query error
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>

                    <!-- Your HTML code with PHP embedded -->
                    <div class="form-floating mb-3" id="semesterSelect" <?php if (!$displaySemesterSelect) echo 'style="display: none;"'; ?>>
                        <select class="form-select" id="semester" name="semester" aria-label="Subject Area">
                            <option selected disabled value>Select Semester</option>
                            <option value="1">First Semester</option>
                            <option value="2">Second Semester</option>
                        </select>
                        <label for="semester">Semester</label>
                    </div>

                    <div class="form-floating mb-3">
                       <select id="faculty_id" name="faculty_id" class="form-select" aria-label="Select Adviser" required>
                          <option selected disabled value>Select Faculty</option>
                          <?php
if (isset($_GET['class_id']) && is_numeric($_GET['class_id'])) {
    $class_id = intval($_GET['class_id']);

    // 1. Get the grade level of the selected class
    $class_query = "SELECT gradeLevel FROM class WHERE id = $class_id";
    $class_result = mysqli_query($conn, $class_query);

    if ($class_result && mysqli_num_rows($class_result) > 0) {
        $class_row = mysqli_fetch_assoc($class_result);
        $gradeLevel = $class_row['gradeLevel'];

        // 2. Map grade level to department
        // Adjust the mapping to match your actual grade level naming
        if (preg_match('/Grade [1-6]/', $gradeLevel)) {
            $department = 'Elementary';
        } elseif (preg_match('/Grade [7-9]|Grade 10/', $gradeLevel)) {
            $department = 'High School';
        } else {
            // Optional: handle other levels (e.g., Kindergarten) or default
            $department = '';
        }

        // 3. Fetch faculty belonging to that department
        if (!empty($department)) {
            // Use a prepared statement or escape the department string
            $dept_escaped = mysqli_real_escape_string($conn, $department);
            $faculty_query = "SELECT id, firstName, middleName, lastName 
                              FROM faculty 
                              WHERE department = '$dept_escaped' 
                                AND designation = 'Faculty'
                              ORDER BY lastName, firstName";
            $faculty_result = mysqli_query($conn, $faculty_query);

            if ($faculty_result && mysqli_num_rows($faculty_result) > 0) {
                while ($row = mysqli_fetch_assoc($faculty_result)) {
                    $firstName = $row['firstName'];
                    $middleName = $row['middleName'];
                    $lastName = $row['lastName'];

                    // Format name: e.g., "John A. Doe"
                    $facultyLabel = $firstName;
                    if (!empty($middleName)) {
                        $facultyLabel .= ' ' . strtoupper(substr($middleName, 0, 1)) . '.';
                    }
                    $facultyLabel .= ' ' . ucfirst($lastName);  // or your custom capitalization

                    echo '<option value="' . $row['id'] . '">' . htmlspecialchars($facultyLabel) . '</option>';
                }
            } else {
                echo '<option value="">No faculty found for this department</option>';
            }
        } else {
            echo '<option value="">Unable to determine department</option>';
        }
    } else {
        echo '<option value="">Invalid class ID</option>';
    }
} else {
    echo '<option value="">Class ID not provided</option>';
}
?>
                       </select>
                        <label for="faculty_id">Instructor</label>
                       <div class="invalid-feedback">
                            Please select a valid Adviser.
                        </div>
                    </div>

                     <div class="form-floating  mb-3">
                      <input type="number" step="0.01" class="form-control" id="hours_per_week" name="hours_per_week" placeholder="Your Name" required readonly>
                      <label for="hours_per_week">Hours/Week</label>
                    </div>

                    <input type="text" id="class_id" name="class_id" style="display: none;" value="<?php echo isset($_GET['class_id']) && $_GET['class_id'] != 0 ? $_GET['class_id'] : ''; ?>" required>

                    <input type="hidden" id="school_year_id" name="school_year_id" value="<?php echo $newest_AY; ?>" >
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="add_class_load" class="btn btn-success">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>


        <!--  edit faculty -->
          <div class="modal fade" id="edit_class_load" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                 <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                    <i class="bi bi-pencil-square"></i>&nbsp; Edit Class Load
                </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Form -->
                  <form action="crud_class_load.php" method="POST">

                    <?php
                    $class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : null;

                    // Query to fetch gradeLevel based on class_i
                    $query = "SELECT gradeLevel FROM class WHERE id = $class_id";

                    // Execute the query
                    $result = mysqli_query($conn, $query);

                    // Check if query executed successfully
                    if ($result) {
                        // Fetch the gradeLevel
                        $row = mysqli_fetch_assoc($result);
                        $gradeLevel = $row['gradeLevel'];
                        
                        // Check if gradeLevel is Grade 11 or 12 to decide whether to display the select or not
                        if ($gradeLevel == "Grade 11" || $gradeLevel == "Grade 12") {
                            $displaySemesterSelect = true;
                        } else {
                            $displaySemesterSelect = false;
                        }
                    } else {
                        // Handle query error
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>

                    <!-- Your HTML code with PHP embedded -->
                    <div class="form-floating mb-3" id="semesterSelect" <?php if (!$displaySemesterSelect) echo 'style="display: none;"'; ?>>
                        <select class="form-select" id="edit_semester" name="edit_semester" aria-label="Subject Area" disabled>
                            <option selected disabled value>Select Semester</option>
                            <option value="1">First Semester</option>
                            <option value="2">Second Semester</option>
                        </select>
                        <label for="edit_semester">Semester</label>
                    </div>

                    <div class="form-floating mb-3">
                       <select id="edit_faculty_id" name="edit_faculty_id" class="form-select" aria-label="Select Adviser" required>
                          <option selected disabled value>Select Faculty</option>
                           <?php
                            if (isset($_GET['class_id']) && is_numeric($_GET['class_id'])) {
                                $class_id = intval($_GET['class_id']);

                                // 1. Get the grade level of the selected class
                                $class_query = "SELECT gradeLevel FROM class WHERE id = $class_id";
                                $class_result = mysqli_query($conn, $class_query);

                                if ($class_result && mysqli_num_rows($class_result) > 0) {
                                    $class_row = mysqli_fetch_assoc($class_result);
                                    $gradeLevel = $class_row['gradeLevel'];

                                    // 2. Map grade level to department
                                    // Adjust the mapping to match your actual grade level naming
                                    if (preg_match('/Grade [1-6]/', $gradeLevel)) {
                                        $department = 'Elementary';
                                    } elseif (preg_match('/Grade [7-9]|Grade 10/', $gradeLevel)) {
                                        $department = 'High School';
                                    } else {
                                        // Optional: handle other levels (e.g., Kindergarten) or default
                                        $department = '';
                                    }

                                    // 3. Fetch faculty belonging to that department
                                    if (!empty($department)) {
                                        // Use a prepared statement or escape the department string
                                        $dept_escaped = mysqli_real_escape_string($conn, $department);
                                        $faculty_query = "SELECT id, firstName, middleName, lastName 
                                                        FROM faculty 
                                                        WHERE department = '$dept_escaped' 
                                                            AND designation = 'Faculty'
                                                        ORDER BY lastName, firstName";
                                        $faculty_result = mysqli_query($conn, $faculty_query);

                                        if ($faculty_result && mysqli_num_rows($faculty_result) > 0) {
                                            while ($row = mysqli_fetch_assoc($faculty_result)) {
                                                $firstName = $row['firstName'];
                                                $middleName = $row['middleName'];
                                                $lastName = $row['lastName'];

                                                // Format name: e.g., "John A. Doe"
                                                $facultyLabel = $firstName;
                                                if (!empty($middleName)) {
                                                    $facultyLabel .= ' ' . strtoupper(substr($middleName, 0, 1)) . '.';
                                                }
                                                $facultyLabel .= ' ' . ucfirst($lastName);  // or your custom capitalization

                                                echo '<option value="' . $row['id'] . '">' . htmlspecialchars($facultyLabel) . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No faculty found for this department</option>';
                                        }
                                    } else {
                                        echo '<option value="">Unable to determine department</option>';
                                    }
                                } else {
                                    echo '<option value="">Invalid class ID</option>';
                                }
                            } else {
                                echo '<option value="">Class ID not provided</option>';
                            }
                            ?>
                       </select>
                        <label for="edit_faculty_id">Instructor</label>
                       <div class="invalid-feedback">
                            Please select a valid Instructor.
                        </div>
                    </div>

                     <div class="form-floating  mb-3">
                      <input type="number" step="0.01" class="form-control" id="edit_hours_per_week" name="edit_hours_per_week" placeholder="Your Name" required readonly>
                      <label for="edit_hours_per_week">Hours/Week</label>
                    </div>

                    <input type="hidden" id="edit_subject_id" name="edit_subject_id">
                    <input type="hidden" id="class_id" name="class_id" value="<?php echo isset($_GET['class_id']) ? $_GET['class_id'] : ''; ?>">
                    <input type="hidden" id="school_year_id" name="school_year_id" value="<?php echo $newest_AY; ?>" >
                    <input type="hidden" id="edit_classload_id" name="edit_classload_id">
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="edit_class_load" class="btn btn-success">Update changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>



        <!-- delete faculty load -->
        <div class="modal fade" id="delete_class_load" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editFacultyLabel" style="font-weight: bold;">
                 <i class="bi bi-trash"></i></i>&nbsp; Delete Class Load
              </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <form id="delete_classload_form" action="crud_class_load.php" method="POST">
              <div class="modal-body">
                <span class="text-danger font-weight-bold">Warning! </span><span>Deleting the class load for <span class="fw-bold" id="delete_class_loadname"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                <p>Are you sure you want to proceed with the deletion?</p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Confirm</button>
                <input type="hidden" id="class_id" name="class_id" value="<?php echo isset($_GET['class_id']) ? $_GET['class_id'] : ''; ?>">
                <input type="hidden" id="school_year_id" name="school_year_id" value="<?php echo $newest_AY; ?>" >
                <input type="hidden" id="delete_classload_id" name="delete_classload_id">
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
                        <form class="d-flex ms-auto" id="classFilterForm" action="" method="GET">
                            <select class="form-select me-1" aria-label="Filter Grade Level" name="class_id" id="classSelect">
                                <?php
                                // Fetch class data from the "class" table where school_year_id is equal to $newest_AY
                                $query_class = "SELECT * FROM class WHERE school_year_id = $newest_AY ORDER BY id DESC";
                                $query_run_class = mysqli_query($conn, $query_class);

                                if (mysqli_num_rows($query_run_class) > 0) {
                                    while ($class_row = mysqli_fetch_assoc($query_run_class)) {
                                        // Combine gradeLevel and section for display
                                        $class_info = $class_row['gradeLevel'] . ' - ' . $class_row['section'];

                                        // Check if the current class ID matches the one in the GET request
                                        $selected = (isset($_GET['class_id']) && $_GET['class_id'] == $class_row['id']) ? 'selected' : '';

                                        // Output the class info as the option value with the "selected" attribute
                                        echo '<option value="' . $class_row['id'] . '" ' . $selected . '>' . $class_info . '</option>';
                                    }
                                } else {
                                    // If there are no classes available for the current academic year, display a disabled option
                                    echo '<option value="" disabled selected>No class found</option>';
                                }
                                ?>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

        <div class="card-body">
<?php
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : null;
$no = 1;

// Connect to your database (assuming $conn is already initialized)

if ($class_id !== null && $class_id > 0) {
    // Sanitize the input to prevent SQL injection
    $class_id = mysqli_real_escape_string($conn, $class_id);

    // Construct the query
    $query = "SELECT class.*, faculty.rank, faculty.firstName, faculty.middleName, faculty.lastName
          FROM class
          JOIN faculty ON class.faculty_id = faculty.id
          WHERE class.id = $class_id AND school_year_id =$newest_AY";

} else {
    // No faculty_id provided, fetch the latest record
    $query = "SELECT class.*, faculty.rank, faculty.firstName, faculty.middleName, faculty.lastName
          FROM class
          JOIN faculty ON class.faculty_id = faculty.id
          WHERE class.id = $class_id AND school_year_id =$newest_AY";
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
                            <h5 class="card-title py-1 mb-0 text-white"><?= $row['gradeLevel'] ?: '-' ?> - <?= $row['section'] ?: '-' ?> | 
                              <?php echo $academic_year; ?>
                            </h5>
                        </div>
                        <div class="card-body mb-0 py-2">
                            <p class="card-text">Adviser: <?= $row['rank'] ?: '-'; ?> <?= $row['firstName'] ?: '-' ?> <?= $row['middleName'] ? $row['middleName'][0] . '.' : ''; ?><?= $row['lastName'] ?: '-' ?></p>
                        </div>
                    </div>
                </div>

        <?php
        $sql = "SELECT COUNT(DISTINCT subject_id) AS num_rows
                FROM loads 
                WHERE class_id = $class_id 
                AND school_year_id = $newest_AY";

        $result = mysqli_query($conn, $sql);

        // Check if query executed successfully
        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }

        // Fetch the result row as an associative array
        $row = mysqli_fetch_assoc($result);

        // Get the count value
        $num_rows = isset($row['num_rows']) ? $row['num_rows'] : 0;

        // Free the result set
        mysqli_free_result($result);
       ?>

        
        <div class="col-lg-4 mt-2">
          <div class="card shadow">
            <div class="card-body text-center mt-1 py-2">
              <h5 class="m-0 text-dark">No. of Class Loads</h5>
              <h2 class="m-0 fw-bold text-dark mt-1"><?php echo $num_rows; ?></h2>
            </div>
          </div>
        </div>

    </div>
<?php
    $no++;
}
} else {
?>
           <div class="row">
                <div class="col-lg-8 mt-2">
                    <div class="card shadow">
                        <div class="card-header py-2 bg-secondary">
                            <h5 class="card-title py-1 mb-0 text-white">Grade Level - Section | <?php echo $academic_year; ?>
                            </h5>
                        </div>
                        <div class="card-body mb-0 py-2">
                            <p class="card-text">Adviser: </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-2">
                  <div class="card shadow">
                    <div class="card-body text-center mt-1 py-2">
                      <h5 class="m-0 text-dark">No. of Class Loads</h5>
                      <h2 class="m-0 fw-bold text-dark mt-1">0</h2>
                    </div>
                  </div>
                </div>

            </div>
        <?php
        }
        ?>



        <div class="card shadow">
              <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Class Loads</h6>
                    <div class="ms-auto"> <!-- 'ms-auto' class pushes the content to the right -->
                        <a data-bs-toggle="modal" data-bs-target="#add_class_load" class="btn btn-sm btn-outline-default shadow-sm text-primary">
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
                      <th class="">Faculty Assigned</th>
                      <th class="no-export">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                 <?php
                        $class_id = isset($_GET['class_id']) ? $_GET['class_id'] : null;
                        $no = 1;

                        if ($class_id !== null) {
                            $whereClause = "WHERE loads.class_id = $class_id AND loads.school_year_id = $newest_AY";
                        } else {
                            $whereClause = "WHERE loads.class_id = (SELECT class_id FROM loads ORDER BY id DESC LIMIT 1) AND loads.school_year_id = $newest_AY";
                        }

                        $query = "SELECT loads.*, 
                                         subjects.courseCode, subjects.courseTitle, 
                                         faculty.firstName, faculty.middleName, faculty.lastName, faculty.rank,
                                         class.gradeLevel, class.section, loads.subject_id as subject_id,
                                         (SELECT COUNT(*) FROM class_students WHERE class_students.class_id = class.id) AS student_count
                                  FROM loads
                                  JOIN subjects ON loads.subject_id = subjects.id
                                  JOIN faculty ON loads.faculty_id = faculty.id
                                  JOIN class ON loads.class_id = class.id
                                  $whereClause";

                        $query_run = mysqli_query($conn, $query);

                        // Initialize an array to store unique subject_ids
                        $subject_ids = array();

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                                // Check if subject_id has been encountered
                                if (!in_array($row['subject_id'], $subject_ids)) {
                                    // Add subject_id to the array
                                    $subject_ids[] = $row['subject_id'];
                                    ?>
                                    <tr style="text-align:left">
                                        <td><?= $no; ?></td>
                                        <td><?= $row['courseCode'] ?: '-'; ?></td>
                                        <td><?= $row['courseTitle'] ?: '-'; ?></td>
                                        <td><?= $row['hours_per_week'] ?: '-'; ?></td>
                                        <td><?= $row['rank'] ?: '-'; ?> <?= $row['firstName'] ?: '-' ?> <?= $row['middleName'] ? $row['middleName'][0] . '.' : ''; ?><?= $row['lastName'] ?: '-' ?></td>
                                        <td class="d-flex justify-content-center">
                                            <?php if (strpos($row['courseCode'], 'MAPEH') === false) { ?>
                                                <button class="btn btn-outline-primary btn-sm mx-1 edit-classload-btn" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#edit_class_load" 
                                                        data-id="<?= $row['id']; ?>" 
                                                        data-subject-id="<?= $row['subject_id']; ?>"
                                                        data-semester="<?= $row['semester']; ?>"
                                                        data-faculty-id="<?= $row['faculty_id']; ?>"
                                                        data-hours-per-week="<?= $row['hours_per_week']; ?>"
                                                        data-bs-tooltip="tooltip" 
                                                        data-placement="top" 
                                                        title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            <?php } ?>
                                                <button class="btn btn-outline-danger btn-sm mx-1 delete-classload-btn" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#delete_class_load" 
                                                        data-id="<?= $row['subject_id']; ?>" 
                                                        data-coursecode="<?= $row['courseCode']; ?>"
                                                        data-coursetitle="<?= $row['courseTitle']; ?>"
                                                        data-rank="<?= $row['rank']; ?>"
                                                        data-firstname="<?= $row['firstName']; ?>"
                                                        data-middlename="<?= $row['middleName']; ?>"
                                                        data-lastname="<?= $row['lastName']; ?>"
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
                            // echo "<h5> No Record Found </h5>";
                        }
                        ?>



                    <!-- Add more rows as needed -->
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
<!-- edit truck function -->

<script>
    // Add event listener for select change
    document.getElementById('classSelect').addEventListener('change', function() {
        document.getElementById('classFilterForm').submit(); // Submit the form on change
    });
</script>

<script>
  $(document).ready(function() {
    $('.edit-classload-btn').click(function() {
      var classload_id = $(this).data('id');
      var subject_id = $(this).data('subject-id');
      var faculty_id = $(this).data('faculty-id');
      var semester = $(this).data('semester');
      var hours_per_week = $(this).data('hours-per-week');

      $('#edit_classload_id').val(classload_id);
      $('#edit_subject_id').val(subject_id);               // preserve current subject
      $('#edit_faculty_id').val(faculty_id);
      $('#edit_semester').val(semester);
      $('#edit_hours_per_week').val(hours_per_week);

      // only update faculty in edit modal – subject and semester are not changeable
      var selectedGradeLevel = "<?php echo $gradeLevel; ?>";
      // no need to fetch subjects; we won't change them

  });
  });
</script>

<script>
// helper to fetch hours per week for a given subject, class, school year, and semester
function fetchAndSetHours(subjectId, hoursInputId) {
    if (!subjectId) return;

    var classId = document.getElementById('class_id').value;
    var schoolYearId = document.getElementById('school_year_id').value;
    var semesterEl = document.getElementById('semester');
    var semester = semesterEl ? semesterEl.value : '';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_hours.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var resp = JSON.parse(xhr.responseText);
                if (resp.hours !== undefined && resp.hours !== null) {
                    document.getElementById(hoursInputId).value = resp.hours;
                }
            } catch (e) {
                console.error('Invalid JSON from fetch_hours.php', xhr.responseText);
            }
        }
    };
    xhr.send('class_id=' + encodeURIComponent(classId) +
             '&subject_id=' + encodeURIComponent(subjectId) +
             '&school_year_id=' + encodeURIComponent(schoolYearId) +
             '&semester=' + encodeURIComponent(semester));
}

// update subjects dropdown when semester changes (existing logic)
document.getElementById('semester').addEventListener('change', function() {
    var selectedSemester = this.value;
    var class_id = "<?php echo $class_id; ?>";
    var selectedGradeLevel = "<?php echo $gradeLevel; ?>";
    var subjectSelect = document.getElementById('subject_id');

    console.log("Selected Grade Level: ", selectedGradeLevel);
    console.log("Selected Semester: ", selectedSemester);
    console.log("Selected Semester: ", subjectSelect);

    // Send AJAX request to fetch subjects based on selected grade level and semester
    fetchSubjects(selectedGradeLevel, selectedSemester);

    // also refresh hours for currently chosen subject (if any)
    var currentSubject = subjectSelect.value;
    fetchAndSetHours(currentSubject, 'hours_per_week');
});

// Function to fetch subjects based on selected grade level and semester
// optional currentSubject can be passed to keep it in list when editing
function fetchSubjects(selectedGradeLevel, selectedSemester, currentSubject, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_subjects.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('subject_id').innerHTML = xhr.responseText;
            if (callback) callback();
        }
    };
    var classId = document.getElementById('class_id').value;
    var schoolYearId = document.getElementById('school_year_id').value;
    var params = 'gradeLevel=' + encodeURIComponent(selectedGradeLevel) +
                 '&semester=' + encodeURIComponent(selectedSemester) +
                 '&class_id=' + encodeURIComponent(classId) +
                 '&school_year_id=' + encodeURIComponent(schoolYearId);
    if (currentSubject) {
        params += '&current_subject_id=' + encodeURIComponent(currentSubject);
    }
    xhr.send(params);
}

// when subject changes in add modal, update hours field
var addSubjectEl = document.getElementById('subject_id');
if (addSubjectEl) {
    addSubjectEl.addEventListener('change', function() {
        fetchAndSetHours(this.value, 'hours_per_week');
    });
}

// when subject changes in edit modal, update hours field
var editSubjectEl = document.getElementById('edit_subject_id');
if (editSubjectEl) {
    editSubjectEl.addEventListener('change', function() {
        fetchAndSetHours(this.value, 'edit_hours_per_week');
    });
}


// also refresh hours when semester in edit modal changes
var editSemester = document.getElementById('edit_semester');
if (editSemester) {
    editSemester.addEventListener('change', function() {
        var subj = document.getElementById('edit_subject_id').value;
        fetchAndSetHours(subj, 'edit_hours_per_week');
        // also update the subject list excluding other assigned subjects
        var selectedGradeLevel = "<?php echo $gradeLevel; ?>";
        var currentSubject = document.getElementById('edit_subject_id').value;
        fetchSubjects(selectedGradeLevel, this.value, currentSubject);
    });
}
</script>


<!-- delete truck function -->
<script>
    $(document).ready(function() {
        $('.delete-classload-btn').click(function() {
            var classload_id = $(this).data('id');
            var courseCode = $(this).data('coursecode');
            var courseTitle = $(this).data('coursetitle');
            var gradeLevel = $(this).data('rank');
            var firstName = $(this).data('firstname');
            var middleName = $(this).data('middlename');
            var lastName = $(this).data('lastname');
            var class_id = $(this).data('classid');
            var school_year_id = $(this).data('schoolyearid');

            $('#delete_classload_id').val(classload_id);
            $('#class_id').val(class_id);
            $('#school_year_id').val(school_year_id);
            $('#delete_class_loadname').text(courseCode + ' - ' + courseTitle + ' assigned to ' + firstName + ' ' + middleName.charAt(0) + '. ' + lastName);
        });

        $('#delete_classload_form').submit(function(e) {
            e.preventDefault();
            var classload_id = $('#delete_classload_id').val();
            var class_id = $('#class_id').val();
            var school_year_id = $('#school_year_id').val();
            $.ajax({
                type: "POST",
                url: "crud_class_load.php",
                data: {
                    delete_classload_id: classload_id,
                    class_id: class_id,
                    school_year_id: school_year_id
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + classload_id).hide();

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


