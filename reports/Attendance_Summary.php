<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class AttendanceSummary extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
       parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
   }

   public function Header()
   {
        // Add image
       $this->Image('../assets/img/bsu logo.jpg', 90, 5.5, 35);
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
       $this->Cell(0, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas, Philippines 4231', 0, 1, 'C');

       // Add line divider
    $this->SetLineWidth(0.7);
$this->Line(0, $this->GetY() + 2, 356, $this->GetY() + 2); // Adjust the coordinates based on your needs

    }
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        $this->SetFont('helvetica', 'B', 12);
        $this->SetFont('', 'I', 12);
        
        $this->SetTextColor(210, 54, 59); // Red color
        $this->Cell(0, 1.0, 'Leading Innovations, Transforming Lives', 0, 1, 'C');

    
    }
}


// Example usage
$pdf = new  AttendanceSummary('L', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();
$pdf->setY(44);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL', 0, 1, 'C');  
$pdf->Cell(0, 3, 'ATTENDANCE SUMMARY', 0, 1, 'C');

$pdf->setY(60);


$pdf->SetLeftMargin(35);
$pdf->SetRightMargin(26.5);
// Add HTML table
$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>
            
                <tr>
                    <td style="text-align: right; font-weight: normal; width: 3.18cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Level/Section:
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 14.45cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Grade 10 Laconic
                    </td>

                    <td style="text-align: right; font-weight: normal; width: 8.57cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Academic Year:
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 3.20cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">2021-2022
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: normal; width: 3.18cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Adviser:
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 14.45cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Asst. Prof. Edwina D. Rodriguez
                    </td>

                    <td style="text-align: right; font-weight: normal; width: 8.57cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">Total Number of School Days:
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 3.20cm; font-family: times, sans-serif; font-size: 12px; vertical-align: middle; line-height: 0.45cm;">203
                    </td>
                </tr>

        </table>';

$pdf->writeHTML($html);

$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>
            
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.1cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">No.
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Name of Learners
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Aug
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Sept
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Oct
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Nov
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Dec
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Jan
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Feb
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">Mar
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">April
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">May
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.52cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 1.33cm;">June
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 2.40cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.69cm;">Total No. of Days Absent
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 2.66cm; font-family: Calibri, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.69cm;">Total No. of Days Present
                    </td>
                </tr>

             <tr>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"></td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="right">No. of School Days</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">17</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">21</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">23</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">20</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">10</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">21</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">19</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">22</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">21</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">20</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">9</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center"></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center"></td>
            </tr>

            <tr>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">1</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;">Abellera, Clarisse Faith a.</span></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">17</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">21</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">23</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">20</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">9</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">21</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">19</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">22</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">21</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">20</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">9</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">1</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">202</td>
            </tr>

             <tr>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">2</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="left"><span style="text-transform: uppercase;">Abellera, Sofia Gabrielle r.</span></td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">17</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">21</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">22</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">20</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">10</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">21</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">19</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">22</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">21</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">20</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">9</td>
                <td style="font-weight: normal; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">1</td>
                <td style="font-weight: bold; font-size: 10px; font-family: Calibri, sans-serif; vertical-align: middle; line-height: .50cm;" align="center">202</td>
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


$pdf->setx(48.5);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'Asst. Prof. EDWINA D. RODRIGUEZ ', 0, 0, 'L');
$pdf->setx(149);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'Ms. JINGLE G. GUEVARRA ', 0, 0, 'L');
$pdf->setx(250);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'Dr. JOSE ALEJANDRO R. BELEN ', 0, 0, 'L');


$pdf->setx(48.5);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 12, 'Adviser ', 0, 0, 'L');
$pdf->setx(149);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 12, 'Chairperson, High School ', 0, 0, 'L');
$pdf->setx(250);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 12, 'Principal ', 0, 0, 'L');


$pdf->setx(48.5);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, 'Date: ', 0, 0, 'L');
$pdf->setx(57.5);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, '10/28/2023 ', 0, 0, 'L');

$pdf->setx(149);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, 'Date: ', 0, 0, 'L');
$pdf->setx(158);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, '10/28/2023 ', 0, 0, 'L');

$pdf->setx(250);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, 'Date: ', 0, 0, 'L');
$pdf->setx(259);
$pdf->SetFont('times', 'N', 10);
$pdf->Cell(0, 35, '10/28/2023 ', 0, 0, 'L');



$pdf->setY(-30);
$pdf->SetFont('times', '', 10);

$filename = "Attendance_Summary" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>