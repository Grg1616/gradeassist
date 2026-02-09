<div class="row align-items-top">
    <!-- Start of Card Section -->
    <div class="col-lg-12 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Summary of Quarterly Grades</h6>
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
                                <!-- Semester Select -->
<!--                                 <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                            <select class="form-select" id="semester" name="semester" aria-label="Filter Department" onchange="this.form.submit()">
                                                <option disabled selected>Select Semester</option>
                                                <option value="1" <?php if(isset($_POST['semester']) && $_POST['semester'] == '1') echo 'selected'; ?>>First Semester</option>
                                                <option value="2" <?php if(isset($_POST['semester']) && $_POST['semester'] == '2') echo 'selected'; ?>>Second Semester</option>
                                            </select>
                                        <label for="semester">Semester</label>
                                    </div>
                                </div>
 -->
                                <!-- Class Select -->
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select id="class_id" name="class_id" class="form-select" aria-label="Select Class">
                                            <option disabled selected>Select Class</option>
                                            <?php
                                            if (isset($_POST['school_year'])) {
                                                $selectedYear = $_POST['school_year'];
                                                $query_class = "SELECT id, gradeLevel, section FROM class WHERE school_year_id = '$selectedYear'";
                                                $query_run_class = mysqli_query($conn, $query_class);

                                                if ($query_run_class) {
                                                    if (mysqli_num_rows($query_run_class) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query_run_class)) {
                                                            $gradeLevel = $row['gradeLevel'];
                                                            $section = $row['section'];
                                                            $classLabel = $gradeLevel . ' - ' . $section;

                                                            $selected = (isset($_POST['class_id']) && $_POST['class_id'] == $row['id']) ? 'selected' : '';

                                                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $classLabel . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option disabled>No classes found for the selected academic year</option>';
                                                    }
                                                } else {
                                                    echo '<option disabled>Error: ' . mysqli_error($conn) . '</option>';
                                                }
                                            } else {
                                                echo '<option disabled>No selected academic year</option>';
                                            }
                                            ?>
                                        </select>
                                        <label for="class_id">Class</label>
                                    </div>
                                </div>
                                <!-- Class Select -->
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select id="load_id" name="load_id" class="form-select" aria-label="Select Subject">
                                            <option disabled selected>Select Subject</option>
                                             <?php
                                            if (isset($_POST['class_id'])) {
                                                $selectedClass = $_POST['class_id'];
                                                $query_subjects = "SELECT s.id, s.courseCode, s.courseTitle, l.mapeh_name, l.id as load_id
                                                                    FROM subjects AS s
                                                                    JOIN loads AS l ON s.id = l.subject_id
                                                                    WHERE l.class_id = $selectedClass";
                                                $query_run_subjects = mysqli_query($conn, $query_subjects);
                                                if ($query_run_subjects) {
                                                    while ($row = mysqli_fetch_assoc($query_run_subjects)) {
                                                        $courseCode = $row['courseCode'];
                                                        $courseTitle = $row['courseTitle'];
                                                        $mapehName = $row['mapeh_name'];

                                                        // Construct the subject label
                                                        $subjectLabel = $courseCode ? $courseCode . ' - ' . ($mapehName ? $mapehName : $courseTitle) : $courseTitle;

                                                        $selected = (isset($_POST['load_id']) && $_POST['load_id'] == $row['load_id']) ? 'selected' : '';
                                                        echo '<option value="' . $row['load_id'] . '" ' . $selected . '>' . $subjectLabel . '</option>';
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_error($conn); // Print any errors that occur during the query execution
                                                }
                                            } else {
                                                echo '<option disabled>No selected class</option>';
                                            }
                                            ?>
                                        </select>
                                        <label for="load_id">Subject</label>
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
    document.getElementById('load_id').addEventListener('change', function() {
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
            $adviser2 = empty($row['st_rank']) ? 
                (($row['gender'] == 'Female') ? "Mrs. " : (($row['gender'] == 'Male') ? "Mr. " : "")) . strtoupper(substr($row['firstName'], 0, 1)) . strtoupper($middleInitial2) . ucfirst(strtolower($row['st_lastName'])) :
                ($row['st_rank'] . " " . strtoupper(substr($row['firstName'], 0, 1)) . strtoupper($middleInitial2) . ucfirst(strtolower($row['st_lastName'])));    
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
$load_id = isset($_POST['load_id']) ? $_POST['load_id'] : '';

if (!empty($school_year) && !empty($class_id) && !empty($load_id)) {
    // Sanitize the input to prevent SQL injection
    $school_year = intval($school_year);
    $class_id = intval($class_id);
    $load_id = intval($load_id);

    // Construct the SQL query string with sanitized values
    $sql = "SELECT loads.id as load_id, loads.hours_per_week, faculty.rank, faculty.firstName, faculty.middleName, faculty.lastName, faculty.gender, subjects.courseCode,  subjects.courseTitle, loads.mapeh_name
            FROM loads 
            JOIN faculty ON loads.faculty_id = faculty.id 
            JOIN subjects ON loads.subject_id = subjects.id 
            WHERE loads.class_id = $class_id 
            AND loads.school_year_id = $school_year 
            AND loads.id = $load_id 
            ORDER BY loads.id DESC 
            LIMIT 1";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output data of the latest row
        $row = $result->fetch_assoc();
        // $load_id = $row['load_id'];
        $courseCode = $row['courseCode'];
        if (isset($row['mapeh_name']) && $row['mapeh_name'] != '') {
            $courseTitle = $row['mapeh_name']; // Use 'mapeh_name' if it has a value
        } else {
            $courseTitle = $row['courseTitle']; // Otherwise, use 'courseTitle'
        }
        $hours_per_week = $row['hours_per_week'];
        $middleInitial = (!empty($row['middleName'])) ? strtoupper(substr($row['middleName'], 0, 1)) . "." : "";
        $subject_teacher = (empty($row['rank'])) ? 
                (($row['gender'] == 'Female') ? "Ms." : (($row['gender'] == 'Male') ? "Mr." : "")) : 
                $row['rank'] . " " . strtoupper($row['firstName']) . " " . strtoupper($middleInitial) . " " . strtoupper($row['lastName']);
    } else {
        // $load_id = ""; // Set default value if no rows found
    }
} else {
    // $load_id = "";
}


?>


<?php
$load_id = isset($load_id) ? $load_id : '';
$courseTitle = isset($courseTitle) ? $courseTitle : '';
$subject_teacher  = isset($subject_teacher ) ? $subject_teacher  : '';
$class = isset($class) ? $class : '';
$adviser2 = isset($adviser2) ? $adviser2 : '';

ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class SummaryofQuarterlyGrades extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
       parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
   }

   public function Header()
   {
        // Add image
       $this->Image('../assets/img/bsulogo.jpg', 20, 5.5, 35);
       // Add text and font
       $this->SetFont('times', 'B', 12);
       $this->SetY(10);
       $this->Cell(0, 1.0, 'Republic of the Philippines', 0, 1, 'C');
       $this->SetFont('times', 'B', 16);
       $this->Cell(0, 1.0, 'BATANGAS STATE UNIVERSITY', 0, 1, 'C');
       $this->SetFont('helvetica', 'B', 12);
       $this->SetTextColor(210, 54, 59); // Red color
       $this->Cell(0, 1.0, 'The National Engineering University', 0, 1, 'C');
       $this->SetTextColor(0, 0, 0);
       $this->SetFont('times', 'B', 12);
       $this->Cell(0, 1.0, 'ARASOF-Nasugbu Campus', 0, 1, 'C');
       $this->SetFont('times', 'B', 10);
       $this->Cell(200, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas, Philippines 4231', 0, 1, 'C');

       // Add line divider
    $this->SetLineWidth(0.7);
$this->Line(0, $this->GetY() + 2, 215.9, $this->GetY() + 2); // Adjust the coordinates based on your needs

    }
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        $this->SetFont('helvetica', 'B', 12);
        $this->SetFont('', 'I', 12);
        
        $this->SetTextColor(210, 54, 59); // Red color
        $this->Cell(0, 1.0, 'Leading Innovations, Transforming Lives', 0, 1, 'R');

    
    }
}


// Example usage
$pdf = new  SummaryofQuarterlyGrades('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Summary of Quarterly Grades');
$pdf->AddPage();
$pdf->setY(44);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL', 0, 1, 'C');  
$pdf->Cell(0, 3, 'SUMMARY OF QUARTERLY GRADES', 0, 1, 'C');

$pdf->setY(60);


$pdf->SetLeftMargin(14);
$pdf->SetRightMargin(14);
// Add HTML table
$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="3" style="text-align: center; font-weight: bold; width: 0.79cm; font-family: times, sans-serif; font-size: 9px;">
                    </td>

                    <td rowspan="3" style="text-align: center; font-weight: bold; width: 5.74cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 2.10cm;">NAME OF STUDENTS
                    </td>
                    
                    <td style="text-align: left; font-weight: bold; width: 6.34cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: .55cm;">GRADE & SECTION: <span style="font-weight: normal;">'. $class .'</span>
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 5.88cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: .55cm;">SCHOOL YEAR: <span style="font-weight: normal;">'. $academic_year .'</span>
                    </td>

                </tr>

                 <tr> 
                    <td style="text-align: left; font-weight: bold; width: 6.34cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: .55cm;">TEACHER: <span style="font-weight: normal;">'. $adviser2 .'</span>
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 5.88cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: .55cm;">SUBJECT: <span style="font-weight: normal;">'. $courseTitle .'</span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.89cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.45cm;">1st Quarter
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.45cm;">2nd Quarter
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.91cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.45cm;">3rd Quarter
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.91cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.45cm;">4th Quarter
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 2.54cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 1.00cm;">Final Grade
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 2.22cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 1.00cm;">Remark
                    </td>
                </tr>

                <tr style="background-color: #bfbfbf;">
                    <th style="text-align: center; font-weight: bold; width: 0.79cm; font-family: times, sans-serif; font-size: 9px;">
                    </th>
                    
                    <th style="text-align: center; font-weight: bold; width: 5.74cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>

                    <th style="text-align: center; font-weight: bold; width:  1.89cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.75cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.91cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.91cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 2.54cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 2.22cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>
                </tr>';


$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$load_id = isset($_POST['load_id']) ? $_POST['load_id'] : '';

if (!empty($school_year) && !empty($class_id) && !empty($load_id)) {
    $no = 1;
    $query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.id as student_id
              FROM students s 
              JOIN class_students cs ON s.id = cs.student_id 
              JOIN class c ON cs.class_id = c.id
              JOIN loads l ON c.id = l.class_id 
              WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year' AND l.id = '$load_id'
              ORDER BY s.lastName";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $student_id = $row['student_id'];
            $finalGrade = ""; // Initialize final grade with a default value

            $html .= '        <tr>';
            $html .= '                 <td style="font-size: 9px; vertical-align: middle; line-height: .50cm;" align="center">' . $no . '</td>';
            $html .= '                 <td style="font-weight: normal; font-size: 9px; vertical-align: middle; line-height: .50cm;" align="left">' . ucwords(strtolower($row['lastName'])) . ', ' . ucwords(strtolower($row['firstName'])) . ' ' . ucwords(substr($row['middleName'], 0, 1)) . '.</td>';

            $query_grades = "SELECT q1_grade, q2_grade, q3_grade, q4_grade FROM subject_grades WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year'";
            $result_grades = mysqli_query($conn, $query_grades);
            if ($result_grades && mysqli_num_rows($result_grades) > 0) {
                $row_grades = mysqli_fetch_assoc($result_grades);
                
                // Check if all quarterly grades have valid values
                if(isset($row_grades['q1_grade']) && $row_grades['q1_grade'] !== '' &&
                   isset($row_grades['q2_grade']) && $row_grades['q2_grade'] !== '' &&
                   isset($row_grades['q3_grade']) && $row_grades['q3_grade'] !== '' &&
                   isset($row_grades['q4_grade']) && $row_grades['q4_grade'] !== '') {
                
                    // Calculate final grade
                    $finalGrade = round(($row_grades['q1_grade'] + $row_grades['q2_grade'] + $row_grades['q3_grade'] + $row_grades['q4_grade']) / 4);
                } else {
                    $finalGrade = ""; // Set final grade as incomplete if any quarterly grade is missing
                }
            }
            
            // Calculate remarks
            if ($finalGrade !== "") {
                $remarks = ($finalGrade >= 75) ? "Passed" : "Failed";
            } else {
                $remarks = ""; // If final grade is not available, leave remarks empty
            }

            $html .= '                 <td style="font-weight: normal; font-size: 9px; vertical-align: middle; line-height: .50cm;" align="center">' . (isset($row_grades['q1_grade']) ? $row_grades['q1_grade'] : '') . '</td>';
            $html .= '                 <td style="font-weight: normal; font-size: 9px; vertical-align: middle; line-height: .50cm;" align="center">' . (isset($row_grades['q2_grade']) ? $row_grades['q2_grade'] : '') . '</td>';
            $html .= '                 <td style="font-weight: normal; font-size: 9px; vertical-align: middle; line-height: .50cm;" align="center">' . (isset($row_grades['q3_grade']) ? $row_grades['q3_grade'] : '') . '</td>';
            $html .= '                 <td style="font-weight: normal; font-size: 9px; vertical-align: middle; line-height: .50cm;" align="center">' . (isset($row_grades['q4_grade']) ? $row_grades['q4_grade'] : '') . '</td>';
            $html .= '                 <td style="font-weight: normal; font-size: 9px; vertical-align: middle; line-height: .50cm;" align="center">' . $finalGrade . '</td>';
            $html .= '                 <td style="font-weight: normal; font-size: 9px; vertical-align: middle; line-height: .50cm;" align="center">' . $remarks . '</td>';
            $html .= '             </tr>';

            $no++;
        }
    }
}
$html .= '         </table>';

$pdf->writeHTML($html);

$html = '<table>
            <thead>

                <tr>
                    <td style="height: 10px;">&nbsp;</td> <!-- Empty row for spacing -->
                </tr>

            </table>';

$pdf->writeHTML($html);


$pdf->setX(16);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 1.0, 'Prepared and submitted by:', 0, 0, 'L');
$pdf->setX(87);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 1.0, 'Checked and verified:', 0, 0, 'L');
$pdf->setX(144);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 1.0, 'Approved by:', 0, 0, 'L');


$pdf->setx(16);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 28, $subject_teacher, 0, 0, 'L');
$pdf->setx(87);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 28, $chairperson, 0, 0, 'L');
$pdf->setx(144);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 28, $principal, 0, 0, 'L');


$pdf->setx(16);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 36, 'Subject Teacher ', 0, 0, 'L');
$pdf->setx(87);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 36, 'Chairperson, High School ', 0, 0, 'L');
$pdf->setx(144);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 36, 'Principal ', 0, 0, 'L');


$pdf->setx(16);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, 'Date: ', 0, 0, 'L');
$pdf->setx(25);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, date('m/d/Y'), 0, 0, 'L');

$pdf->setx(87);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, 'Date: ', 0, 0, 'L');
$pdf->setx(96);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, date('m/d/Y'), 0, 0, 'L');

$pdf->setx(144);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, 'Date: ', 0, 0, 'L');
$pdf->setx(153);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, date('m/d/Y'), 0, 0, 'L');

$pdf->setY(-30);
$pdf->SetFont('times', '', 10);

$filename = "Summary_of_Quarterly_Grades_" . date("Y-m-d") . ".pdf";

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
    link.download = "Summary_of_Quarterly_Grades_" + dateString + ".pdf";
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