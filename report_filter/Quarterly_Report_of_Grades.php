<div class="row align-items-top">
    <!-- Start of Card Section -->
    <div class="col-lg-12 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Quarterly Report of Grades</h6>
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
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                            <select class="form-select" id="semester" name="semester" aria-label="Filter Department" onchange="this.form.submit()">
                                                <option disabled selected>Select Semester</option>
                                                <option value="1" <?php if(isset($_POST['semester']) && $_POST['semester'] == '1') echo 'selected'; ?>>First Semester</option>
                                                <option value="2" <?php if(isset($_POST['semester']) && $_POST['semester'] == '2') echo 'selected'; ?>>Second Semester</option>
                                            </select>
                                        <label for="semester">Semester</label>
                                    </div>
                                </div>

                                <!-- Quarter Select -->
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                            <select class="form-select" id="quarter" name="quarter" aria-label="Filter Department">
                                                <option disabled selected>Select Quarter</option>
                                                <?php if (isset($_POST['semester']) && $_POST['semester'] == '1'): ?>
                                                    <option value="1" <?php if(isset($_POST['quarter']) && $_POST['quarter'] == '1') echo 'selected'; ?>>First Quarter</option>
                                                    <option value="2" <?php if(isset($_POST['quarter']) && $_POST['quarter'] == '2') echo 'selected'; ?>>Second Quarter</option>
                                                <?php elseif (isset($_POST['semester']) && $_POST['semester'] == '2'): ?>
                                                    <option value="3" <?php if(isset($_POST['quarter']) && $_POST['quarter'] == '3') echo 'selected'; ?>>Third Quarter</option>
                                                    <option value="4" <?php if(isset($_POST['quarter']) && $_POST['quarter'] == '4') echo 'selected'; ?>>Fourth Quarter</option>
                                                <?php else: ?>
                                                    <option disabled>No selected semester</option>
                                                <?php endif; ?>
                                            </select>
                                        <label for="quarter">Quarter</label>
                                    </div>
                                </div>

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

    document.getElementById('semester').addEventListener('change', function() {
        document.getElementById('filterForm').submit(); // Submit the form on change
    });

    document.getElementById('quarter').addEventListener('change', function() {
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
$semester = isset($_POST['semester']) ? $_POST['semester'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';

if (!empty($school_year) && !empty($semester) && !empty($class_id)) {

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
            $class = $row['gradeLevel'] . " " . $row['section'];
            $gradeLevel = $row['gradeLevel'];
            $adviser = (empty($row['st_rank'])) ? (($row['gender'] == 'Female') ? "Ms." : (($row['gender'] == 'Male') ? "Mr." : "")) : $row['st_rank'] . " " . $row['firstName'] . " " . $row['st_middleName'] . " " . $row['st_lastName'];

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
?>

<?php
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

$quarter = isset($_POST['quarter']) ? $_POST['quarter'] : '';

if (!empty($quarter)) {
    if ($quarter == 1) {
        $quarterName = 'First';
    } elseif ($quarter == 2) {
        $quarterName = 'Second';
    } else {
        $quarterName = '';
    }
} else {
    $quarterName = '';
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
$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
if (!empty($school_year) && !empty($class_id) && !empty($load_id)) {
    $query = "SELECT 
                    gs.written,
                    gs.performance,
                    gs.assessment,
                    CASE 
                        WHEN sub.gradeLevel IN ('Kinder', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6') THEN 'Elementary'
                        WHEN sub.gradeLevel IN ('Grade 7', 'Grade 8', 'Grade 9', 'Grade 10') THEN 'High School'
                        WHEN sub.gradeLevel IN ('Grade 11', 'Grade 12') THEN 'Senior High School'
                        ELSE 'Unknown'
                    END AS categorized_level
                  FROM 
                    grading_system gs
                  JOIN 
                    subjects sub ON gs.level = (
                        CASE 
                            WHEN sub.gradeLevel IN ('Kinder', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6') THEN 'Elementary'
                            WHEN sub.gradeLevel IN ('Grade 7', 'Grade 8', 'Grade 9', 'Grade 10') THEN 'High School'
                            WHEN sub.gradeLevel IN ('Grade 11', 'Grade 12') THEN 'Senior High School'
                            ELSE 'Unknown'
                        END
                    ) AND gs.subjectArea = sub.subjectArea
                  JOIN 
                    loads l ON sub.id = l.subject_id
                  WHERE 
                    l.school_year_id = $school_year AND
                    l.class_id = $class_id";
    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if there are rows returned
    if (mysqli_num_rows($result) > 0) {
        // Initialize variables
        $written = "";
        $performance = "";
        $assessment = "";
        $categorized_level = "";

        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $written = $row["written"];
            $performance = $row["performance"];
            $assessment = $row["assessment"];
            $categorized_level = $row["categorized_level"];
        }
    } else {
        $written = "0";
        $performance = "0";
        $assessment = "0";
        $categorized_level = "0";
    }
} else {
    $written = "0";
    $performance = "0";
    $assessment = "0";
    $categorized_level = "0";
}

?>


<?php
$quarter = isset($_POST['quarter']) ? $_POST['quarter'] : '';
$academic_year = isset($academic_year) ? $academic_year : '';
$quarterName = isset($quarterName) ? $quarterName : '';
$courseCode = isset($courseCode) ? $courseCode : '';
$courseTitle = isset($courseTitle) ? $courseTitle : '';
$class = isset($class) ? $class : '';
$hours_per_week = isset($hours_per_week) ? $hours_per_week : '';
$subject_teacher  = isset($subject_teacher ) ? $subject_teacher  : '';
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class QuarterlyReportOfGrades extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'cm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
{
    $format = 'LEGAL'; // Set paper size explicitly to legal
    parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
}


   public function Header()
   {
       $this->SetMargins(15, 40, 15); // Left, Top, Right
        // Add image
       $this->Image('../assets/img/bsulogo.jpg', 90, 5.5, 35);
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
       $this->Cell(0, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas, Philippines 4231', 0, 1, 'C');

       // Add line divider
    $this->SetLineWidth(0.7);
$this->Line(0, $this->GetY() + 2, 356, $this->GetY() + 2); // Adjust the coordinates based on your needs

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
$pdf = new QuarterlyReportOfGrades('L', 'mm', 'Legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Quarterly Report of Grades');
$pdf->AddPage();
$pdf->setY(42);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL', 0, 1, 'C'); 
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 1.0, 'REPORT OF GRADES', 0, 1, 'C');

 
$pdf->SetFont('times', '', 10);
$pdf->setY(58);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(9.5);
// Add HTML table

if (!empty($school_year) && !empty($semester)&& !empty($quarter)&& !empty($class_id)&& !empty($load_id)) {

$html = '<table border="1" >
         
                <tr>
                    <td style="text-align: center; width: 4.49cm; font-family: times, sans-serif; font-size: 10px;">Quarter/Term: 
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 4.92cm; font-family: times, sans-serif; font-size: 10px;"> '. $quarterName. '
                    </td>

                    <td style="text-align: right; width: 5.56cm; font-family: times, sans-serif; font-size: 10px;">Academic Year: 
                    </td>

                    <td style="text-align: left;  font-weight: bold;width: 2.86cm; font-family: times, sans-serif; font-size: 10px;"> '. $academic_year .'
                    </td>

                    <td style="text-align: right; width: 4.65cm; font-family: times, sans-serif; font-size: 10px; padding-left: 20px;">Level/Section:</td>

                    <td style="text-align: left;  font-weight: bold;width: 5.24cm; font-family: times, sans-serif; font-size: 10px;"> '. $class .'
                    </td>

                    <td style="text-align: center;width: 2.95cm; font-family: times, sans-serif; font-size: 10px;">Hrs/wk: 
                    </td>

                    <td style="text-align: center;  font-weight: bold;width: 2.95cm; font-family: times, sans-serif; font-size: 10px;"> '. $hours_per_week .'
                    </td>    
                </tr>

                <tr>
                   <td align="center">Subject Code:</td>
                    <td align="left"><strong>'. $courseCode.'</strong></td>
                    <td align="right">Subject Description: </td>
                    <td align="left" width="18.65cm"><strong> '. $courseTitle.'</strong></td>
                </tr>
     
        </table>';

$pdf->writeHTML($html);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(9.5);
$html = '<table border="1" >
   
            <tr>
                <td style="text-align: center;font-weight: bold; width: 0.90cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">No.</td>

                <td style="text-align: center; font-weight: bold; width: 6cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">LEARNERS NAMES</td>

                <td style="text-align: center;font-weight: bold ;width: 9cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">WRITTEN WORKS (30%)</td>

                <td style="text-align: center;  font-weight: bold;width: 9cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">PERFORMANCE TASKS (50%)</td>

                <td style="text-align: center;font-weight: bold;width: 4cm; font-family: times, sans-serif; font-size: 9px;">QUARTERLY ASSESSMENT (20%) </td>

                <td rowspan="3"style="text-align: center;  font-weight: bold;width: 2.22cm;vertical-align: middle; line-height: 1.70cm; font-family: Calibri, sans-serif; font-size: 9px;">Initial Grade</td>

                <td rowspan="3" style="text-align: center; font-weight: bold; width: 2.50cm; vertical-align: middle; line-height: 1.70cm; font-family: Calibri, sans-serif; font-size: 9px;">Quarterly Grade</td>   
            </tr>

            <tr>
                <td align="center"><b></b></td>
                <td align="left"><b></b></td>';

$query = "SELECT * 
          FROM written_works 
          WHERE load_id = '$load_id' 
          AND school_year_id = '$school_year' 
          AND quarter = '$quarter'";

// Assuming $query_run is the result of mysqli_query() or similar
$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        // Compute total of wps1 to wps10
        $total_wps = 0;
        $numColumnsWithValue = 0; // Initialize the counter for columns with values
        for ($i = 1; $i <= 10; $i++) {
            // Check if the value is not empty or null before adding to the total
            if (!empty($row['wps' . $i]) && $row['wps' . $i] !== null) {
                $total_wps += $row['wps' . $i];
                $numColumnsWithValue++; // Increment the counter if the column has a value
            }
        }

       if ($numColumnsWithValue === 1) {
            $cellWidth = '4.25cm';
        } elseif ($numColumnsWithValue === 2) {
            $cellWidth = '2.13cm';
        } elseif ($numColumnsWithValue === 3) {
            $cellWidth = '1.42cm';
        } elseif ($numColumnsWithValue === 4) {
            $cellWidth = '1.067cm';
        } elseif ($numColumnsWithValue === 5) {
            $cellWidth = '0.85cm';
        } elseif ($numColumnsWithValue >= 6 && $numColumnsWithValue <= 10) {
            $cellWidth = '0.75cm';
        } else {
            $cellWidth = '0.85cm'; // Default value
        }

        for ($i = 1; $i <= $numColumnsWithValue; $i++) {
           $html .= '<td align="center" width="' . $cellWidth . '"><b>' . $i . '</b></td>';
        }
        
    }
} else {
$html .= '<td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>';
}
// Now add the remaining static HTML
$html .= '          
                <td align="center" width="1.55cm"><b>Total</b></td>
                <td align="center" width="1.60cm"><b>PS</b></td>
                <td align="center" width="1.60cm"><b>WS</b></td>';
$query = "SELECT * 
          FROM performance_task
          WHERE load_id = '$load_id' 
          AND school_year_id = '$school_year' 
          AND quarter = '$quarter'";

// Assuming $query_run is the result of mysqli_query() or similar
$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        // Compute total of wps1 to wps10
        $total_pps = 0;
        $numColumnsWithValue = 0; // Initialize the counter for columns with values
        for ($i = 1; $i <= 10; $i++) {
            // Check if the value is not empty or null before adding to the total
            if (!empty($row['pps' . $i]) && $row['pps' . $i] !== null) {
                $total_pps += $row['pps' . $i];
                $numColumnsWithValue++;
            }
        }

        if ($numColumnsWithValue === 1) {
            $cellWidth = '4.25cm';
        } elseif ($numColumnsWithValue === 2) {
            $cellWidth = '2.13cm';
        } elseif ($numColumnsWithValue === 3) {
            $cellWidth = '1.42cm';
        } elseif ($numColumnsWithValue === 4) {
            $cellWidth = '1.067cm';
        } elseif ($numColumnsWithValue === 5) {
            $cellWidth = '0.85cm';
        } elseif ($numColumnsWithValue >= 6 && $numColumnsWithValue <= 10) {
            $cellWidth = '0.75cm';
        } else {
            $cellWidth = '0.85cm'; // Default value
        }
        
        $rowData = ''; // Initialize row data
        for ($i = 1; $i <= $numColumnsWithValue; $i++) {
           $html .= '<td align="center" width="' . $cellWidth . '"><b>' . $i . '</b></td>';
        }
        
    }
} else {
$html .= '<td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>';
}
 $html .= '     <td align="center" width="1.55cm"><b>Total</b></td>
                <td align="center" width="1.60cm"><b>PS</b></td>
                <td align="center" width="1.60cm"><b>WS</b></td>
                <td align="center" width="0.80cm"><b></b></td>
                <td align="center" width="1.60cm"><b>PS</b></td>
                <td align="center" width="1.60cm"><b>WS</b></td>  
            </tr>

            <tr>
                <td align="center"><b></b></td>
                <td align="right"><b>Number of item</b></td>';

$wpstotal = 0;
$ww_id = null;
function addWWTotal(&$wpstotal, $value) {
    if (is_numeric($value)) {
        $wpstotal += (int)$value;
    }
}

$query = "SELECT * 
          FROM written_works 
          WHERE load_id = '$load_id' 
          AND school_year_id = '$school_year' 
          AND quarter = '$quarter'";

// Assuming $query_run is the result of mysqli_query() or similar
$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        // Compute total of wps1 to wps10
        $total_wps = 0;
        $ww_id = $row['id'];
        $numColumnsWithValue = 0; // Initialize the counter for columns with values
        for ($i = 1; $i <= 10; $i++) {
            // Check if the value is not empty or null before adding to the total
            if (!empty($row['wps' . $i]) && $row['wps' . $i] !== null) {
                $total_wps += $row['wps' . $i];
                $numColumnsWithValue++; // Increment the counter if the column has a value
            }
        }

        if ($numColumnsWithValue === 1) {
            $cellWidth = '4.25cm';
        } elseif ($numColumnsWithValue === 2) {
            $cellWidth = '2.13cm';
        } elseif ($numColumnsWithValue === 3) {
            $cellWidth = '1.42cm';
        } elseif ($numColumnsWithValue === 4) {
            $cellWidth = '1.067cm';
        } elseif ($numColumnsWithValue === 5) {
            $cellWidth = '0.85cm';
        } elseif ($numColumnsWithValue >= 6 && $numColumnsWithValue <= 10) {
            $cellWidth = '0.75cm';
        } else {
            $cellWidth = '0.85cm'; // Default value
        }
        
        // Generate HTML table row with the appropriate number of <td> elements based on numColumnsWithValue
        $rowData = ''; // Initialize row data
        for ($i = 1; $i <= $numColumnsWithValue; $i++) {
            $value = $row['wps' . $i];
            addWWTotal($wpstotal, $value);
            $html .= '<td align="center" width="' . $cellWidth . '"><b>' . $value . '</b></td>';
        }
    }
} else {
$html .= '<td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>';
}

$html .= '     <td align="center" width="1.55cm"><b>' . $wpstotal . '</b></td>
                <td align="center" width="1.60cm"><b>100.00</b></td>
                <td align="center" width="1.60cm"><b>'. $written .'%</b></td>';

$pps_total = 0; 
$pt_id = null;
function addPTTotal(&$pps_total, $value) {
    if (is_numeric($value)) {
        $pps_total += (int)$value;
    }
}

$query = "SELECT * 
          FROM performance_task 
          WHERE load_id = '$load_id' 
          AND school_year_id = '$school_year' 
          AND quarter = '$quarter'";

// Assuming $query_run is the result of mysqli_query() or similar
$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        // Compute total of wps1 to wps10
        $total_pps = 0;
        $pt_id = $row['id'];
        $numColumnsWithValue = 0; // Initialize the counter for columns with values
        for ($i = 1; $i <= 10; $i++) {
            // Check if the value is not empty or null before adding to the total
            if (!empty($row['pps' . $i]) && $row['pps' . $i] !== null) {
                $total_pps += $row['pps' . $i];
                $numColumnsWithValue++; // Increment the counter if the column has a value
            }
        }

        if ($numColumnsWithValue === 1) {
            $cellWidth = '4.25cm';
        } elseif ($numColumnsWithValue === 2) {
            $cellWidth = '2.13cm';
        } elseif ($numColumnsWithValue === 3) {
            $cellWidth = '1.42cm';
        } elseif ($numColumnsWithValue === 4) {
            $cellWidth = '1.067cm';
        } elseif ($numColumnsWithValue === 5) {
            $cellWidth = '0.85cm';
        } elseif ($numColumnsWithValue >= 6 && $numColumnsWithValue <= 10) {
            $cellWidth = '0.75cm';
        } else {
            $cellWidth = '0.85cm'; // Default value
        }
        
        // Generate HTML table row with the appropriate number of <td> elements based on numColumnsWithValue
        $rowData = ''; // Initialize row data
        for ($i = 1; $i <= $numColumnsWithValue; $i++) {
            $value = $row['pps' . $i];
            addWWTotal($pps_total, $value);
            $html .= '<td align="center" width="' . $cellWidth . '"><b>' . $value . '</b></td>';
        }
    }
} else {
$html .= '<td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>';
}

 $html .= '     <td align="center" width="1.55cm"><b>' . $pps_total . '</b></td>
                <td align="center" width="1.60cm"><b>100.00</b></td>
                <td align="center" width="1.60cm"><b>'. $performance .'%</b></td>';
$qps_total = 0; // Initialize qps_total variable
$qa_id = null; // Initialize qa_id variable

// Function to add value to qps_total if it's numeric
function addQATotal(&$qps_total, $value) {
    if (is_numeric($value)) {
        $qps_total += (int)$value;
    }
}

$query = "SELECT * 
          FROM quarterly_assessment 
          WHERE load_id = '$load_id' 
          AND school_year_id = '$school_year' 
          AND quarter = '$quarter'";

// Assuming $query_run is the result of mysqli_query() or similar
$query_run = mysqli_query($conn, $query);

// Check if the query was executed successfully
if ($query_run) {
    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        // Compute total of wps1 to wps10
        $qa_id = $row['id'];

        $value = $row['ps'];
        $total_ps = $row['ps'];
        addQATotal($qps_total, $value); // Corrected function name
        $html .= '<td align="center" width="0.80cm"><b>' . $value . '</b></td>';
    } else {
    $html .= '<td align="center"width="0.80cm"></td>';
    }
}

 $html .= '      <td align="center" width="1.60cm"><b>100.00</b></td>
                <td align="center" width="1.60cm"><b>'. $assessment .'%</b></td>  
            </tr>

            <tr style="background-color: #bfbfbf;">
                <td align="center"></td>
                <td align="left"></td>';
$wpstotal = 0;
$ww_id = null;


$query = "SELECT * 
          FROM written_works 
          WHERE load_id = '$load_id' 
          AND school_year_id = '$school_year' 
          AND quarter = '$quarter'";

$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        // Compute total of wps1 to wps10
        $total_wps = 0;
        $ww_id = $row['id'];
        $numColumnsWithValue = 0; // Initialize the counter for columns with values
        for ($i = 1; $i <= 10; $i++) {
            // Check if the value is not empty or null before adding to the total
            if (!empty($row['wps' . $i]) && $row['wps' . $i] !== null) {
                $total_wps += $row['wps' . $i];
                $numColumnsWithValue++; // Increment the counter if the column has a value
            }
        }

        if ($numColumnsWithValue === 1) {
            $cellWidth = '4.25cm';
        } elseif ($numColumnsWithValue === 2) {
            $cellWidth = '2.13cm';
        } elseif ($numColumnsWithValue === 3) {
            $cellWidth = '1.42cm';
        } elseif ($numColumnsWithValue === 4) {
            $cellWidth = '1.067cm';
        } elseif ($numColumnsWithValue === 5) {
            $cellWidth = '0.85cm';
        } elseif ($numColumnsWithValue >= 6 && $numColumnsWithValue <= 10) {
            $cellWidth = '0.75cm';
        } else {
            $cellWidth = '0.85cm'; // Default value
        }
        
        // Generate HTML table row with the appropriate number of <td> elements based on numColumnsWithValue
        $rowData = ''; // Initialize row data
        for ($i = 1; $i <= $numColumnsWithValue; $i++) {
            $value = $row['wps' . $i];
            addWWTotal($wpstotal, $value);
            $html .= '<td align="center" width="' . $cellWidth . '"></td>';
        }
    }
} else {
$html .= '<td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>';
}

 $html .= '     <td align="center" width="1.55cm"></td>
                <td align="center" width="1.60cm"></td>
                <td align="center" width="1.60cm"></td>';

$pps_total = 0; 
$pt_id = null;


$query = "SELECT * 
          FROM performance_task 
          WHERE load_id = '$load_id' 
          AND school_year_id = '$school_year' 
          AND quarter = '$quarter'";

// Assuming $query_run is the result of mysqli_query() or similar
$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        // Compute total of wps1 to wps10
        $total_pps = 0;
        $pt_id = $row['id'];
        $numColumnsWithValue = 0; // Initialize the counter for columns with values
        for ($i = 1; $i <= 10; $i++) {
            // Check if the value is not empty or null before adding to the total
            if (!empty($row['pps' . $i]) && $row['pps' . $i] !== null) {
                $total_pps += $row['pps' . $i];
                $numColumnsWithValue++; // Increment the counter if the column has a value
            }
        }

        if ($numColumnsWithValue === 1) {
            $cellWidth = '4.25cm';
        } elseif ($numColumnsWithValue === 2) {
            $cellWidth = '2.13cm';
        } elseif ($numColumnsWithValue === 3) {
            $cellWidth = '1.42cm';
        } elseif ($numColumnsWithValue === 4) {
            $cellWidth = '1.067cm';
        } elseif ($numColumnsWithValue === 5) {
            $cellWidth = '0.85cm';
        } elseif ($numColumnsWithValue >= 6 && $numColumnsWithValue <= 10) {
            $cellWidth = '0.75cm';
        } else {
            $cellWidth = '0.85cm'; // Default value
        }
        
        // Generate HTML table row with the appropriate number of <td> elements based on numColumnsWithValue
        $rowData = ''; // Initialize row data
        for ($i = 1; $i <= $numColumnsWithValue; $i++) {
            $value = $row['pps' . $i];
            addWWTotal($pps_total, $value);
            $html .= '<td align="center" width="' . $cellWidth . '"></td>';
        }
    }
} else {
$html .= '<td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>
          <td align="center"width="0.85cm"></td>';
}

 $html .= '     <td align="center" width="1.55cm"></td>
                <td align="center" width="1.60cm"></td>
                <td align="center" width="1.60cm"></td>';
$qps_total = 0; // Initialize qps_total variable
$qa_id = null; // Initialize qa_id variable

// Function to add value to qps_total if it's numeric


$query = "SELECT * 
          FROM quarterly_assessment 
          WHERE load_id = '$load_id' 
          AND school_year_id = '$school_year' 
          AND quarter = '$quarter'";

// Assuming $query_run is the result of mysqli_query() or similar
$query_run = mysqli_query($conn, $query);

// Check if the query was executed successfully
if ($query_run) {
    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        // Compute total of wps1 to wps10
        $qa_id = $row['id'];

        $value = $row['ps'];
        $total_ps = $row['ps'];
        addQATotal($qps_total, $value); // Corrected function name
        $html .= '<td align="center" width="0.80cm"></td>';
    } else {
    $html .= '<td align="center"width="0.80cm"></td>';
    }
}
  $html .= '    <td align="center" width="1.60cm"></td>
                <td align="center" width="1.60cm"></td>  
                <td align="center"width="2.22cm"></td>
                <td align="center"width="2.50cm"></td>
            </tr>

            ';

$no = 1;
$query = "SELECT DISTINCT
    s.sr_code,
    s.firstName,
    s.lastName,
    s.middleName,
    s.id as student_id,
    ww.w1, ww.w2, ww.w3, ww.w4, ww.w5, ww.w6, ww.w7, ww.w8, ww.w9, ww.w10,
    pt.pt1, pt.pt2, pt.pt3, pt.pt4, pt.pt5, pt.pt6, pt.pt7, pt.pt8, pt.pt9, pt.pt10,
    qa.score
FROM 
    students s 
    JOIN class_students cs ON s.id = cs.student_id 
    JOIN class c ON cs.class_id = c.id
    JOIN loads l ON c.id = l.class_id 
    LEFT JOIN ww_score ww ON s.id = ww.student_id
    LEFT JOIN pt_score pt ON s.id = pt.student_id
    LEFT JOIN qa_score qa ON s.id = qa.student_id
WHERE 
    l.class_id = '$class_id' 
    AND l.school_year_id = '$school_year' 
    AND l.class_id = '$class_id'
    AND ww.quarter = '$quarter'
    AND ww.school_year_id = '$school_year'
    AND ww.load_id = '$load_id'
    AND pt.quarter = '$quarter'
    AND pt.school_year_id = '$school_year'
    AND pt.load_id = '$load_id'
    AND qa.quarter = '$quarter'
    AND qa.school_year_id = '$school_year'
    AND qa.load_id = '$load_id'";

// Assuming $query_run is the result of mysqli_query() or similar
$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
    $ww_maxColumnWithValue = 0;
    $ww_rowNumberWithMaxColumn = 0;
    $ww_currentRowNumber = 0;
    $pt_maxColumnWithValue = 0;
    $pt_rowNumberWithMaxColumn = 0;
    $pt_currentRowNumber = 0;
    while ($row = mysqli_fetch_assoc($query_run)) {

        // Compute total for w1 to w10
$wtotal = array_sum(array_map(fn($key) => $row[$key] ?? 0, array_map(fn($i) => "w$i", range(1, 10))));

                                    // Compute total for pt1 to pt10
$pttotal = array_sum(array_map(fn($key) => $row[$key] ?? 0, array_map(fn($i) => "pt$i", range(1, 10))));

$html .= '<tr> <td align="center">' . $no++ . '</td>';
$html .= '<td align="left">' . ucwords(strtolower($row['lastName'])) . ', ' . ucwords(strtolower($row['firstName'])) . ' ' . ucwords(substr($row['middleName'], 0, 1)) . '.' . '</td>';

$ww_currentRowNumber++;

// Initialize variables for each row
$numColumnsWithValue = 0;

for ($i = 1; $i <= 10; $i++) {
    if (isset($row["w$i"]) && !empty($row["w$i"])) {
        // Check if the current column has a value
        $numColumnsWithValue++;
        // Update the maximum column index if necessary
        if ($i > $ww_maxColumnWithValue) {
            $ww_maxColumnWithValue = $i;
            // Store the row number with max column value
            $ww_rowNumberWithMaxColumn = $ww_currentRowNumber;
        }
    }
}

// Now that you have the count of columns with values, set cell width based on this count
if ($ww_maxColumnWithValue === 1) {
    $cellWidth = '4.25cm';
} elseif ($ww_maxColumnWithValue === 2) {
    $cellWidth = '2.13cm';
} elseif ($ww_maxColumnWithValue === 3) {
    $cellWidth = '1.42cm';
} elseif ($ww_maxColumnWithValue === 4) {
    $cellWidth = '1.067cm';
} elseif ($ww_maxColumnWithValue === 5) {
    $cellWidth = '0.85cm';
} elseif ($ww_maxColumnWithValue >= 6 && $ww_maxColumnWithValue <= 10) {
    $cellWidth = '0.75cm';
} else {
    $cellWidth = '0.85cm'; // Default value
}

for ($i = 1; $i <= $ww_maxColumnWithValue; $i++) {
    if (isset($row["w$i"]) && !empty($row["w$i"])) {
        $html .= '<td align="center" width="' . $cellWidth . '">' . $row["w$i"] . '</td>';
    } else {
        $html .= '<td align="center" width="' . $cellWidth . '"></td>';
    }
}

$html .= '<td align="center"width="1.55cm">' . $wtotal . '</td>';

if ($wpstotal != 0 && $written != 0) {
    $written_ps = number_format(($wtotal / $wpstotal) * 100, 2);
    $written_percentage = number_format($written / 100, 2);
    $written_ws = number_format($written_ps * $written_percentage, 2);
} else {
    $written_ps = 0;
    $written_ws = 0;
}

$html .= '<td align="center"width="1.60cm">' . $written_ps . '</td>';
$html .= '<td align="center"width="1.60cm">' . $written_ws . '</td>';

$pt_currentRowNumber++;

// Initialize variables for each row
$pt_numColumnsWithValue = 0;

for ($i = 1; $i <= 10; $i++) {
    if (isset($row["pt$i"]) && !empty($row["pt$i"])) {
        // Check if the current column has a value
        $pt_numColumnsWithValue++;
        // Update the maximum column index if necessary
        if ($i > $pt_maxColumnWithValue) {
            $pt_maxColumnWithValue = $i;
            // Store the row number with max column value
            $pt_rowNumberWithMaxColumn = $pt_currentRowNumber;
        }
    }
}


// Now that you have the count of columns with values, set cell width based on this count
if ($pt_maxColumnWithValue === 1) {
    $cellWidth = '4.25cm';
} elseif ($pt_maxColumnWithValue === 2) {
    $cellWidth = '2.13cm';
} elseif ($pt_maxColumnWithValue === 3) {
    $cellWidth = '1.42cm';
} elseif ($pt_maxColumnWithValue === 4) {
    $cellWidth = '1.067cm';
} elseif ($pt_maxColumnWithValue === 5) {
    $cellWidth = '0.85cm';
} elseif ($pt_maxColumnWithValue >= 6 && $pt_maxColumnWithValue <= 10) {
    $cellWidth = '0.75cm';
} else {
    $cellWidth = '0.85cm'; // Default value
}

for ($i = 1; $i <= $pt_maxColumnWithValue; $i++) {
    if (isset($row["pt$i"]) && !empty($row["pt$i"])) {
        $html .= '<td align="center" width="' . $cellWidth . '">' . $row["pt$i"] . '</td>';
    } else {
        $html .= '<td align="center" width="' . $cellWidth . '"></td>';
    }
}


$html .= '<td align="center"width="1.55cm">' . $pttotal . '</td>';

if ($total_pps != 0 && $performance != 0) {
    $performance_ps = number_format(($pttotal / $total_pps) * 100, 2);
    $performance_percentage = number_format($performance / 100, 2);
    $performance_ws = number_format($performance_ps * $performance_percentage, 2);
} else {
    $performance_ps = 0;
    $performance_ws = 0;
}

$html .= '<td align="center"width="1.60cm">' . $performance_ps . '</td>';
$html .= '<td align="center"width="1.60cm">' . $performance_ws . '</td>';
$html .= '<td align="center"width="0.80cm">' . (isset($row['score']) ? $row['score'] : '') . '</td>';

if(isset($row['score']) && $row['score'] !== ''):
    if ($total_ps != 0 && $assessment != 0) {
        $assessment_ps = number_format(($row['score'] / $total_ps) * 100, 2);
        $assessment_percentage = number_format($assessment / 100, 2);
        $assessment_ws = number_format($assessment_ps * $assessment_percentage, 2);
    } else {
        $assessment_ps = 0;
        $assessment_ws = 0;
    }
endif;

$html .= '<td align="center"width="1.60cm">' . $assessment_ps . '</td>';
$html .= '<td align="center"width="1.60cm">' . $assessment_ws . '</td>';

$written_ws = $written_ws ?? 0;
$performance_ws = $performance_ws ?? 0;
$assessment_ws = $assessment_ws ?? 0;
$initial_grade = $written_ws + $performance_ws + $assessment_ws;
$formatted_initial_grade = number_format($initial_grade, 2);

$html .= '<td align="center"width="2.22cm">' . $formatted_initial_grade . '</td>';

// Calculate the transmuted grade
$transmuted_grade = 60; // default value

if ($formatted_initial_grade >= 100) {
    $transmuted_grade = 100;
} elseif ($formatted_initial_grade >= 98.40) {
    $transmuted_grade = 99;
} elseif ($formatted_initial_grade >= 96.80) {
    $transmuted_grade = 98;
} elseif ($formatted_initial_grade >= 95.20) {
    $transmuted_grade = 97;
} elseif ($formatted_initial_grade >= 93.60) {
    $transmuted_grade = 96;
} elseif ($formatted_initial_grade >= 92.00) {
    $transmuted_grade = 95;
} elseif ($formatted_initial_grade >= 90.40) {
    $transmuted_grade = 94;
} elseif ($formatted_initial_grade >= 88.80) {
    $transmuted_grade = 93;
} elseif ($formatted_initial_grade >= 87.20) {
    $transmuted_grade = 92;
} elseif ($formatted_initial_grade >= 85.60) {
    $transmuted_grade = 91;
} elseif ($formatted_initial_grade >= 84.00) {
    $transmuted_grade = 90;
} elseif ($formatted_initial_grade >= 82.40) {
    $transmuted_grade = 89;
} elseif ($formatted_initial_grade >= 80.80) {
    $transmuted_grade = 88;
} elseif ($formatted_initial_grade >= 79.20) {
    $transmuted_grade = 87;
} elseif ($formatted_initial_grade >= 77.60) {
    $transmuted_grade = 86;
} elseif ($formatted_initial_grade >= 76.00) {
    $transmuted_grade = 85;
} elseif ($formatted_initial_grade >= 74.40) {
    $transmuted_grade = 84;
} elseif ($formatted_initial_grade >= 72.80) {
    $transmuted_grade = 83;
} elseif ($formatted_initial_grade >= 71.20) {
    $transmuted_grade = 82;
} elseif ($formatted_initial_grade >= 69.60) {
    $transmuted_grade = 81;
} elseif ($formatted_initial_grade >= 68.00) {
    $transmuted_grade = 80;
} elseif ($formatted_initial_grade >= 66.40) {
    $transmuted_grade = 79;
} elseif ($formatted_initial_grade >= 64.80) {
    $transmuted_grade = 78;
} elseif ($formatted_initial_grade >= 63.20) {
    $transmuted_grade = 77;
} elseif ($formatted_initial_grade >= 61.60) {
    $transmuted_grade = 76;
} elseif ($formatted_initial_grade >= 60.00) {
    $transmuted_grade = 75;
} elseif ($formatted_initial_grade >= 56.00) {
    $transmuted_grade = 74;
} elseif ($formatted_initial_grade >= 52.00) {
    $transmuted_grade = 73;
} elseif ($formatted_initial_grade >= 48.00) {
    $transmuted_grade = 72;
} elseif ($formatted_initial_grade >= 44.00) {
    $transmuted_grade = 71;
} elseif ($formatted_initial_grade >= 40.00) {
    $transmuted_grade = 70;
} elseif ($formatted_initial_grade >= 36.00) {
    $transmuted_grade = 69;
} elseif ($formatted_initial_grade >= 32.00) {
    $transmuted_grade = 68;
} elseif ($formatted_initial_grade >= 28.00) {
    $transmuted_grade = 67;
} elseif ($formatted_initial_grade >= 24.00) {
    $transmuted_grade = 66;
} elseif ($formatted_initial_grade >= 20.00) {
    $transmuted_grade = 65;
} elseif ($formatted_initial_grade >= 16.00) {
    $transmuted_grade = 64;
} elseif ($formatted_initial_grade >= 12.00) {
    $transmuted_grade = 63;
} elseif ($formatted_initial_grade >= 4.00) {
    $transmuted_grade = 62;
}

$html .= '<td align="center"width="2.50cm">' . $transmuted_grade . '</td></tr>';

    }
}
           
$html .= '</tbody></table>';

$pdf->writeHTML($html);

} else {

$pdf->SetFont('times', '', 10);
$pdf->setY(58);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(9.5);
// Add HTML table
$html = '<table border="1" >
         
                <tr>
                    <td style="text-align: center; width: 4.49cm; font-family: times, sans-serif; font-size: 10px;">Quarter/Term: 
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 4.92cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: right; width: 5.56cm; font-family: times, sans-serif; font-size: 10px;">Academic Year: 
                    </td>

                    <td style="text-align: left;  font-weight: bold;width: 2.86cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: right; width: 4.65cm; font-family: times, sans-serif; font-size: 10px; padding-left: 20px;">Level/Section:</td>

                    <td style="text-align: left;  font-weight: bold;width: 5.24cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;width: 2.95cm; font-family: times, sans-serif; font-size: 10px;">Hrs/wk: 
                    </td>

                    <td style="text-align: center;  font-weight: bold;width: 2.95cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>    
                </tr>

                <tr>
                   <td align="center">Subject Code:</td>
                    <td align="left"><strong> </strong></td>
                    <td align="right">Subject Description: </td>
                    <td align="left" width="18.65cm"><strong></strong></td>   
                </tr>
     
        </table>';

$pdf->writeHTML($html);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(9.5);

$html = '<table border="1" >
   
            <tr>
                <td style="text-align: center;font-weight: bold; width: 0.90cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">No.</td>

                <td style="text-align: center; font-weight: bold; width: 6cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">LEARNERS NAMES</td>

                <td style="text-align: center;font-weight: bold ;width: 9cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">WRITTEN WORKS (30%)</td>

                <td style="text-align: center;  font-weight: bold;width: 9cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">PERFORMANCE TASKS (50%)</td>

                <td style="text-align: center;font-weight: bold;width: 4cm; font-family: times, sans-serif; font-size: 9px;">QUARTERLY ASSESSMENT (20%) </td>

                <td rowspan="3"style="text-align: center;  font-weight: bold;width: 2.22cm;vertical-align: middle; line-height: 1.70cm; font-family: Calibri, sans-serif; font-size: 9px;">Initial Grade</td>

                <td rowspan="3" style="text-align: center; font-weight: bold; width: 2.50cm; vertical-align: middle; line-height: 1.70cm; font-family: Calibri, sans-serif; font-size: 9px;">Quarterly Grade</td>   
            </tr>

            <tr>
                <td align="center"><b></b></td>
                <td align="left"><b></b></td>
                <td align="center" width="0.85cm"><b>1</b></td>
                <td align="center" width="0.85cm"><b>2</b></td>
                <td align="center" width="0.85cm"><b>3</b></td>
                <td align="center" width="0.85cm"><b>4</b></td>
                <td align="center" width="0.85cm"><b>5</b></td>
                <td align="center" width="1.55cm"><b>Total</b></td>
                <td align="center" width="1.60cm"><b>PS</b></td>
                <td align="center" width="1.60cm"><b>WS</b></td>
                <td align="center" width="0.85cm"><b>1</b></td>
                <td align="center" width="0.85cm"><b>2</b></td>
                <td align="center" width="0.85cm"><b>3</b></td>
                <td align="center" width="0.85cm"><b>4</b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="1.55cm"><b>Total</b></td>
                <td align="center" width="1.60cm"><b>PS</b></td>
                <td align="center" width="1.60cm"><b>WS</b></td>
                <td align="center" width="0.80cm"><b></b></td>
                <td align="center" width="1.60cm"><b>PS</b></td>
                <td align="center" width="1.60cm"><b>WS</b></td>  
            </tr>

            <tr>
                <td align="center"><b></b></td>
                <td align="right"><b>Number of item</b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="1.55cm"><b></b></td>
                <td align="center" width="1.60cm"><b></b></td>
                <td align="center" width="1.60cm"><b></b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="1.55cm"><b></b></td>
                <td align="center" width="1.60cm"><b></b></td>
                <td align="center" width="1.60cm"><b></b></td>
                <td align="center" width="0.80cm"><b></b></td>
                <td align="center" width="1.60cm"><b></b></td>
                <td align="center" width="1.60cm"><b></b></td>  
            </tr>

            <tr style="background-color: #bfbfbf;">
                <td align="center"></td>
                <td align="left"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="0.80cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="2.22cm"></td>
                <td align="center"width="2.50cm"></td>
            </tr>
        </table>';

$pdf->writeHTML($html);

}

$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->setx(40);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(0, 6, $subject_teacher, 0, 0, 'L'); 
$pdf->setx(140);
$pdf->Cell(0, 6, $chairperson, 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 6, $principal, 0, 1, 'L');

$pdf->setx(40);
$pdf->SetFont('times', '', 9);
$pdf->Cell(0, 0, 'Subject Teacher', 0, 0, 'L'); 
$pdf->setx(140);
$pdf->Cell(0, 0, 'Chairperson, High School', 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 0, 'Principal', 0, 0, 'L');
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->setx(40);
$pdf->SetFont('times', '', 9);
$pdf->Cell(0, 0, date('m/d/Y'), 0, 0, 'L'); 
$pdf->setx(140);
$pdf->Cell(0, 0, date('m/d/Y'), 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 0, date('m/d/Y'), 0, 0, 'L');

$filename = "Quarterly_Report_of_Grades_" . date("Y-m-d") . ".pdf";

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

 <!-- JavaScript for handling button actions -->a
<script>
    document.getElementById('savePDF').addEventListener('click', savePDF);
    document.getElementById('printPDF').addEventListener('click', printPDF);

    function savePDF() {
    var pdfData = "<?php echo base64_encode($pdfData); ?>";
    var link = document.createElement("a");
    var currentDate = new Date();
    var dateString = (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + '-' + currentDate.getFullYear();
    link.href = "data:application/pdf;base64," + pdfData;
    link.download = "Quarterly_Report_of_Grades_" + dateString + ".pdf";
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