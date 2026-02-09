<div class="row align-items-top">
    <!-- Start of Card Section -->
    <div class="col-lg-12 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Summary of Final Grades</h6>
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
                                                                    WHERE class.school_year_id = '$selectedYear' AND class.gradeLevel IN ($gradeLevels) AND class.gradeLevel NOT IN ('Grade 11', 'Grade 12')";
                                                } elseif ($_SESSION['userType'] == 'principal') {
                                                    $query_class = "SELECT DISTINCT class.id, class.gradeLevel, class.section
                                                                    FROM class 
                                                                    WHERE class.school_year_id = '$selectedYear' AND class.gradeLevel NOT IN ('Grade 11', 'Grade 12')";
                                                } elseif ($_SESSION['userType'] == 'registrar') {
                                                    $query_class = "SELECT DISTINCT class.id, class.gradeLevel, class.section
                                                                    FROM class 
                                                                    WHERE class.school_year_id = '$selectedYear' AND class.gradeLevel NOT IN ('Grade 11', 'Grade 12')";    
                                                } elseif ($_SESSION['userType'] == 'admin') {
                                                    $query_class = "SELECT DISTINCT class.id, class.gradeLevel, class.section
                                                                    FROM class 
                                                                    WHERE class.school_year_id = '$selectedYear' AND class.gradeLevel NOT IN ('Grade 11', 'Grade 12')";                              
                                                } else {
                                                    $query_class = "SELECT DISTINCT class.id, class.gradeLevel, class.section 
                                                                    FROM class 
                                                                    JOIN loads ON class.id = loads.class_id 
                                                                    JOIN faculty ON class.faculty_id = faculty.id 
                                                                    WHERE class.school_year_id = '$selectedYear' AND class.faculty_id = '$faculty_id' AND class.gradeLevel NOT IN ('Grade 11', 'Grade 12')";
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
            $class = $row['gradeLevel'] . " " . $row['section'];
            $middleInitial = (!empty($row['st_middleName'])) ? strtoupper(substr($row['st_middleName'], 0, 1)) . "." : "";
            $adviser = (empty($row['st_rank'])) ? (($row['gender'] == 'Female') ? "Ms." : (($row['gender'] == 'Male') ? "Mr." : "")) : $row['st_rank'] . " " . $row['firstName'] . " " . $middleInitial . " " . $row['st_lastName'];
            $middleInitial2 = (!empty($row['st_middleName'])) ? strtoupper(substr($row['st_middleName'], 0, 1)) : "";
            $middleInitial2 = (!empty($row['st_middleName'])) ? strtoupper(substr($row['st_middleName'], 0, 1)) . "." : "";
            $adviser2 = (empty($row['st_rank'])) ? 
                (($row['gender'] == 'Female') ? "Ms." : (($row['gender'] == 'Male') ? "Mr." : "")) : 
                $row['st_rank'] . " " . strtoupper($row['firstName']) . " " . strtoupper($middleInitial2) . " " . strtoupper($row['st_lastName']);  
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

?>


<?php
$academic_year = isset($academic_year) ? $academic_year : '';
$class = isset($class) ? $class : '';
$adviser2 = isset($adviser2) ? $adviser2 : '';
$chairperson = isset($chairperson) ? $chairperson : '';
$principal = isset($principal) ? $principal : '';
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class LaboratorySchooSummaryOfFinalGrades extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'cm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
{
    $format = 'LEGAL'; // Set paper size explicitly to legal
    parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
}


  public function Header()
{
    // Set margins
    $this->SetMargins(15, 40, 15); // Left, Top, Right

    // Add image
    $this->Image('../assets/img/bsulogo.jpg', 80, 6, 30);

    // Set Y position for text
    $this->SetY(5.5);

    // Add text and font
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 0, 'Republic of the Philippines', 0, 1, 'C');
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 0, 'BATANGAS STATE UNIVERSITY', 0, 1, 'C');
    $this->SetFont('helvetica', 'B', 12);
    // $this->SetTextColor(210, 54, 59); // Red color
    $this->Cell(0, 0, 'The National Engineering University', 0, 1, 'C');
    $this->SetTextColor(0, 0, 0);
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 0, 'ARASOF-Nasugbu Campus', 0, 1, 'C');
    $this->SetFont('helvetica', 'B', 10);
    $this->Cell(0, 12, 'LABORATORY SCHOOL', 0, 1, 'C');

    // Add line divider
    // $this->SetLineWidth(0.7);
    // $this->Line(0, 35, 356, 35); // Adjust as needed

 // Adjust the coordinates based on your needs

    }
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        $this->SetFont('helvetica', 'B', 12);
        $this->SetFont('', 'I', 12);
        $this->SetTextColor(210, 54, 59); // Red color
        $this->Cell(0, 1.0, 'Leading Innovations, Transforming Lives', 0, 1, 'C');

    
    }
}


// Example usage
$pdf = new LaboratorySchooSummaryOfFinalGrades('L', 'mm', 'Legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Summary of Final Grades');
$pdf->setY(58);
$pdf->AddPage();
$pdf->setY(42);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 6, 'SUMMARY OF FINAL GRADES', 0, 1, 'C'); 
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "$class | A.Y. $academic_year", 0, 1, 'C');

$pdf->SetFont('times', '', 10);
$pdf->setY(58);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(3);

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';

if (!empty($school_year) && !empty($class_id)) {

    $query_students = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.id as student_id
              FROM students s 
              JOIN class_students cs ON s.id = cs.student_id 
              JOIN class c ON cs.class_id = c.id
              JOIN loads l ON c.id = l.class_id 
              WHERE l.school_year_id = $school_year AND l.class_id = $class_id
              ORDER BY s.lastName";

    $result_students = mysqli_query($conn, $query_students);

    if ($result_students) {

        // Initialize array to store subject IDs
        $subject_ids = [];

        // Fetching and processing student data
        while ($row = mysqli_fetch_assoc($result_students)) {
            $student_id = mysqli_real_escape_string($conn, $row['student_id']);

            // Fetch the grades for the student per load_id
            $query_grades = "SELECT loads.id, loads.mapeh_name, subjects.courseTitle, q1_grade, q2_grade, q3_grade, q4_grade 
                             FROM subject_grades 
                             JOIN loads ON subject_grades.load_id = loads.id 
                             JOIN subjects ON loads.subject_id = subjects.id 
                             WHERE student_id = '$student_id' AND loads.school_year_id = $school_year";

            $result_grades = mysqli_query($conn, $query_grades);

            if ($result_grades) {
                while ($grade_row = mysqli_fetch_assoc($result_grades)) {
                    $courseTitle = isset($grade_row['mapeh_name']) && $grade_row['mapeh_name'] != '' ? $grade_row['mapeh_name'] : $grade_row['courseTitle'];

                    // Store course titles for header row per load_id
                    $subject_ids[$grade_row['id']][$courseTitle] = true;
                }
            } else {
                // Handle query error
                echo "Error fetching grades: " . mysqli_error($conn);
            }
        }

        // Chunk the subject IDs to limit to 7 per page
        $subject_ids_chunks = array_chunk($subject_ids, 7, true);

        foreach ($subject_ids_chunks as $chunk_index => $subject_chunk) {
            if ($chunk_index > 0) {
                $pdf->AddPage();
                $pdf->setY(58);
                $pdf->SetLeftMargin(10);
                $pdf->SetRightMargin(3);
            }

            // If course titles are found, create the table
            if (!empty($subject_chunk)) {
                // Start building HTML for the PDF
                $html = '<table border="1">';
                $html .= '<tr>';

                // Only include the first column on the first page
                if ($chunk_index === 0) {
                    $html .= '<td style="text-align: center; font-weight: bold; width: 5.7cm; font-family: times, sans-serif; font-size: 10px;"></td>';
                }

                // Print quarter headers for each course title per load_id
                foreach ($subject_chunk as $load_id => $courses) {
                    foreach ($courses as $courseTitle => $value) {
                        $html .= '<td colspan="5" style="text-align: center; font-weight: bold; width: 4.1cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">' . htmlspecialchars($courseTitle) . '</td>';
                    }
                }

                if ($chunk_index === 1) {
                    $html .= '<td rowspan="3" style="text-align: center; font-weight: bold; width: 1.8cm; font-family: helvetica, sans-serif; font-size: 10px;"></td>';
                    $html .= '<td rowspan="3" style="text-align: center; font-weight: bold; width: .9cm; font-family: helvetica, sans-serif; font-size: 8px;">GEN. AVERAGE</td>';
                }

                $html .= '</tr>';   

                $html .= '<tr>';

                // Only include the "NAMES OF LEARNERS" column on the first page
                if ($chunk_index === 0) {
                    $html .= '<td rowspan="2" style="text-align: center; font-weight: bold; width: 5.7cm; vertical-align: middle; line-height: 1cm; font-family: helvetica, sans-serif; font-size: 10px;">NAMES OF LEARNERS</td>';
                }

                foreach ($subject_chunk as $load_id => $courses) {
                    foreach ($courses as $courseTitle => $value) {
                        $html .= '<td colspan="4" style="text-align: center; font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER</td>
                                  <td rowspan="2" style="text-align: center; font-weight: bold; width: 0.90cm; font-family: Calibri, sans-serif; font-size: 8px;">FINAL GRADE</td>';
                    }
                }

                $html .= '</tr>';

                $html .= '<tr>';

                foreach ($subject_chunk as $load_id => $courses) {
                    foreach ($courses as $courseTitle => $value) {
                        $html .= '<td align="center" width="0.8cm" style="font-size: 7px; vertical-align: middle; line-height: 0.50cm;">1</td>
                                    <td align="center" width="0.8cm" style="font-size: 7px; vertical-align: middle; line-height: 0.50cm;">2</td>
                                    <td align="center" width="0.8cm" style="font-size: 7px; vertical-align: middle; line-height: 0.50cm;">3</td>
                                    <td align="center" width="0.8cm" style="font-size: 7px; vertical-align: middle; line-height: 0.50cm;">4</td>';
                    }
                }   

                $html .= '</tr>';

                // Fetch and print student names and grades
                mysqli_data_seek($result_students, 0); // Reset the query result pointer to the start
                while ($row = mysqli_fetch_assoc($result_students)) {
                    $student_id = $row['student_id'];
                    $student_name = $row['lastName'] . ", " . $row['firstName'] . " " . $row['middleName'];

                                        $html .= '<tr>';

                    // Only include the student name column on the first page
                    if ($chunk_index === 0) {
                        $html .= '<td>' . htmlspecialchars($student_name) . '</td>';
                    }

                    // Initialize variables to calculate student averages
                    $final_grades = [];

                    // Fetch the grades for the student
                    foreach ($subject_chunk as $load_id => $courses) {
                        foreach ($courses as $courseTitle => $value) {
                            $query_grades = "SELECT q1_grade, q2_grade, q3_grade, q4_grade 
                                             FROM subject_grades 
                                             WHERE student_id = '$student_id' AND load_id = '$load_id'";

                            $result_grades = mysqli_query($conn, $query_grades);

                            if ($result_grades && mysqli_num_rows($result_grades) > 0) {
                                $grades = mysqli_fetch_assoc($result_grades);

                                // Calculate final grade for the subject
                               if ($grades && is_numeric($grades['q1_grade']) && is_numeric($grades['q2_grade']) 
    && is_numeric($grades['q3_grade']) && is_numeric($grades['q4_grade'])) {
    $final_grade = round(((float)$grades['q1_grade'] 
                        + (float)$grades['q2_grade'] 
                        + (float)$grades['q3_grade'] 
                        + (float)$grades['q4_grade']) / 4);
} else {
    $final_grade = 0;  // Default if no valid numeric grades
}


                                $final_grades[] = $final_grade;

                                // Print grades for each course title
                                $html .= '<td style="text-align: center;">' . $grades['q1_grade'] . '</td>';
                                $html .= '<td style="text-align: center;">' . $grades['q2_grade'] . '</td>';
                                $html .= '<td style="text-align: center;">' . $grades['q3_grade'] . '</td>';
                                $html .= '<td style="text-align: center;">' . $grades['q4_grade'] . '</td>';
                                $html .= '<td style="text-align: center;">' . $final_grade . '</td>';
                            } else {
                                // Handle query error
                                $html .= '<td colspan="5">Error fetching grades: ' . mysqli_error($conn) . '</td>';
                            }
                        }
                    }

                    // Calculate average
                    $finalGradeAverageWithDecimal = $final_grades ? round(array_sum($final_grades) / count($final_grades), 2) : 0;
                    $finalGradeAverageRounded = round($finalGradeAverageWithDecimal);

// echo "final_grades: " . implode(", ", $final_grades) . "\n";
// // echo "finalGradeAverageWithDecimal: " . $finalGradeAverageWithDecimal . "\n";
// // echo "finalGradeAverageRounded: " . $finalGradeAverageRounded . "\n";

                    if ($chunk_index === 1) {
                        $html .= '<td style="text-align: center;">' . $finalGradeAverageWithDecimal . '</td>';
                        $html .= '<td style="text-align: center;">' . $finalGradeAverageRounded . '</td>';
                    }
                    $html .= '</tr>';
                }

                $html .= '</table>';

                $pdf->writeHTML($html);

                $pdf->ln();

                // Add footer if it's the first page
                if ($chunk_index === 0) {
                    $pdf->setx(15);
                    $pdf->SetFont('times', '', 9);
                    $pdf->Cell(0, 6, 'Prepared by:', 0, 0, 'L'); 
                    $pdf->setx(140);
                    $pdf->Cell(0, 6, 'Checked and reviewed by:', 0, 0, 'L');
                    $pdf->setx(240);
                    $pdf->Cell(0, 6, 'Approved by:', 0, 1, 'L');
                    $pdf->setx(15);
                    $pdf->SetFont('times', 'B', 9);
                    $pdf->Cell(0, 10, $adviser2, 0, 0, 'L'); 
                    $pdf->setx(140);
                    $pdf->Cell(0, 10, $chairperson, 0, 0, 'L');
                    $pdf->setx(240);
                    $pdf->Cell(0, 10, $principal, 0, 0, 'L');

                    $pdf->setx(15);
                    $pdf->SetFont('times', '', 9);
                    $pdf->Cell(0, 17, 'Adviser', 0, 0, 'L'); 

                    $pdf->setx(140);
                    $pdf->Cell(0, 17, 'Coordinator, JHS', 0, 0, 'L');
                    $pdf->setx(240);
                    $pdf->Cell(0, 17, 'Principal', 0, 0, 'L');

                    $pdf->setx(15);
                    $pdf->SetFont('times', '', 9);
                    $pdf->Cell(0, 23, 'Date: ' . date('m/d/Y'), 0, 0, 'L');
                    $pdf->setx(140);
                    $pdf->Cell(0, 23, 'Date: ' . date('m/d/Y'), 0, 0, 'L');
                    $pdf->setx(240);
                    $pdf->Cell(0, 23, 'Date: ' . date('m/d/Y'), 0, 0, 'L');
                }
            } else {
                // No course titles found message
                $html = '<p>No course titles found for the selected criteria.</p>';
                echo $html;
            }
        }
    } else {
        // No data found message
        $html = '<p>No data found for the selected criteria.</p>';
        echo $html;
    }
} else {
    // Handle the case where school_year or class_id is empty
    // $html = '<p>Please select a school year and a class.</p>';
    // echo $html;
} 


                             
$pdf->setY(58);
$pdf->setX(285);
if (!empty($school_year) && !empty($class_id)) {
$html = '<table border="1">
    <tr>
        <td rowspan="1" style="text-align: center; font-weight: bold; width: 1.3cm; font-family: helvetica, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">1st Quarter Average</td>
        <td rowspan="1" style="text-align: center; font-weight: bold; width: 1.3cm; font-family: helvetica, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">2nd Quarter Average</td>
        <td rowspan="1" style="text-align: center; font-weight: bold; width: 1.3cm; font-family: helvetica, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">3rd Quarter Average</td>
        <td rowspan="1" style="text-align: center; font-weight: bold; width: 1.3cm; font-family: helvetica, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">4th Quarter Average</td>
    </tr>
    <tr>
        <td align="center" width="1.3cm" style="font-size: 7px; vertical-align: middle; line-height: 0.50cm;">1</td>
        <td align="center" width="1.3cm" style="font-size: 7px; vertical-align: middle; line-height: 0.50cm;">2</td>
        <td align="center" width="1.3cm" style="font-size: 7px; vertical-align: middle; line-height: 0.50cm;">3</td>
        <td align="center" width="1.3cm" style="font-size: 7px; vertical-align: middle; line-height: 0.50cm;">4</td>
    </tr>';


// Fetch and print student names and grades
mysqli_data_seek($result_students, 0); // Reset the query result pointer to the start
while ($row = mysqli_fetch_assoc($result_students)) {
    $student_id = $row['student_id'];

    $q1_sum = 0;
    $q2_sum = 0;
    $q3_sum = 0;
    $q4_sum = 0;
    $grade_count = 0;

    $html .= '<tr>';

    // Fetch the grades for the student
    foreach ($subject_chunk as $load_id => $courses) {
        foreach ($courses as $courseTitle => $value) {
            $query_grades = "SELECT q1_grade, q2_grade, q3_grade, q4_grade 
                             FROM subject_grades 
                             WHERE student_id = '$student_id' AND load_id = '$load_id'";

            $result_grades = mysqli_query($conn, $query_grades);
            if ($result_grades) {
                $grades = mysqli_fetch_assoc($result_grades);

                // Calculate quarter averages
             $q1_sum += (isset($grades['q1_grade']) && is_numeric($grades['q1_grade'])) ? (float)$grades['q1_grade'] : 0;
$q2_sum += (isset($grades['q2_grade']) && is_numeric($grades['q2_grade'])) ? (float)$grades['q2_grade'] : 0;
$q3_sum += (isset($grades['q3_grade']) && is_numeric($grades['q3_grade'])) ? (float)$grades['q3_grade'] : 0;
$q4_sum += (isset($grades['q4_grade']) && is_numeric($grades['q4_grade'])) ? (float)$grades['q4_grade'] : 0;

                $grade_count++;

            } else {
                // Handle query error
                $html .= '<td colspan="5">Error fetching grades: ' . mysqli_error($conn) . '</td>';
            }
        }
    }

    // Calculate quarter averages for the student
    $q1_average = $grade_count ? $q1_sum / $grade_count : 0;
    $q2_average = $grade_count ? $q2_sum / $grade_count : 0;
    $q3_average = $grade_count ? $q3_sum / $grade_count : 0;
    $q4_average = $grade_count ? $q4_sum / $grade_count : 0;

    // Add quarter averages to the row
    $html .= '<td align="center">' . round($q1_average) . '</td>';
    $html .= '<td align="center">' . round($q2_average) . '</td>';
    $html .= '<td align="center">' . round($q3_average) . '</td>';
    $html .= '<td align="center">' . round($q4_average) . '</td>';


    $html .= '</tr>';
}

$html .= '</table>';

$pdf->writeHTML($html);
} else {

}

$filename = "Summary_of_Final_Grades_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';
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
    link.href = "data:application/pdf;base64," + pdfData;
    link.download = "Summary_of_Final_Grades_" + dateString + ".pdf";
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