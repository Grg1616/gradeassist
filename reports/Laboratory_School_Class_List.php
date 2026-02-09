<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class LaboratorySchoolClassList extends TCPDF
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
$pdf = new  LaboratorySchoolClassList('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();
$pdf->setY(47);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 4, 'LABORATORY SCHOOL', 0, 1, 'C');  
$pdf->Cell(0, 4, 'Class List', 0, 1, 'C');
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, '1st Semester, A.Y. 2022 - 2023', 0, 1, 'C');

$pdf->setX(20);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'Grade Level and Section:', 0, 0, 'L');
$pdf->setX(60);
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, 'Grade 7 Loyalty', 0, 0, 'L');

$pdf->setX(129);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'Adviser:', 0, 0, 'L');
$pdf->setX(143);
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, 'Asst. Prof. Maria Fe M. Bagon', 0, 0, 'L');


$pdf->setY(70);


$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(10.5);
// Add HTML table
$html = '<table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: center; font-weight: bold; width: 0.94cm; font-family: times, sans-serif; font-size: 9px;">No.
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.97cm; font-family: times, sans-serif; font-size: 9px;">SR-Code
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 4.58cm; font-family: times, sans-serif; font-size: 9px;">Name of Student
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.83cm; font-family: times, sans-serif; font-size: 9px;">Birthday
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.72cm; font-family: times, sans-serif; font-size: 9px;">Gender
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 2.5cm; font-family: times, sans-serif; font-size: 9px;">Contact No.
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 3.96cm; font-family: times, sans-serif; font-size: 9px;">Guardians Name
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.93cm; font-family: times, sans-serif; font-size: 9px;">Contact No.
                    </th>
                </tr>
            <tr>
                <td align="left">1</td>
                <td align="left">22-72458</td>
                <td align="left">Abellera, Lanz Earnest R.</td>
                <td align="center">21/09/2009</td>
                <td align="left">Male</td>
                <td align="left">9771680978</td>
                <td align="left">Marcelo D. Bautista</td>
                <td align="left"></td>
            </tr>
            <tr>
                <td align="left">2</td>
                <td align="left">22-79209</td>
                <td align="left">Alberto, Janzen D.</td>
                <td align="center">15/03/2008</td>
                <td align="left">Male</td>
                <td align="left">9560145281</td>
                <td align="left">Yoshiya Matsumoto</td>
                <td align="left"></td>
            </tr>
            
        </table>';


$pdf->writeHTML($html);
$pdf->setY(-30);
$pdf->SetFont('times', '', 10);

$filename = "Laboratory_School_Class_List" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>