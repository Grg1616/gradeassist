<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class GeneralAverageListofLearnersWithAcademicExcellence extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
       parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
   }

   public function Header()
   {
        // Add image
       $this->Image('../assets/img/bsu logo.jpg', 20, 5.5, 35);
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
$pdf = new  GeneralAverageListofLearnersWithAcademicExcellence('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();
$pdf->setY(44);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL', 0, 1, 'C');  
$pdf->Cell(0, 3, 'LIST OF LEARNERS WITH ACADEMIC EXCELLENCE', 0, 1, 'C');
$pdf->Cell(0, 3, 'Grade 10 Laconic | A.Y. 2021-2022', 0, 1, 'C');

$pdf->setY(66);


$pdf->SetLeftMargin(34);
$pdf->SetRightMargin(31.5);
// Add HTML table
$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.09cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">No.
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6.08cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Name of Learners
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 3.77cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">General Average
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 4.12cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Honors Received
                    </td>
                </tr>

                <tr style="background-color: #bfbfbf;">
                    <th style="text-align: center; font-weight: bold; width: 1.09cm; font-family: times, sans-serif; font-size: 9px;">
                    </th>
                    
                    <th style="text-align: center; font-weight: bold; width: 6.08cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>

                    <th style="text-align: center; font-weight: bold; width:  1.88cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.88cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 4.12cm; font-family: Calibri, sans-serif; font-size: 9px;">
                    </th>
                </tr>

             <tr>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">1</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;">Abreu, Lordy Jake a.</span></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">98.16</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">98</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">With Highest Honors</td>
            </tr>

            <tr>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">1</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;">Hernandez, Jullia Clarrize l.</span></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">94.56</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">95</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">With High Honors</td>
            </tr>

        </table>';

$pdf->writeHTML($html);

$html = '<table>
            <thead>

                <tr>
                    <td style="height: 10px;">&nbsp;</td> <!-- Empty row for spacing -->
                </tr>

            </table>';

$pdf->writeHTML($html);


$pdf->setX(16);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 1.0, 'Prepared and submitted by:', 0, 0, 'L');
$pdf->setX(87);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 1.0, 'Checked and verified:', 0, 0, 'L');
$pdf->setX(144);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 1.0, 'Approved by:', 0, 0, 'L');


$pdf->setx(16);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 28, 'Asst. Prof. EDWINA D. RODRIGUEZ ', 0, 0, 'L');
$pdf->setx(87);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 28, 'Ms. JINGLE G. GUEVARRA ', 0, 0, 'L');
$pdf->setx(144);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 28, 'Dr. JOSE ALEJANDRO R. BELEN ', 0, 0, 'L');


$pdf->setx(16);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 36, 'Subject Teacher ', 0, 0, 'L');
$pdf->setx(87);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 36, 'Chairperson, High School ', 0, 0, 'L');
$pdf->setx(144);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 36, 'Principal ', 0, 0, 'L');


$pdf->setx(16);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, 'Date: ', 0, 0, 'L');
$pdf->setx(25);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, '10/28/2023 ', 0, 0, 'L');

$pdf->setx(87);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, 'Date: ', 0, 0, 'L');
$pdf->setx(96);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, '10/28/2023 ', 0, 0, 'L');

$pdf->setx(144);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, 'Date: ', 0, 0, 'L');
$pdf->setx(153);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 59, '10/28/2023 ', 0, 0, 'L');



$pdf->setY(-30);
$pdf->SetFont('times', '', 10);

$filename = "GeneralAverage_List_of_Learners_With_Academic_Excellence" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>