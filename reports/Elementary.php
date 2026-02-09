<?php
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

$pdf->AddPage();
   // Add image
// Add image
$pdf->Image('../assets/img/bsu logo.jpg', 41, 2, 31);
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

$pdf->setY(32.5);


$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(50);
// Add HTML table
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.05cm; font-family: times, sans-serif; font-size: 9px; ">Name:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 5.50cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">Dela Cruz, Juan A.
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.84cm; font-family: times, sans-serif; font-size: 9px; ">Age:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.41cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">16
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.49cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                     <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: times, sans-serif; font-size: 9px; ">Sex:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.95cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">Male
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.00cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                     <td style="text-align: left; font-weight: normal; width: 0.94cm; font-family: times, sans-serif; font-size: 9px; ">LRN:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 2.45cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">10740000000
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.99cm; font-family: times, sans-serif; font-size: 9px; ">Date of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 4.56cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">00/00/0000
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.06cm; font-family: times, sans-serif; font-size: 9px; ">Place of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.80cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">Hospital
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 2.71cm; font-family: times, sans-serif; font-size: 9px; ">Parent or Guardian:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.84cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">Dela Cruz, Pedro C.
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.76cm; font-family: times, sans-serif; font-size: 9px; ">Occupation:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.92cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">CEO
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.17cm; font-family: times, sans-serif; font-size: 9px; ">Address of Parent or Guardian:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 5.78cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">N/A
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 3.70cm; font-family: times, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.44cm; font-family: times, sans-serif; font-size: 9px; ">Date of Entrance:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 2.12cm; font-family: times, sans-serif; font-size: 9px; border-bottom: .6px solid black;">00/00/0000
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Filipino
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">English
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Mathematics
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Mother Tongue (Tagalog)
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Araling Panlipunan
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Edukasyon sa Pagpapakatao
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">MAPEH
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Health
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Computer
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
                </tr>

                <tr>
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
                </tr>

            </table>';

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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Filipino
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">English
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Mathematics
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Mother Tongue (Tagalog)
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Araling Panlipunan
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Edukasyon sa Pagpapakatao
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">MAPEH
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Health
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Computer
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
                </tr>

                <tr>
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
                </tr>

            </table>';

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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Filipino
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">English
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Mathematics
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Science
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Araling Panlipunan
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Edukasyon sa Pagpapakatao
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Mother Tongue (Tagalog)
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">MAPEH
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Health
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Computer
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
                </tr>

                <tr>
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
                </tr>

            </table>';

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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Filipino
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">English
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Mathematics
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Science
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Araling Panlipunan
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Edukasyon sa Pagpapakatao
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.30cm;">Edukasyong Pantahanan at Pangkabuhayan
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
                </tr>


                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">MAPEH
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Health
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Computer
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
                </tr>

                <tr>
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
                </tr>

            </table>';

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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Filipino
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">English
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Mathematics
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Science
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Araling Panlipunan
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Edukasyon sa Pagpapakatao
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.30cm;">Edukasyong Pantahanan at Pangkabuhayan
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">MAPEH
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Health
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Computer
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
                </tr>

            </table>';

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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Filipino
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">English
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Mathematics
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Science
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Araling Panlipunan
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Edukasyon sa Pagpapakatao
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.30cm;">Edukasyong Pantahanan at Pangkabuhayan
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
                </tr>


                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">MAPEH
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;"> &nbsp;&nbsp;Health
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 4.00cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Computer
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
                </tr>

            </table>';

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
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.74cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">Core Values
                    </td>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 6.6cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">Behavior Statements
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: I<br>School Year: 
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: II<br>School Year: 
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: III<br>School Year: 
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

                <tr>
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
                </tr>

                

            </table>';

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
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: I<br>School Year: 
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: II<br>School Year: 
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 3.88cm; font-family: times, sans-serif; font-size: 9px;">Grade: III<br>School Year: 
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

                <tr>
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
                </tr>

                

            </table>';

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

                <tr>
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
                </tr>  
            </table>';

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

$filename = "List_of_Learners_Subject_for_Probation" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>