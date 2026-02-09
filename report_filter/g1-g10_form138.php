<?php
$adviser2 = isset($adviser2) ? $adviser2 : '';
$principal = isset($principal) ? $principal : '';
$studentName = isset($studentName) ? $studentName : '';
$lrn = isset($lrn) ? $lrn : '';
$age = isset($age) ? $age : '';
$gender = isset($gender) ? $gender : '';
$academic_year = isset($academic_year) ? $academic_year : '';
$gradeLevel = isset($gradeLevel) ? $gradeLevel : '';
$section = isset($section) ? $section : '';


ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class G1G10ReportCard extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);

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
   }

   public function Header()
   {
      
    }
    // Page footer
    public function Footer() {

    }
}


// Example usage
$pdf = new G1G10ReportCard('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Grade 1-10 Form 138');

$pdf->AddPage();

$pdf->Image('../assets/img/bsulogo.jpg', 35, 5.5, 35);
       // Add text and font
$pdf->SetFont('times', 'B', 8);
$pdf->Cell(0, 1.0, 'Republic of the Philippines', 0, 1, 'C');
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 1.0, 'BATANGAS STATE UNIVERSITY', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetTextColor(210, 54, 59); // Red color
$pdf->Cell(0, 1.0, 'The National Engineering University', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('times', 'B', 8);
$pdf->Cell(0, 1.0, 'ARASOF-Nasugbu Campus', 0, 1, 'C');
$pdf->SetFont('times', 'B', 7.5);
$pdf->Cell(0, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas, Philippines 4231', 0, 1, 'C');


$pdf->setY(33);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 1.0, 'LABORATORY SCHOOL', 0, 1, 'C'); 
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 0, 'Junior High School', 0, 1, 'C');


$pdf->setY(45);
$pdf->SetLeftMargin(13);
$pdf->SetRightMargin(13);
// Add HTML table

$html = '<table >
       
            <tr>
                <td style="text-align: left; font-weight: normal; width: 1.4cm; font-family: helvetica, sans-serif; font-size: 12px;">Name:</td>
                <td style="text-align: left; font-weight: bold; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px; border-bottom: 1px solid black;">'. $studentName .'</td>
            </tr>

            <tr>
               <td style="text-align: left; font-weight: normal; width: 1.2cm; font-family: helvetica, sans-serif; font-size: 12px;">LRN:</td>
               <td style="text-align: left; font-weight: bold; width: 5cm; font-family: helvetica, sans-serif; font-size: 12px; border-bottom: 1px solid black;">'. $lrn .'</td> 
            </tr>

            <tr>
                <td style="text-align: left; font-weight: normal; width: 1.2cm; font-family: helvetica, sans-serif; font-size: 12px;">Age:</td>
                <td style="text-align: left; font-weight: bold; width: 5cm; font-family: helvetica, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $age .' </td>
                <td style="text-align: left; font-weight: bold; width: 5.5cm; font-family: helvetica, sans-serif; font-size: 12px;"></td>
                <td style="text-align: left; font-weight: normal; width: 1.2cm; font-family: helvetica, sans-serif; font-size: 12px;">Sex:</td>
               <td style="text-align: left; font-weight: bold; width: 5cm; font-family: helvetica, sans-serif; font-size: 11px;border-bottom: 1px solid black;">'. $gender .'  
    </td>
            </tr>

             <tr>
                <td style="text-align: left; font-weight: normal; width: 1.6cm; font-family: helvetica, sans-serif; font-size: 12px;">Grade:</td>
                <td style="text-align: left; font-weight: bold; width: 4.6cm; font-family: helvetica, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $gradeLevel .' </td>
                <td style="text-align: left; font-weight: bold; width: 5.5cm; font-family: helvetica, sans-serif; font-size: 12px;"></td>
                <td style="text-align: left; font-weight: normal; width: 1.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Section:</td>
                <td style="text-align: left; font-weight: bold; width: 4.4cm; font-family: helvetica, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $section .' </td>
            </tr>

            <tr>
               <td style="text-align: left; font-weight: normal; width: 2.7cm; font-family: helvetica, sans-serif; font-size: 12px;">School Year:</td>
               <td style="text-align: left; font-weight: bold; width: 3.5cm; font-family: helvetica, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $academic_year .'</td>  
            </tr>
            
        </table>';

$pdf->writeHTML($html);
$pdf->SetFont('times', 'N', 13);
$pdf->Cell(0, 1.0, 'Dear Parent:', 0, 1, 'L');
$pdf->setX(30);
$pdf->SetFont('times', 'N', 13);
$pdf->Cell(0, 1.0, 'This report card shows the ability and progress your child has made in the different learning', 0, 1, 'L');
$pdf->SetFont('times', 'N', 13);
$pdf->Cell(0, 1.0, 'areas as well as his/her core values.', 0, 1, 'L');
$pdf->setX(30);
$pdf->SetFont('times', 'N', 13);
$pdf->Cell(0, 1.0, 'The school welcomes you, should you desire to know more about your child’s progress.', 0, 0, 'L');
$pdf->ln();
$pdf->ln();

$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 1.0, $adviser2, 0, 1, 'R');
$pdf->SetFont('helvetica', 'N', 11);
$pdf->setX(160);
$pdf->Cell(0, 1.0, 'Adviser', 0, 1, 'L');
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 1.0, $principal, 0, 1, 'L');
$pdf->SetFont('helvetica', 'N', 11);
$pdf->setX(36);
$pdf->Cell(0, 1.0, 'Principal', 0, 1, 'L');
$pdf->SetFont('helvetica', 'B', 11);

// $pdf->SetFont('helvetica', 'B', 11);
// $pdf->Cell(0, 1.0, $adviser2, 0, 1, 'C');
// $pdf->SetFont('helvetica', 'N', 11);
// $pdf->Cell(0, 1.0, 'Adviser', 0, 1, 'C');
// $pdf->SetFont('helvetica', 'B', 11);
// $pdf->Cell(0, 1.0, $principal, 0, 1, 'C');
// $pdf->SetFont('helvetica', 'N', 11);
// $pdf->Cell(0, 1.0, 'Principal', 0, 1, 'C');
$pdf->Cell(0, 2.5, 'REPORT ON LEARNING PROGRESS AND ACHIEVEMENT', 0, 1, 'C');

$html = '<table border="1" style="border-colapse: collapse; width: 100%">

                <tr>
                    <td rowspan="2"style="text-align: center; font-weight: bold; width: 8cm; line-height: 1.5cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">Learning Areas
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6cm;  line-height: 0.60cm;font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">Quarter
                    </td>

                    <td rowspan="2"style="text-align: center; font-weight: bold; width: 2.5cm; line-height: .70cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">Final Grade

                    </td>

                    <td rowspan="2"style="text-align: center; font-weight: bold; width: 2.5cm; line-height: 1.5cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">Remarks
                    </td>

                    
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">4
                    </td>
                </tr>';


if (!empty($school_year) && !empty($class_id) && !empty($student_id)) {
// Update your SQL query to select the course code
$query_subjects = "SELECT l.mapeh_name, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                    FROM subject_grades sg
                    JOIN loads l ON sg.load_id = l.id 
                    JOIN subjects s ON l.subject_id = s.id 
                    WHERE sg.student_id = $student_id AND l.class_id = $class_id AND l.school_year_id = $school_year";

$query_run = mysqli_query($conn, $query_subjects);

$mapeh_grades = [
        'q1_grade' => 0,
        'q2_grade' => 0,
        'q3_grade' => 0,
        'q4_grade' => 0,
        'count' => 0
    ];

    $individual_mapeh_subjects = [];
    $final_ratings = []; // Array to store final ratings of all subjects

    // Arrays to store quarter-specific grades
    $q1_grades = [];
    $q2_grades = [];
    $q3_grades = [];
    $q4_grades = [];

if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        $subject_title = !empty($row['mapeh_name']) ? $row['mapeh_name'] : $row['courseTitle'];
        $course_code = $row['courseCode'];

        $q1_grade = isset($row['q1_grade']) ? (int)$row['q1_grade'] : 0;
        $q2_grade = isset($row['q2_grade']) ? (int)$row['q2_grade'] : 0;
        $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
        $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;

        // Aggregate MAPEH grades
        if (strpos($course_code, 'MAPEH') !== false) {
            $mapeh_grades['q1_grade'] += $q1_grade;
            $mapeh_grades['q2_grade'] += $q2_grade;
            $mapeh_grades['q3_grade'] += $q3_grade;
            $mapeh_grades['q4_grade'] += $q4_grade;
            $mapeh_grades['count']++;

            // Store individual MAPEH subject grades
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
            // Calculate average grade
            $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);

            // Get final rating based on average grade
            $final_rating = $average_grade;
            $final_ratings[] = $final_rating; // Store final rating

            // Determine remarks based on average grade
            $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

            // Append table rows with data and row number
            $html .= '<tr>
                <td style="text-align: left; font-weight: bold; width: 8cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$subject_title.'</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$q1_grade.'</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$q2_grade.'</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$q3_grade.'</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$q4_grade.'</td>
                <td style="text-align: center; font-weight: bold; width: 2.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$final_rating.'</td>
                <td style="text-align: center; font-weight: bold; width: 2.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$remarks.'</td>
            </tr>';
        }
    }

    // Process consolidated MAPEH grades
    if ($mapeh_grades['count'] > 0) {
        $average_q1 = round($mapeh_grades['q1_grade'] / $mapeh_grades['count']);
        $average_q2 = round($mapeh_grades['q2_grade'] / $mapeh_grades['count']);
        $average_q3 = round($mapeh_grades['q3_grade'] / $mapeh_grades['count']);
        $average_q4 = round($mapeh_grades['q4_grade'] / $mapeh_grades['count']);

        // Calculate average grade
        $average_grade = round(($average_q1 + $average_q2 + $average_q3 + $average_q4) / 4);

        // Get final rating based on average grade
        $final_rating = $average_grade;
        $final_ratings[] = $final_rating; // Store final rating for MAPEH
        // Determine remarks based on average grade
        $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

        // Retrieve the course code for MAPEH
        $mapeh_course_code = $individual_mapeh_subjects[0]['course_code']; // Assuming there's at least one MAPEH subject

        // Append MAPEH consolidated row using the course code
        $html .= '<tr>
            <td style="text-align: left; font-weight: bold; width: 8cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$mapeh_course_code.'</td>
            <td style="text-align: center; font-weight: bold; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$average_q1.'</td>
            <td style="text-align: center; font-weight: bold; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$average_q2.'</td>
            <td style="text-align: center; font-weight: bold; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$average_q3.'</td>
            <td style="text-align: center; font-weight: bold; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$average_q4.'</td>
            <td style="text-align: center; font-weight: bold; width: 2.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$final_rating.'</td>
            <td style="text-align: center; font-weight: bold; width: 2.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$remarks.'</td>
        </tr>';

        // Append individual MAPEH subject rows
        foreach ($individual_mapeh_subjects as $subject) {
            $html .= '<tr>
                <td style="text-align: left; font-weight: normal; width: 8cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; padding-left: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$subject['title'].'</td>
                <td style="text-align: center; font-weight: normal; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$subject['q1_grade'].'</td>
                <td style="text-align: center; font-weight: normal; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$subject['q2_grade'].'</td>
                <td style="text-align: center; font-weight: normal; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$subject['q3_grade'].'</td>
                <td style="text-align: center; font-weight: normal; width: 1.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$subject['q4_grade'].'</td>
                <td style="text-align: center; font-weight: normal; width: 2.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$subject['average_grade'].'</td>
                <td style="text-align: center; font-weight: normal; width: 2.5cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">'.$subject['remarks'].'</td>
            </tr>';
        }
    }

    $general_average = !empty($final_ratings) ? round(array_sum($final_ratings) / count($final_ratings)) : 0;

    // Append the row for general average
    $html .= '<tr>
        <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; margin: 5px;"></td>
        <td style="text-align: center; font-weight: bold; width: 6cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">General Average</td>
        <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">'.$general_average.'</td>
        <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;"></td>
    </tr>';

} else {
    $html .= '<tr><td colspan="7" style="text-align: center;">No grades found for this student</td></tr>';
}

} else {
    $html .= '
<tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;</td>


                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; </td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; </td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; margin: 5px;"></td>

                    <td style="text-align: center; font-weight: bold; width: 6cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">General Average
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>
    ';
}

$html .= '</table>';

$pdf->writeHTML($html);


$html = '<table border="1" style="border-colapse: collapse; width: 100%">
                <tr>
                    <td  style="text-align: center; font-weight: bold; width: 4.1cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px; background-color: #f0f0f0;"></td>';

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

    $query1 = "SELECT m.monthName, m.daysInMonth, m.id as month_id
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = $school_year
              ORDER BY $orderClause";
    $query_run = mysqli_query($conn, $query1);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            // Modify the month name format to show the short form (e.g., Jan)
            $shortMonthName = date("M", strtotime($row1["monthName"]));
            $month_id = $row1["month_id"];
            $html .= '<td style="text-align: center; font-weight: bold; width: 1.2cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">'. strtoupper($shortMonthName) .'</td>';
        }
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.2cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;"></td>';
    }
}

$html .= '<td  style="text-align: center; font-weight: bold; width: 1.7cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">Total
        </td>
        </tr>

        <tr>
            <td style="text-align: left; font-weight: bold; width: 4.1cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">&nbsp;&nbsp;No. of school days
            </td>';

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';

if (!empty($school_year)) {
    $query2 = "SELECT m.id, m.daysInMonth
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = '$school_year'
              ORDER BY $orderClause";

    $query_run = mysqli_query($conn, $query2);

    $totalSchoolDays = 0;

    if ($query_run) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            // Calculate width for each column dynamically
            $columnWidth = 0.81;
            $html .= '<td style="text-align: center; font-weight: bold; width: 1.2cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">' . $row1["daysInMonth"] . '</td>';
            $totalSchoolDays += $row1["daysInMonth"];
        }
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.2cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: bold; width: 1.7cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">'. $totalSchoolDays .'
          </td>
     
        </tr>

        <tr>

                    <td style="text-align: left; font-weight: bold; width: 4.1cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">&nbsp;&nbsp;No. of days present
                    </td>';

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

$html .= ''; // Remove the line that initializes $html variable

if (!empty($school_year) && !empty($class_id)) {
    $no = 1; // Initialize $no variable

    // Assuming $conn is your database connection object
    $query_run_months = mysqli_query($conn, $query2); // Execute the query to fetch months

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
            $html .= '<td style="text-align: center; font-weight: bold; width: 1.2cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">' . $daysPresent . '</td>';
        }

        // Add the total days present at the end of the row
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.7cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">' . $totalDaysPresent . '</td>';
    } else {
        // If no data available for months
        $html .= "<td colspan='11'>No data available</td>";
    }

    $no++; // Increment $no within the loop
}

$html .= '
             
                </tr>

                 <tr>

                    <td style="text-align: left; font-weight: bold; width: 4.1cm;  line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">&nbsp;&nbsp;No. of days absent
                    </td>';

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

$html .= ''; // Remove the line that initializes $html variable

if (!empty($school_year) && !empty($class_id)) {
    $no = 1; // Initialize $no variable

    // Assuming $conn is your database connection object
    $query_run_months = mysqli_query($conn, $query2); // Execute the query to fetch months

    if ($query_run_months) {
        $totalDaysAbsent = 0; // Initialize totalDaysPresent variable
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

            $daysAbsent = $daysInMonth - $daysPresent;
            $totalDaysAbsent += $daysAbsent; // Accumulate daysPresent to calculate totalDaysPresent

            // Display the value of daysPresent
            $html .= '<td style="text-align: center; font-weight: bold; width: 1.2cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">' . $daysAbsent . '</td>';
        }

        // Add the total days present at the end of the row
        $html .= '<td style="text-align: center; font-weight: 600; width: 1.7cm; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">' . $totalDaysAbsent . '</td>';
    } else {
        // If no data available for months
        $html .= "<td colspan='11'>No data available</td>";
    }

    $no++; // Increment $no within the loop
}

$html .= '</tr></table>';

$pdf->writeHTML($html);

$pdf->setX(55);
$html = '<table >
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 4.8cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;">Descriptors</td>
                    <td style="text-align: center; font-weight: bold; width: 3.5cm; line-height: 0.68cm; font-family: helvetica, sans-serif; font-size: 11px;">Grading Scale
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3cm; font-family: helvetica, sans-serif; font-size: 11px;">Remarks
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.8cm;  font-family: helvetica, sans-serif; font-size: 11px;">Outstanding</td>
                    <td style="text-align: center; font-weight: normal; width: 3.5cm; font-family: helvetica, sans-serif; font-size: 11px;">90 – 100
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3cm; font-family: helvetica, sans-serif; font-size: 11px;">Passed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.8cm;  font-family: helvetica, sans-serif; font-size: 11px;">Very Satisfactory</td>
                    <td style="text-align: center; font-weight: normal; width: 3.5cm; font-family: helvetica, sans-serif; font-size: 11px;">85 – 89
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3cm; font-family: helvetica, sans-serif; font-size: 11px;">Passed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.8cm;  font-family: helvetica, sans-serif; font-size: 11px;">Satisfactory</td>
                    <td style="text-align: center; font-weight: normal; width: 3.5cm; font-family: helvetica, sans-serif; font-size: 11px;">80 – 84
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3cm; font-family: helvetica, sans-serif; font-size: 11px;">Passed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.8cm;  font-family: helvetica, sans-serif; font-size: 11px11px;">Fairly Satisfactory</td>
                    <td style="text-align: center; font-weight: normal; width: 3.5cm; font-family: helvetica, sans-serif; font-size: 11px;">75 – 79
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3cm; font-family: helvetica, sans-serif; font-size: 11px;">Passed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.8cm;  font-family: helvetica, sans-serif; font-size: 11px;">Did not Meet Expectations</td>
                    <td style="text-align: center; font-weight: normal; width: 3.5cm; font-family: helvetica, sans-serif; font-size: 11px;">Below 75
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3cm; font-family: helvetica, sans-serif; font-size: 11px;">Failed
                    </td>
                </tr>
</table>';

$pdf->writeHTML($html);

// another page
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 2.5, 'REPORT ON LEARNER’S OBSERVED VALUES', 0, 1, 'C');
// report on learners observed values table
$pdf->ln();
$html = '<table border="1" style="border-collapse: collapse; width: 100%" >
        
<tr>
    <td style="text-align: center; font-weight: bold; width: 4.1cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">Core Values</td>

    <td style="text-align: center; font-weight: bold; width: 10cm; line-height: 0.68cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">Behavior Statements</td>

    <td style="text-align: center; line-height: 0.68cm; font-weight: bold; width: 5cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">Quarter</td>
</tr>';

$core_values = [
        1 => [
            'core_values' => ['1. Maka-Diyos']
        ],
        2 => [
            'core_values' => ['2. Makatao']
        ],
        3 => [
            'core_values' => ['3. Makakalikasan']
        ],
        4 => [
            'core_values' => ['4. Makabansa']
        ]
    ];

// Define behavior statements
$behavior_statements = [
    1 => [
        'behavior_statements' => ['Expresses one’s spiritual beliefs while respecting <br> the spiritual beliefs of others']
    ],
    2 => [
        'behavior_statements' => ['Shows adherence to ethical principles by upholding <br> truth']
    ],
    3 => [
        'behavior_statements' => ['Is sensitive to individual, social, and cultural <br> differences']
    ],
    4 => [
        'behavior_statements' => ['Demonstrates contributions toward solidarity']
    ],
    5 => [
        'behavior_statements' => ['Cares for the environment and utilizes resources <br> wisely, judiciously, and economically']
    ],
    6 => [
        'behavior_statements' => ['Demonstrates pride in being a Filipino; exercises the <br> rights and responsibilities of a Filipino citizen']
    ],
    7 => [
        'behavior_statements' => ['Demonstrates appropriate behavior in carrying out <br> activities in the school, community, and country']
    ]
];

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

if (!empty($school_year) && !empty($class_id) && !empty($student_id)) {
$fetch_values_query = "SELECT * FROM observe_values_sh WHERE student_id = '$student_id' AND class_id = '$class_id' AND school_year_id = '$school_year'";
$fetch_result = $conn->query($fetch_values_query);

// Define an array to hold observed values
$observed_values = [];

// Populate the observed values array
if ($fetch_result->num_rows > 0) {
    while ($row = $fetch_result->fetch_assoc()) {
        $core_value = $row['core_value'];
        $behavior_statement_index = $row['behavior_statement']; // No need to adjust for zero-based indexing
        $quarter_1 = $row['quarter_1'];
        $quarter_2 = $row['quarter_2'];
        $quarter_3 = $row['quarter_3'];
        $quarter_4 = $row['quarter_4'];

        // Add observed values to the array
        if (!isset($observed_values[$core_value])) {
            $observed_values[$core_value] = [];
            $observed_values[$core_value]['rowspan'] = 0; // Initialize rowspan count
        }

        // Increment rowspan count for the current core value
        $observed_values[$core_value]['rowspan']++;

        $observed_values[$core_value]['data'][$behavior_statement_index] = [
            'behavior_statement' => $behavior_statements[$behavior_statement_index]['behavior_statements'][0], // Assuming there's only one statement per index
            'quarters' => [$quarter_1, $quarter_2, $quarter_3, $quarter_4]
        ];
    }
}
foreach ($observed_values as $core_value => $data) {
    $rowspan = $data['rowspan'];
    $first_behavior_statement_index = array_key_first($data['data']);

    foreach ($data['data'] as $behavior_statement_index => $item) {
        $html .= '<tr>';

        if ($behavior_statement_index === $first_behavior_statement_index) {
            $html .= '<td rowspan="' . $rowspan . '" style="text-align: left font-weight: normal; width: 4.1cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;">' . $core_values[$core_value]['core_values'][0] . '</td>';
        }

        $html .= '<td style="text-align: left; font-weight: normal; width: 10cm; font-family: helvetica, sans-serif; font-size: 11px;">' . $item['behavior_statement'] . '</td>';

        foreach ($item['quarters'] as $ovquarter) {
            $html .= '<td style="text-align: center; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">' . $ovquarter . '</td>';
        }

        $html .= '</tr>';
    }
}
} else {
 $html .= ' <tr>
                    <td rowspan="2" style="text-align: left; line-height: 2cm; font-weight: normal; width: 4.1cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;">1. Makadiyos</td>

                    <td style="text-align: left; font-weight: normal; width: 10cm; font-family: helvetica, sans-serif; font-size: 11px;">Expresses one’s  spiritual beliefs while respecting the <br>spiritual beliefs of others
                    </td>

                    <td style="text-align: center; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>

                    <td style="text-align: center;  line-height: 1cm;font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>

                    <td style="text-align: center; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>

                    <td style="text-align: center;  line-height: 1cm;font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
             
                </tr>

                <tr>
                    
                    <td style="text-align: left; font-weight: normal; width: 10cm; font-family: helvetica, sans-serif; font-size: 11px;">Shows adherence to ethical principles by upholding <br>truth
                    </td>

                    <td style="text-align: center;  line-height: 1cm;font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>

                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>

                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>

                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
             
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: left;  line-height: 2cm; font-weight: normal; width: 4.1cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;">2. Makatao</td>

                    <td style="text-align: left; font-weight: normal; width: 10cm; font-family: helvetica, sans-serif; font-size: 11px;">Is sensitive to individual, social, and cultural <br>differences
                    </td>

                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>

                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
             
                </tr>

                <tr>
                    
                    <td style="text-align: left; font-weight: normal; width: 10cm;  line-height: .80cm;font-family: helvetica, sans-serif; font-size: 11px;">Demonstrates contributions toward solidarity
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
             
                </tr>

                <tr>
                    <td style="text-align: left;  line-height: 1cm;font-weight: normal; width: 4.1cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;">3. Maka-kalikasan</td>

                    <td style="text-align: left; font-weight: normal; width: 10cm; font-family: helvetica, sans-serif; font-size: 11px;">Cares for the environment and utilizes resources <br>wisely, judiciously, and economically
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
             
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: left; font-weight: normal; width: 4.1cm;  line-height: 2cm;font-family: helvetica, sans-serif; font-size: 11px;">4. Makabansa
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 10cm; font-family: helvetica, sans-serif; font-size: 11px;">Demonstrates pride in being a Filipino; exercise the <br>rights and responsibilities of a Filipino citizen
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
             
             
                </tr>

                <tr>
                   
                    <td style="text-align: left; font-weight: normal; width: 10cm; font-family: helvetica, sans-serif; font-size: 11px;">Demonstrates appropriate behavior in carrying out <br>activities in the school, community, and country
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center;  line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">
                    </td>
             
             
                </tr>';
}
$html .= '</table>';

$pdf->writeHTML($html);


// marking table

$pdf->setX(70);
$html = '<table >
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3cm;  font-family: helvetica, sans-serif; normalfont-size: 12px;">Marking</td>
                
                    <td style="text-align: center; font-weight: bold; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Non-numerical Rating
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;"></td>
                 
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Always Observed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;">SO</td>
                   
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Sometimes Observed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;">RO</td>
                    
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Rarely Observed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;  line-height: .50cm;font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;">NO</td>
                    
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Not Observed
                    </td>
                </tr>
                
</table>';

$pdf->writeHTML($html);

// gardian signature table

$html = '<table >
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 19cm;   line-height: 1.5cm; font-family: helvetica, sans-serif; bold;font-size: 14px;">PARENT’S / GUARDIAN’S SIGNATURE</td>
                </tr>

                <tr>
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;"></td>

                    <td style="text-align: left;  line-height: 1.5cm; font-weight: bold; width: 4cm;  font-family: helvetica, sans-serif; font-size: 14px;">First Quarter</td>
                 
                    <td style="text-align: left;  line-height: 1.5cm; font-weight: normal; width: 12cm; font-family: helvetica, sans-serif; font-size: 12px;">__________________________________________
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;"></td>

                    <td style="text-align: left;  line-height: 1.5cm; font-weight: bold; width: 4cm;  font-family: helvetica, sans-serif; font-size: 14px;">Second Quarter</td>
                 
                    <td style="text-align: left;  line-height: 1.5cm; font-weight: normal; width: 12cm; font-family: helvetica, sans-serif; font-size: 12px;">__________________________________________
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;"></td>

                    <td style="text-align: left;  line-height: 1.5cm; font-weight: bold; width: 4cm;  font-family: helvetica, sans-serif; font-size: 14px;">Third Quarter</td>
                 
                    <td style="text-align: left;  line-height: 1.5cm; font-weight: normal; width: 12cm; font-family: helvetica, sans-serif; font-size: 12px;">__________________________________________
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;"></td>

                    <td style="text-align: left;  line-height: 1.5cm; font-weight: bold; width: 4cm;  font-family: helvetica, sans-serif; font-size: 14px;">Fourth Quarter</td>
                 
                    <td style="text-align: left;  line-height: 1.5cm; font-weight: normal; width: 12cm; font-family: helvetica, sans-serif; font-size: 12px;">__________________________________________
                    </td>
                </tr>             
</table>';

$pdf->writeHTML($html);

// certificate to transfer table

$html = '<table>
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 19cm;   line-height: 1.5cm; font-family: helvetica, sans-serif; bold;font-size: 14px;">Certificate of Transfer</td>
                </tr>

                <tr>
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 2.5cm;  font-family: helvetica, sans-serif; font-size: 13px;"></td>

                    <td style="text-align: left;  line-height: .50cm; font-weight: normal; width: 4cm;  font-family: helvetica, sans-serif; font-size: 13px;">Admitted to Grade </td>

                    <td style="text-align: left;  line-height: .50cm; font-weight: bold; width: 5.5cm;  font-family: helvetica, sans-serif; font-size: 13px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;'. $numericGradeLevel .'</td>
                 
                    <td style="text-align: left;  line-height: .50cm; font-weight: normal; width: 1.7cm; font-family: helvetica, sans-serif; font-size: 13px;">Section
                    </td>
                    <td style="text-align: left;  line-height: .50cm; font-weight: bold; width: 4.3cm; font-family: helvetica, sans-serif; font-size: 13px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;'. $section .'
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;  line-height: .78cm; font-weight: normal; width: 2.5cm;  font-family: helvetica, sans-serif; font-size: 13px;"></td>

                    <td style="text-align: left;  line-height: .78cm; font-weight: normal; width: 6.8cm;  font-family: helvetica, sans-serif; font-size: 13px;">Eligibility for Admission to Grade  </td>

                     <td style="text-align: left;  line-height: .70cm; font-weight: bold; width: 5.5cm;  font-family: helvetica, sans-serif; font-size: 13px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;'. $admissionToGradeLevel .'</td>
                 
                    
                </tr>

                        
</table>';

$pdf->writeHTML($html);

$pdf->setY(247);
$pdf->setX(36);
$pdf->SetFont('helvetica', 'N', 13);
$pdf->Cell(0, 2.5, 'Approved:', 0, 1, 'L');

$pdf->ln();
$pdf->ln();
$pdf->setX(38);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(0, 0, 'Dr. ENRICO M. DALANGIN', 0, 0, 'L');

$pdf->setX(120);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(0, 0, $adviser2, 0, 1, 'L');

$pdf->setX(60);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->Cell(0, 0, 'Chancellor', 0, 0, 'L');

$pdf->setX(150);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->Cell(0, 0, 'Adviser', 0, 1, 'L');
$pdf->ln();
$html = '<table >
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 19cm;   line-height: 2cm; font-family: helvetica, sans-serif; bold;font-size: 14px;">Cancellation of Eligibility to Transfer</td>
                </tr>

                <tr>
                    <td style="text-align: center;  line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 13px;"></td>

                    <td style="text-align: left;  line-height: .50cm; font-weight: normal; width: 2.6cm;  font-family: helvetica, sans-serif; font-size: 13px;">Admitted in </td>

                    <td style="text-align: left; font-weight: normal; width: 4cm;  font-family: helvetica, sans-serif; font-size: 13px;border-bottom: 1px solid black;"></td>
    
                </tr>

                <tr>
                    <td style="text-align: center;  font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 13px;"></td>

                    <td style="text-align: left;  font-weight: normal; width: 1.2cm;  font-family: helvetica, sans-serif; font-size: 13px;">Date</td>

                    <td style="text-align: left; font-weight: normal; width: 5.5cm;  font-family: helvetica, sans-serif; font-size: 13px;border-bottom: 1px solid black;"></td>
                 </tr>               
</table>';

$pdf->writeHTML($html);


$pdf->setY(320);
$pdf->setX(130);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(0, 0, 'Dr. ENRICO M. DALANGIN', 0, 1, 'L');

$pdf->setX(145);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->Cell(0, 0, 'Chancellor', 0, 1, 'L');


$filename = "g1-g10_form138_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';
?>