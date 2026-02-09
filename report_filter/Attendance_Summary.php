<div class="row align-items-top">
    <!-- Start of Card Section -->
    <div class="col-lg-12 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Attendance Summary</h6>
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



?>

<?php
$academic_year = isset($academic_year) ? $academic_year : '';
$class = isset($class) ? $class : '';
$adviser = isset($adviser) ? $adviser : '';
$adviser2 = isset($adviser2) ? $adviser2 : '';
$class_students_count = isset($class_students_count) ? $class_students_count : '';
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class AttendanceSummary extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
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
$pdf = new  AttendanceSummary('L', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Attendance Summary');
$pdf->AddPage();
$pdf->setY(44);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL', 0, 1, 'C');  
$pdf->Cell(0, 3, 'ATTENDANCE SUMMARY', 0, 1, 'C');

$pdf->setY(60);


$pdf->SetLeftMargin(35);
$pdf->SetRightMargin(26.5);
// Add HTML table
$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>
            
                <tr>
                    <td style="text-align: right; font-weight: normal; width: 3.18cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Level/Section:
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 14.45cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">'. $class .'
                    </td>

                    <td style="text-align: right; font-weight: normal; width: 8.57cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Academic Year:
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 3.20cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">'. $academic_year .'
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: normal; width: 3.18cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Adviser:
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 14.45cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">'. $adviser .'
                    </td>

                    <td style="text-align: right; font-weight: normal; width: 8.57cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Total Number of School Days:
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 3.20cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">'. $class_students_count .'
                    </td>
                </tr>

        </table>';

$pdf->writeHTML($html);

$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>
            
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.1cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">No.
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Name of Learners
                    </td>';

// Add initialization of $school_year if it's not set
$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';

if (!empty($school_year)) {
    $query_class_start_month = "SELECT class_start FROM academic_calendar WHERE id = $school_year";
    $query_run_class_start_month = mysqli_query($conn, $query_class_start_month);
    $row_class_start_month = mysqli_fetch_assoc($query_run_class_start_month);
    $class_start_month = date("F", strtotime($row_class_start_month['class_start']));

    $months = array($class_start_month);
    for ($i = 1; $i < 12; $i++) {
        $months[] = date("F", strtotime("$class_start_month + $i month"));
    }

    $orderClause = "FIELD(monthName, '" . implode("', '", $months) . "')";

    $query = "SELECT m.monthName, m.daysInMonth, m.id as month_id
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = $school_year
              ORDER BY $orderClause";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            // Modify the month name format to show the short form (e.g., Jan)
            $shortMonthName = date("M", strtotime($row1["monthName"]));
            $month_id = $row1["month_id"];
            $html .= "<th style=\"text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;\">$shortMonthName</th>";
        }
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= "<th style=\"text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;\"></th>";
    }
}


$html .= '<th style="text-align: center; font-weight: bold; width: 2.40cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.69cm;">Total No. of Days Absent</th>
          <th style="text-align: center; font-weight: bold; width: 2.66cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.69cm;">Total No. of Days Present</th>
        </tr>
         </thead>
        <tbody>
     <tr>
        <td style="text-align: center; width: 1.1cm; font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;"></td>
        <td style="text-align: right; width: 6.52cm; font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;">No. of School Days</td>';

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';

if (!empty($school_year)) {
    $query = "SELECT m.id, m.daysInMonth
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = '$school_year'
              ORDER BY $orderClause";

    $query_run = mysqli_query($conn, $query);

    $totalSchoolDays = 0;

    if ($query_run) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            $html .= '<td style="width: 1.52cm; text-align: center; font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;">' . $row1["daysInMonth"] . '</td>';
            $totalSchoolDays += $row1["daysInMonth"];
        }
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<th style="width: 1.52cm; text-align: center; font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;"></th>';
    }
}


$html .= '<td style="width: 2.40cm; font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;"></td>
        <td style="width: 2.66cm; font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;"></td>
    </tr>';

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';

if (!empty($school_year) && !empty($class_id)) {
$no = 1;
// Execute the query to fetch students
$query_students = "SELECT s.sr_code, s.firstName, s.lastName, s.middleName, s.id as student_id
                    FROM students s 
                    JOIN class_students cs ON s.id = cs.student_id 
                    WHERE cs.class_id = '$class_id' AND cs.school_year_id = '$school_year'
                    ORDER BY s.lastName";
$query_run_students = mysqli_query($conn, $query_students);

if ($query_run_students) {
    while ($row_student = mysqli_fetch_assoc($query_run_students)) {
        $student_id = $row_student['student_id'];

        $html .= '<tr><td style="width: 1.1cm;">' . $no . '</td>
            <td style="width: 6.52cm; font-weight: normal;">' . ucwords(strtolower($row_student['lastName'])) . ', ' . ucwords(strtolower($row_student['firstName'])) . (!empty($row_student['middleName']) ? ' ' . ucwords(substr($row_student['middleName'], 0, 1)) . '.' : '') . '</td>';

        // Fetch daysPresent for each month and order them according to the academic calendar
        $query_run_months = mysqli_query($conn, $query); // Reusing $query to fetch months

        if ($query_run_months) {
            $totalDaysPresent = 0; // Initialize totalDaysPresent variable
            while ($row_month = mysqli_fetch_assoc($query_run_months)) {
                $month_id = $row_month['id'];
                $daysInMonth = $row_month['daysInMonth'];
                $attendance_query = "SELECT a.daysPresent, m.id as m_id
                                     FROM attendance a
                                     RIGHT JOIN months m ON a.month_id = m.id
                                     WHERE a.student_id = '$student_id' AND a.class_id = '$class_id' AND a.school_year_id = '$school_year' AND m.id = '$month_id'";

                $attendance_result = mysqli_query($conn, $attendance_query);
                $attendance_row = mysqli_fetch_assoc($attendance_result);
                $daysPresent = isset($attendance_row['daysPresent']) ? $attendance_row['daysPresent'] : $daysInMonth;
                $totalDaysPresent += $daysPresent; // Accumulate daysPresent to calculate totalDaysPresent

                // Display the value of daysPresent
                $html .= '<td style="width: 1.52cm; text-align: center; font-weight: normal;">' . $daysPresent . '</td>';
            }
        } else {
            $html .= "<td colspan='11'>No data available</td>";
        }
        $html .= '<td style="width: 2.40cm; text-align: center; font-weight: normal;">' . ($totalSchoolDays - $totalDaysPresent) . '</td>
                  <td style="width: 2.66cm; text-align: center; font-weight: bold;">' . $totalDaysPresent . '</td></tr>';

        $no++;
    }
} else {
    $html .= "<td colspan='11'>Error: " . mysqli_error($conn) . "</td>";
}
}

$html .= '</tbody></table>';

// Assuming $pdf is the PDF object
$pdf->writeHTML($html);

$html = '<table>
            <thead>

                <tr>
                    <td style="height: 10px;">&nbsp;</td> <!-- Empty row for spacing -->
                </tr>

            </table>';

$pdf->writeHTML($html);


$pdf->setx(48.5);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, $adviser2, 0, 0, 'L');
$pdf->setx(149);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, $chairperson, 0, 0, 'L');
$pdf->setx(250);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, $principal, 0, 0, 'L');


$pdf->setx(48.5);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 12, 'Adviser ', 0, 0, 'L');
$pdf->setx(149);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 12, 'Chairperson, High School ', 0, 0, 'L');
$pdf->setx(250);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 12, 'Principal ', 0, 0, 'L');


$pdf->setx(48.5);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, 'Date: ', 0, 0, 'L');
$pdf->setx(57.5);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, date('m/d/Y'), 0, 0, 'L'); // Set today's date

$pdf->setx(149);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, 'Date: ', 0, 0, 'L');
$pdf->setx(158);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, date('m/d/Y'), 0, 0, 'L'); // Set today's date

$pdf->setx(250);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, 'Date: ', 0, 0, 'L');
$pdf->setx(259);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, date('m/d/Y'), 0, 0, 'L'); // Set today's date

$pdf->setY(-30);
$pdf->SetFont('times', '', 10);

$filename = "Attendance_Summary_" . date("Y-m-d") . ".pdf";

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
    link.download = "Attendance_Summary_" + dateString + ".pdf";
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