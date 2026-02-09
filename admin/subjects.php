<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Subjects</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item">File Management</li>
          <li class="breadcrumb-item active">Subjects</li>
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


       <!--  add Subjects -->
        <div class="modal fade" id="add_subject" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-plus-circle"></i>&nbsp; Add Subject
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->

                 <form action="crud_subject.php" method="POST">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="courseCode" name="courseCode" placeholder="Your Name">
                            <label for="courseCode">Course Code</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="courseTitle" name="courseTitle" placeholder="Your Name" required>
                            <label for="courseTitle">Course Title</label>
                          </div>
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="gradeLevel" name="gradeLevel" aria-label="Grade Level" required onchange="toggleSemester()">
                          <option selected disabled value>Select Grade Level</option>
                          <option value="Kinder">Kinder</option>
                          <option value="Grade 1">Grade 1</option>
                          <option value="Grade 2">Grade 2</option>
                          <option value="Grade 3">Grade 3</option>
                          <option value="Grade 4">Grade 4</option>
                          <option value="Grade 5">Grade 5</option>
                          <option value="Grade 6">Grade 6</option>
                          <option value="Grade 7">Grade 7</option>
                          <option value="Grade 8">Grade 8</option>
                          <option value="Grade 9">Grade 9</option>
                          <option value="Grade 10">Grade 10</option>
                          <option value="Grade 11">Grade 11</option>
                          <option value="Grade 12">Grade 12</option>
                      </select>
                      <label for="gradeLevel">Grade Level</label>
                      <div class="invalid-feedback">
                          Please select a valid grade level.
                      </div>
                  </div>

                  <div class="form-floating mb-3" id="semesterSelect" style="display: none;">
                      <select class="form-select" id="semester" name="semester" aria-label="Semester">
                          <option selected disabled value>Select Semester</option>
                          <option value="1">First Semester</option>
                          <option value="2">Second Semester</option>
                      </select>
                      <label for="semester">Semester</label>
                  </div>

                  <div class="form-floating mb-3" id="subjectTypeSelect" style="display: none;">
                      <select class="form-select" id="subjectType" name="subjectType" aria-label="Subject Type">
                          <option selected disabled value>Select Subject Type</option>
                          <option value="core">Core Subject</option>
                          <option value="applied">Applied and Specialized Subject</option>
                      </select>
                      <label for="subjectType">Subject Type</label>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="subjectArea" name="subjectArea" aria-label="Subject Area" required>
                          <option selected disabled value>Select Subject Area</option>
                          <option value="Language">Language</option>
                          <option value="ESP">ESP</option>
                          <option value="AP">AP</option>
                          <option value="Science">Science</option>
                          <option value="Math">Math</option>
                          <option value="MAPEH">MAPEH</option>
                          <option value="TLE">TLE</option>
                          <option value="EPP">EPP</option>
                          <option value="English">English</option>
                          <option value="Filipino">Filipino</option>
                          <option value="Humanities">Humanities</option>
                          <option value="Research 2">Research 2</option>
                          <option value="Research 3">Research 3</option>
                          <option value="Data Science">Data Science</option>
                          <option value="Intro to AI">Intro to AI</option>
                      </select>
                      <label for="subjectArea">Subject Area</label>
                      <div class="invalid-feedback">
                          Please select a valid subject area.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="contactHours" name="contactHours" placeholder="Your Name" required>
                      <label for="contactHours">Contact Hours</label>
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_subject" class="btn btn-success">Save changes</button>
              </div>

              </form>

            </div>
          </div>
        </div>

        <!--  edit Subjects -->
        <div class="modal fade" id="edit_subject" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-pencil-square"></i>&nbsp; Edit Subject
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->

                 <form action="crud_subject.php" method="POST">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="edit_courseCode" name="edit_courseCode" placeholder="Your Name">
                            <label for="edit_courseCode">Course Code</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="edit_courseTitle" name="edit_courseTitle" placeholder="Your Name" required>
                            <label for="edit_courseTitle">Course Title</label>
                          </div>
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="edit_gradeLevel" name="edit_gradeLevel" aria-label="Grade Level" required onchange="toggleSemester()">
                          <option selected disabled value>Select Grade Level</option>
                          <option value="Kinder">Kinder</option>
                          <option value="Grade 1">Grade 1</option>
                          <option value="Grade 2">Grade 2</option>
                          <option value="Grade 3">Grade 3</option>
                          <option value="Grade 4">Grade 4</option>
                          <option value="Grade 5">Grade 5</option>
                          <option value="Grade 6">Grade 6</option>
                          <option value="Grade 7">Grade 7</option>
                          <option value="Grade 8">Grade 8</option>
                          <option value="Grade 9">Grade 9</option>
                          <option value="Grade 10">Grade 10</option>
                          <option value="Grade 11">Grade 11</option>
                          <option value="Grade 12">Grade 12</option>
                      </select>
                      <label for="edit_gradeLevel">Grade Level</label>
                      <div class="invalid-feedback">
                          Please select a valid grade level.
                      </div>
                  </div>

                  <div class="form-floating mb-3" id="edit_semesterSelect" style="display: none;">
                      <select class="form-select" id="edit_semester" name="edit_semester" aria-label="Subject Area">
                          <option selected disabled value>Select Semester</option>
                          <option value="1">First Semester</option>
                          <option value="2">Second Semester</option>
                      </select>
                      <label for="edit_semester">Semester</label>
                  </div>

                  <div class="form-floating mb-3" id="edit_subjectTypeSelect" style="display: none;">
                      <select class="form-select" id="edit_subjectType" name="edit_subjectType" aria-label="Subject Type">
                          <option selected disabled value>Select Subject Type</option>
                          <option value="core">Core Subject</option>
                          <option value="applied">Applied and Specialized Subject</option>
                      </select>
                      <label for="edit_subjectType">Subject Type</label>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="edit_subjectArea" name="edit_subjectArea" aria-label="Subject Area" required>
                          <option selected disabled value>Select Subject Area</option>
                          <option value="Language">Language</option>
                          <option value="ESP">ESP</option>
                          <option value="AP">AP</option>
                          <option value="Science">Science</option>
                          <option value="Math">Math</option>
                          <option value="MAPEH">MAPEH</option>
                          <option value="TLE">TLE</option>
                          <option value="EPP">EPP</option>
                          <option value="English">English</option>
                          <option value="Filipino">Filipino</option>
                          <option value="Humanities">Humanities</option>
                          <option value="Research 2">Research 2</option>
                          <option value="Research 3">Research 3</option>
                          <option value="Data Science">Data Science</option>
                          <option value="Intro to AI">Intro to AI</option>
                      </select>
                      <label for="edit_subjectArea">Subject Area</label>
                      <div class="invalid-feedback">
                          Please select a valid subject area.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="edit_contactHours" name="edit_contactHours" placeholder="Your Name" required>
                      <label for="edit_contactHours">Contact Hours</label>
                  </div>

                   <input type="hidden" id="edit_subject_id" name="edit_subject_id">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="edit_subject" class="btn btn-success">Save changes</button>
              </div>

              </form>

            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="delete_subject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editFacultyLabel" style="font-weight: bold;">
                 <i class="bi bi-trash"></i></i>&nbsp; Delete Subject
              </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <form id="delete_subject_form" action="crud_subject.php" method="POST">
              <div class="modal-body">
                <span class="text-danger font-weight-bold">Warning! </span><span>Deleting the subject <span class="fw-bold" id="delete_subject_name"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                <p>Are you sure you want to proceed with the deletion?</p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Confirm</button>
                <input type="hidden" id="delete_subject_id" name="delete_subject_id">
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
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">List of Subjects</h6>
                    <div>
                      <a data-bs-toggle="modal" data-bs-target="#addFaculty" class="btn btn-sm btn-outline-default shadow-sm text-secondary" onclick="refreshPage()">
                          <span class="bi bi-arrow-clockwise fa-sm me-1"></span> <!-- Added me-1 class for margin-right -->
                          Refresh
                       </a>

                      <script>
                          function refreshPage() {
                              location.reload();
                          }
                      </script>

                       <a data-bs-toggle="modal" data-bs-target="#add_subject" class="btn btn-sm btn-outline-default shadow-sm text-primary">
                          <span class="bi bi-plus-circle fa-sm me-1"></span> 
                          Add Subject
                       </a>


                    </div>
                </div>
            </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-sm table-hover table-bordered display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th class="no-export">#</th>
                  <th class="">Course Code</th>
                  <th class="">Course Title</th>
                  <th class="">Grade Level</th>
                  <th class="">Subject Area</th>
                  <th class="">Contact Hours</th>
                  <th class="no-export">Actions</th>
                  
                </tr>
              </thead>
              <tbody>
              
                <?php
                  $no = 1;
                  $query = "SELECT * FROM subjects ORDER BY dateCreated DESC";

                  $query_run = mysqli_query($conn, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $row) {
                          ?>
                          <tr class="small" style="white-space: nowrap; text-align:left;">
                              <td class="no-export"><?= $no; ?></td>
                              <td><?= $row['courseCode'] ?: '-'; ?></td>
                              <td><?= $row['courseTitle'] ?: '-'; ?></td>
                              <td><?= $row['gradeLevel'] ?: '-'; ?></td>
                              <td><?= $row['subjectArea'] ?: '-'; ?></td>
                              <td><?= $row['contactHours'] ?: '-'; ?></td>
                              <td class="d-flex justify-content-center no-export">

                                   <button class="btn btn-outline-info btn-sm mx-1" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#exampleModal<?= $no ?>"
                                        data-bs-tooltip="tooltip" 
                                        data-placement="top" 
                                        title="View details">
                                    <i class="bi bi-info-circle"></i>
                                </button>

                                <!-- View Details -->
                                <div class="modal fade" id="exampleModal<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $no ?>" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                                            <i class="bi bi-info-circle"></i>&nbsp; View Subject Details
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="col-lg-12">
                                            <div class="card mb-4">
                                              <div class="card-body">
                                                <div class="row mt-3">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Course Code:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['courseCode'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Course Title:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['courseTitle'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Grade Level:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['gradeLevel'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <?php if (!empty($row['semester'])) { ?>
    <div class="row">
        <div class="col-sm-3 col">
            <p class="mb-0"><strong>Semester:</strong></p>
        </div>
        <div class="col-sm-9 col">
            <p class="text-muted mb-0">
                <?php
                if ($row['semester'] == 1) {
                    echo 'First Semester';
                } elseif ($row['semester'] == 2) {
                    echo 'Second Semester';
                } else {
                    echo '-';
                }
                ?>
            </p>
        </div>
    </div>
    <hr>
<?php } ?>

<?php if (!empty($row['subjectType'])) { ?>
    <div class="row">
        <div class="col-sm-3 col">
            <p class="mb-0"><strong>Subject Type:</strong></p>
        </div>
        <div class="col-sm-9 col">
            <p class="text-muted mb-0">
                <?php
                if ($row['subjectType'] == 'core') {
                    echo 'Core Subject';
                } elseif ($row['subjectType'] == 'applied') {
                    echo 'Applied and Specialized Subject';
                } else {
                    echo '-';
                }
                ?>
            </p>
        </div>
    </div>
    <hr>
<?php } ?>

                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Subject Area:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['subjectArea'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Contact Hours:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['contactHours'] ?: '-' ?></p>
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


                                 <button class="btn btn-outline-primary btn-sm mx-1 edit-subject-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#edit_subject" 
                                        data-id="<?= $row['id']; ?>" 
                                        data-coursecode="<?= $row['courseCode']; ?>"
                                        data-coursetitle="<?= $row['courseTitle']; ?>"
                                        data-gradelevel="<?= $row['gradeLevel']; ?>"
                                        data-semester="<?= $row['semester']; ?>"
                                        data-subjecttype="<?= $row['subjectType']; ?>"
                                        data-subjectarea="<?= $row['subjectArea']; ?>"
                                        data-contacthours="<?= $row['contactHours']; ?>"
                                        data-bs-tooltip="tooltip" 
                                        data-placement="top" 
                                        title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <button class="btn btn-outline-danger btn-sm mx-1 delete-subject-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#delete_subject" 
                                        data-id="<?= $row['id']; ?>" 
                                        data-coursecode="<?= $row['courseCode']; ?>"
                                        data-coursetitle="<?= $row['courseTitle']; ?>"
                                        data-bs-tooltip="tooltip" 
                                        data-placement="top" 
                                        title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>



                             
                          </tr>
                  <?php
                          $no++;
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
</section>


  </main><!-- End #main -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- edit truck function -->
<script>
  $(document).ready(function() {
    $('.edit-subject-btn').click(function() {
      var subject_id = $(this).data('id');
      var courseCode = $(this).data('coursecode');
      var courseTitle = $(this).data('coursetitle');
      var gradeLevel = $(this).data('gradelevel');
      var semester = $(this).data('semester');
      var subjectType = $(this).data('subjecttype');
      var subjectArea = $(this).data('subjectarea');
      var contactHours = $(this).data('contacthours');

      $('#edit_subject_id').val(subject_id);
      $('#edit_courseCode').val(courseCode);
      $('#edit_courseTitle').val(courseTitle);
      $('#edit_gradeLevel').val(gradeLevel);
      $('#edit_subjectArea').val(subjectArea);
      $('#edit_contactHours').val(contactHours);

      // Adjusting semester display based on grade level
      if (gradeLevel === "Grade 11" || gradeLevel === "Grade 12") {
        $('#edit_semesterSelect').show();
        $('#edit_semester').val(semester);
        $('#edit_subjectTypeSelect').show();
        $('#edit_subjectType').val(subjectType);
      } else {
        $('#edit_semesterSelect').hide();
        $('#edit_semester').val("");
        $('#edit_subjectTypeSelect').hide();
        $('#edit_subjectType').val("");
      }
    });
  });
</script>

<!-- delete truck function -->
</i> <script>
    $(document).ready(function() {
        $('.delete-subject-btn').click(function() {
            var subject_id = $(this).data('id');
            var courseCode = $(this).data('coursecode');
            var courseTitle = $(this).data('coursetitle')
           
            $('#delete_subject_id').val(subject_id);
           $('#delete_subject_name').text(courseCode + ': ' + courseTitle);
        });

        $('#delete_subject_form').submit(function(e) {
            e.preventDefault();
            var subject_id = $('#delete_subject_id').val();
            $.ajax({
                type: "POST",
                url: "crud_subject.php",
                data: {
                    delete_subject_id: subject_id
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + subject_id).hide();

                    // Show a success message with SweetAlert2 toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The subject has been deleted successfully.',
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
    function toggleSemester() {
        var gradeLevelSelect = document.getElementById("gradeLevel");
        var semesterSelect = document.getElementById("semesterSelect");
        var subjectTypeSelect = document.getElementById("subjectTypeSelect");

        if (gradeLevelSelect.value === "Grade 11" || gradeLevelSelect.value === "Grade 12") {
            semesterSelect.style.display = "block";
            subjectTypeSelect.style.display = "block";
        } else {
            semesterSelect.style.display = "none";
            subjectTypeSelect.style.display = "none";
        }
    }
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


