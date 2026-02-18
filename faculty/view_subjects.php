<?php
session_start();

// ==================== BACKEND: Authentication & Access Control ====================
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
    include('../assets/includes/header.php');
    include('../assets/includes/navbar_faculty.php');
    require '../db_conn.php';

    // ==================== BACKEND: Get Faculty ID from Session ====================
    if (isset($_SESSION['user_id'])) {
        $faculty_id = $_SESSION['user_id'];
    } elseif (isset($_SESSION['id'])) {
        $faculty_id = $_SESSION['id'];
    } else {
        $_SESSION['message_danger'] = "User ID not found in session";
        header("Location: faculty_dashboard.php");
        exit();
    }

    // ==================== BACKEND: Determine Current Academic Year ====================
    // We'll use the year where today's date falls between class_start and class_end.
    // If none, fallback to the latest academic year.
    $current_year_id = null;
    $current_year_query = "SELECT id FROM academic_calendar WHERE CURDATE() BETWEEN class_start AND class_end LIMIT 1";
    $current_year_result = mysqli_query($conn, $current_year_query);
    if ($current_year_result && mysqli_num_rows($current_year_result) > 0) {
        $current_year_id = mysqli_fetch_assoc($current_year_result)['id'];
    } else {
        // No active academic year found – use the most recent one
        $latest_query = "SELECT id FROM academic_calendar ORDER BY class_start DESC LIMIT 1";
        $latest_result = mysqli_query($conn, $latest_query);
        if ($latest_result && mysqli_num_rows($latest_result) > 0) {
            $current_year_id = mysqli_fetch_assoc($latest_result)['id'];
        }
    }

    // ==================== BACKEND: Capture and Interpret Filter Input ====================
    // Possible scenarios:
    // 1. No 'school_year_id' parameter → first page load → default to current year.
    // 2. 'school_year_id' is empty string → user selected "All Academic Years" → no filter.
    // 3. 'school_year_id' is a positive integer → user selected a specific year.
    $filter_school_year_id = 0; // 0 means "no filter" (all years)
    $default_to_current = false;

    if (isset($_GET['school_year_id'])) {
        if ($_GET['school_year_id'] === '') {
            // Explicit "All Academic Years" – no filter
            $filter_school_year_id = 0;
        } else {
            // Specific year selected
            $filter_school_year_id = intval($_GET['school_year_id']);
        }
    } else {
        // No parameter at all – first load, default to current year
        $default_to_current = true;
        if ($current_year_id) {
            $filter_school_year_id = $current_year_id;
        }
    }

    // ==================== BACKEND: Fetch All Academic Years for Dropdown ====================
    $academic_years = [];
    $ay_query = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY class_start DESC";
    $ay_result = mysqli_query($conn, $ay_query);
    if ($ay_result) {
        while ($ay = mysqli_fetch_assoc($ay_result)) {
            $academic_years[] = $ay;
        }
    }
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>My Subjects</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="faculty_dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">My Subjects</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">List of Subjects Assigned</h5>
                            <!-- Filter Button (opens modal) -->
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#academicYearFilterModal">
                                <i class="bi bi-funnel"></i> Filter by Academic Year
                            </button>
                        </div>

                        <?php
                        // ==================== BACKEND: Display Active Filter Badge ====================
                        if ($filter_school_year_id > 0) {
                            // Find the selected academic year text from the previously fetched array
                            $selected_year_text = '';
                            foreach ($academic_years as $ay) {
                                if ($ay['id'] == $filter_school_year_id) {
                                    $selected_year_text = date('Y', strtotime($ay['class_start'])) . ' - ' . date('Y', strtotime($ay['class_end']));
                                    break;
                                }
                            }
                            if ($selected_year_text) {
                                $badge_message = ($default_to_current) ? 'Current Academic Year: ' : 'Active Filter: ';
                                echo '<div class="alert alert-info py-2">' . $badge_message . '<strong>' . htmlspecialchars($selected_year_text) . '</strong> <a href="view_subjects.php" class="float-end">Clear Filter</a></div>';
                            }
                        } elseif ($filter_school_year_id == 0 && isset($_GET['school_year_id']) && $_GET['school_year_id'] === '') {
                            // User explicitly selected "All Academic Years"
                            echo '<div class="alert alert-secondary py-2">Showing <strong>All Academic Years</strong> <a href="view_subjects.php" class="float-end">Clear Filter</a></div>';
                        }

                        // Display session messages (success/error)
                        if (isset($_SESSION['message'])) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i> ' . $_SESSION['message'] . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                            unset($_SESSION['message']);
                        }

                        if (isset($_SESSION['message_danger'])) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"></i> ' . $_SESSION['message_danger'] . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                            unset($_SESSION['message_danger']);
                        }
                        ?>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Course Code</th>
                                        <th scope="col">Course Title</th>
                                        <th scope="col"><small>Subject Area</small></th>
                                        <th scope="col"><small>Contact Hours</small></th>
                                        <th scope="col"><small>Section</small></th>
                                        <th scope="col"><small>Grade Level</small></th>
                                        <th scope="col"><small>Total Students</small></th>
                                        <th scope="col"><small>School Year</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // ==================== BACKEND: Main Query with Dynamic Filter ====================
                                    $query = "SELECT 
                                                s.id,
                                                s.courseCode,
                                                s.courseTitle,
                                                s.subjectArea,
                                                s.contactHours,
                                                s.gradeLevel,
                                                s.semester,
                                                ac.class_start,
                                                ac.class_end,
                                                l.id as load_id,
                                                l.school_year_id,
                                                c.section,
                                                (SELECT COUNT(*) 
                                                 FROM class_students cs 
                                                 WHERE cs.class_id = c.id 
                                                 AND cs.school_year_id = l.school_year_id) as total_students
                                            FROM loads l
                                            JOIN subjects s ON l.subject_id = s.id
                                            JOIN academic_calendar ac ON l.school_year_id = ac.id
                                            LEFT JOIN class c ON l.class_id = c.id
                                            WHERE l.faculty_id = ?";

                                    // Add filter condition if a specific year is selected (including default current year)
                                    if ($filter_school_year_id > 0) {
                                        $query .= " AND l.school_year_id = ?";
                                    }

                                    $query .= " ORDER BY ac.class_start DESC, s.semester, s.gradeLevel, s.courseCode";

                                    $stmt = mysqli_prepare($conn, $query);
                                    if ($stmt) {
                                        // Bind parameters based on whether a specific year is filtered
                                        if ($filter_school_year_id > 0) {
                                            mysqli_stmt_bind_param($stmt, "ii", $faculty_id, $filter_school_year_id);
                                        } else {
                                            mysqli_stmt_bind_param($stmt, "i", $faculty_id);
                                        }

                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);
                                        
                                        $counter = 1;
                                        $seen_subject_areas = array();

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Skip duplicate subject areas (e.g., MAPEH components)
                                                if (!empty($row['subjectArea']) && in_array($row['subjectArea'], $seen_subject_areas)) {
                                                    continue;
                                                }
                                                if (!empty($row['subjectArea'])) {
                                                    $seen_subject_areas[] = $row['subjectArea'];
                                                }
                                                // Format school year
                                                $school_year = date('Y', strtotime($row['class_start'])) . ' - ' . date('Y', strtotime($row['class_end']));
                                                
                                                // Get section (if available)
                                                $section = !empty($row['section']) ? $row['section'] : 'N/A';
                                                
                                                // Get total students (if available)
                                                $total_students = isset($row['total_students']) ? $row['total_students'] : 0;
                                    ?>
                                                <tr>
                                                    <th scope="row"><?php echo $counter++; ?></th>
                                                    <td><strong><?php echo htmlspecialchars($row['courseCode']); ?></strong></td>
                                                    <td><?php echo htmlspecialchars($row['courseTitle']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['subjectArea']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['contactHours']); ?> hrs</td>
                                                    <td><?php echo htmlspecialchars($section); ?></td>
                                                    <td><?php echo htmlspecialchars($row['gradeLevel']); ?></td>
                                                    <td><strong><?php echo $total_students; ?> student<?php echo $total_students != 1 ? 's' : ''; ?></strong></td>
                                                    <td> <?php echo $school_year; ?></td>
                                                </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                            <tr>
                                                <td colspan="10" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-journal-x display-4"></i>
                                                        <h5 class="mt-3">No subjects assigned for this academic year</h5>
                                                        <p class="mb-0">Try selecting a different year or contact your administrator.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        echo '<tr><td colspan="10" class="text-center text-danger">Error preparing database query.</td></tr>';
                                    }
                                    
                                    // ==================== BACKEND: Close Connection ====================
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== FRONTEND: Academic Year Filter Modal ==================== -->
    <div class="modal fade" id="academicYearFilterModal" tabindex="-1" aria-labelledby="academicYearFilterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="academicYearFilterModalLabel">Select Academic Year</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- The form uses GET to submit the selected year back to the same page -->
                <form method="get" action="view_subjects.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="school_year_id" class="form-label">Academic Year</label>
                            <select class="form-select" id="school_year_id" name="school_year_id">
                                <option value="">All Academic Years</option>
                                <?php 
                                // Populate dropdown with academic years from the backend array
                                foreach ($academic_years as $ay): 
                                    $year_display = date('Y', strtotime($ay['class_start'])) . ' - ' . date('Y', strtotime($ay['class_end']));
                                    // Determine if this option should be selected
                                    if ($filter_school_year_id == $ay['id']) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                ?>
                                    <option value="<?php echo $ay['id']; ?>" <?php echo $selected; ?>><?php echo htmlspecialchars($year_display); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Apply Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?php
} else {
    // If not logged in, redirect to login page
    header("Location: ../faculty-portal.php");
    exit();
}
?>

<?php
include('../assets/includes/footer.php');
?>