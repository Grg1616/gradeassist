<?php
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
$pdf->Image('../assets/img/bsu logo.jpg', 27, 2, 35);
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

$pdf->setY(45);


$pdf->SetLeftMargin(16);
$pdf->SetRightMargin(50);
// Add HTML table
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.05cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Name:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 5.50cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.84cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Age:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.41cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.49cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.00cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.99cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Date of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 4.56cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
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
                    <td style="text-align: left; font-weight: normal; width: 3.84cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.76cm; font-family: helvetica, sans-serif; font-size: 8.40px; ">Occupation:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.92cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
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
                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: helvetica, sans-serif; font-size: 8.40px; border-bottom: .6px solid black;">
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
                    <td style="text-align: left; font-weight: normal; width: 1.10cm; font-family: helvetica, sans-serif; font-size: 8px; ">Grade:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .35cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">VII
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.08cm; font-family: helvetica, sans-serif; font-size: 8px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 8px; ">School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 8.27cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY-TNEU ARASOF-NASUGBU
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.93cm; font-family: helvetica, sans-serif; font-size: 8px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.82cm; font-family: helvetica, sans-serif; font-size: 8px; ">School Year:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: .58cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 3.64cm; font-family: times, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.22cm; font-family: times, sans-serif; font-size: 8px; border-bottom: .6px solid black;">Formerly Apolinario R. Apacible School of Fisheries
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);



$pdf->setY(84);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE CODE
                    </td>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE TITLE
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">CONTACT
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">GRADING PERIOD
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">C.S
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">ACTION
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">HOURS
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">AVERAGE
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TAKEN
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Filipino 7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Panitikang Panrehiyon at Panuntunang Pambalarila
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">English  7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Communication Arts Skills with Philippine Literature
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Mathematics  7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Algebra 1
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">5
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Science  7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Earth Science
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Technology  7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Exploratory (Electricity, Electronics, Robotics and CHS)
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Computer Science 7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Introduction to Computer Programming
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">Drawing 1
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px;">Freehand, Mechanical, Architectural and Introduction to AutoCAD
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Araling Panlipunan 7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Araling Asyano
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px;">Edukasyon sa Pagpapahalaga 7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">Pananagutang Pansarili
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">2
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">MAPEH 7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;MUS 7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;ARTS 7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;PE 7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;HEALTH 7
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Health
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
                </tr>

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
                </tr>
        </table>';

$pdf->writeHTML($html);


$pdf->setY(168);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">ATTENDANCE
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">AUG
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">SEP
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">OCT
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">NOV
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DEC
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">JAN
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">FEB
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">MAR
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">APR
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">MAY
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">JUN
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">TOTAL
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS OF SCHOOL
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS PRESENT
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                </tr>
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
                    <td style="text-align: left; font-weight: normal; width: 1.10cm; font-family: helvetica, sans-serif; font-size: 8px; ">Grade:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .45cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">VIII
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.08cm; font-family: helvetica, sans-serif; font-size: 8px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 8px; ">School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 8.27cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY-TNEU ARASOF-NASUGBU
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.93cm; font-family: helvetica, sans-serif; font-size: 8px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.82cm; font-family: helvetica, sans-serif; font-size: 8px; ">School Year:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: .58cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 3.64cm; font-family: times, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.22cm; font-family: times, sans-serif; font-size: 8px; border-bottom: .6px solid black;">Formerly Apolinario R. Apacible School of Fisheries
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);


$pdf->setY(199.5);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE CODE
                    </td>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE TITLE
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">CONTACT
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">GRADING PERIOD
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">C.S
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">ACTION
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">HOURS
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">AVERAGE
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TAKEN
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Filipino 8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Pambansang Panitikan at Panuntunang Pambalarila
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">English  8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Communication Arts Skills with Afro-Asian Literature
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Mathematics  8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Algebra 2
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">5
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Science  8-A
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">General Biology
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Science  8-AB
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Environmental Science
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Technology  8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Exploratory (Electricity, Electronics, Robotics and CHS)
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Computer Science 8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Web Development
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">Drawing 2
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">AutoCAD
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Araling Panlipunan 8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Kasaysayan ng Mundo
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px;">Edukasyon sa Pagpapahalaga 8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">Pakikipagkapwa at Katatagan ng Pamilya
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">2
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">MAPEH 8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;MUS 8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;ARTS 8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;PE 8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;HEALTH 8
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Health
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TOTAL
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">36
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 7px; vertical-align: middle; line-height: 0.45cm;">GENERAL AVERAGE:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                </tr>
        </table>';

$pdf->writeHTML($html);


$pdf->setY(288);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">ATTENDANCE
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">AUG
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">SEP
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">OCT
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">NOV
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DEC
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">JAN
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">FEB
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">MAR
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">APR
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">MAY
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">JUN
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">TOTAL
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS OF SCHOOL
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS PRESENT
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                </tr>
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
                    <td style="text-align: left; font-weight: normal; width: 1.10cm; font-family: helvetica, sans-serif; font-size: 8px; ">Grade:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .35cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">IX
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.08cm; font-family: helvetica, sans-serif; font-size: 8px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 8px; ">School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 8.27cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY-TNEU ARASOF-NASUGBU
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.93cm; font-family: helvetica, sans-serif; font-size: 8px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.82cm; font-family: helvetica, sans-serif; font-size: 8px; ">School Year:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: .58cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 3.64cm; font-family: times, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.22cm; font-family: times, sans-serif; font-size: 8px; border-bottom: .6px solid black;">Formerly Apolinario R. Apacible School of Fisheries
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);



$pdf->setY(19);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE CODE
                    </td>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE TITLE
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">CONTACT
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">GRADING PERIOD
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">C.S
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">ACTION
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">HOURS
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">AVERAGE
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TAKEN
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Filipino 9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Saling-akdang Asyano at Panuntunang Pambalarila
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.75cm;">English  9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px;">Communication Arts Skills with Anglo-American Literature
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Mathematics  9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Trigonometry and Advanced Algebra
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">5
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Science  9-A
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">General Chemistry 1
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Science  9-B
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">General Physics 1
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Technology  9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Specialization (Electricity or Robotics)
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Computer Science 9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Data Structures and Algorithms
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Araling Panlipunan 9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Ekonomiks
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px;">Edukasyon sa Pagpapahalaga 9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; ">Paggawa tungo sa Pambansang Pag-unlad at Pakikibahagi sa Pandaigdigang Pagkakaisa
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">2
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">MAPEH 9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;MUS 9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;ARTS 9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;PE 9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;HEALTH 9
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Health
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TOTAL
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">35
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 7px; vertical-align: middle; line-height: 0.45cm;">GENERAL AVERAGE:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                </tr>
        </table>';

$pdf->writeHTML($html);


$pdf->setY(103);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">ATTENDANCE
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">AUG
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">SEP
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">OCT
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">NOV
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DEC
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">JAN
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">FEB
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">MAR
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">APR
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">MAY
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">JUN
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">TOTAL
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS OF SCHOOL
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS PRESENT
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                </tr>
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
                    <td style="text-align: left; font-weight: normal; width: 1.10cm; font-family: helvetica, sans-serif; font-size: 8px; ">Grade:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: .45cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">X
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.08cm; font-family: helvetica, sans-serif; font-size: 8px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.16cm; font-family: helvetica, sans-serif; font-size: 8px; ">School:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: 8.27cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">BATANGAS STATE UNIVERSITY-TNEU ARASOF-NASUGBU
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.93cm; font-family: helvetica, sans-serif; font-size: 8px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.82cm; font-family: helvetica, sans-serif; font-size: 8px; ">School Year:
                    </td>
                    <td style="text-align: left; font-weight: bold; width: .58cm; font-family: helvetica, sans-serif; font-size: 8px; border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 3.64cm; font-family: times, sans-serif; font-size: 8px;">
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 6.22cm; font-family: times, sans-serif; font-size: 8px; border-bottom: .6px solid black;">Formerly Apolinario R. Apacible School of Fisheries
                    </td>
                </tr>

            </table>';

$pdf->writeHTML($html);


$pdf->setY(134.5);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE CODE
                    </td>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.90cm;">COURSE TITLE
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">CONTACT
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">GRADING PERIOD
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">C.S
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">ACTION
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">HOURS
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">AVERAGE
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TAKEN
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Filipino 10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Saling-akdang Pandaigdig at Panuntunang Pambalarila
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">English  10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Communication Arts Skills with World Literature
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Mathematics  10-A
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Plane and Solid Geometry
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Mathematics  10-B
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Statistics and Probability
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Science  10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">General Physics 2
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Research 1
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Introduction to Quantitative and Qualitative Research
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Technology  10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Specialization (Electricity or Robotics)
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 0.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Computer Science 10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Object-Oriented Programming
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Araling Panlipunan 10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Mga Kontemporaryong Isyu
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">3
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px;">Edukasyon sa Pagpapahalaga 10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">Pagkamaka-Diyos at Preperensiya sa Kabutihan
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.70cm;">2
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">MAPEH 10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">4
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;MUS 10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Music
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;ARTS 10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Arts
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;PE 10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Physical Education
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">&nbsp;&nbsp;&nbsp;&nbsp;HEALTH 10
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">Health
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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.42cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 7.25cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">TOTAL
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">36
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.00cm; font-family: helvetica, sans-serif; font-size: 7px; vertical-align: middle; line-height: 0.45cm;">GENERAL AVERAGE:
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.75cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; font-family: helvetica, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.45cm;">
                    </td>
                </tr>
        </table>';

$pdf->writeHTML($html);


$pdf->setY(220.5);
$pdf->setX(14);

$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(15.2);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">ATTENDANCE
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">AUG
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">SEP
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">OCT
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">NOV
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DEC
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">JAN
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">FEB
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">MAR
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">APR
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">MAY
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">JUN
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">TOTAL
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS OF SCHOOL
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 3.75cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">DAYS PRESENT
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.16.5cm; font-family: helvetica, sans-serif; font-size: 6.5px; vertical-align: middle; line-height: 0.33cm;">
                    </td>
                </tr>
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

$filename = "Junior_High_School" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>