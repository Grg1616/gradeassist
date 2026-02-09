<div class="row align-items-top">
    <!-- Start of Card Section -->
    <div class="col-lg-12 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">List of Learners Subject for Probation</h6>
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
 
    </div>
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
        $academic_year = "Academic Year"; // Set default value if no rows found
    }
} else {
 $academic_year = "Academic Year";
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
$class  = isset($class ) ? $class  : 'Grade Level - Section';
$academic_year  = isset($academic_year ) ? $academic_year  : 'Academic Year';
$adviser2 = isset($adviser2) ? $adviser2 : '';
$chairperson = isset($chairperson) ? $chairperson : '';
$principal = isset($principal) ? $principal : '';
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class  ListofLearnersSubjectforProbation extends TCPDF
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
$pdf = new  ListofLearnersSubjectforProbation('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('List of Learners Subject for Probation');
$pdf->AddPage();
$pdf->setY(44);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL', 0, 1, 'C');  
$pdf->Cell(0, 3, 'LIST OF LEARNERS SUBJECT FOR PROBATION', 0, 1, 'C');
$pdf->Cell(0, 3, $class . ' | ' . $academic_year, 0, 1, 'C');

$pdf->setY(66);


$pdf->SetLeftMargin(36);
$pdf->SetRightMargin(33);
// Add HTML table
$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.09cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">No.
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6.6cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Name of Learners
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6.99cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Subject/s with Grade &lt; 80
                    </td>
                </tr>

                 <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.09cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6.6cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 2.54cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Subject
                    </td>

                     <td style="text-align: center; font-weight: bold; width: 4.45cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Grade
                    </td>
                </tr>';

$school_year = isset($_POST['school_year']) ? mysqli_real_escape_string($conn, $_POST['school_year']) : '';
$class_id = isset($_POST['class_id']) ? mysqli_real_escape_string($conn, $_POST['class_id']) : '';

$prev_student_name = ''; // Initialize previous student name

if (!empty($school_year) && !empty($class_id)) {
    // Execute the SQL query
    $query = "SELECT sg.*, l.*, s.lastName, s.firstName, s.middleName, sj.courseTitle
              FROM subject_grades sg
              JOIN loads l ON sg.load_id = l.id
              JOIN students s ON sg.student_id = s.id
              JOIN subjects sj ON l.subject_id = sj.id
              WHERE l.school_year_id = '$school_year' AND l.class_id = '$class_id'";

    $result = $conn->query($query);

    // Check for errors
    if (!$result) {
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            $counter = 1; // Initialize counter for numbering rows
            while ($row = $result->fetch_assoc()) {
                // Fetch individual name components
                $lastName = htmlspecialchars($row['lastName']);
                $firstName = htmlspecialchars($row['firstName']);
                $middleInitial = htmlspecialchars(substr($row['middleName'], 0, 1));

                // Concatenate student name
                $student_name = $lastName . ', ' . $firstName . ' ' . $middleInitial . '.';

                // Check if all quarterly grades are present
                if (isset($row['q1_grade']) && $row['q1_grade'] !== '' &&
                    isset($row['q2_grade']) && $row['q2_grade'] !== '' &&
                    isset($row['q3_grade']) && $row['q3_grade'] !== '' &&
                    isset($row['q4_grade']) && $row['q4_grade'] !== '') {

                    // Calculate final grade
                    $finalGrade = round(($row['q1_grade'] + $row['q2_grade'] + $row['q3_grade'] + $row['q4_grade']) / 4);
                } else {
                    $finalGrade = null; // Set final grade as null if any quarterly grade is missing
                }

                // Check if final grade is less than 80
                if ($finalGrade !== null && $finalGrade < 80) {
                    if ($prev_student_name != $firstName . ' ' . $lastName) {
                        $html .= '<tr>';
                        $html .= '<td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">' . $counter++ . '</td>';
                        $html .= '<td style="font-weight: normal; font-size: 10px; font-family: Tahoma, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;">' . $student_name . '</span></td>';
                        $html .= '<td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">' . htmlspecialchars($row['courseTitle']) . '</td>';
                        $html .= '<td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">' . $finalGrade . '</td>';
                        $html .= '</tr>';
                    } else {
                        $html .= '<tr>';
                        $html .= '<td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center"></td>';
                        $html .= '<td></td>';
                        $html .= '<td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">' . htmlspecialchars($row['courseTitle']) . '</td>';
                        $html .= '<td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">' . $finalGrade . '</td>';
                        $html .= '</tr>';
                    }

                    $prev_student_name = $firstName . ' ' . $lastName;
                }
            }
        } else {
            // If no data is available, display a message in a single row
            // $html .= '<tr><td colspan="4" align="center">No data available</td></tr>';
        }
    }
} else {
    // Handle cases where school_year or class_id is empty
    // $html .= '<tr><td colspan="4" align="center">Please select a school year and a class</td></tr>';
}


$html .= '</table>';

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
$pdf->Cell(0, 28, $adviser2, 0, 0, 'L');
$pdf->setx(87);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 28, $chairperson, 0, 0, 'L');
$pdf->setx(144);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 28, $principal, 0, 0, 'L');


$pdf->setx(16);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 36, 'Adviser ', 0, 0, 'L');
$pdf->setx(87);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 36, 'Chairperson, ' . $department, 0, 0, 'L');
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

$filename = "Quarterly_List_of_Learners_With_Academic_Excellence_" . date("Y-m-d") . ".pdf";

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
    link.download = "Quarterly_List_of_Learners_With_Academic_Excellence_" + dateString + ".pdf";
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