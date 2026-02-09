<?php

$adviser2 = isset($adviser2) ? $adviser2 : '';
$principal = isset($principal) ? $principal : '';
$studentName = isset($studentName) ? $studentName : '';
$lrn = isset($lrn) ? $lrn : '';
$age = isset($age) ? $age : '';
$gender = isset($gender) ? $gender : '';
$academic_year = isset($academic_year) ? $academic_year : '';
$gradeLevel = isset($gradeLevel) ? $gradeLevel : '';
$section = isset($section) ? $section : '';

ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class LaboratorySchoolListOfSubjects extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'letter', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LETTER';
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);

       
   }

   public function Header()
   {
      
    }

    

}


// Example usage
$pdf = new LaboratorySchoolListOfSubjects('L', 'mm', 'letter'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Grade 11-12 Form 138');

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
                    <td rowspan ="2" style="text-align: center; font-weight: bold; width: 2cm;  font-family: times, sans-serif; normalfont-size: 9px;"></td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 4.42cm; font-family: times, sans-serif; font-size: 9px;">First Semester
                    </td>

                    <td style="text-align: center; background-color: #f0f0f0; font-weight: bold; width: 4.5cm; font-family: times, sans-serif; font-size: 9px;">Second Semester
                    </td>


                    <td rowspan ="2" style="text-align: center; background-color: #f0f0f0; vertical-align: middle; line-height: 0.75cm; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 9px;">Total
                    </td>

                </tr>
                <tr>';

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
            $html .= '<td style="text-align: center !important; background-color: #f0f0f0; font-weight: normal; width: 0.81cm; font-family: times, sans-serif; font-size: 7px;">'. strtoupper($shortMonthName) .'</td>';

        }
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; background-color: #f0f0f0; font-weight: normal; width: 0.81cm; font-family: times, sans-serif; font-size: 7px;"></td>';
    }
}

$html .= '
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
            $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.81cm; font-family: times, sans-serif; font-size: 8px;">' . $row1["daysInMonth"] . '</td>';
            $totalSchoolDays += $row1["daysInMonth"];
        }
    } else {
        $html .= "<td colspan='11'>No data available</td>";
    }
} else {
    // If no school year is selected, add 11 empty columns
    for ($i = 0; $i < 11; $i++) {
        $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.81cm; font-family: times, sans-serif; font-size: 8px;"></td>';
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
            $html .= '<td style="text-align: center; font-weight: normal; vertical-align: middle; line-height: 0.70cm; width: 0.81cm; font-family: times, sans-serif; font-size: 8px;">' . $daysPresent . '</td>';
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


$pdf->SetFont('times', 'I', 7);
$pdf->Cell(0, 2.5, '* Alternative Delivery Mode (ADM) option was undertaken for the entire academic year due to COVID-19', 0, 1, 'L');
$pdf->SetFont('times', 'I', 7);
$pdf->Cell(0, 2.5, 'pandemic.  Saturdays are included as Task/Activity Days:', 0, 1, 'L');
$pdf->SetFont('times', 'N', 7);

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
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: center; font-weight: bold; width: 8.5cm;  vertical-align: middle; line-height: 0.50cm; font-family: times, sans-serif; bold;font-size: 11px;">Certificate of Transfer</td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 10cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 3.25cm;  font-family: times, sans-serif; font-size: 11px;">Admitted to Grade: </td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: bold; width: 1.25cm;  font-family: times, sans-serif; font-size: 11px;border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;'. $numericGradeLevel .'</td>
                 
                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1.5cm; font-family: times, sans-serif; font-size: 11px;">Section:</td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: bold; width: 2.5cm; font-family: times, sans-serif; font-size: 11px;border-bottom: 1px solid black;">'. $section .'</td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 6cm;  font-family: times, sans-serif; font-size: 11px;">Eligibility for Admission to:</td>

                    <td style="text-align: center; font-weight: bold; width: 2.5cm;  font-family: times, sans-serif; font-size: 11px;vertical-align: middle; line-height: .50cm; border-bottom: 1px solid black;">'. $admissionToGradeLevel .'</td>

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

                    <td style="text-align: left;  font-weight: bold; width: 5cm;  font-family: times, sans-serif; font-size: 9.5px;">Prof. ENRICO M. DALANGIN</td>

                    <td style="text-align: left;  font-weight: bold; width: 6cm;  font-family: times, sans-serif; font-size: 9.5px;">'. $adviser .'</td>
                </tr>

                <tr>
                    <td style="text-align: left;  font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: center; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 9px;">Chancellor</td>

                    <td style="text-align: center;  font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 9px;">Adviser</td>
                </tr>

                <tr>
                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 8.5cm;  font-family: times, sans-serif; font-size: 11px;"></td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 10cm;  font-family: times, sans-serif; font-size: 11px;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;  font-weight: bold; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: center;  font-weight: bold; width: 9.45cm;  font-family: times, sans-serif; font-size: 11px;">Cancellation of Eligibility to Transfer</td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: middle; line-height: .50cm; font-weight: normal; width: 10cm;  font-family: times, sans-serif; font-size: 11px;"></td>
                </tr>


                <tr>
                    <td style="text-align: left;  font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left; font-weight: normal; width: 2.5cm;  font-family: times, sans-serif; font-size: 11px;">Admitted in:</td>

                    <td style="text-align: center; font-weight: normal; width: 2cm;  font-family: times, sans-serif; font-size: 11px; border-bottom: 1px solid black;"></td>

                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal; width:1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: left;  font-weight: bold; width: 2cm;  font-family: times, sans-serif; font-size: 11px;">Date:</td>

                    <td style="text-align: left; font-weight: normal; width: 2.5cm;  font-family: times, sans-serif; font-size: 11px; border-bottom: 1px solid black; "></td>

                    <td style="text-align: right;  font-weight: bold; width: 6cm;  font-family: times, sans-serif; font-size: 9.5px;">Prof. ENRICO M. DALANGIN </td>
                </tr>

                <tr>
                    <td style="text-align: left;  font-weight: normal; width: 1cm;  font-family: times, sans-serif; font-size: 11px;"></td>

                    <td style="text-align: center; font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 9px;"></td>

                    <td style="text-align: center;  font-weight: normal; width: 5.5cm;  font-family: times, sans-serif; font-size: 11px;">Chancellor</td>
                </tr>

                        
</table>';

$pdf->writeHTML($html);
$pdf->setY(20);
$pdf->setX(155);
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
$pdf->setX(155);
$html = '<table >
     <tr>
        <td style="text-align: center; width: 2.5cm;"></td>
    </tr>
    <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: times, sans-serif; font-size: 11px;">LABORATORY SCHOOL</td>
    </tr>

    <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: times, sans-serif; font-size: 10px;">Senior High School</td>
    </tr>

    <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: helvetica, sans-serif; font-size: 9px;"></td>
    </tr>

     <tr>
        <td style="text-align: center; width: 2.5cm;"></td>
    </tr>

    <tr>
        <td style="text-align: center; width: 2.5cm;"></td>

        <td style="text-align: center; font-weight: bold; width: 6.5cm; font-family: times, sans-serif; font-size: 12px;">REPORT CARD</td>
    </tr>


</table>';

$pdf->writeHTML($html);

$pdf->setX(150);
$html = '<table >
     <tr>
        <td style="text-align: center; width: 2.5cm;"></td>
    </tr>
    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Name:</td>

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $studentName .'</td>
    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td>    
    </tr>

    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">LRN:</td>

        <td style="text-align: left; font-weight: bold;width: 9.5cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $lrn .'</td>
    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td> 
    </tr>

    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Age:</td>

        <td style="text-align: left; font-weight: bold;width: 3cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $age .'</td>

        <td style="text-align: left; font-weight: bold;width: 1cm; font-family: times, sans-serif; font-size: 12px;"></td>

        <td style="text-align: left; font-weight: normal;width: 1.75cm; font-family: times, sans-serif; font-size: 12px;">Sex:</td>

        <td style="text-align: left; font-weight: bold;width: 3.75cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $gender .'</td>
    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: top; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td> 
    </tr>

    <tr>
       <td style="text-align: left; width: 1.5cm; vertical-align: top; font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Grade:</td>

        <td style="text-align: left; font-weight: bold;width: 3cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $numericGradeLevel .'</td>

        <td style="text-align: left; font-weight: bold;width: 1cm; font-family: times, sans-serif; font-size: 12px;"></td>

        <td style="text-align: left; font-weight: normal;width: 1.75cm; font-family: times, sans-serif; font-size: 12px;">Section:</td>

        <td style="text-align: left; font-weight: bold;width: 3.75cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $section .'</td>
    </tr>

    <tr>
       <td style="text-align: left; width: 9cm; vertical-align: middle; font-weight: bold; font-family: times, sans-serif; font-size: 12px;"></td> 
    </tr>

    <tr>
       <td style="text-align: left; width: 3cm;  font-weight: normal; font-family: times, sans-serif; font-size: 12px;">Academic Year:</td>

        <td style="text-align: left; font-weight: bold;width: 8cm; font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">'. $academic_year .'</td>
    </tr>

    <tr>
       <td rowspan="2" style="text-align: left; width: 3cm; vertical-align: bottom; line-height: 45px; font-weight: normal; font-family: times, sans-serif; font-size: 12px;"><br>Track/Strand:</td>

        <td style="text-align: left; font-weight: bold;width: 8cm;font-family: times, sans-serif; font-size: 12px;border-bottom: 1px solid black;">Academic / Science, Technology, Engineering and Mathematics (STEM)</td>
    </tr>

    <tr>
         <td style="text-align: left; font-weight: bold;width: 8cm;font-family: times, sans-serif; font-size: 12px;vertical-align: middle; line-height: 1cm;"></td>
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
         <td style="text-align: left; font-weight: bold;width: 8cm;font-family: times, sans-serif; font-size: 12px;"></td>
    </tr>

    <tr>
         <td style="text-align: left; font-weight: bold;width: 8cm;font-family: times, sans-serif; font-size: 12px;"></td>
    </tr>

    <tr>
         <td style="text-align: left; font-weight: bold;width: 6cm;font-family: times, sans-serif; font-size: 9.5px;">'. $principal .'</td>

         <td style="text-align: right; font-weight: bold;width: 6cm;font-family: times, sans-serif; font-size: 9.5px;">'. $adviser .'</td>
    </tr>

    <tr>
         <td style="text-align: center; font-weight: normal;width: 6cm;font-family: times, sans-serif; font-size: 11px;">Principal</td>

         <td style="text-align: center; font-weight: normal;width: 6cm;font-family: times, sans-serif; font-size: 11px;">Adviser</td>
    </tr>

</table>';

$pdf->writeHTML($html);
$pdf->AddPage();

$pdf->SetFont('times', 'B', 11);
$pdf->setX(15);
$pdf->Cell(0, 2.5, 'REPORT ON LEARNER’S PROGRESS AND ACHIEVEMENT', 0, 0, 'L');
$pdf->SetFont('times', 'B', 11);
$pdf->setX(168);
$pdf->Cell(0, 2.5, 'REPORT ON LEARNER’S OBSERVED VALUES', 0, 1, 'L');

// report on learners observed values table
$pdf->ln();
$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

if (!empty($school_year) && !empty($class_id) && !empty($student_id)) {
$html = '<table>
    <tr>
        <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.55cm;">First Semester</td>
        <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 2cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">GRADE</td>
        <td rowspan="3" style="text-align: center; background-color: #f0f0f0; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black; padding-top: 20px;vertical-align: middle; line-height: 0.55cm;">Final Grade</td>
    </tr>
    <tr>
        <td rowspan="2" style="text-align: center; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.75cm; border: 1px solid black;background-color: #f0f0f0;">Subjects</td>
        <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 2cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;">Quarter</td>
    </tr>
    <tr>
        <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;background-color: #f0f0f0;">1</td>
        <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 1cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;background-color: #f0f0f0;">2</td>
    </tr>
    <tr>
        <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;Core Subjects</td>
    </tr>';

$html .= generateSubjectRows($conn, $school_year, $class_id, $student_id, 'core');

$html .= '<tr>
    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;"></td>
</tr>
<tr>
    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;Applied and Specialized Subjects</td>
</tr>';

$html .= generateSubjectRows($conn, $school_year, $class_id, $student_id, 'applied');

$generalAverage = calculateGeneralAverage($conn, $school_year, $class_id, $student_id);

$html .= '<tr>
    <td style="text-align: right; font-weight: bold; width: 11.5cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.70cm;">General Average&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td rowspan="3" style="text-align: center; vertical-align: middle; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 12px; border: 1px solid black; padding-top: 20px;vertical-align: middle; line-height: 0.70cm;">' . $generalAverage . '</td>
</tr>';

$html .= '</table>';

$pdf->writeHTML($html);

} else {
$html = '<table >
        
                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.55cm;">First Semester</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 2cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">GRADE</td>

                    <td rowspan="3" style="text-align: center; background-color: #f0f0f0; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black; padding-top: 20px;vertical-align: middle; line-height: 0.55cm;">Final Grade</td>
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.75cm; border: 1px solid black;background-color: #f0f0f0;">Subjects</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 2cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;">Quarter</td>              

                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;background-color: #f0f0f0;">1</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 1cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;background-color: #f0f0f0;">2</td>   
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;Core Subjects</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.87cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.87cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.87cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.87cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.87cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.87cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;Applied and Specialized Subjects</td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: right; font-weight: bold; width: 11.5cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.70cm;">General Average&nbsp;&nbsp;&nbsp;&nbsp;</td>

                    <td rowspan="3" style="text-align: center; vertical-align: middle; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 12px; border: 1px solid black; padding-top: 20px;vertical-align: middle; line-height: 0.70cm;"></td>
                </tr>
</table>';

$pdf->writeHTML($html);    
}
function calculateGeneralAverage($conn, $school_year, $class_id, $student_id) {
    $query_subjects = "SELECT sg.q1_grade, sg.q2_grade
                    FROM subject_grades sg
                    JOIN loads l ON sg.load_id = l.id 
                    WHERE sg.student_id = $student_id AND l.class_id = $class_id AND l.school_year_id = $school_year AND l.semester = 1";
    $query_run = mysqli_query($conn, $query_subjects);
    $totalSubjects = mysqli_num_rows($query_run);
    $totalFinalGrades = 0;
    if ($totalSubjects > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $q1_grade = isset($row['q1_grade']) ? (int)$row['q1_grade'] : 0;
            $q2_grade = isset($row['q2_grade']) ? (int)$row['q2_grade'] : 0;
            $final_grade = round(($q1_grade + $q2_grade) / 2);
            $totalFinalGrades += $final_grade;
        }
        return round($totalFinalGrades / $totalSubjects); // Return the average rounded without decimal places
    } else {
        return 0; // Return 0 if no grades found for this student
    }
}

function generateSubjectRows($conn, $school_year, $class_id, $student_id, $subject_type) {
    $html = '';
    $query_subjects = "SELECT l.mapeh_name, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, s.subjectType
                    FROM subject_grades sg
                    JOIN loads l ON sg.load_id = l.id 
                    JOIN subjects s ON l.subject_id = s.id 
                    WHERE sg.student_id = $student_id AND l.class_id = $class_id AND l.school_year_id = $school_year AND l.semester = 1 AND s.subjectType = '$subject_type'";
    $query_run = mysqli_query($conn, $query_subjects);
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $subject_title = !empty($row['mapeh_name']) ? $row['mapeh_name'] : $row['courseTitle'];
            $q1_grade = isset($row['q1_grade']) ? (int)$row['q1_grade'] : 0;
            $q2_grade = isset($row['q2_grade']) ? (int)$row['q2_grade'] : 0;
            $final_grade = round(($q1_grade + $q2_grade) / 2);
            $html .= '<tr>
                <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $subject_title . '</td>
                <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">' . $q1_grade . '</td>
                <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">' . $q2_grade . '</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">' . $final_grade . '</td>
            </tr>';
        }
    } else {
        $html .= '<tr><td colspan="4">No grades found for this student</td></tr>';
    }
    return $html;
}
$pdf->setY(115);


$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

if (!empty($school_year) && !empty($class_id) && !empty($student_id)) {
$html = '<table >
        
                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.55cm;">Second Semester</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 2cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">GRADE</td>

                    <td rowspan="3" style="text-align: center; background-color: #f0f0f0; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black; padding-top: 20px;vertical-align: middle; line-height: 0.55cm;">Final Grade</td>
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.75cm; border: 1px solid black;background-color: #f0f0f0;">Subjects</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 2cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;">Quarter</td>              

                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;background-color: #f0f0f0;">3</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 1cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;background-color: #f0f0f0;">4</td>   
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;Core Subjects</td>
                </tr>';

$html .= generateSubjectRows2($conn, $school_year, $class_id, $student_id, 'core');

$html .= '<tr>
    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;"></td>
</tr>
<tr>
    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;Applied and Specialized Subjects</td>
</tr>';

$html .= generateSubjectRows2($conn, $school_year, $class_id, $student_id, 'applied');

$generalAverage = calculateGeneralAverage2($conn, $school_year, $class_id, $student_id);

$html .= '<tr>
    <td style="text-align: right; font-weight: bold; width: 11.5cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.70cm;">General Average&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td rowspan="3" style="text-align: center; vertical-align: middle; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 12px; border: 1px solid black; padding-top: 20px;vertical-align: middle; line-height: 0.70cm;">' . $generalAverage . '</td>
</tr>';

$html .= '</table>';

$pdf->writeHTML($html);

} else {
$html = '<table >
        
                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.55cm;">Second Semester</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 2cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">GRADE</td>

                    <td rowspan="3" style="text-align: center; background-color: #f0f0f0; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black; padding-top: 20px;vertical-align: middle; line-height: 0.55cm;">Final Grade</td>
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: center; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: 0.75cm; border: 1px solid black;background-color: #f0f0f0;">Subjects</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 2cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;">Quarter</td>              

                </tr>

                <tr>
                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;background-color: #f0f0f0;">3</td>

                    <td style="text-align: center; font-weight: bold; background-color: #f0f0f0; width: 1cm; font-family: times, sans-serif; font-size: 8px; border: 1px solid black;background-color: #f0f0f0;">4</td>   
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;Core Subjects</td>
                </tr>

                <tr>
                    <td style="text-align: justify; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;"></td>
                </tr>

                
                <tr>
                    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 13cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;background-color: #f0f0f0;vertical-align: middle; line-height: 0.50cm;">&nbsp;&nbsp;Applied and Specialized Subjects</td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>

                    <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.50cm;"></td>
                </tr>


                <tr>
                    <td style="text-align: right; font-weight: bold; width: 11.5cm; font-family: times, sans-serif; font-size: 11px; border-top: none;vertical-align: middle; line-height: 0.70cm;">General Average&nbsp;&nbsp;&nbsp;&nbsp;</td>

                    <td rowspan="3" style="text-align: center; vertical-align: middle; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 12px; border: 1px solid black; padding-top: 20px;vertical-align: middle; line-height: 0.70cm;"></td>
                </tr>

</table>';

$pdf->writeHTML($html);
}
function calculateGeneralAverage2($conn, $school_year, $class_id, $student_id) {
    $query_subjects = "SELECT sg.q3_grade, sg.q4_grade
                    FROM subject_grades sg
                    JOIN loads l ON sg.load_id = l.id 
                    WHERE sg.student_id = $student_id AND l.class_id = $class_id AND l.school_year_id = $school_year AND l.semester = 2";
    $query_run = mysqli_query($conn, $query_subjects);
    $totalSubjects = mysqli_num_rows($query_run);
    $totalFinalGrades = 0;
    if ($totalSubjects > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
            $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;
            $final_grade = round(($q3_grade + $q4_grade) / 2);
            $totalFinalGrades += $final_grade;
        }
        return round($totalFinalGrades / $totalSubjects); // Return the average rounded without decimal places
    } else {
        return 0; // Return 0 if no grades found for this student
    }
}
function generateSubjectRows2($conn, $school_year, $class_id, $student_id, $subject_type) {
    $html = '';
    $query_subjects = "SELECT l.mapeh_name, s.courseTitle, s.courseCode, sg.q3_grade, sg.q4_grade, s.subjectType
                    FROM subject_grades sg
                    JOIN loads l ON sg.load_id = l.id 
                    JOIN subjects s ON l.subject_id = s.id 
                    WHERE sg.student_id = $student_id AND l.class_id = $class_id AND l.school_year_id = $school_year AND l.semester = 2 AND s.subjectType = '$subject_type'";
    $query_run = mysqli_query($conn, $query_subjects);
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $subject_title = !empty($row['mapeh_name']) ? $row['mapeh_name'] : $row['courseTitle'];
            $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
            $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;
            $final_grade = round(($q3_grade + $q4_grade) / 2);
            $html .= '<tr>
                <td style="text-align: left; font-weight: bold; width: 9.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $subject_title . '</td>
                <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">' . $q3_grade . '</td>
                <td style="text-align: center; font-weight: bold; width: 1cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">' . $q4_grade . '</td>
                <td style="text-align: center; font-weight: bold; width: 1.5cm; font-family: times, sans-serif; font-size: 10px; border: 1px solid black;vertical-align: middle; line-height: 0.55cm;">' . $final_grade . '</td>
            </tr>';
        }
    } else {
        $html .= '<tr><td colspan="4">No grades found for this student</td></tr>';
    }
    return $html;
}

$pdf->setY(191);
$html = '<table >

         <tr>
                    <td style="text-align: left; font-weight: bold; width: 10cm; font-family: times, sans-serif; font-size: 10px;font-style: italic;color: rgb(127, 127, 127);">'. $studentName .'</td>

                </tr>

</table>';

$pdf->writeHTML($html);

$pdf->setY(19.55);
$pdf->setX(152);
$html = '<table border="1" style="border-colapse: collapse; width: 100%" >
        
<tr>
    <td style="text-align: center;vertical-align: middle; line-height: 0.68cm; font-weight: bold; width: 3cm;  font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;">Core Values</td>

    <td style="text-align: center; font-weight: bold; width: 5.52cm;vertical-align: middle; line-height: 0.68cm; font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;">Behavior Statements
    </td>

    <td style="text-align: center;vertical-align: middle; line-height: 0.68cm; font-weight: bold; width: 3.48cm; font-family: times, sans-serif; font-size: 10px;background-color: #f0f0f0;">Quarter
    </td>
</tr>';

$core_values = [
        1 => [
            'core_values' => ['1. Maka-Diyos']
        ],
        2 => [
            'core_values' => ['2. Makatao']
        ],
        3 => [
            'core_values' => ['3. Makakalikasan']
        ],
        4 => [
            'core_values' => ['4. Makabansa']
        ]
    ];

// Define behavior statements
$behavior_statements = [
    1 => [
        'behavior_statements' => ['Expresses one’s spiritual beliefs <br>while respecting the spiritual beliefs <br>of others']
    ],
    2 => [
        'behavior_statements' => ['Shows adherence to ethical <br>principles by upholding truth']
    ],
    3 => [
        'behavior_statements' => ['Is sensitive to individual, social, and <br>cultural differences']
    ],
    4 => [
        'behavior_statements' => ['Demonstrates contributions toward <br>solidarity']
    ],
    5 => [
        'behavior_statements' => ['Cares for the environment and  <br>utilizes resources wisely, judiciously,  <br>and economically']
    ],
    6 => [
        'behavior_statements' => ['Demonstrates pride in being a <br>Filipino; exercises the  rights and <br>responsibilities of a Filipino citizen']
    ],
    7 => [
        'behavior_statements' => ['Demonstrates appropriate behavior <br>in carrying out activities in the <br>school, community, and country']
    ]
];

$school_year = isset($_POST['school_year']) ? $_POST['school_year'] : '';
$class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

if (!empty($school_year) && !empty($class_id) && !empty($student_id)) {
$fetch_values_query = "SELECT * FROM observe_values_sh WHERE student_id = '$student_id' AND class_id = '$class_id' AND school_year_id = '$school_year'";
$fetch_result = $conn->query($fetch_values_query);

// Define an array to hold observed values
$observed_values = [];

// Populate the observed values array
if ($fetch_result->num_rows > 0) {
    while ($row = $fetch_result->fetch_assoc()) {
        $core_value = $row['core_value'];
        $behavior_statement_index = $row['behavior_statement']; // No need to adjust for zero-based indexing
        $quarter_1 = $row['quarter_1'];
        $quarter_2 = $row['quarter_2'];
        $quarter_3 = $row['quarter_3'];
        $quarter_4 = $row['quarter_4'];

        // Add observed values to the array
        if (!isset($observed_values[$core_value])) {
            $observed_values[$core_value] = [];
            $observed_values[$core_value]['rowspan'] = 0; // Initialize rowspan count
        }

        // Increment rowspan count for the current core value
        $observed_values[$core_value]['rowspan']++;

        $observed_values[$core_value]['data'][$behavior_statement_index] = [
            'behavior_statement' => $behavior_statements[$behavior_statement_index]['behavior_statements'][0], // Assuming there's only one statement per index
            'quarters' => [$quarter_1, $quarter_2, $quarter_3, $quarter_4]
        ];
    }
}
foreach ($observed_values as $core_value => $data) {
    $rowspan = $data['rowspan'];
    $first_behavior_statement_index = array_key_first($data['data']);

    foreach ($data['data'] as $behavior_statement_index => $item) {
        $html .= '<tr>';

        if ($behavior_statement_index === $first_behavior_statement_index) {
            $html .= '<td rowspan="' . $rowspan . '" style="text-align: left; font-weight: normal; width: 3cm;  font-family: times, sans-serif; font-size: 10px;">' . $core_values[$core_value]['core_values'][0] . '</td>';
        }

        $html .= '<td style="text-align: left; font-weight: normal; width: 5.52cm; font-family: times, sans-serif; font-size: 10px;">' . $item['behavior_statement'] . '</td>';

        foreach ($item['quarters'] as $ovquarter) {
            $html .= '<td style="text-align: center; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">' . $ovquarter . '</td>';
        }

        $html .= '</tr>';
    }
}
} else {
 $html .= '<tr>
                    <td rowspan="2" style="text-align: left;vertical-align: middle; line-height: 2cm; font-weight: normal; width: 3cm;  font-family: times, sans-serif; font-size: 10px;">1. Makadiyos</td>

                    <td style="text-align: left; font-weight: normal; width: 5.52cm; font-family: times, sans-serif; font-size: 10px;">Expresses one’s  spiritual beliefs while respecting the spiritual beliefs of others
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.30cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1.30cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.30cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1.30cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
             
                </tr>

                <tr>
                    
                    <td style="text-align: left; font-weight: normal; width: 5.52cm; font-family: times, sans-serif; font-size: 10px;">Shows adherence to ethical principles by upholding truth
                    </td>

                     <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
             
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: left; vertical-align: middle; line-height: 1.75cm; font-weight: normal; width: 3cm;  font-family: times, sans-serif; font-size: 10px;">2. Makatao</td>

                    <td style="text-align: left; font-weight: normal; width: 5.52cm; font-family: times, sans-serif; font-size: 10px;">Is sensitive to individual, social, and cultural differences
                    </td>

                     <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
             
                </tr>

                <tr>
                    
                    <td style="text-align: left; font-weight: normal; width: 5.52cm; vfont-family: times, sans-serif; font-size: 10px;">Demonstrates contributions toward solidarity
                    </td>
                     <td style="text-align: center;vertical-align: middle; line-height: .75cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: .75cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: .75cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: .75cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
             
                </tr>

                <tr>
                    <td style="text-align: left; font-weight: normal;vertical-align: middle; line-height: 1.30cm; width: 3cm;  font-family: times, sans-serif; font-size: 10px;">3. Makakalikasan</td>

                    <td style="text-align: left; font-weight: normal; width: 5.52cm; font-family: times, sans-serif; font-size: 10px;">Cares for the environment and utilizes resources wisely, judiciously, and economically
                    </td>
                     <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1.25cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.25cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1.25cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
             
                </tr>

                <tr>
                    <td rowspan="2" style="text-align: left; font-weight: normal; width: 3cm; vertical-align: middle; line-height: 2.5cm;font-family: times, sans-serif; font-size: 10px;">4. Makabansa
                    </td>
                    <td style="text-align: left; font-weight: normal; width: 5.52cm; font-family: times, sans-serif; font-size: 10px;">Demonstrates pride in being a Filipino; exercise the rights and responsibilities of a Filipino citizen
                    </td>
                     <td style="text-align: center;vertical-align: middle; line-height: 1.30cm1.30cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1.30cm1.30cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.30cm1.30cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1.30cm1.30cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
             
             
                </tr>

                <tr>
                   
                    <td style="text-align: left; font-weight: normal; width: 5.52cm; font-family: times, sans-serif; font-size: 10px;">Demonstrates appropriate behavior in carrying out activities in the school, community, and country
                    </td>
                     <td style="text-align: center;vertical-align: middle; line-height: 1.30cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1.30cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center;vertical-align: middle; line-height: 1.30cm; font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>

                    <td style="text-align: center; vertical-align: middle; line-height: 1.30cm;font-weight: bold; width: 0.87cm; font-family: times, sans-serif; font-size: 10px;">
                    </td>
             
             
                </tr>';
}
$html .= '</table>';
$pdf->writeHTML($html);
$pdf->setX(152);
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

        <tr>
            <td style="text-align: center; font-weight: bold; width: 12cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Learner’s  Progress and Achievement
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: bold; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Descriptors
                    </td>

            <td style="text-align: center; font-weight: bold; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Grading Scale
                    </td>

            <td style="text-align: center; font-weight: bold; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Remarks
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Outstanding
                    </td>

            <td style="text-align: center; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">90-100
                    </td>

            <td style="text-align: center; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Passed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Very Satisfactory
                    </td>

            <td style="text-align: center; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">85-89
                    </td>

            <td style="text-align: center; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Passed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">Satisfactory
                    </td>

            <td style="text-align: center; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cm">80-84
                    </td>

            <td style="text-align: center; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Passed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Fairly Satisfactory
                    </td>

            <td style="text-align: center; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">75-79
                    </td>

            <td style="text-align: center; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Passed
                    </td>
        </tr>

        <tr>
            <td style="text-align: center; font-weight: normal; width: 5cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Did not Meet Expectation
                    </td>

            <td style="text-align: center; font-weight: normal; width: 4cm; font-family: times, sans-serif; font-size: 10px;vertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cmvertical-align: middle; line-height: .60cm">Below 75
                    </td>

            <td style="text-align: center; font-weight: normal; width: 3cm; font-family: times, sans-serif; font-size: 10px; vertical-align: middle; line-height: .60cm;">Failed
                    </td>
        </tr>


</table>';

$pdf->writeHTML($html);

$filename = "g11-g12_form138_" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');

echo '<iframe src="data:application/pdf;base64,' . base64_encode($pdfData) . '" width="100%" height="800" style="border: none;"></iframe>';
?>