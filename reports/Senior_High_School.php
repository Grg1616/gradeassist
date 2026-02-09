<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class SeniorHighSchool extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
       parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
   }

   public function Header()
   {
       $this->SetFont('helvetica', 'N', 8);
       $this->SetY(10);
       $this->Cell(0, 1.0, 'FORM 137-SHS', 0, 1, 'R');
    }
}


// Example usage
$pdf = new  SeniorHighSchool('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();

    // Add image
       $pdf->Image('../assets/img/bsu logo.jpg', 29, 10, 35);
       // Add text and font


       $pdf->SetFont('times', 'B', 12);
       $pdf->SetY(16);
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
       $pdf->Cell(200, 1.0, 'R. Martinez St., Brgy. Bucana, Nasugbu, Batangas', 0, 1, 'C');
       $pdf->SetFont('times', 'N', 10);
       $pdf->Cell(200, 1.0, 'Tel Nos.: (+63 43) 416 0349 loc. 114 / +63 919 079 0672', 0, 1, 'C');
        $pdf->SetFont('times', 'N', 10);
       $pdf->Cell(200, 1.0, 'Email Address: registrar.nasugbu@g.batstate-u.edu.ph | Website Address: http://www.batstate-u.edu.ph', 0, 1, 'C');

       // Add line divider
    $pdf->SetLineWidth(0.7);
$pdf->Line(5, $pdf->GetY() + 2, 210, $pdf->GetY() + 2); // Adjust the coordinates based on your needs

$pdf->setY(55);
$pdf->SetFont('times', 'B', 11); 
$pdf->Cell(0, 3, 'SENIOR HIGH SCHOOL STUDENT PERMANENT RECORD', 0, 1, 'C');
$pdf->Cell(0, 8, 'LEARNERS INFORMATION', 0, 1, 'C');


$pdf->setY(74);


$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table
$html = '<table>
            <thead>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.25cm; font-family: Calibri, sans-serif; font-size: 9px; ">NAME:
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 18.10cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 19.99cm; font-family: Calibri, sans-serif; font-size: 8px;">(Last, First, Middle)
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.25cm; font-family: Calibri, sans-serif; font-size: 9px; ">LRN:
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 3.40cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.06cm; font-family: Calibri, sans-serif; font-size: 9px; ">Date of Birth:
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.80cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.90cm; font-family: Calibri, sans-serif; font-size: 9px; ">Sex:
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.00cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 3.62cm; font-family: Calibri, sans-serif; font-size: 9px; ">Date of SHS Admission:
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.75cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 5.30cm; font-family: Calibri, sans-serif; font-size: 8px;">
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;">(MM/DD/YYYY)
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 3.70cm; font-family: Calibri, sans-serif; font-size: 8px;">
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;">(MM/DD/YYYY)
                    </td>
                </tr>

        </table>';

$pdf->writeHTML($html);

$pdf->setY(96);
$pdf->SetFont('times', 'B', 11); 
$pdf->Cell(0, 3, 'ELIGIBILITY FOR SHS ENROLLMENT', 0, 1, 'C');

// Draw a square box
$pdf->SetLineWidth(0.35);
$pdf->Rect(11, 109, 4.5, 4);

$pdf->setY(109);+

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: .70cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 4.50cm; font-family: Calibri, sans-serif; font-size: 9px;">Junior High School Completer</td>

                    <td style="text-align: left; font-weight: normal; width: .45cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.71cm; font-family: Calibri, sans-serif; font-size: 9px;">Gen. Ave.:</td>

                    <td style="text-align: center; font-weight: bold; width: 2.30cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 9px;">Date of Completion:</td>

                    <td style="text-align: left; font-weight: normal; width: 2.20cm; font-family: Calibri, sans-serif; font-size: 9px; border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .45cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.55cm; font-family: Calibri, sans-serif; font-size: 9px;">Name of School:</td>

                    <td style="text-align: left; font-weight: bold; width: 5.10cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .45cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.55cm; font-family: Calibri, sans-serif; font-size: 9px;">School Address:</td>

                    <td style="text-align: left; font-weight: bold; width: 3.10cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(125);
$pdf->SetFont('times', 'B', 11); 
$pdf->Cell(0, 3, 'SCHOLASTIC RECORD', 0, 1, 'C');


// GRADE 11 - FIRST SEM //

$pdf->setY(137);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.44cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL:</td>

                    <td style="text-align: left; font-weight: bold; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;  border-bottom: .6px solid black;">BatStateU-TNEU ARASOF-Nasugbu Campus
                    </td>


                <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL ID:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px;">GRADE LEVEL:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.40cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">11
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SY:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.81cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SEM:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.70cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">First
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 8.5px;">TRACK/STRAND:</td>

                    <td style="text-align: left; font-weight: bold; width: 7.40cm; font-family: Calibri, sans-serif; font-size: 8.5px; border-bottom: .6px solid black;">Science, Technology, Engineering and Mathematics
                    </td>        

                    <td style="text-align: left; font-weight: normal; width: 1.45cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SECTION:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.60cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">Obedience
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(152);

$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(11);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">COURSE<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;CODE</span>
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">COURSE TITLE
                    </td>   

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">CONTACT<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;&nbsp;HOURS</span>
                    </td>     

                    <td style="text-align: center; font-weight: bold; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">QUARTER
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">SEM FINAL<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;GRADE</span>
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">ACTION<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;TAKEN</span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">Grade 11 - First Semester
                    </td>      

                    <td style="text-align: center; font-weight: bold; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">1ST
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">2ND
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Filipino 11-A
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Komunikasyon sa Wika at Akademikong Filipino
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">English 11-A
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Reading and Writing Skills
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Mathematics 11-A
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Pre-Calculus
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">5
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Science 11-A
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">General Chemistry 2
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Computer Science 11
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Data Science
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Research 2
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Reasearch 2 (Knowledge, Innovation and Science Technology)
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Humanities 1
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Introduction to the Philosophy of Human Person
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: right; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Total
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">28
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 6.25.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 15.39.5cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">General Ave. for the Semester:
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);


// GRADE 11 - SECOND SEM //

$pdf->setY(225);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.44cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL:</td>

                    <td style="text-align: left; font-weight: bold; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;  border-bottom: .6px solid black;">BatStateU-TNEU ARASOF-Nasugbu Campus
                    </td>


                <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL ID:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px;">GRADE LEVEL:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.40cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">11
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SY:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.81cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SEM:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.09cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">Second
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 8.5px;">TRACK/STRAND:</td>

                    <td style="text-align: left; font-weight: bold; width: 7.40cm; font-family: Calibri, sans-serif; font-size: 8.5px; border-bottom: .6px solid black;">Science, Technology, Engineering and Mathematics
                    </td>        

                    <td style="text-align: left; font-weight: normal; width: 1.45cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SECTION:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.60cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">Obedience
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(240);

$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(11);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">COURSE<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;CODE</span>
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">COURSE TITLE
                    </td>   

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">CONTACT<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;&nbsp;HOURS</span>
                    </td>     

                    <td style="text-align: center; font-weight: bold; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">QUARTER
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">SEM FINAL<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;GRADE</span>
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">ACTION<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;TAKEN</span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">Grade 11 - Second Semester
                    </td>      

                    <td style="text-align: center; font-weight: bold; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">3RD
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">4TH
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Filipino 11-B
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Pananaliksik sa Filipino
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">English 11-B
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Oral Communication in Context
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Mathematics 11-B
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Differential Calculus
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">5
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Science 11-B
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">General Chemistry 3
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Humanities 2
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Contemporary Philippine Arts from the Regions
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Humanities 3
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Personal Development
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: right; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Total
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">23
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 6.25.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 15.39.5cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">General Ave. for the Semester:
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->AddPage();

// GRADE 12 - FIRST SEM //

$pdf->setY(20);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.44cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL:</td>

                    <td style="text-align: left; font-weight: bold; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;  border-bottom: .6px solid black;">BatStateU-TNEU ARASOF-Nasugbu Campus
                    </td>


                <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL ID:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px;">GRADE LEVEL:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.40cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">12
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SY:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.81cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SEM:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.70cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">First
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 8.5px;">TRACK/STRAND:</td>

                    <td style="text-align: left; font-weight: bold; width: 7.40cm; font-family: Calibri, sans-serif; font-size: 8.5px; border-bottom: .6px solid black;">Science, Technology, Engineering and Mathematics
                    </td>        

                    <td style="text-align: left; font-weight: normal; width: 1.45cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SECTION:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.60cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">Courage
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(35);

$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(11);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">COURSE<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;CODE</span>
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">COURSE TITLE
                    </td>   

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">CONTACT<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;&nbsp;HOURS</span>
                    </td>     

                    <td style="text-align: center; font-weight: bold; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">QUARTER
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">SEM FINAL<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;GRADE</span>
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">ACTION<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;TAKEN</span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">Grade 12 - First Semester
                    </td>      

                    <td style="text-align: center; font-weight: bold; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">1ST
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">2ND
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Filipino 12
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Masining na Pagpapahayag
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">English 12-A
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Media and Information Literacy
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Mathematics 12-A
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Integral Calculus 1
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">5
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Science 12-A
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Classical Physics 1 (Calculus Based)
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Science 12-B
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Molecular Biology
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Humanities 4
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Understanding Culture, Society, and Politics
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: right; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Total
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">24
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 6.25.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 15.39.5cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">General Ave. for the Semester:
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

// GRADE 12 - SECOND SEM //

$pdf->setY(103);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(16);
// Add HTML table
$html = '<table>
            <thead>
                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1.44cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL:</td>

                    <td style="text-align: left; font-weight: bold; width: 6.00cm; font-family: Calibri, sans-serif; font-size: 8px;  border-bottom: .6px solid black;">BatStateU-TNEU ARASOF-Nasugbu Campus
                    </td>


                <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SCHOOL ID:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 9px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 9px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px;">GRADE LEVEL:</td>

                    <td style="text-align: left; font-weight: bold; width: 0.40cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">12
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .55cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SY:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.81cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: .20cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 0.80cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SEM:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.09cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">Second
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.01cm; font-family: Calibri, sans-serif; font-size: 8.5px;">TRACK/STRAND:</td>

                    <td style="text-align: left; font-weight: bold; width: 7.40cm; font-family: Calibri, sans-serif; font-size: 8.5px; border-bottom: .6px solid black;">Science, Technology, Engineering and Mathematics
                    </td>        

                    <td style="text-align: left; font-weight: normal; width: 1.45cm; font-family: Calibri, sans-serif; font-size: 8.5px; ">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.50cm; font-family: Calibri, sans-serif; font-size: 8.5px;">SECTION:</td>

                    <td style="text-align: left; font-weight: bold; width: 1.60cm; font-family: Calibri, sans-serif; font-size: 8.5px;  border-bottom: .6px solid black;">Courage
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);

$pdf->setY(118);

$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(11);
// Add HTML table
$html = '<table border=".45" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">COURSE<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;CODE</span>
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">COURSE TITLE
                    </td>   

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">CONTACT<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;&nbsp;HOURS</span>
                    </td>     

                    <td style="text-align: center; font-weight: bold; width: 2.25cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">QUARTER
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">SEM FINAL<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;GRADE</span>
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 2cm; font-family: Calibri, sans-serif; font-size: 8.5px; line-height: 4;">
                    <span style="line-height: 1;">ACTION<br></span>
                    <span style="text-align: center;">&nbsp;&nbsp;TAKEN</span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">Grade 12 - Second Semester
                    </td>      

                    <td style="text-align: center; font-weight: bold; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">3RD
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8.5px; vertical-align: middle; line-height: 0.80cm;">4TH
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">FEnglish 12-B
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">English for Academic and Professional Purposes
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Mathematics 12-B
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Integral Calculus 2 and Linear Algebra
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">5
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Science 12-C
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Classical Physics 2 (Calculus Based)
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Science 12-D
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Introduction to Biotechnology
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Research 3
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">CResearch 3 (Knowledge, Innovation, and Science Technology)
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">3
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Computer Science 12
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Introduction to Artificial Intelligence
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">4
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">Humanities 5
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 7.5px; vertical-align: middle; line-height: 0.50cm;">Humanities 5
                    </td>

                    <td style="text-align: center; font-weight: normal; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 1.13cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 1.12.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 3.3cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: right; font-weight: bold; width: 8.00cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">Total
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 1.84cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">27
                    </td>      

                    <td style="text-align: left; font-weight: normal; width: 6.25.5cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 15.39.5cm; font-family: Calibri, sans-serif; font-size: 9px; vertical-align: middle; line-height: 0.50cm;">General Ave. for the Semester:
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: Calibri, sans-serif; font-size: 8px; vertical-align: middle; line-height: 0.50cm;">
                    </td>
                </tr>
            </thead>
        </table>';

$pdf->writeHTML($html);


$pdf->setY(190);

$pdf->setX(15);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 1.0, 'CERTIFICATE OF TRANSFER', 0, 0, 'C');

$pdf->setX(11);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 20, 'TO WHOM IT MAY CONCERN:', 0, 0, 'L');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 38, 'This certifies the true Senior High School Permanet Record of _________________________________. She is eligible for', 0, 0, 'L');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 46, 'admission to _________ as (a regular/irregular) student and has no property responsibility in this school.', 0, 0, 'L');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 65, 'This Certificate of Transfer is given this _____ day of ___________.', 0, 0, 'L');

$pdf->setY(230);

$pdf->setX(140);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 20, 'ERWIN R. ABIAD', 0, 0, 'C');

$pdf->setx(17);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 28, 'Registrar III/ Head, Registration Services', 0, 0, 'R');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 50, 'COPY VALID FOR:', 0, 0, 'L');

$pdf->setx(11);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->Cell(0, 85, 'Not valid without University dryseal', 0, 0, 'L');

$pdf->setY(-30);
$pdf->SetFont('times', '', 10);

$filename = "Senior_High_School" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>