<?php
$adviser2 = isset($adviser2) ? $adviser2 : '';
$principal = isset($principal) ? $principal : '';
$studentName = isset($studentName) ? $studentName : '';
$lrn = isset($lrn) ? $lrn : '';
$age = isset($age) ? $age : '';
$gender = isset($gender) ? $gender : '';
$academic_year = isset($academic_year) ? $academic_year : '';

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
$pdf->SetTitle('Kinder Form 138');

// another page
$pdf->AddPage();

$pdf->SetFont('times', 'B', 11);
$pdf->setX(40);
$pdf->Cell(0, 2.5, 'REPORT ON ATTENDANCE', 0, 0, 'L');
$pdf->SetFont('times', 'B', 11);

$pdf->Cell(0, 2.5, 'FORM 138', 0, 1, 'R');

// report on learners observed values table
$pdf->ln();
$html = '<table border="1" style="border-collapse: collapse; width: 100%" >
                <tr>
                    <td  style="text-align: center; font-weight: bold; width: 2cm;  font-family: times, sans-serif; font-size: 7px;background-color: #f0f0f0;"></td>';

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';

if (!empty($school_year)) {
    $query_class_start_month = "SELECT class_start FROM academic_calendar WHERE id = $school_year";
    $query_run_class_start_month = mysqli_query($conn, $query_class_start_month);
    $row_class_start_month = mysqli_fetch_assoc($query_run_class_start_month);
    $class_start_month = date("F", strtotime($row_class_start_month['class_start']));

    $months = array($class_start_month);
    for ($i = 1; $i < 12; $i++) {
        $months[] = date("F", strtotime("$class_start_month + $i month"));
    }

    $orderClause = "FIELD(monthName, '" . implode("', '", $months) . "')";

    $query1 = "SELECT m.monthName, m.daysInMonth, m.id as month_id
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = $school_year
              ORDER BY $orderClause";
    $query_run = mysqli_query($conn, $query1);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            // Modify the month name format to show the short form (e.g., Jan)
            $shortMonthName = date("M", strtotime($row1["monthName"]));
            $month_id = $row1["month_id"];
            $html .= '<td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.81cm; font-family: times, sans-serif; font-size: 7px;">'. strtoupper($shortMonthName) .'</td>';
        }
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.81cm; font-family: times, sans-serif; font-size: 7px;"></td>';
    }
}

$html .= '<td  style="text-align: center; background-color: #f0f0f0;  font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 7px;">Total
        </td>
        </tr>

        <tr>
            <td style="text-align: left; font-weight: normal; width: 2cm; font-family: times, sans-serif; font-size: 8px;">No. of school days
            </td>';

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';

if (!empty($school_year)) {
    $query2 = "SELECT m.id, m.daysInMonth
              FROM months m
              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
              WHERE ac.id = '$school_year'
              ORDER BY $orderClause";

    $query_run = mysqli_query($conn, $query2);

    $totalSchoolDays = 0;

    if ($query_run) {
        while ($row1 = mysqli_fetch_assoc($query_run)) {
            // Calculate width for each column dynamically
            $columnWidth = 0.81;
            $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: '.$columnWidth.'cm; font-family: times, sans-serif; font-size: 8px;">' . $row1["daysInMonth"] . '</td>';
            $totalSchoolDays += $row1["daysInMonth"];
        }
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.82cm; font-family: times, sans-serif; font-size: 8px;"></td>';
    }
}

$html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 1cm; font-family: times, sans-serif; font-size: 8px;">'. $totalSchoolDays .'
          </td>
     
        </tr>

        <tr>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: times, sans-serif; font-size: 8px;">No. of days present
                    </td>';

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

$html .= ''; // Remove the line that initializes $html variable

if (!empty($school_year) && !empty($class_id)) {
    $no = 1; // Initialize $no variable

    // Assuming $conn is your database connection object
    $query_run_months = mysqli_query($conn, $query2); // Execute the query to fetch months

    if ($query_run_months) {
        $totalDaysPresent = 0; // Initialize totalDaysPresent variable
        while ($row_month = mysqli_fetch_assoc($query_run_months)) {
            $month_id = $row_month['id'];
            $daysInMonth = $row_month['daysInMonth'];
            $attendance_query = "SELECT a.daysPresent, m.id as m_id
                                 FROM attendance a
                                 RIGHT JOIN months m ON a.month_id = m.id
                                 WHERE a.student_id = '$student_id' AND a.class_id = '$class_id' AND a.school_year_id = '$school_year' AND m.id = '$month_id'";

            $attendance_result = mysqli_query($conn, $attendance_query);
            $attendance_row = mysqli_fetch_assoc($attendance_result);
            $daysPresent = isset($attendance_row['daysPresent']) ? $attendance_row['daysPresent'] : $daysInMonth;
            $totalDaysPresent += $daysPresent; // Accumulate daysPresent to calculate totalDaysPresent

            // Display the value of daysPresent
            $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: '.$columnWidth.'cm; font-family: times, sans-serif; font-size: 8px;">' . $daysPresent . '</td>';
        }

        // Add the total days present at the end of the row
        $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 1cm; font-family: times, sans-serif; font-size: 8px;">' . $totalDaysPresent . '</td>';
    } else {
        // If no data available for months
        $html .= "<td colspan='11'>No data available</td>";
    }

    $no++; // Increment $no within the loop
}

$html .= '
             
                </tr>

                 <tr>

                    <td style="text-align: left; font-weight: normal; width: 2cm; font-family: times, sans-serif; font-size: 8px;">No. of days absent
                    </td>';

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

$html .= ''; // Remove the line that initializes $html variable

if (!empty($school_year) && !empty($class_id)) {
    $no = 1; // Initialize $no variable

    // Assuming $conn is your database connection object
    $query_run_months = mysqli_query($conn, $query2); // Execute the query to fetch months

    if ($query_run_months) {
        $totalDaysAbsent = 0; // Initialize totalDaysPresent variable
        while ($row_month = mysqli_fetch_assoc($query_run_months)) {
            $month_id = $row_month['id'];
            $daysInMonth = $row_month['daysInMonth'];
            $attendance_query = "SELECT a.daysPresent, m.id as m_id
                                 FROM attendance a
                                 RIGHT JOIN months m ON a.month_id = m.id
                                 WHERE a.student_id = '$student_id' AND a.class_id = '$class_id' AND a.school_year_id = '$school_year' AND m.id = '$month_id'";

            $attendance_result = mysqli_query($conn, $attendance_query);
            $attendance_row = mysqli_fetch_assoc($attendance_result);
            $daysPresent = isset($attendance_row['daysPresent']) ? $attendance_row['daysPresent'] : $daysInMonth;

            $daysAbsent = $daysInMonth - $daysPresent;
            $totalDaysAbsent += $daysAbsent; // Accumulate daysPresent to calculate totalDaysPresent

            // Display the value of daysPresent
            $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: '.$columnWidth.'cm; font-family: times, sans-serif; font-size: 8px;">' . $daysAbsent . '</td>';
        }

        // Add the total days present at the end of the row
        $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 1cm; font-family: times, sans-serif; font-size: 8px;">' . $totalDaysAbsent . '</td>';
    } else {
        // If no data available for months
        $html .= "<td colspan='11'>No data available</td>";
    }

    $no++; // Increment $no within the loop
}

$html .= '</tr></table>';

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

                    <td style="text-align: center;  font-weight: bold; width: 6cm;  font-family: times, sans-serif; font-size: 10.5px;">'. $adviser2 .'</td>
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

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; '. $studentName .'</td>
    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td>    
    </tr>

    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">LRN:</td>

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; '. $lrn .'</td>
    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td> 
    </tr>

    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Age:</td>

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; '. $age .'</td>

    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td> 
    </tr>

    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Sex:</td>

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; '. $gender .'</td>
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

        <td style="text-align: left; font-weight: bold;width: 8cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp; '. $academic_year .'</td>
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
         <td style="text-align: left; font-weight: bold;width: 6.5cm;font-family: times, sans-serif; font-size: 10.5px;">'. $principal .'</td>

         <td style="text-align: center; font-weight: bold;width: 6cm;font-family: times, sans-serif; font-size: 10.5px;">'. $adviser2 .'</td>
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
$pdf->Cell(0, 2.5, 'REPORT ON LEARNER’S OBSERVED VALUES', 0, 0, 'L');
$pdf->setX(170);
$pdf->Cell(0, 2.5, 'REPORT ON LEARNER’S PROGRESS AND ACHIEVEMENT', 0, 1, 'L');

// report on learners observed values table
$pdf->ln();
$html = '<table>
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
    </tr>';

$value_text_equivalents = [
    1 => "Exercises good health habits",
    2 => "Dresses up independently",
    3 => "Eats without help",
    4 => "Uses toilet independently",
    5 => "Interacts with teachers, peers and other people",
    6 => "Completes tasks willingly",
    7 => "Plays cooperatively",
    8 => "Participates actively in manipulative activities",
    9 => "Follows rules and routines",
    10 => "Accepts simple responsibilities",
    11 => "Says simple prayers",
    12 => "Shows concern for others",
    13 => "Cares for plants and animals",
    14 => "Accepts criticism",
    15 => "Waits for one’s turn"
];
$fetch_query = "SELECT * FROM observe_values_k WHERE 
    value BETWEEN 1 AND 10 AND 
    student_id = '$student_id' AND 
    class_id = '$class_id' AND 
    school_year_id = '$school_year'";
$result = $conn->query($fetch_query);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;' . $value_text_equivalents[$row['value']] . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">' . $row["quarter_1"] . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">' . $row["quarter_2"] . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">' . $row["quarter_3"] . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">' . $row["quarter_4"] . '</td>';
        $html .= '</tr>';
    }
} else {
    for ($i = 1; $i <= 10; $i++) {
        $html .= '<tr>';
        // Assuming $value_text_equivalents is an array containing text equivalents for values 1 to 10
        $text_equivalent = isset($value_text_equivalents[$i]) ? $value_text_equivalents[$i] : ''; 
        $html .= '<td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;' . $text_equivalent . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;"></td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;"></td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;"></td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;"></td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';

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
                </tr>';

$fetch_query = "SELECT * FROM observe_values_k WHERE 
    value BETWEEN 11 AND 15 AND 
    student_id = '$student_id' AND 
    class_id = '$class_id' AND 
    school_year_id = '$school_year'";
$result = $conn->query($fetch_query);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;' . $value_text_equivalents[$row['value']] . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">' . $row["quarter_1"] . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">' . $row["quarter_2"] . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">' . $row["quarter_3"] . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">' . $row["quarter_4"] . '</td>';
        $html .= '</tr>';
    }
} else {
    for ($i = 11; $i <= 15; $i++) {
        $html .= '<tr>';
        // Assuming $value_text_equivalents is an array containing text equivalents for values 1 to 10
        $text_equivalent = isset($value_text_equivalents[$i]) ? $value_text_equivalents[$i] : ''; 
        $html .= '<td style="text-align: justify; font-weight: normal; width: 8.48cm; font-family: times, sans-serif; font-size: 11px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;">&nbsp;&nbsp;&nbsp;&nbsp;' . $text_equivalent . '</td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;"></td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;"></td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;"></td>';
        $html .= '    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.75cm;"></td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';

$pdf->writeHTML($html);


$pdf->setY(19.55);
$pdf->setX(158);
$html = '<table border="1" style="border-collapse: collapse; width: 100%" >
        
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
                </tr>';

if (!empty($school_year) && !empty($class_id) && !empty($student_id)) {
function getGradeDescriptor($grade) {
    if ($grade >= 90) {
        return "O"; // Outstanding
    } elseif ($grade >= 85) {
        return "VS"; // Very Satisfactory
    } elseif ($grade >= 80) {
        return "S"; // Satisfactory
    } elseif ($grade >= 75) {
        return "FS"; // Fairly Satisfactory
    } else {
        return "F"; // Failed
    }
}

$row_number = 1; // Initialize row number

// Fetch the list of subjects for the student
$query_subjects = "SELECT subjects.courseTitle, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade
                    FROM subject_grades sg
                    JOIN loads l ON sg.load_id = l.id 
                    JOIN subjects ON l.subject_id = subjects.id 
                    WHERE sg.student_id = $student_id AND l.class_id = $class_id AND l.school_year_id = $school_year";

$query_run = mysqli_query($conn, $query_subjects);
if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
                $courseTitle = $row['courseTitle'];
                $q1_grade = htmlspecialchars($row['q1_grade']);
                $q2_grade = htmlspecialchars($row['q2_grade']);
                $q3_grade = htmlspecialchars($row['q3_grade']);
                $q4_grade = htmlspecialchars($row['q4_grade']);

                $q1_descriptor = getGradeDescriptor($q1_grade);
                $q2_descriptor = getGradeDescriptor($q2_grade);
                $q3_descriptor = getGradeDescriptor($q3_grade);
                $q4_descriptor = getGradeDescriptor($q4_grade);

                // Calculate average grade
                $average_grade = round(($q1_grade + $q2_grade + $q3_grade + $q4_grade) / 4);

                // Get grade descriptor for average grade
                $average_descriptor = getGradeDescriptor($average_grade);

                // Get final rating based on average grade
                $final_rating = $average_descriptor;

                // Determine remarks based on average grade
                $remarks = ($average_grade >= 75) ? "Passed" : "Failed";

                // Append table rows with data and row number
                $html .= '<tr>
                    <td style="text-align: left;vertical-align: middle; line-height: 1cm; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;">'.$row_number.'. '.$courseTitle.'</td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;">'.$q1_descriptor.'</td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1cm; font-family: times, sans-serif; font-size: 10px;">'.$q2_descriptor.'</td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">'.$q3_descriptor.'</td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">'.$q4_descriptor.'</td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">'.$final_rating.'</td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">'.$remarks.'</td>
                </tr>';

                $row_number++; // Increment row number
    }
} else {
    $html .= '<tr><td colspan="7" style="text-align: center;">No grades found for this student</td></tr>';
}
} else {
  $html .= '
<tr>
                    <td  style="text-align: left;vertical-align: middle; line-height: 1cm; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;"></td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left;vertical-align: middle; line-height: 1cm; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;"></td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left;vertical-align: middle; line-height: 1cm; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;"> </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left; font-weight: normal; vertical-align: middle; line-height: .80cm; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;"></td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1.25cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left; font-weight: normal; vertical-align: middle; line-height: .80cm; width: 5.5cm;  font-family: times, sans-serif; font-size: 10px;"></td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 10px;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm;vertical-align: middle; line-height: 1.25cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 1.65cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
                </tr>
  ';
}

$html .= '</table>';

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
                    <td style="text-align: left; font-weight: bold; width: 12cm; font-family: times, sans-serif; font-size: 10px;font-style: italic;color: rgb(127, 127, 127);">'. $studentName .' </td>

                </tr>

</table>';

$pdf->writeHTML($html);

$filename = "Kinder_form138_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';
?>