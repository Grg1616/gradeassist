<div class="row align-items-top">
    <!-- Start of Card Section -->
    <div class="col-lg-12 col-sm-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-0">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <h6 class="m-0 font-weight-bold text-dark">Class List</h6>
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
                                        <select class="form-select" id="department" name="department" aria-label="Department" required>
                                            <option selected value>Select Department</option>
                                            <option value="Elementary" <?php if(isset($_POST['department']) && $_POST['department'] == 'Elementary') echo 'selected'; ?>>Elementary</option>
                                            <option value="High School" <?php if(isset($_POST['department']) && $_POST['department'] == 'High School') echo 'selected'; ?>>High School</option>
                                            <option value="Senior High School" <?php if(isset($_POST['department']) && $_POST['department'] == 'Senior High School') echo 'selected'; ?>>Senior High School</option>
                                        </select>
                                        <label for="department">Department</label>
                                    </div>
                                </div>

                                <!-- Class Select -->
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

ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class ListofallFaculty extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
   }

   public function Header()
   {
       $this->SetMargins(15, 50, 15); // Left, Top, Right
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
$pdf = new ListofallFaculty('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('List of Faculty');
$pdf->AddPage();
$pdf->setY(50);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LIST OF LABORATORY SCHOOL FACULTY', 0, 1, 'C');  
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, $academic_year, 0, 1, 'C'); 

$pdf->setY(70);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
// Add HTML table
$html = '<table border="1">
            <thead>
                <tr>
                    <th style="text-align: center; font-weight: bold; width: 0.9cm; font-family: times, sans-serif; font-size: 10px;">No.</th>
                    <th style="text-align: center; font-weight: bold; width: 4.50cm; font-family: times, sans-serif; font-size: 10px;">Name of Faculty</th>
                    <th style="text-align: center; font-weight: bold; width: 2.72cm; font-family: times, sans-serif; font-size: 10px;">Rank</th>
                    <th style="text-align: center; font-weight: bold; width: 2.4cm; font-family: times, sans-serif; font-size: 10px;">Gender</th>
                    <th style="text-align: center; font-weight: bold; width: 3.7cm; font-family: times, sans-serif; font-size: 10px;">Status</th>
                    <th style="text-align: center; font-weight: bold; width: 3.55cm; font-family: times, sans-serif; font-size: 10px;">Department</th>
                </tr>
            </thead>
            <tbody>'; // Start table body

// Assuming $conn is defined and contains the database connection object

$department = isset($_POST['department']) ? $_POST['department'] : '';

if (!empty($department)) {
    // Sanitize input to prevent SQL injection
    $department = mysqli_real_escape_string($conn, $department);

    // Execute the SQL query
    $query2 = "SELECT * FROM faculty WHERE department = '$department' ORDER BY lastName";

    $result2 = $conn->query($query2);

    if ($result2->num_rows > 0) {
        $count = 1; // Initialize the count
        // Loop through each row of data
        while ($row1 = $result2->fetch_assoc()) {
            // Add a table row for each record
            $html .= '<tr>';
            $html .= '<td align="center" style="width: 0.9cm;">' . $count . '</td>';
            $html .= '<td align="left" style="width: 4.50cm;">&nbsp;' . ($row1['lastName'] ?? '') . ', ' . ($row1['firstName'] ?? '') . (isset($row1['middleName']) ? ' ' . substr($row1['middleName'], 0, 1) . '.' : '') . '</td>';
            $html .= '<td align="left" style="width: 2.72cm;">&nbsp;' . ($row1['rank'] ?? '') . '</td>';
            $html .= '<td align="left" style="width: 2.4cm;">&nbsp;' . ($row1['gender'] ?? '') . '</td>';
            $html .= '<td align="left" style="width: 3.7cm;">&nbsp;' . ($row1['status'] ?? '') . '</td>';
            $html .= '<td align="left" style="width: 3.55cm;">&nbsp;' . ($row1['department'] ?? '') . '</td>';
            $html .= '</tr>';
            $count++; // Increment the count
        }
    } else {
        // If no data is available, display a message in a single row
        $html .= '<tr><td colspan="6" align="center">No data available</td></tr>';
    }
} else {
    // If the department parameter is empty, retrieve all faculty members
    $queryAll = "SELECT * FROM faculty ORDER BY lastName";
    $resultAll = $conn->query($queryAll);

    if ($resultAll->num_rows > 0) {
        $count = 1; // Initialize the count
        // Loop through each row of data
        while ($row1 = $resultAll->fetch_assoc()) {
            // Add a table row for each record
            $html .= '<tr>';
            $html .= '<td align="center" style="width: 0.9cm;">' . $count . '</td>';
            $html .= '<td align="left" style="width: 4.50cm;">&nbsp;' . ($row1['lastName'] ?? '') . ', ' . ($row1['firstName'] ?? '') . (isset($row1['middleName']) ? ' ' . substr($row1['middleName'], 0, 1) . '.' : '') . '</td>';
            $html .= '<td align="left" style="width: 2.72cm;">&nbsp;' . ($row1['rank'] ?? '') . '</td>';
            $html .= '<td align="left" style="width: 2.4cm;">&nbsp;' . ($row1['gender'] ?? '') . '</td>';
            $html .= '<td align="left" style="width: 3.7cm;">&nbsp;' . ($row1['status'] ?? '') . '</td>';
            $html .= '<td align="left" style="width: 3.55cm;">&nbsp;' . ($row1['department'] ?? '') . '</td>';
            $html .= '</tr>';
            $count++; // Increment the count
        }
    } else {
        // If no data is available, display a message in a single row
        $html .= '<tr><td colspan="6" align="center">No data available</td></tr>';
    }
}

$html .= '</tbody></table>'; // End of table body





$pdf->writeHTML($html);
$pdf->setY(-30);
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, 'Date Printed: 01/07/2023', 0, 1, 'L');

$filename = "List_of_Faculty_" . date("Y-m-d") . ".pdf";

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
    link.download = "List_of_Faculty_" + dateString + ".pdf";
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