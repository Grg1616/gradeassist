<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class ListofallFaculty extends TCPDF
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
$pdf = new ListofallFaculty('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();
$pdf->setY(50);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LIST OF LABORATORY SCHOOL FACULTY', 0, 1, 'C');  
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, 'A.Y. 2022 – 2023', 0, 1, 'C'); 

$pdf->setY(70);
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
// Add HTML table
$html = '<table border="1" >
            <thead>
                <tr>
                    <th style="text-align: center; font-weight: bold; width: 0.9cm; font-family: times, sans-serif; font-size: 10px;">No.
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 4.25cm; font-family: times, sans-serif; font-size: 10px;">Name of Faculty
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 3.65cm; font-family: times, sans-serif; font-size: 10px;">Rank
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 2.26cm; font-family: times, sans-serif; font-size: 10px;">Gender
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 3.97cm; font-family: times, sans-serif; font-size: 10px;">Status
                    </th>
                    <th style="text-align: center; font-weight: bold; width: 2.55cm; font-family: times, sans-serif; font-size: 10px;">Department
                    </th>
                </tr>
            <tr>
               <td align="center">1</td>
                <td align="center">Abellera, Wilfredo U.</td>
                <td align="center">Assistant Professor III</td>
                <td align="left">Male</td>
                <td align="left">Permanent</td>
                <td align="center">High School</td>
            </tr>
            <tr>
                <td align="center">2</td>
                <td align="center">Abellera, Wilfredo U.</td>
                <td align="center">GC 2260</td>
                <td align="center">Row 1, Cell 4</td>
                <td align="center">Row 1, Cell 5</td>
                <td align="center">Row 1, Cell 6</td>
            </tr>
            
        </table>';


$pdf->writeHTML($html);
$pdf->setY(-30);
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, 'Date Printed: 01/07/2023', 0, 1, 'L');

$filename = "List_of_all_Faculty-" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>