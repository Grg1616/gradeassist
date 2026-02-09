<div class="row align-items-top">
    <!-- Start of Card Section -->
    <div class="col-lg-12 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Form 138</h6>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row align-items-top">
                    <!-- Filter Section -->
                    <div class="col-lg-3 col-sm-12">

                        <form id="filterForm" action="" method="POST">
                            <div class="row align-items-center justify-content-between mt-3">
                                <!-- Year Select -->
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="school_year" name="school_year" aria-label="State">
                                            <option selected value>Select Academic Year</option> <!-- Add empty option -->
                                            <?php
                                            // Fetch academic years
                                            $query_drivers = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY class_start DESC";
                                            $query_run_drivers = mysqli_query($conn, $query_drivers);

                                            if (mysqli_num_rows($query_run_drivers) > 0) {
                                                while ($row = mysqli_fetch_assoc($query_run_drivers)) {
                                                    $startYear = date('Y', strtotime($row['class_start']));
                                                    $endYear = date('Y', strtotime($row['class_end']));
                                                    $academicYearLabel = "$startYear-$endYear";

                                                    $selected = (isset($_POST['school_year']) && $_POST['school_year'] == $row['id']) ? 'selected' : '';

                                                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $academicYearLabel . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="school_year">Academic Year</label>
                                    </div>
                                </div>
                               <?php
        $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;
        $user_type = isset($_SESSION['userType']) ? $_SESSION['userType'] : null;

        if ($user_id && $user_type) {
            // Sanitize user_type to prevent SQL injection
            $user_type = $conn->real_escape_string($user_type);

            // Prepare the SQL query
            $sql = "SELECT * FROM faculty WHERE id = $user_id AND LOWER(designation) = '$user_type' ORDER BY id DESC LIMIT 1";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                // Output data of the latest row
                $row = $result->fetch_assoc();
                $user_department = $row['department']; // Ensure the correct column name
            } else {
                $user_department = ""; // Set default value if no rows found
            }
        } else {
            $user_department = ""; // Set default value if session variables are not set
        }

        // echo $user_department;

        $gradeLevelsElementary = ['Kinder', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6'];
        $gradeLevelsHighSchool = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];

        if ($_SESSION['userType'] == 'chairperson') {
            echo '<div class="col-md-12">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="showAll" name="showAll" value="1" ' . (isset($_POST['showAll']) ? 'checked' : '') . '>
                    <label class="form-check-label" for="showAll">
                        Show all Classes in ' . htmlspecialchars($user_department) . '
                    </label>
                </div>
            </div>';
        }
        ?>

        <!-- Class Select -->
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <select id="class_id" name="class_id" class="form-select" aria-label="Select Class">
                    <option disabled selected>Select Class</option>
                    <?php
                    if (isset($_POST['school_year'])) {
                        $selectedYear = mysqli_real_escape_string($conn, $_POST['school_year']); // Sanitize input to prevent SQL injection
                        $faculty_id = mysqli_real_escape_string($conn, $_SESSION['user_id']); // Sanitize input

                        // Determine which query to use based on checkbox state
                        if (isset($_POST['showAll']) && $_POST['showAll'] == '1' && $_SESSION['userType'] == 'chairperson') {
                            // Determine which grade levels to show based on the department
                            if ($user_department == 'Elementary') {
                                $gradeLevels = "'" . implode("', '", $gradeLevelsElementary) . "'";
                            } elseif ($user_department == 'High School') {
                                $gradeLevels = "'" . implode("', '", $gradeLevelsHighSchool) . "'";
                            } else {
                                $gradeLevels = "''"; // Default to an impossible value if department is unknown
                            }

                            $query_class = "SELECT DISTINCT class.id, class.gradeLevel, class.section
                                            FROM class 
                                            WHERE class.school_year_id = '$selectedYear' AND class.gradeLevel IN ($gradeLevels)";
                        } elseif ($_SESSION['userType'] == 'principal') {
                            $query_class = "SELECT DISTINCT class.id, class.gradeLevel, class.section
                                            FROM class 
                                            WHERE class.school_year_id = '$selectedYear'";
                        } elseif ($_SESSION['userType'] == 'registrar') {
                            $query_class = "SELECT DISTINCT class.id, class.gradeLevel, class.section
                                            FROM class 
                                            WHERE class.school_year_id = '$selectedYear'";    
                        } elseif ($_SESSION['userType'] == 'admin') {
                            $query_class = "SELECT DISTINCT class.id, class.gradeLevel, class.section
                                            FROM class 
                                            WHERE class.school_year_id = '$selectedYear'";                              
                        } else {
                            $query_class = "SELECT DISTINCT class.id, class.gradeLevel, class.section 
                                            FROM class 
                                            JOIN loads ON class.id = loads.class_id 
                                            JOIN faculty ON class.faculty_id = faculty.id 
                                            WHERE class.school_year_id = '$selectedYear' AND class.faculty_id = '$faculty_id'";
                        }

                        $query_run_class = mysqli_query($conn, $query_class);

                        if ($query_run_class) {
                            if (mysqli_num_rows($query_run_class) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run_class)) {
                                    $gradeLevel = $row['gradeLevel'];
                                    $section = $row['section'];
                                    $classLabel = $gradeLevel . ' - ' . $section;

                                    $selected = (isset($_POST['class_id']) && $_POST['class_id'] == $row['id']) ? 'selected' : '';

                                    echo '<option value="' . htmlspecialchars($row['id']) . '" ' . $selected . '>' . htmlspecialchars($classLabel) . '</option>';
                                }
                            } else {
                                echo '<option disabled>No classes found for the selected academic year</option>';
                            }
                        } else {
                            echo '<option disabled>Error: ' . htmlspecialchars(mysqli_error($conn)) . '</option>';
                        }
                    }
                    ?>
                </select>
                <label for="class_id">Class</label>
            </div>
        </div>

                                <div class="col-md-12" >
                                    <div class="form-floating mb-3">
                                        <select id="student_id" name="student_id" class="form-select" aria-label="Select Subject">
                                            <option disabled selected>Select Student</option>
                                            <?php
                                            if (isset($_POST['class_id'])) {
                                                $selectedClass = $_POST['class_id'];
                                                $selectedClass = mysqli_real_escape_string($conn, $selectedClass);
                                                $selectedYear = mysqli_real_escape_string($conn, $selectedYear); // Add this line

                                                // Change $school_year_id to $selectedYear in the SQL query
                                                $query = "SELECT s.id, s.sr_code, s.firstName, s.middleName, s.lastName FROM students s 
                                                          LEFT JOIN class_students cs 
                                                          ON s.id = cs.student_id 
                                                          WHERE cs.class_id = '$selectedClass' AND cs.school_year_id = '$selectedYear'"; // Change $school_year_id to $selectedYear

                                                $query_run_student = mysqli_query($conn, $query);
                                                if ($query_run_student) {
                                                    while ($row = mysqli_fetch_assoc($query_run_student)) {
                                                        $sr_code = $row['sr_code'];
                                                        $fullName = $row['lastName'] . ", " . $row['firstName'] . (!empty($row['middleName']) ? " " . substr($row['middleName'], 0, 1) . "." : '');
                                                        $studentLabel = $sr_code . " - " . $fullName;

                                                        $selected = (isset($_POST['student_id']) && $_POST['student_id'] == $row['id']) ? 'selected' : '';
                                                        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $studentLabel . '</option>';
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_error($conn); // Print any errors that occur during the query execution
                                                }
                                            } else {
                                                echo '<option disabled>No selected class</option>';
                                            }
                                            ?>
                                        </select>
                                        <label for="student_id">Student</label>
                                    </div>
                                </div>

                            </div>
                            <!-- Generate Report Button -->
                            <!-- <div class="d-flex align-items-center">
                                <button class="btn btn-outline-primary" type="submit">Generate Report</button>
                            </div> -->
                        </form>

<button id="savePDF" class="btn btn-sm btn-primary"><i class="bi bi-download me-2"></i>Download</button>
<button id="printPDF" class="btn btn-sm btn-secondary"><i class="bi bi-printer me-2"></i>Print</button>

<script>
    // Add event listeners for select change
    document.getElementById('school_year').addEventListener('change', function() {
        document.getElementById('filterForm').submit(); // Submit the form on change
    });
    document.getElementById('class_id').addEventListener('change', function() {
        document.getElementById('filterForm').submit(); // Submit the form on change
    });
    document.getElementById('student_id').addEventListener('change', function() {
        document.getElementById('filterForm').submit(); // Submit the form on change
    });
     document.getElementById('showAll').addEventListener('change', function() {
        document.getElementById('filterForm').submit(); // Submit the form on change
    });
</script>



                    </div>
                    <!-- PDF Viewer Section -->
                    <div class="col-md-9">
                        <div class="card mt-3">
                            <div class="card-body">
                                <!-- PDF Embed -->

<?php
$gradeLevel2 = ''; 
$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';

if (!empty($school_year) && !empty($class_id)) {

    // Sanitize the input to prevent SQL injection
    $school_year = mysqli_real_escape_string($conn, $school_year);
    $class_id = mysqli_real_escape_string($conn, $class_id);

    // Construct the SQL query
    $query1 = "SELECT class.*, 
        class.gradeLevel, class.section,
        faculty.gender, faculty.rank AS st_rank, faculty.firstName AS firstName,
        faculty.middleName AS st_middleName, faculty.lastName AS st_lastName
    FROM class
    LEFT JOIN faculty ON class.faculty_id = faculty.id
    WHERE class.id = '$class_id' AND class.school_year_id = '$school_year'";

    // Execute the first query
    $result1 = $conn->query($query1);

    // Check if the query executed successfully
    if ($result1) {
        while ($row = $result1->fetch_assoc()) { 
            // Store grade level and section in the desired format
            $gradeLevel = $row['gradeLevel'];
            $numericGradeLevel = preg_replace('/[^0-9]/', '', $gradeLevel);
            // Check if the numeric grade level is within Grade 1 - Grade 11 range
            if ($numericGradeLevel >= 1 && $numericGradeLevel <= 11) {
                $admissionToGradeLevel = $numericGradeLevel + 1;
            } elseif ($numericGradeLevel == 12) { // Use '==' for comparison, not '='
                $admissionToGradeLevel = 'COLLEGE';
            } else {
                $admissionToGradeLevel = '';
            }

            $section = $row['section'];
            $gradeLevel2 = $row['gradeLevel'];
            $class = $row['gradeLevel'] . " " . $row['section'];
            $middleInitial = (!empty($row['st_middleName'])) ? strtoupper(substr($row['st_middleName'], 0, 1)) . "." : "";
            $adviser = (empty($row['st_rank'])) ? (($row['gender'] == 'Female') ? "Ms." : (($row['gender'] == 'Male') ? "Mr." : "")) : $row['st_rank'] . " " . strtoupper($row['firstName']) . " " . $middleInitial . " " . strtoupper($row['st_lastName']);
            $middleInitial2 = (!empty($row['st_middleName'])) ? strtoupper(substr($row['st_middleName'], 0, 1)) . "." : "";
            $adviser2 = (($row['gender'] == 'Female') ? "Ms." : (($row['gender'] == 'Male') ? "Mr." : "")) . strtoupper($row['firstName']) . " " . strtoupper($middleInitial2) . " " . strtoupper($row['st_lastName']);

         }
    } else {
        // Handle query execution error
        echo "Error executing query: " . $conn->error;
    }

}

?>

<?php
$gradeLevelsElementary = ['Kinder', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6'];
$gradeLevelsHighSchool = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];

$department = '';

if (isset($gradeLevel)) {
    if (in_array($gradeLevel, $gradeLevelsElementary)) {
        $department = 'Elementary';
    } elseif (in_array($gradeLevel, $gradeLevelsHighSchool)) {
        $department = 'High School';
    }
}


$principal = "";
$chairperson = "";

if (!empty($department)) {
    $department = $conn->real_escape_string($department);

    $sqlPrincipal = "SELECT * FROM faculty WHERE department = '$department' AND designation = 'Principal' ORDER BY id DESC LIMIT 1";
    $resultPrincipal = $conn->query($sqlPrincipal);

    if ($resultPrincipal && $resultPrincipal->num_rows > 0) {
        $rowPrincipal = $resultPrincipal->fetch_assoc();
        $middleInitialPrincipal = (!empty($rowPrincipal['middleName'])) ? strtoupper(substr($rowPrincipal['middleName'], 0, 1)) . "." : "";
        $principal = (empty($rowPrincipal['rank'])) ?
            (($rowPrincipal['gender'] == 'Female') ? "Ms." : (($rowPrincipal['gender'] == 'Male') ? "Mr." : "")) :
            $rowPrincipal['rank'] . " " . strtoupper($rowPrincipal['firstName']) . " " . strtoupper($middleInitialPrincipal) . " " . strtoupper($rowPrincipal['lastName']);
    }

    $sqlChairperson = "SELECT * FROM faculty WHERE department = '$department' AND designation = 'Chairperson' ORDER BY id DESC LIMIT 1";
    $resultChairperson = $conn->query($sqlChairperson);

    if ($resultChairperson && $resultChairperson->num_rows > 0) {
        $rowChairperson = $resultChairperson->fetch_assoc();
        $middleInitialChairperson = (!empty($rowChairperson['middleName'])) ? strtoupper(substr($rowChairperson['middleName'], 0, 1)) . "." : "";
        $chairperson = (empty($rowChairperson['rank'])) ?
            (($rowChairperson['gender'] == 'Female') ? "Ms." : (($rowChairperson['gender'] == 'Male') ? "Mr." : "")) :
            $rowChairperson['rank'] . " " . strtoupper($rowChairperson['firstName']) . " " . strtoupper($middleInitialChairperson) . " " . strtoupper($rowChairperson['lastName']);
    }
}

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';

if (!empty($school_year)) {
    // Sanitize the input to prevent SQL injection
    $school_year = intval($school_year);
    
    $sql = "SELECT id, class_start, class_end FROM academic_calendar WHERE id = $school_year ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output data of the latest row
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $academic_year = "$start_year - $end_year";
    } else {
        $academic_year = ""; // Set default value if no rows found
    }
} else {
 $academic_year = "";
}

$semester = isset($_POST['semester']) ? $_POST['semester'] : '';

if (!empty($semester)) {
    if ($semester == 1) {
        $semesterName = '1<sup>st</sup> Semester';
    } elseif ($semester == 2) {
        $semesterName = '2<sup>nd</sup> Semester';
    } else {
        $semesterName = 'Semester';
    }
} else {
    $semesterName = 'Semester';
}

$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';

if (!empty($class_id)) {
    // Assuming $conn is your database connection
    $sql = "SELECT COUNT(*) AS class_students_count FROM class_students WHERE class_id = $class_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output data of the latest row
        $row = $result->fetch_assoc();
        $class_students_count = $row['class_students_count'];
    } else {
        $class_students_count = 0; // Set default value if no rows found
    }
} else {
    $class_students_count = 0;
}

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';

$course = ""; // Initialize $course variable

if (!empty($school_year) && !empty($class_id) && !empty($subject_id)) {
    // Sanitize the input to prevent SQL injection
    $school_year = intval($school_year);
    $class_id = intval($class_id);
    $subject_id = intval($subject_id);

    // Construct the SQL query string with sanitized values
    $sql = "SELECT loads.id as load_id, loads.hours_per_week, faculty.rank, faculty.firstName, faculty.middleName, faculty.lastName, faculty.gender, subjects.courseCode,  subjects.courseTitle
            FROM loads 
            JOIN faculty ON loads.faculty_id = faculty.id 
            JOIN subjects ON loads.subject_id = subjects.id 
            WHERE loads.class_id = $class_id 
            AND loads.school_year_id = $school_year 
            AND loads.subject_id = $subject_id 
            ORDER BY loads.id DESC 
            LIMIT 1";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output data of the latest row
        $row = $result->fetch_assoc();
        $load_id = $row['load_id'];
        $courseCode = $row['courseCode'];
        $courseTitle = $row['courseTitle'];

        // Check if $courseCode is set and not empty, if not, use $courseTitle
        $course = isset($courseCode) && !empty($courseCode) ? $courseCode : $courseTitle;
        
        $hours_per_week = $row['hours_per_week'];
        $middleInitial = (!empty($row['middleName'])) ? strtoupper(substr($row['middleName'], 0, 1)) . "." : "";
        $subject_teacher = (empty($row['rank'])) ? 
                (($row['gender'] == 'Female') ? "Ms." : (($row['gender'] == 'Male') ? "Mr." : "")) : 
                $row['rank'] . " " . strtoupper($row['firstName']) . " " . strtoupper($middleInitial) . " " . strtoupper($row['lastName']);
    } else {
        $load_id = ""; // Set default value if no rows found
    }
} else {
    $load_id = "";
}

$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

if (!empty($student_id)) {
    // Assuming $conn is your database connection
    $sql = "SELECT *  FROM students WHERE id = $student_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output data of the latest row
        $row = $result->fetch_assoc();
        $middleInitial = !empty($row['middleName']) ? substr($row['middleName'], 0, 1) . '.' : '';
        $studentName = $row['lastName'] . ', ' . $row['firstName'] . ($middleInitial ? ' ' . $middleInitial : '');
        $lrn = $row['lrn'];
        $age = (new DateTime())->diff(new DateTime($row['birthday']))->y;
        $gender = $row['gender'];

    } else {
        $studentName = '';
        $lrn = '';
        $age = '';
        $gender = '';
    }
} else {
    $studentName = '';
    $lrn = '';
    $age = '';
    $gender = '';
}

?>

<?php
$gradeLevels2Kinder = ['Kinder'];
$gradeLevels2Elementary = ['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6', 'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];
$gradeLevels2HighSchool = ['Grade 11', 'Grade 12'];

$department2 = '';

if (in_array($gradeLevel2, $gradeLevels2Kinder)) {
    $department2 = '1';
    include '../report_filter/Kinder_form138.php';
} elseif (in_array($gradeLevel2, $gradeLevels2Elementary)) {
    $department2 = '2';
    include '../report_filter/g1-g10_form138.php';
} elseif (in_array($gradeLevel2, $gradeLevels2HighSchool)) {
    $department2 = '3';
    include '../report_filter/g11-g12_form138.php';
}else {
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

// Create new instance of TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Blank PDF');
$pdf->SetSubject('Blank PDF');
$pdf->SetKeywords('Blank, PDF');

// Remove header
$pdf->setPrintHeader(false); // This removes the header

// Add a page
$pdf->AddPage();

$filename = "g11-g12_form138_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';

}



?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- JavaScript for handling button actions -->
<script>
    document.getElementById('savePDF').addEventListener('click', savePDF);
    document.getElementById('printPDF').addEventListener('click', printPDF);

    function savePDF() {
        var pdfData = "<?php echo base64_encode($pdfData); ?>";
        var link = document.createElement("a");
        var currentDate = new Date();
        var dateString = (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + '-' + currentDate.getFullYear();
        
        var departmentName = "";
        if ("<?php echo $department2; ?>" === "1") {
            departmentName = "Kinder_form138_";
        } else if ("<?php echo $department2; ?>" === "2") {
            departmentName = "g1-g10_form138_";
        } else if ("<?php echo $department2; ?>" === "3") {
            departmentName = "g11-g12_form138_";
        }
        
        link.href = "data:application/pdf;base64," + pdfData;
        link.download = departmentName + dateString + ".pdf";
        link.click();
    }


    function printPDF() {
        var pdfData = "<?php echo base64_encode($pdfData); ?>";
        var pdfWindow = window.open(""); // Open a new window

        // Write PDF content to the new window
        pdfWindow.document.write("<iframe width=\'100%\' height=\'100%\' src=\'data:application/pdf;base64," + pdfData + "\'></iframe>");

        // Wait for PDF content to load before printing
        pdfWindow.onload = function() {
            // Print PDF
            pdfWindow.focus();
            pdfWindow.print();
            
            // Close the window after printing
            setTimeout(function() {
                pdfWindow.close();
            }, 1000);
        };
    }
</script>