<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
    include('../assets/includes/header.php');
    include('../assets/includes/navbar_faculty.php');
    require '../db_conn.php';

    // ========== SCHOOL YEAR FILTER LOGIC ========== //
    // Get the current/latest school year (same approach as dashboard)
    $school_year_query = "SELECT MAX(id) AS newest_id FROM academic_calendar";
    $school_year_result = mysqli_query($conn, $school_year_query);
    $school_year_row = mysqli_fetch_assoc($school_year_result);
    $selected_syid = $school_year_row['newest_id'] ?? 0;

    // Get label for the selected year (for header)
    $selected_sy_label = '';
    if ($selected_syid > 0) {
        $label_res = mysqli_query($conn, "SELECT class_start, class_end FROM academic_calendar WHERE id = $selected_syid");
        if ($lrow = mysqli_fetch_assoc($label_res)) {
            $selected_sy_label = date('Y', strtotime($lrow['class_start'])) . '-' . date('Y', strtotime($lrow['class_end']));
        }
    }
    // ============================================== //

    // Prepare classes query – get all classes where faculty teaches (advisory + subject load)
    $query = "SELECT DISTINCT 
        class.id, 
        class.section, 
        class.gradeLevel,
        class.school_year_id,
        sy.class_start,
        sy.class_end
    FROM class
    JOIN academic_calendar sy ON class.school_year_id = sy.id
    WHERE (class.faculty_id = {$_SESSION['user_id']} OR class.id IN (
        SELECT loads.class_id FROM loads WHERE loads.faculty_id = {$_SESSION['user_id']}
    ))
    AND class.school_year_id = $selected_syid
    ORDER BY class.gradeLevel ASC, class.section ASC;";

    $query_run = mysqli_query($conn, $query);
    $classes_count = ($query_run) ? mysqli_num_rows($query_run) : 0;
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Students by Class</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="faculty_dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Students by Class</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <!-- Tab Navigation -->
        <div class="card shadow">
            <div class="card-header justify-content-between px-4 d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Total view of <?php echo $classes_count; ?> Classes for AY <?php echo $selected_sy_label ?: 'N/A'; ?></h5>
                    <small class="text-muted">Select a class to view students</small>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-bordered" id="viewTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-view" type="button" role="tab">
                            <i class="bi bi-grid-3x3-gap"></i> Card View
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="table-tab" data-bs-toggle="tab" data-bs-target="#table-view" type="button" role="tab">
                            <i class="bi bi-table"></i> Table View
                        </button>
                    </li>
                </ul>

                <div class="tab-content pt-2" id="viewTabsContent">

                    <!-- ========== CARD VIEW ========== -->
                    <div class="tab-pane fade show active" id="list-view" role="tabpanel">
                        <div id="classCardsContainer" class="row mt-3">
                            <?php
                            if ($classes_count > 0) {
                                while ($class = mysqli_fetch_assoc($query_run)) {
                                    // Count students in this class for the current school year
                                    $student_count_query = "SELECT COUNT(DISTINCT class_students.student_id) as student_count
                                                           FROM class_students
                                                           WHERE class_students.class_id = {$class['id']}
                                                           AND class_students.school_year_id = {$class['school_year_id']}";
                                    $student_count_result = mysqli_query($conn, $student_count_query);
                                    $student_count = mysqli_fetch_assoc($student_count_result)['student_count'];
                                    ?>
                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                                        <div class="card"
                                             data-class-id="<?php echo $class['id']; ?>"
                                             data-class-name="<?php echo $class['gradeLevel']; ?> - <?php echo htmlspecialchars($class['section']); ?>">
                                            <div class="card-header bg-secondary fw-bold fs-5 text-white"><?php echo $class['gradeLevel'] . ' - ' . $class['section']; ?></div>
                                             <div class="card-body">
                                            <div class="text-end py-2 mb-2">
                                                <i class="bi bi-people"></i> <?php echo $student_count; ?> Student<?php echo $student_count != 1 ? 's' : ''; ?>
                                            </div>    
                                            <div class="card-footer bg-transparent d-flex align-items-end justify-content-end">
                                                <button class="btn btn-sm btn-outline-secondary view-students-btn"
                                                        data-class-id="<?php echo $class['id']; ?>"
                                                        data-class-name="<?php echo $class['gradeLevel']; ?> - <?php echo htmlspecialchars($class['section']); ?>">
                                                    View <i class="bi bi-chevron-right"></i>
                                                </button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo '<div class="col-12"><div class="alert alert-info" role="alert">No classes assigned to you yet for this school year.</div></div>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- ========== TABLE VIEW ========== -->
                    <div class="tab-pane fade" id="table-view" role="tabpanel">
                        <div class="mt-3">
                            <!-- Search and Filter -->
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" id="classSearch" class="form-control" placeholder="Search classes...">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select id="gradeFilter" class="form-select">
                                        <option value="">All Grades</option>
                                        <?php
                                        // Grade filter now respects the selected school year
                                        $gradeQuery = "SELECT DISTINCT class.gradeLevel 
                                                    FROM class 
                                                    WHERE class.faculty_id = {$_SESSION['user_id']}
                                                    AND class.school_year_id = $selected_syid
                                                    ORDER BY class.gradeLevel";
                                        $gradeResult = mysqli_query($conn, $gradeQuery);
                                        while ($grade = mysqli_fetch_assoc($gradeResult)) {
                                            echo '<option value="' . $grade['gradeLevel'] . '">' . $grade['gradeLevel'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-outline-secondary w-100" onclick="resetTableFilters()">
                                        <i class="bi bi-arrow-clockwise"></i> Reset
                                    </button>
                                </div>
                            </div>

                            <!-- Classes Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="classesTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Class Details</th>
                                            <th>Section</th>
                                            <th>Grade Level</th>
                                            <th>Total Students</th>
                                            <th>School Year</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Reset pointer for table loop
                                        mysqli_data_seek($query_run, 0);
                                        $counter = 1;
                                        if ($classes_count > 0) {
                                            while ($class = mysqli_fetch_assoc($query_run)) {
                                                // Count students with school year filter
                                                $student_count_query = "SELECT COUNT(DISTINCT class_students.student_id) as student_count
                                                                       FROM class_students
                                                                       WHERE class_students.class_id = {$class['id']}
                                                                       AND class_students.school_year_id = {$class['school_year_id']}";
                                                $student_count_result = mysqli_query($conn, $student_count_query);
                                                $student_count = mysqli_fetch_assoc($student_count_result)['student_count'];

                                                // Student preview (first 3 names) with school year filter
                                                $students_query = "SELECT 
                                                                    students.firstName,
                                                                    students.middleName,
                                                                    students.lastName
                                                                  FROM class_students
                                                                  JOIN students ON class_students.student_id = students.id
                                                                  WHERE class_students.class_id = {$class['id']}
                                                                  AND class_students.school_year_id = {$class['school_year_id']}
                                                                  ORDER BY students.lastName, students.firstName
                                                                  LIMIT 3";
                                                $students_result = mysqli_query($conn, $students_query);
                                                $students_list = [];
                                                while ($student = mysqli_fetch_assoc($students_result)) {
                                                    $middle = $student['middleName'] ? substr($student['middleName'], 0, 1) . '.' : '';
                                                    $students_list[] = $student['firstName'] . ' ' . $middle . ' ' . $student['lastName'];
                                                }
                                                $students_preview = implode(', ', $students_list);
                                                if (count($students_list) == 3) {
                                                    $students_preview .= '...';
                                                }

                                                // School year for this row
                                                $sy_display = '';
                                                if (!empty($class['class_start']) && !empty($class['class_end'])) {
                                                    $start_year = date('Y', strtotime($class['class_start']));
                                                    $end_year = date('Y', strtotime($class['class_end']));
                                                    $sy_display = $start_year . '-' . $end_year;
                                                }
                                                ?>
                                                <tr data-grade="<?php echo $class['gradeLevel']; ?>">
                                                    <td><?php echo $counter++; ?></td>
                                                    <td>
                                                        <strong><?php echo $class['gradeLevel']; ?> - <?php echo htmlspecialchars($class['section']); ?></strong>
                                                        <?php if (!empty($students_preview)): ?>
                                                            <div class="text-muted small mt-1">
                                                                <i class="bi bi-person"></i> 
                                                                <?php echo htmlspecialchars($students_preview); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($class['section']); ?></td>
                                                    <td><?php echo $class['gradeLevel']; ?></td>
                                                    <td class="text-center"><?php echo $student_count; ?></td>
                                                    <td>AY <?php echo $sy_display; ?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-outline-secondary view-class-students"
                                                                data-class-id="<?php echo $class['id']; ?>"
                                                                data-class-name="<?php echo $class['gradeLevel']; ?> - <?php echo htmlspecialchars($class['section']); ?>">
                                                            <i class="bi bi-folder"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-people display-4"></i>
                                                        <h5 class="mt-3">No classes assigned yet for this school year</h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== STUDENT MODAL (UNIFIED, WITH PDF EXPORT) ========== -->
        <div class="modal fade" id="studentsModal" tabindex="-1" aria-labelledby="studentsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="studentsModalLabel">Students in <span id="modalClassName" class="text-info"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Hidden field to store the current class ID for PDF export -->
                        <input type="hidden" id="currentClassId" value="">
                        <div class="table-responsive">
                            <table class="table table-hover" id="modalStudentsTable">
                                <thead>
                                    <tr>
                                        <th>SR Code</th>
                                        <th>LRN</th>
                                        <th>Name</th>                                       
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody id="modalStudentsBody">
                                    <!-- Students loaded via AJAX -->
                                    <tr><td colspan="6" class="text-center">Select a class to view students.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="exportPDF()">
                            <i class="bi bi-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>

<?php
    mysqli_close($conn);
} else {
    header("Location: ../faculty-portal.php");
    exit();
}
include('../assets/includes/footer.php');
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ----- DOM Elements -----
    const viewStudentsBtns = document.querySelectorAll('.view-students-btn');
    const classCards = document.querySelectorAll('.class-card');
    const viewClassStudentsBtns = document.querySelectorAll('.view-class-students');

    // Modal
    const studentsModal = new bootstrap.Modal(document.getElementById('studentsModal'));
    const modalClassName = document.getElementById('modalClassName');
    const modalStudentsBody = document.getElementById('modalStudentsBody');
    const currentClassId = document.getElementById('currentClassId');

    // Table search & filter
    const classSearch = document.getElementById('classSearch');
    const gradeFilter = document.getElementById('gradeFilter');

    // ----- Card View: Click on entire card -----
    classCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Ignore if the click is on the view button itself
            if (!e.target.closest('.view-students-btn')) {
                const classId = this.dataset.classId;
                const className = this.dataset.className;
                loadStudentsInModal(classId, className);
            }
        });
    });

    // ----- Card View: Click on the "View" button -----
    viewStudentsBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent card click event
            const classId = this.dataset.classId;
            const className = this.dataset.className;
            loadStudentsInModal(classId, className);
        });
    });

    // ----- Table View: "View" buttons -----
    viewClassStudentsBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const classId = this.dataset.classId;
            const className = this.dataset.className;
            loadStudentsInModal(classId, className);
        });
    });

    // ----- Load students into modal (AJAX) -----
    function loadStudentsInModal(classId, className) {
        modalClassName.textContent = className;
        currentClassId.value = classId; // Store for PDF export
        modalStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center"><div class="spinner-border text-primary" role="status"></div></td></tr>';

        studentsModal.show();

        fetch('get_students.php?class_id=' + classId)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                modalStudentsBody.innerHTML = '';
                if (data.success && data.students && data.students.length > 0) {
                    data.students.forEach(student => {
                        const middle = student.middleName ? student.middleName.charAt(0) + '.' : '';
                        const fullName = `${student.lastName}, ${student.firstName} ${middle} `.trim();
                        const row = `
                            <tr>
                                <td>${student.sr_code || 'N/A'}</td>
                                <td>${student.lrn || 'N/A'}</td>
                                <td>${fullName}</td>
                                <td>${student.gender || 'N/A'}</td>
                                <td>${student.email || 'N/A'}</td>
                                <td>${student.contactNumber || student.phone || 'N/A'}</td>
                            </tr>
                        `;
                        modalStudentsBody.innerHTML += row;
                    });
                } else {
                    modalStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No students found in this class</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                modalStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error loading students</td></tr>';
            });
    }

    // ----- Table View: Combined Search + Grade filter -----
    function applyTableFilters() {
        const searchTerm = classSearch ? classSearch.value.toLowerCase() : '';
        const grade = gradeFilter ? gradeFilter.value : '';
        const rows = document.querySelectorAll('#classesTable tbody tr');
        rows.forEach(row => {
            // Skip empty placeholder rows (no dataset.grade)
            const rowText = row.textContent.toLowerCase();
            const rowGrade = row.dataset ? (row.dataset.grade || '') : '';
            const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
            const matchesGrade = grade === '' || rowGrade === grade;
            row.style.display = (matchesSearch && matchesGrade) ? '' : 'none';
        });
    }

    if (classSearch) {
        classSearch.addEventListener('keyup', function() {
            applyTableFilters();
        });
    }

    if (gradeFilter) {
        gradeFilter.addEventListener('change', function() {
            applyTableFilters();
        });
    }

    // ----- Reset Table Filters (global function) -----
    window.resetTableFilters = function() {
        if (classSearch) classSearch.value = '';
        if (gradeFilter) gradeFilter.value = '';
        const rows = document.querySelectorAll('#classesTable tbody tr');
        rows.forEach(row => row.style.display = '');
    };
});

// ----- PDF Export (opens faculty_student_list.php) -----
window.exportPDF = function() {
    const classId = document.getElementById('currentClassId').value;
    if (!classId) {
        alert('No class selected.');
        return;
    }
    window.open('../reports/faculty_student_list.php?class_id=' + classId, '_blank');
};
</script>

<style>
/* Minimal styling – no colourful gender badges, no heavy animations */
.nav-tabs .nav-link {
    font-weight: 500;
    padding: 12px 20px;
}
.nav-tabs .nav-link.active {
    background-color: #fff;
    border-bottom-color: transparent;
}
.class-card {
    cursor: pointer;
    transition: box-shadow 0.2s;
    height: 100%;
}
.class-card:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}
.bg-info.bg-opacity-10 {
    background-color: rgba(13, 202, 240, 0.1) !important;
}
</style>