<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class Kinder2Form138 extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
{
    parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
}

   public function Header()
   {
      
    }
    // Page footer
    public function Footer() {

    }

}


// Example usage
$pdf = new Kinder2Form138('L', 'mm', 'A4'); // 'P' for portrait orientation, 'mm' for millimeters


// another page
$pdf->AddPage();

$pdf->SetFont('times', 'B', 11);
$pdf->setX(40);
$pdf->Cell(0, 2.5, 'REPORT ON ATTENDANCE', 0, 0, 'L');
$pdf->SetFont('times', 'B', 11);

$pdf->Cell(0, 2.5, 'FORM 138', 0, 1, 'R');

// report on learners observed values table
$pdf->ln();
$html = '<table border="1" style="border-colapse: collapse; width: 100%" >
        

                <tr>
                    <td  style="text-align: center; font-weight: bold; width: 2cm;  font-family: times, sans-serif; font-size: 7px;background-color: #f0f0f0;"></td>
                
                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.81cm; font-family: times, sans-serif; font-size: 7px;">AUG
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.81cm; font-family: times, sans-serif; font-size: 7px;">SEP
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.82cm; font-family: times, sans-serif; font-size: 7px;">OCT
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.82cm; font-family: times, sans-serif; font-size: 7px;">NOV
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.82cm; font-family: times, sans-serif; font-size: 7px;">DEC
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.82cm; font-family: times, sans-serif; font-size: 7px;">JAN
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.82cm; font-family: times, sans-serif; font-size: 7px;">FEB
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.82cm; font-family: times, sans-serif; font-size: 7px;">MAR
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.82cm; font-family: times, sans-serif; font-size: 7px;">APR
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.82cm; font-family: times, sans-serif; font-size: 7px;">MAY
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.82cm; font-family: times, sans-serif; font-size: 7px;">JUN
                    </td>

                    <td  style="text-align: center; background-color: #f0f0f0;  font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 7px;">Total
                    </td>
             
                </tr>

               <tr>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: times, sans-serif; font-size: 8px;">No. of school days
                    </td>
                
                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.81cm; font-family: times, sans-serif; font-size: 8px;">1
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.81cm; font-family: times, sans-serif; font-size: 8px;">26
                    </td>

                    <td style="text-align: center; font-weight: normal;  vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">26
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">23
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">15
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">13
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">22
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">27
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">23
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">24
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">3
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 1cm; font-family: times, sans-serif; font-size: 8px;">203
                    </td>
             
                </tr>

                <tr>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: times, sans-serif; font-size: 8px;">No. of days present
                    </td>
                
                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.81cm; font-family: times, sans-serif; font-size: 8px;">1
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.81cm; font-family: times, sans-serif; font-size: 8px;">26
                    </td>

                    <td style="text-align: center; font-weight: normal;  vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">26
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">23
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">15
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">13
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">22
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">27
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">23
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">24
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">3
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 1cm; font-family: times, sans-serif; font-size: 8px;">203
                    </td>
             
                </tr>

                 <tr>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: times, sans-serif; font-size: 8px;">No. of days absent
                    </td>
                
                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.81cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.81cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal;  vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>

                    <td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 1cm; font-family: times, sans-serif; font-size: 8px;">0
                    </td>
             
                </tr>

               
</table>';

$pdf->writeHTML($html);


$pdf->SetFont('times', 'I', 7.5);
$pdf->Cell(0, 2.5, '* Alternative Delivery Mode (ADM) option was undertaken for the entire academic year due to COVID-19', 0, 1, 'L');
$pdf->SetFont('times', 'I', 7.5);
$pdf->Cell(0, 2.5, 'pandemic.  Saturdays are included as Task/Activity Days:', 0, 1, 'L');
$pdf->SetFont('times', 'N', 7.5);

// gardian signature table

$html = '<table >

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 10cm; font-family: times, sans-serif; bold;font-size: 11px;"></td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 10cm;font-family: times, sans-serif; bold;font-size: 11px;">PARENT’S / GUARDIAN’S SIGNATURE</td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 10cm; font-family: times, sans-serif; bold;font-size: 11px;"></td>
                </tr>

                <tr>
                    <td style="text-align: center; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left;  font-weight: normal; width: 2.5cm; font-family: times, sans-serif; font-size: 11px;">1<sup>st</sup> Quarter</td>

                    <td style="text-align: left;font-weight: bold; width: 7.5cm; font-family: times, sans-serif; font-size: 11px;border-bottom: 1px solid black;">
                    </td>
                </tr>

                 <tr>
                    <td style="text-align: right; font-weight: bold; width: 10cm; font-family: times, sans-serif; bold;font-size: 11px;"></td>
                </tr>


                <tr>
                    <td style="text-align: center; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left;  font-weight: normal; width: 2.5cm; font-family: times, sans-serif; font-size: 11px;">2<sup>nd</sup> Quarter</td>

                 
                    <td style="text-align: left;font-weight: bold; width: 7.5cm; font-family: times, sans-serif; font-size: 11px;border-bottom: 1px solid black;">
                    </td>
                </tr>

                 <tr>
                    <td style="text-align: right; font-weight: bold; width: 10cm; font-family: times, sans-serif; bold;font-size: 11px;"></td>
                </tr>


                <tr>
                    <td style="text-align: center; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left;  font-weight: normal; width: 2.5cm; font-family: times, sans-serif; font-size: 11px;">3<sup>rd</sup> Quarter</td>

                    <td style="text-align: left;font-weight: bold; width: 7.5cm; font-family: times, sans-serif; font-size: 11px;border-bottom: 1px solid black;">
                    </td>
                </tr>

                 <tr>
                    <td style="text-align: right; font-weight: bold; width: 10cm; font-family: times, sans-serif; bold;font-size: 11px;"></td>
                </tr>


               <tr>
                    <td style="text-align: center; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left;  font-weight: normal; width: 2.5cm; font-family: times, sans-serif; font-size: 11px;">4<sup>th</sup> Quarter</td>

                 
                    <td style="text-align: left;font-weight: bold; width: 7.5cm; font-family: times, sans-serif; font-size: 11px;border-bottom: 1px solid black;">
                    </td>
                </tr>
</table>';

$pdf->writeHTML($html);

// certificate to transfer table

$html = '<table>
                
                <tr>
                    <td style="text-align: left; font-weight: bold;width: 8cm;font-family: times, sans-serif; font-size: 12px;"></td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: center; font-weight: bold; width: 10.95cm;  vertical-align: middle; line-height: 0.50cm; font-family: times, sans-serif; bold;font-size: 11px;">Certificate of Transfer</td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 10cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3.25cm;  font-family: times, sans-serif; font-size: 11px;">Admitted to Grade: </td>

                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: bold; width: 6.70cm;  font-family: times, sans-serif; font-size: 11px;border-bottom: 1px solid black;">Kindergarten 2</td>
                 
                  
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 11px;">Eligibility for Admission to Grade:</td>

                    <td style="text-align: center; font-weight: bold; width: 4.45cm;  font-family: times, sans-serif; font-size: 11px;vertical-align: middle; line-height: .50cm; border-bottom: 1px solid black;">1</td>

                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 10cm;  font-family: times, sans-serif; font-size: 11px;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 8.5cm;  font-family: times, sans-serif; font-size: 11px;">Approved:</td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 10cm;  font-family: times, sans-serif; font-size: 11px;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left;  font-weight: bold; width: 6cm;  font-family: times, sans-serif; font-size: 10.5px;">Prof. ENRICO M. DALANGIN</td>

                    <td style="text-align: center;  font-weight: bold; width: 6cm;  font-family: times, sans-serif; font-size: 10.5px;">Ms. CRISTINE P. DACILLO</td>
                </tr>

                <tr>
                    <td style="text-align: left;  font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: center; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 9px;">Chancellor</td>

                    <td style="text-align: center;  font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 9px;">Adviser</td>
                </tr>

                 <tr>
                    <td style="text-align: center; font-weight: normal; width: 10cm;  font-family: times, sans-serif; font-size: 11px;vertical-align: middle; line-height: .80cm; "></td>
                </tr>

                <tr>
                

                    <td style="text-align: left;  font-weight: bold; width: 8.5cm;  font-family: times, sans-serif; font-size: 11px;">Cancellation of Eligibility to Transfer</td>
                </tr>

        
                 <tr>
                    <td style="text-align: center; font-weight: normal; width: 10cm;  font-family: times, sans-serif; font-size: 11px;"></td>
                </tr>


                <tr>
                    <td style="text-align: left;  font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left; font-weight: normal; width: 2.5cm;  font-family: times, sans-serif; font-size: 11px;">Admitted in:</td>

                    <td style="text-align: center; font-weight: normal; width: 2cm;  font-family: times, sans-serif; font-size: 11px; border-bottom: 1px solid black;"></td>

                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left;  font-weight: bold; width: 2cm;  font-family: times, sans-serif; font-size: 11px;">Date:</td>

                    <td style="text-align: left; font-weight: normal; width: 2.5cm;  font-family: times, sans-serif; font-size: 11px; border-bottom: 1px solid black; "></td>

                    <td style="text-align: right;  font-weight: bold; width: 6cm;  font-family: times, sans-serif; font-size: 10.5px;">Prof. ENRICO M. DALANGIN </td>
                </tr>

                <tr>
                    <td style="text-align: left;  font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: center; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 9px;"></td>

                    <td style="text-align: center;  font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 11px;">Chancellor</td>
                </tr>

                        
</table>';

$pdf->writeHTML($html);
$pdf->setY(20);
$pdf->setX(160);
$html = '<table >
    <tr>
        <td rowspan="5"style="text-align: center; width: 2.5cm;"><img src="../assets/img/BatStateU-NEU-Logo.jpg" width="60" height="55"></td>

        <td style="text-align: center; font-weight: bold; width: 7cm; font-family: times, sans-serif; font-size: 8px;">Republic of the Philippines</td>
    </tr>

    <tr>
        
        <td style="text-align: center; font-weight: bold; width: 7cm; font-family: times, sans-serif; font-size: 12px;">BATANGAS STATE UNIVERSITY</td>
    </tr>

    <tr>
        
        <td style="text-align: center; font-weight: bold; width: 7cm; font-family: helvetica, sans-serif; font-size: 9px;color: rgb(210, 54, 59);">The National Engineering University</td>
    </tr>

    <tr>
        
        <td style="text-align: center; font-weight: bold; width: 7cm; font-family: times, sans-serif; font-size: 8px;">ARASOF-Nasugbu Campus</td>
    </tr>

    <tr>
        
        <td style="text-align: center; font-weight: bold; width:7cm; font-family: times, sans-serif; font-size: 6.5px;">R. Martinez St., Brgy. Bucana, Nasugbu, Batangas, Philippines 4231</td>
    </tr>


</table>';

$pdf->writeHTML($html);
$pdf->setX(160);
$html = '<table >
    <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: times, sans-serif; font-size: 11px;">LABORATORY SCHOOL</td>
    </tr>

    <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: times, sans-serif; font-size: 9px;">Pre Elementary</td>
    </tr>

    <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: helvetica, sans-serif; font-size: 9px;"></td>
    </tr>
     <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: times, sans-serif; font-size: 12px;"></td>
    </tr>

    <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: times, sans-serif; font-size: 12px;">REPORT CARD</td>
    </tr>


</table>';

$pdf->writeHTML($html);

$pdf->setX(160);
$html = '<table >
     <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: times, sans-serif; font-size: 12px;"></td>
    </tr>
    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Name:</td>

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; Agoncillo, Jose Chino VI E.</td>
    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td>    
    </tr>

    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">LRN:</td>

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; 600030210001</td>
    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td> 
    </tr>

    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Age:</td>

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; 5</td>

    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td> 
    </tr>

    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Sex:</td>

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; MALE</td>
    </tr>
     <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td> 
    </tr>

    <tr>
       <td style="text-align: left; width: 2.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Grade:</td>

        <td style="text-align: left; font-weight: bold;width: 8.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; KINDERGARTEN 2</td>
    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td> 
    </tr>

    <tr>
       <td style="text-align: left; width: 3cm; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Academic Year:</td>

        <td style="text-align: left; font-weight: bold;width: 8cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; 2021 – 2022</td>
    </tr>

    <tr>
         <td style="text-align: left; font-weight: bold;width: 8cm;font-family: times, sans-serif; font-size: 12px;"></td>
    </tr>
  

    <tr>
         <td style="text-align: left; font-weight: normal;width: 8cm;font-family: times, sans-serif; vertical-align; middle; line-height: 30px; font-size: 12px;">Dear Parent:</td>
    </tr>

    <tr>
         <td style="text-align: justify; font-weight: normal;width: 12cm;font-family: times, sans-serif; font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;This report card shows the ability and progress your child has made in the different learning areas as well as his/her core values.</td>
    </tr>

    <tr>
         <td style="text-align: justify; font-weight: normal;width: 12cm;font-family: times, sans-serif; font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;The school welcomes you should you desire to know more about your child’s progress.</td>
    </tr>

    <tr>
         <td style="text-align: left; font-weight: bold;width: 8cm;font-family: times, sans-serif; font-size: 12px; vertical-align; middle; line-height: 20px;"></td>
    </tr>



    <tr>
         <td style="text-align: left; font-weight: bold;width: 6.5cm;font-family: times, sans-serif; font-size: 10.5px;">Assoc. Prof. LORENJANE E. BALAN</td>

         <td style="text-align: center; font-weight: bold;width: 6cm;font-family: times, sans-serif; font-size: 10.5px;">Ms. CRISTINE P. DACILLO</td>
    </tr>

    <tr>
         <td style="text-align: center; font-weight: normal;width: 6cm;font-family: times, sans-serif; font-size: 11px;">Principal</td>

         <td style="text-align: center; font-weight: normal;width: 6cm;font-family: times, sans-serif; font-size: 11px;">Adviser</td>
    </tr>

</table>';

$pdf->writeHTML($html);

// another page
$pdf->AddPage();

$pdf->SetFont('times', 'B', 11);
$pdf->setX(15);
$pdf->Cell(0, 2.5, 'REPORT ON LEARNER’S PROGRESS AND ACHIEVEMENT', 0, 0, 'L');
$pdf->SetFont('times', 'B', 11);
$pdf->setX(170);
$pdf->Cell(0, 2.5, 'REPORT ON LEARNER’S OBSERVED VALUES', 0, 1, 'L');

// report on learners observed values table
$pdf->ln();
$html = '<table >
        
                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.55cm;"></td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 4cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;vertical-align: middle; line-height: 0.70cm;">GRADE</td>
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; vertical-align: middle; line-height: 0.75cm; border: 1px solid black;background-color: #f0f0f0;">PERSONAL – SOCIAL DEVELOPMENT</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 4cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;">Quarter</td>              

                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">1</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 1cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">2</td> 

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">3</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 1cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">4</td>   
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Exercises good health habits</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Dresses up independently</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Eats without help</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>


               <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Uses toilet independently</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>


                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Interacts with teachers, peers and other people</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>


                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Completes tasks willingly</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>


                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Plays cooperatively</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Participates actively in manipulative activities</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Follow rules and routines</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Accepts simple responsibilities</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>
                


</table>';

$pdf->writeHTML($html);
$pdf->setY(125);

$html = '<table >
        
                <tr>
                    <td style="text-align: left; font-weight: bold; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.55cm;"></td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 4cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;vertical-align: middle; line-height: 1cm;">GRADE</td>
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; vertical-align: middle; line-height: 0.75cm; border: 1px solid black;background-color: #f0f0f0;">AFFECTIVE DEVELOPMENT</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 4cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;">Quarter</td>              

                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">1</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 1cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">2</td> 

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">3</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 1cm; font-family: times, sans-serif; font-size: 9px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">4</td>   
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Says simple prayers</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Shows concern for others</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Cares for plants and animals</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Accept criticism</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;Wait for one’s turn</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">AO</td>
                </tr>
</table>';

$pdf->writeHTML($html);

$pdf->setY(19.55);
$pdf->setX(158);
$html = '<table border="1" style="border-colapse: collapse; width: 100%" >
        
                <tr>
                    <td rowspan="2" style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;">COGNITIVE DEVELOPMENT</td>

                    <td style="text-align: center; font-weight: bold; width: 4cm;vertical-align: middle; line-height: 0.50cm; font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;">Quarter
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;vertical-align: middle; line-height: .55cm;">
                    <span style="line-height: 1;">FINAL<br></span>
                    <span style="text-align: center;">RATING</span> 
                    </td>

                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;vertical-align: middle; line-height: .55cm;">
                    <span style="line-height:1;">FINAL<br></span>
                    <span style="text-align: center;">RATING</span> 
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;vertical-align: middle; line-height: 0.50cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;">1</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 0.50cm; font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;">2
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 0.50cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;">3
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 0.50cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;">4
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left;vertical-align: middle; line-height: 1cm; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;">1. Communication Skills</td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;">O</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">Passed
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left;vertical-align: middle; line-height: 1cm; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;">2. Komunikasyon sa Filipino</td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;">O</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">Passed
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left;vertical-align: middle; line-height: 1cm; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;">3. Numeracy Skills</td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;">VA</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">Passed
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left; font-weight: normal; vertical-align: middle; line-height: .80cm; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;">4. Sensory Perceptual Skills
                    <span style="line-height: 1;"><br>&nbsp;&nbsp;&nbsp;(Use of Senses)<br></span></td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;">VS</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1.25cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">Passed
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left; font-weight: normal; vertical-align: middle; line-height: .80cm; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;">5.  Motor and Creative Skills 
                    <span style="line-height: 1;"><br>&nbsp;&nbsp;&nbsp;(Music, Arts and P.E.)<br></span></td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;">VS</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1.25cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">O
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">Passed
                    </td>
                </tr>

                
</table>';

$pdf->writeHTML($html);

$pdf->setX(158);
$html = '<table  >
        <tr>
            <td style="text-align: center; font-weight: bold; width: 12cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Observed Values
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: bold; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Marking
                    </td>

            <td style="text-align: center; font-weight: bold; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Non-numerical Rating
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: normal; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">AO
                    </td>

            <td style="text-align: center; font-weight: normal; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Always Observed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: normal; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">SO
                    </td>

            <td style="text-align: center; font-weight: normal; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Sometimes Observed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: normal; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">RO
                    </td>

            <td style="text-align: center; font-weight: normal; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Rarely Observed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: normal; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">NO
                    </td>

            <td style="text-align: center; font-weight: normal; width: 6cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Not Observed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: bold; width: 12cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
        </tr>

</table>';
$pdf->writeHTML($html);

$pdf->setX(158);
$html = '<table >

<tr>
            <td style="text-align: center; font-weight: bold; width: 12cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Learner’s  Progress and Achievement
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; border: 1px solid black; font-weight: bold; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Descriptors
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: bold; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Grading Scale
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: bold; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Remarks
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Outstanding
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">90-100
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Passed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Very Satisfactory
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">85-89
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Passed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Satisfactory
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">80-84
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Passed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Fairly Satisfactory
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">75-79
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Passed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Did not Meet Expectation
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Below 75
                    </td>

            <td style="text-align: center; border: 1px solid black; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: .60cm;">Failed
                    </td>
        </tr>
    </table>';

$pdf->writeHTML($html);

$pdf->setX(250);
$html = '<table >

         <tr>
                    <td style="text-align: left; font-weight: bold; width: 12cm; font-family: times, sans-serif; font-size: 10px;font-style: italic;color: rgb(127, 127, 127);">Agoncillo, Jose Chino VI </td>

                </tr>

</table>';

$pdf->writeHTML($html);

$filename = "Kinder2_Form_138" . date("m_d_Y") . ".pdf";

// Output the PDF to the browser
$pdf->Output($filename, 'I');
?>