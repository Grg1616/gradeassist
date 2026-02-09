<?php
ob_start();
require '../db_conn.php';

$studentId = isset($_GET['student_id']) ? $_GET['student_id'] : '';

// Fetch student details from the database based on the student ID
$query = "SELECT * FROM students WHERE id = $studentId";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Generate HTML markup for displaying student details
    ob_start();
    // Loop through the results and generate HTML markup for each student
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
  <div class="col-lg-12">

    <div class="card mb-4">
     <div class="card-header py-1 bg-secondary text-white">
        <p class="mb-0"><strong>Student Details</strong></p>
      </div>
      <div class="card-body">
        
        <div class="row mt-3">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>First Name:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['firstName'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Middle Name:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['middleName'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Last Name:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['lastName'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Gender:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['gender'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Birthday:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['birthday'] ? date('F j, Y', strtotime($row['birthday'])) : '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Religion:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['religion'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Contact Number:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['contactNumber'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Email Address:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['email'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Home Address:</strong></p>
          </div>
          <div class="col-sm-8 col">
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
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Name:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['fatherName'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Occupation:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['fatherOccupation'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Contact Number:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['fatherContact'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Email Adddress:</strong></p>
          </div>
          <div class="col-sm-8 col">
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
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Name:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['motherName'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Occupation:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['motherOccupation'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Contact Number:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['motherContact'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Email Adddress:</strong></p>
          </div>
          <div class="col-sm-8 col">
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
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Name:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['guardianName'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Occupation:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['guardianOccupation'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Contact Number:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['guardianContact'] ?: '-' ?></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-4 col">
            <p class="mb-0"><strong>Email Adddress:</strong></p>
          </div>
          <div class="col-sm-8 col">
            <p class="text-muted mb-0"><?= $row['guardianEmail'] ?: '-' ?></p>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
<?php
    }
    ob_end_flush();
} else {
    echo "<p>No student found</p>";
}
?>