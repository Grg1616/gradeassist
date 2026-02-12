<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
    include('../assets/includes/header.php');
    include('../assets/includes/navbar_faculty.php');
    require '../db_conn.php';
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
                        <h5 class="card-title">List of Subjects Assigned</h5>

                        <?php
                        // Display messages
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
                                    // Get faculty ID - check which session variable is used in your system
                                    if (isset($_SESSION['user_id'])) {
                                        $faculty_id = $_SESSION['user_id'];
                                    } elseif (isset($_SESSION['id'])) {
                                        $faculty_id = $_SESSION['id'];
                                    } else {
                                        $_SESSION['message_danger'] = "User ID not found in session";
                                        header("Location: faculty_dashboard.php");
                                        exit();
                                    }
                                    
                                    // Query to get subjects assigned to the faculty with section and student count
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
                                            WHERE l.faculty_id = ?
                                            ORDER BY ac.class_start DESC, s.semester, s.gradeLevel, s.courseCode";
                                    
                                    $stmt = mysqli_prepare($conn, $query);
                                    if ($stmt) {
                                        mysqli_stmt_bind_param($stmt, "i", $faculty_id);
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);
                                        
                                        $counter = 1;
                                        $seen_subject_areas = array();

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // skip duplicate subject areas (e.g., MAPEH components)
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
                                                        <h5 class="mt-3">No subjects assigned yet</h5>
                                                        <p class="mb-0">Please contact your administrator if you believe this is an error.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        echo '<tr><td colspan="10" class="text-center text-danger">Error preparing database query.</td></tr>';
                                    }
                                    
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

</main><!-- End #main -->

<?php
} else {
    header("Location: ../faculty-portal.php");
    exit();
}
?>

<?php
include('../assets/includes/footer.php');
?>