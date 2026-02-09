<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';


if(isset($_GET['class_id'])) {
    $_SESSION['class_id'] = $_GET['class_id'];
}
?>



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Class List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Get Started</li>
          <li class="breadcrumb-item"><a href="class.php">Add Class</a></li>
          <li class="breadcrumb-item active">Class List</li>
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


     <!-- Add faculty -->
<div class="modal fade" id="add_learner" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
          <i class="bi bi-plus-circle"></i>&nbsp; Add Learners
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form action="crud_learners.php" method="POST">

          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Select Students</h5>

              <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">


              <div class="row">

                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <select class="form-select" id="school_year" name="school_year" aria-label="State">
                      <option selected value>Select Academic Year</option> <!-- Add empty option -->
                      <?php
                   

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
                </div>
                
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <select id="class_id" name="class_id" class="form-select" aria-label="Select Class">
                      <option selected value>Select Class</option> <!-- Add empty option -->
                    </select>
                    <label for="class_id">Class</label>
                  </div>
                </div>

                
              </div>


              <div id="studentTableContainer" class="table-responsive">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>

                        <th>SR-Code</th>
                        <th>LRN</th>
                        <th>Student Name</th>
                        <th>Gender</th>
                        <th><input type="checkbox" id="checkAll"> All</th>
                      </tr>
                    </thead>
                    <tbody id="tableBody">
                      <?php
                      // Retrieve class_id from session
                      $class_id = $_SESSION['class_id'];

                      // Select school_year_id from class table where id matches $class_id
                      $query = "SELECT school_year_id FROM class WHERE id = '$class_id'";
                      $result = mysqli_query($conn, $query);

                      // Check if query was successful
                      if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $school_year_id = $row['school_year_id'];
                        mysqli_free_result($result);

                        // Query to select students who are not associated with the class for the specified school_year_id and the same class_id
                        $query = "SELECT s.* FROM students s 
                                                  LEFT JOIN class_students cs 
                                                  ON s.id = cs.student_id 
                                                  AND cs.class_id = cs.class_id
                                                  AND cs.school_year_id = '$school_year_id'
                                                  WHERE cs.student_id IS NULL";
                        $result = mysqli_query($conn, $query);

                        // Check if query was successful
                        if ($result) {
                          // Fetch all rows from the result set
                          while ($row = mysqli_fetch_assoc($result)) {
                            // Concatenate first name, middle name, and last name
                            $fullName = $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'];
                            echo "<tr class='small' style='white-space: nowrap; text-align:left;'>";
                            // Display full name
                            echo "<td>" . $row['sr_code'] . "</td>";
                            echo "<td>" . $row['lrn'] . "</td>";
                            echo "<td>" . $fullName . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td><input type='checkbox' name='selected_students[]' value='" . $row['id'] . "'></td>";
                            echo "</tr>";
                          }

                          // Free result set
                          mysqli_free_result($result);
                        } else {
                          // Error message
                          echo "Query failed: " . mysqli_error($conn);
                        }
                      } else {
                        // If no school_year_id found, handle the error
                        echo "Error occurred while retrieving school year ID.";
                      }

                      ?>
                    </tbody>
                  </table>
                  <div id="noResultsMessage" class="text-center" style="display: none;">No results found.</div>
                </div>

              </div>

            </div>
          </div>

      </div>
      <input type="hidden" id="class_id" name="class_id" value="<?php echo isset($_SESSION['class_id']) ? $_SESSION['class_id'] : ''; ?>">

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add_learner" class="btn btn-success">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const schoolYearSelect = document.getElementById('school_year');
  const classIdSelect = document.getElementById('class_id');

  schoolYearSelect.addEventListener('change', function() {
    const selectedSchoolYear = this.value;
    // Clear previous options
    classIdSelect.innerHTML = '<option selected value>Select Class</option>';

    // Fetch class options based on selected school year
    fetch('fetch_class.php?school_year=' + selectedSchoolYear)
      .then(response => response.json())
      .then(data => {
        data.forEach(option => {
          const optionElement = document.createElement('option');
          optionElement.value = option.id;
          optionElement.textContent = option.label;
          classIdSelect.appendChild(optionElement);
        });
      })
      .catch(error => console.error('Error fetching class options:', error));
  });
});
</script>
<script>
    // Add event listener to "Check All" checkbox
    document.getElementById("checkAll").addEventListener("change", function() {
        var checkboxes = document.getElementsByClassName("student-checkbox");
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
</script>

<script>
    
   // Get the input field, table body, and no results message
var input = document.getElementById("searchInput");
var tableBody = document.getElementById("tableBody");
var noResultsMessage = document.getElementById("noResultsMessage");

// Function to update search results
function updateSearchResults() {
  var filter = input.value.toUpperCase();
  var rows = tableBody.getElementsByTagName("tr");
  var foundResults = false;

  // Loop through all table rows, and hide those that don't match the search query
  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName("td");
    var found = false;
    for (var j = 0; j < cells.length && !found; j++) {
      var cell = cells[j];
      if (cell) {
        var textValue = cell.textContent || cell.innerText;
        if (textValue.toUpperCase().indexOf(filter) > -1) {
          found = true;
          foundResults = true;
        }
      }
    }
    if (found) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }

  // Display no results message if no rows are found
  if (!foundResults) {
    noResultsMessage.style.display = "block";
  } else {
    noResultsMessage.style.display = "none";
  }
}

// Add event listeners to the select elements
document.getElementById('class_id').addEventListener('change', function() {
  updateStudentList();
  updateSearchResults(); // Update search results when class selection changes
});
document.getElementById('school_year').addEventListener('change', function() {
  updateStudentList();
  updateSearchResults(); // Update search results when academic year selection changes
});

// Function to update the student list based on the selected class and academic year
function updateStudentList() {
  var classId = document.getElementById('class_id').value;
  var schoolYearId = document.getElementById('school_year').value;

  // Send AJAX request to fetch updated student list
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Update the table with the response
        tableBody.innerHTML = xhr.responseText;
        updateSearchResults(); // Update search results after table content is updated
      } else {
        console.error('Request failed: ' + xhr.status);
      }
    }
  };
  xhr.open('GET', 'fetch_students.php?class_id=' + classId + '&school_year_id=' + schoolYearId, true);
  xhr.send();
}

// Add event listener to input field for searching
input.addEventListener("input", updateSearchResults);

// Get the "Check All" checkbox and individual checkboxes
var checkAllCheckbox = document.getElementById("checkAll");
var individualCheckboxes = document.querySelectorAll("input[name='selected_students[]']");

// Add event listener to "Check All" checkbox
checkAllCheckbox.addEventListener("change", function() {
    // Set all individual checkboxes to the same state as "Check All" checkbox
    individualCheckboxes.forEach(function(checkbox) {
        checkbox.checked = checkAllCheckbox.checked;
    });
});

// Add event listener to individual checkboxes
individualCheckboxes.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
        // If any individual checkbox is unchecked, uncheck "Check All" checkbox
        if (!this.checked) {
            checkAllCheckbox.checked = false;
        } else {
            // Check if all individual checkboxes are checked, then check "Check All" checkbox
            var allChecked = true;
            individualCheckboxes.forEach(function(individualCheckbox) {
                if (!individualCheckbox.checked) {
                    allChecked = false;
                }
            });
            checkAllCheckbox.checked = allChecked;
        }
    });
});
</script>

        <!-- Modal -->
        <div class="modal fade" id="remove_student" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editFacultyLabel" style="font-weight: bold;">
                 <i class="bi bi-trash"></i></i>&nbsp; Remove Student
              </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <form id="delete_student_form" action="crud_learners.php" method="POST">
              <div class="modal-body">
                <span class="text-danger font-weight-bold">Warning! </span><span>Removing the student <span class="fw-bold" id="delete_student_fullname"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                <p>Are you sure you want to proceed with the deletion?</p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Confirm</button>
                <input type="hidden" id="delete_student_id" name="delete_student_id">
                <input type="hidden" id="delete_class_id" name="delete_class_id">
              </div>
               </form>
            </div>
          </div>
        </div>


<section class="section">
  <div class="row align-items-top">
    <div class="col-lg-12 col-sm-12">


      <!-- Card with header and footer -->
       <div class="card shadow mb-4">
            <div class="card-header justify-content-between px-4">
              <div class="row">
                  <div class="col-lg-6 mt-1 col-sm-6 col">
                      <div class="d-flex align-items-center">
                         
                      </div>
                  </div>
                  <div class="col-lg-6 col-sm-6 mt-1 col">
                      <form action="" method="GET">
                          <div class="d-flex align-items-end justify-content-end px-2 me-auto">
                              <a class="btn btn-sm btn-outline-default shadow-sm text-primary add-learner-btn"
                                  data-bs-toggle="modal"
                                  data-bs-target="#add_learner"
                                  data-id="<?= isset($_GET['class_id']) ? $_GET['class_id'] : ''; ?>">
                                  <span class="bi bi-plus-circle fa-sm me-1"></span>
                                  Add Learners
                              </a>
                          </div>
                      </form>
                  </div>
              </div>
          </div>

          <div class="card-body">

            <?php
            // Check if class_id is set in the session
            $class_id = isset($_SESSION['class_id']) ? $_SESSION['class_id'] : null;

            if ($class_id !== null) {
                // Proceed with your database query
                $query = "SELECT class.*, 
                       faculty.firstName, 
                       faculty.middleName, 
                       faculty.lastName, 
                       faculty.rank,
                       academic_calendar.id AS school_year_id,
                       academic_calendar.class_start, 
                       academic_calendar.class_end
                FROM class 
                LEFT JOIN faculty ON class.faculty_id = faculty.id
                LEFT JOIN academic_calendar ON class.school_year_id = academic_calendar.id
                WHERE class.id = '$class_id'";


                $query_run = mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                        <div class="row">
                            <div class="col-lg-8 mt-2">
                                <div class="card shadow">
                                    <div class="card-header py-2 bg-secondary">
                                        <h5 class="card-title py-1 mb-0 text-white"><?= $row['gradeLevel'] ?: '-' ?> - <?= $row['section'] ?: '-' ?> | 
                                        <?php
                                            $start_year = date('Y', strtotime($row['class_start']));
                                            $end_year = date('Y', strtotime($row['class_end']));
                                            $academic_year = "A.Y $start_year - $end_year";
                                            echo $academic_year;
                                        ?>
                                        </h5>
                                    </div>
                                    <div class="card-body mb-0">
                                        <p class="card-text mt-2">Adviser: <?= $row['rank'] ?: '-' ?> <?= $row['firstName'] . ' ' . substr($row['middleName'], 0, 1) . '. ' . $row['lastName'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-2">
                                <div class="card shadow">
                                    <div class="card-body text-center mt-1 py-2">
                                        <h6 class="m-0 text-dark small">No. of Learners</h6>
                                        <h6 class="m-0 fw-bold text-dark">
                                            <?php
                                            $sql_students = "SELECT COUNT(student_id) AS total_students FROM class_students WHERE class_id = $class_id";
                                            $result_students = mysqli_query($conn, $sql_students);
                                            if ($result_students && mysqli_num_rows($result_students) > 0) {
                                                $row_students = mysqli_fetch_assoc($result_students);
                                                echo $row_students["total_students"];
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </h6>
                                        <hr class="py-0 m-1">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="m-0 text-dark small">Male</h6>
                                                <h6 class="m-0 fw-bold text-dark">
                                                    <?php
                                                    $sql_male_students = "SELECT COUNT(cs.student_id) AS total_students 
                                                            FROM class_students cs
                                                            INNER JOIN students s ON cs.student_id = s.id
                                                            WHERE cs.class_id = $class_id AND s.gender = 'Male'";
                                                    $result_male_students = mysqli_query($conn, $sql_male_students);
                                                    if ($result_male_students && mysqli_num_rows($result_male_students) > 0) {
                                                        $row_male_students = mysqli_fetch_assoc($result_male_students);
                                                        echo $row_male_students["total_students"];
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>
                                                </h6>
                                            </div>
                                            <div class="col">
                                                <h6 class="m-0 text-dark small">Female</h6>
                                                <h6 class="m-0 fw-bold text-dark">
                                                    <?php
                                                    $sql_female_students = "SELECT COUNT(cs.student_id) AS total_students 
                                                            FROM class_students cs
                                                            INNER JOIN students s ON cs.student_id = s.id
                                                            WHERE cs.class_id = $class_id AND s.gender = 'Female'";
                                                    $result_female_students = mysqli_query($conn, $sql_female_students);
                                                    if ($result_female_students && mysqli_num_rows($result_female_students) > 0) {
                                                        $row_female_students = mysqli_fetch_assoc($result_female_students);
                                                        echo $row_female_students["total_students"];
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // Handle case when no record is found
                    // echo "<h5> No Record Found </h5>";
                }
            } else {
                // Handle case when class_id is not set
            }
            ?>
            <div class="card shadow">
             <div class="card-body">
              <div class="table-responsive mt-2">

                <table class="table table-sm table-hover table-bordered" style="width:100%">
                  <thead class="bg-secondary">
                    <tr>
                      <th class="text-center">No.</th>
                      <th>SR-Code</th>
                      <th>LRN</th>
                      <th>Name of Learner</th>
                      <th>Gender</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    <?php
// $class_id = isset($_SESSION['class_id']) ? $_SESSION['class_id'] : null;

$query = "SELECT students.* 
          FROM students 
          INNER JOIN class_students 
          ON students.id = class_students.student_id 
          WHERE class_students.class_id = $class_id
          ORDER BY 
          CASE 
              WHEN gender = 'Male' THEN 1
              WHEN gender = 'Female' THEN 2
              ELSE 3
          END,
          lastName";

$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    $male_count = 0;
    $female_count = 0;
    $no = 0; // Initialize $no here
    while ($row = mysqli_fetch_assoc($query_run)) {
        if ($row['gender'] == 'Male') {
            $male_count++;
            $no = $male_count; // Reset numbering for male students
        } else if ($row['gender'] == 'Female') {
            if ($male_count > 0 && $female_count == 0) {
                // Add a separator row between male and female students
                echo '<tr class="py-0" style="background-color: #CCCCCC;"><td colspan="6" class="py-1" style="background-color: #dfdcdc;"></td></tr>';
            }
            $female_count++;
            $no = $female_count; // Reset numbering for female students
        }
?>
            <tr class="small" style="white-space: nowrap; text-align:left;">
                <td class="text-center"><?= $no; ?></td>
                <td><?= $row['sr_code'] ?: '-'; ?></td>
                <td><?= $row['lrn'] ?: '-'; ?></td>
                <td><?= $row['lastName'] ?: '-' ?>, <?= $row['firstName'] ?: '-' ?> <?= $row['middleName'] ? $row['middleName'][0] . '.' : ''; ?></td>
                <td><?= $row['gender'] ?: '-'; ?></td>
                <td class="d-flex justify-content-center">
                    <button class="btn btn-outline-info btn-sm mx-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#exampleModal<?= $row['id'] ?>"
                                        data-bs-tooltip="tooltip" 
                                        data-placement="top" 
                                        title="View details">
                                    <i class="bi bi-info-circle"></i>
                                </button>

                                <!-- View Details -->
                                <div class="modal fade" id="exampleModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $row['id'] ?>" aria-hidden="true">
                                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                                            <i class="bi bi-info-circle"></i>&nbsp; View Student Details
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="col-lg-12">
    
                                            <div class="card mb-4">
                                              <div class="card-header py-1 bg-secondary text-white">
                                                <p class="mb-0"><strong>Student Details</strong></p>
                                              </div>
                                              <div class="card-body">
                                                
                                                <div class="row mt-3">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>SR-Code:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['sr_code'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row mt-3">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>LRN:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['lrn'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row mt-3">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>First Name:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['firstName'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Middle Name:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['middleName'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Last Name:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['lastName'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Gender:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['gender'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Birthday:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['birthday'] ? date('F j, Y', strtotime($row['birthday'])) : '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Religion:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['religion'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Contact Number:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['contactNumber'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Email Address:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['email'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Home Address:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['homeAddress'] ?: '-' ?></p>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>

                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-lg-12">
    
                                            <div class="card mb-4">
                                              <div class="card-header py-1 bg-secondary text-white">
                                                <p class="mb-0"><strong>Father Details</strong></p>
                                              </div>
                                              <div class="card-body">
                                                
                                                <div class="row mt-3">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Name:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['fatherName'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Occupation:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['fatherOccupation'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Contact Number:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['fatherContact'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Email Adddress:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['fatherEmail'] ?: '-' ?></p>
                                                  </div>
                                                </div>
        
                                              </div>
                                            </div>

                                          </div>
                                        </div>




                                        <div class="row">
                                          <div class="col-lg-12">
    
                                            <div class="card mb-4">
                                              <div class="card-header py-1 bg-secondary text-white">
                                                <p class="mb-0"><strong>Mother Details</strong></p>
                                              </div>
                                              <div class="card-body">
                                                
                                                <div class="row mt-3">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Name:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['motherName'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Occupation:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['motherOccupation'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Contact Number:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['motherContact'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Email Adddress:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['motherEmail'] ?: '-' ?></p>
                                                  </div>
                                                </div>
        
                                              </div>
                                            </div>

                                          </div>
                                        </div>


                                        <div class="row">
                                          <div class="col-lg-12">
    
                                            <div class="card mb-4">
                                              <div class="card-header py-1 bg-secondary text-white">
                                                <p class="mb-0"><strong>Guardian Details</strong></p>
                                              </div>
                                              <div class="card-body">
                                                
                                                <div class="row mt-3">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Name:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['guardianName'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Occupation:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['guardianOccupation'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Contact Number:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['guardianContact'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Email Adddress:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['guardianEmail'] ?: '-' ?></p>
                                                  </div>
                                                </div>
        
                                              </div>
                                            </div>

                                          </div>
                                        </div>

                                      

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>


                                 <button class="btn btn-outline-danger btn-sm mx-1 delete-student-btn" 
        data-bs-toggle="modal" 
        data-bs-target="#remove_student" 
        data-studentid="<?= $row['id']; ?>" 
        data-classid="<?= $class_id; ?>" 
        data-firstname="<?= $row['firstName']; ?>"
        data-middlename="<?= $row['middleName']; ?>"
        data-lastname="<?= $row['lastName']; ?>"
        data-bs-tooltip="tooltip" 
        data-placement="top" 
        title="Remove">
    <i class="bi bi-x-lg"></i>
</button>

                </td>
      
                       
              <?php
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
          </div><!-- End Card with header and footer -->
       </div>
      </div>
    </div>
  </div>
</section>


  </main><!-- End #main -->

<!-- <script>
        // Function to get the value of a URL parameter by name
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };

        // Get the class_id parameter from the URL
        var classId = getUrlParameter('class_id');

        // If class_id exists, add it back to the URL after reload
        if (classId) {
            window.addEventListener('load', function() {
                history.replaceState({}, '', window.location.pathname + '?class_id=' + classId);
            });
        }
    </script> -->
<script>
  $(document).ready(function() {
    $('.add-learner-btn').click(function() {
      var class_id = $(this).data('id');

      $('#class_id').val(class_id);
    });
  });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- edit truck function -->
<script>
  $(document).ready(function() {
    $('.edit-faculty-btn').click(function() {
      var faculty_id = $(this).data('id');
      var firstName = $(this).data('firstname');
      var middleName = $(this).data('middlename');
      var lastName = $(this).data('lastname');
      var gender = $(this).data('gender');
      var rank = $(this).data('rank');
      var designation = $(this).data('designation');
      var department = $(this).data('department');
      var status = $(this).data('status');

      $('#edit_faculty_id').val(faculty_id);
      $('#edit_firstName').val(firstName);
      $('#edit_middleName').val(middleName);
      $('#edit_lastName').val(lastName);
      $('#edit_gender').val(gender);
      $('#edit_rank').val(rank);
      $('#edit_designation').val(designation);
      $('#edit_department').val(department);
      $('#edit_status').val(status);
    });
  });
</script>


<!-- delete truck function -->
<script>
$(document).ready(function() {
    $('.delete-student-btn').click(function() {
        var student_id = $(this).data('studentid');
        var firstName = $(this).data('firstname');
        var middleName = $(this).data('middlename');
        var lastName = $(this).data('lastname');
        var class_id = $(this).data('classid');
       
        $('#delete_student_id').val(student_id);
        $('#delete_class_id').val(class_id);
        $('#delete_student_fullname').text(firstName + ' ' + middleName + ' ' + lastName);
    });

    $('#delete_student_form').submit(function(e) {
        e.preventDefault();
        var student_id = $('#delete_student_id').val();
        var class_id = $('#delete_class_id').val();
        $.ajax({
            type: "POST",
            url: "crud_learners.php",
            data: {
                delete_student_id: student_id,
                delete_class_id: class_id // Include class_id in the data to be sent
            },
            success: function(response) {
                console.log("Delete response:", response);

                // Hide the deleted row from the table
                $('#row_' + student_id).hide();

                // Show a success message with SweetAlert2 toast
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'The student has been removed successfully.',
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


