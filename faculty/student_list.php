<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
    include('../assets/includes/header.php');
    include('../assets/includes/navbar_faculty.php');
    require '../db_conn.php';

    // ========== ACADEMIC YEAR SELECTION ========== //
    // Get all academic years for dropdown
    $sy_options = [];
    $sy_query = "SELECT id, class_start, class_end FROM academic_calendar ORDER BY id DESC";
    $sy_result = mysqli_query($conn, $sy_query);
    while ($sy_row = mysqli_fetch_assoc($sy_result)) {
        $sy_options[$sy_row['id']] = date('Y', strtotime($sy_row['class_start'])) . '-' . date('Y', strtotime($sy_row['class_end']));
    }

    // Determine selected school year ID
    $selected_syid = isset($_GET['sy_id']) ? (int)$_GET['sy_id'] : 0;
    if ($selected_syid === 0 || !array_key_exists($selected_syid, $sy_options)) {
        // Default to the latest year
        $selected_syid = (int) mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(id) AS max_id FROM academic_calendar"))['max_id'];
    }
    // Optionally store in session for other pages
    $_SESSION['selected_school_year'] = $selected_syid;

    // Get label for the selected year
    $selected_sy_label = $sy_options[$selected_syid] ?? 'N/A';
    // ============================================== //

    // Prepare classes query – get all classes where faculty teaches (advisory + subject load) for selected year
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
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h5 class="mb-0">Classes for AY <?php echo $selected_sy_label; ?></h5>
                </div>
                <!-- Button to open filter modal -->
                <div>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="bi bi-funnel"></i> Filter Option
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Tab Navigation -->
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
                                mysqli_data_seek($query_run, 0); // reset pointer
                                while ($class = mysqli_fetch_assoc($query_run)) {
                                    // Count students in this class for the selected school year
                                    $student_count_query = "SELECT COUNT(DISTINCT class_students.student_id) as student_count
                                                           FROM class_students
                                                           WHERE class_students.class_id = {$class['id']}
                                                           AND class_students.school_year_id = {$class['school_year_id']}";
                                    $student_count_result = mysqli_query($conn, $student_count_query);
                                    $student_count = mysqli_fetch_assoc($student_count_result)['student_count'];
                                    ?>
                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                                        <div class="card class-card"
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
                            <!-- Search and Filter (kept as is) -->
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
                                                $sy_display = $sy_options[$class['school_year_id']] ?? '';
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

        <!-- ========== FILTER MODAL (Academic Year) ========== -->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">Select Academic Year</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="modalSySelect" class="form-label">Academic Year</label>
                            <select id="modalSySelect" class="form-select">
                                <?php foreach ($sy_options as $id => $label): ?>
                                    <option value="<?php echo $id; ?>" <?php echo $id == $selected_syid ? 'selected' : ''; ?>>
                                        <?php echo $label; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="applyYearFilter()">Apply</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== STUDENT MODAL (Gender Separated) ========== -->
        <div class="modal fade" id="studentsModal" tabindex="-1" aria-labelledby="studentsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="studentsModalLabel">Students in <span id="modalClassName" class="text-info"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Hidden field to store the current class ID and school year for PDF export -->
                        <input type="hidden" id="currentClassId" value="">
                        <input type="hidden" id="currentSchoolYearId" value="<?php echo $selected_syid; ?>">

                        <!-- Male Students Section -->
                        <h6 class="mt-2">Male</h6>
                        <div class="table-responsive">
                            <table class="table table-hover" id="maleStudentsTable">
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
                                <tbody id="maleStudentsBody">
                                    <tr><td colspan="6" class="text-center">Select a class to view male students.</td></tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Female Students Section -->
                        <h6 class="mt-4">Female</h6>
                        <div class="table-responsive">
                            <table class="table table-hover" id="femaleStudentsTable">
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
                                <tbody id="femaleStudentsBody">
                                    <tr><td colspan="6" class="text-center">Select a class to view female students.</td></tr>
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
    const maleStudentsBody = document.getElementById('maleStudentsBody');
    const femaleStudentsBody = document.getElementById('femaleStudentsBody');
    const currentClassId = document.getElementById('currentClassId');
    const currentSchoolYearId = document.getElementById('currentSchoolYearId').value;

    // Table search & filter
    const classSearch = document.getElementById('classSearch');
    const gradeFilter = document.getElementById('gradeFilter');

    // ----- Card View: Click on entire card -----
    classCards.forEach(card => {
        card.addEventListener('click', function(e) {
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
            e.stopPropagation();
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

    // ----- Load students into modal (AJAX) with school year and separate by gender -----
    function loadStudentsInModal(classId, className) {
        modalClassName.textContent = className;
        currentClassId.value = classId;

        // Clear previous content and show loading spinners
        maleStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center"><div class="spinner-border text-primary" role="status"></div></td></tr>';
        femaleStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center"><div class="spinner-border text-primary" role="status"></div></td></tr>';

        studentsModal.show();

        fetch('get_students.php?class_id=' + classId + '&school_year_id=' + currentSchoolYearId)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                maleStudentsBody.innerHTML = '';
                femaleStudentsBody.innerHTML = '';

                if (data.success && data.students && data.students.length > 0) {
                    const maleStudents = data.students.filter(s => s.gender && s.gender.toLowerCase() === 'male');
                    const femaleStudents = data.students.filter(s => s.gender && s.gender.toLowerCase() === 'female');

                    // Populate male table
                    if (maleStudents.length > 0) {
                        maleStudents.forEach(student => {
                            const middle = student.middleName ? student.middleName.charAt(0) + '.' : '';
                            const fullName = `${student.lastName}, ${student.firstName} ${middle}`.trim();
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
                            maleStudentsBody.innerHTML += row;
                        });
                    } else {
                        maleStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No male students found</td></tr>';
                    }

                    // Populate female table
                    if (femaleStudents.length > 0) {
                        femaleStudents.forEach(student => {
                            const middle = student.middleName ? student.middleName.charAt(0) + '.' : '';
                            const fullName = `${student.lastName}, ${student.firstName} ${middle}`.trim();
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
                            femaleStudentsBody.innerHTML += row;
                        });
                    } else {
                        femaleStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No female students found</td></tr>';
                    }
                } else {
                    maleStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No students found in this class</td></tr>';
                    femaleStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No students found in this class</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                maleStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error loading students</td></tr>';
                femaleStudentsBody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error loading students</td></tr>';
            });
    }

    // ----- Table View: Combined Search + Grade filter -----
    function applyTableFilters() {
        const searchTerm = classSearch ? classSearch.value.toLowerCase() : '';
        const grade = gradeFilter ? gradeFilter.value : '';
        const rows = document.querySelectorAll('#classesTable tbody tr');
        rows.forEach(row => {
            if (row.cells.length < 7) return; // skip empty placeholder
            const rowText = row.textContent.toLowerCase();
            const rowGrade = row.dataset.grade || '';
            const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
            const matchesGrade = grade === '' || rowGrade === grade;
            row.style.display = (matchesSearch && matchesGrade) ? '' : 'none';
        });
    }

    if (classSearch) {
        classSearch.addEventListener('keyup', applyTableFilters);
    }

    if (gradeFilter) {
        gradeFilter.addEventListener('change', applyTableFilters);
    }

    window.resetTableFilters = function() {
        if (classSearch) classSearch.value = '';
        if (gradeFilter) gradeFilter.value = '';
        const rows = document.querySelectorAll('#classesTable tbody tr');
        rows.forEach(row => row.style.display = '');
    };
});

// ----- Apply filter from modal and reload page -----
window.applyYearFilter = function() {
    const selectedSyId = document.getElementById('modalSySelect').value;
    if (selectedSyId) {
        window.location.href = window.location.pathname + '?sy_id=' + selectedSyId;
    }
};

// ----- PDF Export (pass class_id and school_year_id) -----
window.exportPDF = function() {
    const classId = document.getElementById('currentClassId').value;
    const schoolYearId = document.getElementById('currentSchoolYearId').value;
    if (!classId) {
        alert('No class selected.');
        return;
    }
    window.open('../reports/faculty_student_list.php?class_id=' + classId + '&school_year_id=' + schoolYearId, '_blank');
};
</script>

<style>
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
</style>