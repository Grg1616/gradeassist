<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_admin.php');
require '../db_conn.php';
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Grading System</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item">File Management</li>
          <li class="breadcrumb-item active">Grading System</li>
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

             <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Component</th>
                        <th>Weight(%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Written Work</td>
                        <td><input type="number" class="form-control" name="written" id="written" aria-label="Written Work Weight" oninput="calculateTotal()" required></td>
                    </tr>
                    <tr>
                        <td>Performance Task</td>
                        <td><input type="number" class="form-control" name="performance" id="performance" aria-label="Performance Task Weight" oninput="calculateTotal()" required></td>
                    </tr>
                    <tr>
                        <td>Quarterly Assessment</td>
                        <td><input type="number" class="form-control" name="assessment" id="assessment" aria-label="Quarterly Assessment Weight" oninput="calculateTotal()" required></td>
                    </tr>
                    <tr>
                        <td class="text-center fw-semibold">Total:</td>
                        <td class="text-center fw-semibold"> <span id="total">0%</span></td>
                    </tr>
                </tbody>
            </table>
            <style>
                .red {
                    color: red;
                }
                .green {
                    color: green;
                }
            </style>
            <script>
                function calculateTotal() {
                    // Retrieve the values entered by the user
                    var written = parseFloat(document.getElementById('written').value) || 0;
                    var performance = parseFloat(document.getElementById('performance').value) || 0;
                    var assessment = parseFloat(document.getElementById('assessment').value) || 0;

                    // Calculate the total
                    var total = written + performance + assessment;

                    // Display the total
                    var totalElement = document.getElementById('total');
                    totalElement.innerText = total % 1 === 0 ? total.toFixed(0) + '%' : total.toFixed(2) + '%';

                    // Check if the total is equal to 100
                    if (total === 100) {
                      totalElement.classList.remove('red');
                      totalElement.classList.add('green'); // Add the 'green' class when total is 100
                    } else {
                        totalElement.classList.remove('green'); // Remove 'green' class if total is not 100
                        totalElement.classList.add('red');
                    }
                }
            </script>


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
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_grading_system" class="btn btn-success">Save changes</button>
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

                 <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Component</th>
                            <th>Weight(%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Written Work</td>
                            <td><input type="number" class="form-control" name="edit_written" id="edit_written" aria-label="Written Work Weight" oninput="editcalculateTotal()" required></td>
                        </tr>
                        <tr>
                            <td>Performance Task</td>
                            <td><input type="number" class="form-control" name="edit_performance" id="edit_performance" aria-label="Performance Task Weight" oninput="editcalculateTotal()" required></td>
                        </tr>
                        <tr>
                            <td>Quarterly Assessment</td>
                            <td><input type="number" class="form-control" name="edit_assessment" id="edit_assessment" aria-label="Quarterly Assessment Weight" oninput="editcalculateTotal()" required></td>
                        </tr>
                        <tr>
                            <td class="text-center fw-semibold">Total:</td>
                            <td class="text-center fw-semibold"> <span id="editTotal">0%</span></td>
                        </tr>
                    </tbody>
                </table>

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

                  <input type="hidden" id="edit_grading_id" name="edit_grading_id">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="edit_grading_system" class="btn btn-success">Update changes</button>
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
                <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Confirm</button>
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
                    <h6 class="m-0 font-weight-bold text-dark">List of Grading System</h6>
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

                       <a data-bs-toggle="modal" data-bs-target="#add_grading_system" class="btn btn-sm btn-outline-default shadow-sm text-primary">
                          <span class="bi bi-plus-circle fa-sm me-1"></span> 
                          Add Grading System
                       </a>


                    </div>
                </div>
            </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-sm table-hover table-bordered display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th class="">Subject Area</th>
                  <th class="">Written Work</th>
                  <th class="">Performance Task</th>
                  <th class="">Quarterly Assestment</th>
                  <th class="">Level</th>
                  <th class="no-export">Actions</th>
                </tr>
              </thead>
              <tbody>
              
                <?php
$no = 1;
$query = "SELECT * FROM grading_system";
$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $row) {
        ?>
        <tr class="small" style="white-space: nowrap; text-align:left;">   
            <td><?= $row['subjectArea'] ?: '-'; ?></td>
            <td><?= $row['written'] ?: '-'; ?></td>
            <td><?= $row['performance'] ?: '-'; ?></td>
            <td><?= $row['assessment'] ?: '-'; ?></td>
            <td><?= $row['level'] ?: '-'; ?></td>
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
                                    <i class="bi bi-info-circle"></i>&nbsp; View Grading System Details
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-body"> 
                                                

                                                <?php
                                                $totalPercentage = ($row['written'] ?? 0) + ($row['performance'] ?? 0) + ($row['assessment'] ?? 0);
                                                ?>

                                                <table class="table table-sm table-hover table-bordered mt-3" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Component</th>
                                                            <th>Weight(%)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Written Work</td>
                                                            <td><?= $row['written'] ?? '-' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Performance Task</td>
                                                            <td><?= $row['performance'] ?? '-' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Quarterly Assessment</td>
                                                            <td><?= $row['assessment'] ?? '-' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center fw-semibold">Total:</td>
                                                            <td class="text-center fw-semibold"><?= $totalPercentage ?>%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="row mt-5">
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
                                                        <p class="mb-0"><strong>Level:</strong></p>
                                                    </div>
                                                    <div class="col-sm-9 col">
                                                        <p class="text-muted mb-0"><?= $row['level'] ?: '-' ?></p>
                                                    </div>
                                                </div>
                                                <hr>

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


                <button class="btn btn-outline-primary btn-sm mx-1 edit-grading_system-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#edit_grading_system" 
                        data-id="<?= $row['id']; ?>" 
                        data-written="<?= $row['written']; ?>"
                        data-performance="<?= $row['performance']; ?>"
                        data-assessment="<?= $row['assessment']; ?>"
                        data-subjectarea="<?= $row['subjectArea']; ?>"
                        data-level="<?= $row['level']; ?>"
                        data-bs-tooltip="tooltip" 
                        data-placement="top" 
                        title="Edit">
                    <i class="bi bi-pencil-square"></i>
                </button>

                <button class="btn btn-outline-danger btn-sm mx-1 delete-grading_system-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#delete_grading_system" 
                        data-id="<?= $row['id']; ?>" 
                        data-level="<?= $row['level']; ?>" 
                        data-subjectarea="<?= $row['subjectArea']; ?>"
                        data-bs-tooltip="tooltip" 
                        data-placement="top" 
                        title="Delete">
                    <i class="bi bi-trash"></i>
                </button>



                             
            </td>
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
      </div>
      <!-- End Card with header and footer -->
    </div>
  </div>
</section>


  </main><!-- End #main -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- edit truck function -->
<script>
$(document).ready(function() {
    // Bind calculateTotal function to input events
    $('#edit_written, #edit_performance, #edit_assessment').on('input', function() {
        editcalculateTotal();
    });

    $('.edit-grading_system-btn').click(function() {
        var grading_id = $(this).data('id');
        var written = $(this).data('written');
        var performance = $(this).data('performance');
        var assessment = $(this).data('assessment');
        var subjectArea = $(this).data('subjectarea');
        var level = $(this).data('level');

        $('#edit_grading_id').val(grading_id);
        $('#edit_written').val(written);
        $('#edit_performance').val(performance);
        $('#edit_assessment').val(assessment);
        $('#edit_subjectArea').val(subjectArea);
        $('#edit_level').val(level);

        // Recalculate the total after updating the input values
        editcalculateTotal();
    });

    function editcalculateTotal() {
        // Retrieve the values entered by the user
        var written = parseFloat($('#edit_written').val()) || 0;
        var performance = parseFloat($('#edit_performance').val()) || 0;
        var assessment = parseFloat($('#edit_assessment').val()) || 0;

        // Calculate the editTotal
        var editTotal = written + performance + assessment;

        // Display the editTotal
        var totalElement = $('#editTotal');
        totalElement.text(editTotal.toFixed(2) + '%');

        // Check if the editTotal is equal to 100
        if (editTotal === 100) {
            totalElement.removeClass('text-danger').addClass('text-success').text(editTotal.toFixed(2) + '%');
        } else {
            totalElement.removeClass('text-success').addClass('text-danger').text(editTotal.toFixed(2) + '%');
        }
    }
});
</script>




<!-- delete truck function -->
</i> <script>
    $(document).ready(function() {
        $('.delete-grading_system-btn').click(function() {
            var grading_id = $(this).data('id');
            var level = $(this).data('level');
            var subjectArea = $(this).data('subjectarea')
           
          $('#delete_grading_id').val(grading_id);
          $('#delete_component').text(subjectArea + ' for ' + level);
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


