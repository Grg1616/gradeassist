<?php
session_start();
// Ensure the user is logged in and is a faculty member (or other allowed types)
if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || !isset($_SESSION['userType']) || !in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
    die('Unauthorized access.');
}

require '../db_conn.php';
require '../assets/vendor/tcpdf/tcpdf.php';

// Get class_id from URL
if (!isset($_GET['class_id']) || empty($_GET['class_id'])) {
    die('No class specified.');
}
$class_id = intval($_GET['class_id']);

// Verify that this class belongs to the logged-in faculty
$user_id = $_SESSION['user_id'];
$check_query = "SELECT id FROM class WHERE id = $class_id AND faculty_id = $user_id";
$check_result = mysqli_query($conn, $check_query);
if (mysqli_num_rows($check_result) == 0) {
    die('You do not have permission to view this class.');
}

// Fetch class details
$class_query = "SELECT 
                    class.gradeLevel, 
                    class.section, 
                    sy.class_start, 
                    sy.class_end
                FROM class
                JOIN academic_calendar sy ON class.school_year_id = sy.id
                WHERE class.id = $class_id";
$class_result = mysqli_query($conn, $class_query);
$class = mysqli_fetch_assoc($class_result);

// Fetch all students in this class (we will separate by gender later)
$students_query = "SELECT 
                    students.sr_code,
                    students.lrn,
                    students.firstName,
                    students.middleName,
                    students.lastName,
                    students.email,
                    students.contactNumber,
                    students.gender
                  FROM class_students
                  JOIN students ON class_students.student_id = students.id
                  WHERE class_students.class_id = $class_id
                  ORDER BY students.lastName, students.firstName";
$students_result = mysqli_query($conn, $students_query);

// Format school year
$school_year = '';
if (!empty($class['class_start']) && !empty($class['class_end'])) {
    $start_year = date('Y', strtotime($class['class_start']));
    $end_year = date('Y', strtotime($class['class_end']));
    $school_year = $start_year . '-' . $end_year;
}
$class_name = 'Grade ' . $class['gradeLevel'] . ' - ' . $class['section'];

// ---------------------------
// TCPDF Setup (unchanged)
// ---------------------------
class StudentListPDF extends TCPDF
{
    public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
    {
        $format = 'LEGAL';
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
    }

    public function Header()
    {
        // University logo
        $this->Image('../assets/img/bsulogo.jpg', 20, 5.5, 35);
        // Header text
        $this->SetFont('times', 'B', 12);
        $this->SetY(10);
        $this->Cell(0, 1.0, 'Republic of the Philippines', 0, 1, 'C');
        $this->SetFont('times', 'B', 16);
        $this->Cell(0, 1.0, 'BATANGAS STATE UNIVERSITY', 0, 1, 'C');
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(210, 54, 59); // Red
        $this->Cell(0, 1.0, 'The National Engineering University', 0, 1, 'C');
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('times', 'B', 12);
        $this->Cell(0, 1.0, 'ARASOF-Nasugbu Campus', 0, 1, 'C');
        $this->SetFont('times', 'B', 10);
        $this->Cell(0, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas, Philippines 4231', 0, 1, 'C');

        // Line divider
        $this->SetLineWidth(0.7);
        $this->Line(0, $this->GetY() + 2, 215.9, $this->GetY() + 2);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 12);
        $this->SetTextColor(210, 54, 59);
        $this->Cell(0, 1.0, 'Leading Innovations, Transforming Lives', 0, 1, 'R');
        $this->SetTextColor(0, 0, 0);
    }
}

// Create PDF instance
$pdf = new StudentListPDF('P', 'mm', 'legal');
$pdf->SetMargins(20, 40, 20); // Left, Top, Right
$pdf->SetAutoPageBreak(TRUE, 25);
$pdf->AddPage();

// Title
$pdf->SetY(40);
$pdf->SetFont('times', 'B', 14);
$pdf->Cell(0, 6, 'CLASS LIST OF STUDENTS', 0, 1, 'C');
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, $class_name, 0, 1, 'C');
$pdf->SetFont('times', '', 11);
$pdf->Cell(0, 6, 'School Year: ' . $school_year, 0, 1, 'C');
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 6, 'Date Printed: ' . date('m/d/Y'), 0, 1, 'L');
$pdf->Ln(8);

// ---------------------------------------------------------
// Separate students by gender
// ---------------------------------------------------------
$male_students   = [];
$female_students = [];

if (mysqli_num_rows($students_result) > 0) {
    mysqli_data_seek($students_result, 0); // reset pointer
    while ($student = mysqli_fetch_assoc($students_result)) {
        // Normalize gender (assume stored as 'Male'/'Female' or 'M'/'F')
        $gender = strtoupper(trim($student['gender']));
        if ($gender == 'MALE' || $gender == 'M') {
            $male_students[] = $student;
        } else {
            $female_students[] = $student;
        }
    }
}

// ---------------------------------------------------------
// Helper: Build HTML table for a given set of students
// ---------------------------------------------------------
function buildStudentTable($students, $title, $startNumber = 1) {
    $html = '<h3 style="font-size: 14px; font-weight: bold; margin-top: 10px;">' . $title . ' (' . count($students) . ')</h3>';
    $html .= '<table border="1" cellpadding="5">
                <thead>
                    <tr style="background-color: #f2f2f2; font-weight: bold;">
                        <th width="5%" align="center">No.</th>
                        <th width="15%" align="center">SR Code</th>
                        <th width="15%" align="center">LRN</th>
                        <th width="25%" align="center">Student Name</th>
                        <th width="25%" align="center">Email</th>
                        <th width="15%" align="center">Contact</th>
                    </tr>
                </thead>
                <tbody>';

    $counter = $startNumber;
    foreach ($students as $student) {
        // Format full name
        $middle = $student['middleName'] ? substr($student['middleName'], 0, 1) . '.' : '';
        $full_name = trim($student['lastName'] . ', ' . $student['firstName'] . ' ' . $middle);

        $html .= '<tr>
                    <td width="5%" align="center">' . $counter++ . '</td>
                    <td width="15%" align="center">' . ($student['sr_code'] ?? 'N/A') . '</td>
                    <td width="15%" align="center">' . ($student['lrn'] ?? 'N/A') . '</td>
                    <td width="25%" align="left">' . htmlspecialchars($full_name) . '</td>
                    <td width="25%" align="center">' . ($student['email'] ?? 'N/A') . '</td>
                    <td width="15%" align="center">' . ($student['contactNumber'] ?? 'N/A') . '</td>
                  </tr>';
    }

    $html .= '</tbody></table>';
    return $html;
}

// ---------------------------------------------------------
// Generate HTML for Male and Female tables
// ---------------------------------------------------------
$html = '';

// Male table
if (count($male_students) > 0) {
    $html .= buildStudentTable($male_students, 'MALE STUDENTS');
} else {
    $html .= '<h3 style="font-size: 14px; font-weight: bold; margin-top: 10px;">MALE STUDENTS</h3>';
    $html .= '<p>No male students found.</p>';
}

// Female table
if (count($female_students) > 0) {
    $html .= buildStudentTable($female_students, 'FEMALE STUDENTS');
} else {
    $html .= '<h3 style="font-size: 14px; font-weight: bold; margin-top: 10px;">FEMALE STUDENTS (0)</h3>';
    $html .= '<p>No female students found.</p>';
}

// Total count line
$total = count($male_students) + count($female_students);
$html .= '<p style="font-size: 11px; margin-top: 10px;"><strong>Total Students:</strong> ' . $total . ' (Male: ' . count($male_students) . ', Female: ' . count($female_students) . ')</p>';

// Write the HTML to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF
$filename = "Class_List_By_Gender_" . str_replace([' ', '-'], '_', $class_name) . "_" . date("Ymd") . ".pdf";
$pdf->Output($filename, 'I');

mysqli_close($conn);
?>