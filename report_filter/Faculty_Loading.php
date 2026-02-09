<div class="row align-items-top">
    <!-- Start of Card Section -->
    <div class="col-lg-12 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Faculty Loading</h6>
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
                                        <select class="form-select" id="semester" name="semester" aria-label="Filter Department">
                                            <option disabled selected>Select Semester</option>
                                            <option value="1" <?php if(isset($_POST['semester']) && $_POST['semester'] == '1') echo 'selected'; ?>>First Semester</option>
                                            <option value="2" <?php if(isset($_POST['semester']) && $_POST['semester'] == '2') echo 'selected'; ?>>Second Semester</option>
                                        </select>
                                        <label for="semester">Semester</label>
                                    </div>
                                </div>
                                <!-- Class Select -->
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="department" name="department" aria-label="Department" required>
                                            <option selected value>Select Department</option>
                                            <option value="Elementary" <?php if(isset($_POST['department']) && $_POST['department'] == 'Elementary') echo 'selected'; ?>>Elementary</option>
                                            <option value="High School" <?php if(isset($_POST['department']) && $_POST['department'] == 'High School') echo 'selected'; ?>>High School</option>
                                            <option value="Senior High School" <?php if(isset($_POST['department']) && $_POST['department'] == 'Senior High School') echo 'selected'; ?>>Senior High School</option>
                                        </select>
                                        <label for="department">Department</label>
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

    document.getElementById('department').addEventListener('change', function() {
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
            $adviser = (empty($row['st_rank'])) ? (($row['gender'] == 'Female') ? "Ms." : (($row['gender'] == 'Male') ? "Mr." : "")) : $row['st_rank'] . " " . $row['firstName'] . " " . $row['st_middleName'] . " " . $row['st_lastName'];

         }
    } else {
        // Handle query execution error
        echo "Error executing query: " . $conn->error;
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
        $academic_year = "A.Y. $start_year - $end_year";
    } else {
        $academic_year = "A.Y."; // Set default value if no rows found
    }
} else {
 $academic_year = "A.Y.";
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
?>


<?php

$academic_year = isset($academic_year) ? $academic_year : '';
$semesterName = isset($semesterName) ? $semesterName : '';

ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class LaboratorySchoolFacultyLoading extends TCPDF
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
$pdf = new  LaboratorySchoolFacultyLoading('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Faculty Loading');
$pdf->AddPage();
$pdf->setY(50);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL FACULTY LOADING', 0, 1, 'C');  
$pdf->SetFont('times', '', 10);
$pdf->writeHTML($semesterName . ', ' . $academic_year, true, false, true, false, 'C');
$pdf->setY(70);


$pdf->SetLeftMargin(17);
$pdf->SetRightMargin(16);
// Add HTML table
$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: center; font-weight: bold; width: 6.19cm; font-family: times, sans-serif; font-size: 10px;">Name of Faculty
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 4.29cm; font-family: times, sans-serif; font-size: 10px;">Subject
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 4.29cm; font-family: times, sans-serif; font-size: 10px;">Class
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.91cm; font-family: times, sans-serif; font-size: 10px;">No. of Students
                    </th>
                    <th style="text-align: center; font-weight: bold; width: 1.59cm; font-family: times, sans-serif; font-size: 10px;">No. of Hours
                    </th>
                </tr>
            </thead>
            <tbody>'; // Start table body

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$semester = isset($_POST['semester']) ? $_POST['semester'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';
$prev_faculty_name = ''; // Variable to store the previous faculty name

if (!empty($school_year) && !empty($semester) && !empty($department)) {
    // Sanitize input to prevent SQL injection
    $school_year = mysqli_real_escape_string($conn, $school_year);
    $department = mysqli_real_escape_string($conn, $department);
    $semester = mysqli_real_escape_string($conn, $semester);

    // Construct the SQL query
$query2 = "SELECT loads.*, 
         subjects.courseCode, subjects.courseTitle,
           faculty.rank, faculty.gender, faculty.firstName,
           faculty.middleName, faculty.lastName, faculty.department,
           class.gradeLevel, class.section,
           (SELECT COUNT(*) FROM class_students WHERE class_students.class_id = class.id) AS class_students_count
        FROM loads
        LEFT JOIN subjects ON loads.subject_id = subjects.id
        LEFT JOIN faculty ON loads.faculty_id = faculty.id
        LEFT JOIN class ON loads.class_id = class.id
        WHERE faculty.department = '$department' 
            AND loads.school_year_id = '$school_year' 
            AND (loads.semester = '$semester' OR loads.semester IS NULL OR loads.semester = 0) 
        GROUP BY subjects.courseCode, subjects.courseTitle, faculty.lastName
        ORDER BY faculty.lastName, subjects.courseCode, subjects.courseTitle";

    // Execute the query
    $result2 = $conn->query($query2);

    // Check if the query executed successfully
    if ($result2) {
        if ($result2->num_rows > 0) {
            // Loop through each row of data
            while ($row1 = $result2->fetch_assoc()) {
                // Check if the faculty name has changed
                if ($prev_faculty_name != ($row1['firstName'] . ' ' . $row1['lastName'])) {
                        // If it has changed, display the faculty name
                        $html .= '<tr>';
                        $html .= '<td align="left" style="width: 6.19cm;">&nbsp;' . 
                            (empty($row1['rank']) ? 
                                (($row1['gender'] == 'Female') ? "Ms." : (($row1['gender'] == 'Male') ? "Mr." : "")) : 
                                $row1['rank'] . " " . 
                                ($row1['firstName'] ?? '') . " " . 
                                (!empty($row1['middleName']) ? $row1['middleName'][0] . ". " : '') .  // Adding "A." if middle name exists
                                ($row1['lastName'] ?? '')) . 
                            '</td>';
                        // Check if courseCode is empty, if so, display courseTitle instead
                        $course_display = empty($row1['courseCode']) ? $row1['courseTitle'] : $row1['courseCode'];
                        $html .= '<td align="left" style="width: 4.29cm;">&nbsp;' . $course_display . '</td>';
                        $html .= '<td align="left" style="width: 4.29cm;">&nbsp;' . ($row1['gradeLevel'] ?? '') . ' ' . ($row1['section'] ?? '') . '</td>';
                        $html .= '<td align="center" style="width: 1.91cm;">' . ($row1['class_students_count'] ?? '') . '</td>';
                        $html .= '<td align="center" style="width: 1.59cm;">' . ($row1['hours_per_week'] ?? '') . '</td>';
                        $html .= '</tr>';
                    } else {
                        // If it hasn't changed, display empty cells for the faculty name
                        $html .= '<tr>';
                        $html .= '<td></td>'; // Empty cell
                        // Check if courseCode is empty, if so, display courseTitle instead
                        $course_display = empty($row1['courseCode']) ? $row1['courseTitle'] : $row1['courseCode'];
                        $html .= '<td align="left" style="width: 4.29cm;">&nbsp;' . $course_display . '</td>';
                        $html .= '<td align="left" style="width: 4.29cm;">&nbsp;' . ($row1['gradeLevel'] ?? '') . ' ' . ($row1['section'] ?? '') . '</td>';
                        $html .= '<td align="center" style="width: 1.91cm;">' . ($row1['class_students_count'] ?? '') . '</td>';
                        $html .= '<td align="center" style="width: 1.59cm;">' . ($row1['hours_per_week'] ?? '') . '</td>';
                        $html .= '</tr>';
                    }

                // Update the previous faculty name
                $prev_faculty_name = $row1['firstName'] . ' ' . $row1['lastName'];
            }
        } else {
            // If no data is available, display a message in a single row
            $html .= '<tr><td colspan="5" align="center">No data available</td></tr>';
        }
    } else {
        // Handle query execution error
        echo "Error executing query: " . $conn->error;
    }
}

$html .= '</tbody></table>';



$pdf->writeHTML($html);
$pdf->setY(-30);
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, 'Date Printed: 01/07/2023', 0, 1, 'legal');

$filename = "Faculty_Loading_" . date("Y-m-d") . ".pdf";

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
    link.download = "Faculty_Loading_" + dateString + ".pdf";
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