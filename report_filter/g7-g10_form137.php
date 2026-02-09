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

class  JuniorHighSchool extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
       parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
   }

   public function Header()
   {
    }
}


// Example usage
$pdf = new  JuniorHighSchool('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();
   // Add image
// Add image
$pdf->Image('../assets/img/bsulogo.jpg', 27, 2, 35);
// Add text and font
$pdf->SetFont('times', 'N', 12);
$pdf->SetY(5);
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
$pdf->Cell(0, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas', 0, 0, 'C');

$pdf->setY(35);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 1.0, 'SECONDARY STUDENT’S PERMANENT RECORD', 0, 0, 'C');


// $pdf->setY(27);
// $pdf->setX(20);
// $pdf->SetFont('times', 'N', 8);
// $pdf->Cell(0, 1.0, 'Name:', 0, 0, 'L');
// $pdf->Ln(); // Add a line break
// $pdf->Line(30, $pdf->GetY(), 78, $pdf->GetY());



$default_table = '';
for ($i = 0; $i < 14; $i++) {
 $default_table .='<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                </tr>';
}
 $default_table .='
 <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TOTAL
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">33
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 7px; vertical-align: middle; line-height: 0.45cm;">GENERAL AVERAGE:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                </tr>';

$pdf->setY(45);


$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(50);
// Add HTML table
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.05cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Name:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 5.50cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">'. $studentName .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.84cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Age:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.41cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">'. $age .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.49cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.00cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.99cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Date of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 4.56cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">'. $birthday .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.06cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Place of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.80cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 2.71cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Parent or Guardian:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.84cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">'. $guardianName .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.76cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Occupation:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.92cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">'. $guardianOccupation .'
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.17cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Address of Parent or Guardian:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 5.78cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                  <tr>
                    <td style="text-align: left; font-weight: normal; width: 5.52cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Intermediate Course Completed (School):
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.90cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .40cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.87cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">School Year:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 2.00cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 7.80cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Total No. of Years in School Complete Elementary Course:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.83cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.45cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">General Average:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.42cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.83cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .90cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">LRN:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;"> '. $lrn .'
                    </td>
                </tr>

        </table>';

$pdf->writeHTML($html);

// GRADE VII

$pdf->setY(70);
$pdf->setX(25);
$pdf->SetFont('helvetica', 'N', 8);
$pdf->Cell(0, 1.0, 'Classified as:', 0, 1, 'L');

$pdf->setY(75);

$pdf->SetLeftMargin(26);
$pdf->SetRightMargin(16.5);
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.10cm; font-family: helvetica, sans-serif; font-size: 8px;">Grade:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .35cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">VII
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.08cm; font-family: helvetica, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 8px;">School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 8.27cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY-TNEU ARASOF-NASUGBU
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.8cm; font-family: helvetica, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.82cm; font-family: helvetica, sans-serif; font-size: 8px;">School Year:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 1.9cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">';

if (!empty($student_id)) {
    $gradeLevel = 'Grade 7';

    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    // Escape the student_id to prevent SQL injection
    $student_id = $conn->real_escape_string($student_id);

    $sql = "SELECT
                c.*,
                cs.*,
                ac.*
            FROM
                class c
            JOIN
                class_students cs ON cs.class_id = c.id
            JOIN
                academic_calendar ac ON c.school_year_id = ac.id
            WHERE
                cs.student_id = '$student_id'
                AND c.gradeLevel = '$gradeLevel'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $g7_academic_year = "$start_year - $end_year";
    } else {
        $g7_academic_year = '';
    }
} else {
    $g7_academic_year = '';
}

$html .= $g7_academic_year . '</td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: normal; width: 3.64cm; font-family: times, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.22cm; font-family: times, sans-serif; font-size: 8px; border-bottom: .6px solid black;">Formerly Apolinario R. Apacible School of Fisheries
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);




$pdf->setY(84);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border="0.45" style="border-collapse: collapse; width: 100%;">
            <tr>
                <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE CODE</td>
                <td rowspan="2" style="text-align: center; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE TITLE</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">CONTACT</td>
                <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">GRADING PERIOD</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">C.S</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">ACTION</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">HOURS</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">1</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">2</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">AVERAGE</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TAKEN</td>
            </tr>';

if (!empty($student_id)) {
    $query_subjects = "SELECT l.mapeh_name, c.gradeLevel, l.id as load_id, l.hours_per_week, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 7'";

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
            $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
            $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;

            if (strpos($course_code, 'MAPEH') !== false) {
                $mapeh_grades['q1_grade'] += $q1_grade;
                $mapeh_grades['q2_grade'] += $q2_grade;
                $mapeh_grades['q3_grade'] += $q3_grade;
                $mapeh_grades['q4_grade'] += $q4_grade;
                $mapeh_grades['count']++;

                $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $individual_mapeh_subjects[] = [
                    'title' => $subject_title,
                    'course_code' => $course_code,
                    'q1_grade' => $q1_grade,
                    'q2_grade' => $q2_grade,
                    'q3_grade' => $q3_grade,
                    'q4_grade' => $q4_grade,
                    'average_grade' => $average_grade,
                    'remarks' => $remarks
                ];
            } else {
                $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);
                $final_rating = $average_grade;
                $final_ratings[] = $final_rating;
                $hpwTotals[] = $hours_per_week;
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$course_code.'</td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hours_per_week.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$average_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$remarks.'</td>
                </tr>';
            }
        }

        if ($mapeh_grades['count'] > 0) {
            $mapeh_q1_avg = round($mapeh_grades['q1_grade'] / $mapeh_grades['count']);
            $mapeh_q2_avg = round($mapeh_grades['q2_grade'] / $mapeh_grades['count']);
            $mapeh_q3_avg = round($mapeh_grades['q3_grade'] / $mapeh_grades['count']);
            $mapeh_q4_avg = round($mapeh_grades['q4_grade'] / $mapeh_grades['count']);
            $mapeh_final_rating = round(($mapeh_q1_avg + $mapeh_q2_avg + $mapeh_q3_avg + $mapeh_q4_avg) / 4);
            $final_ratings[] = $mapeh_final_rating;
            $hpwTotals[] = $hours_per_week;
            $mapeh_remarks = ($mapeh_final_rating >= 75) ? "Passed" : "Failed";

            $html .= '<tr>
                <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">MAPEH</td>
                <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;"></td>
                <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hours_per_week.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q1_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q2_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q3_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q4_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_final_rating.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_remarks.'</td>
            </tr>';

            foreach ($individual_mapeh_subjects as $mapeh_subject) {
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;'.$mapeh_subject['title'].'</td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">' . preg_replace('/\d+/', '', htmlspecialchars($mapeh_subject['title'])) . '</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;"></td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q1_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q2_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q3_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q4_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['average_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['remarks'].'</td>
                </tr>';
            }
        }

        $general_average = round(array_sum($final_ratings) / count($final_ratings));
        $hpwTotal = array_sum($hpwTotals);
        $final_remark = ($general_average >= 75) ? "Passed" : "Failed";

        $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TOTAL
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hpwTotal.'
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 7px; vertical-align: middle; line-height: 0.45cm;">GENERAL AVERAGE:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$general_average.'
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$final_remark.'
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


$pdf->setY(168);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table


if (!empty($student_id)) {
    $gradeLevel = 'Grade 7';
    
    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    $sql = "SELECT
                attendance.*,
                months.*,
                class.*,
                class_students.*
            FROM
                attendance
            JOIN
                months ON months.id = attendance.month_id
            JOIN
                class ON class.id = attendance.class_id
            JOIN
                class_students ON class_students.class_id = class.id
            WHERE
                attendance.student_id = $student_id
                AND class_students.student_id = $student_id
                AND attendance.school_year_id = class_students.school_year_id
                AND class.gradeLevel = '$gradeLevel'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $g7_school_year = $row['school_year_id'];
        $g7_class_id = $row['class_id']; 
    } else {
        $g7_class_id = '';
        $g7_school_year = '';
    }
} else {
    $g7_class_id = '';
    $g7_school_year = '';
}

$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
           
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">ATTENDANCE</td>';

if (!empty($g7_school_year)) {
    $query_class_start_month = "SELECT class_start FROM academic_calendar WHERE id = $g7_school_year";
    $query_run_class_start_month = mysqli_query($conn, $query_class_start_month);
    $row_class_start_month = mysqli_fetch_assoc($query_run_class_start_month);
    $class_start_month = date("F", strtotime($row_class_start_month['class_start']));

    $months = array($class_start_month);
    for ($i = 1; $i < 12; $i++) {
        $months[] = date("F", strtotime("$class_start_month + $i month"));
    }

    $orderClause = "FIELD(monthName, '" . implode("', '", $months) . "')";

    $query1 = "SELECT m.monthName, m.daysInMonth, m.id as month_id
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = $g7_school_year
              ORDER BY $orderClause";
    $query_run = mysqli_query($conn, $query1);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            $shortMonthName = date("M", strtotime($row1["monthName"]));
            $month_id = $row1["month_id"];
            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">'. strtoupper($shortMonthName) .'</td>';
        }
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">TOTAL</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS OF SCHOOL</td>';

$totalSchoolDays = 0;

if (!empty($g7_school_year)) {
    $query2 = "SELECT m.id, m.daysInMonth
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = '$g7_school_year'
              ORDER BY $orderClause";

    $query_run = mysqli_query($conn, $query2);

    if ($query_run) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $row1["daysInMonth"] . '</td>';
            $totalSchoolDays += $row1["daysInMonth"];
        }
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">'. $totalSchoolDays .'</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS PRESENT</td>';

$totalDaysPresent = 0;

if (!empty($g7_school_year) && !empty($g7_class_id)) {
    $query_run_months = mysqli_query($conn, $query2);

    if ($query_run_months) {
        while ($row_month = mysqli_fetch_assoc($query_run_months)) {
            $month_id = $row_month['id'];
            $daysInMonth = $row_month['daysInMonth'];
            $attendance_query = "SELECT a.daysPresent, m.id as m_id
                                 FROM attendance a
                                 RIGHT JOIN months m ON a.month_id = m.id
                                 WHERE a.student_id = '$student_id' AND a.class_id = '$g7_class_id' AND a.school_year_id = '$g7_school_year' AND m.id = '$month_id'";

            $attendance_result = mysqli_query($conn, $attendance_query);
            $attendance_row = mysqli_fetch_assoc($attendance_result);
            $daysPresent = isset($attendance_row['daysPresent']) ? $attendance_row['daysPresent'] : $daysInMonth;
            $totalDaysPresent += $daysPresent;

            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $daysPresent . '</td>';
        }

        $html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $totalDaysPresent . '</td>';
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '</tr>
        </table>';

$pdf->writeHTML($html);


$pdf->setY(180);
$pdf->setX(25);
$pdf->SetFont('helvetica', 'N', 9);
$pdf->Cell(0, 1.0, 'Total number of years in school to date   …………….', 0, 1, 'L');

// Grade VIII

$pdf->setY(185.5);
$pdf->setX(25);
$pdf->SetFont('helvetica', 'N', 8);
$pdf->Cell(0, 1.0, 'Classified as:', 0, 1, 'L');

$pdf->setY(190.5);

$pdf->SetLeftMargin(26);
$pdf->SetRightMargin(16.5);
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.10cm; font-family: helvetica, sans-serif; font-size: 8px;">Grade:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .45cm;  font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">VIII
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.08cm; font-family: helvetica, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 8px;">School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 8.27cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY-TNEU ARASOF-NASUGBU
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.8cm; font-family: helvetica, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.82cm; font-family: helvetica, sans-serif; font-size: 8px;">School Year:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 1.7cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">';

if (!empty($student_id)) {
    $gradeLevel = 'Grade 8';

    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    // Escape the student_id to prevent SQL injection
    $student_id = $conn->real_escape_string($student_id);

    $sql = "SELECT
                c.*,
                cs.*,
                ac.*
            FROM
                class c
            JOIN
                class_students cs ON cs.class_id = c.id
            JOIN
                academic_calendar ac ON c.school_year_id = ac.id
            WHERE
                cs.student_id = '$student_id'
                AND c.gradeLevel = '$gradeLevel'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $g8_academic_year = "$start_year - $end_year";
    } else {
        $g8_academic_year = '';
    }
} else {
    $g8_academic_year = '';
}

$html .= $g8_academic_year . '</td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: normal; width: 3.64cm; font-family: times, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.22cm; font-family: times, sans-serif; font-size: 8px; border-bottom: .6px solid black;">Formerly Apolinario R. Apacible School of Fisheries
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);


$pdf->setY(199.5);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border="0.45" style="border-collapse: collapse; width: 100%;">
            <tr>
                <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE CODE</td>
                <td rowspan="2" style="text-align: center; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE TITLE</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">CONTACT</td>
                <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">GRADING PERIOD</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">C.S</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">ACTION</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">HOURS</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">1</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">2</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">AVERAGE</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TAKEN</td>
            </tr>';

if (!empty($student_id)) {
    $query_subjects = "SELECT l.mapeh_name, l.id as load_id, l.hours_per_week, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 8'";

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


            $q1_grade = isset($row['q1_grade']) ? (int)$row['q1_grade'] : 0;
            $q2_grade = isset($row['q2_grade']) ? (int)$row['q2_grade'] : 0;
            $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
            $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;

            if (strpos($course_code, 'MAPEH') !== false) {
                $mapeh_grades['q1_grade'] += $q1_grade;
                $mapeh_grades['q2_grade'] += $q2_grade;
                $mapeh_grades['q3_grade'] += $q3_grade;
                $mapeh_grades['q4_grade'] += $q4_grade;
                $mapeh_grades['count']++;

                $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $individual_mapeh_subjects[] = [
                    'title' => $subject_title,
                    'course_code' => $course_code,
                    'q1_grade' => $q1_grade,
                    'q2_grade' => $q2_grade,
                    'q3_grade' => $q3_grade,
                    'q4_grade' => $q4_grade,
                    'average_grade' => $average_grade,
                    'remarks' => $remarks
                ];
            } else {
                $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);
                $final_rating = $average_grade;
                $final_ratings[] = $final_rating;
                $hpwTotals[] = $hours_per_week;
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$course_code.'</td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hours_per_week.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$average_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$remarks.'</td>
                </tr>';
            }
        }

        if ($mapeh_grades['count'] > 0) {
            $mapeh_q1_avg = round($mapeh_grades['q1_grade'] / $mapeh_grades['count']);
            $mapeh_q2_avg = round($mapeh_grades['q2_grade'] / $mapeh_grades['count']);
            $mapeh_q3_avg = round($mapeh_grades['q3_grade'] / $mapeh_grades['count']);
            $mapeh_q4_avg = round($mapeh_grades['q4_grade'] / $mapeh_grades['count']);
            $mapeh_final_rating = round(($mapeh_q1_avg + $mapeh_q2_avg + $mapeh_q3_avg + $mapeh_q4_avg) / 4);
            $final_ratings[] = $mapeh_final_rating;
            $hpwTotals[] = $hours_per_week;
            $mapeh_remarks = ($mapeh_final_rating >= 75) ? "Passed" : "Failed";

            $html .= '<tr>
                <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">MAPEH</td>
                <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;"></td>
                <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hours_per_week.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q1_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q2_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q3_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q4_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_final_rating.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_remarks.'</td>
            </tr>';

            foreach ($individual_mapeh_subjects as $mapeh_subject) {
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;'.$mapeh_subject['title'].'</td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">' . preg_replace('/\d+/', '', htmlspecialchars($mapeh_subject['title'])) . '</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;"></td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q1_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q2_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q3_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q4_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['average_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['remarks'].'</td>
                </tr>';
            }
        }

        $general_average = round(array_sum($final_ratings) / count($final_ratings));
        $hpwTotal = array_sum($hpwTotals);
        $final_remark = ($general_average >= 75) ? "Passed" : "Failed";

        $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TOTAL
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hpwTotal.'
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 7px; vertical-align: middle; line-height: 0.45cm;">GENERAL AVERAGE:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$general_average.'
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$final_remark.'
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


$pdf->setY(288);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
if (!empty($student_id)) {
    $gradeLevel = 'Grade 8';
    
    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    $sql = "SELECT
                attendance.*,
                months.*,
                class.*,
                class_students.*
            FROM
                attendance
            JOIN
                months ON months.id = attendance.month_id
            JOIN
                class ON class.id = attendance.class_id
            JOIN
                class_students ON class_students.class_id = class.id
            WHERE
                attendance.student_id = $student_id
                AND class_students.student_id = $student_id
                AND attendance.school_year_id = class_students.school_year_id
                AND class.gradeLevel = '$gradeLevel'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $g8_school_year = $row['school_year_id'];
        $g8_class_id = $row['class_id']; 
    } else {
        $g8_class_id = '';
        $g8_school_year = '';
    }
} else {
    $g8_class_id = '';
    $g8_school_year = '';
}

$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
           
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">ATTENDANCE</td>';

if (!empty($g8_school_year)) {
    $query_class_start_month = "SELECT class_start FROM academic_calendar WHERE id = $g8_school_year";
    $query_run_class_start_month = mysqli_query($conn, $query_class_start_month);
    $row_class_start_month = mysqli_fetch_assoc($query_run_class_start_month);
    $class_start_month = date("F", strtotime($row_class_start_month['class_start']));

    $months = array($class_start_month);
    for ($i = 1; $i < 12; $i++) {
        $months[] = date("F", strtotime("$class_start_month + $i month"));
    }

    $orderClause = "FIELD(monthName, '" . implode("', '", $months) . "')";

    $query1 = "SELECT m.monthName, m.daysInMonth, m.id as month_id
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = $g8_school_year
              ORDER BY $orderClause";
    $query_run = mysqli_query($conn, $query1);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            $shortMonthName = date("M", strtotime($row1["monthName"]));
            $month_id = $row1["month_id"];
            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">'. strtoupper($shortMonthName) .'</td>';
        }
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">TOTAL</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS OF SCHOOL</td>';

$totalSchoolDays = 0;

if (!empty($g8_school_year)) {
    $query2 = "SELECT m.id, m.daysInMonth
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = '$g8_school_year'
              ORDER BY $orderClause";

    $query_run = mysqli_query($conn, $query2);

    if ($query_run) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $row1["daysInMonth"] . '</td>';
            $totalSchoolDays += $row1["daysInMonth"];
        }
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">'. $totalSchoolDays .'</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS PRESENT</td>';

$totalDaysPresent = 0;

if (!empty($g8_school_year) && !empty($g8_class_id)) {
    $query_run_months = mysqli_query($conn, $query2);

    if ($query_run_months) {
        while ($row_month = mysqli_fetch_assoc($query_run_months)) {
            $month_id = $row_month['id'];
            $daysInMonth = $row_month['daysInMonth'];
            $attendance_query = "SELECT a.daysPresent, m.id as m_id
                                 FROM attendance a
                                 RIGHT JOIN months m ON a.month_id = m.id
                                 WHERE a.student_id = '$student_id' AND a.class_id = '$g8_class_id' AND a.school_year_id = '$g8_school_year' AND m.id = '$month_id'";

            $attendance_result = mysqli_query($conn, $attendance_query);
            $attendance_row = mysqli_fetch_assoc($attendance_result);
            $daysPresent = isset($attendance_row['daysPresent']) ? $attendance_row['daysPresent'] : $daysInMonth;
            $totalDaysPresent += $daysPresent;

            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $daysPresent . '</td>';
        }

        $html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $totalDaysPresent . '</td>';
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '</tr>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(300);
$pdf->setX(25);
$pdf->SetFont('helvetica', 'N', 9);
$pdf->Cell(0, 1.0, 'Total number of years in school to date   …………….', 0, 1, 'L');

$pdf->AddPage();

// GRADE IX

$pdf->setY(5);
$pdf->setX(25);
$pdf->SetFont('helvetica', 'N', 8);
$pdf->Cell(0, 1.0, 'Classified as:', 0, 1, 'L');

$pdf->setY(10);

$pdf->SetLeftMargin(26);
$pdf->SetRightMargin(16.5);
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.10cm; font-family: helvetica, sans-serif; font-size: 8px;">Grade:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .35cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">IX
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.08cm; font-family: helvetica, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 8px;">School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 8.27cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY-TNEU ARASOF-NASUGBU
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.8cm; font-family: helvetica, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.82cm; font-family: helvetica, sans-serif; font-size: 8px;">School Year:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 1.9cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">';

if (!empty($student_id)) {
    $gradeLevel = 'Grade 9';

    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    // Escape the student_id to prevent SQL injection
    $student_id = $conn->real_escape_string($student_id);

    $sql = "SELECT
                c.*,
                cs.*,
                ac.*
            FROM
                class c
            JOIN
                class_students cs ON cs.class_id = c.id
            JOIN
                academic_calendar ac ON c.school_year_id = ac.id
            WHERE
                cs.student_id = '$student_id'
                AND c.gradeLevel = '$gradeLevel'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $g8_academic_year = "$start_year - $end_year";
    } else {
        $g8_academic_year = '';
    }
} else {
    $g8_academic_year = '';
}

$html .= $g8_academic_year . '</td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: normal; width: 3.64cm; font-family: times, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.22cm; font-family: times, sans-serif; font-size: 8px; border-bottom: .6px solid black;">Formerly Apolinario R. Apacible School of Fisheries
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);


$pdf->setY(19);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border="0.45" style="border-collapse: collapse; width: 100%;">
            <tr>
                <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE CODE</td>
                <td rowspan="2" style="text-align: center; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE TITLE</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">CONTACT</td>
                <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">GRADING PERIOD</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">C.S</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">ACTION</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">HOURS</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">1</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">2</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">AVERAGE</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TAKEN</td>
            </tr>';

if (!empty($student_id)) {
    $query_subjects = "SELECT l.mapeh_name, l.id as load_id, l.hours_per_week, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 9'";

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


            $q1_grade = isset($row['q1_grade']) ? (int)$row['q1_grade'] : 0;
            $q2_grade = isset($row['q2_grade']) ? (int)$row['q2_grade'] : 0;
            $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
            $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;

            if (strpos($course_code, 'MAPEH') !== false) {
                $mapeh_grades['q1_grade'] += $q1_grade;
                $mapeh_grades['q2_grade'] += $q2_grade;
                $mapeh_grades['q3_grade'] += $q3_grade;
                $mapeh_grades['q4_grade'] += $q4_grade;
                $mapeh_grades['count']++;

                $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $individual_mapeh_subjects[] = [
                    'title' => $subject_title,
                    'course_code' => $course_code,
                    'q1_grade' => $q1_grade,
                    'q2_grade' => $q2_grade,
                    'q3_grade' => $q3_grade,
                    'q4_grade' => $q4_grade,
                    'average_grade' => $average_grade,
                    'remarks' => $remarks
                ];
            } else {
                $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);
                $final_rating = $average_grade;
                $final_ratings[] = $final_rating;
                $hpwTotals[] = $hours_per_week;
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$course_code.'</td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hours_per_week.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$average_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$remarks.'</td>
                </tr>';
            }
        }

        if ($mapeh_grades['count'] > 0) {
            $mapeh_q1_avg = round($mapeh_grades['q1_grade'] / $mapeh_grades['count']);
            $mapeh_q2_avg = round($mapeh_grades['q2_grade'] / $mapeh_grades['count']);
            $mapeh_q3_avg = round($mapeh_grades['q3_grade'] / $mapeh_grades['count']);
            $mapeh_q4_avg = round($mapeh_grades['q4_grade'] / $mapeh_grades['count']);
            $mapeh_final_rating = round(($mapeh_q1_avg + $mapeh_q2_avg + $mapeh_q3_avg + $mapeh_q4_avg) / 4);
            $final_ratings[] = $mapeh_final_rating;
            $hpwTotals[] = $hours_per_week;
            $mapeh_remarks = ($mapeh_final_rating >= 75) ? "Passed" : "Failed";

            $html .= '<tr>
                <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">MAPEH</td>
                <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;"></td>
                <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hours_per_week.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q1_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q2_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q3_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q4_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_final_rating.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_remarks.'</td>
            </tr>';

            foreach ($individual_mapeh_subjects as $mapeh_subject) {
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;'.$mapeh_subject['title'].'</td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">' . preg_replace('/\d+/', '', htmlspecialchars($mapeh_subject['title'])) . '</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;"></td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q1_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q2_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q3_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q4_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['average_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['remarks'].'</td>
                </tr>';
            }
        }

        $general_average = round(array_sum($final_ratings) / count($final_ratings));
        $hpwTotal = array_sum($hpwTotals);
        $final_remark = ($general_average >= 75) ? "Passed" : "Failed";

        $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TOTAL
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hpwTotal.'
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 7px; vertical-align: middle; line-height: 0.45cm;">GENERAL AVERAGE:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$general_average.'
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$final_remark.'
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


$pdf->setY(103);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
if (!empty($student_id)) {
    $gradeLevel = 'Grade 9';
    
    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    $sql = "SELECT
                attendance.*,
                months.*,
                class.*,
                class_students.*
            FROM
                attendance
            JOIN
                months ON months.id = attendance.month_id
            JOIN
                class ON class.id = attendance.class_id
            JOIN
                class_students ON class_students.class_id = class.id
            WHERE
                attendance.student_id = $student_id
                AND class_students.student_id = $student_id
                AND attendance.school_year_id = class_students.school_year_id
                AND class.gradeLevel = '$gradeLevel'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $g9_school_year = $row['school_year_id'];
        $g8_class_id = $row['class_id']; 
    } else {
        $g8_class_id = '';
        $g9_school_year = '';
    }
} else {
    $g8_class_id = '';
    $g9_school_year = '';
}

$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
           
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">ATTENDANCE</td>';

if (!empty($g9_school_year)) {
    $query_class_start_month = "SELECT class_start FROM academic_calendar WHERE id = $g9_school_year";
    $query_run_class_start_month = mysqli_query($conn, $query_class_start_month);
    $row_class_start_month = mysqli_fetch_assoc($query_run_class_start_month);
    $class_start_month = date("F", strtotime($row_class_start_month['class_start']));

    $months = array($class_start_month);
    for ($i = 1; $i < 12; $i++) {
        $months[] = date("F", strtotime("$class_start_month + $i month"));
    }

    $orderClause = "FIELD(monthName, '" . implode("', '", $months) . "')";

    $query1 = "SELECT m.monthName, m.daysInMonth, m.id as month_id
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = $g9_school_year
              ORDER BY $orderClause";
    $query_run = mysqli_query($conn, $query1);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            $shortMonthName = date("M", strtotime($row1["monthName"]));
            $month_id = $row1["month_id"];
            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">'. strtoupper($shortMonthName) .'</td>';
        }
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">TOTAL</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS OF SCHOOL</td>';

$totalSchoolDays = 0;

if (!empty($g9_school_year)) {
    $query2 = "SELECT m.id, m.daysInMonth
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = '$g9_school_year'
              ORDER BY $orderClause";

    $query_run = mysqli_query($conn, $query2);

    if ($query_run) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $row1["daysInMonth"] . '</td>';
            $totalSchoolDays += $row1["daysInMonth"];
        }
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">'. $totalSchoolDays .'</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS PRESENT</td>';

$totalDaysPresent = 0;

if (!empty($g9_school_year) && !empty($g8_class_id)) {
    $query_run_months = mysqli_query($conn, $query2);

    if ($query_run_months) {
        while ($row_month = mysqli_fetch_assoc($query_run_months)) {
            $month_id = $row_month['id'];
            $daysInMonth = $row_month['daysInMonth'];
            $attendance_query = "SELECT a.daysPresent, m.id as m_id
                                 FROM attendance a
                                 RIGHT JOIN months m ON a.month_id = m.id
                                 WHERE a.student_id = '$student_id' AND a.class_id = '$g8_class_id' AND a.school_year_id = '$g9_school_year' AND m.id = '$month_id'";

            $attendance_result = mysqli_query($conn, $attendance_query);
            $attendance_row = mysqli_fetch_assoc($attendance_result);
            $daysPresent = isset($attendance_row['daysPresent']) ? $attendance_row['daysPresent'] : $daysInMonth;
            $totalDaysPresent += $daysPresent;

            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $daysPresent . '</td>';
        }

        $html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $totalDaysPresent . '</td>';
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '</tr>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(115);
$pdf->setX(25);
$pdf->SetFont('helvetica', 'N', 9);
$pdf->Cell(0, 1.0, 'Total number of years in school to date   …………….', 0, 1, 'L');

// Grade X

$pdf->setY(120.5);
$pdf->setX(25);
$pdf->SetFont('helvetica', 'N', 8);
$pdf->Cell(0, 1.0, 'Classified as:', 0, 1, 'L');

$pdf->setY(125.5);

$pdf->SetLeftMargin(26);
$pdf->SetRightMargin(16.5);
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.10cm; font-family: helvetica, sans-serif; font-size: 8px;">Grade:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .35cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">X
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.08cm; font-family: helvetica, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 8px;">School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 8.27cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY-TNEU ARASOF-NASUGBU
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.8cm; font-family: helvetica, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.82cm; font-family: helvetica, sans-serif; font-size: 8px;">School Year:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 1.9cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">';

if (!empty($student_id)) {
    $gradeLevel = 'Grade 10';

    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    // Escape the student_id to prevent SQL injection
    $student_id = $conn->real_escape_string($student_id);

    $sql = "SELECT
                c.*,
                cs.*,
                ac.*
            FROM
                class c
            JOIN
                class_students cs ON cs.class_id = c.id
            JOIN
                academic_calendar ac ON c.school_year_id = ac.id
            WHERE
                cs.student_id = '$student_id'
                AND c.gradeLevel = '$gradeLevel'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $g10_academic_year = "$start_year - $end_year";
    } else {
        $g10_academic_year = '';
    }
} else {
    $g10_academic_year = '';
}

$html .= $g10_academic_year . '</td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: normal; width: 3.64cm; font-family: times, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.22cm; font-family: times, sans-serif; font-size: 8px; border-bottom: .6px solid black;">Formerly Apolinario R. Apacible School of Fisheries
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);


$pdf->setY(134.5);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border="0.45" style="border-collapse: collapse; width: 100%;">
            <tr>
                <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE CODE</td>
                <td rowspan="2" style="text-align: center; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE TITLE</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">CONTACT</td>
                <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">GRADING PERIOD</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">C.S</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">ACTION</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">HOURS</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">1</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">2</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3</td>
                <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4</td>
                <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">AVERAGE</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TAKEN</td>
            </tr>';

if (!empty($student_id)) {
    $query_subjects = "SELECT l.mapeh_name, l.id as load_id, l.hours_per_week, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 10'";

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


            $q1_grade = isset($row['q1_grade']) ? (int)$row['q1_grade'] : 0;
            $q2_grade = isset($row['q2_grade']) ? (int)$row['q2_grade'] : 0;
            $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
            $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;

            if (strpos($course_code, 'MAPEH') !== false) {
                $mapeh_grades['q1_grade'] += $q1_grade;
                $mapeh_grades['q2_grade'] += $q2_grade;
                $mapeh_grades['q3_grade'] += $q3_grade;
                $mapeh_grades['q4_grade'] += $q4_grade;
                $mapeh_grades['count']++;

                $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $individual_mapeh_subjects[] = [
                    'title' => $subject_title,
                    'course_code' => $course_code,
                    'q1_grade' => $q1_grade,
                    'q2_grade' => $q2_grade,
                    'q3_grade' => $q3_grade,
                    'q4_grade' => $q4_grade,
                    'average_grade' => $average_grade,
                    'remarks' => $remarks
                ];
            } else {
                $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);
                $final_rating = $average_grade;
                $final_ratings[] = $final_rating;
                $hpwTotals[] = $hours_per_week;
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$course_code.'</td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hours_per_week.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$average_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$remarks.'</td>
                </tr>';
            }
        }

        if ($mapeh_grades['count'] > 0) {
            $mapeh_q1_avg = round($mapeh_grades['q1_grade'] / $mapeh_grades['count']);
            $mapeh_q2_avg = round($mapeh_grades['q2_grade'] / $mapeh_grades['count']);
            $mapeh_q3_avg = round($mapeh_grades['q3_grade'] / $mapeh_grades['count']);
            $mapeh_q4_avg = round($mapeh_grades['q4_grade'] / $mapeh_grades['count']);
            $mapeh_final_rating = round(($mapeh_q1_avg + $mapeh_q2_avg + $mapeh_q3_avg + $mapeh_q4_avg) / 4);
            $final_ratings[] = $mapeh_final_rating;
            $hpwTotals[] = $hours_per_week;
            $mapeh_remarks = ($mapeh_final_rating >= 75) ? "Passed" : "Failed";

            $html .= '<tr>
                <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">MAPEH</td>
                <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;"></td>
                <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hours_per_week.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q1_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q2_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q3_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_q4_avg.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_final_rating.'</td>
                <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_remarks.'</td>
            </tr>';

            foreach ($individual_mapeh_subjects as $mapeh_subject) {
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;'.$mapeh_subject['title'].'</td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">' . preg_replace('/\d+/', '', htmlspecialchars($mapeh_subject['title'])) . '</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;"></td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q1_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q2_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q3_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['q4_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['average_grade'].'</td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$mapeh_subject['remarks'].'</td>
                </tr>';
            }
        }

        $general_average = round(array_sum($final_ratings) / count($final_ratings));
        $hpwTotal = array_sum($hpwTotals);
        $final_remark = ($general_average >= 75) ? "Passed" : "Failed";

        $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TOTAL
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$hpwTotal.'
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 7px; vertical-align: middle; line-height: 0.45cm;">GENERAL AVERAGE:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$general_average.'
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">'.$final_remark.'
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


$pdf->setY(220.5);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
if (!empty($student_id)) {
    $gradeLevel = 'Grade 10';
    
    // Escape the grade level input to prevent SQL injection
    $gradeLevel = $conn->real_escape_string($gradeLevel);
    
    $sql = "SELECT
                attendance.*,
                months.*,
                class.*,
                class_students.*
            FROM
                attendance
            JOIN
                months ON months.id = attendance.month_id
            JOIN
                class ON class.id = attendance.class_id
            JOIN
                class_students ON class_students.class_id = class.id
            WHERE
                attendance.student_id = $student_id
                AND class_students.student_id = $student_id
                AND attendance.school_year_id = class_students.school_year_id
                AND class.gradeLevel = '$gradeLevel'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $g10_school_year = $row['school_year_id'];
        $g10_class_id = $row['class_id']; 
    } else {
        $g10_class_id = '';
        $g10_school_year = '';
    }
} else {
    $g10_class_id = '';
    $g10_school_year = '';
}

$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
           
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">ATTENDANCE</td>';

if (!empty($g10_school_year)) {
    $query_class_start_month = "SELECT class_start FROM academic_calendar WHERE id = $g10_school_year";
    $query_run_class_start_month = mysqli_query($conn, $query_class_start_month);
    $row_class_start_month = mysqli_fetch_assoc($query_run_class_start_month);
    $class_start_month = date("F", strtotime($row_class_start_month['class_start']));

    $months = array($class_start_month);
    for ($i = 1; $i < 12; $i++) {
        $months[] = date("F", strtotime("$class_start_month + $i month"));
    }

    $orderClause = "FIELD(monthName, '" . implode("', '", $months) . "')";

    $query1 = "SELECT m.monthName, m.daysInMonth, m.id as month_id
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = $g10_school_year
              ORDER BY $orderClause";
    $query_run = mysqli_query($conn, $query1);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            $shortMonthName = date("M", strtotime($row1["monthName"]));
            $month_id = $row1["month_id"];
            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">'. strtoupper($shortMonthName) .'</td>';
        }
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">TOTAL</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS OF SCHOOL</td>';

$totalSchoolDays = 0;

if (!empty($g10_school_year)) {
    $query2 = "SELECT m.id, m.daysInMonth
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = '$g10_school_year'
              ORDER BY $orderClause";

    $query_run = mysqli_query($conn, $query2);

    if ($query_run) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $row1["daysInMonth"] . '</td>';
            $totalSchoolDays += $row1["daysInMonth"];
        }
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">'. $totalSchoolDays .'</td>
        </tr>
        <tr>
            <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS PRESENT</td>';

$totalDaysPresent = 0;

if (!empty($g10_school_year) && !empty($g10_class_id)) {
    $query_run_months = mysqli_query($conn, $query2);

    if ($query_run_months) {
        while ($row_month = mysqli_fetch_assoc($query_run_months)) {
            $month_id = $row_month['id'];
            $daysInMonth = $row_month['daysInMonth'];
            $attendance_query = "SELECT a.daysPresent, m.id as m_id
                                 FROM attendance a
                                 RIGHT JOIN months m ON a.month_id = m.id
                                 WHERE a.student_id = '$student_id' AND a.class_id = '$g10_class_id' AND a.school_year_id = '$g10_school_year' AND m.id = '$month_id'";

            $attendance_result = mysqli_query($conn, $attendance_query);
            $attendance_row = mysqli_fetch_assoc($attendance_result);
            $daysPresent = isset($attendance_row['daysPresent']) ? $attendance_row['daysPresent'] : $daysInMonth;
            $totalDaysPresent += $daysPresent;

            $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $daysPresent . '</td>';
        }

        $html .= '<td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">' . $totalDaysPresent . '</td>';
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;"></td>';
    }
}

$html .= '</tr>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(232.5);
$pdf->setX(25);
$pdf->SetFont('helvetica', 'N', 9);
$pdf->Cell(0, 1.0, 'Total number of years in school to date   …………….', 0, 1, 'L');

$pdf->setY(263);

$pdf->setX(15);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 1.0, 'REMARKS', 0, 0, 'C');

$pdf->setx(19);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 28, 'Remarks on health, character, and habits of the pupil __________________________________________', 0, 0, 'L');

$pdf->setx(19);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 38, '_______________________________________________________________ .', 0, 0, 'L');

$pdf->setY(307);

$pdf->setX(155);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 20, 'ERWIN R. ABIAD', 0, 0, 'C');

$pdf->setx(17);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 28, 'Head, Registration Services', 0, 0, 'R');




$pdf->setY(-10);
$pdf->SetFont('times', '', 10);

$filename = "Kinder_form138_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';
?>