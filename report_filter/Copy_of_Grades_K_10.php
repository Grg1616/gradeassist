<button id="savePDF" class="btn btn-sm btn-primary mb-3"><i class="bi bi-download me-2"></i>Download</button>
<button id="printPDF" class="btn btn-sm btn-secondary mb-3"><i class="bi bi-printer me-2"></i>Print</button>


<?php
ob_start();
require('../assets/vendor/tcpdf/tcpdf.php');

class SummaryofQuarterlyGrades extends TCPDF
{
   public function __construct($orientation = 'P', $unit = 'mm', $format = 'letter', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
   {
        $format = 'LEGAL';
       parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
   }

   public function Header()
   {
        // Add image
       $this->Image('../assets/img/bsulogo.jpg', 20, 5.5, 35);
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
       $this->SetFont('times', 'B', 10);
       $this->Cell(0, 1.0, 'LABORATORY SCHOOL', 0, 1, 'C');
       $this->SetFont('times', 'B', 8);
       $this->Cell(200, 1.0, 'Elementary', 0, 1, 'C');

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
$pdf = new  SummaryofQuarterlyGrades('P', 'mm', 'legal'); // 'P' for portrait orientation, 'mm' for millimeters
$pdf->SetTitle('Copy of Grades');
$pdf->AddPage();
$pdf->setY(52);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 6, 'GRADING PERIOD REPORT', 0, 1, 'C');

$pdf->setY(62);

$pdf->setX(15);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'NAME', 0, 0, 'L');
$pdf->setX(38);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, ': ' . $fullName, 0, 1, 'L');

$pdf->setY(67);
$pdf->setX(15);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'GRADE/SEC', 0, 0, 'L');
$pdf->setX(38);
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, ': ' . $gradeLevelAndSection, 0, 1, 'L');
$pdf->setY(67);
$pdf->setX(158);
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 1.0, 'AY:', 0, 0, 'L');
$pdf->setX(170);
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 1.0, ': ' . $academic_year, 0, 1, 'L');

$pdf->setY(74);


$pdf->SetLeftMargin(8);
$pdf->SetRightMargin(8);
// Add HTML table
$html = '<table border="0.3" style="border-collapse: collapse; width: 100%;">
            <tr style="background-color: #E1E1E1;">
                <td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 28%;" align="center">Subject</td>
                <td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">
                    1st Quarter
                </td>
                <td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">
                    2nd Quarter
                </td>
                <td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">
                    3rd Quarter
                </td>
                <td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">
                    4th Quarter
                </td>
                <td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 24%;" align="center">Subject Teacher</td>
            </tr>';

if (!empty($school_year_id) && !empty($class_id) && !empty($student_id)) {
    // Update your SQL query to select the course code
    $query_subjects = "SELECT l.*, f.*, s.courseTitle, s.courseCode, sg.q1_grade, sg.q2_grade, sg.q3_grade, sg.q4_grade, s.id as subject_id
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id 
                        JOIN subjects s ON l.subject_id = s.id 
                        JOIN faculty f ON l.faculty_id = f.id
                        WHERE sg.student_id = $student_id AND l.class_id = $class_id AND l.school_year_id = $school_year_id";

    $query_run = mysqli_query($conn, $query_subjects);

    $mapeh_grades = [
        'q1_grade' => 0,
        'q2_grade' => 0,
        'q3_grade' => 0,
        'q4_grade' => 0,
        'count' => 0
    ];

    $individual_mapeh_subjects = [];
    $final_ratings = []; // Array to store final ratings of all subjects

    // Arrays to store quarter-specific grades
    $q1_grades = [];
    $q2_grades = [];
    $q3_grades = [];
    $q4_grades = [];

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $subject_title = !empty($row['mapeh_name']) ? $row['mapeh_name'] : $row['courseTitle'];
            $course_code = $row['courseCode'];

            $q1_grade = isset($row['q1_grade']) ? (int)$row['q1_grade'] : 0;
            $q2_grade = isset($row['q2_grade']) ? (int)$row['q2_grade'] : 0;
            $q3_grade = isset($row['q3_grade']) ? (int)$row['q3_grade'] : 0;
            $q4_grade = isset($row['q4_grade']) ? (int)$row['q4_grade'] : 0;

            // Aggregate MAPEH grades
            if (strpos($course_code, 'MAPEH') !== false) {
                $mapeh_grades['q1_grade'] += $q1_grade;
                $mapeh_grades['q2_grade'] += $q2_grade;
                $mapeh_grades['q3_grade'] += $q3_grade;
                $mapeh_grades['q4_grade'] += $q4_grade;
                $mapeh_grades['count']++;

                // Store individual MAPEH subject grades
                $teacherName = '';

                if ($row['gender'] == 'Male') {
                    $teacherName = 'Mr. ';
                } elseif ($row['gender'] == 'Female') {
                    $teacherName = 'Ms. ';
                }

                $teacherName .= htmlspecialchars($row['firstName'] ?: '') . ' ' . 
                               (!empty($row['middleName']) ? htmlspecialchars($row['middleName'][0] . '. ') : '') . 
                               htmlspecialchars($row['lastName'] ?: '');

                $individual_mapeh_subjects[] = [
                    'title' => $subject_title,
                    'course_code' => $course_code,
                    'q1_grade' => $q1_grade,
                    'q2_grade' => $q2_grade,
                    'q3_grade' => $q3_grade,
                    'q4_grade' => $q4_grade,
                ];
            } else {

                // Append table rows with data and row number
                $html .= '<tr>
                    <td style="font-weight: normal; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 28%;" align="left">
                        &nbsp;&nbsp;'.$subject_title.'
                    </td>';
                    if ($q1_grade > 0) {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'.$q1_grade.'</td>';
            } else {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
            }
                    if ($q2_grade > 0) {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'.$q2_grade.'</td>';
            } else {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
            }
                    if ($q3_grade > 0) {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'.$q3_grade.'</td>';
            } else {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
            }
                    if ($q4_grade > 0) {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'.$q4_grade.'</td>';
            } else {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
            }

                    $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 24%;" align="left">'.$teacherName.'
                    </td>
                </tr>';

                // Store grades in quarter-specific arrays
                $q1_grades[] = $q1_grade;
                $q2_grades[] = $q2_grade;
                $q3_grades[] = $q3_grade;
                $q4_grades[] = $q4_grade;
            }
        }

        // Process consolidated MAPEH grades
        if ($mapeh_grades['count'] > 0) {
            $average_q1 = round($mapeh_grades['q1_grade'] / $mapeh_grades['count']);
            $average_q2 = round($mapeh_grades['q2_grade'] / $mapeh_grades['count']);
            $average_q3 = round($mapeh_grades['q3_grade'] / $mapeh_grades['count']);
            $average_q4 = round($mapeh_grades['q4_grade'] / $mapeh_grades['count']);

            // Retrieve the course code for MAPEH
            $mapeh_course_code = $individual_mapeh_subjects[0]['course_code']; // Assuming there's at least one MAPEH subject

            // Append MAPEH consolidated row using the course code
            $html .= '<tr>
                <td style="font-weight: normal; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 28%;" align="left">
                &nbsp;&nbsp;'.$mapeh_course_code.'
                </td>';

            if ($average_q1 > 0) {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'.$average_q1.'</td>';
            } else {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
            }

            if ($average_q2 > 0) {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'.$average_q2.'</td>';
            } else {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
            }

            if ($average_q3 > 0) {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'.$average_q3.'</td>';
            } else {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
            }

            if ($average_q4 > 0) {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'.$average_q4.'</td>';
            } else {
                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
            }

            $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 24%;" align="left">'.$teacherName.'</td>
            </tr>';

            // Append individual MAPEH subject rows
            foreach ($individual_mapeh_subjects as $subject) {
                $html .= '<tr>
                    <td style="font-weight: normal; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 28%;" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $subject['title'] . '</td>';

                if ($subject['q1_grade'] > 0) {
                    $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">' . $subject['q1_grade'] . '</td>';
                } else {
                    $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
                }

                if ($subject['q2_grade'] > 0) {
                    $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">' . $subject['q2_grade'] . '</td>';
                } else {
                    $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
                }

                if ($subject['q3_grade'] > 0) {
                    $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">' . $subject['q3_grade'] . '</td>';
                } else {
                    $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
                }

                if ($subject['q4_grade'] > 0) {
                    $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">' . $subject['q4_grade'] . '</td>';
                } else {
                    $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
                }

                $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 24%;" align="left">' . $teacherName . '</td>
                </tr>';
            }
        }

        // Calculate general average from final ratings
        $q1_general_average = !empty($q1_grades) ? round(array_sum($q1_grades) / count($q1_grades)) : 0;
        $q2_general_average = !empty($q2_grades) ? round(array_sum($q2_grades) / count($q2_grades)) : 0;
        $q3_general_average = !empty($q3_grades) ? round(array_sum($q3_grades) / count($q3_grades)) : 0;
        $q4_general_average = !empty($q4_grades) ? round(array_sum($q4_grades) / count($q4_grades)) : 0;

        $html .= '<tr border="0">
            <td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 28%;" align="right">General Average</td>';

        if ($q1_general_average > 0) {
            $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'. $q1_general_average .'</td>';
        } else {
            $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
        }

        if ($q2_general_average > 0) {
            $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'. $q2_general_average .'</td>';
        } else {
            $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
        }

        if ($q3_general_average > 0) {
            $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'. $q3_general_average .'</td>';
        } else {
            $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
        }

        if ($q4_general_average > 0) {
            $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center">'. $q4_general_average .'</td>';
        } else {
            $html .= '<td style="font-weight: bold; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 12%;" align="center"></td>';
        }

        $html .= '<td style="font-weight: normal; font-size: 10px; vertical-align: middle; line-height: .50cm; width: 24%;" align="left"></td>
        </tr>';

    } else {
        $html .= '<tr><td colspan="7" style="text-align: center;">No grades found for this student</td></tr>';
    }
}

            
$html .= '        </table>

     
       ';

$pdf->writeHTML($html);


$pdf->setY(-30);
$pdf->SetFont('times', '', 10);
$filename = "Copy_of_Grades" . date("Y-m-d") . ".pdf";

$pdfData = $pdf->Output($filename, 'S');
$base64Pdf = base64_encode($pdfData);
?>

<!DOCTYPE html>
<html>
<head>
    <title>PDF Viewer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
</head>
<body>
    <div id="pdfViewer" style="width: 100%; height: 800px;"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pdfData = atob("<?php echo $base64Pdf; ?>");
            var pdfjsLib = window['pdfjs-dist/build/pdf'];

            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

            var loadingTask = pdfjsLib.getDocument({ data: pdfData });
            loadingTask.promise.then(function(pdf) {
                pdf.getPage(1).then(function(page) {
                    var scale = 1.5;
                    var viewport = page.getViewport({ scale: scale });

                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext).promise.then(function() {
                        document.getElementById('pdfViewer').appendChild(canvas);
                    });
                });
            }, function(reason) {
                console.error(reason);
            });
        });
    </script>
</body>
</html>

<script>
    document.getElementById('savePDF').addEventListener('click', savePDF);
    document.getElementById('printPDF').addEventListener('click', printPDF);

    function savePDF() {
    var pdfData = "<?php echo base64_encode($pdfData); ?>";
    var link = document.createElement("a");
    var currentDate = new Date();
    var dateString = (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + '-' + currentDate.getFullYear();
    link.href = "data:application/pdf;base64," + pdfData;
    link.download = "Attendance_Summary_" + dateString + ".pdf";
    link.click();
}

    function printPDF() {
        var pdfData = "<?php echo base64_encode($pdfData); ?>";
        var pdfWindow = window.open(""); // Open a new window

        // Write PDF content to the new window
        pdfWindow.document.write("<iframe width=\'100%\' height=\'100%\' src=\'data:application/pdf;base64," + pdfData + "\'></iframe>");

        // Wait for PDF content to load before printing
        pdfWindow.onload = function() {
            // Print PDF
            pdfWindow.focus();
            pdfWindow.print();
            
            // Close the window after printing
            setTimeout(function() {
                pdfWindow.close();
            }, 1000);
        };
    }
</script>