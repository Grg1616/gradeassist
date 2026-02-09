<?php
require '../db_conn.php';

// Check if school_year parameter is set
if(isset($_GET['school_year'])) {
    // Sanitize the input
    $selectedSchoolYear = mysqli_real_escape_string($conn, $_GET['school_year']);

    // Your SQL query to fetch class options based on the selected school year
    $query_class = "SELECT class.id, class.gradeLevel, class.section
                    FROM class
                    WHERE school_year_id = '$selectedSchoolYear'";

    $result = mysqli_query($conn, $query_class);

    if($result) {
        $classOptions = array();

        // Fetch class options
        while($row = mysqli_fetch_assoc($result)) {
            $classOptions[] = array(
                'id' => $row['id'],
                'label' => $row['gradeLevel'] . ' - ' . $row['section']
            );
        }

        // Free result set
        mysqli_free_result($result);

        // Send class options as JSON response
        header('Content-Type: application/json');
        echo json_encode($classOptions);
    } else {
        // Handle query error
        echo json_encode(array('error' => 'Query failed: ' . mysqli_error($conn)));
    }
} else {
    // Handle missing school_year parameter
    echo json_encode(array('error' => 'Missing school_year parameter'));
}
?>
