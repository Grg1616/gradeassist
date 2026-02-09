<?php

$student_id = isset($student_id) ? $student_id : '';
$adviser2 = isset($adviser2) ? $adviser2 : '';
$principal = isset($principal) ? $principal : '';
$studentName = isset($studentName) ? $studentName : '';
$lrn = isset($lrn) ? $lrn : '';
$age = isset($age) ? $age : '';
$gender = isset($gender) ? $gender : '';
$academic_year = isset($academic_year) ? $academic_year : '';
$gradeLevel = isset($gradeLevel) ? $gradeLevel : '';
$section = isset($section) ? $section : '';
$birthday  = isset($birthday ) ? $birthday  : '';
$guardianName  = isset($guardianName ) ? $guardianName  : '';
$guardianOccupation  = isset($guardianOccupation ) ? $guardianOccupation  : '';


ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class SeniorHighSchool extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
       parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
   }

   public function Header()
   {
       $this->SetFont('helvetica', 'N', 8);
       $this->SetY(10);
       $this->Cell(0, 1.0, 'FORM 137-SHS', 0, 1, 'R');
    }
}


// Example usage
$pdf = new  SeniorHighSchool('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();

    // Add image
       $pdf->Image('../assets/img/bsulogo.jpg', 29, 10, 35);
       // Add text and font


       $pdf->SetFont('times', 'B', 12);
       $pdf->SetY(16);
       $pdf->Cell(0, 1.0, 'Republic of the Philippines', 0, 1, 'C');
       $pdf->SetFont('times', 'B', 16);
       $pdf->Cell(0, 1.0, 'BATANGAS STATE UNIVERSITY', 0, 1, 'C');
       $pdf->SetFont('helvetica', 'B', 12);
       $pdf->SetTextColor(210, 54, 59); // Red color
       $pdf->Cell(0, 1.0, 'The National Engineering University', 0, 1, 'C');
       $pdf->SetTextColor(0, 0, 0);
       $pdf->SetFont('times', 'B', 12);
       $pdf->Cell(0, 1.0, 'ARASOF-Nasugbu Campus', 0, 1, 'C');
       $pdf->SetFont('times', 'B', 10);
       $pdf->Cell(200, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas', 0, 1, 'C');
       $pdf->SetFont('times', 'N', 10);
       $pdf->Cell(200, 1.0, 'Tel Nos.: (+63 43) 416 0349 loc. 114 / +63 919 079 0672', 0, 1, 'C');
        $pdf->SetFont('times', 'N', 10);
       $pdf->Cell(200, 1.0, 'Email Address: registrar.nasugbu@g.batstate-u.edu.ph | Website Address: http://www.batstate-u.edu.ph', 0, 1, 'C');

       // Add line divider
    $pdf->SetLineWidth(0.7);
$pdf->Line(5, $pdf->GetY() + 2, 210, $pdf->GetY() + 2); // Adjust the coordinates based on your needs

$pdf->setY(55);
$pdf->SetFont('times', 'B', 11); 
$pdf->Cell(0, 3, 'SENIOR HIGH SCHOOL STUDENT PERMANENT RECORD', 0, 1, 'C');
$pdf->Cell(0, 8, 'LEARNERS INFORMATION', 0, 1, 'C');


$pdf->setY(74);

$default_table = '';
for ($i = 0; $i < 7; $i++) {
 $default_table .=' <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>';
}
$default_table .='<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: right; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Total
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 6.25.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 15.39.5cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">General Ave. for the Semester:
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>';

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.25cm; font-family: Calibri, sans-serif; font-size: 9px; ">NAME:
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 18.10cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">'. $studentName .'
                    </td>

                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 19.99cm; font-family: Calibri, sans-serif; font-size: 8px;">(Last, First, Middle)
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.25cm; font-family: Calibri, sans-serif; font-size: 9px; ">LRN:
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.40cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">'. $lrn .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.06cm; font-family: Calibri, sans-serif; font-size: 9px; ">Date of Birth:
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.80cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">'. $birthday .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.90cm; font-family: Calibri, sans-serif; font-size: 9px; ">Sex:
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.00cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">'. $gender .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 3.62cm; font-family: Calibri, sans-serif; font-size: 9px; ">Date of SHS Admission:
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 5.30cm; font-family: Calibri, sans-serif; font-size: 8px;">
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;">(MM/DD/YYYY)
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 3.70cm; font-family: Calibri, sans-serif; font-size: 8px;">
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;">(MM/DD/YYYY)
                    </td>
                </tr>

        </table>';

$pdf->writeHTML($html);

$pdf->setY(96);
$pdf->SetFont('times', 'B', 11); 
$pdf->Cell(0, 3, 'ELIGIBILITY FOR SHS ENROLLMENT', 0, 1, 'C');

// Draw a square box
$pdf->SetLineWidth(0.35);
$pdf->Rect(11, 109, 4.5, 4);

$pdf->setY(109);+

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table

$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: .70cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 4.50cm; font-family: Calibri, sans-serif; font-size: 9px;">Junior High School Completer</td>

                    <td style="text-align: left; font-weight: normal; width: .45cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.71cm; font-family: Calibri, sans-serif; font-size: 9px;">Gen. Ave.:</td>

                    <td style="text-align: center; font-weight: bold; width: 2.30cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 9px;">Date of Completion:</td>

                    <td style="text-align: left; font-weight: normal; width: 2.20cm; font-family: Calibri, sans-serif; font-size: 9px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .45cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.55cm; font-family: Calibri, sans-serif; font-size: 9px;">Name of School:</td>

                    <td style="text-align: left; font-weight: bold; width: 5.10cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .45cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.55cm; font-family: Calibri, sans-serif; font-size: 9px;">School Address:</td>

                    <td style="text-align: left; font-weight: bold; width: 3.10cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(125);
$pdf->SetFont('times', 'B', 11); 
$pdf->Cell(0, 3, 'SCHOLASTIC RECORD', 0, 1, 'C');


// GRADE 11 - FIRST SEM //

$pdf->setY(137);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table

if (!empty($student_id)) {
    $gradeLevel = 'Grade 12';

    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    // Escape the student_id to prevent SQL injection
    $student_id = $conn->real_escape_string($student_id);

    $sql = "SELECT
                c.*,
                cs.*,
                ac.*,
                l.*
            FROM
                class c
            JOIN
                class_students cs ON cs.class_id = c.id
            JOIN
                academic_calendar ac ON c.school_year_id = ac.id
            JOIN
                loads l ON c.id = l.class_id
            WHERE
                cs.student_id = '$student_id'
                AND c.gradeLevel = '$gradeLevel'
                AND l.semester = 1";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $g11_1_section = $row['section'];
        $g11_1_academic_year = "$start_year - $end_year";
    } else {
        $g11_1_academic_year = '';
        $g11_1_section = '';
    }
} else {
    $g11_1_academic_year = '';
    $g11_1_section = '';
}

$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.44cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL:</td>

                    <td style="text-align: left; font-weight: bold; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;  border-bottom: .6px solid black;">BatStateU-TNEU ARASOF-Nasugbu Campus
                    </td>


                <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL ID:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px;">GRADE LEVEL:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.40cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">11
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SY:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.81cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">'. $g11_1_academic_year.'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SEM:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.70cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">First
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 8.5px;">TRACK/STRAND:</td>

                    <td style="text-align: left; font-weight: bold; width: 7.40cm; font-family: Calibri, sans-serif; font-size: 8.5px; border-bottom: .6px solid black;">Science, Technology, Engineering and Mathematics
                    </td>        

                    <td style="text-align: left; font-weight: normal; width: 1.45cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SECTION:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.60cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">'. $g11_1_section.'
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(152);

$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(11);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">COURSE<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;CODE</span>
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">COURSE TITLE
                    </td>   

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">CONTACT<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;&nbsp;HOURS</span>
                    </td>     

                    <td style="text-align: center; font-weight: bold; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">QUARTER
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">SEM FINAL<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;GRADE</span>
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">ACTION<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;TAKEN</span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">Grade 11 - First Semester
                    </td>      

                    <td style="text-align: center; font-weight: bold; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">1ST
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">2ND
                    </td>
                </tr>';

if (!empty($student_id)) {
    $query_subjects = "SELECT l.mapeh_name, c.gradeLevel, l.id as load_id, l.hours_per_week, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id, l.semester
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 11' AND l.semester = 1";

    $query_run = mysqli_query($conn, $query_subjects);

    $mapeh_grades = [
        'q1_grade' => 0,
        'q2_grade' => 0,
        'q3_grade' => 0,
        'q4_grade' => 0,
        'count' => 0
    ];

    $individual_mapeh_subjects = [];
    $final_ratings = [];
    $hpwTotals = [];

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $subject_title = !empty($row['mapeh_name']) ? $row['mapeh_name'] : $row['courseTitle'];
            $course_code = $row['courseCode'];
            $hours_per_week = $row['hours_per_week'];
            $gradeLevel = $row['gradeLevel'];


            $q1_grade = isset($row['q1_grade']) ? (int)$row['q1_grade'] : 0;
            $q2_grade = isset($row['q2_grade']) ? (int)$row['q2_grade'] : 0;


            if (strpos($course_code, 'MAPEH') !== false) {
                $mapeh_grades['q1_grade'] += $q1_grade;
                $mapeh_grades['q2_grade'] += $q2_grade;
                $mapeh_grades['count']++;

                $average_grade = round(($q1_grade + $q2_grade) / 2);
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $individual_mapeh_subjects[] = [
                    'title' => $subject_title,
                    'course_code' => $course_code,
                    'q1_grade' => $q1_grade,
                    'q2_grade' => $q2_grade,
                    'average_grade' => $average_grade,
                    'remarks' => $remarks
                ];
            } else {
                $average_grade = round(($q1_grade + $q2_grade) / 2);
                $final_rating = $average_grade;
                $final_ratings[] = $final_rating;
                $hpwTotals[] = $hours_per_week;
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$course_code.'</td>
                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$hours_per_week.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$average_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$remarks.'</td>
                </tr>';
            }
        }

        if ($mapeh_grades['count'] > 0) {
            $mapeh_q1_avg = round($mapeh_grades['q1_grade'] / $mapeh_grades['count']);
            $mapeh_q2_avg = round($mapeh_grades['q2_grade'] / $mapeh_grades['count']);
            $mapeh_final_rating = round(($mapeh_q1_avg + $mapeh_q2_avg) / 4);
            $final_ratings[] = $mapeh_final_rating;
            $hpwTotals[] = $hours_per_week;
            $mapeh_remarks = ($mapeh_final_rating >= 75) ? "Passed" : "Failed";

            $html .= '<tr>
                <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">MAPEH</td>
                <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;"></td>
                <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$hours_per_week.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.13.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_q1_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_q2_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_final_rating.'</td>
                <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_remarks.'</td>
            </tr>';

            foreach ($individual_mapeh_subjects as $mapeh_subject) {
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;'.$mapeh_subject['title'].'</td>
                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">' . preg_replace('/\d+/', '', htmlspecialchars($mapeh_subject['title'])) . '</td>
                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;"></td>
                    <td style="text-align: center; font-weight: normal; width: 1.13.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['q1_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['q2_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['average_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['remarks'].'</td>
                </tr>';
            }
        }

        $general_average = round(array_sum($final_ratings) / count($final_ratings));
        $hpwTotal = array_sum($hpwTotals);
        $final_remark = ($general_average >= 75) ? "Passed" : "Failed";

        $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Total
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$hpwTotal.'
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.25.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: bold; width: 15.39.5cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">General Ave. for the Semester:
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$general_average.'
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$final_remark.'
                    </td>
                </tr>';
    } else {
$html .= $default_table;
        
    }
} else {
    $html .= $default_table;
} 

$html .= '</table>';
$pdf->writeHTML($html);


// GRADE 11 - SECOND SEM //

$pdf->setY(225);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table

if (!empty($student_id)) {
    $gradeLevel = 'Grade 11';

    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    // Escape the student_id to prevent SQL injection
    $student_id = $conn->real_escape_string($student_id);

    $sql = "SELECT
                c.*,
                cs.*,
                ac.*,
                l.*
            FROM
                class c
            JOIN
                class_students cs ON cs.class_id = c.id
            JOIN
                academic_calendar ac ON c.school_year_id = ac.id
            JOIN
                loads l ON c.id = l.class_id
            WHERE
                cs.student_id = '$student_id'
                AND c.gradeLevel = '$gradeLevel'
                AND l.semester = 2";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $g11_2_section = $row['section'];
        $g11_2_academic_year = "$start_year - $end_year";
    } else {
        $g11_2_academic_year = '';
        $g11_2_section = '';
    }
} else {
    $g11_2_academic_year = '';
    $g11_2_section = '';
}
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.44cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL:</td>

                    <td style="text-align: left; font-weight: bold; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;  border-bottom: .6px solid black;">BatStateU-TNEU ARASOF-Nasugbu Campus
                    </td>


                <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL ID:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px;">GRADE LEVEL:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.40cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">11
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SY:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.81cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">'. $g11_2_academic_year .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SEM:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.09cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">Second
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 8.5px;">TRACK/STRAND:</td>

                    <td style="text-align: left; font-weight: bold; width: 7.40cm; font-family: Calibri, sans-serif; font-size: 8.5px; border-bottom: .6px solid black;">Science, Technology, Engineering and Mathematics
                    </td>        

                    <td style="text-align: left; font-weight: normal; width: 1.45cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SECTION:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.60cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">'. $g11_2_section.'
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(240);

$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(11);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">COURSE<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;CODE</span>
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">COURSE TITLE
                    </td>   

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">CONTACT<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;&nbsp;HOURS</span>
                    </td>     

                    <td style="text-align: center; font-weight: bold; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">QUARTER
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">SEM FINAL<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;GRADE</span>
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">ACTION<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;TAKEN</span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">Grade 11 - First Semester
                    </td>      

                    <td style="text-align: center; font-weight: bold; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">1ST
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">2ND
                    </td>
                </tr>';

if (!empty($student_id)) {
    $query_subjects = "SELECT l.mapeh_name, c.gradeLevel, l.id as load_id, l.hours_per_week, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id, l.semester
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 11' AND l.semester = 2";

    $query_run = mysqli_query($conn, $query_subjects);

    $mapeh_grades = [
        'q1_grade' => 0,
        'q2_grade' => 0,
        'q3_grade' => 0,
        'q4_grade' => 0,
        'count' => 0
    ];

    $individual_mapeh_subjects = [];
    $final_ratings = [];
    $hpwTotals = [];

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $subject_title = !empty($row['mapeh_name']) ? $row['mapeh_name'] : $row['courseTitle'];
            $course_code = $row['courseCode'];
            $hours_per_week = $row['hours_per_week'];
            $gradeLevel = $row['gradeLevel'];


            $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
            $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;


            if (strpos($course_code, 'MAPEH') !== false) {
                $mapeh_grades['q3_grade'] += $q3_grade;
                $mapeh_grades['q4_grade'] += $q4_grade;
                $mapeh_grades['count']++;

                $average_grade = round(($q3_grade + $q4_grade) / 2);
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $individual_mapeh_subjects[] = [
                    'title' => $subject_title,
                    'course_code' => $course_code,
                    'q3_grade' => $q3_grade,
                    'q4_grade' => $q4_grade,
                    'average_grade' => $average_grade,
                    'remarks' => $remarks
                ];
            } else {
                $average_grade = round(($q3_grade + $q4_grade) / 2);
                $final_rating = $average_grade;
                $final_ratings[] = $final_rating;
                $hpwTotals[] = $hours_per_week;
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$course_code.'</td>
                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$hours_per_week.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$average_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$remarks.'</td>
                </tr>';
            }
        }

        if ($mapeh_grades['count'] > 0) {
            $mapeh_q3_avg = round($mapeh_grades['q3_grade'] / $mapeh_grades['count']);
            $mapeh_q4_avg = round($mapeh_grades['q4_grade'] / $mapeh_grades['count']);
            $mapeh_final_rating = round(($mapeh_q3_avg + $mapeh_q4_avg) / 4);
            $final_ratings[] = $mapeh_final_rating;
            $hpwTotals[] = $hours_per_week;
            $mapeh_remarks = ($mapeh_final_rating >= 75) ? "Passed" : "Failed";

            $html .= '<tr>
                <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">MAPEH</td>
                <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;"></td>
                <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$hours_per_week.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.13.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_q3_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_q4_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_final_rating.'</td>
                <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_remarks.'</td>
            </tr>';

            foreach ($individual_mapeh_subjects as $mapeh_subject) {
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;'.$mapeh_subject['title'].'</td>
                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">' . preg_replace('/\d+/', '', htmlspecialchars($mapeh_subject['title'])) . '</td>
                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;"></td>
                    <td style="text-align: center; font-weight: normal; width: 1.13.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['q3_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['q4_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['average_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['remarks'].'</td>
                </tr>';
            }
        }

        $general_average = round(array_sum($final_ratings) / count($final_ratings));
        $hpwTotal = array_sum($hpwTotals);
        $final_remark = ($general_average >= 75) ? "Passed" : "Failed";

        $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Total
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$hpwTotal.'
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.25.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: bold; width: 15.39.5cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">General Ave. for the Semester:
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$general_average.'
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$final_remark.'
                    </td>
                </tr>';
    } else {
$html .= $default_table;
        
    }
} else {
    $html .= $default_table;
} 

$html .= '</table>';
$pdf->writeHTML($html);

$pdf->AddPage();

// GRADE 12 - FIRST SEM //

$pdf->setY(20);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table

if (!empty($student_id)) {
    $gradeLevel = 'Grade 12';

    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    // Escape the student_id to prevent SQL injection
    $student_id = $conn->real_escape_string($student_id);

    $sql = "SELECT
                c.*,
                cs.*,
                ac.*,
                l.*
            FROM
                class c
            JOIN
                class_students cs ON cs.class_id = c.id
            JOIN
                academic_calendar ac ON c.school_year_id = ac.id
            JOIN
                loads l ON c.id = l.class_id
            WHERE
                cs.student_id = '$student_id'
                AND c.gradeLevel = '$gradeLevel'
                AND l.semester = 1";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $g12_1_section = $row['section'];
        $g12_1_academic_year = "$start_year - $end_year";
    } else {
        $g12_1_academic_year = '';
        $g12_1_section = '';
    }
} else {
    $g12_1_academic_year = '';
    $g12_1_section = '';
}

$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.44cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL:</td>

                    <td style="text-align: left; font-weight: bold; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;  border-bottom: .6px solid black;">BatStateU-TNEU ARASOF-Nasugbu Campus
                    </td>


                <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL ID:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px;">GRADE LEVEL:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.40cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">12
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SY:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.81cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">'. $g12_1_academic_year .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SEM:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.70cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">First
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 8.5px;">TRACK/STRAND:</td>

                    <td style="text-align: left; font-weight: bold; width: 7.40cm; font-family: Calibri, sans-serif; font-size: 8.5px; border-bottom: .6px solid black;">Science, Technology, Engineering and Mathematics
                    </td>        

                    <td style="text-align: left; font-weight: normal; width: 1.45cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SECTION:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.60cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">'. $g12_1_section .'
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(35);

$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(11);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">COURSE<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;CODE</span>
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">COURSE TITLE
                    </td>   

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">CONTACT<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;&nbsp;HOURS</span>
                    </td>     

                    <td style="text-align: center; font-weight: bold; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">QUARTER
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">SEM FINAL<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;GRADE</span>
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">ACTION<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;TAKEN</span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">Grade 11 - First Semester
                    </td>      

                    <td style="text-align: center; font-weight: bold; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">1ST
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">2ND
                    </td>
                </tr>';

if (!empty($student_id)) {
    $query_subjects = "SELECT l.mapeh_name, c.gradeLevel, l.id as load_id, l.hours_per_week, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id, l.semester
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 12' AND l.semester = 1";

    $query_run = mysqli_query($conn, $query_subjects);

    $mapeh_grades = [
        'q1_grade' => 0,
        'q2_grade' => 0,
        'q3_grade' => 0,
        'q4_grade' => 0,
        'count' => 0
    ];

    $individual_mapeh_subjects = [];
    $final_ratings = [];
    $hpwTotals = [];

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $subject_title = !empty($row['mapeh_name']) ? $row['mapeh_name'] : $row['courseTitle'];
            $course_code = $row['courseCode'];
            $hours_per_week = $row['hours_per_week'];
            $gradeLevel = $row['gradeLevel'];


            $q1_grade = isset($row['q1_grade']) ? (int)$row['q1_grade'] : 0;
            $q2_grade = isset($row['q2_grade']) ? (int)$row['q2_grade'] : 0;


            if (strpos($course_code, 'MAPEH') !== false) {
                $mapeh_grades['q1_grade'] += $q1_grade;
                $mapeh_grades['q2_grade'] += $q2_grade;
                $mapeh_grades['count']++;

                $average_grade = round(($q1_grade + $q2_grade) / 2);
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $individual_mapeh_subjects[] = [
                    'title' => $subject_title,
                    'course_code' => $course_code,
                    'q1_grade' => $q1_grade,
                    'q2_grade' => $q2_grade,
                    'average_grade' => $average_grade,
                    'remarks' => $remarks
                ];
            } else {
                $average_grade = round(($q1_grade + $q2_grade) / 2);
                $final_rating = $average_grade;
                $final_ratings[] = $final_rating;
                $hpwTotals[] = $hours_per_week;
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$course_code.'</td>
                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$hours_per_week.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$average_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$remarks.'</td>
                </tr>';
            }
        }

        if ($mapeh_grades['count'] > 0) {
            $mapeh_q1_avg = round($mapeh_grades['q1_grade'] / $mapeh_grades['count']);
            $mapeh_q2_avg = round($mapeh_grades['q2_grade'] / $mapeh_grades['count']);
            $mapeh_final_rating = round(($mapeh_q1_avg + $mapeh_q2_avg) / 4);
            $final_ratings[] = $mapeh_final_rating;
            $hpwTotals[] = $hours_per_week;
            $mapeh_remarks = ($mapeh_final_rating >= 75) ? "Passed" : "Failed";

            $html .= '<tr>
                <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">MAPEH</td>
                <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;"></td>
                <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$hours_per_week.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.13.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_q1_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_q2_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_final_rating.'</td>
                <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_remarks.'</td>
            </tr>';

            foreach ($individual_mapeh_subjects as $mapeh_subject) {
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;'.$mapeh_subject['title'].'</td>
                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">' . preg_replace('/\d+/', '', htmlspecialchars($mapeh_subject['title'])) . '</td>
                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;"></td>
                    <td style="text-align: center; font-weight: normal; width: 1.13.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['q1_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['q2_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['average_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['remarks'].'</td>
                </tr>';
            }
        }

        $general_average = round(array_sum($final_ratings) / count($final_ratings));
        $hpwTotal = array_sum($hpwTotals);
        $final_remark = ($general_average >= 75) ? "Passed" : "Failed";

        $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Total
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$hpwTotal.'
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.25.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: bold; width: 15.39.5cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">General Ave. for the Semester:
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$general_average.'
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$final_remark.'
                    </td>
                </tr>';
    } else {
$html .= $default_table;
        
    }
} else {
    $html .= $default_table;
} 

$html .= '</table>';
$pdf->writeHTML($html);

// GRADE 12 - SECOND SEM //

$pdf->setY(103);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table

if (!empty($student_id)) {
    $gradeLevel = 'Grade 12';

    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    // Escape the student_id to prevent SQL injection
    $student_id = $conn->real_escape_string($student_id);

    $sql = "SELECT
                c.*,
                cs.*,
                ac.*,
                l.*
            FROM
                class c
            JOIN
                class_students cs ON cs.class_id = c.id
            JOIN
                academic_calendar ac ON c.school_year_id = ac.id
            JOIN
                loads l ON c.id = l.class_id
            WHERE
                cs.student_id = '$student_id'
                AND c.gradeLevel = '$gradeLevel'
                AND l.semester = 2";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $g12_2_section = $row['section'];
        $g12_2_academic_year = "$start_year - $end_year";
    } else {
        $g12_2_academic_year = '';
        $g12_2_section = '';
    }
} else {
    $g12_2_academic_year = '';
    $g12_2_section = '';
}
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.44cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL:</td>

                    <td style="text-align: left; font-weight: bold; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;  border-bottom: .6px solid black;">BatStateU-TNEU ARASOF-Nasugbu Campus
                    </td>


                <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL ID:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px;">GRADE LEVEL:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.40cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">12
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SY:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.81cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">'. $g12_2_academic_year .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SEM:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.09cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">Second
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 8.5px;">TRACK/STRAND:</td>

                    <td style="text-align: left; font-weight: bold; width: 7.40cm; font-family: Calibri, sans-serif; font-size: 8.5px; border-bottom: .6px solid black;">Science, Technology, Engineering and Mathematics
                    </td>        

                    <td style="text-align: left; font-weight: normal; width: 1.45cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SECTION:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.60cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">'. $g12_2_section .'
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(118);

$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(11);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">COURSE<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;CODE</span>
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">COURSE TITLE
                    </td>   

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">CONTACT<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;&nbsp;HOURS</span>
                    </td>     

                    <td style="text-align: center; font-weight: bold; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">QUARTER
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">SEM FINAL<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;GRADE</span>
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">ACTION<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;TAKEN</span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">Grade 11 - First Semester
                    </td>      

                    <td style="text-align: center; font-weight: bold; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">1ST
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">2ND
                    </td>
                </tr>';

if (!empty($student_id)) {
    $query_subjects = "SELECT l.mapeh_name, c.gradeLevel, l.id as load_id, l.hours_per_week, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id, l.semester
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 12' AND l.semester = 2";

    $query_run = mysqli_query($conn, $query_subjects);

    $mapeh_grades = [
        'q1_grade' => 0,
        'q2_grade' => 0,
        'q3_grade' => 0,
        'q4_grade' => 0,
        'count' => 0
    ];

    $individual_mapeh_subjects = [];
    $final_ratings = [];
    $hpwTotals = [];

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $subject_title = !empty($row['mapeh_name']) ? $row['mapeh_name'] : $row['courseTitle'];
            $course_code = $row['courseCode'];
            $hours_per_week = $row['hours_per_week'];
            $gradeLevel = $row['gradeLevel'];


            $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
            $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;


            if (strpos($course_code, 'MAPEH') !== false) {
                $mapeh_grades['q3_grade'] += $q3_grade;
                $mapeh_grades['q4_grade'] += $q4_grade;
                $mapeh_grades['count']++;

                $average_grade = round(($q3_grade + $q4_grade) / 2);
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $individual_mapeh_subjects[] = [
                    'title' => $subject_title,
                    'course_code' => $course_code,
                    'q3_grade' => $q3_grade,
                    'q4_grade' => $q4_grade,
                    'average_grade' => $average_grade,
                    'remarks' => $remarks
                ];
            } else {
                $average_grade = round(($q3_grade + $q4_grade) / 2);
                $final_rating = $average_grade;
                $final_ratings[] = $final_rating;
                $hpwTotals[] = $hours_per_week;
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$course_code.'</td>
                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$hours_per_week.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$average_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$remarks.'</td>
                </tr>';
            }
        }

        if ($mapeh_grades['count'] > 0) {
            $mapeh_q3_avg = round($mapeh_grades['q3_grade'] / $mapeh_grades['count']);
            $mapeh_q4_avg = round($mapeh_grades['q4_grade'] / $mapeh_grades['count']);
            $mapeh_final_rating = round(($mapeh_q3_avg + $mapeh_q4_avg) / 4);
            $final_ratings[] = $mapeh_final_rating;
            $hpwTotals[] = $hours_per_week;
            $mapeh_remarks = ($mapeh_final_rating >= 75) ? "Passed" : "Failed";

            $html .= '<tr>
                <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">MAPEH</td>
                <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;"></td>
                <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$hours_per_week.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.13.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_q3_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_q4_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_final_rating.'</td>
                <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_remarks.'</td>
            </tr>';

            foreach ($individual_mapeh_subjects as $mapeh_subject) {
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;'.$mapeh_subject['title'].'</td>
                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">' . preg_replace('/\d+/', '', htmlspecialchars($mapeh_subject['title'])) . '</td>
                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;"></td>
                    <td style="text-align: center; font-weight: normal; width: 1.13.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['q3_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['q4_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['average_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_subject['remarks'].'</td>
                </tr>';
            }
        }

        $general_average = round(array_sum($final_ratings) / count($final_ratings));
        $hpwTotal = array_sum($hpwTotals);
        $final_remark = ($general_average >= 75) ? "Passed" : "Failed";

        $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Total
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$hpwTotal.'
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.25.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right; font-weight: bold; width: 15.39.5cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">General Ave. for the Semester:
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$general_average.'
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">'.$final_remark.'
                    </td>
                </tr>';
    } else {
$html .= $default_table;
        
    }
} else {
    $html .= $default_table;
} 

$html .= '</table>';
$pdf->writeHTML($html);


$pdf->setY(190);

$pdf->setX(15);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 1.0, 'CERTIFICATE OF TRANSFER', 0, 0, 'C');

$pdf->setX(11);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 20, 'TO WHOM IT MAY CONCERN:', 0, 0, 'L');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 38, 'This certifies the true Senior High School Permanet Record of _________________________________. She is eligible for', 0, 0, 'L');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 46, 'admission to _________ as (a regular/irregular) student and has no property responsibility in this school.', 0, 0, 'L');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 65, 'This Certificate of Transfer is given this _____ day of ___________.', 0, 0, 'L');

$pdf->setY(230);

$pdf->setX(140);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 20, 'ERWIN R. ABIAD', 0, 0, 'C');

$pdf->setx(17);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 28, 'Registrar III/ Head, Registration Services', 0, 0, 'R');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 50, 'COPY VALID FOR:', 0, 0, 'L');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 85, 'Not valid without University dryseal', 0, 0, 'L');

$pdf->setY(-30);
$pdf->SetFont('times', '', 10);

$filename = "Kinder_form138_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';
?>