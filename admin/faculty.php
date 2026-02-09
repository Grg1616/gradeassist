<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Faculty</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item">File Management</li>
          <li class="breadcrumb-item active">Faculty</li>
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
        <div class="modal fade" id="addFaculty" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-plus-circle"></i>&nbsp; Add Faculty
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->
                 <form action="crud_faculty.php" method="POST">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="emp_number" name="emp_number" placeholder="Your Name" required>
                    <label for="emp_number">Employee Number</label>
                  </div>
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                    <input type="text" class="form-control" id="First" name="firstName" placeholder="Your Name" required>
                    <label for="First">First Name</label>
                  </div>
                      </div>

                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                    <input type="text" class="form-control" id="Middle" name="middleName" placeholder="Your Name" required>
                    <label for="Middle">Middle Name</label>
                  </div>
                      </div>
                        <div class="col-md-4 mb-3">
                          <div class="form-floating">
                    <input type="text" class="form-control" id="Last" name="lastName" placeholder="Your Name" required>
                    <label for="Last">Last Name</label>
                  </div>
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="Gender" name="gender" aria-label="State" required>
                          <option selected disabled value>Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Others">Others</option>
                      </select>
                      <label for="Gender">Gender</label>
                      <div class="invalid-feedback">
                        Please select a valid gender.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="Rank" name="rank" aria-label="State" required>
                          <option selected disabled value>Select Rank</option>
                          <option value="Instructor I">Instructor I</option>
                          <option value="Instructor II">Instructor II</option>
                          <option value="Instructor III">Instructor III</option>
                          <option value="Asst. Prof. I">Asst. Prof. I</option>
                          <option value="Asst. Prof. II">Asst. Prof. II</option>
                          <option value="Asst. Prof. III">Asst. Prof. III</option>
                          <option value="Asst. Prof. IV">Asst. Prof. IV</option>
                          <option value="Assoc. Prof. I">Assoc. Prof. I</option>
                          <option value="Assoc. Prof. II">Assoc. Prof. II</option>
                          <option value="Assoc. Prof. III">Assoc. Prof. III</option>
                          <option value="Assoc. Prof. IV">Assoc. Prof. IV</option>
                          <option value="Assoc. Prof. V">Assoc. Prof. V</option>
                          <option value="Professor I">Professor I</option>
                          <option value="Professor II">Professor II</option>
                          <option value="Professor III">Professor III</option>
                          <option value="Professor IV">Professor IV</option>
                          <option value="Professor VI">Professor VI</option>
                      </select>
                      <label for="Rank">Rank</label>
                      <div class="invalid-feedback">
                        Please select a valid rank.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="Designation" name="designation" aria-label="State" required>
                          <option selected disabled value>Select Designation</option>
                          <option value="Principal">Principal</option>
                          <option value="Chairperson">Chairperson</option>
                          <option value="Registrar">Registrar</option>
                          <option value="Faculty">Faculty</option>
                      </select>
                      <label for="Designation">Designation</label>
                      <div class="invalid-feedback">
                        Please select a valid designation.
                      </div>
                  </div>

                   <div class="form-floating mb-3">
                        <select class="form-select" id="Department" name="department" aria-label="State" required>
                            <option selected disabled value>Select Department</option>
                            <option value="Elementary">Elementary</option>
                            <option value="High School">High School</option>
                            <option value="Senior High School">Senior High School</option>
                        </select>
                        <label for="Department">Department</label>
                        <div class="invalid-feedback">
                        Please select a valid department.
                      </div>
                    </div>

                    <div class="form-floating mb-3">
                      <select class="form-select" id="Status" name="status" aria-label="Status" required>
                          <option selected disabled value>Select Status</option>
                          <option value="Permanent">Permanent</option>
                          <option value="Temporary">Temporary</option>
                      </select>
                      <label for="Designation">Status</label>
                      <div class="invalid-feedback">
                        Please select a valid status.
                      </div>
                  </div>

                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="addFaculty" class="btn btn-success">Save changes</button>
              </div>

              </form>

            </div>
          </div>
        </div>

        <!--  edit faculty -->
        <div class="modal fade" id="edit_faculty" tabindex="-1" aria-labelledby="editFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="editFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-pencil-square"></i>&nbsp; Edit Faculty
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->
                 <form action="crud_faculty.php" method="POST">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="edit_emp_number" name="edit_emp_number" placeholder="Your Name" required>
                    <label for="edit_emp_number">Employee Number</label>
                  </div>
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                    <input type="text" class="form-control" id="edit_firstName" name="edit_firstName" placeholder="Your Name" required>
                    <label for="edit_firstName">First Name</label>
                  </div>
                      </div>

                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                    <input type="text" class="form-control" id="edit_middleName" name="edit_middleName" placeholder="Your Name" required>
                    <label for="edit_middleName">Middle Name</label>
                  </div>
                      </div>
                        <div class="col-md-4 mb-3">
                          <div class="form-floating">
                    <input type="text" class="form-control" id="edit_lastName" name="edit_lastName" placeholder="Your Name" required>
                    <label for="edit_lastName">Last Name</label>
                  </div>
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="edit_gender" name="edit_gender" aria-label="State" required>
                          <option selected disabled value>Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Others">Others</option>
                      </select>
                      <label for="edit_gender">Gender</label>
                      <div class="invalid-feedback">
                        Please select a valid gender.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="edit_rank" name="edit_rank" aria-label="State" required>
                          <option selected disabled value>Select Rank</option>
                          <option value="Instructor I">Instructor I</option>
                          <option value="Instructor II">Instructor II</option>
                          <option value="Instructor III">Instructor III</option>
                          <option value="Asst. Prof. I">Asst. Prof. I</option>
                          <option value="Asst. Prof. II">Asst. Prof. II</option>
                          <option value="Asst. Prof. III">Asst. Prof. III</option>
                          <option value="Asst. Prof. IV">Asst. Prof. IV</option>
                          <option value="Assoc. Prof. I">Assoc. Prof. I</option>
                          <option value="Assoc. Prof. II">Assoc. Prof. II</option>
                          <option value="Assoc. Prof. III">Assoc. Prof. III</option>
                          <option value="Assoc. Prof. IV">Assoc. Prof. IV</option>
                          <option value="Assoc. Prof. V">Assoc. Prof. V</option>
                          <option value="Professor I">Professor I</option>
                          <option value="Professor II">Professor II</option>
                          <option value="Professor III">Professor III</option>
                          <option value="Professor IV">Professor IV</option>
                          <option value="Professor VI">Professor VI</option>
                      </select>
                      <label for="edit_rank">Rank</label>
                      <div class="invalid-feedback">
                        Please select a valid rank.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="edit_designation" name="edit_designation" aria-label="State" required>
                          <option selected disabled value>Select Designation</option>
                          <option value="Principal">Principal</option>
                          <option value="Chairperson">Chairperson</option>
                          <option value="Registrar">Registrar</option>
                          <option value="Faculty">Faculty</option>
                      </select>
                      <label for="edit_designation">Designation</label>
                      <div class="invalid-feedback">
                        Please select a valid designation.
                      </div>
                  </div>

                   <div class="form-floating mb-3">
                        <select class="form-select" id="edit_department" name="edit_department" aria-label="State" required>
                            <option selected disabled value>Select Department</option>
                            <option value="Elementary">Elementary</option>
                            <option value="High School">High School</option>
                            <option value="Senior High School">Senior High School</option>
                        </select>
                        <label for="edit_department">Department</label>
                        <div class="invalid-feedback">
                        Please select a valid department.
                      </div>
                    </div>

                    <div class="form-floating mb-3">
                      <select class="form-select" id="edit_status" name="edit_status" aria-label="Status" required>
                          <option selected disabled value>Select Status</option>
                          <option value="Permanent">Permanent</option>
                          <option value="Temporary">Temporary</option>
                      </select>
                      <label for="edit_status">Status</label>
                      <div class="invalid-feedback">
                        Please select a valid status.
                      </div>
                  </div>

                  <input type="hidden" id="edit_faculty_id" name="edit_faculty_id">

                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="edit_faculty" class="btn btn-success">Update changes</button>
              </div>

              </form>

            </div>
          </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="delete_faculty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Confirm</button>
                <input type="hidden" id="delete_faculty_id" name="delete_faculty_id">
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
                    <h6 class="m-0 font-weight-bold text-dark">List of Faculty</h6>
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

                       <a data-bs-toggle="modal" data-bs-target="#addFaculty" class="btn btn-sm btn-outline-default shadow-sm text-primary">
                          <span class="bi bi-plus-circle fa-sm me-1"></span> <!-- Added me-1 class for margin-right -->
                          Add Faculty
                       </a>


                    </div>
                </div>
            </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-sm table-hover table-bordered display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th class="">Name</th>
                  <th class="">Gender</th>
                  <th class="">Rank</th>
                  <th class="">Designation</th>
                  <th class="">Department</th>
                  <th class="">Status</th>
                  <th class="no-export">Actions</th>
                </tr>
              </thead>
              <tbody>
              
                <?php
                  $no = 1;
                  $query = "SELECT * FROM faculty";

                  $query_run = mysqli_query($conn, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $row) {
                          ?>
                            <tr class="small" style="white-space: nowrap; text-align:left;">
                             <td><?= $row['lastName'] ?: '-' ?>, <?= $row['firstName'] ?: '-' ?> <?= $row['middleName'] ? $row['middleName'][0] . '.' : ''; ?></td>
                              <td><?= $row['gender'] ?: '-'; ?></td>
                              <td><?= $row['rank'] ?: '-'; ?></td>
                              <td><?= $row['designation'] ?: '-'; ?></td>
                              <td><?= $row['department'] ?: '-'; ?></td>
                              <td><?= $row['status'] ?: '-'; ?></td>
                              <td class="d-flex justify-content-center">

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
                                            <i class="bi bi-info-circle"></i>&nbsp; View Faculty Details
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
                                                    <p class="mb-0"><strong>Employee Number</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['emp_number'] ?: '-' ?></p>
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
                                                    <p class="mb-0"><strong>Rank:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['rank'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Designation:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['designation'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Department:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['department'] ?: '-' ?></p>
                                                  </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                  <div class="col-sm-3 col">
                                                    <p class="mb-0"><strong>Status:</strong></p>
                                                  </div>
                                                  <div class="col-sm-9 col">
                                                    <p class="text-muted mb-0"><?= $row['status'] ?: '-' ?></p>
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


                                 <button class="btn btn-outline-primary btn-sm mx-1 edit-faculty-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#edit_faculty" 
                                        data-id="<?= $row['id']; ?>" 
                                        data-empnumber="<?= $row['emp_number']; ?>"
                                        data-firstname="<?= $row['firstName']; ?>"
                                        data-middlename="<?= $row['middleName']; ?>"
                                        data-lastname="<?= $row['lastName']; ?>"
                                        data-gender="<?= $row['gender']; ?>"
                                        data-rank="<?= $row['rank']; ?>"
                                        data-designation="<?= $row['designation']; ?>"
                                        data-department="<?= $row['department']; ?>"
                                        data-status="<?= $row['status']; ?>" 
                                        data-bs-tooltip="tooltip" 
                                        data-placement="top" 
                                        title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <button class="btn btn-outline-danger btn-sm mx-1 delete-faculty-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#delete_faculty" 
                                        data-id="<?= $row['id']; ?>" 
                                        data-firstname="<?= $row['firstName']; ?>"
                                        data-middlename="<?= $row['middleName']; ?>"
                                        data-lastname="<?= $row['lastName']; ?>"
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
    $('.edit-faculty-btn').click(function() {
      var faculty_id = $(this).data('id');
      var emp_number = $(this).data('empnumber');
      var firstName = $(this).data('firstname');
      var middleName = $(this).data('middlename');
      var lastName = $(this).data('lastname');
      var gender = $(this).data('gender');
      var rank = $(this).data('rank');
      var designation = $(this).data('designation');
      var department = $(this).data('department');
      var status = $(this).data('status');

      $('#edit_faculty_id').val(faculty_id);
      $('#edit_emp_number').val(emp_number);
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
</i> <script>
    $(document).ready(function() {
        $('.delete-faculty-btn').click(function() {
            var faculty_id = $(this).data('id');
            var firstName = $(this).data('firstname');
            var middleName = $(this).data('middlename');
            var lastName = $(this).data('lastname');
           
            $('#delete_faculty_id').val(faculty_id);
            $('#delete_faculty_fullname').text(firstName + ' ' + middleName + ' ' + lastName);
        });

        $('#delete_faculty_form').submit(function(e) {
            e.preventDefault();
            var faculty_id = $('#delete_faculty_id').val();
            $.ajax({
                type: "POST",
                url: "crud_faculty.php",
                data: {
                    delete_faculty_id: faculty_id
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + faculty_id).hide();

                    // Show a success message with SweetAlert2 toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The faculty has been deleted successfully.',
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


