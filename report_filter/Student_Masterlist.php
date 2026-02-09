<div class="row align-items-top">
    <!-- Start of Card Section -->
    <div class="col-lg-12 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Student Masterlist</h6>
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
                                            <option selected value="">Select Semester</option>
                                            <option value="1" <?php if(isset($_POST['semester']) && $_POST['semester'] == '1') echo 'selected'; ?>>First Semester</option>
                                            <option value="2" <?php if(isset($_POST['semester']) && $_POST['semester'] == '2') echo 'selected'; ?>>Second Semester</option>
                                        </select>
                                        <label for="semester">Semester</label>
                                    </div>
                                </div>
                                <!-- Class Select -->
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select id="class_id" name="class_id" class="form-select" aria-label="Select Class">
                                            <option selected value="">Select Class</option>
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

    document.getElementById('semester').addEventListener('change', function() {
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

class LaboratorySchoolStudentMasterlist extends TCPDF
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
$pdf = new LaboratorySchoolStudentMasterlist('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Student Masterlist');
$pdf->AddPage();
$pdf->setY(50);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL STUDENT MASTERLIST', 0, 1, 'C'); 
$pdf->SetFont('times', '', 10);

$pdf->setY(75);
$pdf->SetLeftMargin(12);
$pdf->SetRightMargin(12);
// Add HTML table
$html = '<table border="1" style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: center; font-weight: bold; width: 0.94cm;">No.</th>
                    <th style="text-align: center; font-weight: bold; width: 1.97cm;">SR-Code</th>
                    <th style="text-align: center; font-weight: bold; width: 5.0cm;">Name of Student</th>
                    <th style="text-align: center; font-weight: bold; width: 1.9cm;">Birthday</th>
                    <th style="text-align: center; font-weight: bold; width: 1.72cm;">Gender</th>
                    <th style="text-align: center; font-weight: bold; width: 2.4cm;">Contact No.</th>
                    <th style="text-align: center; font-weight: bold; width: 2.2cm;">Department.</th>
                    <th style="text-align: center; font-weight: bold; width: 3.2cm;">Level & Section</th>
                </tr>
            </thead>
            <tbody>'; // Start table body

// Assuming $conn is defined and contains the database connection object
$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$semester = isset($_POST['semester']) ? $_POST['semester'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';

if (!empty($school_year)) {

    // Sanitize input to prevent SQL injection
    $school_year = mysqli_real_escape_string($conn, $school_year);
    $class_id = mysqli_real_escape_string($conn, $class_id);

    // Construct the basic query
    $query2 = "SELECT DISTINCT class_students.*, students.*
           FROM class_students
           LEFT JOIN students ON class_students.student_id = students.id
           LEFT JOIN loads ON class_students.class_id = loads.class_id
           WHERE class_students.school_year_id = '$school_year'";



    // Add conditions for filtering by class_id and semester if they are provided
    if (!empty($class_id)) {
        $query2 .= " AND loads.class_id = '$class_id'";
    }
    if (!empty($semester)) {
        $query2 .= " AND (loads.semester = '$semester' OR loads.semester = 0)";
    }

    // Add ORDER BY clause
    $query2 .= " ORDER BY students.lastName";

    $result2 = $conn->query($query2);

    if ($result2->num_rows > 0) {
        $no = 1; // Initialize $no variable inside the condition
        // Loop through each row of data
        while ($row1 = $result2->fetch_assoc()) {
            $class_id2 = $row1['class_id'];

            $queryClass = "SELECT * FROM class WHERE id = '$class_id2' AND school_year_id = '$school_year'";
            $resultClass = $conn->query($queryClass);
            if ($resultClass->num_rows > 0) { // Corrected the result variable to $resultClass

                while ($row2 = $resultClass->fetch_assoc()) {
                   $gradeLevel = $row2['gradeLevel'];
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

                $section = $row2['section'];$section = $row2['section'];$section = $row2['section'];
                // Add a table row for each record
                $html .= '<tr>';
                $html .= '<td align="center" style="width: 0.94cm;">' . $no . '</td>';
                $html .= '<td align="center" style="width: 1.97cm;">' . ($row1['sr_code'] ?? '') . '</td>';
                $html .= '<td align="left" style="width: 5.0cm;">' . ($row1['lastName'] ?? '') . ', ' . ($row1['firstName'] ?? '') . (isset($row1['middleName']) ? ' ' . substr($row1['middleName'], 0, 1) . '.' : '') . '</td>';
                $html .= '<td align="center" style="width: 1.9cm;">' . date('d/m/Y', strtotime($row1['birthday'] ?? '')) . '</td>';
                $html .= '<td align="center" style="width: 1.72cm;">' . ($row1['gender'] ?? '') . '</td>';
                $html .= '<td align="center" style="width: 2.4cm;">' . ($row1['contactNumber'] ?? '') . '</td>';
                $html .= '<td align="center" style="width: 2.2cm;">' . ($department ?? '') . '</td>';
                $html .= '<td align="center" style="width: 3.2cm;">' . ($row2['gradeLevel'] . ' ' . ($row2['section'] ?? '')) . '</td>'; // Corrected concatenation
                $html .= '</tr>';
                $no++; 
                }
            } else {
                // If no data is available, display a message in a single row
                $html .= '<tr><td colspan="8" align="center">No data available</td></tr>';
            }
        }
    } else {
        // If no data is available, display a message in a single row
        $html .= '<tr><td colspan="8" align="center">No data available</td></tr>';
    }
} else {
    // If any of the parameters is empty, display a message in a single row
    $html .= '<tr><td colspan="8" align="center">Please provide school year</td></tr>';
}




$html .= '</tbody></table>';

$pdf->writeHTML($html);

$filename = "Student_Masterlist_" . date("Y-m-d") . ".pdf";

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
    link.download = "Student_Masterlist_" + dateString + ".pdf";
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