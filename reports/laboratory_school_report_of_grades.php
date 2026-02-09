<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class QuarterlyReportOfGrades extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'cm', $format = 'legal', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
{
    $format = 'LEGAL'; // Set paper size explicitly to legal
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
$pdf = new QuarterlyReportOfGrades('L', 'mm', 'Legal'); // 'P' for portrait orientation, 'mm' for millimeters

$pdf->AddPage();
$pdf->setY(42);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'LABORATORY SCHOOL', 0, 1, 'C'); 
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 1.0, 'REPORT OF GRADES', 0, 1, 'C');

 
$pdf->SetFont('times', '', 10);
$pdf->setY(58);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(9.5);
// Add HTML table
$html = '<table border="1" >
         
                <tr>
                    <td style="text-align: center; width: 4.49cm; font-family: times, sans-serif; font-size: 10px;">Quarter/Term: 
                    </td>

                    <td style="text-align: left; font-weight: bold; width: 4.92cm; font-family: times, sans-serif; font-size: 10px;"> First
                    </td>

                    <td style="text-align: right; width: 5.56cm; font-family: times, sans-serif; font-size: 10px;">Academic Year: 
                    </td>

                    <td style="text-align: left;  font-weight: bold;width: 2.86cm; font-family: times, sans-serif; font-size: 10px;"> 2021-2022
                    </td>

                    <td style="text-align: right; width: 4.65cm; font-family: times, sans-serif; font-size: 10px; padding-left: 20px;">Level/Section:</td>

                    <td style="text-align: left;  font-weight: bold;width: 5.24cm; font-family: times, sans-serif; font-size: 10px;"> Grade 10 Laconic
                    </td>

                    <td style="text-align: center;width: 2.95cm; font-family: times, sans-serif; font-size: 10px;">Hrs/wk: 
                    </td>

                    <td style="text-align: center;  font-weight: bold;width: 2.95cm; font-family: times, sans-serif; font-size: 10px;"> 4
                    </td>    
                </tr>

                <tr>
                   <td align="center">Subject Code:</td>
                    <td align="left"><strong> English 10 </strong></td>
                    <td align="right">Subject Description: </td>
                    <td align="left" width="18.65cm"><strong> Communication Arts in English</strong></td>   
                </tr>
     
        </table>';

$pdf->writeHTML($html);

$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(9.5);
$html = '<table border="1" >
   
            <tr>
                <td style="text-align: center;font-weight: bold; width: 0.90cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">No.</td>

                <td style="text-align: center; font-weight: bold; width: 6cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">LEARNERS NAMES</td>

                <td style="text-align: center;font-weight: bold ;width: 9cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">WRITTEN WORKS (30%)</td>

                <td style="text-align: center;  font-weight: bold;width: 9cm; font-family: times, sans-serif; font-size: 9px;vertical-align: middle; line-height: 0.75cm;">PERFORMANCE TASKS (50%)</td>

                <td style="text-align: center;font-weight: bold;width: 4cm; font-family: times, sans-serif; font-size: 9px;">QUARTERLY ASSESSMENT (20%) </td>

                <td rowspan="3"style="text-align: center;  font-weight: bold;width: 2.22cm;vertical-align: middle; line-height: 1.70cm; font-family: Calibri, sans-serif; font-size: 9px;">Initial Grade</td>

                <td rowspan="3" style="text-align: center; font-weight: bold; width: 2.50cm; vertical-align: middle; line-height: 1.70cm; font-family: Calibri, sans-serif; font-size: 9px;">Quarterly Grade</td>   
            </tr>

            <tr>
                <td align="center"><b></b></td>
                <td align="left"><b></b></td>
                <td align="center" width="0.85cm"><b>1</b></td>
                <td align="center" width="0.85cm"><b>2</b></td>
                <td align="center" width="0.85cm"><b>3</b></td>
                <td align="center" width="0.85cm"><b>4</b></td>
                <td align="center" width="0.85cm"><b>5</b></td>
                <td align="center" width="1.55cm"><b>Total</b></td>
                <td align="center" width="1.60cm"><b>PS</b></td>
                <td align="center" width="1.60cm"><b>WS</b></td>
                <td align="center" width="0.85cm"><b>1</b></td>
                <td align="center" width="0.85cm"><b>2</b></td>
                <td align="center" width="0.85cm"><b>3</b></td>
                <td align="center" width="0.85cm"><b>4</b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="1.55cm"><b>Total</b></td>
                <td align="center" width="1.60cm"><b>PS</b></td>
                <td align="center" width="1.60cm"><b>WS</b></td>
                <td align="center" width="0.80cm"><b></b></td>
                <td align="center" width="1.60cm"><b>PS</b></td>
                <td align="center" width="1.60cm"><b>WS</b></td>  
            </tr>

            <tr>
                <td align="center"><b></b></td>
                <td align="right"><b>Number of item</b></td>
                <td align="center" width="0.85cm"><b>10</b></td>
                <td align="center" width="0.85cm"><b>30</b></td>
                <td align="center" width="0.85cm"><b>15</b></td>
                <td align="center" width="0.85cm"><b>20</b></td>
                <td align="center" width="0.85cm"><b>10</b></td>
                <td align="center" width="1.55cm"><b>85</b></td>
                <td align="center" width="1.60cm"><b>100.00</b></td>
                <td align="center" width="1.60cm"><b>30%</b></td>
                <td align="center" width="0.85cm"><b>30</b></td>
                <td align="center" width="0.85cm"><b>15</b></td>
                <td align="center" width="0.85cm"><b>10</b></td>
                <td align="center" width="0.85cm"><b>10</b></td>
                <td align="center" width="0.85cm"><b></b></td>
                <td align="center" width="1.55cm"><b>65</b></td>
                <td align="center" width="1.60cm"><b>100.00</b></td>
                <td align="center" width="1.60cm"><b>50%</b></td>
                <td align="center" width="0.80cm"><b>75</b></td>
                <td align="center" width="1.60cm"><b>100.00</b></td>
                <td align="center" width="1.60cm"><b>20%</b></td>  
            </tr>

            <tr style="background-color: #bfbfbf;">
                <td align="center"></td>
                <td align="left"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="0.80cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="1.60cm"></td>
                <td align="center"width="2.22cm"></td>
                <td align="center"width="2.50cm"></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            <tr>
                <td align="center">1</td>
                <td align="left"> ABREU, LORDY JAKE A.</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">26</td>
                <td align="center"width="0.85cm">15</td>
                <td align="center"width="0.85cm">20</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="1.55cm">80</td>
                <td align="center"width="1.60cm"><b>94.12</b></td>
                <td align="center"width="1.60cm"><b>28.24</b></td>
                <td align="center"width="0.85cm">30</td>
                <td align="center"width="0.85cm">13</td>
                <td align="center"width="0.85cm">10</td>
                <td align="center"width="0.85cm">8</td>
                <td align="center"width="0.85cm"></td>
                <td align="center"width="1.55cm">61</td>
                <td align="center"width="1.60cm"><b>93.85</b></td>
                <td align="center"width="1.60cm"><b>46.93</b></td>
                <td align="center"width="0.80cm">61</td>
                <td align="center"width="1.60cm"><b>81.33</b></td>
                <td align="center"width="1.60cm"><b>16.27</b></td>
                <td align="center"width="2.22cm"><b>91.44</b></td>
                <td align="center"width="2.50cm"><b>94</b></td>
            </tr>

            
        </table>';

$pdf->writeHTML($html);

$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->setx(40);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(0, 6, 'Asst. Prof. EDWINA D. RODRIGUEZ', 0, 0, 'L'); 
$pdf->setx(140);
$pdf->Cell(0, 6, 'Ms. JINGLE G. GUEVARRA', 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 6, 'Dr. JOSE ALEJANDRO R. BELEN', 0, 1, 'L');

$pdf->setx(40);
$pdf->SetFont('times', '', 9);
$pdf->Cell(0, 0, 'Subject Teacher', 0, 0, 'L'); 
$pdf->setx(140);
$pdf->Cell(0, 0, 'Chairperson, High School', 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 0, 'Principal', 0, 0, 'L');
$pdf->ln();
$pdf->ln();
$pdf->ln();
$pdf->setx(40);
$pdf->SetFont('times', '', 9);
$pdf->Cell(0, 0, 'Date: 10/28/2023', 0, 0, 'L'); 
$pdf->setx(140);
$pdf->Cell(0, 0, 'Date: 10/28/2023', 0, 0, 'L');
$pdf->setx(240);
$pdf->Cell(0, 0, 'Date: 10/28/2023', 0, 0, 'L');

$filename = "LABORATORY_SCHOOL_REPORT_OF_GRADES" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>