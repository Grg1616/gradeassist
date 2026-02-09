<?php
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
    $this->Image('../assets/img/bsu logo2.jpg', 21, 85.5, 178, 178);
        
        // Move to the top of the page
        $this->SetY(5); 
    }
}


// Example usage
$pdf = new  Kinder('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();
   // Add image
// Add image
$pdf->Image('../assets/img/bsu logo.jpg', 40, 2, 31);
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
                    <td style="text-align: left; font-weight: normal; width: 5.50cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.84cm; font-family: times, sans-serif; font-size: 9.5px; ">Age:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 1.41cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.49cm; font-family: times, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.00cm; font-family: times, sans-serif; font-size: 8.40px; ">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.99cm; font-family: times, sans-serif; font-size: 9.5px; ">Date of Birth:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 4.56cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;">
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
                    <td style="text-align: left; font-weight: normal; width: 3.84cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: times, sans-serif; font-size: 8.40px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.76cm; font-family: times, sans-serif; font-size: 9.5px; ">Occupation:
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 3.92cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;">
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
                    <td style="text-align: left; font-weight: normal; width: 2.90cm; font-family: times, sans-serif; font-size: 9.5px; border-bottom: .6px solid black;">
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
                    <td style="text-align: left; font-weight: bold; width: 1.90cm; font-family: times, sans-serif; font-size: 10px; border-bottom: .6px solid black;">
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
                </tr>

                <tr>
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
                </tr>
        </table>';

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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Exercises good health habits
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Dresses up independently
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Eats without help
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Uses toilet independently
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Interacts with teachers, peers and other people
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Completes tasks willingly
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Plays cooperatively
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Participates actively in manipulative activities
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Follow rules and routines
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Accepts simple responsibilities
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
        </table>';

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
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Says simple prayers
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Shows concern for others
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Cares for plants and animals
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Accept criticism
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 11.19cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">Wait for one’s turn
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.75cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(225);

$pdf->SetLeftMargin(17);
$pdf->SetRightMargin(17);
// Add HTML table
$html = '<table border=".40" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 10px; ">ATTENDANCE<br>RECORD
                    </td>

                    <th style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size: 7.8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">August</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">Sept.</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.08cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">Oct.</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">Nov.</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">Dec.</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">Jan.</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">Feb.</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">March</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">April</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">May</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">June</div>
                    </th>

                    <th style="text-align: center; font-weight: normal; width: 1.89cm; font-family: times, sans-serif; font-size: 8px;">
                    <div style="writing-mode: vertical-rl; transform: rotate(90deg);">TOTAL</div>
                    </th>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">No. of School Days
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.08cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.89cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">No. of School Days Present
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.08cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.89cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">No. of School Days Absent
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.08cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.89cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 4.19cm; font-family: times, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.60cm;">No. of Times Tardy
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.08cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.13cm; font-family: times, sans-serif; font-size:7px; ">
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.89cm; font-family: times, sans-serif; font-size: 7px; ">
                    </td>
                </tr>
        </table>';

$pdf->writeHTML($html);



$pdf->setY(258);

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

$pdf->setY(264);

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

$filename = "Kinder" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>