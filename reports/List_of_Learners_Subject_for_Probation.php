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
$pdf = new  ListofLearnersSubjectforProbation('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();
$pdf->setY(44);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL', 0, 1, 'C');  
$pdf->Cell(0, 3, 'LIST OF LEARNERS SUBJECT FOR PROBATION', 0, 1, 'C');
$pdf->Cell(0, 3, 'Grade 10 Laconic | A.Y. 2021-2022', 0, 1, 'C');

$pdf->setY(66);


$pdf->SetLeftMargin(36);
$pdf->SetRightMargin(33);
// Add HTML table
$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.09cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">No.
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6.6cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Name of Learners
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6.99cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Subject/s with Grade < 80
                    </td>
                </tr>

                 <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.09cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6.6cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 2.54cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Subject
                    </td>

                     <td style="text-align: center; font-weight: bold; width: 4.45cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.80cm;">Grade
                    </td>
                </tr>

            <tr>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">1</td>
                <td style="font-weight: normal; font-size: 10px; font-family: tahoma, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;">Manibay, Gianne Karla r.</span></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">Science</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">78</td>
            </tr>

            <tr>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center"></td>
                <td style="font-weight: normal; font-size: 10px; font-family: tahoma, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;"></span></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">Math</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">79</td>
            </tr>

            <tr>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">2</td>
                <td style="font-weight: normal; font-size: 10px; font-family: tahoma, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;">Nuestro, Lavelle Corvine u.</span></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">Science</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">77</td>
            </tr>

            <tr>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">3</td>
                <td style="font-weight: normal; font-size: 10px; font-family: tahoma, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;">Pacheco, Jillian Isabel m.</span></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">Mathematics</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">78</td>
            </tr>

            <tr>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center"></td>
                <td style="font-weight: normal; font-size: 10px; font-family: tahoma, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;"></span></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">Technology</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">78</td>
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

$filename = "List_of_Learners_Subject_for_Probation" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>