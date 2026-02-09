<?php
// Include database connection file
require '../db_conn.php';

// Initialize variables for class ID and school year ID
$class_id = null;
$school_year_id = null;

// Check if class_id and school_year_id are provided and numeric
if (isset($_GET['class_id']) && isset($_GET['school_year_id']) && is_numeric($_GET['class_id']) && is_numeric($_GET['school_year_id'])) {
    // Sanitize input data
    $class_id = mysqli_real_escape_string($conn, $_GET['class_id']);
    $school_year_id = mysqli_real_escape_string($conn, $_GET['school_year_id']);
}

// Query to select students
$query = "SELECT s.* FROM students s";

// Append conditions based on provided class_id and school_year_id
if ($class_id !== null && $school_year_id !== null) {
    $query .= " LEFT JOIN class_students cs 
                ON s.id = cs.student_id 
                WHERE cs.class_id = '$class_id'
                AND cs.school_year_id = '$school_year_id'
                AND cs.student_id IS NOT NULL";
} else {
    // If class_id and school_year_id are not provided, select students who are not associated with any class for the newest school year
    $newest_school_year_query = "SELECT MAX(id) as newest_school_year_id FROM academic_calendar";
    $newest_school_year_result = mysqli_query($conn, $newest_school_year_query);
    $newest_school_year_row = mysqli_fetch_assoc($newest_school_year_result);
    $newest_school_year_id = $newest_school_year_row['newest_school_year_id'];

    $query .= " WHERE s.id NOT IN (SELECT student_id FROM class_students WHERE school_year_id = '$newest_school_year_id')";
}

// Execute the query
$result = mysqli_query($conn, $query);

if ($result) {
    // Start building the table
    $output = '<table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SR-Code</th>
                            <th>LRN</th>
                            <th>Student Name</th>
                            <th>Gender</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>';

    // Fetch and display student data
    while ($row = mysqli_fetch_assoc($result)) {
        // Concatenate first name, middle name, and last name
        $fullName = $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'];
        $output .= "<tr>";
        // Display full name
        $output .= "<td>" . htmlspecialchars($row['sr_code']) . "</td>"; // Sanitize output
        $output .= "<td>" . htmlspecialchars($row['lrn']) . "</td>"; // Sanitize output
        $output .= "<td>" . htmlspecialchars($fullName) . "</td>"; // Sanitize output
        $output .= "<td>" . htmlspecialchars($row['gender']) . "</td>"; // Sanitize output
        $output .= "<td><input type='checkbox' class='student-checkbox' name='selected_students[]' value='" . htmlspecialchars($row['id']) . "'></td>"; // Sanitize output
        $output .= "</tr>";
    }

    // Finish building the table
    $output .= '</tbody></table>';

    // Echo the HTML code for the table
    echo $output;
} else {
    // Handle query failure
    echo "Query failed: " . mysqli_error($conn);
}
?>
