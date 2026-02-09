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

class  ListofLearnersSubjectforProbation extends TCPDF
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
$pdf = new  ListofLearnersSubjectforProbation('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Grade 1-6 Form 137');
$pdf->AddPage();
   // Add image
// Add image
$pdf->Image('../assets/img/bsulogo.jpg', 41, 2, 31);
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
$pdf->Cell(200, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas', 0, 1, 'C');
$pdf->SetFont('times', 'N', 9);
$pdf->Cell(0, 1.0, 'PALAGIANG TALAAN SA MABABANG PAARALAN', 0, 1, 'C');
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(0, 1.0, '(ELEMENTARY SCHOOL PERMANENT RECORD)', 0, 0, 'C');


// $pdf->setY(27);
// $pdf->setX(20);
// $pdf->SetFont('times', 'N', 8);
// $pdf->Cell(0, 1.0, 'Name:', 0, 0, 'L');
// $pdf->Ln(); // Add a line break
// $pdf->Line(30, $pdf->GetY(), 78, $pdf->GetY());
$default_table = '';

// Loop to generate 12 rows of empty cells
for ($i = 0; $i < 12; $i++) {
    $default_table .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>';
}

// Adding the final two rows for additional data
$default_table .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.40cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.40cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.40cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.40cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.40cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.40cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">GENERAL AVERAGE:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>';

$default_table2 = '';

$default_table2 .= '<tr>
                    <td rowspan="2" style="text-align: center; font-weight: normal; width: 1.74cm; font-family: times, sans-serif; font-size: 9px; vertical-align: top; line-height: 0.55cm;">Maka - Diyos
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.6cm; font-family: times, sans-serif; font-size: 9px;">Expresses one’s spiritual beliefs while respecting the spiritual beliefs of others
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 6.6cm; font-family: times, sans-serif; font-size: 9px;">Shows adherence to ethical principles by upholding truth
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: normal; width: 1.74cm; font-family: times, sans-serif; font-size: 9px; vertical-align: top; line-height: 1.38cm;">Makatao
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.6cm; font-family: times, sans-serif; font-size: 9px;">Is sensitive to individual, social, and cultural differences
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 6.6cm; font-family: times, sans-serif; font-size: 9px;">Demonstrates contributions toward solidarity
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 1.74cm; font-family: times, sans-serif; font-size: 9px; vertical-align: top; line-height: .5cm;">Maka - kalikasan
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.6cm; font-family: times, sans-serif; font-size: 9px;">Cares for the environment and utilizes resources wisely, judiciously, and economically
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: normal; width: 1.74cm; font-family: times, sans-serif; font-size: 9px; vertical-align: top; line-height: 0.55cm;">Maka - bansa
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.6cm; font-family: times, sans-serif; font-size: 9px;">Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 6.6cm; font-family: times, sans-serif; font-size: 8.8px;">Demonstrates appropriate behavior in carrying out activities in the school, community and country
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">
                    </td>
                </tr>';

$pdf->setY(32.5);


$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(50);
// Add HTML table
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.05cm; font-family: times, sans-serif; font-size: 9px; ">Name:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 5.50cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">'. $studentName .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.84cm; font-family: times, sans-serif; font-size: 9px; ">Age:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.41cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">'. $age .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.49cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                     <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: times, sans-serif; font-size: 9px; ">Sex:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.95cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">'. $gender .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.00cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                     <td style="text-align: left; font-weight: normal; width: 0.94cm; font-family: times, sans-serif; font-size: 9px; ">LRN:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 2.45cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">'. $lrn .'
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.99cm; font-family: times, sans-serif; font-size: 9px; ">Date of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 4.56cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">'. $birthday .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.06cm; font-family: times, sans-serif; font-size: 9px; ">Place of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.80cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 2.71cm; font-family: times, sans-serif; font-size: 9px; ">Parent or Guardian:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.84cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">'. $guardianName .'
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.76cm; font-family: times, sans-serif; font-size: 9px; ">Occupation:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.92cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">'. $guardianOccupation .'
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.17cm; font-family: times, sans-serif; font-size: 9px; ">Address of Parent or Guardian:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 5.78cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 3.70cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.44cm; font-family: times, sans-serif; font-size: 9px; ">Date of Entrance:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 2.12cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">
                    </td>
                </tr>

        </table>';

$pdf->writeHTML($html);


$pdf->setY(49);
$pdf->setX(50);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(0, 1.0, 'PAG-UNLAD SA MABABANG PAARALAN', 0, 1, 'C');
$pdf->setX(50);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(0, 1.0, '(ELEMENTARY SCHOOL PROGRESS)', 0, 0, 'C');

$pdf->setY(57.5);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(16.5);
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.95cm; font-family: times, sans-serif; font-size: 7.5px; ">Grade: I School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 6.58cm; font-family: times, sans-serif; font-size: 7.5px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY ARASOF-Nasugbu
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.08cm; font-family: times, sans-serif; font-size: 7.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.04cm; font-family: times, sans-serif; font-size: 7.5px; ">Grade: II School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 6.58cm; font-family: times, sans-serif; font-size: 7.5px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY ARASOF-Nasugbu
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 9.15cm; font-family: times, sans-serif; font-size: 7.5px;">School Year:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 10.00cm; font-family: times, sans-serif; font-size: 7.5px;">School Year:
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);


// GRADE I //

$pdf->setY(64);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(114.3);
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">Learning Areas
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.65cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Periodic Rating
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">FR
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>
                </tr>';


if (!empty($student_id)) {
    // Update your SQL query to select the course code
    $query_subjects = "SELECT l.mapeh_name, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 1'";

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
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Store grades in quarter-specific arrays
                $q1_grades[] = $q1_grade;
                $q2_grades[] = $q2_grade;
                $q3_grades[] = $q3_grade;
                $q4_grades[] = $q4_grade;
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
            $q1_grades[] = $average_q1;
            $q2_grades[] = $average_q2;
            $q3_grades[] = $average_q3;
            $q4_grades[] = $average_q4;
            $final_ratings[] = $final_rating; // Store final rating for MAPEH

            // Determine remarks based on average grade
            $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

            // Retrieve the course code for MAPEH
            $mapeh_course_code = $individual_mapeh_subjects[0]['course_code']; // Assuming there's at least one MAPEH subject

                            // Append MAPEH consolidated row using the course code
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_course_code.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q1.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q2.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q3.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q4.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Append individual MAPEH subject rows
                foreach ($individual_mapeh_subjects as $subject) {
                    $html .= '<tr>
                        <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$subject['title'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q1_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q2_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q3_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q4_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['average_grade'].'</td>
                    </tr>';
                }
            }

            // Calculate general average from final ratings
            $q1_general_average = !empty($q1_grades) ? round(array_sum($q1_grades) / count($q1_grades)) : 0;
            $q2_general_average = !empty($q2_grades) ? round(array_sum($q2_grades) / count($q2_grades)) : 0;
            $q3_general_average = !empty($q3_grades) ? round(array_sum($q3_grades) / count($q3_grades)) : 0;
            $q4_general_average = !empty($q4_grades) ? round(array_sum($q4_grades) / count($q4_grades)) : 0;

            $general_average = !empty($final_ratings) ? round(array_sum($final_ratings) / count($final_ratings)) : 0;

            // Append the row for general average
            $html .= '<tr>
                        <td style="text-align: right; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">GENERAL AVERAGE:</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q1_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q2_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q3_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q4_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $general_average .'</td>
                    </tr>';
        } else {
           $html .= $default_table;
        }
    } else {
        $html .= $default_table;
    }

$html .= '</table>';

$pdf->writeHTML($html);

// GRADE II //

$pdf->setY(64);
$pdf->setX(113);

$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">Learning Areas
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.65cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Periodic Rating
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">FR
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>
                </tr>';


if (!empty($student_id)) {
    // Update your SQL query to select the course code
    $query_subjects = "SELECT l.mapeh_name, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 2'";

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
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Store grades in quarter-specific arrays
                $q1_grades[] = $q1_grade;
                $q2_grades[] = $q2_grade;
                $q3_grades[] = $q3_grade;
                $q4_grades[] = $q4_grade;
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
            $q1_grades[] = $average_q1;
            $q2_grades[] = $average_q2;
            $q3_grades[] = $average_q3;
            $q4_grades[] = $average_q4;
            $final_ratings[] = $final_rating; // Store final rating for MAPEH

            // Determine remarks based on average grade
            $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

            // Retrieve the course code for MAPEH
            $mapeh_course_code = $individual_mapeh_subjects[0]['course_code']; // Assuming there's at least one MAPEH subject

                            // Append MAPEH consolidated row using the course code
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_course_code.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q1.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q2.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q3.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q4.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Append individual MAPEH subject rows
                foreach ($individual_mapeh_subjects as $subject) {
                    $html .= '<tr>
                        <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$subject['title'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q1_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q2_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q3_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q4_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['average_grade'].'</td>
                    </tr>';
                }
            }

            // Calculate general average from final ratings
            $q1_general_average = !empty($q1_grades) ? round(array_sum($q1_grades) / count($q1_grades)) : 0;
            $q2_general_average = !empty($q2_grades) ? round(array_sum($q2_grades) / count($q2_grades)) : 0;
            $q3_general_average = !empty($q3_grades) ? round(array_sum($q3_grades) / count($q3_grades)) : 0;
            $q4_general_average = !empty($q4_grades) ? round(array_sum($q4_grades) / count($q4_grades)) : 0;

            $general_average = !empty($final_ratings) ? round(array_sum($final_ratings) / count($final_ratings)) : 0;

            // Append the row for general average
            $html .= '<tr>
                        <td style="text-align: right; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">GENERAL AVERAGE:</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q1_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q2_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q3_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q4_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $general_average .'</td>
                    </tr>';
        } else {
           $html .= $default_table;
        }
    } else {
        $html .= $default_table;
    }

$html .= '</table>';

$pdf->writeHTML($html);

$pdf->setY(143);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(114.3);
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 9.70cm; font-family: times, sans-serif; font-size: 8px; ">Eligible for Admission to Grade ………………………..…….. 
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.84cm; font-family: times, sans-serif; font-size: 8px; ">Eligible for Admission to Grade ………………………..…….. 
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);

$pdf->setY(147.6);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(16.5);
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.95cm; font-family: times, sans-serif; font-size: 7.5px; ">Grade: III School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 6.58cm; font-family: times, sans-serif; font-size: 7.5px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY ARASOF-Nasugbu
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.17cm; font-family: times, sans-serif; font-size: 7.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.04cm; font-family: times, sans-serif; font-size: 7.5px; ">Grade: IV School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 6.54cm; font-family: times, sans-serif; font-size: 7.5px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY ARASOF-Nasugbu
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 9.15cm; font-family: times, sans-serif; font-size: 7.5px;">School Year:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 10.00cm; font-family: times, sans-serif; font-size: 7.5px;">School Year:
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);


// GRADE III //

$pdf->setY(154);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(114.3);
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">Learning Areas
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.65cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Periodic Rating
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">FR
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>
                </tr>';


if (!empty($student_id)) {
    // Update your SQL query to select the course code
    $query_subjects = "SELECT l.mapeh_name, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 3'";

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
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Store grades in quarter-specific arrays
                $q1_grades[] = $q1_grade;
                $q2_grades[] = $q2_grade;
                $q3_grades[] = $q3_grade;
                $q4_grades[] = $q4_grade;
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
            $q1_grades[] = $average_q1;
            $q2_grades[] = $average_q2;
            $q3_grades[] = $average_q3;
            $q4_grades[] = $average_q4;
            $final_ratings[] = $final_rating; // Store final rating for MAPEH

            // Determine remarks based on average grade
            $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

            // Retrieve the course code for MAPEH
            $mapeh_course_code = $individual_mapeh_subjects[0]['course_code']; // Assuming there's at least one MAPEH subject

                            // Append MAPEH consolidated row using the course code
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_course_code.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q1.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q2.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q3.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q4.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Append individual MAPEH subject rows
                foreach ($individual_mapeh_subjects as $subject) {
                    $html .= '<tr>
                        <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$subject['title'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q1_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q2_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q3_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q4_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['average_grade'].'</td>
                    </tr>';
                }
            }

            // Calculate general average from final ratings
            $q1_general_average = !empty($q1_grades) ? round(array_sum($q1_grades) / count($q1_grades)) : 0;
            $q2_general_average = !empty($q2_grades) ? round(array_sum($q2_grades) / count($q2_grades)) : 0;
            $q3_general_average = !empty($q3_grades) ? round(array_sum($q3_grades) / count($q3_grades)) : 0;
            $q4_general_average = !empty($q4_grades) ? round(array_sum($q4_grades) / count($q4_grades)) : 0;

            $general_average = !empty($final_ratings) ? round(array_sum($final_ratings) / count($final_ratings)) : 0;

            // Append the row for general average
            $html .= '<tr>
                        <td style="text-align: right; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">GENERAL AVERAGE:</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q1_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q2_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q3_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q4_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $general_average .'</td>
                    </tr>';
        } else {
           $html .= $default_table;
        }
    } else {
        $html .= $default_table;
    }

$html .= '</table>';

$pdf->writeHTML($html);

// GRADE IV //

$pdf->setY(154);
$pdf->setX(113);

$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">Learning Areas
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.65cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Periodic Rating
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">FR
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>
                </tr>';


if (!empty($student_id)) {
    // Update your SQL query to select the course code
    $query_subjects = "SELECT l.mapeh_name, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 4'";

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
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Store grades in quarter-specific arrays
                $q1_grades[] = $q1_grade;
                $q2_grades[] = $q2_grade;
                $q3_grades[] = $q3_grade;
                $q4_grades[] = $q4_grade;
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
            $q1_grades[] = $average_q1;
            $q2_grades[] = $average_q2;
            $q3_grades[] = $average_q3;
            $q4_grades[] = $average_q4;
            $final_ratings[] = $final_rating; // Store final rating for MAPEH

            // Determine remarks based on average grade
            $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

            // Retrieve the course code for MAPEH
            $mapeh_course_code = $individual_mapeh_subjects[0]['course_code']; // Assuming there's at least one MAPEH subject

                            // Append MAPEH consolidated row using the course code
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_course_code.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q1.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q2.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q3.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q4.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Append individual MAPEH subject rows
                foreach ($individual_mapeh_subjects as $subject) {
                    $html .= '<tr>
                        <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$subject['title'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q1_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q2_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q3_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q4_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['average_grade'].'</td>
                    </tr>';
                }
            }

            // Calculate general average from final ratings
            $q1_general_average = !empty($q1_grades) ? round(array_sum($q1_grades) / count($q1_grades)) : 0;
            $q2_general_average = !empty($q2_grades) ? round(array_sum($q2_grades) / count($q2_grades)) : 0;
            $q3_general_average = !empty($q3_grades) ? round(array_sum($q3_grades) / count($q3_grades)) : 0;
            $q4_general_average = !empty($q4_grades) ? round(array_sum($q4_grades) / count($q4_grades)) : 0;

            $general_average = !empty($final_ratings) ? round(array_sum($final_ratings) / count($final_ratings)) : 0;

            // Append the row for general average
            $html .= '<tr>
                        <td style="text-align: right; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">GENERAL AVERAGE:</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q1_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q2_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q3_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q4_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $general_average .'</td>
                    </tr>';
        } else {
           $html .= $default_table;
        }
    } else {
        $html .= $default_table;
    }

$html .= '</table>';

$pdf->writeHTML($html);


$pdf->setY(238);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(114.3);
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 9.70cm; font-family: times, sans-serif; font-size: 8px; ">Eligible for Admission to Grade ………………………..…….. 
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.84cm; font-family: times, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.55cm;">Eligible for Admission to Grade ………………………..…….. 
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);


$pdf->setY(242.5);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(16.5);
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.95cm; font-family: times, sans-serif; font-size: 7.5px; ">Grade: V School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 6.58cm; font-family: times, sans-serif; font-size: 7.5px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY ARASOF-Nasugbu
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.17cm; font-family: times, sans-serif; font-size: 7.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.04cm; font-family: times, sans-serif; font-size: 7.5px; ">Grade: VI School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 6.54cm; font-family: times, sans-serif; font-size: 7.5px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY ARASOF-Nasugbu
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 9.15cm; font-family: times, sans-serif; font-size: 7.5px;">School Year:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 10.00cm; font-family: times, sans-serif; font-size: 7.5px;">School Year:
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);


// GRADE V //

$pdf->setY(249);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(114.3);
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">Learning Areas
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.65cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Periodic Rating
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">FR
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>
                </tr>';


if (!empty($student_id)) {
    // Update your SQL query to select the course code
    $query_subjects = "SELECT l.mapeh_name, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 5'";

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
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Store grades in quarter-specific arrays
                $q1_grades[] = $q1_grade;
                $q2_grades[] = $q2_grade;
                $q3_grades[] = $q3_grade;
                $q4_grades[] = $q4_grade;
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
            $q1_grades[] = $average_q1;
            $q2_grades[] = $average_q2;
            $q3_grades[] = $average_q3;
            $q4_grades[] = $average_q4;
            $final_ratings[] = $final_rating; // Store final rating for MAPEH

            // Determine remarks based on average grade
            $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

            // Retrieve the course code for MAPEH
            $mapeh_course_code = $individual_mapeh_subjects[0]['course_code']; // Assuming there's at least one MAPEH subject

                            // Append MAPEH consolidated row using the course code
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_course_code.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q1.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q2.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q3.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q4.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Append individual MAPEH subject rows
                foreach ($individual_mapeh_subjects as $subject) {
                    $html .= '<tr>
                        <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$subject['title'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q1_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q2_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q3_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q4_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['average_grade'].'</td>
                    </tr>';
                }
            }

            // Calculate general average from final ratings
            $q1_general_average = !empty($q1_grades) ? round(array_sum($q1_grades) / count($q1_grades)) : 0;
            $q2_general_average = !empty($q2_grades) ? round(array_sum($q2_grades) / count($q2_grades)) : 0;
            $q3_general_average = !empty($q3_grades) ? round(array_sum($q3_grades) / count($q3_grades)) : 0;
            $q4_general_average = !empty($q4_grades) ? round(array_sum($q4_grades) / count($q4_grades)) : 0;

            $general_average = !empty($final_ratings) ? round(array_sum($final_ratings) / count($final_ratings)) : 0;

            // Append the row for general average
            $html .= '<tr>
                        <td style="text-align: right; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">GENERAL AVERAGE:</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q1_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q2_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q3_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q4_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $general_average .'</td>
                    </tr>';
        } else {
           $html .= $default_table;
        }
    } else {
        $html .= $default_table;
    }

$html .= '</table>';

$pdf->writeHTML($html);

// GRADE VI //

$pdf->setY(249);
$pdf->setX(113);

$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">Learning Areas
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.65cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Periodic Rating
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.95cm;">FR
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>
                </tr>';


if (!empty($student_id)) {
    // Update your SQL query to select the course code
    $query_subjects = "SELECT l.mapeh_name, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id
                        JOIN class c ON l.class_id = c.id  
                        WHERE sg.student_id = $student_id AND c.gradeLevel = 'Grade 6'";

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
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject_title.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q1_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q2_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q3_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$q4_grade.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Store grades in quarter-specific arrays
                $q1_grades[] = $q1_grade;
                $q2_grades[] = $q2_grade;
                $q3_grades[] = $q3_grade;
                $q4_grades[] = $q4_grade;
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
            $q1_grades[] = $average_q1;
            $q2_grades[] = $average_q2;
            $q3_grades[] = $average_q3;
            $q4_grades[] = $average_q4;
            $final_ratings[] = $final_rating; // Store final rating for MAPEH

            // Determine remarks based on average grade
            $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

            // Retrieve the course code for MAPEH
            $mapeh_course_code = $individual_mapeh_subjects[0]['course_code']; // Assuming there's at least one MAPEH subject

                            // Append MAPEH consolidated row using the course code
                $html .= '<tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$mapeh_course_code.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q1.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q2.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q3.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$average_q4.'</td>
                    <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$final_rating.'</td>
                </tr>';

                // Append individual MAPEH subject rows
                foreach ($individual_mapeh_subjects as $subject) {
                    $html .= '<tr>
                        <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$subject['title'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q1_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q2_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q3_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['q4_grade'].'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'.$subject['average_grade'].'</td>
                    </tr>';
                }
            }

            // Calculate general average from final ratings
            $q1_general_average = !empty($q1_grades) ? round(array_sum($q1_grades) / count($q1_grades)) : 0;
            $q2_general_average = !empty($q2_grades) ? round(array_sum($q2_grades) / count($q2_grades)) : 0;
            $q3_general_average = !empty($q3_grades) ? round(array_sum($q3_grades) / count($q3_grades)) : 0;
            $q4_general_average = !empty($q4_grades) ? round(array_sum($q4_grades) / count($q4_grades)) : 0;

            $general_average = !empty($final_ratings) ? round(array_sum($final_ratings) / count($final_ratings)) : 0;

            // Append the row for general average
            $html .= '<tr>
                        <td style="text-align: right; font-weight: bold; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">GENERAL AVERAGE:</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q1_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q2_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q3_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.92cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $q4_general_average .'</td>
                        <td style="text-align: center; font-weight: normal; width: 0.91cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">'. $general_average .'</td>
                    </tr>';
        } else {
           $html .= $default_table;
        }
    } else {
        $html .= $default_table;
    }

$html .= '</table>';

$pdf->writeHTML($html);

$pdf->setY(330);

$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(114.3);
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 9.70cm; font-family: times, sans-serif; font-size: 8px; ">Eligible for Admission to Grade ………………………..…….. 
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.84cm; font-family: times, sans-serif; font-size: 8px; ">Eligible for Admission to Grade ………………………..…….. 
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);

$pdf->AddPage();

$pdf->setY(8);
$pdf->setX(116);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(0, 1.0, 'REPORT ON LEARNER’S OBSERVED VALUES', 0, 1, 'C');

$pdf->SetLeftMargin(8);
$pdf->SetRightMargin(8.1);

$pdf->setY(17);

$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.74cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">Core Values</td>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 6.6cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">Behavior Statements</td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: I<br>School Year:</td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: II<br>School Year:</td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: III<br>School Year:</td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">1</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">2</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">3</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">4</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">1</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">2</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">3</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">4</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">1</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">2</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">3</td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">4</td>
                </tr>
            </thead>
            <tbody>';

$core_values = [
    1 => ['core_values' => ['Maka-Diyos']],
    2 => ['core_values' => ['Makatao']],
    3 => ['core_values' => ['Makakalikasan']],
    4 => ['core_values' => ['Makabansa']]
];

$behavior_statements = [
    1 => ['behavior_statements' => ['Expresses one’s spiritual beliefs while respecting the spiritual beliefs of others']],
    2 => ['behavior_statements' => ['Shows adherence to ethical principles by upholding truth']],
    3 => ['behavior_statements' => ['Is sensitive to individual, social, and cultural differences']],
    4 => ['behavior_statements' => ['Demonstrates contributions toward solidarity']],
    5 => ['behavior_statements' => ['Cares for the environment and utilizes resources wisely, judiciously, and economically']],
    6 => ['behavior_statements' => ['Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen']],
    7 => ['behavior_statements' => ['Demonstrates appropriate behavior in carrying out activities in the school, community, and country']]
];

if (!empty($student_id)) {
    $fetch_values_query = "SELECT 
        o.core_value,
        o.behavior_statement,
        MAX(CASE WHEN c.gradeLevel = 'Grade 1' THEN o.quarter_1 END) AS grade_1_q1,
        MAX(CASE WHEN c.gradeLevel = 'Grade 1' THEN o.quarter_2 END) AS grade_1_q2,
        MAX(CASE WHEN c.gradeLevel = 'Grade 1' THEN o.quarter_3 END) AS grade_1_q3,
        MAX(CASE WHEN c.gradeLevel = 'Grade 1' THEN o.quarter_4 END) AS grade_1_q4,
        MAX(CASE WHEN c.gradeLevel = 'Grade 2' THEN o.quarter_1 END) AS grade_2_q1,
        MAX(CASE WHEN c.gradeLevel = 'Grade 2' THEN o.quarter_2 END) AS grade_2_q2,
        MAX(CASE WHEN c.gradeLevel = 'Grade 2' THEN o.quarter_3 END) AS grade_2_q3,
        MAX(CASE WHEN c.gradeLevel = 'Grade 2' THEN o.quarter_4 END) AS grade_2_q4,
        MAX(CASE WHEN c.gradeLevel = 'Grade 3' THEN o.quarter_1 END) AS grade_3_q1,
        MAX(CASE WHEN c.gradeLevel = 'Grade 3' THEN o.quarter_2 END) AS grade_3_q2,
        MAX(CASE WHEN c.gradeLevel = 'Grade 3' THEN o.quarter_3 END) AS grade_3_q3,
        MAX(CASE WHEN c.gradeLevel = 'Grade 3' THEN o.quarter_4 END) AS grade_3_q4
    FROM observe_values_sh AS o
    JOIN class AS c ON o.class_id = c.id
                  AND o.school_year_id = c.school_year_id  -- Assuming school year condition is necessary
    WHERE o.student_id = $student_id
      AND c.gradeLevel IN ('Grade 1', 'Grade 2', 'Grade 3')
    GROUP BY o.core_value, o.behavior_statement;";
    
    $fetch_result = $conn->query($fetch_values_query);

    $observed_values = [];

    if ($fetch_result->num_rows > 0) {
        while ($row = $fetch_result->fetch_assoc()) {
            $core_value = $row['core_value'];
            $behavior_statement_index = $row['behavior_statement'];

            $observed_values[$core_value][$behavior_statement_index] = [
                'quarters' => [
                    $row['grade_1_q1'], $row['grade_1_q2'], $row['grade_1_q3'], $row['grade_1_q4'],
                    $row['grade_2_q1'], $row['grade_2_q2'], $row['grade_2_q3'], $row['grade_2_q4'],
                    $row['grade_3_q1'], $row['grade_3_q2'], $row['grade_3_q3'], $row['grade_3_q4']
                ]
            ];
        }
    }

    if (!empty($observed_values)) {
        foreach ($observed_values as $core_value => $data) {
            $rowspan = count($data);
            $first_row = true;

            foreach ($data as $behavior_statement_index => $item) {
                $html .= '<tr>';

                if ($first_row) {
                    $html .= '<td rowspan="' . $rowspan . '" style="text-align: center; font-weight: normal; width: 1.74cm; font-family: times, sans-serif; font-size: 9px;">' . $core_values[$core_value]['core_values'][0] . '</td>';
                    $first_row = false;
                }

                $html .= '<td style="text-align: left; font-weight: normal; width: 6.6cm; font-family: times, sans-serif; font-size: 9px;">' . $behavior_statements[$behavior_statement_index]['behavior_statements'][0] . '</td>';

                foreach ($item['quarters'] as $ovquarter) {
                    $html .= '<td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">' . $ovquarter . '</td>';
                }

                $html .= '</tr>';
            }
        }
    } else {
        $html .= $default_table2;
    }
} else {
    $html .= $default_table2;
}

$html .= '</tbody></table>';

$pdf->writeHTML($html);


$pdf->SetLeftMargin(8);
$pdf->SetRightMargin(8.1);

$pdf->setY(91);

$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.74cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">Core Values
                    </td>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 6.6cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">Behavior Statements
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: IV<br>School Year: 
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: V<br>School Year: 
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: VI<br>School Year: 
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">4
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">4
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px;">4
                    </td>
                </tr>
            </thead>
            <tbody>';

$core_values = [
    1 => ['core_values' => ['Maka-Diyos']],
    2 => ['core_values' => ['Makatao']],
    3 => ['core_values' => ['Makakalikasan']],
    4 => ['core_values' => ['Makabansa']]
];

$behavior_statements = [
    1 => ['behavior_statements' => ['Expresses one’s spiritual beliefs while respecting the spiritual beliefs of others']],
    2 => ['behavior_statements' => ['Shows adherence to ethical principles by upholding truth']],
    3 => ['behavior_statements' => ['Is sensitive to individual, social, and cultural differences']],
    4 => ['behavior_statements' => ['Demonstrates contributions toward solidarity']],
    5 => ['behavior_statements' => ['Cares for the environment and utilizes resources wisely, judiciously, and economically']],
    6 => ['behavior_statements' => ['Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen']],
    7 => ['behavior_statements' => ['Demonstrates appropriate behavior in carrying out activities in the school, community, and country']]
];

if (!empty($student_id)) {
    $fetch_values_query = "SELECT 
        o.core_value,
        o.behavior_statement,
        MAX(CASE WHEN c.gradeLevel = 'Grade 4' THEN o.quarter_1 END) AS grade_4_q1,
        MAX(CASE WHEN c.gradeLevel = 'Grade 4' THEN o.quarter_2 END) AS grade_4_q2,
        MAX(CASE WHEN c.gradeLevel = 'Grade 4' THEN o.quarter_3 END) AS grade_4_q3,
        MAX(CASE WHEN c.gradeLevel = 'Grade 4' THEN o.quarter_4 END) AS grade_4_q4,
        MAX(CASE WHEN c.gradeLevel = 'Grade 5' THEN o.quarter_1 END) AS grade_5_q1,
        MAX(CASE WHEN c.gradeLevel = 'Grade 5' THEN o.quarter_2 END) AS grade_5_q2,
        MAX(CASE WHEN c.gradeLevel = 'Grade 5' THEN o.quarter_3 END) AS grade_5_q3,
        MAX(CASE WHEN c.gradeLevel = 'Grade 5' THEN o.quarter_4 END) AS grade_5_q4,
        MAX(CASE WHEN c.gradeLevel = 'Grade 6' THEN o.quarter_1 END) AS grade_6_q1,
        MAX(CASE WHEN c.gradeLevel = 'Grade 6' THEN o.quarter_2 END) AS grade_6_q2,
        MAX(CASE WHEN c.gradeLevel = 'Grade 6' THEN o.quarter_3 END) AS grade_6_q3,
        MAX(CASE WHEN c.gradeLevel = 'Grade 6' THEN o.quarter_4 END) AS grade_6_q4
    FROM observe_values_sh AS o
    JOIN class AS c ON o.class_id = c.id
                  AND o.school_year_id = c.school_year_id  -- Assuming school year condition is necessary
    WHERE o.student_id = $student_id
      AND c.gradeLevel IN ('Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6')
    GROUP BY o.core_value, o.behavior_statement;";
    
    $fetch_result = $conn->query($fetch_values_query);

    $observed_values = [];

    if ($fetch_result->num_rows > 0) {
        while ($row = $fetch_result->fetch_assoc()) {
            $core_value = $row['core_value'];
            $behavior_statement_index = $row['behavior_statement'];

            $observed_values[$core_value][$behavior_statement_index] = [
                'quarters' => [
                    $row['grade_4_q1'], $row['grade_4_q2'], $row['grade_4_q3'], $row['grade_4_q4'],
                    $row['grade_5_q1'], $row['grade_5_q2'], $row['grade_5_q3'], $row['grade_5_q4'],
                    $row['grade_6_q1'], $row['grade_6_q2'], $row['grade_6_q3'], $row['grade_6_q4']
                ]
            ];
        }
    }

    if (!empty($observed_values)) {
        foreach ($observed_values as $core_value => $data) {
            $rowspan = count($data);
            $first_row = true;

            foreach ($data as $behavior_statement_index => $item) {
                $html .= '<tr>';

                if ($first_row) {
                    $html .= '<td rowspan="' . $rowspan . '" style="text-align: center; font-weight: normal; width: 1.74cm; font-family: times, sans-serif; font-size: 9px; vertical-align: top; line-height: 0.55cm;">' . $core_values[$core_value]['core_values'][0] . '</td>';
                    $first_row = false;
                }

                $html .= '<td style="text-align: left; font-weight: normal; width: 6.6cm; font-family: times, sans-serif; font-size: 9px;">' . $behavior_statements[$behavior_statement_index]['behavior_statements'][0] . '</td>';

                foreach ($item['quarters'] as $ovquarter) {
                    $html .= '<td style="text-align: center; font-weight: bold; width: 0.97cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.80cm;">' . $ovquarter . '</td>';
                }

                $html .= '</tr>';
            } 
        }
    } else {
        $html .= $default_table2;
    }
} else {
    $html .= $default_table2;
}

$html .= '</tbody></table>';


$pdf->writeHTML($html);


$pdf->SetLeftMargin(55);
$pdf->SetRightMargin(8.1);

$pdf->setY(168);

$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 11px;">Marking 
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.50cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 4.88cm; font-family: times, sans-serif; font-size: 11px;">Non – numerical Rating 
                    </td>
                </tr> 
            </table>';

$pdf->writeHTML($html);

$pdf->SetLeftMargin(70);
$pdf->SetRightMargin(8.1);

$pdf->setY(173);

$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.88cm; font-family: times, sans-serif; font-size: 11px;">AO 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.07cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.88cm; font-family: times, sans-serif; font-size: 11px;">Always Observed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.88cm; font-family: times, sans-serif; font-size: 11px;">SO 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.07cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.88cm; font-family: times, sans-serif; font-size: 11px;">Sometimes Observed
                    </td>
                </tr> 

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.88cm; font-family: times, sans-serif; font-size: 11px;">RO 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.07cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.88cm; font-family: times, sans-serif; font-size: 11px;">Rarely Observed
                    </td>
                </tr> 

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.88cm; font-family: times, sans-serif; font-size: 11px;">NO 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.07cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.88cm; font-family: times, sans-serif; font-size: 11px;">Not Observed
                    </td>
                </tr>  
            </table>';

$pdf->writeHTML($html);

$pdf->setY(200);
$pdf->setX(18);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(0, 1.0, 'ATTENDANCE RECORD', 0, 0, 'L');


$pdf->SetLeftMargin(18);
$pdf->SetRightMargin(17.4);

$pdf->setY(209);

// Initialize the $html variable outside the loop to accumulate table rows
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td style="text-align: center; font-weight: normal; width: 1.81cm; font-family: times, sans-serif; font-size: 11px; vertical-align: middle; line-height: 1.40cm;">Grade 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.46cm; font-family: times, sans-serif; font-size: 11px;">No. of<br>School<br>Days
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.72cm; font-family: times, sans-serif; font-size: 11px;">No. of<br>School Days<br>Absent
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.85cm; font-family: times, sans-serif; font-size: 11px; vertical-align: middle; line-height: 1.40cm;">Cause 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.59cm; font-family: times, sans-serif; font-size: 11px;">No. of<br>Times<br>Tardy
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3.02cm; font-family: times, sans-serif; font-size: 11px; vertical-align: middle; line-height: 1.40cm;">Cause
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.61cm; font-family: times, sans-serif; font-size: 11px;">No. of<br>School Days<br>Present
                    </td>
                </tr>
            </thead>';
if (!empty($student_id)) {
$sql = "
    SELECT
        'Grade 1' AS gradeLevel,
        SUM(months.daysInMonth) AS no_of_schooldays,
        SUM(attendance.daysPresent) AS no_of_days_present,
        SUM(months.daysInMonth - attendance.daysPresent) AS no_of_days_absent
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
        AND class.gradeLevel = 'Grade 1'

    UNION ALL

    SELECT
        'Grade 2' AS gradeLevel,
        SUM(months.daysInMonth) AS no_of_schooldays,
        SUM(attendance.daysPresent) AS no_of_days_present,
        SUM(months.daysInMonth - attendance.daysPresent) AS no_of_days_absent
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
        AND class.gradeLevel = 'Grade 2'

    UNION ALL

    SELECT
        'Grade 3' AS gradeLevel,
        SUM(months.daysInMonth) AS no_of_schooldays,
        SUM(attendance.daysPresent) AS no_of_days_present,
        SUM(months.daysInMonth - attendance.daysPresent) AS no_of_days_absent
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
        AND class.gradeLevel = 'Grade 3'

    UNION ALL

    SELECT
        'Grade 4' AS gradeLevel,
        SUM(months.daysInMonth) AS no_of_schooldays,
        SUM(attendance.daysPresent) AS no_of_days_present,
        SUM(months.daysInMonth - attendance.daysPresent) AS no_of_days_absent
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
        AND class.gradeLevel = 'Grade 4'

    UNION ALL

    SELECT
        'Grade 5' AS gradeLevel,
        SUM(months.daysInMonth) AS no_of_schooldays,
        SUM(attendance.daysPresent) AS no_of_days_present,
        SUM(months.daysInMonth - attendance.daysPresent) AS no_of_days_absent
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
        AND class.gradeLevel = 'Grade 5'

    UNION ALL

    SELECT
        'Grade 6' AS gradeLevel,
        SUM(months.daysInMonth) AS no_of_schooldays,
        SUM(attendance.daysPresent) AS no_of_days_present,
        SUM(months.daysInMonth - attendance.daysPresent) AS no_of_days_absent
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
        AND class.gradeLevel = 'Grade 6';
";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mapping of grade levels to Roman numerals
    $gradeMap = [
        'Grade 1' => 'I',
        'Grade 2' => 'II',
        'Grade 3' => 'III',
        'Grade 4' => 'IV',
        'Grade 5' => 'V',
        'Grade 6' => 'VI'
    ];

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $gradeRoman = $gradeMap[$row["gradeLevel"]];
        $html .= '<tr>
                    <td style="text-align: center; font-weight: bold; width: 1.81cm; font-family: times, sans-serif; font-size: 11px;">
                    '. $gradeRoman .' 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.46cm; font-family: times, sans-serif; font-size: 11px;">
                    '. $row["no_of_schooldays"] .'
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.72cm; font-family: times, sans-serif; font-size: 11px;">
                    '. $row["no_of_days_absent"] .'
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.85cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.59cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3.02cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.61cm; font-family: times, sans-serif; font-size: 11px;">
                    '. $row["no_of_days_present"] .'
                    </td>
                </tr>';
    }
} else {
    echo "0 results";
}
} else {
      $html .= '<tr>
                    <td style="text-align: center; font-weight: bold; width: 1.81cm; font-family: times, sans-serif; font-size: 11px;">I 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.46cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.72cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.85cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.59cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3.02cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.61cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.81cm; font-family: times, sans-serif; font-size: 11px;">II 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.46cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.72cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.85cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.59cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3.02cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.61cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                </tr> 

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.81cm; font-family: times, sans-serif; font-size: 11px;">III 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.46cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.72cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.85cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.59cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3.02cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.61cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                </tr> 

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.81cm; font-family: times, sans-serif; font-size: 11px;">IV 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.46cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.72cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.85cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.59cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3.02cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.61cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                </tr> 

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.81cm; font-family: times, sans-serif; font-size: 11px;">V 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.46cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.72cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.85cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.59cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3.02cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.61cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                </tr> 

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.81cm; font-family: times, sans-serif; font-size: 11px;">VI 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.46cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.72cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.85cm; font-family: times, sans-serif; font-size: 11px;"> 
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.59cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 3.02cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.61cm; font-family: times, sans-serif; font-size: 11px;">
                    </td>
                </tr> ';    
}
$html .= '</table>';


// Assuming $pdf is your PDF generation object, write the HTML to PDF
$pdf->writeHTML($html);


$pdf->setY(263);

$pdf->setX(15);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(0, 1.0, 'CERTIFICATE OF TRANSFER', 0, 0, 'C');

$pdf->setx(19);
$pdf->SetFont('times', 'N', 11);
$pdf->Cell(0, 28, 'TO WHOM IT MAY CONCERN:', 0, 0, 'L');

$pdf->setx(19);
$pdf->SetFont('times', 'N', 11);
$pdf->Cell(0, 56, 'This is to certify that this is a true record of the Elementary School Permanent Record of ___________________.', 0, 0, 'L');

$pdf->setx(19);
$pdf->SetFont('times', 'N', 11);
$pdf->Cell(0, 69, 'He/She is eligible for admission to __________________.', 0, 0, 'L');

$pdf->setY(307);

$pdf->setX(155);
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(0, 20, 'ERWIN R. ABIAD', 0, 0, 'C');

$pdf->setx(17);
$pdf->SetFont('times', 'N', 11);
$pdf->Cell(0, 28, 'Head, Registration Services', 0, 0, 'R');




$pdf->setY(-10);
$pdf->SetFont('times', '', 10);

$filename = "Kinder_form138_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';
?>