<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && $_SESSION['userType'] === 'admin') {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Manage Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Manage Users</li>
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
        <div class="modal fade" id="add_grading_system" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-plus-circle"></i>&nbsp; Add Grading System
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->

                 <form action="crud_grading.php" method="POST">

                 <div class="form-floating mb-3">
                      <select class="form-select" id="component" name="component" aria-label="Subject Area" required>
                          <option selected disabled value>Select Component</option>
                          <option value="Written Work">Written Work</option>
                          <option value="Performance Task">Performance Task</option>
                          <option value="Quarterly Assessment">Quarterly Assessment</option>
                      </select>
                      <label for="component">Component</label>
                      <div class="invalid-feedback">
                          Please select a valid component.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="subjectArea" name="subjectArea" aria-label="Subject Area" required>
                          <option selected disabled value>Select Subject Area</option>
                          <option value="Mathematics">Mathematics</option>
                          <option value="Language">Language</option>
                      </select>
                      <label for="subjectArea">Subject Area</label>
                      <div class="invalid-feedback">
                          Please select a valid subject area.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="level" name="level" aria-label="State" required>
                          <option selected disabled value>Select Level</option>
                          <option value="Elementary">Elementary</option>
                          <option value="High School">High School</option>
                          <option value="Senior High School">Senior High School</option>
                      </select>
                      <label for="level">Level</label>
                      <div class="invalid-feedback">
                      Please select a valid level.
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="weight" name="weight" placeholder="Your Name" required>
                      <label for="weight">Weight</label>
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_grading_system" class="btn btn-primary">Save changes</button>
              </div>

              </form>

            </div>
          </div>
        </div>

        <!--  edit Subjects -->
        <div class="modal fade" id="edit_grading_system" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-pencil-square"></i>&nbsp; Edit Grading System
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form -->

                 <form action="crud_grading.php" method="POST">

                 <div class="form-floating mb-3">
                      <select class="form-select" id="edit_component" name="edit_component" aria-label="Subject Area" required>
                          <option selected disabled value>Select Component</option>
                          <option value="Written Work">Written Work</option>
                          <option value="Performance Task">Performance Task</option>
                          <option value="Quarterly Assessment">Quarterly Assessment</option>
                      </select>
                      <label for="edit_component">Component</label>
                      <div class="invalid-feedback">
                          Please select a valid component.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="edit_subjectArea" name="edit_subjectArea" aria-label="Subject Area" required>
                          <option selected disabled value>Select Subject Area</option>
                          <option value="Mathematics">Mathematics</option>
                          <option value="Language">Language</option>
                      </select>
                      <label for="edit_subjectArea">Subject Area</label>
                      <div class="invalid-feedback">
                          Please select a valid subject area.
                      </div>
                  </div>

                  <div class="form-floating mb-3">
                      <select class="form-select" id="edit_level" name="edit_level" aria-label="State" required>
                          <option selected disabled value>Select Level</option>
                          <option value="Elementary">Elementary</option>
                          <option value="High School">High School</option>
                          <option value="Senior High School">Senior High School</option>
                      </select>
                      <label for="edit_level">Level</label>
                      <div class="invalid-feedback">
                      Please select a valid level.
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="edit_weight" name="edit_weight" placeholder="Your Name" required>
                      <label for="edit_weight">Weight</label>
                  </div>

                  <input type="hidden" id="edit_grading_id" name="edit_grading_id">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="edit_grading_system" class="btn btn-primary">Update changes</button>
              </div>

              </form>

            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="delete_grading_system" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editFacultyLabel" style="font-weight: bold;">
                 <i class="bi bi-trash"></i></i>&nbsp; Delete Grading System
              </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <form id="delete_grading_form" action="crud_grading.php" method="POST">
              <div class="modal-body">
                <span class="text-danger font-weight-bold">Warning! </span><span>Deleting the grading system for <span class="fw-bold" id="delete_component"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                <p>Are you sure you want to proceed with the deletion?</p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="confirm_delete_btn" class="btn btn-primary">Confirm</button>
                <input type="hidden" id="delete_grading_id" name="delete_grading_id">
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
                    <h6 class="m-0 font-weight-bold text-dark">List of Users</h6>
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

                       <!-- <a data-bs-toggle="modal" data-bs-target="#add_grading_system" class="btn btn-sm btn-outline-default shadow-sm text-primary">
                          <span class="bi bi-plus-circle fa-sm me-1"></span> 
                          Add User
                       </a> -->


                    </div>
                </div>
            </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-sm table-hover table-bordered display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th class="">No.</th>
                  <th class="no-export">Profile</th>
                  <th class="">Name</th>
                  <th class="">Username</th>
                  <th class="">User Type</th>
                  <th class="text-center no-export">Account Status</th>
                  <th class="text-center no-export">Activity Status</th>
                  <th class="">Date Created</th>  
                  <th class="">Date Updated</th> 
                  <!-- <th class="no-export">Actions</th>  -->
                </tr>
              </thead>
              <tbody>
              
<?php
$no = 1;
$query = "
    SELECT u.*, 
           CASE 
               WHEN u.userType IN ('principal', 'chairperson', 'registrar', 'faculty') THEN f.firstName
               WHEN u.userType = 'student' THEN s.firstName
           END as firstName,
           CASE 
               WHEN u.userType IN ('principal', 'chairperson', 'registrar', 'faculty') THEN f.middleName
               WHEN u.userType = 'student' THEN s.middleName
           END as middleName,
           CASE 
               WHEN u.userType IN ('principal', 'chairperson', 'registrar', 'faculty') THEN f.lastName
               WHEN u.userType = 'student' THEN s.lastName
           END as lastName
    FROM users u
    LEFT JOIN faculty f ON u.user_id = f.id AND u.userType IN ('principal', 'chairperson', 'registrar', 'faculty')
    LEFT JOIN students s ON u.user_id = s.id AND u.userType = 'student'
    WHERE u.userType != 'admin'";

$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        if (!isset($row['image']) || empty($row['image'])) {
            $profile_picture = "../assets/img/user.png";
        } else {
            $profile_picture = "../uploads/" . $row['image'];
        }
?>
        <tr class="small" style="white-space: nowrap; text-align:left;">
            <td><?= $no++; ?></td>
            <td class="text-center"><img src="<?= $profile_picture ?>" alt="Profile Picture" class="rounded-circle" width="30" style="width: 30px; height: 30px;"></td>
            <td><?= $row['lastName'] ?: '-' ?>, <?= $row['firstName'] ?: '-' ?> <?= $row['middleName'] ? $row['middleName'][0] . '.' : ''; ?></td>
            <td><?= $row['username'] ?: '-'; ?></td>
            <td class="text-capitalize"><?= $row['userType'] ?: '-'; ?></td>
            <td class="text-capitalize">
                <form class="filterForm" action="update_status.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $row['id']; ?>">
                    <input type="hidden" name="status" class="status-input" value="<?= ($row['status'] == 'enabled') ? '1' : '0'; ?>">
                    <div class="d-flex justify-content-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input status-switch" type="checkbox" <?= ($row['status'] == 'enabled') ? 'checked' : ''; ?>>
                            <label class="form-check-label small" for="statusSwitch<?= $row['id']; ?>">
                                <?= $row['status']; ?>
                            </label>
                        </div>
                    </div>
                </form>
            </td>

            <td class="text-capitalize text-center">
                <?php if ($row['online_status'] === 'online'): ?>
                    <span class="badge bg-success"><?= $row['online_status']; ?></span>
                <?php elseif ($row['online_status'] === 'offline'): ?>
                    <span class="badge bg-danger"><?= $row['online_status']; ?></span>
                <?php else: ?>
                    <span class="badge bg-secondary">-</span>
                <?php endif; ?>
            </td>
            <td><?= $row['dateCreated'] ? date('F j, Y g:i a', strtotime($row['dateCreated'])) : '-'; ?></td>
            <td><?= $row['dateUpdated'] ? date('F j, Y g:i a', strtotime($row['dateUpdated'])) : '-'; ?></td>
        </tr>
<?php
    }
} else {
    // echo "<h5> No Record Found </h5>";
}
?>

<script>
    // Add event listener for checkbox change
    document.querySelectorAll('.status-switch').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var statusInput = this.closest('form').querySelector('.status-input');
            if (this.checked) {
                // If checkbox is checked, set the value of hidden input to 1
                statusInput.value = "1";
            } else {
                // If checkbox is unchecked, set the value of hidden input to 0
                statusInput.value = "0";
            }
            this.closest('form').submit(); // Submit the form whenever checkbox state changes
        });
    });
</script>



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
    $('.edit-grading_system-btn').click(function() {
      var grading_id = $(this).data('id');
      var component = $(this).data('component');
      var subjectArea = $(this).data('subjectarea');
      var level = $(this).data('level');
      var weight = $(this).data('weight');

      $('#edit_grading_id').val(grading_id);
      $('#edit_component').val(component);
      $('#edit_subjectArea').val(subjectArea);
      $('#edit_level').val(level);
      $('#edit_weight').val(weight);
    });
  });
</script>


<!-- delete truck function -->
</i> <script>
    $(document).ready(function() {
        $('.delete-grading-btn').click(function() {
            var grading_id = $(this).data('id');
            var component = $(this).data('component');
            var subjectArea = $(this).data('subjectarea')
           
          $('#delete_grading_id').val(grading_id);
          $('#delete_component').text(component + ' for ' + subjectArea);
        });

        $('#delete_grading_form').submit(function(e) {
            e.preventDefault();
            var grading_id = $('#delete_grading_id').val();
            $.ajax({
                type: "POST",
                url: "crud_grading.php",
                data: {
                    delete_grading_id: grading_id
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + grading_id).hide();

                    // Show a success message with SweetAlert2 toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The grading system has been deleted successfully.',
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


