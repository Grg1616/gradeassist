<?php
require '../db_conn.php';

// Retrieve selected parameters
$gradeLevel = isset($_POST['gradeLevel']) ? $_POST['gradeLevel'] : '';
$semester = isset($_POST['semester']) && $_POST['semester'] !== '' ? intval($_POST['semester']) : null;
$class_id = isset($_POST['class_id']) ? intval($_POST['class_id']) : 0;
$school_year_id = isset($_POST['school_year_id']) ? intval($_POST['school_year_id']) : 0;
$current_subject = isset($_POST['current_subject_id']) ? intval($_POST['current_subject_id']) : 0;

// if a class_id was supplied, override the grade level with the actual class record
if ($class_id) {
    $gl_res = mysqli_query($conn, "SELECT gradeLevel FROM class WHERE id = $class_id LIMIT 1");
    if ($gl_res && mysqli_num_rows($gl_res) > 0) {
        $gl_row = mysqli_fetch_assoc($gl_res);
        $gradeLevel = $gl_row['gradeLevel'];
    }
}

// build array of subjects to exclude (already assigned to this class/year and optionally semester)
$excludeIds = [];
if ($class_id && $school_year_id) {
    $sqlEx = "SELECT subject_id FROM loads WHERE class_id = $class_id AND school_year_id = $school_year_id";
    if ($semester !== null) {
        $sqlEx .= " AND semester = $semester";
    }
    $resEx = mysqli_query($conn, $sqlEx);
    if ($resEx) {
        while ($er = mysqli_fetch_assoc($resEx)) {
            $excludeIds[] = intval($er['subject_id']);
        }
    }
    // if we have a current_subject (from edit) remove it from exclusion so it stays selectable
    if ($current_subject && ($key = array_search($current_subject, $excludeIds)) !== false) {
        unset($excludeIds[$key]);
    }
}

// Construct main query
$filter = "";
if (!empty($gradeLevel)) {
    $filter = "WHERE gradeLevel = '" . mysqli_real_escape_string($conn, $gradeLevel) . "'";
} else {
    // If no grade level is set, return only the disabled option
    $options = '<option disabled selected>Select Subject (Class required)</option>';
    echo $options;
    exit;
}

if (!empty($excludeIds)) {
    $filter .= ' AND id NOT IN (' . implode(',', $excludeIds) . ')';
}
if (($gradeLevel === 'Grade 11' || $gradeLevel === 'Grade 12') && $semester !== null) {
    $filter .= " AND semester = $semester";
}

$query_subjects = "SELECT id, courseCode, courseTitle FROM subjects $filter ORDER BY courseCode";
$query_run_subjects = mysqli_query($conn, $query_subjects);

// Build options for subject dropdown
$options = '<option disabled selected>Select Subject</option>';
if ($query_run_subjects && mysqli_num_rows($query_run_subjects) > 0) {
    while ($row = mysqli_fetch_assoc($query_run_subjects)) {
        $courseCode = $row['courseCode'];
        $courseTitle = $row['courseTitle'];
        $subjectLabel = $courseCode ? $courseCode . '&nbsp;&nbsp;-&nbsp;&nbsp;' . $courseTitle : $courseTitle;
        $options .= '<option value="' . $row['id'] . '">' . $subjectLabel . '</option>';
    }
}

echo $options;
?>

