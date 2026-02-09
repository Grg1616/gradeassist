<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class LaboratorySchooSummaryOfFinalGrades extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'cm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
{
    $format = 'LEGAL'; // Set paper size explicitly to legal
    parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
}


  public function Header()
{
    // Set margins
    $this->SetMargins(15, 40, 15); // Left, Top, Right

    // Add image
    $this->Image('../assets/img/bsu logo.jpg', 90, 5, 40);

    // Set Y position for text
    $this->SetY(5.5);

    // Add text and font
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 0, 'Republic of the Philippines', 0, 1, 'C');
    $this->SetFont('helvetica', 'B', 16);
    $this->Cell(0, 0, 'BATANGAS STATE UNIVERSITY', 0, 1, 'C');
    $this->SetFont('helvetica', 'B', 12);
    // $this->SetTextColor(210, 54, 59); // Red color
    $this->Cell(0, 0, 'The National Engineering University', 0, 1, 'C');
    $this->SetTextColor(0, 0, 0);
    $this->SetFont('helvetica', 'B', 12);
    $this->Cell(0, 0, 'ARASOF-Nasugbu Campus', 0, 1, 'C');
    $this->SetFont('helvetica', 'B', 10);
    $this->Cell(0, 12, 'LABORATORY SCHOOL', 0, 1, 'C');

    // Add line divider
    // $this->SetLineWidth(0.7);
    // $this->Line(0, 35, 356, 35); // Adjust as needed

 // Adjust the coordinates based on your needs

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
$pdf = new LaboratorySchooSummaryOfFinalGrades('L', 'mm', 'Legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->setY(58);
$pdf->AddPage();
$pdf->setY(42);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 6, 'SUMMARY OF FINAL GRADES', 0, 1, 'C'); 
$pdf->SetFont('helvetica', 'N', 12);
$pdf->Cell(0, 1.0, 'GRADE 10 LACONIC | A.Y. 2021-2022
', 0, 1, 'C');

 
$pdf->SetFont('times', '', 10);
$pdf->setY(58);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(3);
// Add HTML table
$html = '<table border="0.2" >
         
<tr>
                    <td style="text-align: center;
                    font-weight: bold; width: 5.5cm; font-family: times, sans-serif; font-size: 10px;"> 
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;"> FILIPINO
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;">ENGLISH 
                    </td>

                    <td style="text-align: center;  font-weight: bold;width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;">MATHEMATICS
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px; padding-left: 20px;">SCIENCE
                    </td>

                    <td style="text-align: center;  font-weight: bold;width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;">AP
                    </td>

                    <td style="text-align: center;font-weight: bold;width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;">TLE 
                    </td>

                    <td style="text-align: center;  font-weight: bold;width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;">MUSIC
                    </td>    
                </tr>

                <tr>
                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 5.5cm; vertical-align: middle; line-height: 1cm; font-family: helvetica, sans-serif; font-size: 10px;">NAMES OF LEARNERS
                    </td>

                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: Calibri, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>

                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>

                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>

                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>

                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>

                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>

                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td> 
                </tr>

                <tr>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                </tr>

                <tr>
                    <td align="center" width="0.5.5cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>1</b></td>
                    <td align="left" width="4.5.5cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">ABREU, LORDY JAKE A</td>
                    <td align="center" width="0.5.5cm"></td>

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>
                </tr>

                <tr>
                    <td align="center" width="0.5.5cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>1</b></td>
                    <td align="left" width="4.5.5cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">ABREU, LORDY JAKE A</td>
                    <td align="center" width="0.5.5cm"></td>

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>
                </tr>
                <tr>
                    <td align="center" width="0.5.5cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>1</b></td>
                    <td align="left" width="4.5.5cm" style="font-size: 7px;">MORCILLA, ALESSANDRA REGINE D.</td>
                    <td align="center" width="0.5.5cm"></td>

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>
                </tr>
                <tr>
                    <td align="center" width="0.5.5cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>1</b></td>
                    <td align="left" width="4.5.5cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">ABREU, LORDY JAKE A</td>
                    <td align="center" width="0.5.5cm"></td>

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>
                </tr>
                
                <tr>
                    <td align="center" width="0.5.5cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>1</b></td>
                    <td align="left" width="4.5.5cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">ABREU, LORDY JAKE A</td>
                    <td align="center" width="0.5.5cm"></td>

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>
                </tr>
                <tr>
                    <td align="center" width="0.5.5cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>1</b></td>
                    <td align="left" width="4.5.5cm" style="font-size: 7px;">MORCILLA, ALESSANDRA REGINE D.</td>
                    <td align="center" width="0.5.5cm"></td>

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>
                </tr>

        </table>';

$pdf->writeHTML($html);


$pdf->ln();
$pdf->setx(15);
$pdf->SetFont('times', 'N', 9);
$pdf->Cell(0, 6, 'Prepared by:', 0, 0, 'L'); 
$pdf->setx(140);
$pdf->Cell(0, 6, 'Checked and reviewed by:', 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 6, 'Approved: by:', 0, 1, 'L');
$pdf->setx(15);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(0, 10, 'Mr. ROY KRISTIAN T. VILLADELREY', 0, 0, 'L'); 
$pdf->setx(140);
$pdf->Cell(0, 10, 'Ms. JINGLE G. GUEVARRA', 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 10, 'Asst. Prof. LORENJANE E. BALAN', 0, 0, 'L');

$pdf->setx(15);
$pdf->SetFont('times', '', 9);
$pdf->Cell(0, 17, 'Adviser', 0, 0, 'L'); 

$pdf->setx(140);
$pdf->Cell(0, 17, 'Coordinator, JHS', 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 17, 'Principal', 0, 0, 'L');

$pdf->setx(15);
$pdf->SetFont('times', '', 9);
$pdf->Cell(0, 23, 'Date: __________', 0, 0, 'L'); 
$pdf->setx(140);
$pdf->Cell(0, 23, 'Date: __________', 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 23, 'Date: __________', 0, 0, 'L');

// another page

$pdf->AddPage();
$pdf->setY(58);
$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(3);
$html = '<table border="0.2" >
         
                <tr>
                

                    <td style="text-align: center; font-weight: bold; width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;"> ARTS
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;">PE 
                    </td>

                    <td style="text-align: center;  font-weight: bold;width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;">HEALTH
                    </td>

                    <td style="text-align: center; font-weight: bold; width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px; padding-left: 20px;">MAPEH
                    </td>

                    <td style="text-align: center;  font-weight: bold;width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;">ESP
                    </td>

                    <td style="text-align: center;font-weight: bold;width: 4.1cm; font-family: helvetica, sans-serif; font-size: 10px;">COMPUTER 
                    </td>

                    <td rowspan="3"style="text-align: center;  font-weight: bold;width: 1.3cm; font-family: helvetica, sans-serif; font-size: 10px;">
                    </td> 

                    <td rowspan="3"style="text-align: center;  font-weight: bold;width: .9cm; font-family: helvetica, sans-serif; font-size: 8px;">GEN. AVERAGE
                    </td>  
                </tr>

                <tr>
                    
                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: Calibri, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>
                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>
                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>
                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>
                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>
                    <td style="text-align: center;  font-weight: bold; width: 3.2cm; vertical-align: middle; line-height: 0.50cm; font-family: helvetica, sans-serif; font-size: 8px;">QUARTER
                    </td>

                    <td rowspan="2"style="text-align: center;  font-weight: bold; width: 0.90cm; font-family: helvetica, sans-serif; font-size: 8px;">FINAL GRADE
                    </td>
                    
                </tr>

                <tr>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm"style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
              
                </tr>

                <tr>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.9cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    
                 
                </tr>

                <tr>
        

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.9cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    
             
                </tr>
                <tr>
              

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.9cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    
                
                </tr>
                <tr>
    

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.9cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    
                    
                </tr>
                
                <tr>
              

                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.9cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
          
                    
                </tr>
                <tr>
               
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                    <td align="center" width="0.8cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>
                    <td align="center" width="0.90cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;"><b>5</b></td>


                    <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                    <td align="center" width="0.9cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                  
                    
                </tr>


        </table>';

$pdf->writeHTML($html);

$pdf->setY(58);
$pdf->setX(285);
$html = '<table border="0.2" >
           <tr>
                <td rowspan ="1"style="text-align: center; font-weight: bold; width: 1.3cm; font-family: helvetica, sans-serif; font-size: 7.5px;vertical-align: middle; line-height: 0.50cm;">1st Quarter Average
                </td> 
                <td rowspan ="1" style="text-align: center; font-weight: bold; width: 1.3cm; font-family: helvetica, sans-serif; font-size: 7.5px;vertical-align: middle; line-height: 0.50cm;">2nd Quarter Average
                </td> 
                <td rowspan ="1" style="text-align: center; font-weight: bold; width: 1.3cm; font-family: helvetica, sans-serif; font-size: 7.5px;vertical-align: middle; line-height: 0.50cm;">3rd Quarter Average
                </td> 
                <td rowspan ="1" style="text-align: center; font-weight: bold; width: 1.3cm; font-family: helvetica, sans-serif; font-size: 7.5px;vertical-align: middle; line-height: 0.50cm;">4th Quarter Average
                </td>        
            </tr>

            <tr>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>       
            </tr>

            <tr>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>        
            </tr>

            <tr>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>          
            </tr>

            <tr>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>     
            </tr>

            <tr>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>     
            </tr>

            <tr>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">1</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">2</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">3</td>
                <td align="center" width="1.3cm" style="font-size: 7px;vertical-align: middle; line-height: 0.50cm;">4</td>     
            </tr>

</table>';

$pdf->writeHTML($html);



$filename = "Summary_of_Final_Grades" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>