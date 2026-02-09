<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class LaboratorySchoolListOfSubjects extends TCPDF
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
$pdf = new LaboratorySchoolListOfSubjects('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();
$pdf->setY(50);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL', 0, 1, 'C'); 
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 1.0, 'List of Subjects', 0, 1, 'C');
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, '1st Semester, A.Y. 2022 – 2023', 0, 1, 'C'); 
$pdf->setX(25);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 1.0, 'Grade Level:', 0, 0, ''); 
$pdf->setX(50);
$pdf->SetFont('times', '', 12);
$pdf->Cell(0, 1.0, 'Grade 7 Loyalty', 0, 0, ''); 

$pdf->setX(110);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 1.0, 'Adviser:', 0, 0, ''); 
$pdf->setX(126);
$pdf->SetFont('times', '', 12);
$pdf->Cell(0, 1.0, 'Asst. Prof. Maria Fe M. Bagon ', 0, 0, ''); 

$pdf->SetFont('times', '', 10);
$pdf->setY(80);
$pdf->SetLeftMargin(13);
$pdf->SetRightMargin(13);
// Add HTML table
$html = '<table border="1">
            <thead>
                <tr>
                    <th style="text-align: center; font-weight: bold; width: 3.49cm; font-family: times, sans-serif; font-size: 10px;">Course Code
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 8.57cm; font-family: times, sans-serif; font-size: 10px;">Description
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 1.86cm; font-family: times, sans-serif; font-size: 10px;">Contact Hours
                    </th>

                    <th style="text-align: center; font-weight: bold; width: 5.08cm; font-family: times, sans-serif; font-size: 10px;">Subject Teacher
                    </th>

                    
                </tr>
            <tr>
               <td align="center">Filipino 7</td>
                <td align="left">Panitikang Panrehiyon at Panuntunang Pambalarila </td>
                <td align="center">3</td>
                <td align="left">Ms. Mercedes M. Sevilla</td>
                
            </tr>

            <tr>
                <td align="center">2</td>
                <td align="center">Row 1, Cell 2</td>
                <td align="center">GC 2260</td>
                <td align="center">Row 1, Cell 4</td>
              </tr>   
            
        </table>';


$pdf->writeHTML($html);


$filename = "Laboratory_School_List_of_Subjects_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'D');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';
?>