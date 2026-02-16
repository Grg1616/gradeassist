<?php
session_start();
// Only faculty members (advisers) should access attendance
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && $_SESSION['userType'] === 'faculty') {
    include('../assets/includes/header.php');
    include('../assets/includes/navbar_faculty.php');
    require '../db_conn.php';
} else {
    header("Location: ../faculty-portal.php");
    exit();
}

// -----------------------------------------------
// Get current faculty ID from users table
// -----------------------------------------------
$user_id = $_SESSION['id']; // users.id
$stmt = $conn->prepare("SELECT user_id FROM users WHERE id = ? AND userType = 'faculty'");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$faculty_id = null;
if ($row = $result->fetch_assoc()) {
    $faculty_id = $row['user_id']; // this references faculty.id
}
$stmt->close();

if (!$faculty_id) {
    die("<main id='main' class='main'><div class='pagetitle'><h1>Error</h1></div>
         <section class='section'><div class='alert alert-danger'>Faculty record not found.</div></section></main>");
}

// -----------------------------------------------
// Determine current school year
// -----------------------------------------------
$current_sy_id = null;

// 1. Try to get from user's filter
$stmt = $conn->prepare("SELECT school_year FROM filter WHERE user_id = ? ORDER BY dateCreated DESC LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $current_sy_id = $row['school_year'];
}
$stmt->close();

// 2. If no filter, get latest academic calendar
if (!$current_sy_id) {
    $result = $conn->query("SELECT id FROM academic_calendar ORDER BY id DESC LIMIT 1");
    if ($row = $result->fetch_assoc()) {
        $current_sy_id = $row['id'];
    }
}

// -----------------------------------------------
// Fetch classes for this faculty & school year
// -----------------------------------------------
$classes = [];
if ($current_sy_id) {
    $stmt = $conn->prepare("
        SELECT c.id, c.section, c.gradeLevel, 
               CONCAT(f.firstName, ' ', f.lastName) AS faculty_name
        FROM class c
        JOIN faculty f ON c.faculty_id = f.id
        WHERE c.faculty_id = ? AND c.school_year_id = ?
        ORDER BY c.gradeLevel, c.section
    ");
    $stmt->bind_param("ii", $faculty_id, $current_sy_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row;
    }
    $stmt->close();
}

// Helper: get total students per class
function getTotalStudents($conn, $class_id) {
    $sql = "SELECT COUNT(student_id) AS total FROM class_students WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();
    return $row ? $row['total'] : 0;
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Attendance</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="faculty_dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Attendance</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Classes for Attendance</h5>

                        <?php if (!$current_sy_id): ?>
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle"></i> 
                                Unable to determine current school year. Please set a filter in your profile.
                            </div>
                        <?php elseif (empty($classes)): ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> 
                                No classes found for the current school year.
                            </div>
                        <?php else: ?>

                        <!-- ========== TABS ========== -->
                        <style>
                            .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
                                color: #0d6efd;
                                background-color: var(--bs-nav-tabs-link-active-bg);
                                border-color: var(--bs-nav-tabs-link-active-border-color);
                            }
                            .nav-link:not(.active) {
                                color: black;
                            }
                        </style>

                        <ul class="nav nav-tabs mt-3" id="attendanceTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="list-view-tab" data-bs-toggle="tab" data-bs-target="#list-view" type="button" role="tab" aria-controls="list-view" aria-selected="true">
                                    <i class="bi bi-list-ul"></i> List View
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="table-view-tab" data-bs-toggle="tab" data-bs-target="#table-view" type="button" role="tab" aria-controls="table-view" aria-selected="false">
                                    <i class="bi bi-table"></i> Table View
                                </button>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content mt-3" id="attendanceTabContent">
                            
                            <!-- ========== LIST VIEW ========== -->
                            <div class="tab-pane fade show active" id="list-view" role="tabpanel" aria-labelledby="list-view-tab">
                                <div class="row mt-2">
                                    <?php 
                                    $count = 0;
                                    foreach ($classes as $class): 
                                        $total_students = getTotalStudents($conn, $class['id']);
                                        if ($count % 4 == 0) echo '<div class="row mt-3">'; // start row
                                    ?>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="card shadow h-100">
                                            <div class="card-header text-white fw-bold bg-secondary" style="background-color: #EDEDED;">
                                                <h6 class="fw-bold text-start text-truncate mb-0">
                                                    <?= htmlspecialchars($class['gradeLevel']) ?>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mt-2">
                                                    <div class="col-lg-6 col">
                                                        <h6 class="small fw-bold text-start text-dark mb-0 mt-3 text-uppercase">
                                                            <?= htmlspecialchars($class['gradeLevel']) ?> - <?= htmlspecialchars($class['section']) ?>
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-6 col">
                                                        <h1 class="fw-bold text-end mb-0 text-danger">
                                                            <?= $total_students ?>
                                                        </h1>
                                                    </div>
                                                </div>
                                                <h6 class="small text-start mb-0 text-secondary">
                                                    <?= htmlspecialchars($class['faculty_name']) ?>
                                                </h6>
                                                <hr>
                                                <div class="row mt-3">
                                                    <div class="col-md-12 col">
                                                        <a href="attendance_list.php?class_id=<?= $class['id'] ?>&school_year_id=<?= $current_sy_id ?>" 
                                                           class="btn btn-outline-success float-end">
                                                           <i class="bi bi-check-circle"></i> Take Attendance
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $count++;
                                        if ($count % 4 == 0) echo '</div>'; // close row
                                    endforeach; 
                                    if ($count % 4 != 0) echo '</div>'; // close last row if not closed

                                    ?>
                                </div>
                            </div><!-- End List View -->

                            <!-- ========== TABLE VIEW ========== -->
                            <div class="tab-pane fade" id="table-view" role="tabpanel" aria-labelledby="table-view-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr style="white-space: nowrap;">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Grade Level</th>
                                                <th class="text-center">Section</th>
                                                <th>Adviser</th>
                                                <th class="text-center">Total Students</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $counter = 1;
                                            foreach ($classes as $class): 
                                                $total_students = getTotalStudents($conn, $class['id']);
                                            ?>
                                            <tr class="text small">
                                                <td class="text-center"><?= $counter++ ?></td>
                                                <td><?= htmlspecialchars($class['gradeLevel']) ?></td>
                                                <td><?= htmlspecialchars($class['section']) ?></td>
                                                <td><?= htmlspecialchars($class['faculty_name']) ?></td>
                                                <td class="text-center"><?= $total_students ?></td>
                                                <td class="text-center">
                                                    <a href="attendance_list.php?class_id=<?= $class['id'] ?>&school_year_id=<?= $current_sy_id ?>" 
                                                       class="btn btn-sm btn-success">
                                                       <i class="bi bi-check-circle"></i> Take Attendance
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- End Table View -->

                        </div><!-- End tab-content -->
                        <?php endif; ?>
                    </div><!-- End card-body -->
                </div><!-- End card -->
            </div><!-- End col -->
        </div><!-- End row -->
    </section>
</main><!-- End #main -->

<!-- Tab persistence script (same as in class.php) -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const listTab = document.getElementById('list-view-tab');
        const tableTab = document.getElementById('table-view-tab');

        [listTab, tableTab].forEach(tab => {
            tab.addEventListener('click', function() {
                localStorage.setItem('selectedAttendanceTab', tab.getAttribute('id'));
            });
        });

        const selectedTab = localStorage.getItem('selectedAttendanceTab');
        if (selectedTab) {
            const tab = document.getElementById(selectedTab);
            if (tab) tab.click();
        }
    });
</script>

<?php
include('../assets/includes/footer.php');
$conn->close();
?>