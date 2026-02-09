<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class G1G10ReportCard extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);

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
$pdf->AddPage();

$pdf->Image('../assets/img/bsu logo.jpg', 35, 5.5, 35);
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
                <td style="text-align: left; font-weight: bold; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px; border-bottom: 1px solid black;">Smith, Diana L.</td>
            </tr>

            <tr>
               <td style="text-align: left; font-weight: normal; width: 1.2cm; font-family: helvetica, sans-serif; font-size: 12px;">LRN:</td>
               <td style="text-align: left; font-weight: bold; width: 5cm; font-family: helvetica, sans-serif; font-size: 12px; border-bottom: 1px solid black;">107511140019</td> 
            </tr>

            <tr>
                <td style="text-align: left; font-weight: normal; width: 1.2cm; font-family: helvetica, sans-serif; font-size: 12px;">Age:</td>
                <td style="text-align: left; font-weight: bold; width: 5cm; font-family: helvetica, sans-serif; font-size: 12px;border-bottom: 1px solid black;">14 </td>
                <td style="text-align: left; font-weight: bold; width: 5.5cm; font-family: helvetica, sans-serif; font-size: 12px;"></td>
                <td style="text-align: left; font-weight: normal; width: 1.2cm; font-family: helvetica, sans-serif; font-size: 12px;">Sex:</td>
               <td style="text-align: left; font-weight: bold; width: 5cm; font-family: helvetica, sans-serif; font-size: 11px;border-bottom: 1px solid black;">Female  
    </td>
            </tr>

             <tr>
                <td style="text-align: left; font-weight: normal; width: 1.6cm; font-family: helvetica, sans-serif; font-size: 12px;">Grade:</td>
                <td style="text-align: left; font-weight: bold; width: 4.6cm; font-family: helvetica, sans-serif; font-size: 12px;border-bottom: 1px solid black;">8 </td>
                <td style="text-align: left; font-weight: bold; width: 5.5cm; font-family: helvetica, sans-serif; font-size: 12px;"></td>
                <td style="text-align: left; font-weight: normal; width: 1.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Section:</td>
                <td style="text-align: left; font-weight: bold; width: 4.4cm; font-family: helvetica, sans-serif; font-size: 12px;border-bottom: 1px solid black;">FREEDOM </td>
            </tr>

            <tr>
               <td style="text-align: left; font-weight: normal; width: 2.7cm; font-family: helvetica, sans-serif; font-size: 12px;">School Year:</td>
               <td style="text-align: left; font-weight: bold; width: 3.5cm; font-family: helvetica, sans-serif; font-size: 12px;border-bottom: 1px solid black;">2022 – 2023 </td>  
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
$pdf->Cell(0, 1.0, 'Mr. ROY KRISTIAN T. VILLADELREY', 0, 1, 'R');
$pdf->SetFont('helvetica', 'N', 11);
$pdf->setX(160);
$pdf->Cell(0, 1.0, 'Adviser', 0, 1, 'L');
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 1.0, 'Dr. JOSE ALEJANDRO R. BELEN', 0, 1, 'L');
$pdf->SetFont('helvetica', 'N', 11);
$pdf->setX(36);
$pdf->Cell(0, 1.0, 'Principal', 0, 1, 'L');
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 2.5, 'REPORT ON LEARNING PROGRESS AND ACHIEVEMENT', 0, 1, 'C');

$html = '<table border="1" style="border-colapse: collapse; width: 100%">

                <tr>
                    <td rowspan="2"style="text-align: center; font-weight: bold; width: 8cm;vertical-align: middle; line-height: 1.5cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">Learning Areas
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 6cm; vertical-align: middle; line-height: 0.60cm;font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">Quarter
                    </td>

                    <td rowspan="2"style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: .70cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">Final Grade

                    </td>

                    <td rowspan="2"style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 1.5cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">Remarks
                    </td>

                    
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">1
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">2
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">3
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;background-color: #f0f0f0;">4
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; Filipino 8</td>


                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; English 8</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; Mathematics 8</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; Science 8-A</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; Science 8-B</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; Technology 8</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; Computer Science 8</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; Drawing 2</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; Araling Panlipunan 8</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; Edukasyon sa Pagpapahalaga 8</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp; MAPEH 8</td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Music 8</td>

                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Arts 8</td>

                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Physical Education 8</td>

                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Health 8</td>




                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">94
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 1.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">96
                    </td>
                    <td style="text-align: center; font-weight: normal; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">Passed
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px; margin: 5px;"></td>

                    <td style="text-align: center; font-weight: bold; width: 6cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">General Average
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 12px;">95
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 2.5cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 12px;">
                    </td>
                </tr>
            
        </table>';


$pdf->writeHTML($html);

$html = '<table border="1" style="border-colapse: collapse; width: 100%">
            <tr>
                    <td style="text-align: center; font-weight: bold; width: 4.1cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px; background-color: #f0f0f0;"></td>


                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">AUG
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">SEP
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">OCT
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">NOV
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">DEC
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">JAN
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">FEB
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">MAR
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">APR
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">MAY
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">JUN
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.7cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">TOTAL
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 4.1cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">No. of school days</td>

                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">11
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">20
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">20
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">17
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">11
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">17
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">20
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">23
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">18
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">22
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">7
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.7cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">186
                    </td>
                </tr>

                 <tr>
                    <td style="text-align: center; font-weight: bold; width: 4.1cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">No. of school days</td>

                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">11
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">20
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">20
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">17
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">11
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">17
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">20
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">23
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">18
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">22
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">7
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.7cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">186
                    </td>
                </tr>

                 <tr>
                    <td style="text-align: center; font-weight: bold; width: 4.1cm; vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">No. of days absent</td>

                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.2cm; vertical-align: middle; line-height: 0.75cm;font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                    <td style="text-align: center; font-weight: bold; width: 1.7cm;vertical-align: middle; line-height: 0.75cm; font-family: helvetica, sans-serif; font-size: 11px;">0
                    </td>
                </tr>
</table>';

$pdf->writeHTML($html);

$pdf->setX(55);
$html = '<table >
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 4.8cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;">Descriptors</td>
                    <td style="text-align: center; font-weight: bold; width: 3.5cm;vertical-align: middle; line-height: 0.68cm; font-family: helvetica, sans-serif; font-size: 11px;">Grading Scale
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
$html = '<table border="1" style="border-colapse: collapse; width: 100%" >
        
                <tr>
                    <td style="text-align: center;vertical-align: middle; line-height: 0.68cm; font-weight: bold; width: 5cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;background-color: #f0f0f0;">Core Values</td>

                    <td style="text-align: center; font-weight: bold; width: 9cm;vertical-align: middle; line-height: 0.68cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">Behavior Statements
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 0.68cm; font-weight: bold; width: 5cm; font-family: helvetica, sans-serif; font-size: 11px;background-color: #f0f0f0;">Quarter
                    </td>
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: left;vertical-align: middle; line-height: 2cm; font-weight: normal; width: 5cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;">1. Makadiyos</td>

                    <td style="text-align: left; font-weight: normal; width: 9cm; font-family: helvetica, sans-serif; font-size: 11px;">Expresses one’s  spiritual beliefs while respecting the spiritual beliefs of others
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm;font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm;font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
             
                </tr>

                <tr>
                    
                    <td style="text-align: left; font-weight: normal; width: 9cm; font-family: helvetica, sans-serif; font-size: 11px;">Shows adherence to ethical principles by upholding truth
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm;font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
             
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: left; vertical-align: middle; line-height: 2cm; font-weight: normal; width: 5cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;">2. Makatao</td>

                    <td style="text-align: left; font-weight: normal; width: 9cm; font-family: helvetica, sans-serif; font-size: 11px;">Is sensitive to individual, social, and cultural differences
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
             
                </tr>

                <tr>
                    
                    <td style="text-align: left; font-weight: normal; width: 9cm; vertical-align: middle; line-height: .80cm;font-family: helvetica, sans-serif; font-size: 11px;">Demonstrates contributions toward solidarity
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
             
                </tr>

                <tr>
                    <td style="text-align: left; vertical-align: middle; line-height: 1cm;font-weight: normal; width: 5cm;  font-family: helvetica, sans-serif; normalfont-size: 11px;">3. Maka-kalikasan</td>

                    <td style="text-align: left; font-weight: normal; width: 9cm; font-family: helvetica, sans-serif; font-size: 11px;">Cares for the environment and utilizes resources wisely, judiciously, and economically
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
             
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: left; font-weight: normal; width: 5cm; vertical-align: middle; line-height: 2cm;font-family: helvetica, sans-serif; font-size: 11px;">4. Makabansa
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 9cm; font-family: helvetica, sans-serif; font-size: 11px;">Demonstrates pride in being a Filipino; exercise the rights and responsibilities of a Filipino citizen
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
             
             
                </tr>

                <tr>
                   
                    <td style="text-align: left; font-weight: normal; width: 9cm; font-family: helvetica, sans-serif; font-size: 11px;">Demonstrates appropriate behavior in carrying out activities in the school, community, and country
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
                    <td style="text-align: center; vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.25cm; font-family: helvetica, sans-serif; font-size: 11px;">AO
                    </td>
             
             
                </tr>
</table>';

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
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;">AO</td>
                 
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Always Observed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;">SO</td>
                   
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Sometimes Observed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;">RO</td>
                    
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Rarely Observed
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm;font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;">NO</td>
                    
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 4.8cm; font-family: helvetica, sans-serif; font-size: 12px;">Not Observed
                    </td>
                </tr>
                
</table>';

$pdf->writeHTML($html);

// gardian signature table

$html = '<table >
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 19cm;  vertical-align: middle; line-height: 1.5cm; font-family: helvetica, sans-serif; bold;font-size: 14px;">PARENT’S / GUARDIAN’S SIGNATURE</td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: 1.5cm; font-weight: bold; width: 4cm;  font-family: helvetica, sans-serif; font-size: 14px;">First Quarter</td>
                 
                    <td style="text-align: left; vertical-align: middle; line-height: 1.5cm; font-weight: normal; width: 12cm; font-family: helvetica, sans-serif; font-size: 12px;">__________________________________________________
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: 1.5cm; font-weight: bold; width: 4cm;  font-family: helvetica, sans-serif; font-size: 14px;">Second Quarter</td>
                 
                    <td style="text-align: left; vertical-align: middle; line-height: 1.5cm; font-weight: normal; width: 12cm; font-family: helvetica, sans-serif; font-size: 12px;">__________________________________________________
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: 1.5cm; font-weight: bold; width: 4cm;  font-family: helvetica, sans-serif; font-size: 14px;">Third Quarter</td>
                 
                    <td style="text-align: left; vertical-align: middle; line-height: 1.5cm; font-weight: normal; width: 12cm; font-family: helvetica, sans-serif; font-size: 12px;">__________________________________________________
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 12px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: 1.5cm; font-weight: bold; width: 4cm;  font-family: helvetica, sans-serif; font-size: 14px;">Fourth Quarter</td>
                 
                    <td style="text-align: left; vertical-align: middle; line-height: 1.5cm; font-weight: normal; width: 12cm; font-family: helvetica, sans-serif; font-size: 12px;">__________________________________________________
                    </td>
                </tr>             
</table>';

$pdf->writeHTML($html);

// certificate to transfer table

$html = '<table>
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 19cm;  vertical-align: middle; line-height: 1.5cm; font-family: helvetica, sans-serif; bold;font-size: 14px;">Certificate of Transfer</td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 2.5cm;  font-family: helvetica, sans-serif; font-size: 13px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 4cm;  font-family: helvetica, sans-serif; font-size: 13px;">Admitted to Grade </td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: bold; width: 5.5cm;  font-family: helvetica, sans-serif; font-size: 13px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;8</td>
                 
                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1.7cm; font-family: helvetica, sans-serif; font-size: 13px;">Section
                    </td>
                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 4.3cm; font-family: helvetica, sans-serif; font-size: 13px;border-bottom: 1px solid black;">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .78cm; font-weight: normal; width: 2.5cm;  font-family: helvetica, sans-serif; font-size: 13px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: .78cm; font-weight: normal; width: 6.8cm;  font-family: helvetica, sans-serif; font-size: 13px;">Eligibility for Admission to Grade  </td>

                    <td style="text-align: left; font-weight: normal; width: 8.7cm;  font-family: helvetica, sans-serif; font-size: 13px;">__________________________________</td>
                 
                    
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
$pdf->Cell(0, 0, 'Mr. ROY KRISTIAN T. VILLADELREY', 0, 1, 'L');

$pdf->setX(60);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->Cell(0, 0, 'Chancellor', 0, 0, 'L');

$pdf->setX(150);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->Cell(0, 0, 'Adviser', 0, 1, 'L');
$pdf->ln();
$html = '<table >
                <tr>
                    <td style="text-align: center; font-weight: bold; width: 19cm;  vertical-align: middle; line-height: 2cm; font-family: helvetica, sans-serif; bold;font-size: 14px;">Cancellation of Eligibility to Transfer</td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3cm;  font-family: helvetica, sans-serif; font-size: 13px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 2.6cm;  font-family: helvetica, sans-serif; font-size: 13px;">Admitted in </td>

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

$filename = "G1-G10_Format" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>