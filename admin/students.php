<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Students</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item">File Management</li>
          <li class="breadcrumb-item active">Students</li>
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
            if (isset($_SESSION['message_ok'])) {
                // Replace newlines with <br> tags
                $message = str_replace("\n", "<br>", $_SESSION['message_ok']);
                echo "Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        html: '$message',
                        showConfirmButton: true,
                        customClass: {
                            popup: 'my-sweetalert',
                        }
                    });";
                unset($_SESSION['message_ok']); // Clear the session message after displaying it
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
            if (isset($_SESSION['message_danger_ok'])) {
                echo "Swal.fire({
                        icon: 'warning',
                        title: 'Error!',
                        text: '{$_SESSION['message_danger_ok']}',
                        showConfirmButton: true,
                        customClass: {
                            popup: 'my-sweetalert',
                        }
                    });";
                unset($_SESSION['message_danger_ok']); // Clear the session message after displaying it
            }
            ?>
        </script>


       <!--  add student -->
        <div class="modal fade" id="add_student" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-plus-circle"></i>&nbsp; Add Student
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->
                 <form action="crud_student.php" method="POST">

                  <div class="row">
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="sr_code" name="sr_code" placeholder="Your Name" required>
                              <label for="sr_code">SR-Code</label>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="number" class="form-control" id="lrn" name="lrn" placeholder="Your Name" required>
                              <label for="lrn">LRN</label>
                          </div>
                      </div>
                  </div>

                  <p class="mb-0 fw-bold h6">Student Details</p>
                  <hr class="py-0 mt-1">
                  

                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Your Name" required>
                              <label for="firstName">First Name</label>
                          </div>
                      </div>
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Your Name" required>
                              <label for="middleName">Middle Name</label>
                          </div>
                      </div>
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Your Name" required>
                              <label for="lastName">Last Name</label>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <select class="form-select" id="gender" name="gender" aria-label="State" required>
                                  <option selected disabled value>Select Gender</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                  <option value="Others">Others</option>
                              </select>
                              <label for="gender">Gender</label>
                              <div class="invalid-feedback">
                                Please select a valid gender.
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Your Name" required>
                              <label for="birthday">Birthday</label>
                          </div>
                      </div>
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="religion" name="religion" placeholder="Your Name" required>
                              <label for="religion">Religion</label>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="number" class="form-control" id="contactNumber" name="contactNumber" placeholder="Your Name" required>
                              <label for="contactNumber">Contact Number</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                              <input type="email" class="form-control" id="email" name="email" placeholder="Your Name" required>
                              <label for="email">Email Address</label>
                          </div>
                      </div>
                  </div>

                   <div class="form-floating mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="homeAddress" name="homeAddress" placeholder="Your Name" required>
                              <label for="homeAddress">Home Address</label>
                          </div>
                  </div>
                  
                  <p class="mb-0 fw-bold h6">Father Details</p>
                  <hr class="py-0 mt-1">
                  

                  <div class="row mt-3">
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="fatherName" name="fatherName" placeholder="Your Name">
                              <label for="fatherName">Father's Name (ex. Juan B. Dela Cruz)</label>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="fatherOccupation" name="fatherOccupation" placeholder="Your Name">
                              <label for="fatherOccupation">Occupation</label>
                          </div>
                      </div>
                  </div>
                  
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="number" class="form-control" id="fatherContact" name="fatherContact" placeholder="Your Name">
                              <label for="fatherContact">Contact Number</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                              <input type="email" class="form-control" id="fatherEmail" name="fatherEmail" placeholder="Your Name">
                              <label for="fatherEmail">Email Address</label>
                          </div>
                      </div>
                  </div>

                  <p class="mb-0 fw-bold h6">Mother Details</p>
                  <hr class="py-0 mt-1">

                  <div class="row mt-3">
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="motherName" name="motherName" placeholder="Your Name">
                              <label for="motherName">Mother's Name (ex. Maria B. Dela Cruz)</label>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="motherOccupation" name="motherOccupation" placeholder="Your Name">
                              <label for="motherOccupation">Occupation</label>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="number" class="form-control" id="motherContact" name="motherContact" placeholder="Your Name">
                              <label for="motherContact">Contact Number</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                              <input type="email" class="form-control" id="motherEmail" name="motherEmail" placeholder="Your Name">
                              <label for="motherEmail">Email Address</label>
                          </div>
                      </div>
                  </div>

                  <p class="mb-0 fw-bold h6">Guardian Details</p>
                  <hr class="py-0 mt-1">

                  <div class="row mt-3">
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="guardianName" name="guardianName" placeholder="Your Name">
                              <label for="guardianName">Guardian's Name (ex. Juan B. Dela Cruz)</label>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="guardianOccupation" name="guardianOccupation" placeholder="Your Name">
                              <label for="guardianOccupation">Occupation</label>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="tel" class="form-control" id="guardianContact" name="guardianContact" placeholder="Your Name">
                              <label for="guardianContact">Contact Number</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                              <input type="email" class="form-control" id="guardianEmail" name="guardianEmail" placeholder="Your Name">
                              <label for="guardianEmail">Email Address</label>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_student" class="btn btn-success">Save changes</button>
              </div>

              </form>

            </div>
          </div>
        </div>

        <!-- edit student -->
        <div class="modal fade" id="edit_student" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-pencil-square"></i>&nbsp; Edit Student
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->
                 <form action="crud_student.php" method="POST">

                  <div class="row">
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_sr_code" name="edit_sr_code" placeholder="Your Name" required>
                              <label for="edit_sr_code">SR-Code</label>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_lrn" name="edit_lrn" placeholder="Your Name" required>
                              <label for="edit_lrn">LRN</label>
                          </div>
                      </div>
                  </div>

                  <p class="mb-0 fw-bold h6">Student Details</p>
                  <hr class="py-0 mt-1">
                  

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

                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
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
                      </div>
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="date" class="form-control" id="edit_birthday" name="edit_birthday" placeholder="Your Name" required>
                              <label for="edit_birthday">Birthday</label>
                          </div>
                      </div>
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_religion" name="edit_religion" placeholder="Your Name" required>
                              <label for="edit_religion">Religion</label>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="number" class="form-control" id="edit_contactNumber" name="edit_contactNumber" placeholder="Your Name" required>
                              <label for="edit_contactNumber">Contact Number</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                              <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="Your Name" required>
                              <label for="edit_email">Email Address</label>
                          </div>
                      </div>
                  </div>

                   <div class="form-floating mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_homeAddress" name="edit_homeAddress" placeholder="Your Name" required>
                              <label for="edit_homeAddress">Home Address</label>
                          </div>
                  </div>
                  
                  <p class="mb-0 fw-bold h6">Father Details</p>
                  <hr class="py-0 mt-1">
                  

                  <div class="row mt-3">
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_fatherName" name="edit_fatherName" placeholder="Your Name" >
                              <label for="edit_fatherName">Father's Name (ex. Juan B. Dela Cruz)</label>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_fatherOccupation" name="edit_fatherOccupation" placeholder="Your Name" >
                              <label for="edit_fatherOccupation">Occupation</label>
                          </div>
                      </div>
                  </div>
                  
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="number" class="form-control" id="edit_fatherContact" name="edit_fatherContact" placeholder="Your Name" >
                              <label for="edit_fatherContact">Contact Number</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                              <input type="email" class="form-control" id="edit_fatherEmail" name="edit_fatherEmail" placeholder="Your Name" >
                              <label for="edit_fatherEmail">Email Address</label>
                          </div>
                      </div>
                  </div>

                  <p class="mb-0 fw-bold h6">Mother Details</p>
                  <hr class="py-0 mt-1">

                  <div class="row mt-3">
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_motherName" name="edit_motherName" placeholder="Your Name" >
                              <label for="edit_motherName">Mother's Name (ex. Maria B. Dela Cruz)</label>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_motherOccupation" name="edit_motherOccupation" placeholder="Your Name" >
                              <label for="edit_motherOccupation">Occupation</label>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="number" class="form-control" id="edit_motherContact" name="edit_motherContact" placeholder="Your Name" >
                              <label for="edit_motherContact">Contact Number</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                              <input type="email" class="form-control" id="edit_motherEmail" name="edit_motherEmail" placeholder="Your Name" >
                              <label for="edit_motherEmail">Email Address</label>
                          </div>
                      </div>
                  </div>

                  <p class="mb-0 fw-bold h6">Guardian Details</p>
                  <hr class="py-0 mt-1">

                  <div class="row mt-3">
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_guardianName" name="edit_guardianName" placeholder="Your Name" >
                              <label for="edit_guardianName">Guardian's Name (ex. Juan B. Dela Cruz)</label>
                          </div>
                      </div>
                      <div class="col-md-6 mb-3">
                          <div class="form-floating">
                              <input type="text" class="form-control" id="edit_guardianOccupation" name="edit_guardianOccupation" placeholder="Your Name" >
                              <label for="edit_guardianOccupation">Occupation</label>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <div class="form-floating">
                              <input type="number" class="form-control" id="edit_guardianContact" name="edit_guardianContact" placeholder="Your Name" >
                              <label for="edit_guardianContact">Contact Number</label>
                          </div>
                      </div>
                      <div class="col-md-8 mb-3">
                          <div class="form-floating">
                              <input type="email" class="form-control" id="edit_guardianEmail" name="edit_guardianEmail" placeholder="Your Name" >
                              <label for="edit_guardianEmail">Email Address</label>
                          </div>
                      </div>
                  </div>

                   <input type="hidden" id="edit_student_id" name="edit_student_id">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="edit_student" class="btn btn-success">Update changes</button>
              </div>

              </form>

            </div>
          </div>
        </div>


        <!-- delete student -->
        <div class="modal fade" id="delete_student" tabindex="-1" aria-labelledby="editstudentLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editstudentLabel" style="font-weight: bold;">
                 <i class="bi bi-trash"></i></i>&nbsp; Delete Student
              </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <form id="delete_student_form" action="crud_student.php" method="POST">
              <div class="modal-body">
                <span class="text-danger font-weight-bold">Warning! </span><span>Deleting the student <span class="fw-bold" id="delete_student_fullname"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                <p>Are you sure you want to proceed with the deletion?</p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Confirm</button>
                <input type="hidden" id="delete_student_id" name="delete_student_id">
              </div>
               </form>
            </div>
          </div>
        </div>

        
        <!-- import students -->
        <div class="modal fade" id="import_student" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-upload"></i>&nbsp; Import Student
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form action="import_student.php" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                  <label for="csvFile" class="form-label">Choose CSV file:</label>
                  <input type="file" class="form-control" id="csvFile" name="csvFile" accept=".csv" required>
                </div>
                

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="import_student" class="btn btn-success">Import Students</button>
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
                      <h6 class="m-0 font-weight-bold text-dark">List of Students</h6>
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

                        <a data-bs-toggle="modal" data-bs-target="#import_student" class="btn btn-sm btn-outline-default shadow-sm text-primary">
                            <span class="bi bi-upload fa-sm me-1"></span> <!-- Added me-1 class for margin-right -->
                            Import Student
                         </a>

                         <a data-bs-toggle="modal" data-bs-target="#add_student" class="btn btn-sm btn-outline-default shadow-sm text-primary">
                            <span class="bi bi-plus-circle fa-sm me-1"></span> <!-- Added me-1 class for margin-right -->
                            Add Student
                         </a>


                      </div>
                  </div>
              </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-sm table-hover table-bordered display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th class="">SR-Code</th>
                  <th class="">LRN</th>
                  <th class="">Name</th>
                  <th class="">Gender</th>
                  <!-- <th class="">Birthday</th> -->
                  <th class="">Contact Number</th>
                  <!-- <th class="">Home Address</th> -->
                  <th class="">Email Address</th>
                  <!-- <th class="">Religion</th> -->
                  <th class="no-export">Actions</th>
                </tr>
              </thead>
              <tbody>
              
                <?php
                  $no = 1;
                  $query = "SELECT * FROM students";

                  $query_run = mysqli_query($conn, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $row) {
                          ?>
                          <tr class="small" style="white-space: nowrap; text-align:left;">
                            <td><?= $row['sr_code'] ?: '-'; ?></td>
                            <td><?= $row['lrn'] ?: '-'; ?></td>
                            <td><?= $row['lastName'] ?: '-' ?>, <?= $row['firstName'] ?: '-' ?> <?= $row['middleName'] ? $row['middleName'][0] . '.' : ''; ?></td>
                            <td><?= $row['gender'] ?: '-'; ?></td>
                            <!-- <td><?= $row['birthday'] ?: '-'; ?></td> -->
                            <td><?= $row['contactNumber'] ?: '-'; ?></td>
                            <!-- <td><?= $row['homeAddress'] ?: '-'; ?></td> -->
                            <td><?= $row['email'] ?: '-'; ?></td>
                            <!-- <td><?= $row['religion'] ?: '-'; ?></td> -->
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


                                <button class="btn btn-outline-primary btn-sm mx-1 edit-student-btn" 
                                      data-bs-toggle="modal" 
                                      data-bs-target="#edit_student" 
                                      data-id="<?= $row['id']; ?>" 
                                      data-sr-code="<?= $row['sr_code']; ?>" 
                                      data-lrn="<?= $row['lrn']; ?>"
                                      data-firstname="<?= $row['firstName']; ?>"
                                      data-middlename="<?= $row['middleName']; ?>"
                                      data-lastname="<?= $row['lastName']; ?>"
                                      data-gender="<?= $row['gender']; ?>"
                                      data-birthday="<?= $row['birthday']; ?>"
                                      data-contactnumber="<?= $row['contactNumber']; ?>"
                                      data-homeaddress="<?= $row['homeAddress']; ?>"
                                      data-email="<?= $row['email']; ?>"
                                      data-religion="<?= $row['religion']; ?>"
                                      data-fathername="<?= $row['fatherName']; ?>"
                                      data-fatheroccupation="<?= $row['fatherOccupation']; ?>"
                                      data-fathercontact="<?= $row['fatherContact']; ?>"
                                      data-fatheremail="<?= $row['fatherEmail']; ?>"
                                      data-mothername="<?= $row['motherName']; ?>"
                                      data-motheroccupation="<?= $row['motherOccupation']; ?>"
                                      data-mothercontact="<?= $row['motherContact']; ?>"
                                      data-motheremail="<?= $row['motherEmail']; ?>"
                                      data-guardianname="<?= $row['guardianName']; ?>"
                                      data-guardianoccupation="<?= $row['guardianOccupation']; ?>"
                                      data-guardiancontact="<?= $row['guardianContact']; ?>"
                                      data-guardianemail="<?= $row['guardianEmail']; ?>"
                                      data-bs-tooltip="tooltip" 
                                      data-placement="top" 
                                      title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>


                                <button class="btn btn-outline-danger btn-sm mx-1 delete-student-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#delete_student" 
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
    $('.edit-student-btn').click(function() {
      var faculty_id = $(this).data('id');
      var sr_code = $(this).data('sr-code');
      var lrn = $(this).data('lrn');
      var firstName = $(this).data('firstname');
      var middleName = $(this).data('middlename');
      var lastName = $(this).data('lastname');
      var gender = $(this).data('gender');
      var birthday = $(this).data('birthday');
      var contactNumber = $(this).data('contactnumber');
      var homeAddress = $(this).data('homeaddress');
      var email = $(this).data('email');
      var religion = $(this).data('religion');
      var fatherName = $(this).data('fathername');
      var fatherOccupation = $(this).data('fatheroccupation');
      var fatherContact = $(this).data('fathercontact');
      var fatherEmail = $(this).data('fatheremail');
      var motherName = $(this).data('mothername');
      var motherOccupation = $(this).data('motheroccupation');
      var motherContact = $(this).data('mothercontact');
      var motherEmail = $(this).data('motheremail');
      var guardianName = $(this).data('guardianname');
      var guardianOccupation = $(this).data('guardianoccupation');
      var guardianContact = $(this).data('guardiancontact');
      var guardianEmail = $(this).data('guardianemail');

      $('#edit_student_id').val(faculty_id);
      $('#edit_sr_code').val(sr_code);
      $('#edit_lrn').val(lrn);
      $('#edit_firstName').val(firstName);
      $('#edit_middleName').val(middleName);
      $('#edit_lastName').val(lastName);
      $('#edit_gender').val(gender);
      $('#edit_birthday').val(birthday);
      $('#edit_contactNumber').val(contactNumber);
      $('#edit_homeAddress').val(homeAddress);
      $('#edit_email').val(email);
      $('#edit_religion').val(religion);
      $('#edit_fatherName').val(fatherName);
      $('#edit_fatherOccupation').val(fatherOccupation);
      $('#edit_fatherContact').val(fatherContact);
      $('#edit_fatherEmail').val(fatherEmail);
      $('#edit_motherName').val(motherName);
      $('#edit_motherOccupation').val(motherOccupation);
      $('#edit_motherContact').val(motherContact);
      $('#edit_motherEmail').val(motherEmail);
      $('#edit_guardianName').val(guardianName);
      $('#edit_guardianOccupation').val(guardianOccupation);
      $('#edit_guardianContact').val(guardianContact);
      $('#edit_guardianEmail').val(guardianEmail);
    });
  });
</script>


<!-- delete truck function -->
</i> <script>
    $(document).ready(function() {
        $('.delete-student-btn').click(function() {
            var student_id = $(this).data('id');
            var firstName = $(this).data('firstname');
            var middleName = $(this).data('middlename');
            var lastName = $(this).data('lastname');
           
            $('#delete_student_id').val(student_id);
            $('#delete_student_fullname').text(firstName + ' ' + middleName + ' ' + lastName);
        });

        $('#delete_student_form').submit(function(e) {
            e.preventDefault();
            var student_id = $('#delete_student_id').val();
            $.ajax({
                type: "POST",
                url: "crud_student.php",
                data: {
                    delete_student_id: student_id
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + student_id).hide();

                    // Show a success message with SweetAlert2 toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The student has been deleted successfully.',
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


