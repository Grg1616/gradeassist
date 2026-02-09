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

class  Kinder extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
       parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
   }

   public function Header()
   {
    $this->Image('../assets/img/bsulogo2.jpg', 21, 85.5, 178, 178);
        
        // Move to the top of the page
        $this->SetY(5); 
    }
}

// Example usage
$pdf = new  Kinder('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Kinder Form 137');

$pdf->AddPage();
   // Add image
// Add image
$pdf->Image('../assets/img/bsulogo.jpg', 40, 2, 31);
// Add text and font
$pdf->SetFont('times', 'N', 9);
$pdf->SetY(5);
$pdf->Cell(0, 1.0, 'Republic of the Philippines', 0, 1, 'C');
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(0, 1.0, 'BATANGAS STATE UNIVERSITY', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetTextColor(210, 54, 59); // Red color
$pdf->Cell(0, 1.0, 'The National Engineering University', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(0, 1.0, 'ARASOF-Nasugbu Campus', 0, 1, 'C');
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(0, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas', 0, 0, 'C');

$pdf->setY(27);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'PROGRESS REPORT CARD', 0, 1, 'C');
$pdf->setY(31);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'In', 0, 1, 'C');
$pdf->setY(35);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'PRE–ELEMENTARY', 0, 0, 'C');



$pdf->setY(43);


$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(50);
// Add HTML table
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.05cm; font-family: times, sans-serif; font-size: 9.5px; ">Name:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 5.50cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;"> '. $studentName .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.84cm; font-family: times, sans-serif; font-size: 9.5px; ">Age:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.41cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;"> '. $age .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.49cm; font-family: times, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.00cm; font-family: times, sans-serif; font-size: 8.40px; ">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.99cm; font-family: times, sans-serif; font-size: 9.5px; ">Date of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 4.56cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;"> '. $birthday .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.06cm; font-family: times, sans-serif; font-size: 9.5px; ">Place of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.80cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 2.71cm; font-family: times, sans-serif; font-size: 9.5px; ">Parent or Guardian:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.84cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;"> '. $guardianName .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.76cm; font-family: times, sans-serif; font-size: 9.5px; ">Occupation: 
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.92cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;"> '. $guardianOccupation .'
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.40cm; font-family: times, sans-serif; font-size: 9.5px; ">Address of Parent or Guardian:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.78cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                  <tr>
                    <td style="text-align: left; font-weight: normal; width: 2.41cm; font-family: times, sans-serif; font-size: 9.5px; ">Date of Entrance:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.00cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 0.78cm; font-family: times, sans-serif; font-size: 9.5px; ">LRN:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 2.90cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;"> '. $lrn .'
                    </td>
                </tr>

        </table>';

$pdf->writeHTML($html);

// GRADE VII

$pdf->setY(72);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(16.5);
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.40cm; font-family: times, sans-serif; font-size: 10px; ">Kinder:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .25cm; font-family: times, sans-serif; font-size: 10px; border-bottom: .6px solid black;">II
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .45cm; font-family: times, sans-serif; font-size: 9.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.29cm; font-family: times, sans-serif; font-size: 10px; ">School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 10.99cm; font-family: times, sans-serif; font-size: 10px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY-TNEU ARASOF-Nasugbu Campus
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .50cm; font-family: times, sans-serif; font-size: 10px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.00cm; font-family: times, sans-serif; font-size: 10px; ">School Year:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 1.90cm; font-family: times, sans-serif; font-size: 10px; border-bottom: .6px solid black;"> '. $academic_year .'
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 3.38cm; font-family: times, sans-serif; font-size: 9.5px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.60cm; font-family: times, sans-serif; font-size: 10px; border-bottom: .6px solid black;">Formerly Apolinario R. Apacible School of Fisheries
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);



$pdf->setY(84);


$pdf->SetLeftMargin(17);
$pdf->SetRightMargin(17);
// Add HTML table
$html = '<table border=".40" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 8.15cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.90cm;">COGNITIVE DEVELOPMENT
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 4.3cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">QUARTER
                    </td>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2.75cm; font-family: times, sans-serif; font-size: 10px;">FINAL<br>RATING
                    </td>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.00cm; font-family: times, sans-serif; font-size: 10px;">ACTION<br>TAKEN
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.24cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">4
                    </td>
                </tr>';

if (!empty($school_year) && !empty($student_id)) {
    function getGradeDescriptor($grade) {
        if ($grade >= 90) {
            return "O"; // Outstanding
        } elseif ($grade >= 85) {
            return "VS"; // Very Satisfactory
        } elseif ($grade >= 80) {
            return "S"; // Satisfactory
        } elseif ($grade >= 75) {
            return "FS"; // Fairly Satisfactory
        } else {
            return "F"; // Failed
        }
    }

    $row_number = 1; // Initialize row number
    $average_grades = []; // Initialize array to store average grades

    // Fetch the list of subjects for the student
    $query_subjects = "SELECT subjects.courseTitle, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects ON l.subject_id = subjects.id 
                        WHERE sg.student_id = $student_id AND l.class_id = $class_id AND l.school_year_id = $school_year";

    $query_run = mysqli_query($conn, $query_subjects);
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $courseTitle = $row['courseTitle'];
            $q1_grade = htmlspecialchars($row['q1_grade']);
            $q2_grade = htmlspecialchars($row['q2_grade']);
            $q3_grade = htmlspecialchars($row['q3_grade']);
            $q4_grade = htmlspecialchars($row['q4_grade']);

            $q1_descriptor = getGradeDescriptor($q1_grade);
            $q2_descriptor = getGradeDescriptor($q2_grade);
            $q3_descriptor = getGradeDescriptor($q3_grade);
            $q4_descriptor = getGradeDescriptor($q4_grade);

            // Calculate average grade
            $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);

            // Append average grade to the array
            $average_grades[] = $average_grade;

            // Get grade descriptor for average grade
            $average_descriptor = getGradeDescriptor($average_grade);

            // Get final rating based on average grade
            $final_rating = $average_descriptor;

            // Determine remarks based on average grade
            $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

            // Append table rows with data and row number
            $html .= '<tr>
                <td style="text-align: left; font-weight: bold; width: 8.15cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">'.$row_number.'. '.$courseTitle.'</td>
                <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">'.$q1_descriptor.'</td>
                <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">'.$q2_descriptor.'</td>
                <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">'.$q3_descriptor.'</td>
                <td style="text-align: center; font-weight: bold; width: 1.24cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">'.$q4_descriptor.'</td>
                <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: times, sans-serif; font-size: 10px;">'.$final_rating.'</td>
                <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: times, sans-serif; font-size: 10px;">'.$remarks.'</td>
            </tr>';

            $row_number++; // Increment row number
        }

        // Calculate general average
        $general_average = round(array_sum($average_grades) / count($average_grades));

        $general_average_descriptor = getGradeDescriptor($general_average);

        $general_average_remarks = ($general_average >= 75) ? "Passed" : "Failed";

        $html .= '<tr>
            <td style="text-align: left; font-weight: bold; width: 8.15cm; font-family: times, sans-serif; font-size: 10px;"></td>
            <td colspan="4" style="text-align: center; font-weight: bold; font-family: times, sans-serif; font-size: 10px;">GENERAL AVERAGE</td>
            <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: times, sans-serif; font-size: 10px;">'.$general_average_descriptor.'</td>
            <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: times, sans-serif; font-size: 10px;">'.$general_average_remarks.'</td>
        </tr>';
    } else {
        $html .= '<tr><td colspan="7" style="text-align: center;">No grades found for this student</td></tr>';
    }
    
}else {
$html .= '    <tr>
                    <td style="text-align: left; font-weight: bold; width: 8.15cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">1. Communication Skills
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.24cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8.15cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">2. Komunikasyon sa Filipino
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.24cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8.15cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">3. Numeracy Skills
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.24cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8.15cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">4. Sensory Perceptual Skills (Use of Senses)
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.24cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8.15cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">5. Motor and Creative Skills (Music, Arts and P.E.)
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.02cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.24cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8.15cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 4.3cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">GENERAL AVERAGE
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: times, sans-serif; font-size: 10px;"> 
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>';
} 
$html .= '</table>';
$pdf->writeHTML($html);

$pdf->setY(126);

$pdf->SetLeftMargin(17);
$pdf->SetRightMargin(17);
// Add HTML table
$html = '<table border=".40" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.90cm;">PERSONAL-SOCIAL DEVELOPMENT
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 6.99cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">GRADE QUARTER
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.45cm;">4
                    </td>
                </tr>';

$value_text_equivalents = [
    1 => "Exercises good health habits",
    2 => "Dresses up independently",
    3 => "Eats without help",
    4 => "Uses toilet independently",
    5 => "Interacts with teachers, peers and other people",
    6 => "Completes tasks willingly",
    7 => "Plays cooperatively",
    8 => "Participates actively in manipulative activities",
    9 => "Follows rules and routines",
    10 => "Accepts simple responsibilities",
    11 => "Says simple prayers",
    12 => "Shows concern for others",
    13 => "Cares for plants and animals",
    14 => "Accepts criticism",
    15 => "Waits for one’s turn"
];
$fetch_query = "SELECT * FROM observe_values_k WHERE 
    value BETWEEN 1 AND 10 AND 
    student_id = '$student_id' AND 
    class_id = '$class_id' AND 
    school_year_id = '$school_year'";
$result = $conn->query($fetch_query);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;' . $value_text_equivalents[$row['value']] . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">' . $row["quarter_1"] . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">' . $row["quarter_2"] . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">' . $row["quarter_3"] . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">' . $row["quarter_4"] . '</td>';
        $html .= '</tr>';
    }
} else {
    for ($i = 1; $i <= 10; $i++) {
        $html .= '<tr>';
        // Assuming $value_text_equivalents is an array containing text equivalents for values 1 to 10
        $text_equivalent = isset($value_text_equivalents[$i]) ? $value_text_equivalents[$i] : ''; 
        $html .= '<td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;' . $text_equivalent . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;"></td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;"></td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;"></td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;"></td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';

$pdf->writeHTML($html);

$pdf->setY(188);

$pdf->SetLeftMargin(17);
$pdf->SetRightMargin(17);
// Add HTML table
$html = '<table border=".40" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 9.5px; vertical-align: middle; line-height: 0.90cm;">AFFECTIVE DEVELOPMENT
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 6.99cm; font-family: times, sans-serif; font-size: 9.5px; vertical-align: middle; line-height: 0.45cm;">GRADE QUARTER
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 9.5px; vertical-align: middle; line-height: 0.45cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 9.5px; vertical-align: middle; line-height: 0.45cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 9.5px; vertical-align: middle; line-height: 0.45cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 9.5px; vertical-align: middle; line-height: 0.45cm;">4
                    </td>
                </tr>';

$fetch_query = "SELECT * FROM observe_values_k WHERE 
    value BETWEEN 11 AND 15 AND 
    student_id = '$student_id' AND 
    class_id = '$class_id' AND 
    school_year_id = '$school_year'";
$result = $conn->query($fetch_query);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;' . $value_text_equivalents[$row['value']] . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">' . $row["quarter_1"] . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">' . $row["quarter_2"] . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">' . $row["quarter_3"] . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">' . $row["quarter_4"] . '</td>';
        $html .= '</tr>';
    }
} else {
    for ($i = 11; $i <= 15; $i++) {
        $html .= '<tr>';
        // Assuming $value_text_equivalents is an array containing text equivalents for values 1 to 10
        $text_equivalent = isset($value_text_equivalents[$i]) ? $value_text_equivalents[$i] : ''; 
        $html .= '<td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;' . $text_equivalent . '</td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;"></td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;"></td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;"></td>';
        $html .= '<td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;"></td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';

$pdf->writeHTML($html);

$pdf->setY(225);

$pdf->SetLeftMargin(17);
$pdf->SetRightMargin(17);
// Add HTML table
$html = '<table border="1" style="border-collapse: collapse; width: 100%">
                <tr>
                    <td style="text-align: center; vertical-align: middle; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 10px;">ATTENDANCE<br>RECORD
                    </td>';

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
            $html .= '<td style="text-align: center; vertical-align: middle; line-height: 0.80cm; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size: 8px;">
                    '. strtoupper($shortMonthName) .'</td>';
        }
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center;  font-weight: normal; width: 1.1cm; vertical-align: middle; line-height: 0.80cm; font-family: times, sans-serif; font-size: 7.8px;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 1.89cm; vertical-align: middle; line-height: 0.80cm; font-family: times, sans-serif; font-size: 8px;">
            TOTAL
        </td>
        </tr>

        <tr>
            <td style="text-align: left; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">No. of School Days
                    </td>';

$totalSchoolDays = 0;

if (!empty($school_year)) {
    $query2 = "SELECT m.id, m.daysInMonth
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = '$school_year'
              ORDER BY $orderClause";

    $query_run = mysqli_query($conn, $query2);



    if ($query_run) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            // Calculate width for each column dynamically
            $columnWidth = 1.1;
            $html .= '<td style="text-align: center; font-weight: normal; width: '.$columnWidth.'cm; vertical-align: middle; line-height: 0.60cm; font-family: times, sans-serif; font-size:7px; ">' . $row1["daysInMonth"] . '</td>';
            $totalSchoolDays += $row1["daysInMonth"];
        }
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal;  width: 1.1cm; vertical-align: middle; line-height: 0.60cm; font-family: times, sans-serif; font-size: 8px;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; width: 1.89cm; vertical-align: middle; line-height: 0.60cm; font-family: times, sans-serif; font-size:7px; ">'. $totalSchoolDays .'
          </td>
     
        </tr>

        <tr>
            <td style="text-align: left; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">No. of School Days Present
            </td>';


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
            $html .= '<td style="text-align: center; font-weight: normal; width: '.$columnWidth.'cm; vertical-align: middle; line-height: 0.60cm; font-family: times, sans-serif; font-size:7px; ">' . $daysPresent . '</td>';
        }

        // Add the total days present at the end of the row
        $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.60cm; width: 1.89cm; font-family: times, sans-serif; font-size: 8px;">' . $totalDaysPresent . '</td>';
    } else {
        // If no data available for months
        $html .= "<td colspan='11'>No data available</td>";
    }

    $no++; // Increment $no within the loop
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal;  width: 1.1cm; vertical-align: middle; line-height: 0.60cm; font-family: times, sans-serif; font-size: 8px;"></td>';
    }
    $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.60cm; width: 1.89cm; font-family: times, sans-serif; font-size: 8px;"></td>';
}

$html .= '
             
                </tr>

                 <tr>

                    <td style="text-align: left; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">No. of School Days Absent
                    </td>';


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
            $html .= '<td style="text-align: center; font-weight: normal; width: '.$columnWidth.'cm; vertical-align: middle; line-height: 0.60cm; font-family: times, sans-serif; font-size:7px; ">' . $daysAbsent . '</td>';
        }

        // Add the total days present at the end of the row
        $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.60cm; width: 1.89cm; font-family: times, sans-serif; font-size: 8px;">' . $totalDaysAbsent . '</td>';
    } else {
        // If no data available for months
        $html .= "<td colspan='11'>No data available</td>";
    }

    $no++; // Increment $no within the loop
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal;  width: 1.1cm; vertical-align: middle; line-height: 0.60cm; font-family: times, sans-serif; font-size: 8px;"></td>';
    }
    $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.60cm; width: 1.89cm; font-family: times, sans-serif; font-size: 8px;"></td>';
}

$html .= '</tr>

<tr>
                    <td style="text-align: left; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">No. of Times Tardy
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.89cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                </tr></table>';

$pdf->writeHTML($html);



$pdf->setY(260);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(114.3);
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 11.70cm; font-family: times, sans-serif; font-size: 10px; ">Eligible for Admission to Grade________________________________
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);

$pdf->setY(268);

$pdf->setX(85);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(0, 1.0, 'CERTIFICATE OF TRANSFER', 0, 0, 'center');

$pdf->setx(19);
$pdf->SetFont('times', 'N', 11);
$pdf->Cell(0, 20, 'TO WHOM IT MAY CONCERN:', 0, 0, 'L');

$pdf->setx(19);
$pdf->SetFont('times', 'N', 11);
$pdf->Cell(0, 35, 'This is to certify that this is a true record of the Elementary School Permanent Record of ___________________.', 0, 0, 'L');

$pdf->setx(19);
$pdf->SetFont('times', 'N', 11);
$pdf->Cell(0, 45, 'He/She is eligible for admission to __________________.', 0, 0, 'L');

$pdf->setY(307);

$pdf->setX(155);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(0, 20, 'ERWIN R. ABIAD', 0, 0, 'L');

$pdf->setX(149);
$pdf->SetFont('times', 'N', 11);
$pdf->Cell(0, 28, 'Head, Registration Services', 0, 0, 'L');


$pdf->setY(-10);
$pdf->SetFont('times', '', 10);

$filename = "Kinder_form138_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';
?>