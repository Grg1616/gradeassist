<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
    include('../assets/includes/header.php');
    include('../assets/includes/navbar_faculty.php');
    require '../db_conn.php';
} else {
    header("Location: ../faculty-portal.php");
    exit();
}

// -----------------------------------------------
// Security & Permission Check
// -----------------------------------------------
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;
$school_year_id = isset($_GET['school_year_id']) ? intval($_GET['school_year_id']) : 0;

if (!$class_id || !$school_year_id) {
    die("<main id='main' class='main'><div class='pagetitle'><h1>Error</h1></div>
         <section class='section'><div class='alert alert-danger'>Invalid parameters.</div></section></main>");
}

$user_id = $_SESSION['id'];
$stmt = $conn->prepare("SELECT user_id FROM users WHERE id = ? AND userType = 'faculty'");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$faculty_id = null;
if ($row = $result->fetch_assoc()) {
    $faculty_id = $row['user_id'];
}
$stmt->close();

if (!$faculty_id) {
    die("<main id='main' class='main'><div class='pagetitle'><h1>Error</h1></div>
         <section class='section'><div class='alert alert-danger'>Faculty record not found.</div></section></main>");
}

// Verify that the class belongs to this faculty
$stmt = $conn->prepare("SELECT id FROM class WHERE id = ? AND faculty_id = ? AND school_year_id = ?");
$stmt->bind_param("iii", $class_id, $faculty_id, $school_year_id);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 0) {
    $stmt->close();
    die("<main id='main' class='main'><div class='pagetitle'><h1>Access Denied</h1></div>
         <section class='section'><div class='alert alert-danger'>You are not authorized to take attendance for this class.</div></section></main>");
}
$stmt->close();

// -----------------------------------------------
// Fetch Class Details
// -----------------------------------------------
$class_info = null;
$stmt = $conn->prepare("
    SELECT c.section, c.gradeLevel, 
           CONCAT(f.firstName, ' ', f.lastName) AS adviser
    FROM class c
    JOIN faculty f ON c.faculty_id = f.id
    WHERE c.id = ?
");
$stmt->bind_param("i", $class_id);
$stmt->execute();
$result = $stmt->get_result();
$class_info = $result->fetch_assoc();
$stmt->close();

// -----------------------------------------------
// Fetch Students Enrolled in this Class (with gender)
// -----------------------------------------------
$students = [];
$stmt = $conn->prepare("
    SELECT s.id, s.lrn, s.firstName, s.middleName, s.lastName, s.gender
    FROM class_students cs
    JOIN students s ON cs.student_id = s.id
    WHERE cs.class_id = ? AND cs.school_year_id = ?
    ORDER BY s.lastName, s.firstName
");
$stmt->bind_param("ii", $class_id, $school_year_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}
$stmt->close();

// Split students by gender
$male_students = [];
$female_students = [];
foreach ($students as $student) {
    if ($student['gender'] === 'Male') {
        $male_students[] = $student;
    } elseif ($student['gender'] === 'Female') {
        $female_students[] = $student;
    }
    // If you have other gender values, handle them here or ignore
}

// -----------------------------------------------
// Handle Form Submission
// -----------------------------------------------
$message = '';
$alert_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attendance_date'])) {
    $attendance_date = $_POST['attendance_date'];
    
    if (DateTime::createFromFormat('Y-m-d', $attendance_date) !== false) {
        $conn->begin_transaction();
        try {
            $success_count = 0;
            foreach ($_POST['status'] as $student_id => $status) {
                // sanitize inputs
                $student_id = intval($student_id);
                $status = trim($status);

                // check existing record
                $check_stmt = $conn->prepare("SELECT id FROM attendance_check WHERE student_id = ? AND date = ?");
                if (!$check_stmt) throw new Exception('Prepare failed: ' . $conn->error);
                $check_stmt->bind_param("is", $student_id, $attendance_date);
                if (!$check_stmt->execute()) throw new Exception('Execute failed: ' . $check_stmt->error);
                $check_stmt->store_result();

                if ($check_stmt->num_rows > 0) {
                    $check_stmt->bind_result($record_id);
                    $check_stmt->fetch();

                    $update_stmt = $conn->prepare("UPDATE attendance_check SET status = ?, teacher_id = ?, section_id = ? WHERE id = ?");
                    if (!$update_stmt) throw new Exception('Prepare failed: ' . $conn->error);
                    $update_stmt->bind_param("siii", $status, $faculty_id, $class_id, $record_id);
                    if (!$update_stmt->execute()) throw new Exception('Execute failed: ' . $update_stmt->error);
                    $update_stmt->close();
                } else {
                    $insert_stmt = $conn->prepare("INSERT INTO attendance_check (student_id, date, status, teacher_id, section_id) VALUES (?, ?, ?, ?, ?)");
                    if (!$insert_stmt) throw new Exception('Prepare failed: ' . $conn->error);
                    $insert_stmt->bind_param("issii", $student_id, $attendance_date, $status, $faculty_id, $class_id);
                    if (!$insert_stmt->execute()) throw new Exception('Execute failed: ' . $insert_stmt->error);
                    $insert_stmt->close();
                }

                $check_stmt->close();
                $success_count++;
            }
            $conn->commit();
            $message = "Attendance saved successfully for $attendance_date.";
            $alert_type = 'success';
        } catch (Exception $e) {
            $conn->rollback();
            $message = "Error saving attendance: " . $e->getMessage();
            $alert_type = 'danger';
        }
    } else {
        $message = "Invalid date format.";
        $alert_type = 'danger';
    }
}

// -----------------------------------------------
// Get current attendance status for selected date
// -----------------------------------------------
$selected_date = isset($_POST['attendance_date']) ? $_POST['attendance_date'] : date('Y-m-d');
$attendance_status = [];

$stmt = $conn->prepare("
    SELECT student_id, status 
    FROM attendance_check 
    WHERE section_id = ? AND date = ?
");
$stmt->bind_param("is", $class_id, $selected_date);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $attendance_status[$row['student_id']] = $row['status'];
}
$stmt->close();

// Default status for students without a record
foreach ($students as $student) {
    if (!isset($attendance_status[$student['id']])) {
        $attendance_status[$student['id']] = 'present';
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Take Attendance</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="faculty_dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="attendance.php">Attendance</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($class_info['gradeLevel'] . ' - ' . $class_info['section']) ?></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= htmlspecialchars($class_info['gradeLevel'] . ' - ' . $class_info['section']) ?>
                            <small class="text-muted">(Adviser: <?= htmlspecialchars($class_info['adviser']) ?>)</small>
                        </h5>

                        <?php if ($message): ?>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const iconMap = {
                                        'success': 'success',
                                        'danger': 'error',
                                        'warning': 'warning',
                                        'info': 'info'
                                    };
                                    const icon = iconMap[<?= json_encode($alert_type) ?>] || 'info';
                                    Swal.fire({
                                        icon: icon,
                                        title: icon === 'success' ? 'Saved' : (icon === 'error' ? 'Error' : ''),
                                        text: <?= json_encode($message) ?>,
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            </script>
                        <?php endif; ?>

                        <form method="POST" action="" id="attendanceForm">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label for="attendance_date" class="form-label fw-bold">Attendance Date</label>
                                    <input type="date" class="form-control" id="attendance_date" name="attendance_date" 
                                           value="<?= htmlspecialchars($selected_date) ?>" max="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>

                            <!-- Male Students Table -->
                            <div class="mt-4">
                                <h6 class="fw-bold">Males</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="15%">LRN</th>
                                                <th width="35%">Student Name</th>
                                                <th width="15%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($male_students)): ?>
                                                <tr><td colspan="4" class="text-center">No male students enrolled.</td></tr>
                                            <?php else: ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($male_students as $student): ?>
                                                    <?php 
                                                        $fullname = $student['lastName'] . ', ' . $student['firstName'];
                                                        if (!empty($student['middleName'])) {
                                                            $fullname .= ' ' . substr($student['middleName'], 0, 1) . '.';
                                                        }
                                                        $current_status = $attendance_status[$student['id']];
                                                    ?>
                                                    <tr>
                                                        <td><?= $counter++ ?></td>
                                                        <td><?= htmlspecialchars($student['lrn']) ?></td>
                                                        <td><?= htmlspecialchars($fullname) ?></td>
                                                        <td class="text-center">
                                                            <input type="hidden" 
                                                                   name="status[<?= $student['id'] ?>]" 
                                                                   id="status_<?= $student['id'] ?>" 
                                                                   value="<?= $current_status ?>">
                                                            <button type="button" 
                                                                class="btn btn-sm status-toggle
                                                                       <?= $current_status === 'present' ? 'btn-outline-success' : 
                                                                      ($current_status === 'absent' ? 'btn-outline-danger' : 'btn-outline-secondary') ?>"
                                                                data-student-id="<?= $student['id'] ?>"
                                                                data-status="<?= $current_status ?>" 
                                                                title="Current: <?= ucfirst($current_status) ?>. Click to change.">
                                                                <?= ucfirst($current_status) ?>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Female Students Table -->
                            <div class="mt-5">
                                <h6 class="fw-bold">Females</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="15%">LRN</th>
                                                <th width="35%">Student Name</th>
                                                <th width="15%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($female_students)): ?>
                                                <tr><td colspan="4" class="text-center">No female students enrolled.</td></tr>
                                            <?php else: ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($female_students as $student): ?>
                                                    <?php 
                                                        $fullname = $student['lastName'] . ', ' . $student['firstName'];
                                                        if (!empty($student['middleName'])) {
                                                            $fullname .= ' ' . substr($student['middleName'], 0, 1) . '.';
                                                        }
                                                        $current_status = $attendance_status[$student['id']];
                                                    ?>
                                                    <tr>
                                                        <td><?= $counter++ ?></td>
                                                        <td><?= htmlspecialchars($student['lrn']) ?></td>
                                                        <td><?= htmlspecialchars($fullname) ?></td>
                                                        <td class="text-center">
                                                            <input type="hidden" 
                                                                   name="status[<?= $student['id'] ?>]" 
                                                                   id="status_<?= $student['id'] ?>" 
                                                                   value="<?= $current_status ?>">
                                                            <button type="button" 
                                                                class="btn btn-sm status-toggle
                                                                       <?= $current_status === 'present' ? 'btn-outline-success' : 
                                                                      ($current_status === 'absent' ? 'btn-outline-danger' : 'btn-outline-secondary') ?>"
                                                                data-student-id="<?= $student['id'] ?>"
                                                                data-status="<?= $current_status ?>"
                                                                title="Current: <?= ucfirst($current_status) ?>. Click to change.">
                                                                <?= ucfirst($current_status) ?>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Save Button (displayed if at least one student is enrolled) -->
                            <?php if (!empty($students)): ?>
                                <div class="row mt-3">
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-success" name="save_attendance" value="1">
                                            <i class="bi bi-person-check-fill"></i> <small>Save Attendance</small>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
// Single‑button toggle for attendance status
document.addEventListener('DOMContentLoaded', function() {
    // Map of statuses and their next status
    const nextStatus = {
        'present': 'absent',
        'absent': 'excused',
        'excused': 'present'
    };

    // Map of status to button class and text (using outline variants)
    const statusConfig = {
        'present': { class: 'btn-outline-success', text: 'Present' },
        'absent': { class: 'btn-outline-danger', text: 'Absent' },
        'excused': { class: 'btn-outline-secondary', text: 'Excused' }
    };

    // Attach click handlers to all toggle buttons
    const toggleButtons = document.querySelectorAll('.status-toggle');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const studentId = this.dataset.studentId;
            const hiddenInput = document.getElementById('status_' + studentId);
            const currentStatus = hiddenInput.value;
            const newStatus = nextStatus[currentStatus];

            // Update hidden input
            hiddenInput.value = newStatus;

            // Update button data-status, class, text, and title
            this.dataset.status = newStatus;
            
            // Remove old outline/filled status classes and add new outline class
            this.classList.remove('btn-success', 'btn-danger', 'btn-warning', 'btn-secondary',
                                  'btn-outline-success', 'btn-outline-danger', 'btn-outline-secondary');
            this.classList.add(statusConfig[newStatus].class);
            
            // Set button text (first letter)
            this.textContent = statusConfig[newStatus].text;
            
            // Update title
            this.title = 'Current: ' + newStatus.charAt(0).toUpperCase() + newStatus.slice(1) + '. Click to change.';

            // Mark form as changed for unsaved warning
            window.formChanged = true;
        });
    });
});

// Unsaved changes warning
let formChanged = false;
document.getElementById('attendanceForm').addEventListener('change', function(e) {
    // Track any change in hidden inputs (status changes)
    if (e.target.type === 'hidden' && e.target.name.startsWith('status[')) {
        formChanged = true;
    }
});

window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
        return e.returnValue;
    }
});

// Reset formChanged after successful save
<?php if ($message && $alert_type == 'success'): ?>
    formChanged = false;
<?php endif; ?>
</script>

<?php
include('../assets/includes/footer.php');
$conn->close();
?>