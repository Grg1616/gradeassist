<?php
require '../db_conn.php'; // Ensure this file contains your database connection details
?>
<script type="text/javascript">
// Function to generate an array of 10 colors from dark to light based on the selected color
function generateColorRange(selectedColor) {
    var colorRange = [];
    var color = new Color(selectedColor);

    for (var i = 0; i < 10; i++) {
        colorRange.push(color.toHex());
        color.lighten(40); // Increase the amount to create a larger gap
    }

    return colorRange;
}

// Color class for manipulating colors
class Color {
    constructor(hex) {
        this.red = parseInt(hex.slice(1, 3), 16);
        this.green = parseInt(hex.slice(3, 5), 16);
        this.blue = parseInt(hex.slice(5, 7), 16);
    }

    toHex() {
        return `#${this.red.toString(16).padStart(2, '0')}${this.green.toString(16).padStart(2, '0')}${this.blue.toString(16).padStart(2, '0')}`;
    }

    lighten(amount) {
        this.red = Math.min(255, this.red + amount);
        this.green = Math.min(255, this.green + amount);
        this.blue = Math.min(255, this.blue + amount);
    }
}
</script>

<?php
$sql = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Output data of the latest row
    $row = $result->fetch_assoc();
    $start_year = date('Y', strtotime($row['class_start']));
    $end_year = date('Y', strtotime($row['class_end']));
    $academic_year = "$start_year - $end_year";
    $newest_school_year = $row['id'];
} else {
    $academic_year = "";
    $newest_school_year = "";
}

$sql = "SELECT id FROM class ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Output data of the latest row
    $row = $result->fetch_assoc();
    $newest_class_id = $row['id'];
} else {
    $newest_class_id = "";
}

?>


<form id="filterForm" action="" method="POST">
    <div class="row align-items-center">
        <div class="col-md-5 mb-2 text-center">
           <div class="card mt-4 shadow-sm">
                <div class="card-body mb-0 py-2 d-flex align-items-center justify-content-center">
                    <h6 class="fw-normal mt-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Analytics date range">
                        Analytics for
                        <?php
// Assume $conn is your database connection

// Ensure $school_year is set and numeric
$school_year = !empty($_POST['school_year']) ? intval($_POST['school_year']) : $newest_school_year;

// Ensure $class_id is set and numeric
$class_id = !empty($_POST['class_id']) ? intval($_POST['class_id']) : $newest_class_id;

$academic_year = "0000-0000";
$class = "Grade Level/Section";

// Fetch academic year details
if (!empty($school_year)) {
    $escaped_school_year = mysqli_real_escape_string($conn, $school_year);
    $sql = "SELECT id, class_start, class_end FROM academic_calendar WHERE id = '$escaped_school_year'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $start_year = date('Y', strtotime($row['class_start']));
        $end_year = date('Y', strtotime($row['class_end']));
        $academic_year = "$start_year - $end_year";
    }
}

// Fetch class details
if (!empty($class_id)) {
    $escaped_class_id = mysqli_real_escape_string($conn, $class_id);
    $sql = "SELECT * FROM class WHERE id = '$escaped_class_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gradeLevel = $row['gradeLevel'];
        $section = $row['section'];
        $class = "$gradeLevel-$section";
    }
}

// Output the results if both academic_year and class are not empty
if (!empty($academic_year) && !empty($class)) {
    echo "<span class='fw-bold'>$class</span> School Year <span class='fw-bold'>$academic_year</span>";
}
?>


                    </h6>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-2">
            <div class="form-group">
                <div class="form-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Select chart color">
                    <input type="color" class="form-control" id="colorPicker" name="chart_color" value="<?php echo isset($_POST['chart_color']) ? $_POST['chart_color'] : '#026601'; ?>">
                    <label for="colorPicker" class="form-label">Chart Color</label>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-2">
            <div class="form-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Select from date">
                <select class="form-select" id="school_year" name="school_year" aria-label="State">
                    <option selected value>Academic Year</option> <!-- Add empty option -->
                    <?php
                    // Fetch academic years
                    $school_year = !empty($_POST['school_year']) ? $_POST['school_year'] : $newest_school_year;

                    $query_drivers = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY class_start DESC";
                    $query_run_drivers = mysqli_query($conn, $query_drivers);

                    if (mysqli_num_rows($query_run_drivers) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run_drivers)) {
                            $startYear = date('Y', strtotime($row['class_start']));
                            $endYear = date('Y', strtotime($row['class_end']));
                            $academicYearLabel = "$startYear-$endYear";

                            $selected = (isset($school_year) && $school_year == $row['id']) ? 'selected' : $newest_school_year;

                            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $academicYearLabel . '</option>';
                        }
                    }
                    ?>
                </select>
                <label for="school_year">Academic Year</label>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="form-floating" data-bs-toggle="tooltip" data-bs-placement="top" title="Select to date">
                <select id="class_id" name="class_id" class="form-select" aria-label="Select Class">
                    <option disabled selected>Class</option>
                    <?php
                    $class_id = !empty($_POST['class_id']) ? $_POST['class_id'] : $newest_class_id;
                    if (isset($school_year)) {
                        $selectedYear = $school_year;
                        $query_class = "SELECT id, gradeLevel, section FROM class WHERE school_year_id = '$selectedYear'";
                        $query_run_class = mysqli_query($conn, $query_class);

                        if ($query_run_class) {
                            if (mysqli_num_rows($query_run_class) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run_class)) {
                                    $gradeLevel = $row['gradeLevel'];
                                    $section = $row['section'];
                                    $classLabel = $gradeLevel . ' - ' . $section;

                                    $selected = (isset($class_id) && $class_id == $row['id']) ? 'selected' : $newest_class_id;

                                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $classLabel . '</option>';
                                }
                            } else {
                                echo '<option disabled>No classes found for the selected academic year</option>';
                            }
                        } else {
                            echo '<option disabled>Error: ' . mysqli_error($conn) . '</option>';
                        }
                    }
                    ?>
                </select>
                <label for="class_id">Class</label>
            </div>
        </div>
    </div>
</form>

<script>
    // Add event listeners for select change
    document.getElementById('school_year').addEventListener('change', function() {
        document.getElementById('filterForm').submit(); // Submit the form on change
    });

    document.getElementById('class_id').addEventListener('change', function() {
        document.getElementById('filterForm').submit(); // Submit the form on change
    });

    document.getElementById('colorPicker').addEventListener('change', function() {
        document.getElementById('filterForm').submit(); // Submit the form on change
    });
</script>
<style>
    .no-caret::after {
        display: none;
    }
</style>

<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center fw-bold py-2">
                <h6 class="fw-bold text-start mb-0 text-dark">Top Five Highest Final Grades</h6>
                <i id="btnGroupDrop1" type="button" class="bi bi-three-dots-vertical btn btn-md btn-dw dropdown-toggle no-caret text-dark" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <li><a class="dropdown-item btn" id="exportPngHighest"><i class="bi bi-person-plus"></i>Export as PNG</a></li>
                    <li><a class="dropdown-item btn" id="exportJpgHighest"><i class="bi bi-gear"></i>Export as JPEG</a></li>
                    <li><a class="dropdown-item btn" id="exportPdfHighest"><i class="bi bi-trash"></i>Export as PDF</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="chart-wrapper" style="position: relative; height: 100%;">
                    <div class="chart-container" style="position: relative; height: 100%; width: 100%;">
                        <canvas id="highest_grade"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $school_year = isset($_POST['school_year']) ? $_POST['school_year'] : $newest_school_year;
        $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : $newest_class_id;

        if (!$conn) {
            echo "Database connection error.";
        } else {
            $sql = "SELECT 
                        s.id AS student_id,
                        s.lastName AS student_name,
                        AVG(subject_avg) AS final_grade_average
                    FROM (
                        SELECT 
                            sg.student_id,
                            sj.courseTitle,
                            sj.courseCode,
                            (COALESCE(sg.q1_grade, 0) + COALESCE(sg.q2_grade, 0) + COALESCE(sg.q3_grade, 0) + COALESCE(sg.q4_grade, 0)) / 4 AS subject_avg
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id
                        JOIN subjects sj ON l.subject_id = sj.id
                        WHERE l.school_year_id = '$school_year' 
                        AND l.class_id = '$class_id'
                    ) AS subject_averages
                    JOIN students s ON subject_averages.student_id = s.id
                    GROUP BY 
                        s.id, s.lastName, s.firstName
                    ORDER BY 
                        final_grade_average DESC, s.lastName, s.firstName
                    LIMIT 5";

            $result = mysqli_query($conn, $sql);
            $student_name_high = [];
            $final_grade_average_high = [];

            while ($row = mysqli_fetch_array($result)) {
                $student_name_high[] = $row['student_name'];
                $final_grade_average_high[] = $row['final_grade_average'];
            }
        }
        ?>

        <script type="text/javascript">
            // Get the canvas context
            var ctx = document.getElementById("highest_grade").getContext('2d');

            // Initial chart configuration
            var myChart_highest = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($student_name_high); ?>,
                    datasets: [{
                        backgroundColor: generateColorRange(document.getElementById("colorPicker").value),
                        borderColor: generateColorRange(document.getElementById("colorPicker").value),
                        borderWidth: 1,
                        data: <?php echo json_encode($final_grade_average_high); ?>,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Name',
                                fontSize: 16
                            },
                            ticks: {
                                beginAtZero: true,
                                fontSize: 14
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Final Grade',
                                fontSize: 16
                            },
                            ticks: {
                                fontSize: 14
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'end'
                        }
                    }
                }
            });

            // Event listener for color picker changes
            document.getElementById("colorPicker").addEventListener("input", function () {
                // Update chart colors when the color picker changes
                var selectedColor = this.value;
                myChart_highest.data.datasets[0].backgroundColor = generateColorRange(selectedColor);
                myChart_highest.data.datasets[0].borderColor = generateColorRange(selectedColor);
                myChart_highest.update(); // Update the chart to reflect the new colors
            });
        </script>
    </div>

    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center fw-bold py-2">
                <h6 class="fw-bold text-start mb-0 text-dark">Top Five Lowest Final Grades</h6>
                <i id="btnGroupDrop1" type="button" class="bi bi-three-dots-vertical btn btn-md btn-dw dropdown-toggle no-caret text-dark" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <li><a class="dropdown-item btn" id="exportPngLowest"><i class="bi bi-person-plus"></i>Export as PNG</a></li>
                    <li><a class="dropdown-item btn" id="exportJpgLowest"><i class="bi bi-gear"></i>Export as JPEG</a></li>
                    <li><a class="dropdown-item btn" id="exportPdfLowest"><i class="bi bi-trash"></i>Export as PDF</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="chart-wrapper" style="position: relative; height: 100%;">
                    <div class="chart-container" style="position: relative; height: 100%; width: 100%;">
                        <canvas id="lowest_grade"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $school_year = isset($_POST['school_year']) ? $_POST['school_year'] : $newest_school_year;
        $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : $newest_class_id;

        if (!$conn) {
            echo "Database connection error.";
        } else {
            $sql = "SELECT 
                        s.id AS student_id,
                        s.lastName AS student_name,
                        AVG(subject_avg) AS final_grade_average
                    FROM (
                        SELECT 
                            sg.student_id,
                            sj.courseTitle,
                            sj.courseCode,
                            (COALESCE(sg.q1_grade, 0) + COALESCE(sg.q2_grade, 0) + COALESCE(sg.q3_grade, 0) + COALESCE(sg.q4_grade, 0)) / 4 AS subject_avg
                        FROM subject_grades sg
                        JOIN loads l ON sg.load_id = l.id
                        JOIN subjects sj ON l.subject_id = sj.id
                        WHERE l.school_year_id = '$school_year' 
                        AND l.class_id = '$class_id'
                    ) AS subject_averages
                    JOIN students s ON subject_averages.student_id = s.id
                    GROUP BY 
                        s.id, s.lastName, s.firstName
                    ORDER BY 
                        final_grade_average ASC, s.lastName, s.firstName
                    LIMIT 5";

            $result = mysqli_query($conn, $sql);
            $student_name_low = [];
            $final_grade_average_low = [];

            while ($row = mysqli_fetch_array($result)) {
                $student_name_low[] = $row['student_name'];
                $final_grade_average_low[] = $row['final_grade_average'];
            }
        }
        ?>

        <script type="text/javascript">
            // Get the canvas context
            var ctx = document.getElementById("lowest_grade").getContext('2d');

            // Initial chart configuration
            var myChart_highest = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($student_name_low); ?>,
                    datasets: [{
                        backgroundColor: generateColorRange(document.getElementById("colorPicker").value),
                        borderColor: generateColorRange(document.getElementById("colorPicker").value),
                        borderWidth: 1,
                        data: <?php echo json_encode($final_grade_average_low); ?>,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Name',
                                fontSize: 16
                            },
                            ticks: {
                                beginAtZero: true,
                                fontSize: 14
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Final Grade',
                                fontSize: 16
                            },
                            ticks: {
                                fontSize: 14
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'end'
                        }
                    }
                }
            });

            // Event listener for color picker changes
            document.getElementById("colorPicker").addEventListener("input", function () {
                // Update chart colors when the color picker changes
                var selectedColor = this.value;
                myChart_highest.data.datasets[0].backgroundColor = generateColorRange(selectedColor);
                myChart_highest.data.datasets[0].borderColor = generateColorRange(selectedColor);
                myChart_highest.update(); // Update the chart to reflect the new colors
            });
        </script>
    </div>
</div>

<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script type="text/javascript">
function setupExportButton(buttonId, chartId, format) {
    document.getElementById(buttonId).addEventListener("click", function () {
        exportChart(chartId, format);
    });
}

function exportChart(chartId, format) {
    var chartCanvas = document.getElementById(chartId);

    if (format === "pdf") {
        // Use html2canvas to capture the chart canvas
        html2canvas(chartCanvas).then(function (canvas) {
            var imgData = canvas.toDataURL('image/png');
            var docDefinition = {
                content: [{
                    image: imgData,
                    width: 500,
                }],
            };
            pdfMake.createPdf(docDefinition).download(chartId + '.pdf');
        });
    } else {
        // Use html2canvas to capture the chart canvas
        html2canvas(chartCanvas).then(function (canvas) {
            var imgData;
            if (format === "png") {
                imgData = canvas.toDataURL('image/png');
            } else if (format === "jpg") {
                imgData = canvas.toDataURL('image/jpeg');
            }

            // Create a temporary link element to trigger the download
            var a = document.createElement('a');
            a.href = imgData;
            a.download = chartId + '.' + format;
            a.style.display = 'none';
            document.body.appendChild(a);   

            // Trigger the click event to download the image
            a.click();

            // Clean up
            document.body.removeChild(a);
        });
    }
}

// Set up export buttons for different charts
setupExportButton("exportPngHighest", "highest_grade", "png");
setupExportButton("exportJpgHighest", "highest_grade", "jpg");
setupExportButton("exportPdfHighest", "highest_grade", "pdf");

setupExportButton("exportPngLowest", "lowest_grade", "png");
setupExportButton("exportJpgLowest", "lowest_grade", "jpg");
setupExportButton("exportPdfLowest", "lowest_grade", "pdf");
</script>
