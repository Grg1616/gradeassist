<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && 
   ($_SESSION['userType'] === 'student' || $_SESSION['userType'] === 'parent')) {

require '../db_conn.php';

$student_id = $_SESSION['user_id'];
$id_for_filter = $_SESSION['id'];
?>


<!DOCTYPE html>
<html lang="en">


<?php
$sql = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the latest row
    $row = $result->fetch_assoc();
    $new_SY_id = $row["id"];
} else {
    $new_SY_id = ""; // Set default value if no rows found
}
?>

<?php
// Check if there's a value of school_year in the filter table for the given user_id
$check_query = "SELECT * FROM filter WHERE user_id = '$id_for_filter'";

// Execute the query
$result = mysqli_query($conn, $check_query);

if ($result) {
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch the first row
        $row = mysqli_fetch_assoc($result);
        
        $school_year_id = $row['school_year'];
        $semester = $row['semester'];
        $quarter = $row['quarter'];

    } else {
        $school_year_id = $new_SY_id;
        $semester = 1;
        $quarter = 1;
    }
} else {
    // Handle query execution error
    echo "Error executing query: " . mysqli_error($conn);
}

if (!empty($semester)) {
    if ($semester == 1) {
        $semesterName = 'First Semester';
    } elseif ($semester == 2) {
        $semesterName = 'Second Semester';
    } else {
        $semesterName = '';
    }
} else {
    $semesterName = '';
}

if (!empty($quarter)) {
    if ($quarter == 1) {
        $quarterName = 'First Quarter';
    } elseif ($quarter == 2) {
        $quarterName = 'Second Quarter';
    } elseif ($quarter == 3) {
        $quarterName = 'Third Quarter';
    } elseif ($quarter == 4) {
        $quarterName = 'Fourth Quarter';
    } else {
        $quarterName = '';
    }
} else {
    $quarterName = '';
}

?>
<?php
if (isset($school_year_id) && !empty($school_year_id)) {
    $sql = "SELECT id, class_start, class_end FROM academic_calendar WHERE id = $school_year_id ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the latest row
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $academic_year = "AY $start_year-$end_year";
    } else {
        $academic_year = "AY 0000-0000"; // Set default value if no rows found
    }
} else {
    $academic_year = "AY 0000-0000"; // Set default value if no school_year_id is provided
}
?>
<?php
if (isset($student_id) && !empty($student_id) && isset($school_year_id) && !empty($school_year_id)) {
    $sql = "SELECT * FROM class_students WHERE student_id = $student_id AND school_year_id = $school_year_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Loop through the results
        while ($row = mysqli_fetch_assoc($result)) {
           $class_id = $row["class_id"];
        }
    } else {
        $class_id = ''; // Set default value if no rows found
    }
} else {
    $class_id = ''; // Set default value if student_id or school_year_id is not provided
}

?>

<?php
// Construct the SQL query
$sql = "SELECT * FROM class WHERE id = '$class_id' AND school_year_id = '$school_year_id'";

$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Set $enrolled to 'Enrolled' if there are rows fetched
        $enrolled = 'Enrolled';
        // Loop through the results
        while ($row = mysqli_fetch_assoc($result)) {
           $gradeLevel = $row["gradeLevel"];
           $section = $row["section"];
           $gradeLevelAndSection = $gradeLevel . ' ' . $section;
        }
    } else {
        // Set $enrolled to 'Unenrolled' if no rows fetched
        $gradeLevelAndSection = '';
        $gradeLevel = '';
        $section = '';
        $enrolled = 'Unenrolled';
    }
} else {
    // Handle SQL error
    echo "Error: " . mysqli_error($conn);
}
?>


<?php
$gradeLevelsKinder = ['Kinder'];
$gradeLevelsElementary = ['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6'];
$gradeLevelsHighSchool = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];
$gradeLevelsSeniorHighSchool = ['Grade 11', 'Grade 12'];

$department = '';

if (isset($gradeLevel)) {
    if (in_array($gradeLevel, $gradeLevelsKinder)) {
        $department = 'Kindergarten';
    } elseif (in_array($gradeLevel, $gradeLevelsElementary)) {
        $department = 'Elementary';
    } elseif (in_array($gradeLevel, $gradeLevelsHighSchool)) {
        $department = 'Junior High School';
    } elseif (in_array($gradeLevel, $gradeLevelsSeniorHighSchool)) {
        $department = 'Senior High School';
    }
}
?>


<?php
$query = "SELECT lastName, firstName, middleName FROM students WHERE id = $student_id";
$result = mysqli_query($conn, $query);

$fullName = ""; // Initializing the variable

if ($result && mysqli_num_rows($result) > 0) {
    $faculty = mysqli_fetch_assoc($result);
    $lastName = $faculty['lastName'];
    $firstName = $faculty['firstName'];
    $middleName = $faculty['middleName'];

    // Concatenating full name
    $fullName = ($lastName . ", " . $firstName);
    if (!empty($middleName)) {
        $fullName .= " " . substr($middleName, 0, 1) . ".";
    }
} elseif ($result) {
     $fullName = '';
} else {
    // Error executing query
    $fullName = "Error executing query: " . mysqli_error($conn);
}
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GradeAssist - Student/Faculty Portal</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/icon.png" rel="icon">
  <link href="../assets/img/icon.png" rel="apple-touch-icon">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Favicons -->
  <link href="../assets/img/icon.png" rel="icon">
  <link href="../assets/img/icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Custom Styles -->
  <style>
    /* Background Image */
    .row-background {
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        /* Add the background image URL here */
        background-image: url('../assets/img/bsu.jpg');
    }
    /* Selected tab text color */
    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #d9534f;
        background-color: var(--bs-nav-tabs-link-active-bg);
        border-color: var(--bs-nav-tabs-link-active-border-color);
        font-weight: bold;
    }
    /* Non-selected tab text color */
    .nav-link:not(.active) {
        color: black;
    }
    a {
    text-decoration: none;
}
.my-sweetalert {
    padding-bottom: 40px; /* You can adjust the padding value as needed */
}



  </style>
</head>

<body>

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
  if (isset($_SESSION['email_completion'])) {
    echo "Swal.fire({
            icon: 'info',
            title: 'Email Completion!',
            text: '{$_SESSION['email_completion']}',
            showCancelButton: true,
            confirmButtonText: 'Update Email',
            cancelButtonText: 'Close',
            customClass: {
                popup: 'my-sweetalert'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#updateEmailModal').modal('show'); // Show the modal
            }
        });";
  unset($_SESSION['email_completion']);
}

  if (isset($_SESSION['email_exist'])) {
    echo "Swal.fire({
            icon: 'error',
            title: 'Email Already Exist!',
            text: '{$_SESSION['email_exist']}',
            showCancelButton: true,
            confirmButtonText: 'Try Again',
            cancelButtonText: 'Close',
            customClass: {
                popup: 'my-sweetalert'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#updateEmailModal').modal('show'); // Show the modal
            }
        });";
    unset($_SESSION['email_exist']); // Clear the session message after displaying it
}
?>
</script>



 <?php
if (isset($_SESSION['id'])) {
    // Check if session variable 'id' is set
    $user_id = $_SESSION['id'];

    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $admin = mysqli_fetch_assoc($result);
            // Change $row to $admin
            if (!isset($admin['image']) || empty($admin['image'])) {
                $profile_picture = "../assets/img/user.png";
            } else {
                $profile_picture = "../uploads/" . $admin['image'];
            }
        }
    }
}
?>


<!-- Header -->
<div class="shadow-lg" style="position:relative;background-color:white;margin-top:0px;margin-left:auto;margin-right:auto;padding:0px;padding-top:0px;max-width:1000px;min-height:100%;overflow:hidden">
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="https://batstate-u.edu.ph">
            <img src="../assets/img/icon.png" class="img-thumbnail ms-2 mb-1" alt="..." style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;">
            Grade Assist
        </a>
    </nav>

    <!-- Secondary Navbar -->
    <nav class="navbar navbar-light" style="background-color: #ececec;">
        <div class="px-2 d-flex justify-content-between w-100 py-2">
            <!-- Button to Trigger Change Password Modal -->
            <button class="btn btn-light btn-sm rounded-pill" style="border: 1px solid #ced4da;" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                <span class="bi bi-key"></span>
                Change Password
            </button>
            <!-- Button to Trigger Sign-out Modal -->
            <button class="btn btn-light btn-sm rounded-pill" style="border: 1px solid #ced4da;" data-bs-toggle="modal" data-bs-target="#signoutModal">
                <span class="bi bi-box-arrow-right"></span>
                Sign-out
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="row row-background p-4">
        <div class="col">
            <div class="row no-gutters py-3" style="background-color: rgb(255 255 255 / 80%);">
                <!-- Profile Card -->
                <div class="col-md-2 align-baseline d-flex justify-content-start mb-3 ml-3">
                    <div class="card-body">
                       <img src="<?= isset($profile_picture) ? $profile_picture : '../assets/img/user.png' ?>" alt="..." style="width: 140px; height: 140px; object-fit: cover;">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase"><strong><?php echo $fullName; ?></strong></h5>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-text font-weight-bold mb-0 text-uppercase"><i class="bi bi-caret-right-fill"></i> <strong><?php echo $semesterName; ?> <?php echo $academic_year; ?></strong></p>
                        <p class="card-text mb-0"><i class="bi bi-caret-right-fill"></i> <?php echo $department; ?>-ARASOF-Nasugbu Campus</p>
                        <p class="card-text mb-0"><i class="bi bi-caret-right-fill"></i> Science, Technology, Engineering, and Mathematics</p>
                        <p class="card-text mb-0"><i class="bi bi-caret-right-fill"></i> <strong><?php echo $gradeLevel; ?> - <?php echo $section; ?></strong></p>
                        <p class="card-text">
                            <i class="bi bi-caret-right-fill"></i>
                            <?php if ($enrolled == 'Enrolled'): ?>
                                <strong class="text-success text-uppercase"><?php echo $enrolled; ?></strong>
                            <?php elseif ($enrolled == 'Unenrolled'): ?>
                                <strong class="text-danger text-uppercase"><?php echo $enrolled; ?></strong>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="row mt-3 px-2">
        <div class="col">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <!-- Home Tab -->
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        <i class="bi bi-house"></i> Home
                    </button>
                    <!-- Profile Tab -->
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        <i class="bi bi-person"></i> Profile
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <!-- Start Home Tab Content -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <p class="ms-2 mt-3 mb-0 ">
                        <span class='text-danger h6 text-uppercase'><?php echo $quarterName; ?></span>
                        <span class='text-dark h6 text-uppercase'>- <?php echo $semesterName; ?> <?php echo $academic_year; ?></span>
                    </p>
                    <p class='ms-2 mt-3 mb-0 text-secondary'><i class="bi bi-info-circle text-info"></i></i> Click "Filter Option" button to change the default schoolyear / semester / quarter</p>
                     <button class="btn btn-sm btn-outline-default shadow-sm text-dark mx-1 edit-filter-btn mt-2" 
                        data-bs-toggle="modal" 
                        data-bs-target="#filter" 
                         <?php
                        $query = "SELECT * FROM filter WHERE user_id = $id_for_filter";
                        $query_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { // Fetch each row from the result set
                                ?>
                                    data-id="<?= $row['id']; ?>" 
                                    data-school-year="<?= $row['school_year']; ?>"
                                    data-semester="<?= $row['semester']; ?>"
                                    data-user-id="<?= $row['user_id']; ?>"
                                    data-quarter="<?= $row['quarter']; ?>"
                                <?php
                            }
                        } else {
                            // No filter found, using default values
                            ?>
                                data-school-year="<?= $school_year_id; ?>"
                                data-semester="<?= $semester; ?>"
                                data-quarter="<?= $quarter; ?>"
                            <?php
                        }
                        ?>
                        data-bs-tooltip="tooltip" 
                        data-placement="top" 
                        title="Click here to change the default schoolyear, semester, quarter">
                    <i class="bi bi-funnel"></i> Filter Option
                </button>
                    <div class="row align-items-top mt-3">
                        <div class="col-lg-4 col-sm-12 mb-3">
                            <!-- Card with header and footer -->
                             <a href="grades.php" data-bs-toggle="modal" data-bs-target="#gradesModal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Click here to view your grades">
                            <div class="card">
                                <div class="card-body bg-primary rounded-top">
                                    <div class="row">
                                        <div class="col-lg-4 col">
                                            <img src="../assets/img/grades.png" alt="Profile" class="img-fluid" style="width:80px; height: 80px;">
                                        </div>
                                        <div class="col-lg-8 col mt-1">
                                            <h1 class="fw-bold text-white text-end mb-0" style="color: #012970;"></h1>
                                            <h5 class="text-white text-end mb-0">Grades</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h5 class="text-primary small mb-0 d-inline">View Grades</h5>
                                    <i class="bi bi-arrow-right-circle text-primary float-end"></i>
                                </div>
                            </a>
                            </div><!-- End Card with header and footer -->
                        </div>
                        <div class="col-lg-4 col-sm-12 mb-3">
                            <!-- Card with header and footer -->
                            <a href="subjects.php" data-bs-toggle="modal" data-bs-target="#subjectsModal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Click here to view your encoded subjects">
                            <div class="card">
                                <div class="card-body bg-danger rounded-top">
                                    <div class="row">
                                        <div class="col-lg-4 col">
                                            <img src="../assets/img/subjects.png" alt="Profile" class="img-fluid" style="width:80px; height: 80px;">
                                        </div>
                                        <div class="col-lg-8 col mt-1">
                                            <h1 class="fw-bold text-white text-end mb-0" style="color: #012970;"></h1>
                                            <h5 class="text-white text-end mb-0">Subjects</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h5 class="text-danger small mb-0 d-inline">View Subjects</h5>
                                    <i class="bi bi-arrow-right-circle text-danger float-end"></i>
                                </div>
                            </a>
                            </div><!-- End Card with header and footer -->
                        </div>
                        <div class="col-lg-4 col-sm-12 mb-3">
                            <!-- Card with header and footer -->
                            <a href="subjects.php" data-bs-toggle="modal" data-bs-target="#printGradeModal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Click here to print copy of grades">
                            <div class="card">
                                <div class="card-body bg-success rounded-top">
                                    <div class="row">
                                        <div class="col-lg-4 col">
                                            <img src="../assets/img/print.png" alt="Profile" class="img-fluid" style="width:80px; height: 80px;">
                                        </div>
                                        <div class="col-lg-8 col mt-1">
                                            <h1 class="fw-bold text-white text-end mb-0" style="color: #012970;"></h1>
                                            <h5 class="text-white text-end mb-0">Print Copy of Grades</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h5 class="text-success small mb-0 d-inline">Print Grades</h5>
                                    <i class="bi bi-arrow-right-circle text-success float-end"></i>
                                </div>
                            </a>
                            </div><!-- End Card with header and footer -->
                        </div>
                    </div>
                </div>
                <!-- End Home Tab Content -->
                <!-- Start Profile Tab Content -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row mt-3">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <img src="<?= isset($profile_picture) ? $profile_picture : '../assets/img/user.png' ?>" alt="Profile Picture" class="rounded-circle mb-3" width="100" style="border-radius: 50%; width: 100px; height: 100px;">
                                    <span>
                                        <h2>
                                            <h6 class='fw-bold mb-0 mt-2 text-center' style='color: #000;'><?php echo $fullName; ?></h6>
                                            <h3 class='small mt-0 text-center'><?php echo $gradeLevel; ?> - <?php echo $section; ?></h3>
                                        </h2>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">
                                        <li class="nav-item">
                                            <button id="profile-overview-tab" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                        </li>
                                        <li class="nav-item">
                                            <button id="profile-edit-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                        </li>
                                        <li class="nav-item">
                                            <button id="profile-settings-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-2">
                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                            <!-- HTML markup for displaying student details -->
                                            <div id="studentDetails"></div>
                                            <!-- Include jQuery library -->
                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                            <script>
                                            $(document).ready(function() {
                                                // Function to fetch student details using AJAX
                                                function fetchStudentDetails(studentId) {
                                                    $.ajax({
                                                        url: 'students.php', // Path to your server-side script
                                                        method: 'GET',
                                                        data: { student_id: studentId }, // Pass student ID as parameter
                                                        dataType: 'html', // Expect HTML response
                                                        success: function(response) {
                                                            $('#studentDetails').html(response); // Insert response HTML into 'studentDetails' div
                                                        },
                                                        error: function(xhr, status, error) {
                                                            console.error('Error fetching student details:', error);
                                                        }
                                                    });
                                                }
                                                // Call fetchStudentDetails function with student ID
                                                fetchStudentDetails(<?php echo $student_id; ?>);
                                            });
                                            </script>
                                        </div>
                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                            <!-- Profile Edit Form -->
                                            <form>
                                                <div class="row mb-3">
                                                    <span for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</span>
                                                    <div class="col-md-8 col-lg-9">
                                                        <div style="position: relative;">
                                                           <img src="<?= isset($profile_picture) ? $profile_picture : '../assets/img/user.png' ?>" alt="Profile Picture" class="img-thumbnail" width="100" style="width: 100px; height: 100px;">
                                                        </div>
                                                        <div class="pt-2">
                                                          <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#change_image" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form><!-- End Profile Edit Form -->
                                        </div>
                                    </div><!-- End Bordered Tabs -->
                                    <!-- Start settings Tabs -->
                                    <div class="tab-pane fade pt-3" id="profile-settings">
                                        <?php
                                        $user_id = $_SESSION['id'];
                                        $query = "SELECT * FROM users WHERE id = $user_id";
                                        $result = $conn->query($query);
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $username = $row["username"];
                                            $email = $row["email"];
                                        } else {
                                            $username = '';
                                            $email = '';
                                        }
                                        ?>
                                        
                                            <div class="row mb-3">
                                                <label for="username" class="col-md-4 col-lg-4 col-form-label">Username</label>
                                                <div class="col-md-8 col-lg-8">
                                                    <input name="username" type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($username); ?>" readonly>

                                                </div>
                                            </div>

                                        <form action="crud_account.php" method="POST">
                                            <div class="row mb-3">
                                                <label for="email" class="col-md-4 col-lg-4 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-8">
                                                    <input name="email" type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>">
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="update_account_settings" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </form>
                                    </div><!-- End settings Tabs -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Profile Tab Content -->
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>


  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Remember Selected Tab Script -->
  <script>
      document.addEventListener("DOMContentLoaded", function() {
          const homeTab = document.getElementById('nav-home-tab');
          const profileTab = document.getElementById('nav-profile-tab');

          [homeTab, profileTab].forEach(tab => {
              tab.addEventListener('click', function() {
                  localStorage.setItem('selectedTab', tab.getAttribute('id'));
              });
          });

          const selectedTab = localStorage.getItem('selectedTab');
          if (selectedTab) {
              document.getElementById(selectedTab).click();
          }
      });
  </script>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">
                    <i class="bi bi-key"></i>&nbsp; Change Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="crud_account.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" name="current_password" id="current_password" placeholder="Enter current password" class="form-control" required>
                            <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="current_password" style="border-color: #dee2e6;">
                                <i class="bi bi-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" name="new_password" id="new_password" placeholder="Enter new password" class="form-control" required onkeyup="checkPasswordStrength()">
                            <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="new_password" style="border-color: #dee2e6;">
                                <i class="bi bi-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                        <div id="password-strength" class="password-strength"></div>
                         <div id="password-suggestions" class="password-suggestions"></div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" class="form-control" required onkeyup="checkPasswordMatch()">
                            <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="confirm_password" style="border-color: #dee2e6;">
                                <i class="bi bi-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                        <div id="password-match-message" class="password-confirm"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_password" name="edit_password" class="btn btn-success">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Sign out Modal -->
<div class="modal fade" id="signoutModal" tabindex="-1" aria-labelledby="signOutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signOutModalLabel">Confirm Log Out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="../logout.php">Log Out</a>
            </div>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateEmailModal" tabindex="-1" aria-labelledby="updateEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title" id="updateEmailModalLabel">
                    <i class="bi bi-envelope-at"></i></i>&nbsp; Update Email
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="change_password_form" action="update_email.php" method="POST">
            <div class="modal-body">
                <div class="mb-3">
                    <div class="input-group has-validation">
                        <input type="email" name="email" placeholder="Enter your email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                    </div>
                </div>
            </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="update_email" class="btn btn-success">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- Grades Modal -->
<div class="modal fade" id="gradesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gradesModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gradesModalLabel">
                    <i class="bi bi-award"></i>&nbsp; Grades
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php
            if ($gradeLevel == "Grade 11" || $gradeLevel == "Grade 12") {
                include('grades_senior_high.php');
            } else {
                include('grades_k_10.php');
            }
            ?>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Subjects Modal -->
<div class="modal fade" id="subjectsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="subjectsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectsModalLabel">
                    <i class="bi bi-book"></i>&nbsp; Subjects
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php
            if ($gradeLevel == "Grade 11" || $gradeLevel == "Grade 12") {
                include('subject_senior_high.php');
            } else {
                include('subject_k_10.php');
            }
            ?>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Print Grades Modal -->
<div class="modal fade" id="printGradeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="printGradeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printGradeModalLabel">
                    <i class="bi bi-book"></i>&nbsp; Print Copy of Grades
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto">
                <?php
                if ($gradeLevel == "Grade 11" || $gradeLevel == "Grade 12") {
                    include('../report_filter/Copy_of_Grades_Senior_High.php');
                } else {
                    include('../report_filter/Copy_of_Grades_K_10.php');
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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
        <form action="crud_filter.php" method="POST">
          <div class="form-floating mb-3">
            <select class="form-select" id="school_year" name="school_year" aria-label="State" required>
              <option selected disabled value>Select Academic Year</option>
              <?php
              $selectedOption = isset($_GET['school_year']) ? $_GET['school_year'] : '';
              $query_drivers = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY class_start DESC";
              $query_run_drivers = mysqli_query($conn, $query_drivers);
              if ($query_run_drivers) {
                while ($row = mysqli_fetch_assoc($query_run_drivers)) {
                  $startYear = date('Y', strtotime($row['class_start']));
                  $endYear = date('Y', strtotime($row['class_end']));
                  $academicYearLabel = "$startYear-$endYear";
                  $selected = ($selectedOption == $row['id']) ? "selected" : "";
                  echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $academicYearLabel . '</option>';
                }
              } else {
                echo "Error: " . mysqli_error($conn);
              }
              ?>
            </select>
            <label for="school_year">Academic Year</label>
            <div class="invalid-feedback">
              Please select a valid academic year.
            </div>
          </div>

<?php
$options = array(
    "1" => "First Quarter",
    "2" => "Second Quarter",
    "3" => "Third Quarter",
    "4" => "Fourth Quarter"
);

// Check if grade level is selected
if (isset($gradeLevel) && !empty($gradeLevel)) {
    // Check if the grade level is 11 or 12
    if ($gradeLevel == 'Grade 11' || $gradeLevel == 'Grade 12') {
        $options = array(); // Initialize as empty initially
    }
} else {
    // Handle case where grade level is not provided
    $gradeLevel = null;
}

?>

<div class="form-floating mb-3">
    <select class="form-select" id="quarter" name="quarter" aria-label="Quarter" required>
        <option selected disabled value>Select Quarter</option>
        <?php
        // Generate options based on the conditions
        foreach ($options as $key => $value) {
            echo "<option value=\"$key\">$value</option>";
        }
        ?>
    </select>
    <label for="quarter">Quarter</label>
    <div class="invalid-feedback">
        Please select a valid quarter.
    </div>
</div>

<h6 class="text-dark mt-2 small">Applied on senior high school only</h6>
<div class="form-floating mb-3">
    <select class="form-select" id="semester" name="semester" aria-label="Semester">
        <option selected value>Select Semester (For Senior High School)</option>
        <option value="1">First Semester</option>
        <option value="2">Second Semester</option>
    </select>
    <label for="semester">Semester</label>
    <div class="invalid-feedback">
        Please select a valid semester.
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#semester').change(function() {
        var semester = $(this).val();
        var options = [];

        // Clear any previous options
        $('#quarter').empty();

        // Populate options based on semester selection
        if (semester == '1') {
            options = {
                "1": "First Quarter",
                "2": "Second Quarter"
            };
        } else if (semester == '2') {
            options = {
                "3": "Third Quarter",
                "4": "Fourth Quarter"
            };
        } else {
            // If no semester selected, show all quarters
            options = {
                "1": "First Quarter",
                "2": "Second Quarter",
                "3": "Third Quarter",
                "4": "Fourth Quarter"
            };
        }

        // Append new options to quarter select
        $.each(options, function(key, value) {
            $('#quarter').append($('<option>', {
                value: key,
                text: value
            }));
        });
    });

    // Trigger change event to initialize quarter options based on initial semester value
    $('#semester').change();
});
</script>

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

<!-- change profile picture -->
<div class="modal fade" id="change_image" tabindex="-1" aria-labelledby="changeImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="changeImageLabel" style="font-weight: bold;">
                    <i class="bi bi-funnel"></i>&nbsp; Update Profile Picture
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form method="POST" enctype="multipart/form-data" id="imageForm" action="crud_account.php">
                    <?php
                    $id = $_SESSION['id'];
                    $ret = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
                    while ($row = mysqli_fetch_array($ret)) {
                        $profile_picture = empty($row['image']) ? "../assets/img/user.png" : "../uploads/" . $row['image'];
                    ?>
                        <input type="hidden" name="oldpic" value="<?php echo $row['image']; ?>">
                        <div class="form-group text-center">
                            <img id="previewImage" src="<?= $profile_picture ?>" alt="Profile Picture" class="rounded-circle" width="300" style="border-radius: 50%; width: 300px; height: 300px;">
                        </div>
                        <div class="form-group px-4">
                            <div class="form-group mt-2 col-md-12">
                                <input type="file" id="image" name="image" class="form-control" id="customFile" placeholder=" " onchange="previewFile()" required>
                                <span style="color:red; font-size:12px;">Only jpg / jpeg / png / gif format allowed.</span>
                            </div>
                        </div>
                    <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="change_profile" class="btn btn-success">Update changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center p-3" style="position:relative;background-color:white;margin-top:0px;margin-left:auto;margin-right:auto;padding:0px;padding-top:0px;max-width:1000px;min-height:100%;overflow:hidden;">
    &copy; <span id="currentYear"></span> GradeAssist. All rights reserved.
</footer>

<a href="#" class="back-to-top btn-md btn btn-danger" style="position:fixed; bottom:10px; right:10px; display: none;"><i class="bi bi-arrow-up-short"></i></a>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
  .password-strength {
    margin-top: 5px;
    font-size: 12px;
  }
   .password-confirm {
    margin-top: 5px;
    font-size: 12px;
  }
  .weak {
    color: #dc3545; /* Bootstrap 4 danger color */
  }
  .medium {
    color: #ffc107; /* Bootstrap 4 warning color */
  }
  .strong {
    color: #28a745; /* Bootstrap 4 success color */
  }
  .password-suggestions {
    margin-top: 8px;
    font-size: 13px;
  }
</style>

<script>
window.addEventListener('scroll', function() {
    var button = document.querySelector('.back-to-top');
    if (window.scrollY > 100) { // Adjust the scroll threshold as needed
        button.style.display = 'block';
    } else {
        button.style.display = 'none';
    }
});
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const homeTab = document.getElementById('nav-home-tab');
        const profileTab = document.getElementById('nav-profile-tab');

        [homeTab, profileTab].forEach(tab => {
            tab.addEventListener('click', function() {
                localStorage.setItem('selectedTab', tab.getAttribute('id'));
            });
        });

        const selectedTab = localStorage.getItem('selectedTab');
        if (selectedTab) {
            document.getElementById(selectedTab).click();
        }
    });
</script>

<script>
    document.getElementById("currentYear").textContent = new Date().getFullYear();
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

<script>
function previewFile() {
    const preview = document.getElementById('previewImage');
    const fileInput = document.getElementById('image');
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>

 <script>
    function checkPasswordStrength() {
        var password = document.getElementById("new_password").value;
        var passwordStrength = document.getElementById("password-strength");
        var passwordSuggestions = document.getElementById("password-suggestions");

        var weakRegex = /^.{0,5}$/;
        var mediumRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;
        var strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_#^+=(){}[\]|\\:;"'<>,.~`]).{8,}$/;

        if (strongRegex.test(password)) {
            passwordStrength.textContent = "Strong password";
            passwordStrength.className = "password-strength strong";
            passwordSuggestions.innerHTML = "";
        } else if (mediumRegex.test(password)) {
            passwordStrength.textContent = "Medium password";
            passwordStrength.className = "password-strength medium";
            passwordSuggestions.innerHTML = "<ul><li>Add special characters, uppercase, and lowercase letters</li></ul>";
        } else if (weakRegex.test(password)) {
            passwordStrength.textContent = "Weak password";
            passwordStrength.className = "password-strength weak";
            passwordSuggestions.innerHTML = "<ul><li>Make it longer, include numbers, uppercase and lowercase letters, and special characters</li></ul>";
        } else {
            passwordStrength.textContent = "Password is too short";
            passwordStrength.className = "password-strength";
            passwordSuggestions.innerHTML = "<ul><li>Make it at least 8 characters long, include uppercase and lowercase letters, numbers, and special characters</li></ul>";
        }
    }

    function checkPasswordMatch() {
        var password = document.getElementById("new_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        var matchMessage = document.getElementById("password-match-message");

        if (password === confirmPassword) {
            matchMessage.innerHTML = "Passwords match";
            matchMessage.style.color = "#28a745"; 
        } else {
            matchMessage.innerHTML = "Passwords do not match";
            matchMessage.style.color = "#dc3545"; 
        }
    }

    var passwordToggleButtons = document.querySelectorAll('.password-toggle-btn');

    passwordToggleButtons.forEach(function(button) {
        button.addEventListener('click', function () {
            var targetId = this.getAttribute('data-target');
            var passwordInput = document.getElementById(targetId);
            var passwordIcon = this.querySelector('i'); // Change class name from '.password-icon' to 'i'

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        });
    });
</script>

</body>
</html>
<script type="text/javascript">
        // Disable right-click context menu
        window.onload = function() {
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });
        };
    </script>
<?php 
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: ../index.php");
    exit();
}
