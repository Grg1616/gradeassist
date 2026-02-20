<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType']) && in_array($_SESSION['userType'], ['principal', 'chairperson', 'registrar', 'faculty'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_faculty.php');
require '../db_conn.php';

?>
<style>
.input {
    background-color: transparent; /* Removes background color */
    border-color: transparent; /* Removes border color */
    outline: none; /* Removes outline on focus */
}

.input:focus {
    border-color: transparent; /* Ensures border remains hidden even on focus */
}

/* Add these styles for exceeded values */
.input.exceeded {
    background-color: #ffebee !important;
    border: 1px solid #f44336 !important;
    color: #f44336 !important;
}

.cell-exceeded {
    background-color: #ffebee !important;
    border: 1px solid #f44336 !important;
}

.input:focus {
    background-color: #f0f8ff !important;
}
</style>
<style>
    /* Hide input fields by default */
    .editable, .custom-editable, .third-editable {
        display: none;
    }
</style>
<style>
.switchToggle input[type=checkbox] {
    height: 0;
    width: 0;
    visibility: hidden;
    position: absolute;
}

.switchToggle label {
    cursor: pointer;
    text-indent: -9999px;
    width: 50px;
    max-width: 50px;
    height: 30px;
    background: #6c757d;
    display: block;
    border-radius: 100px;
    position: relative;
}

.switchToggle label:after {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 26px;
    height: 26px;
    background: #fff;
    border-radius: 90px;
    transition: 0.3s;
}

.switchToggle input:checked + label,
.switchToggle input:checked + input + label {
    background: #0d6efd;
}

.switchToggle input:checked + label:after,
.switchToggle input:checked + input + label:after {
    left: calc(100% - 2px);
    transform: translateX(-100%);
}

.switchToggle label:active:after {
    width: 60px;
}

.toggle-label {
    text-align: center;
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

.toggle-label.active {
    color: #0d6efd;
    font-weight: bold;
}

.toggle-switchArea {
    margin: 10px 0 10px 0;
}

</style>
<style>
  /* Selected tab text color */
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #0d6efd;
    background-color: var(--bs-nav-tabs-link-active-bg);
    border-color: var(--bs-nav-tabs-link-active-border-color);
  }
  /* Non-selected tab text color */
  .nav-link:not(.active) {
    color: black;
  }
</style>

<script>
<?php
// Check if the session message exists and show it as a SweetAlert
if (isset($_SESSION['message'])) {
    echo "Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{$_SESSION['message']}',
            showConfirmButton: false,
            timer: 1000,
            customClass: {
                popup: 'my-sweetalert',
            }
        });";
    unset($_SESSION['message']); // Clear the session message after displaying it
}

if (isset($_SESSION['message_danger'])) {
    echo "Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{$_SESSION['message_danger']}',
            showConfirmButton: false,
            timer: 1000,
            customClass: {
                popup: 'my-sweetalert',
            }
        });";
    unset($_SESSION['message_danger']); // Clear the session message after displaying it
}
?>
</script>
  <main id="main" class="main">


<?php
$load_id = isset($_GET['load_id']) ? mysqli_real_escape_string($conn, $_GET['load_id']) : '';
// Retrieve faculty_id
$faculty_id = mysqli_real_escape_string($conn, $_SESSION['user_id']); // Get faculty_id from session
// Initialize submission flag; actual check runs after $quarter is determined
$is_submitted = false;
?>

<?php
// Escape the user_id to prevent SQL injection
$user_id = mysqli_real_escape_string($conn, $_SESSION['id']);

// Check if there's a value of school_year in the filter table for the given user_id
$check_query = "SELECT * FROM filter WHERE user_id = '$user_id'";

// Execute the query
$result = mysqli_query($conn, $check_query);

if ($result) {
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch the first row
        $row = mysqli_fetch_assoc($result);
        
        $class_id = isset($_GET['class_id']) ? mysqli_real_escape_string($conn, $_GET['class_id']) : '';
        $load_id = isset($_GET['load_id']) ? mysqli_real_escape_string($conn, $_GET['load_id']) : $load_id;
        $school_year = $row['school_year'];
        $sem_query = "SELECT semester FROM loads WHERE id = '$load_id' AND class_id = '$class_id' AND school_year_id  = '$school_year'";
            $sem_result = mysqli_query($conn, $sem_query);

            if ($sem_result && mysqli_num_rows($sem_result) > 0) {
                $sem_row = mysqli_fetch_assoc($sem_result);
                $semester = $sem_row['semester'];
            } else {
                // Default value if the query fails or no results
                $semester = 1;
            }
        $quarter = $row['quarter'];

    } else {
        $class_id = isset($_GET['class_id']) ? mysqli_real_escape_string($conn, $_GET['class_id']) : '';
        $load_id = isset($_GET['load_id']) ? mysqli_real_escape_string($conn, $_GET['load_id']) : '';
        $school_year = isset($_GET['school_year']) ? mysqli_real_escape_string($conn, $_GET['school_year']) : $school_year;
        $semester = 1;
        $quarter = 1;
    }
} else {
    // Handle query execution error
    echo "Error executing query: " . mysqli_error($conn);
}

// Free the result set
mysqli_free_result($result);

// Check if load_id and faculty_id with status 'submit' exist in the submit_grades table for this quarter
$submit_check_sql = "SELECT * FROM submit_grades WHERE load_id = '$load_id' AND faculty_id = '$faculty_id' AND status = 'submit' AND quarter = '$quarter'";
$submit_check_result = mysqli_query($conn, $submit_check_sql);
if ($submit_check_result && mysqli_num_rows($submit_check_result) > 0) {
    $is_submitted = true;
}
?>

<?php
// Prepare the SQL query
$query = "
    SELECT 
        gs.written,
        gs.performance,
        gs.assessment,
        gs.level
    FROM 
        grading_system gs
    JOIN 
        subjects s ON gs.subjectArea = s.subjectArea
    JOIN 
        loads l ON s.id = l.subject_id
    WHERE 
        l.id = '$load_id'
        AND (
            (s.gradeLevel IN ('Kinder', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6') AND gs.level = 'Elementary') OR
            (s.gradeLevel IN ('Grade 7', 'Grade 8', 'Grade 9', 'Grade 10') AND gs.level = 'High School') OR
            (s.gradeLevel IN ('Grade 11', 'Grade 12') AND gs.level = 'Senior High School')
        )
";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if there are rows returned
if (mysqli_num_rows($result) > 0) {
    // Initialize variables
    $written = "";
    $performance = "";
    $assessment = "";
    $level = "";

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $written = $row["written"];
        $performance = $row["performance"];
        $assessment = $row["assessment"];
        $level = $row["level"];
    }
} else {
    $written = "0";
    $performance = "0";
    $assessment = "0";
    $level = "0";
}
?>




    <div class="pagetitle">
      <h1>Class Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="faculty_dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="class.php">Classes</a></li>
          <li class="breadcrumb-item active">Class Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

        <!-- Filter Modal -->
        <div class="modal fade" id="filter" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="addFacultyLabel" style="font-weight: bold;">
                            <i class="bi bi-funnel"></i>&nbsp; Filter Option
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_class_details_filter.php" method="POST">
                            <?php
                            $query = "SELECT gradeLevel FROM class WHERE id = $class_id";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $gradeLevel = $row['gradeLevel'];
                            } else {
                                // Handle error - grade level not found
                                die("Error fetching grade level: " . mysqli_error($conn));
                            }

                            // Determine the options based on grade level and semester
                            if (($gradeLevel == 'Grade 11' || $gradeLevel == 'Grade 12') && $semester == 1) {
                                $options = array("1" => "First Quarter", "2" => "Second Quarter");
                            } elseif (($gradeLevel == 'Grade 11' || $gradeLevel == 'Grade 12') && $semester == 2) {
                                $options = array("3" => "Third Quarter", "4" => "Fourth Quarter");
                            } else {
                                // Show all quarters
                                $options = array(
                                    "1" => "First Quarter",
                                    "2" => "Second Quarter",
                                    "3" => "Third Quarter",
                                    "4" => "Fourth Quarter"
                                );
                            }
                            ?>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="quarter" name="quarter" aria-label="State" required>
                                    <option selected disabled value>Select Quarter</option>
                                    <?php
                                    foreach ($options as $key => $value) {
                                        echo "<option value=\"$key\">$value</option>";
                                    }
                                    ?>
                                </select>
                                <label for="quarter">Semester</label>
                                <div class="invalid-feedback">
                                    Please select a valid quarter.
                                </div>
                            </div>

                            <input type="hidden" id="filter_id" name="filter_id">
                            <input type="hidden" id="school_year" name="school_year">
                            <input type="hidden" id="semester" name="semester">
                            <input type="hidden" id="class_id" name="class_id">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                            <input type="hidden" id="load_id" name="load_id" value="<?php echo $load_id; ?>">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="class_details_filter" class="btn btn-success">Apply Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!--  Transmutation Table -->
        <div class="modal fade" id="add_student" tabindex="-1" aria-labelledby="addFacultyLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-table"></i>&nbsp; Transmutation Table
              </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                 <div class="form-floating mb-3">
                  <input type="number" class="form-control" id="searchInput">
                  <label for="searchInput">Enter a grade</label>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" style="width: 100%;" id="gradeTable">
                        <thead>
                            <tr class="text-center" style="white-space: nowrap;">
                                <th>Initial Grade</th>
                                <th>Transmuted Grade</th>
                            </tr>
                        <thead>
                        <tbody class="text-center">
                        <tr>
                          <td>100</td>
                          <td>100</td>
                        </tr>
                        <tr>
                          <td>98.40 - 99.99</td>
                          <td>99</td>
                        </tr>
                        <tr>
                          <td>96.80 - 98.39</td>
                          <td>98</td>
                        </tr>
                        <tr>
                          <td>95.20 - 96.79</td>
                          <td>97</td>
                        </tr>
                        <tr>
                          <td>93.60 - 95.19</td>
                          <td>96</td>
                        </tr>
                        <tr>
                          <td>92.00 - 93.59</td>
                          <td>95</td>
                        </tr>
                        <tr>
                          <td>90.40 - 91.99</td>
                          <td>94</td>
                        </tr>
                        <tr>
                          <td>88.80 - 90.39</td>
                          <td>93</td>
                        </tr>
                        <tr>
                          <td>87.20 - 88.79</td>
                          <td>92</td>
                        </tr>
                        <tr>
                          <td>85.60 - 87.19</td>
                          <td>91</td>
                        </tr>
                        <tr>
                          <td>84.00 - 85.59</td>
                          <td>90</td>
                        </tr>
                        <tr>
                          <td>82.40 - 83.99</td>
                          <td>89</td>
                        </tr>
                        <tr>
                          <td>80.80 - 82.39</td>
                          <td>88</td>
                        </tr>
                        <tr>
                          <td>79.20 - 80.79</td>
                          <td>87</td>
                        </tr>
                        <tr>
                          <td>77.60 - 79.19</td>
                          <td>86</td>
                        </tr>
                        <tr>
                          <td>76.00 - 77.59</td>
                          <td>85</td>
                        </tr>
                        <tr>
                          <td>74.40 - 75.99</td>
                          <td>84</td>
                        </tr>
                        <tr>
                          <td>72.80 - 74.39</td>
                          <td>83</td>
                        </tr>
                        <tr>
                          <td>71.20 - 72.79</td>
                          <td>82</td>
                        </tr>
                        <tr>
                          <td>69.60 - 71.19</td>
                          <td>81</td>
                        </tr>
                        <tr>
                          <td>68.00 - 69.59</td>
                          <td>80</td>
                        </tr>
                        <tr>
                          <td>66.40 - 67.99</td>
                          <td>79</td>
                        </tr>
                        <tr>
                          <td>64.80 - 66.39</td>
                          <td>78</td>
                        </tr>
                        <tr>
                          <td>63.20 - 64.79</td>
                          <td>77</td>
                        </tr>
                        <tr>
                          <td>61.60 - 63.19</td>
                          <td>76</td>
                        </tr>
                        <tr>
                          <td>60.00 - 61.59</td>
                          <td>75</td>
                        </tr>
                        <tr>
                          <td>56.00 - 59.99</td>
                          <td>74</td>
                        </tr>
                        <tr>
                          <td>52.00 - 55.99</td>
                          <td>73</td>
                        </tr>
                        <tr>
                          <td>48.00 - 51.99</td>
                          <td>72</td>
                        </tr>
                        <tr>
                          <td>44.00 - 47.99</td>
                          <td>71</td>
                        </tr>
                        <tr>
                          <td>40.00 - 43.99</td>
                          <td>70</td>
                        </tr>
                        <tr>
                          <td>36.00 - 39.99</td>
                          <td>69</td>
                        </tr>
                        <tr>
                          <td>32.00 - 35.99</td>
                          <td>68</td>
                        </tr>
                        <tr>
                          <td>28.00 - 31.99</td>
                          <td>67</td>
                        </tr>
                        <tr>
                          <td>24.00 - 27.99</td>
                          <td>66</td>
                        </tr>
                        <tr>
                          <td>20.00 - 23.99</td>
                          <td>65</td>
                        </tr>
                        <tr>
                          <td>16.00 - 19.99</td>
                          <td>64</td>
                        </tr>
                        <tr>
                          <td>12.00 - 15.99</td>
                          <td>63</td>
                        </tr>
                        <tr>
                          <td>8.00 - 11.99</td>
                          <td>62</td>
                        </tr>
                        <tr>
                          <td>4.00 - 7.99</td>
                          <td>61</td>
                        </tr>
                        <tr>
                          <td>0 - 3.99</td>
                          <td>60</td>
                        </tr>
                      </tbody>
                    </table>
                 </div>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script>
                $(document).ready(function(){
                    $("#searchInput").on("input", function() {
                        var searchValue = $(this).val().trim(); // Trim any whitespace
                        var rows = $("#gradeTable tbody tr");
                        if (searchValue === "") {
                            rows.show(); // Show all rows when search input is empty
                        } else {
                            rows.hide(); // Hide all rows
                            rows.each(function() {
                                var range = $(this).find("td:first").text().split(" - ");
                                var min = parseFloat(range[0]);
                                var max = parseFloat(range[1] || Infinity);
                                if (parseFloat(searchValue) >= min && parseFloat(searchValue) <= max && parseFloat(searchValue) <= 100) {
                                    $(this).show();
                                    return false;
                                }
                            });
                        }
                    });
                });
                </script>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <!--  <button type="submit" name="add_student" class="btn btn-success">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>

        <!-- Grading Scale -->
        <div class="modal fade" id="gradingScaleModal" tabindex="-1" aria-labelledby="gradingScaleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addFacultyLabel" style="font-weight: bold;">
                  <i class="bi bi-journal-check"></i>&nbsp; Grading Scale
              </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" style="width: 100%;" id="gradeTable">
                       <thead>
                        <tr class="text-center" style="white-space: nowrap;">
                          <th>Descriptors</th>
                          <th>Grading Scale</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Outstanding</td>
                          <td>90-100</td>
                          <td class="text-center">Passed</td>
                        </tr>
                        <tr>
                          <td>Very Satisfactory</td>
                          <td>85-89</td>
                          <td class="text-center">Passed</td>
                        </tr>
                        <tr>
                          <td>Satisfactory</td>
                          <td>80-84</td>
                          <td class="text-center">Passed</td>
                        </tr>
                        <tr>
                          <td>Fairly Satisfactory</td>
                           <td>75-79</td>
                          <td class="text-center">Passed</td>
                        </tr>
                        <tr>
                          <td>Did Not Meet Expectations</td>
                          <td>Below 75</td>
                          <td class="text-center">Passed</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

    <section class="section">

      <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">Class Details</h6>
            <div>
                <a data-bs-toggle="modal" data-bs-target="#add_student" class="m-0  btn btn-sm btn-outline-default shadow-sm text-primary me-3">
                    <span class="bi bi-table fa-sm me-1"></span> <!-- Added me-1 class for margin-right -->
                    Transmutation Table
                </a>
                <a data-bs-toggle="modal" data-bs-target="#gradingScaleModal" class=" m-0 btn btn-sm btn-outline-default shadow-sm text-primary">
                    <span class="bi bi-journal-check fa-sm me-1"></span> <!-- Added me-1 class for margin-right -->
                    Grading Scale
                </a>
            </div>
        </div>

        <div class="card-body">
          <div class="d-flex align-items-center w-100">
              <?php
                $quarter_names = [
                    1 => "Q1 / First Quarter",
                    2 => "Q2 / Second Quarter",
                    3 => "Q3 / Third Quarter",
                    4 => "Q4 / Fourth Quarter"
                ];

                // Defaulting $quarter to 1 if it's not defined or zero
                $quarter = isset($quarter) && $quarter > 0 ? $quarter : 1;

                $sql = "SELECT YEAR(class_start) AS start_year, YEAR(class_end) AS end_year FROM academic_calendar WHERE id = '$school_year'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $display_quarter = $quarter_names[$quarter];
                        echo "<h5 class=\"m-0 me-2 fw-semibold text-center\">" . $display_quarter . " AY " . $row["start_year"] . "-" . $row["end_year"] . "</h6>";
                    }
                } else {
                    echo "No results found";
                }
                ?>
              <button class="btn btn-sm btn-outline-default shadow-sm text-primary mx-1 edit-filter-btn ms-auto" 
                        data-bs-toggle="modal" 
                        data-bs-target="#filter" 
                         <?php
                        $query = "SELECT * FROM filter WHERE user_id = '{$_SESSION['id']}'";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) { // Fetch each row from the result set
                                ?>

                                    data-id="<?= $row['id']; ?>" 
                                    data-school-year="<?= $row['school_year']; ?>"
                                    data-semester="<?= $row['semester']; ?>"
                                    data-user-id="<?= $row['user_id']; ?>"
                                    data-quarter="<?= $row['quarter']; ?>"
                                    data-class-id="<?= $class_id; ?>"
                                <?php
                            }
                        } else {
                            // Handle case where no rows are returned
                            echo "No data found";
                        }
                        ?>
                        data-bs-tooltip="tooltip" 
                        data-placement="top" 
                        title="Filter Quarter">
                    <i class="bi bi-funnel"></i> Filter Option
                </button>
          </div>
          <?php
          $sql = "SELECT loads.*, subjects.courseCode, subjects.courseTitle,
                  faculty.rank as st_rank, faculty.firstName as st_firstName,
                  faculty.middleName as st_middleName, faculty.lastName as st_lastName,
                  class.section, class.gradeLevel,
                  faculty2.rank as a_rank, faculty2.firstName as a_firstName,
                  faculty2.middleName as a_middleName, faculty2.lastName a_lastName
           FROM loads
           LEFT JOIN subjects ON loads.subject_id = subjects.id
           LEFT JOIN faculty ON loads.faculty_id = faculty.id
           LEFT JOIN class ON loads.class_id = class.id
           LEFT JOIN faculty AS faculty2 ON class.faculty_id = faculty2.id
           WHERE loads.class_id = $class_id AND loads.school_year_id = $school_year AND loads.id = $load_id";

          $result = mysqli_query($conn, $sql);

          $row = mysqli_fetch_assoc($result);

          // Fetch class_student_count
          $class_student_count_query = "SELECT COUNT(student_id) AS total_students FROM class_students WHERE class_id = $class_id";
          $class_student_count_result = mysqli_query($conn, $class_student_count_query);
          $class_student_count_row = mysqli_fetch_assoc($class_student_count_result);
          $class_student_count = $class_student_count_row['total_students'];

          mysqli_free_result($result);
          mysqli_free_result($class_student_count_result);
          ?>
         <div class="card shadow mt-2 mb-3">
            <div class="card-body pb-0 pt-2 ps-3 pe-3">
              <div class="table-responsive">
                <table class="table table-borderless" style="width: 100%;">
                    <tbody>
                      <tr style="white-space: nowrap;">
                            <td class="fw-light py-0">Subject:</td>
                            <td class="fw-semibold py-0">
                                 <?php 
                                if(isset($row['courseCode']) && $row['courseCode'] != '') {
                                    if(isset($row['mapeh_name']) && $row['mapeh_name'] != '') {
                                        echo $row['courseCode'] . ' - ' . $row['mapeh_name'];
                                    } else {
                                        echo $row['courseCode'] . ' - ' . $row['courseTitle'];
                                    }
                                } else {
                                    echo isset($row['courseTitle']) ? $row['courseTitle'] : '-';
                                }
                                ?>
                            </td>
                            <td class="fw-light py-0">Subject Teacher:</td>
                            <td class="fw-semibold py-0">
                                <?php 
                                $middleInitial = substr($row['st_middleName'], 0, 1) . '.';
                                $subject_teacher_name = $row['st_rank'] . ' ' . $row['st_firstName'] . ' ' . $middleInitial . ' ' . $row['st_lastName'];
                                echo $subject_teacher_name;
                                ?>
                            </td>
                        </tr>

                        <tr style="white-space: nowrap;">
                            <td class="fw-light py-0">Grade/Section:</td>
                            <td class="fw-semibold py-0"><?= $row['gradeLevel'] ?: '-'; ?> - <?= $row['section'] ?: '-'; ?></td>
                            <td class="fw-light py-0">Adviser:</td>
                            <td class="fw-semibold py-0">
                                <?php 
                                $middleInitial = substr($row['a_middleName'], 0, 1) . '.';
                                $adviser_name = $row['a_rank'] . ' ' . $row['a_firstName'] . ' ' . $middleInitial . ' ' . $row['a_lastName'];
                                echo $adviser_name;
                                ?>
                            </td>
                        </tr>
                        <tr style="white-space: nowrap;">
                            <td class="fw-light py-0">Total Students:</td>
                            <td class="fw-semibold py-0"><?= isset($class_student_count) ? $class_student_count : '-'; ?></td>
                        </tr>
                    </tbody>
                </table>
              </div> 
            </div>
        </div>

<?php
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && isset($class_id) && !empty($class_id) && isset($school_year) && !empty($school_year)) {
    $session_id = $_SESSION['user_id'];
    $query = "SELECT * FROM class WHERE faculty_id = '$session_id' AND id = '$class_id' AND school_year_id = '$school_year'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        $attendance_enabled = true;
        $observed_values_enabled = true;
    } else {
        $attendance_enabled = false;
        $observed_values_enabled = false;
    }
} else {
    $attendance_enabled = false;
    $observed_values_enabled = false;
}
?>


<!-- Navigation tabs -->
<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
    <!-- Grades tab -->
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-grades-tab" data-bs-toggle="tab" data-bs-target="#pills-grades" type="button" role="tab" aria-controls="pills-grades" aria-selected="true">
            <span class="d-none d-sm-inline">Grades</span>
            <span class="d-sm-none">
                <i class="bi bi-journal-check"></i> 
            </span>
        </button>
    </li>
    <!-- Attendance tab -->
    <li class="nav-item" role="presentation">
      <span class="d-inline-block" tabindex="0" <?php echo $attendance_enabled ? '' : 'data-bs-toggle="tooltip" title="Attendance navigation only enabled for advisory class"'; ?>>
        <button class="nav-link" id="pills-attendance-tab" data-bs-toggle="tab" data-bs-target="#pills-attendance" type="button" role="tab" aria-controls="pills-attendance" aria-selected="false" <?php echo $attendance_enabled ? '' : 'disabled'; ?> >
            <span class="d-none d-sm-inline">Attendance</span>
            <span class="d-sm-none">
                <i class="bi bi-person-check"></i> 
            </span>
        </button>
      </span>
    </li>

    <!-- Learners Observed tab -->
    <li class="nav-item" role="presentation">
      <span class="d-inline-block" tabindex="0" <?php echo $observed_values_enabled ? '' : 'data-bs-toggle="tooltip" title="Observed values navigation only enabled for advisory class"'; ?>>
        <button class="nav-link" id="pills-observed-tab" data-bs-toggle="tab" data-bs-target="#pills-observed" type="button" role="tab" aria-controls="pills-observed" aria-selected="false" <?php echo $observed_values_enabled ? '' : 'disabled'; ?>>
            <span class="d-none d-sm-inline">Observed Values</span>
            <span class="d-sm-none">
                <i class="bi bi-eye"></i> 
            </span>
        </button>
      </span>
    </li>
</ul>


<!-- Tab for grade attendance and obervere values content -->
<div class="tab-content" id="myTabContent">
    <!-- Grades tab content -->
    <div class="tab-pane fade show active" id="pills-grades" role="tabpanel" aria-labelledby="pills-grades-tab">
        <!-- Content for Grades tab -->
   

    <!-- Grades tab -->
        <div class="card shadow">
            <div class="card-body px-0">
        
        <div class="d-flex justify-content-end">
            <nav class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="written-works-tab" data-bs-toggle="tab" data-bs-target="#written-works" type="button" role="tab" aria-controls="written-works" aria-selected="true">
                        <span class="d-none d-sm-inline">Written Works</span>
                        <span class="d-sm-none">
                            <i class="bi bi-file-text"></i> <!-- Bootstrap icon for written works -->
                        </span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="performance-task-tab" data-bs-toggle="tab" data-bs-target="#performance-task" type="button" role="tab" aria-controls="performance-task" aria-selected="false">
                        <span class="d-none d-sm-inline">Performance Task</span>
                        <span class="d-sm-none">
                            <i class="bi bi-speedometer2"></i> <!-- Bootstrap icon for performance task -->
                        </span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="quarterly-assessment-tab" data-bs-toggle="tab" data-bs-target="#quarterly-assessment" type="button" role="tab" aria-controls="quarterly-assessment" aria-selected="false">
                        <span class="d-none d-sm-inline">Quarterly Assessment</span>
                        <span class="d-sm-none">
                            <i class="bi bi-journal-text"></i> <!-- Bootstrap icon for quarterly assessment -->
                        </span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="view-class-record-tab" data-bs-toggle="tab" data-bs-target="#view-class-record" type="button" role="tab" aria-controls="view-class-record" aria-selected="false">
                        <span class="d-none d-sm-inline">View Class Record</span>
                        <span class="d-sm-none">
                            <i class="bi bi-journal"></i> <!-- Bootstrap icon for class record -->
                        </span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="quarterly-grade-tab" data-bs-toggle="tab" data-bs-target="#quarterly-grade" type="button" role="tab" aria-controls="quarterly-grade" aria-selected="false">
                        <span class="d-none d-sm-inline">Quarterly Grade</span>
                        <span class="d-sm-none">
                            <i class="bi bi-journal"></i> <!-- Bootstrap icon for class record -->
                        </span>
                    </button>
                </li>
            </nav>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="written-works" role="tabpanel" aria-labelledby="written-works-tab">
                <!-- Table for Written Works -->
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                        <thead>
                            <tr class="text-center small" style="white-space: nowrap;">
                                <th colspan="3"></th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <th style="width: 50px;"><?php echo $i; ?></th> 
                        <?php endfor; ?>
                        <td style="width: 50px;"></td> 
                        <th style="width: 50px;">Total</th> 
                        <th style="width: 50px;">PS</th> 
                        <th style="width: 50px;">WS</th> 
                                <!-- Add 13 more columns here -->
                            </tr>
                            <tr class="text-center small" style="white-space: nowrap;">
                                <td colspan="3" class="text-end fw-semibold">Highest Possible Score</td>
                                <style>
                                    .input {
                                    border: none; /* Removes the border */
                                }

                                </style>
                                <form action="crud_written.php" method="POST">
                                <?php
                                // Initialize variables
                                $wpstotal = 0;
                                $ww_id = null;

                                // Function to add to total
                                function addWWTotal(&$wpstotal, $value) {
                                    if (is_numeric($value)) {
                                        $wpstotal += (int)$value;
                                    }
                                }


                                // Query to retrieve written works
                                $query = "SELECT id, wps1, wps2, wps3, wps4, wps5, wps6, wps7, wps8, wps9, wps10 
                                          FROM written_works 
                                          WHERE load_id = '$load_id' 
                                          AND school_year_id = '$school_year' 
                                          AND quarter = '$quarter'";

                                $result = mysqli_query($conn, $query);

                                // Check for errors in query execution
                                if (!$result) {
                                    echo "Error: " . mysqli_error($conn);
                                } else {
                                    // Check if there are rows returned
                                    if (mysqli_num_rows($result) > 0) {
                                        // Fetch the first row
                                        $row = mysqli_fetch_assoc($result);
                                        $ww_id = $row['id']; // Store the id value
                                        // Output input fields for each wps column
                                        for ($i = 1; $i <= 10; $i++) {
                                            $value = isset($row['wps' . $i]) ? $row['wps' . $i] : '';
                                            addWWTotal($wpstotal, $value); // Add to total
                                            echo "<td><input class='input' type='text' name='written_work[]' value='$value' size='2' style='text-align: center;' onkeypress='return isNumberKey(event)' oninput='maxLengthCheck(this)' maxlength='2'></td>";
                                        }
                                    } else {
                                        // Output input fields with empty values
                                        for ($i = 1; $i <= 10; $i++) {
                                            echo "<td><input class='input' type='text' name='written_work[]' value='' size='2' style='text-align: center;' onkeypress='return isNumberKey(event)' oninput='maxLengthCheck(this)' maxlength='2'></td>";
                                        }
                                    }
                                }
                                ?>

                                <input type="hidden" id="load_id" name="load_id" value="<?= $load_id ?? '' ?>">
                                <input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?? '' ?>">
                                <input type="hidden" id="school_year" name="school_year" value="<?= $school_year ?? '' ?>">
                                <input type="hidden" id="quarter" name="quarter" value="<?= $quarter ?? '' ?>">
                                <td>
                                    <button type="submit" name="ww" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </td>
                                <td><?= $wpstotal ?: '0' ?></td>
                                </form>


                                <td>100.00</td>
                                <td><?php echo $written; ?>%</td>
                                <!-- Add 13 more columns here -->
                            </tr>
                        </thead>
                        <tbody>
                            <form action="crud_written.php" method="POST">
                                <tr class="text-center small" style="white-space: nowrap;">
                                    <td class="fw-semibold">#</td>
                                    <td class="text-start fw-semibold">Sr-Code</td>
                                    <td class="text-start fw-semibold">Student Name</td>
                                    <td colspan="13"></td>
                                </tr>
                                <?php
                                $no = 1;

                                                                $query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.gender, s.id as student_id
                                                                                    FROM students s 
                                                                                    JOIN class_students cs ON s.id = cs.student_id 
                                                                                    JOIN class c ON cs.class_id = c.id
                                                                                    JOIN loads l ON c.id = l.class_id 
                                                                                    WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
                                                                                    ORDER BY 
                                                                                        CASE WHEN TRIM(LOWER(s.gender)) IN ('male','m') THEN 0 
                                                                                                 WHEN TRIM(LOWER(s.gender)) IN ('female','f') THEN 1 
                                                                                                 ELSE 2 END, s.lastName";


                                $query_run = mysqli_query($conn, $query);

                                if ($query_run) {
                                    $currentGenderGroup = null;
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $student_id = $row['student_id'];
                                        $gender = isset($row['gender']) ? strtolower(trim($row['gender'])) : '';
                                        $genderGroup = (in_array($gender, ['male','m']) ? 'male' : (in_array($gender, ['female','f']) ? 'female' : 'other'));
                                        if ($genderGroup !== $currentGenderGroup) {
                                            // print group header row
                                            $label = ($genderGroup === 'male') ? 'Male' : (($genderGroup === 'female') ? 'Female' : 'Other / Unspecified');
                                            echo "<tr class=\"table  small text-start\"><td colspan=\"3\"><strong>" . htmlspecialchars($label) . "</strong></td></tr>";
                                            $currentGenderGroup = $genderGroup;
                                        }
                                ?>
                                        <tr class="text-center small" style="white-space: nowrap;">
                                            <td class=""><?php echo $no; ?></td>
                                            <td class="text-start"><?php echo $row['sr_code']; ?></td>
                                            <td class="text-start"><?php echo ucwords(strtolower($row['lastName'])) . ', ' . ucwords(strtolower($row['firstName'])) . ' ' . ucwords(substr($row['middleName'], 0, 1)) . '.'; ?>
                                            </td>
                                            <?php
                                            $query = "SELECT w1, w2, w3, w4, w5, w6, w7, w8, w9, w10, id FROM ww_score WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter' AND ww_id = '$ww_id'";
                                            $result = mysqli_query($conn, $query);

                                            if ($result) {
                                                $row_ww = mysqli_fetch_assoc($result);
                                                $w_score_total = 0;
                                                if ($row_ww) {
                                                    foreach ($row_ww as $key => $value) {
                                                        if (preg_match('/^w(\d+)$/', $key, $matches) && is_numeric($value)) {
                                                            $w_score_total += $value;
                                                        }
                                                    }
                                                }
                                                mysqli_free_result($result);
                                            } else {
                                                echo "Error executing query: " . mysqli_error($conn);
                                            }
                                            ?>

                                            <?php if ($result): ?>
                                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                                <?php
                                                // Check if the corresponding wps value is set
                                                $wps_column = 'wps'.$i;
                                                $query_wps = "SELECT $wps_column FROM written_works WHERE id = '$ww_id'";
                                                $result_wps = mysqli_query($conn, $query_wps);

                                                if ($result_wps && mysqli_num_rows($result_wps) > 0) {
                                                    $row_wps = mysqli_fetch_assoc($result_wps);
                                                    $wps_value = isset($row_wps[$wps_column]) ? $row_wps[$wps_column] : null;
                                                    mysqli_free_result($result_wps);
                                                } else {
                                                    // Handle query error or empty result set
                                                    $wps_value = null;
                                                }
                                                ?>

                                                <?php if (!empty($wps_value)): ?>
                                                    <td style="height: 30px;">
                                                        <span class="readonly" id="w<?php echo $i; ?>_<?php echo $student_id; ?>"><?php echo isset($row_ww['w'.$i]) ? $row_ww['w'.$i] : ''; ?></span>
                                                        <input class="editable input score-input" 
                                                               type="text" 
                                                               id="w<?php echo $i; ?>_input_<?php echo $student_id; ?>"
                                                               name="w<?php echo $i; ?>[<?php echo $student_id; ?>]" 
                                                               value="<?php echo isset($row_ww['w'.$i]) ? $row_ww['w'.$i] : ''; ?>" 
                                                               size="2" 
                                                               style="text-align: center;" 
                                                               onkeypress="return isNumberKey(event)" 
                                                               oninput="validateAndCalculate(this, <?php echo $wps_value; ?>, '<?php echo $student_id; ?>', 'written')"
                                                               data-hps="<?php echo $wps_value; ?>"
                                                               data-student-id="<?php echo $student_id; ?>"
                                                               data-type="written"
                                                               data-column="<?php echo $i; ?>"
                                                               data-total-columns="10"
                                                               onkeydown="navigateWithArrows(event, this)"
                                                               maxlength="3">
                                                    </td>
                                                <?php else: ?>
                                                    <td style="height: 30px;"></td>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            <?php endif; ?>

                                            <!-- <input type="hidden" id="id" name="ww_id" value="<?= isset($row_ww['id']) ? $row_ww['id'] : '' ?>"> -->
                                            <input type="hidden" id="load_id" name="load_id" value="<?= $load_id ?? '' ?>">
                                            <input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?? '' ?>">
                                            <input type="hidden" id="school_year" name="school_year" value="<?= $school_year ?? '' ?>">
                                            <input type="hidden" id="quarter" name="quarter" value="<?= $quarter ?? '' ?>">
                                            <input type="hidden" id="ww_id" name="ww_id" value="<?= $ww_id ?? '' ?>">
                                            <input type="hidden" id="student_id" name="student_id[]" value="<?= $student_id ?? '' ?>">

                                            <td></td>
                                            <?php if ($result): ?>
                                                <td id="ww_total_<?php echo $student_id; ?>"><?php echo $w_score_total; ?></td>
                                            <?php endif; ?>
                                            <?php 
                                                if ($wpstotal != 0 && $written != 0) {
                                                    $written_ps = number_format(($w_score_total / $wpstotal) * 100, 2);
                                                    $written_percentage = number_format($written / 100, 2);
                                                    $written_ws = number_format($written_ps * $written_percentage, 2);
                                                } else {
                                                    $written_ps = 0;
                                                    $written_ws = 0;
                                                }
                                            ?>
                                            <td id="ww_ps_<?php echo $student_id; ?>"><?php echo $written_ps; ?></td>
                                            <td id="ww_ws_<?php echo $student_id; ?>"><?php echo $written_ws; ?></td>

                                        </tr>
                                <?php
                                        $no++;
                                    }
                                } else {
                                    echo "<h5> No Record Found </h5>";
                                }
                                ?>
                            </tbody>
                        </table>
                     </div>
                <div class="row align-items-center ms-3 px-3 py-2">
                    <div class="col-auto">
                        <div class="toggle-wrapper">
                            <div class="switchToggle">
                                <input type="checkbox" id="flexSwitchCheckDefault">
                                <label for="flexSwitchCheckDefault"></label>
                            </div>
                            <div class="toggle-label" id="toggleLabel"></div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button id="saveChangesButton" type="submit" name="ww_score" class="btn btn-sm btn-success" style="padding: 5px 10px; display: none;" <?php if ($is_submitted) echo 'disabled'; ?>>
                            <i class="bi bi-save me-2"></i> Save Changes
                        </button>
                    </div>
                </div>
            </form>
                <!-- End Table for Written Works -->
            </div>

            <div class="tab-pane fade" id="performance-task" role="tabpanel" aria-labelledby="performance-task-tab">
                <!-- Table for Performance Task -->
                 <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                        <thead>
                            <tr class="text-center small" style="white-space: nowrap;">
                                <th colspan="3"></th>
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <th style="width: 50px;"><?php echo $i; ?></th> 
                                <?php endfor; ?>
                                <td style="width: 50px;"></td> 
                                <th style="width: 50px;">Total</th> 
                                <th style="width: 50px;">PS</th> 
                                <th style="width: 50px;">WS</th> 
                                <!-- Add 13 more columns here -->
                            </tr>
                            <tr class="text-center small" style="white-space: nowrap;">
                                <td colspan="3" class="text-end fw-semibold">Highest Possible Score</td>
                                <style>
                                    .input {
                                        border: none; /* Removes the border */
                                    }
                                </style>
                                <form action="crud_performance.php" method="POST">
                                <?php
                                $pps_total = 0; // Initialize $total for performance task
                                $pt_id = null;


                                // Cast and add $value to $total
                                function addPTTotal(&$pps_total, $value) {
                                    if (is_numeric($value)) {
                                        $pps_total += (int)$value;
                                    }
                                }

                                // Query to retrieve performance tasks
                                $query = "SELECT id, pps1, pps2, pps3, pps4, pps5, pps6, pps7, pps8, pps9, pps10 
                                          FROM performance_task 
                                          WHERE load_id = '$load_id' 
                                          AND school_year_id = '$school_year' 
                                          AND quarter = '$quarter'";

                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $pt_id = $row['id']; // Store the id value
                                        for ($i = 1; $i <= 10; $i++) {
                                            $value = isset($row['pps' . $i]) ? $row['pps' . $i] : 0;
                                            addPTTotal($pps_total, $value); // Add to total using the function
                                            echo "<td><input class='input' type='text' name='performance_task[]' value='" . (isset($row['pps' . $i]) ? $row['pps' . $i] : '') . "' size=2 style='text-align: center;' onkeypress='return isNumberKey(event)' oninput='maxLengthCheck(this)' maxlength='2'></td>";
                                        }
                                    } else {
                                        for ($i = 1; $i <= 10; $i++) {
                                            echo "<td><input class='input' type='text' name='performance_task[]' value='' size=2 style='text-align: center;' onkeypress='return isNumberKey(event)' oninput='maxLengthCheck(this)' maxlength='2'></td>";
                                        }
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($conn);
                                }
                                ?>

                                <input type="hidden" id="load_id" name="load_id" value="<?= $load_id ?? '' ?>">
                                <input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?? '' ?>">
                                <input type="hidden" id="school_year" name="school_year" value="<?= $school_year ?? '' ?>">
                                <input type="hidden" id="quarter" name="quarter" value="<?= $quarter ?? '' ?>">
                                <td>
                                    <button type="submit" name="pt" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                </td>
                                <td><?= $pps_total ?: '0' ?></td>
                                </form>

                                <td>100.00</td>
                                <td><?php echo $performance; ?>%</td>
                                <!-- Add 13 more columns here -->
                            </tr>
                        </thead>
                        <tbody>
                            <form action="crud_performance.php" method="POST">
                                <tr class="text-center small" style="white-space: nowrap;">
                                    <td class="fw-semibold">#</td>
                                    <td class="text-start fw-semibold">Sr-Code</td>
                                    <td class="text-start fw-semibold">Student Name</td>
                                    <td colspan="14"></td>
                                </tr>
                                <?php
                                $no = 1;

                                                                $query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.gender, s.id as student_id
                                                                                        FROM students s 
                                                                                        JOIN class_students cs ON s.id = cs.student_id 
                                                                                        JOIN class c ON cs.class_id = c.id
                                                                                        JOIN loads l ON c.id = l.class_id 
                                                                                        WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
                                                                                        ORDER BY 
                                                                                            CASE WHEN TRIM(LOWER(s.gender)) IN ('male','m') THEN 0 
                                                                                                     WHEN TRIM(LOWER(s.gender)) IN ('female','f') THEN 1 
                                                                                                     ELSE 2 END, s.lastName";

                                $query_run = mysqli_query($conn, $query);

                                if ($query_run) {
                                    $currentGenderGroup = null;
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $student_id = $row['student_id'];
                                        $gender = isset($row['gender']) ? strtolower(trim($row['gender'])) : '';
                                        $genderGroup = (in_array($gender, ['male','m']) ? 'male' : (in_array($gender, ['female','f']) ? 'female' : 'other'));
                                        if ($genderGroup !== $currentGenderGroup) {
                                            $label = ($genderGroup === 'male') ? 'Male' : (($genderGroup === 'female') ? 'Female' : 'Other / Unspecified');
                                            echo "<tr class=\"table small text-start\"><td colspan=\"3\"><strong>" . htmlspecialchars($label) . "</strong></td></tr>";
                                            $currentGenderGroup = $genderGroup;
                                        }
                                ?>
                                        <tr class="text-center small" style="white-space: nowrap;">
                                            <td class=""><?php echo $no; ?></td>
                                            <td class="text-start"><?php echo $row['sr_code']; ?></td>
                                            <td class="text-start"><?php echo ucwords(strtolower($row['lastName'])) . ', ' . ucwords(strtolower($row['firstName'])) . ' ' . ucwords(substr($row['middleName'], 0, 1)) . '.'; ?>
                                            </td>
                                            <?php
                                            $query = "SELECT pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8, pt9, pt10, id FROM pt_score WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter' AND pt_id = '$pt_id'";
                                            $result = mysqli_query($conn, $query);

                                            if ($result) {
                                                $row_pt = mysqli_fetch_assoc($result);
                                                $p_score_total = 0;
                                                if ($row_pt) {
                                                    foreach ($row_pt as $key => $value) {
                                                        if (preg_match('/^pt(\d+)$/', $key, $matches) && is_numeric($value)) {
                                                            $p_score_total += $value;
                                                        }
                                                    }
                                                }
                                                mysqli_free_result($result);
                                            } else {
                                                echo "Error executing query: " . mysqli_error($conn);
                                            }
                                            ?>

                                            <?php if ($result): ?>
                                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                                    <?php
                                                    $pps_column = 'pps'.$i;
                                                    $query_pps = "SELECT $pps_column FROM performance_task WHERE id = '$pt_id'";
                                                    $result_pps = mysqli_query($conn, $query_pps);

                                                    if ($result_pps && mysqli_num_rows($result_pps) > 0) {
                                                        $row_wps = mysqli_fetch_assoc($result_pps);
                                                        $pps_value = isset($row_wps[$pps_column]) ? $row_wps[$pps_column] : null;
                                                        mysqli_free_result($result_pps);
                                                    } else {
                                                        // Handle query error or empty result set
                                                        $pps_value = null;
                                                    }
                                                    ?>

                                                    <?php if (!empty($pps_value)): ?>
                                                        <td style="height: 30px;">
                                                            <span class="custom-readonly" id="pt<?php echo $i; ?>_<?php echo $student_id; ?>"><?php echo isset($row_pt['pt'.$i]) ? $row_pt['pt'.$i] : ''; ?></span>
                                                            <input class="custom-editable input score-input" 
                                                                   type="text" 
                                                                   id="pt<?php echo $i; ?>_input_<?php echo $student_id; ?>"
                                                                   name="pt<?php echo $i; ?>[<?php echo $student_id; ?>]" 
                                                                   value="<?php echo isset($row_pt['pt'.$i]) ? $row_pt['pt'.$i] : ''; ?>" 
                                                                   size="2" 
                                                                   style="text-align: center;" 
                                                                   onkeypress="return isNumberKey(event)" 
                                                                   oninput="validateAndCalculate(this, <?php echo $pps_value; ?>, '<?php echo $student_id; ?>', 'performance')"
                                                                   data-hps="<?php echo $pps_value; ?>"
                                                                   data-student-id="<?php echo $student_id; ?>"
                                                                   data-type="performance"
                                                                   data-column="<?php echo $i; ?>"
                                                                   data-total-columns="10"
                                                                   onkeydown="navigateWithArrows(event, this)"
                                                                   maxlength="3">
                                                        </td>
                                                    <?php else: ?>
                                                        <td style="height: 30px;"></td>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            <?php endif; ?>

                                            <!-- <input type="hidden" id="id" name="ww_id" value="<?= isset($row_pt['id']) ? $row_pt['id'] : '' ?>"> -->
                                            <input type="hidden" id="load_id" name="load_id" value="<?= $load_id ?? '' ?>">
                                            <input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?? '' ?>">
                                            <input type="hidden" id="school_year" name="school_year" value="<?= $school_year ?? '' ?>">
                                            <input type="hidden" id="quarter" name="quarter" value="<?= $quarter ?? '' ?>">
                                            <input type="hidden" id="pt_id" name="pt_id" value="<?= $pt_id ?? '' ?>">
                                            <input type="hidden" id="student_id" name="student_id[]" value="<?= $student_id ?? '' ?>">

                                            <td></td>
                                            <?php if ($result): ?>
                                                <td id="pt_total_<?php echo $student_id; ?>"><?php echo $p_score_total; ?></td>
                                            <?php endif; ?>
                                            <?php 
                                                if ($pps_total != 0 && $performance != 0) {
                                                    $performance_ps = number_format(($p_score_total / $pps_total) * 100, 2);
                                                    $performance_percentage = number_format($performance / 100, 2);
                                                    $performance_ws = number_format($performance_ps * $performance_percentage, 2);
                                                } else {
                                                    $performance_ps = 0;
                                                    $performance_ws = 0;
                                                }
                                            ?>
                                            <td id="pt_ps_<?php echo $student_id; ?>"><?php echo $performance_ps; ?></td>
                                            <td id="pt_ws_<?php echo $student_id; ?>"><?php echo $performance_ws; ?></td>

                                        </tr>
                                <?php
                                        $no++;
                                    }
                                } else {
                                    echo "<h5> No Record Found </h5>";
                                }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                    <div class="row align-items-center ms-3  px-3 py-2">
                            <div class="col-auto">
                                <div class="toggle-wrapper">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="customFlexSwitchCheckDefault">
                                        <label for="customFlexSwitchCheckDefault"></label>
                                    </div>
                                    <div class="toggle-label" id="customToggleLabel"></div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button id="customSaveChangesButton" type="submit" name="pt_score" class="btn btn-sm btn-success" style="padding: 5px 10px; display: none;" <?php if ($is_submitted) echo 'disabled'; ?>>
                                    <i class="custom-icon bi bi-save me-2"></i> Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                <!-- End for Table for Performance Task -->
            </div>

         <div class="tab-pane fade" id="quarterly-assessment" role="tabpanel" aria-labelledby="quarterly-assessment-tab">
    <!-- Table for Quarterly Assessment -->
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered" style="width: 100%;">
            <thead>
                <tr class="text-center small" style="white-space: nowrap;">
                    <th colspan="3"></th>
                    <th style="width: 50px;"></th> 
                    <td style="width: 50px;"></td> 
                    <th style="width: 50px;">Total</th> 
                    <th style="width: 50px;">PS</th> 
                    <th style="width: 50px;">WS</th> 
                </tr>
                <tr class="text-center small" style="white-space: nowrap;">
                    <td colspan="3" class="text-end fw-semibold">Highest Possible Score</td>
                    <form action="crud_quarterly.php" method="POST">
                    <?php
                    $qps_total = 0;
                    $qa_id = null;

                    function addQATotal(&$qps_total, $value) {
                        if (is_numeric($value)) {
                            $qps_total += (int)$value;
                        }
                    }

                    $query = "SELECT id, ps 
                              FROM quarterly_assessment 
                              WHERE load_id = '$load_id' 
                              AND school_year_id = '$school_year' 
                              AND quarter = '$quarter'";

                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $qa_id = $row['id'];
                            $value = isset($row['ps']) ? $row['ps'] : 0;
                            addQATotal($qps_total, $value);
                            echo "<td><input class='input' type='text' name='ps' value='" . (isset($row['ps']) ? $row['ps'] : '') . "' size=2 style='text-align: center;' onkeypress='return isNumberKey(event)' oninput='maxLengthCheck(this)' maxlength='2'></td>";
                        } else {
                            echo "<td><input class='input' type='text' name='ps' value='' size=2 style='text-align: center;' onkeypress='return isNumberKey(event)' oninput='maxLengthCheck(this)' maxlength='2'></td>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>

                    <style>
                        .input {
                            border: none;
                        }
                    </style>
                    <input type="hidden" id="load_id" name="load_id" value="<?= $load_id ?? '' ?>">
                    <input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?? '' ?>">
                    <input type="hidden" id="school_year" name="school_year" value="<?= $school_year ?? '' ?>">
                    <input type="hidden" id="quarter" name="quarter" value="<?= $quarter ?? '' ?>">
                    <td>
                        <button type="submit" name="qa" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                    </td>
                    <td><?= $qps_total ?: '0' ?></td>
                    </form>
                    <td>100.00</td>
                    <td><?php echo $assessment; ?>%</td>
                </tr>
            </thead>
            <tbody>
                <form action="crud_quarterly.php" method="POST">
                    <tr class="text-center small" style="white-space: nowrap;">
                        <td class="fw-semibold">#</td>
                        <td class="text-start fw-semibold">Sr-Code</td>
                        <td class="text-start fw-semibold">Student Name</td>
                        <td colspan="14"></td>
                    </tr>
                    <?php
                    $no = 1;
                                                                $query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.gender, s.id as student_id
                                                                                        FROM students s 
                                                                                        JOIN class_students cs ON s.id = cs.student_id 
                                                                                        JOIN class c ON cs.class_id = c.id
                                                                                        JOIN loads l ON c.id = l.class_id 
                                                                                        WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
                                                                                        ORDER BY 
                                                                                            CASE WHEN TRIM(LOWER(s.gender)) IN ('male','m') THEN 0 
                                                                                                     WHEN TRIM(LOWER(s.gender)) IN ('female','f') THEN 1 
                                                                                                     ELSE 2 END, s.lastName";

                    $query_run = mysqli_query($conn, $query);

                                if ($query_run) {
                                    $currentGenderGroup = null;
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $student_id = $row['student_id'];
                                        $gender = isset($row['gender']) ? strtolower(trim($row['gender'])) : '';
                                        $genderGroup = (in_array($gender, ['male','m']) ? 'male' : (in_array($gender, ['female','f']) ? 'female' : 'other'));
                                        if ($genderGroup !== $currentGenderGroup) {
                                            $label = ($genderGroup === 'male') ? 'Male' : (($genderGroup === 'female') ? 'Female' : 'Other / Unspecified');
                                            echo "<tr class=\"table small text-start\"><td colspan=\"3\"><strong>" . htmlspecialchars($label) . "</strong></td></tr>";
                                            $currentGenderGroup = $genderGroup;
                                        }
                    ?>
                            <tr class="text-center small" style="white-space: nowrap;">
                                <td class=""><?php echo $no; ?></td>
                                <td class="text-start"><?php echo $row['sr_code']; ?></td>
                                <td class="text-start"><?php echo ucwords(strtolower($row['lastName'])) . ', ' . ucwords(strtolower($row['firstName'])) . ' ' . ucwords(substr($row['middleName'], 0, 1)) . '.'; ?>
                                </td>
                                <?php
                                $query = "SELECT score, id FROM qa_score WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
                                $result = mysqli_query($conn, $query);

                                $score_value = '';
                                $qa_score_id = null;
                                if ($result) {
                                    $q_score_total = 0;
                                    while ($row_qa = mysqli_fetch_assoc($result)) {
                                        if (isset($row_qa['score']) && is_numeric($row_qa['score'])) {
                                            $q_score_total += $row_qa['score'];
                                            $score_value = $row_qa['score'];
                                            $qa_score_id = $row_qa['id'];
                                        }
                                    }
                                    mysqli_free_result($result);
                                } else {
                                    echo "Error executing query: " . mysqli_error($conn);
                                }
                                ?>

                                <?php 
                                if ($result) {
                                    $qa_column = 'ps';
                                    $query_qa = "SELECT $qa_column FROM quarterly_assessment WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
                                    $result_qa = mysqli_query($conn, $query_qa);
                                    
                                    if ($result_qa) {
                                        $row_qqa = mysqli_fetch_assoc($result_qa);
                                        
                                        if ($row_qqa) {
                                            $qa_value = $row_qqa[$qa_column];
                                            
                                            if (!empty($qa_value)) { ?>
                                                <td>
                                                    <span class="third-readonly" id="score_<?php echo $student_id; ?>"><?php echo $score_value; ?></span>
                                                    <input class="third-editable input score-input" 
                                                           type="text" 
                                                           id="qa_input_<?php echo $student_id; ?>"
                                                           name="score[<?php echo $student_id; ?>]" 
                                                           value="<?php echo $score_value; ?>" 
                                                           size="2" 
                                                           style="text-align: center;" 
                                                           onkeypress="return isNumberKey(event)" 
                                                           oninput="validateAndUpdateQuarterly(this, <?php echo $qa_value; ?>, '<?php echo $student_id; ?>')"
                                                           data-hps="<?php echo $qa_value; ?>"
                                                           data-student-id="<?php echo $student_id; ?>"
                                                           data-type="quarterly"
                                                           data-column="1"
                                                           data-total-columns="1"
                                                           onkeydown="navigateWithArrows(event, this)"
                                                           maxlength="3">
                                                </td>
                                            <?php } else { ?>
                                                <td style="height: 30px;"></td>
                                            <?php }
                                        }
                                        mysqli_free_result($result_qa);
                                    }
                                } 
                                ?>

                                <input type="hidden" id="load_id" name="load_id" value="<?= $load_id ?? '' ?>">
                                <input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?? '' ?>">
                                <input type="hidden" id="school_year" name="school_year" value="<?= $school_year ?? '' ?>">
                                <input type="hidden" id="quarter" name="quarter" value="<?= $quarter ?? '' ?>">
                                <?php if($qa_score_id): ?>
                                <input type="hidden" id="qa_score_id" name="qa_score_id[<?php echo $student_id; ?>]" value="<?php echo $qa_score_id; ?>">
                                <?php endif; ?>
                                <input type="hidden" id="qa_id" name="qa_id" value="<?= $qa_id ?? '' ?>">
                                <input type="hidden" id="student_id" name="student_id[]" value="<?= $student_id ?? '' ?>">

                                <td></td>
                                <?php if ($result): ?>
                                    <td id="qa_total_<?php echo $student_id; ?>"><?php echo $q_score_total; ?></td>
                                <?php endif; ?>
                                <?php 
                                    if ($qps_total != 0 && $assessment != 0) {
                                        $assessment_ps = number_format(($q_score_total / $qps_total) * 100, 2);
                                        $assessment_percentage = number_format($assessment / 100, 2);
                                        $assessment_ws = number_format($assessment_ps * $assessment_percentage, 2);
                                    } else {
                                        $assessment_ps = 0;
                                        $assessment_ws = 0;
                                    }
                                ?>   
                                <td id="qa_ps_<?php echo $student_id; ?>"><?php echo $assessment_ps; ?></td>
                                <td id="qa_ws_<?php echo $student_id; ?>"><?php echo $assessment_ws; ?></td>
                            </tr>
                    <?php
                            $no++;
                        }
                    } else {
                        echo "<h5> No Record Found </h5>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="row align-items-center ms-3  px-3 py-2">
                <div class="col-auto">
                    <div class="toggle-wrapper">
                        <div class="switchToggle">
                            <input type="checkbox" id="thirdFlexSwitchCheckDefault">
                            <label for="thirdFlexSwitchCheckDefault"></label>
                        </div>
                        <div class="toggle-label" id="thirdToggleLabel"></div>
                    </div>
                </div>
                <div class="col-auto">
                    <button id="thirdSaveChangesButton" type="submit" name="qa_score" class="btn btn-sm btn-success" style="padding: 5px 10px; display: none;" <?php if ($is_submitted) echo 'disabled'; ?>>
                        <i class="custom-icon bi bi-save me-2"></i> Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>

  <div class="tab-pane fade" id="view-class-record" role="tabpanel" aria-labelledby="view-class-record-tab">
    <!-- Start for Table for class record -->
    <form action="crud_subject_grade.php" method="POST" id="subjectGradeForm">
        <div class="table-responsive">
            <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                <thead>
                    <tr class="text-center small" style="white-space: nowrap;">
                        <th colspan="3"></th>
                        <th colspan="13" class="h6 bg-primary text-white">Written Works</th>
                        <th colspan="13" class="h6 bg-success text-white">Performance Task</th>
                        <th colspan="3" class="h6 bg-danger text-white">Quarterly Assessment</th>
                        <th style="width: 100px; min-width: 100px;" rowspan="3" class="h6 align-middle text-center fw-semibold">Initial<br>Grade</th>
                        <th style="width: 100px; min-width: 100px;" rowspan="3" class="h6 align-middle text-center fw-semibold">Quarterly<br>Grade</th>
                    </tr>

                    <tr class="text-center small" style="white-space: nowrap;">
                        <th colspan="3"></th>
                        <td style="width: 40px; min-width: 40px;">1</td>
                        <th style="width: 40px; min-width: 40px;">2</th>
                        <th style="width: 40px; min-width: 40px;">3</th>
                        <th style="width: 40px; min-width: 40px;">4</th>
                        <th style="width: 40px; min-width: 40px;">5</th>
                        <th style="width: 40px; min-width: 40px;">6</th>
                        <th style="width: 40px; min-width: 40px;">7</th>
                        <th style="width: 40px; min-width: 40px;">8</th>
                        <th style="width: 40px; min-width: 40px;">9</th>
                        <th style="width: 40px; min-width: 40px;">10</th>
                        <th style="width: 40px; min-width: 40px;">Total</th>
                        <th style="width: 40px; min-width: 40px;">PS</th>
                        <th style="width: 40px; min-width: 40px;">WS</th>

                        <th style="width: 40px; min-width: 40px;">1</th>
                        <th style="width: 40px; min-width: 40px;">2</th>
                        <th style="width: 40px; min-width: 40px;">3</th>
                        <th style="width: 40px; min-width: 40px;">4</th>
                        <th style="width: 40px; min-width: 40px;">5</th>
                        <th style="width: 40px; min-width: 40px;">6</th>
                        <th style="width: 40px; min-width: 40px;">7</th>
                        <th style="width: 40px; min-width: 40px;">8</th>
                        <th style="width: 40px; min-width: 40px;">9</th>
                        <th style="width: 40px; min-width: 40px;">10</th>
                        <th style="width: 40px; min-width: 40px;">Total</th>
                        <th style="width: 40px; min-width: 40px;">PS</th>
                        <th style="width: 40px; min-width: 40px;">WS</th>

                        <th style="width: 40px; min-width: 40px;"></th>
                        <th style="width: 40px; min-width: 40px;">PS</th>
                        <th style="width: 40px; min-width: 40px;">WS</th>
                    </tr>
                    <tr class="text-center small" style="white-space: nowrap;">
                        <td colspan="3" class="text-end fw-semibold">Highest Possible Score</td>
                        <?php
                        // Get written works HPS
                        $ww_query = "SELECT * FROM written_works WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
                        $ww_result = mysqli_query($conn, $ww_query);
                        $ww_row = mysqli_fetch_assoc($ww_result);
                        $total_wps = 0;
                        
                        if ($ww_row) {
                            for ($i = 1; $i <= 10; $i++) {
                                $wps_value = isset($ww_row['wps' . $i]) ? $ww_row['wps' . $i] : '';
                                $total_wps += (int)$wps_value;
                                echo "<td>$wps_value</td>";
                            }
                        } else {
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<td></td>";
                            }
                        }
                        ?>
                        <td><?= $total_wps; ?></td>
                        <td>100.00</td>
                        <td><?php echo $written; ?>%</td>

                        <?php
                        // Get performance task HPS
                        $pt_query = "SELECT * FROM performance_task WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
                        $pt_result = mysqli_query($conn, $pt_query);
                        $pt_row = mysqli_fetch_assoc($pt_result);
                        $total_pps = 0;
                        
                        if ($pt_row) {
                            for ($i = 1; $i <= 10; $i++) {
                                $pps_value = isset($pt_row['pps' . $i]) ? $pt_row['pps' . $i] : '';
                                $total_pps += (int)$pps_value;
                                echo "<td>$pps_value</td>";
                            }
                        } else {
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<td></td>";
                            }
                        }
                        ?>
                        <td><?= $total_pps; ?></td>
                        <td>100.00</td>
                        <td><?php echo $performance; ?>%</td>

                        <?php
                        // Get quarterly assessment HPS
                        $qa_query = "SELECT * FROM quarterly_assessment WHERE load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter'";
                        $qa_result = mysqli_query($conn, $qa_query);
                        $qa_row = mysqli_fetch_assoc($qa_result);
                        $total_ps = isset($qa_row['ps']) ? $qa_row['ps'] : 0;
                        ?>
                        <td><?= $total_ps; ?></td>
                        <td>100.00</td>
                        <td><?php echo $assessment; ?>%</td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center small" style="white-space: nowrap;">
                        <td class="fw-semibold">#</td>
                        <td class="text-start fw-semibold">Sr-Code</td>
                        <td class="text-start fw-semibold">Student Name</td>
                        <td colspan="13"></td>
                        <td colspan="13"></td>
                        <td colspan="3"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    $no = 1;
                    
                    // First, get all students in the class
                                        $students_query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.gender, s.id as student_id
                                                                            FROM students s 
                                                                            JOIN class_students cs ON s.id = cs.student_id 
                                                                            WHERE cs.class_id = '$class_id' AND cs.school_year_id = '$school_year'
                                                                            ORDER BY 
                                                                                CASE WHEN TRIM(LOWER(s.gender)) IN ('male','m') THEN 0 
                                                                                         WHEN TRIM(LOWER(s.gender)) IN ('female','f') THEN 1 
                                                                                         ELSE 2 END, s.lastName";
                    
                    $students_result = mysqli_query($conn, $students_query);
                    
                    if ($students_result && mysqli_num_rows($students_result) > 0) {
                        $currentGenderGroup = null;
                        while ($student_row = mysqli_fetch_assoc($students_result)) {
                            $student_id = $student_row['student_id'];
                            $gender = isset($student_row['gender']) ? strtolower(trim($student_row['gender'])) : '';
                            $genderGroup = (in_array($gender, ['male','m']) ? 'male' : (in_array($gender, ['female','f']) ? 'female' : 'other'));
                            if ($genderGroup !== $currentGenderGroup) {
                                $label = ($genderGroup === 'male') ? 'Male' : (($genderGroup === 'female') ? 'Female' : 'Other / Unspecified');
                                echo "<tr class=\"table small text-start\"><td colspan=\"3\"><strong>" . htmlspecialchars($label) . "</strong></td></tr>";
                                $currentGenderGroup = $genderGroup;
                            }
                            
                            // Get written works scores for this student
                            $ww_scores = array_fill(1, 10, '');
                            $wtotal = 0;
                            $ww_id = isset($ww_row['id']) ? $ww_row['id'] : null;
                            
                            if ($ww_id) {
                                $ww_score_query = "SELECT w1, w2, w3, w4, w5, w6, w7, w8, w9, w10 
                                                 FROM ww_score 
                                                 WHERE student_id = '$student_id' 
                                                 AND load_id = '$load_id' 
                                                 AND school_year_id = '$school_year' 
                                                 AND quarter = '$quarter' 
                                                 AND ww_id = '$ww_id'";
                                $ww_score_result = mysqli_query($conn, $ww_score_query);
                                
                                if ($ww_score_result && mysqli_num_rows($ww_score_result) > 0) {
                                    $ww_score_row = mysqli_fetch_assoc($ww_score_result);
                                    for ($i = 1; $i <= 10; $i++) {
                                        $score = isset($ww_score_row['w' . $i]) ? $ww_score_row['w' . $i] : '';
                                        $ww_scores[$i] = $score;
                                        if (is_numeric($score)) {
                                            $wtotal += $score;
                                        }
                                    }
                                }
                            }
                            
                            // Get performance task scores for this student
                            $pt_scores = array_fill(1, 10, '');
                            $pttotal = 0;
                            $pt_id = isset($pt_row['id']) ? $pt_row['id'] : null;
                            
                            if ($pt_id) {
                                $pt_score_query = "SELECT pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8, pt9, pt10 
                                                 FROM pt_score 
                                                 WHERE student_id = '$student_id' 
                                                 AND load_id = '$load_id' 
                                                 AND school_year_id = '$school_year' 
                                                 AND quarter = '$quarter' 
                                                 AND pt_id = '$pt_id'";
                                $pt_score_result = mysqli_query($conn, $pt_score_query);
                                
                                if ($pt_score_result && mysqli_num_rows($pt_score_result) > 0) {
                                    $pt_score_row = mysqli_fetch_assoc($pt_score_result);
                                    for ($i = 1; $i <= 10; $i++) {
                                        $score = isset($pt_score_row['pt' . $i]) ? $pt_score_row['pt' . $i] : '';
                                        $pt_scores[$i] = $score;
                                        if (is_numeric($score)) {
                                            $pttotal += $score;
                                        }
                                    }
                                }
                            }
                            
                            // Get quarterly assessment score for this student
                            $qa_score = '';
                            $qa_id = isset($qa_row['id']) ? $qa_row['id'] : null;
                            $q_score_total = 0;
                            
                            if ($qa_id) {
                                $qa_score_query = "SELECT score 
                                                 FROM qa_score 
                                                 WHERE student_id = '$student_id' 
                                                 AND load_id = '$load_id' 
                                                 AND school_year_id = '$school_year' 
                                                 AND quarter = '$quarter' 
                                                 AND qa_id = '$qa_id'";
                                $qa_score_result = mysqli_query($conn, $qa_score_query);
                                
                                if ($qa_score_result && mysqli_num_rows($qa_score_result) > 0) {
                                    $qa_score_row = mysqli_fetch_assoc($qa_score_result);
                                    $qa_score = isset($qa_score_row['score']) ? $qa_score_row['score'] : '';
                                    $q_score_total = is_numeric($qa_score) ? $qa_score : 0;
                                }
                            }
                            
                            // Calculate PS and WS for Written Works
                            $written_ps = 0;
                            $written_ws = 0;
                            if ($total_wps > 0 && $written > 0) {
                                $written_ps = number_format(($wtotal / $total_wps) * 100, 2);
                                $written_percentage = number_format($written / 100, 2);
                                $written_ws = number_format($written_ps * $written_percentage, 2);
                            }
                            
                            // Calculate PS and WS for Performance Task
                            $performance_ps = 0;
                            $performance_ws = 0;
                            if ($total_pps > 0 && $performance > 0) {
                                $performance_ps = number_format(($pttotal / $total_pps) * 100, 2);
                                $performance_percentage = number_format($performance / 100, 2);
                                $performance_ws = number_format($performance_ps * $performance_percentage, 2);
                            }
                            
                            // Calculate PS and WS for Quarterly Assessment
                            $assessment_ps = 0;
                            $assessment_ws = 0;
                            if ($total_ps > 0 && $assessment > 0) {
                                $assessment_ps = number_format(($q_score_total / $total_ps) * 100, 2);
                                $assessment_percentage = number_format($assessment / 100, 2);
                                $assessment_ws = number_format($assessment_ps * $assessment_percentage, 2);
                            }
                            
                            // Calculate Initial Grade and Transmuted Grade
                            $initial_grade = $written_ws + $performance_ws + $assessment_ws;
                            $formatted_initial_grade = number_format($initial_grade, 2);
                            
                            // Calculate transmuted grade
                            $transmuted_grade = 60; // Default
                            if ($formatted_initial_grade >= 100) {
                                $transmuted_grade = 100;
                            } elseif ($formatted_initial_grade >= 98.40) {
                                $transmuted_grade = 99;
                            } elseif ($formatted_initial_grade >= 96.80) {
                                $transmuted_grade = 98;
                            } elseif ($formatted_initial_grade >= 95.20) {
                                $transmuted_grade = 97;
                            } elseif ($formatted_initial_grade >= 93.60) {
                                $transmuted_grade = 96;
                            } elseif ($formatted_initial_grade >= 92.00) {
                                $transmuted_grade = 95;
                            } elseif ($formatted_initial_grade >= 90.40) {
                                $transmuted_grade = 94;
                            } elseif ($formatted_initial_grade >= 88.80) {
                                $transmuted_grade = 93;
                            } elseif ($formatted_initial_grade >= 87.20) {
                                $transmuted_grade = 92;
                            } elseif ($formatted_initial_grade >= 85.60) {
                                $transmuted_grade = 91;
                            } elseif ($formatted_initial_grade >= 84.00) {
                                $transmuted_grade = 90;
                            } elseif ($formatted_initial_grade >= 82.40) {
                                $transmuted_grade = 89;
                            } elseif ($formatted_initial_grade >= 80.80) {
                                $transmuted_grade = 88;
                            } elseif ($formatted_initial_grade >= 79.20) {
                                $transmuted_grade = 87;
                            } elseif ($formatted_initial_grade >= 77.60) {
                                $transmuted_grade = 86;
                            } elseif ($formatted_initial_grade >= 76.00) {
                                $transmuted_grade = 85;
                            } elseif ($formatted_initial_grade >= 74.40) {
                                $transmuted_grade = 84;
                            } elseif ($formatted_initial_grade >= 72.80) {
                                $transmuted_grade = 83;
                            } elseif ($formatted_initial_grade >= 71.20) {
                                $transmuted_grade = 82;
                            } elseif ($formatted_initial_grade >= 69.60) {
                                $transmuted_grade = 81;
                            } elseif ($formatted_initial_grade >= 68.00) {
                                $transmuted_grade = 80;
                            } elseif ($formatted_initial_grade >= 66.40) {
                                $transmuted_grade = 79;
                            } elseif ($formatted_initial_grade >= 64.80) {
                                $transmuted_grade = 78;
                            } elseif ($formatted_initial_grade >= 63.20) {
                                $transmuted_grade = 77;
                            } elseif ($formatted_initial_grade >= 61.60) {
                                $transmuted_grade = 76;
                            } elseif ($formatted_initial_grade >= 60.00) {
                                $transmuted_grade = 75;
                            } elseif ($formatted_initial_grade >= 56.00) {
                                $transmuted_grade = 74;
                            } elseif ($formatted_initial_grade >= 52.00) {
                                $transmuted_grade = 73;
                            } elseif ($formatted_initial_grade >= 48.00) {
                                $transmuted_grade = 72;
                            } elseif ($formatted_initial_grade >= 44.00) {
                                $transmuted_grade = 71;
                            } elseif ($formatted_initial_grade >= 40.00) {
                                $transmuted_grade = 70;
                            } elseif ($formatted_initial_grade >= 36.00) {
                                $transmuted_grade = 69;
                            } elseif ($formatted_initial_grade >= 32.00) {
                                $transmuted_grade = 68;
                            } elseif ($formatted_initial_grade >= 28.00) {
                                $transmuted_grade = 67;
                            } elseif ($formatted_initial_grade >= 24.00) {
                                $transmuted_grade = 66;
                            } elseif ($formatted_initial_grade >= 20.00) {
                                $transmuted_grade = 65;
                            } elseif ($formatted_initial_grade >= 16.00) {
                                $transmuted_grade = 64;
                            } elseif ($formatted_initial_grade >= 12.00) {
                                $transmuted_grade = 63;
                            } elseif ($formatted_initial_grade >= 8.00) {
                                $transmuted_grade = 62;
                            } elseif ($formatted_initial_grade >= 4.00) {
                                $transmuted_grade = 61;
                            }
                    ?>
                            <tr class="text-center small" style="white-space: nowrap;">
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-start"><?= $student_row['sr_code']; ?></td>
                                <td class="text-start"><?php echo ucwords(strtolower($student_row['lastName'])) . ', ' . ucwords(strtolower($student_row['firstName'])) . ' ' . ucwords(substr($student_row['middleName'], 0, 1)) . '.'; ?></td>
                                
                                <!-- Written Works Scores -->
                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                    <td class="text-center"><?= $ww_scores[$i]; ?></td>
                                <?php } ?>
                                <td class="text-center"><?= $wtotal; ?></td>
                                <td><?= $written_ps; ?></td>
                                <td><?= $written_ws; ?></td>
                                
                                <!-- Performance Task Scores -->
                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                    <td class="text-center"><?= $pt_scores[$i]; ?></td>
                                <?php } ?>
                                <td class="text-center"><?= $pttotal; ?></td>
                                <td><?= $performance_ps; ?></td>
                                <td><?= $performance_ws; ?></td>
                                
                                <!-- Quarterly Assessment Score -->
                                <td class="text-center"><?= $qa_score; ?></td>
                                <td><?= $assessment_ps; ?></td>
                                <td><?= $assessment_ws; ?></td>
                                
                                <!-- Initial Grade and Transmuted Grade -->
                                <td><?= $formatted_initial_grade; ?></td>
                                <td><?= $transmuted_grade; ?></td>
                                
                                <input type="hidden" name="transmuted_grade[<?= $student_id ?>]" value="<?= $transmuted_grade ?>">
                                <input type="hidden" name="student_id[]" value="<?= $student_id ?>">
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="31" class="text-center">No students found in this class.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- Hidden inputs for form submission -->
        <input type="hidden" id="load_id" name="load_id" value="<?= $load_id ?? '' ?>">
        <input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?? '' ?>">
        <input type="hidden" id="school_year" name="school_year" value="<?= $school_year ?? '' ?>">
        <input type="hidden" id="quarter" name="quarter" value="<?= $quarter ?? '' ?>">
        
        <div class="row align-items-center px-3 py-2">
            <!-- HTML Button Code -->
            <div class="col-auto">
                <button type="button" 
                        class="btn btn-sm btn-success" 
                        style="padding: 5px 10px;" 
                        data-bs-toggle="modal" 
                        data-bs-target="#confirmSubmitModal"
                        <?php if ($is_submitted) echo 'disabled'; ?>>
                    <i class="bi bi-save me-2"></i> Submit Grade
                </button>
            </div>
        </div>
        
        <!-- Confirmation Modal - Moved INSIDE the form -->
        <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmSubmitModalLabel">Confirm Grade Submission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to submit the grades? The following items will no longer be editable after confirmation:</p>
                        <ul>
                            <li>Written Works</li>
                            <li>Performance Task</li>
                            <li>Quarterly Assessment</li>
                            <li>Class Record</li>
                            <li>Attendance</li>
                            <li>Observed Values</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_grade" class="btn btn-success">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

            <div class="tab-pane fade" id="quarterly-grade" role="tabpanel" aria-labelledby="quarterly-grade-tab">
                <!-- Start for Table for quarterly grade -->
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                        <thead>
                            <tr class="text-center small" style="white-space: nowrap;">
                                <th>No.</th>
                                <th>Sr-Code</th>
                                <th>Student Name</th>
                                <th>1<sup>st</sup> Quarter</th>
                                <th>2<sup>nd</sup> Quarter</th>
                                <th>3<sup>rd</sup> Quarter</th>
                                <th>4<sup>th</sup> Quarter</th>
                                <th>Final Grade</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$no = 1;
$query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.gender, s.id as student_id, c.gradeLevel
                    FROM students s 
                    JOIN class_students cs ON s.id = cs.student_id 
                    JOIN class c ON cs.class_id = c.id
                    JOIN loads l ON c.id = l.class_id 
                    WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
                    ORDER BY 
                        CASE WHEN TRIM(LOWER(s.gender)) IN ('male','m') THEN 0 
                                 WHEN TRIM(LOWER(s.gender)) IN ('female','f') THEN 1 
                                 ELSE 2 END, s.lastName";
$query_run = mysqli_query($conn, $query);
if ($query_run) {
    $currentGenderGroup = null;
    while ($row = mysqli_fetch_assoc($query_run)) {
        $student_id = $row['student_id'];
        $gradeLevel = $row['gradeLevel'];
        $gender = isset($row['gender']) ? strtolower(trim($row['gender'])) : '';
        $genderGroup = (in_array($gender, ['male','m']) ? 'male' : (in_array($gender, ['female','f']) ? 'female' : 'other'));
        if ($genderGroup !== $currentGenderGroup) {
            $label = ($genderGroup === 'male') ? 'Male' : (($genderGroup === 'female') ? 'Female' : 'Other / Unspecified');
            echo "<tr class=\"table small text-start\"><td colspan=\"3\"><strong>" . htmlspecialchars($label) . "</strong></td></tr>";
            $currentGenderGroup = $genderGroup;
        }
        $finalGrade = "N/A"; // Initialize final grade with a default value
?>

        <tr class="text-center small" style="white-space: nowrap;">
            <td><?php echo $no; ?></td>
            <td class="text-start"><?php echo $row['sr_code']; ?></td>
            <td class="text-start"><?php echo ucwords(strtolower($row['lastName'])) . ', ' . ucwords(strtolower($row['firstName'])) . ' ' . ucwords(substr($row['middleName'], 0, 1)) . '.'; ?></td>
<?php
        $query_grades = "SELECT q1_grade, q2_grade, q3_grade, q4_grade FROM subject_grades WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year'";
        $result_grades = mysqli_query($conn, $query_grades);
        if ($result_grades && mysqli_num_rows($result_grades) > 0) {
            $row_grades = mysqli_fetch_assoc($result_grades);
            
            // Check if grades should be calculated for Grade 11 or Grade 12 students
            if (($gradeLevel == 'Grade 11' || $gradeLevel == 'Grade 12') && ($semester == 1 || $semester == 2)) {
                if ($semester == 1) {
                    // Calculate final grade based on q1 and q2
                    if (isset($row_grades['q1_grade']) && $row_grades['q1_grade'] !== '' &&
                        isset($row_grades['q2_grade']) && $row_grades['q2_grade'] !== '') {
                        $finalGrade = round(($row_grades['q1_grade'] + $row_grades['q2_grade']) / 2);
                    } else {
                        $finalGrade = ""; // Set final grade as incomplete if any grade is missing
                    }
                } elseif ($semester == 2) {
                    // Calculate final grade based on q3 and q4
                    if (isset($row_grades['q3_grade']) && $row_grades['q3_grade'] !== '' &&
                        isset($row_grades['q4_grade']) && $row_grades['q4_grade'] !== '') {
                        $finalGrade = round(($row_grades['q3_grade'] + $row_grades['q4_grade']) / 2);
                    } else {
                        $finalGrade = ""; // Set final grade as incomplete if any grade is missing
                    }
                }

                // Determine the remarks based on the final grade
                if (!empty($finalGrade)) {
                    if ($semester == 1) {
                        if ($row_grades['q1_grade'] === '' || $row_grades['q2_grade'] === '') {
                            $remarks = "Ongoing"; // If any grade is not completed, set remarks as "Ongoing"
                        } elseif ($finalGrade >= 75) {
                            $remarks = "Passed";
                        } else {
                            $remarks = "Failed";
                        }
                    } elseif ($semester == 2) {
                        if ($row_grades['q3_grade'] === '' || $row_grades['q4_grade'] === '') {
                            $remarks = "Ongoing"; // If any grade is not completed, set remarks as "Ongoing"
                        } elseif ($finalGrade >= 75) {
                            $remarks = "Passed";
                        } else {
                            $remarks = "Failed";
                        }
                    }
                } else {
                    $remarks = "Ongoing"; // If final grade is not available, leave remarks as "Ongoing"
                }
            } else {
                // Check if all quarterly grades have valid values
                if (isset($row_grades['q1_grade']) && $row_grades['q1_grade'] !== '' &&
                    isset($row_grades['q2_grade']) && $row_grades['q2_grade'] !== '' &&
                    isset($row_grades['q3_grade']) && $row_grades['q3_grade'] !== '' &&
                    isset($row_grades['q4_grade']) && $row_grades['q4_grade'] !== '') {
                    // Calculate final grade
                    $finalGrade = round(($row_grades['q1_grade'] + $row_grades['q2_grade'] + $row_grades['q3_grade'] + $row_grades['q4_grade']) / 4);
                } else {
                    $finalGrade = ""; // Set final grade as incomplete if any quarterly grade is missing
                }

                // Determine the remarks based on the final grade
                if (!empty($finalGrade)) {
                    if ($row_grades['q1_grade'] === '' || $row_grades['q2_grade'] === '' || $row_grades['q3_grade'] === '' || $row_grades['q4_grade'] === '') {
                        $remarks = "Ongoing"; // If any grade is not completed, set remarks as "Ongoing"
                    } elseif ($finalGrade >= 75) {
                        $remarks = "Passed";
                    } else {
                        $remarks = "Failed";
                    }
                } else {
                    $remarks = "Ongoing"; // If final grade is not available, leave remarks as "Ongoing"
                }
            }

            // Calculate the grade color based on quarterly comparisons
            if (isset($row_grades['q1_grade'], $row_grades['q2_grade']) && $row_grades['q1_grade'] !== '' && $row_grades['q2_grade'] !== '') {
                // Compare q2_grade with q1_grade
                if ($row_grades['q2_grade'] > $row_grades['q1_grade']) {
                    $q2_grade_color = 'text-success'; // Bootstrap success color
                } elseif ($row_grades['q2_grade'] <= $row_grades['q1_grade'] - 3) {
                    $q2_grade_color = 'text-danger'; // Bootstrap danger color
                } else {
                    $q2_grade_color = ''; // No specific color
                }
            }

            if (isset($row_grades['q3_grade'], $row_grades['q2_grade']) && $row_grades['q3_grade'] !== '' && $row_grades['q2_grade'] !== '') {
                // Compare q3_grade with q2_grade
                if ($row_grades['q3_grade'] > $row_grades['q2_grade']) {
                    $q3_grade_color = 'text-success'; // Bootstrap success color
                } elseif ($row_grades['q3_grade'] <= $row_grades['q2_grade'] - 3) {
                    $q3_grade_color = 'text-danger'; // Bootstrap danger color
                } else {
                    $q3_grade_color = ''; // No specific color
                }
            }

            if (isset($row_grades['q4_grade'], $row_grades['q3_grade']) && $row_grades['q4_grade'] !== '' && $row_grades['q3_grade'] !== '') {
                // Compare q4_grade with q3_grade
                if ($row_grades['q4_grade'] > $row_grades['q3_grade']) {
                    $q4_grade_color = 'text-success'; // Bootstrap success color
                } elseif ($row_grades['q4_grade'] <= $row_grades['q3_grade'] - 3) {
                    $q4_grade_color = 'text-danger'; // Bootstrap danger color
                } else {
                    $q4_grade_color = ''; // No specific color
                }
            }
?>
            <td><?php echo isset($row_grades['q1_grade']) ? $row_grades['q1_grade'] : 'N/A'; ?></td>
            <td class="<?php echo $q2_grade_color ?>"><?php echo isset($row_grades['q2_grade']) ? $row_grades['q2_grade'] : 'N/A'; ?></td>
            <td class="<?php echo $q3_grade_color ?>"><?php echo isset($row_grades['q3_grade']) ? $row_grades['q3_grade'] : 'N/A'; ?></td>
            <td class="<?php echo $q4_grade_color ?>"><?php echo isset($row_grades['q4_grade']) ? $row_grades['q4_grade'] : 'N/A'; ?></td>
            <td><?php echo $finalGrade; ?></td>
            <td><?php echo $remarks; ?></td>
<?php
        } else {
?>
            <td colspan="6">No grades available</td>
<?php
        }
?>
        </tr>
<?php
        $no++;
    }
}
?>



                        </tbody>

                    </table>
                </div>
                <!-- Start for Table for quarterly grade -->
            </div>

                            </div> 
                        </div>
                    </div>
                </div>

                <!-- End Grades tab -->
                <!-- Attendance tab content -->
                <div class="tab-pane fade" id="pills-attendance" role="tabpanel" aria-labelledby="pills-attendance-tab">

                 <form action="crud_attendance.php" method="POST" id="attendanceForm">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                            <thead>
                                <tr class="text-center small" style="white-space: nowrap;">
                                    <th colspan="3"></th>
                                    <th colspan="11" class="text-center">Monthly Attendance</th>
                                    <th colspan="2"></th>
                                </tr>
                                <tr class="text-center small" style="white-space: nowrap;">
                                    <th>#</th>
                                    <th>Sr-Code</th>
                                    <th>Name of Learners</th>
                                    <?php
                                    $query_class_start_month = "SELECT class_start FROM academic_calendar WHERE id = $school_year";
                                    $query_run_class_start_month = mysqli_query($conn, $query_class_start_month);
                                    $row_class_start_month = mysqli_fetch_assoc($query_run_class_start_month);
                                    $class_start_month = date("F", strtotime($row_class_start_month['class_start']));

                                    $months = array($class_start_month);
                                    for ($i = 1; $i < 12; $i++) {
                                        $months[] = date("F", strtotime("$class_start_month + $i month"));
                                    }

                                    $orderClause = "FIELD(monthName, '" . implode("', '", $months) . "')";

                                    $query = "SELECT m.monthName, m.daysInMonth, m.id as month_id
                                              FROM months m
                                              INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
                                              WHERE ac.id = $school_year
                                              ORDER BY $orderClause";
                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($query_run)) {
                                            // Modify the month name format to show the short form (e.g., Jan)
                                            $shortMonthName = date("M", strtotime($row1["monthName"]));
                                            $month_id = $row1["month_id"];
                                            echo "<th>" . $shortMonthName . "</th>";
                                        }
                                    }
                                    ?>
                                    <th>Total No. of Days Absent</th>
                                    <th>Total No. of Days Present</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center small" style="white-space: nowrap;">
                                    <td colspan="3">No. of School Days</td>
                                    <?php
                                    $query_run = mysqli_query($conn, $query);

                                    // Variable to store the total daysInMonth
                                    $totalSchoolDays = 0;

                                    if (mysqli_num_rows($query_run) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($query_run)) {
                                            echo "<td style='height: 40px;'>" . $row1["daysInMonth"] . "</td>";
                                            // Add the value of daysInMonth to the total
                                            $totalSchoolDays += $row1["daysInMonth"];
                                        }
                                    }

                                    // Output the total daysInMonth
                                    echo "<td>0</td>"; // Empty cell
                                    echo "<td>" . $totalSchoolDays . "</td>"; // Total daysInMonth
                                    ?>
                                </tr>

                                <tr class="text-center small" style="white-space: nowrap;">
                                    <?php
                                    $no = 1;
                                    $query_students = "SELECT s.sr_code, s.firstName, s.lastName, s.middleName, s.id as student_id
                                                        FROM students s 
                                                        JOIN class_students cs ON s.id = cs.student_id 
                                                        WHERE cs.class_id = '$class_id' AND cs.school_year_id = '$school_year' ORDER BY s.lastName";
                                    $query_run_students = mysqli_query($conn, $query_students);

                                    if ($query_run_students) {
                                        while ($row_student = mysqli_fetch_assoc($query_run_students)) {
                                            $student_id = $row_student['student_id'];
                                            ?>
                                            <tr class="text-center small" style="white-space: nowrap;">
                                                <td class=""><?php echo $no; ?></td>
                                                <td class="text-start"><?php echo $row_student['sr_code']; ?></td>
                                                <td class="text-start"><?php
                                                    echo ucwords(strtolower($row_student['lastName'])) . ', ' .
                                                        ucwords(strtolower($row_student['firstName'])) .
                                                        (!empty($row_student['middleName']) ? ' ' . ucwords(substr($row_student['middleName'], 0, 1)) . '.' : '');
                                                    ?>
                                                </td>
                                                <?php

                                                // Fetch daysPresent for each month and order them according to the academic calendar
                                                $query_months = "SELECT m.id, m.daysInMonth
                                                                  FROM months m
                                                                  INNER JOIN academic_calendar ac ON m.school_year_id = ac.id
                                                                  WHERE ac.id = '$school_year'
                                                                  ORDER BY $orderClause";

                                                $query_run_months = mysqli_query($conn, $query_months);

                                                if ($query_run_months) {
                                                    $totalDaysPresent = 0; // Initialize totalDaysPresent variable
                                                    while ($row_month = mysqli_fetch_assoc($query_run_months)) {
                                                        $month_id = $row_month['id'];
                                                        $daysInMonth = $row_month['daysInMonth'];
                                                        $attendance_query = "SELECT a.daysPresent, m.id as m_id
                                                                             FROM attendance a
                                                                             RIGHT JOIN months m ON a.month_id = m.id
                                                                             WHERE a.student_id = '$student_id' AND a.class_id = '$class_id' AND a.school_year_id = '$school_year' AND m.id = '$month_id'";

                                                        $attendance_result = mysqli_query($conn, $attendance_query);
                                                        $attendance_row = mysqli_fetch_assoc($attendance_result);
                                                        $daysPresent = isset($attendance_row['daysPresent']) ? $attendance_row['daysPresent'] : $daysInMonth;
                                                        $totalDaysPresent += $daysPresent; // Accumulate daysPresent to calculate totalDaysPresent

                                                        // Display the input field for days present
                                                        ?>
                                                        <td>
                                                            <input class="input score-input" 
                                                                   size="1" 
                                                                   type="text" 
                                                                   class="form-control text-center" 
                                                                   name="days_present_<?php echo $student_id; ?>_<?php echo $month_id; ?>" 
                                                                   value="<?php echo $daysPresent; ?>" 
                                                                   style="text-align: center;" 
                                                                   onkeypress="return isNumberKey(event)" 
                                                                   oninput="checkValue(this, <?php echo $daysInMonth; ?>)"
                                                                   data-hps="<?php echo $daysInMonth; ?>"
                                                                   data-student-id="<?php echo $student_id; ?>"
                                                                   data-type="attendance"
                                                                   data-column="<?php echo $month_id; ?>"
                                                                   onkeydown="navigateWithArrows(event, this)"
                                                                   maxlength="2"/>
                                                        </td>
                                                        <?php

                                                        // If no data exists for attendance, insert default value
                                                        if (!isset($attendance_row['daysPresent'])) {
                                                            // Insert attendance data including month_id
                                                            $insert_query = "INSERT INTO attendance (student_id, class_id, school_year_id, month_id, daysPresent) VALUES ('$student_id', '$class_id', '$school_year', '$month_id', '$daysPresent')";
                                                            mysqli_query($conn, $insert_query);
                                                        }

                                                    }
                                                } else {
                                                    echo "<td colspan='12'>No data available</td>";
                                                }
                                                ?>
                                                <td class="text-center"><?php echo $totalSchoolDays - $totalDaysPresent; ?></td>
                                                <td class="text-center"><?php echo $totalDaysPresent; ?></td>
                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                    } else {
                                        echo "Error: " . mysqli_error($conn);
                                    }
                                    ?>
                                </tr>

                            </tbody>
                        </table>
    </div>

                    <input type='hidden' name='class_id' value="<?php echo $class_id; ?>">
                    <input type='hidden' name='load_id' value="<?php echo $load_id; ?>">
                    <input type='hidden' name='school_year_id' value="<?php echo $school_year; ?>">
                    <input type='hidden' name='quarter' value="<?php echo $quarter; ?>">
                    <input type='hidden' name='edit_attendance' value="1">

                    <button type="button" id="attendanceSaveBtn" class="btn btn-sm btn-success" style="padding: 5px 10px;" <?php if ($is_submitted) echo 'disabled'; ?>>
                        <i class="bi bi-save"></i> Save Changes
                    </button>

                </form>

                <!-- Attendance Confirmation Modal -->
                <div class="modal fade" id="attendanceConfirmModal" tabindex="-1" aria-labelledby="attendanceConfirmLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="attendanceConfirmLabel">Confirm Save</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to save the attendance changes?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="confirmAttendanceSave">
                        <i class="bi bi-save"></i> Save
                        </button>
                    </div>
                    </div>
                </div>
                </div>

                <script>
                document.getElementById('attendanceSaveBtn').addEventListener('click', function() {
                    const modal = new bootstrap.Modal(document.getElementById('attendanceConfirmModal'));
                    modal.show();
                });

                document.getElementById('confirmAttendanceSave').addEventListener('click', function() {
                    document.getElementById('attendanceForm').submit();
                });
                </script>


                </div>
                <!-- End Attendance tab content -->

                <!-- Learners Observed tab content -->
                <div class="tab-pane fade" id="pills-observed" role="tabpanel" aria-labelledby="pills-observed-tab">
              
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                        <thead>
                            <tr style="white-space: nowrap;">
                                <th class="text-center small" style="width: 3%;">#</th>
                                <th style="width: 7%;">Sr-Code</th>
                                <th style="width: 20%;">Name of Learners</th>
                                <th style="width: 50%;" class="text-start">Learner's Observed Values</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          $query_students = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, c.gradeLevel, s.id as student_id
                                              FROM students s 
                                              JOIN class_students cs ON s.id = cs.student_id 
                                              JOIN class c ON cs.class_id = c.id
                                              JOIN loads l ON c.id = l.class_id 
                                              WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
                                              ORDER BY s.lastName";

                          $query_run_students = mysqli_query($conn, $query_students);

                          if ($query_run_students) {
                              while ($row_student = mysqli_fetch_assoc($query_run_students)) {
                                  $student_id = $row_student['student_id'];
                                  $grade_level = $row_student['gradeLevel'];

                                  // Check if gradeLevel is equal to 'Kinder'
                                  if ($grade_level == 'Kinder') {
                                      include 'observe_values_k.php';
                                  } else {
                                      include 'observe_values_sh.php';
                                  }
                          ?>
                              
                          <?php
                                  $no++;
                              }
                          }
                          ?>
                        </tbody>
                    </table>
                </div>



                </div>
                <!-- End Learners Observed tab content -->
            </div>  
        </div>
<!-- End Tab for grade attendance and obervere values content -->

</div>

    </section>

  </main><!-- End #main -->

<?php 
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: ../faculty-portal.php");
    exit();
}
 ?>

<script>
// For the first set of tabs
document.addEventListener("DOMContentLoaded", function() {
  const gradesTab = document.getElementById('pills-grades-tab');
  const attendanceTab = document.getElementById('pills-attendance-tab');
  const observedTab = document.getElementById('pills-observed-tab');

  [gradesTab, attendanceTab, observedTab].forEach(tab => {
    tab.addEventListener('click', function() {
      localStorage.setItem('selectedTabGrades', tab.getAttribute('id'));
    });
  });

    const selectedTabGrades = localStorage.getItem('selectedTabGrades');
    if (selectedTabGrades) {
        const el = document.getElementById(selectedTabGrades);
        if (el) el.click();
    }
});

// For the second set of tabs
document.addEventListener("DOMContentLoaded", function() {
  const writtenWorksTab = document.getElementById('written-works-tab');
  const performanceTaskTab = document.getElementById('performance-task-tab');
  const quarterlyAssessmentTab = document.getElementById('quarterly-assessment-tab');
  const viewClassRecordTab = document.getElementById('view-class-record-tab');
  const quarterlyGradeTab = document.getElementById('quarterly-grade-tab');

  [writtenWorksTab, performanceTaskTab, quarterlyAssessmentTab, viewClassRecordTab, quarterlyGradeTab].forEach(tab => {
    tab.addEventListener('click', function() {
      localStorage.setItem('selectedTabWrittenWorks', tab.getAttribute('id'));
    });
  });

    const selectedTabWrittenWorks = localStorage.getItem('selectedTabWrittenWorks');
    if (selectedTabWrittenWorks) {
        const el2 = document.getElementById(selectedTabWrittenWorks);
        if (el2) el2.click();
    }
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to set the state of the switch based on local storage
        function setSwitchState(switchId, switchStateKey, readOnlyClass, editableClass, saveButtonId) {
            var switchState = localStorage.getItem(switchStateKey);
            var switchElement = document.getElementById(switchId);
            var spans = document.querySelectorAll('.' + readOnlyClass);
            var inputs = document.querySelectorAll('.' + editableClass);
            var saveButton = document.getElementById(saveButtonId);

            // Determine toggle label ID based on switch ID
            var toggleLabelId = switchId === 'flexSwitchCheckDefault' ? 'toggleLabel' : 
                                switchId === 'customFlexSwitchCheckDefault' ? 'customToggleLabel' : 'thirdToggleLabel';
            var toggleLabel = document.getElementById(toggleLabelId);

            // Safely toggle editable mode for elements and the save button
            function toggleEditable(editable) {
                // Toggle readonly spans and editable inputs
                for (var i = 0; i < Math.max(spans.length, inputs.length); i++) {
                    if (spans[i]) spans[i].style.display = editable ? 'none' : 'inline-block';
                    if (inputs[i]) inputs[i].style.display = editable ? 'inline-block' : 'none';
                }

                // Ensure save button is toggled even if there are no span/input elements
                if (saveButton) {
                    saveButton.style.display = editable ? 'inline-block' : 'none';
                }

                // Update toggle label
                if (toggleLabel) {
                    if (editable) {
                        toggleLabel.textContent = 'Active';
                        toggleLabel.classList.add('active');
                    } else {
                        toggleLabel.textContent = '';
                        toggleLabel.classList.remove('active');
                    }
                }
            }

            // Initialize based on stored value (default false)
            if (switchElement) {
                if (switchState === 'true') {
                    switchElement.checked = true;
                    toggleEditable(true);
                } else {
                    switchElement.checked = false;
                    toggleEditable(false);
                }

                // Event listener for switch change
                switchElement.addEventListener('change', function() {
                    if (this.checked) {
                        localStorage.setItem(switchStateKey, 'true');
                        toggleEditable(true);
                    } else {
                        localStorage.setItem(switchStateKey, 'false');
                        toggleEditable(false);
                    }
                });
            }
        }

        // Call setSwitchState function for the first switch
        setSwitchState('flexSwitchCheckDefault', 'editableSwitchState', 'readonly', 'editable', 'saveChangesButton');

        // Call setSwitchState function for the second switch
        setSwitchState('customFlexSwitchCheckDefault', 'customEditableSwitchState', 'custom-readonly', 'custom-editable', 'customSaveChangesButton');

        // Call setSwitchState function for the third switch
        setSwitchState('thirdFlexSwitchCheckDefault', 'thirdEditableSwitchState', 'third-readonly', 'third-editable', 'thirdSaveChangesButton');

        // Add more calls to setSwitchState for additional switches if needed
    });
</script>


<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function maxLengthCheck(object) {
        if (object.value.length > object.maxLength)
            object.value = object.value.slice(0, object.maxLength)
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $('.edit-filter-btn').click(function() {
      var filter_id = $(this).data('id');
      var school_year = $(this).data('school-year');
      var semester = $(this).data('semester');
      var quarter = $(this).data('quarter');
      var class_id = $(this).data('class-id');
      
      $('#filter_id').val(filter_id);
      $('#school_year').val(school_year);
      $('#semester').val(semester);
      $('#quarter').val(quarter);
      $('#class_id').val(class_id);
    });
  });
</script>

<script>
// Special function for quarterly assessment validation and update
function validateAndUpdateQuarterly(input, maxValue, studentId) {
    const value = parseFloat(input.value) || 0;
    
    if (value > maxValue && value > 0) {
        input.classList.add('exceeded');
        input.parentElement.classList.add('cell-exceeded');
        
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: `Score (${value}) exceeds maximum allowable value (${maxValue})`,
            showConfirmButton: false,
            timer: 1500
        });
    } else {
        input.classList.remove('exceeded');
        input.parentElement.classList.remove('cell-exceeded');
    }
    
    // Update quarterly calculations immediately
    updateQuarterlyCalculations(studentId);
}

// Function to update quarterly calculations
function updateQuarterlyCalculations(studentId) {
    const scoreInput = document.getElementById(`qa_input_${studentId}`);
    
    if (!scoreInput) return;
    
    const score = parseFloat(scoreInput.value) || 0;
    const hps = parseFloat(scoreInput.dataset.hps) || 0;
    
    // Update total score
    const totalElement = document.getElementById(`qa_total_${studentId}`);
    if (totalElement) {
        totalElement.textContent = score;
    }
    
    // Calculate PS
    let ps = 0;
    if (hps > 0) {
        ps = (score / hps) * 100;
    }
    
    // Update PS
    const psElement = document.getElementById(`qa_ps_${studentId}`);
    if (psElement) {
        psElement.textContent = ps.toFixed(2);
    }
    
    // Calculate WS (Weighted Score)
    const assessmentWeight = <?php echo $assessment; ?>;
    const ws = (ps * assessmentWeight) / 100;
    
    // Update WS
    const wsElement = document.getElementById(`qa_ws_${studentId}`);
    if (wsElement) {
        wsElement.textContent = ws.toFixed(2);
    }
}

// Function to calculate and update totals, PS, WS in real-time
function updateCalculations(studentId, type) {
    // Written Works calculations
    if (type === 'written') {
        let total = 0;
        let hpsTotal = 0;
        
        // Calculate student's total score
        for (let i = 1; i <= 10; i++) {
            const scoreInput = document.getElementById(`w${i}_input_${studentId}`);
            const hps = parseFloat(scoreInput ? scoreInput.dataset.hps : 0) || 0;
            
            if (scoreInput) {
                const score = parseFloat(scoreInput.value) || 0;
                total += score;
                hpsTotal += hps;
                
                // Check if score exceeds HPS
                if (score > hps && score > 0) {
                    scoreInput.classList.add('exceeded');
                    scoreInput.parentElement.classList.add('cell-exceeded');
                } else {
                    scoreInput.classList.remove('exceeded');
                    scoreInput.parentElement.classList.remove('cell-exceeded');
                }
            }
        }
        
        // Calculate PS and WS
        const ps = hpsTotal > 0 ? ((total / hpsTotal) * 100).toFixed(2) : '0.00';
        const writtenWeight = <?php echo $written; ?>;
        const ws = ((parseFloat(ps) * writtenWeight) / 100).toFixed(2);
        
        // Update display
        const totalElement = document.getElementById(`ww_total_${studentId}`);
        const psElement = document.getElementById(`ww_ps_${studentId}`);
        const wsElement = document.getElementById(`ww_ws_${studentId}`);
        
        if (totalElement) totalElement.textContent = total;
        if (psElement) psElement.textContent = ps;
        if (wsElement) wsElement.textContent = ws;
    }
    
    // Performance Task calculations
    else if (type === 'performance') {
        let total = 0;
        let hpsTotal = 0;
        
        for (let i = 1; i <= 10; i++) {
            const scoreInput = document.getElementById(`pt${i}_input_${studentId}`);
            const hps = parseFloat(scoreInput ? scoreInput.dataset.hps : 0) || 0;
            
            if (scoreInput) {
                const score = parseFloat(scoreInput.value) || 0;
                total += score;
                hpsTotal += hps;
                
                // Check if score exceeds HPS
                if (score > hps && score > 0) {
                    scoreInput.classList.add('exceeded');
                    scoreInput.parentElement.classList.add('cell-exceeded');
                } else {
                    scoreInput.classList.remove('exceeded');
                    scoreInput.parentElement.classList.remove('cell-exceeded');
                }
            }
        }
        
        // Calculate PS and WS
        const ps = hpsTotal > 0 ? ((total / hpsTotal) * 100).toFixed(2) : '0.00';
        const performanceWeight = <?php echo $performance; ?>;
        const ws = ((parseFloat(ps) * performanceWeight) / 100).toFixed(2);
        
        // Update display
        const totalElement = document.getElementById(`pt_total_${studentId}`);
        const psElement = document.getElementById(`pt_ps_${studentId}`);
        const wsElement = document.getElementById(`pt_ws_${studentId}`);
        
        if (totalElement) totalElement.textContent = total;
        if (psElement) psElement.textContent = ps;
        if (wsElement) wsElement.textContent = ws;
    }
    
    // Quarterly Assessment calculations
    else if (type === 'quarterly') {
        updateQuarterlyCalculations(studentId);
    }
    
    // Attendance calculations
    else if (type === 'attendance') {
        // Find all attendance inputs for this student
        const attendanceInputs = document.querySelectorAll(`input[name^="days_present_${studentId}_"]`);
        let totalDaysPresent = 0;
        
        attendanceInputs.forEach(input => {
            const days = parseInt(input.value) || 0;
            const hps = parseInt(input.dataset.hps) || 0;
            totalDaysPresent += days;
            
            // Check if days present exceeds days in month
            if (days > hps) {
                input.classList.add('exceeded');
                input.parentElement.classList.add('cell-exceeded');
            } else {
                input.classList.remove('exceeded');
                input.parentElement.classList.remove('cell-exceeded');
            }
        });
        
        // Update the total days present (you might need to add an element for this)
        const totalDaysPresentElement = document.querySelector(`td:nth-last-child(1)`);
        if (totalDaysPresentElement) {
            totalDaysPresentElement.textContent = totalDaysPresent;
        }
    }
}

// Function to validate input and update calculations
function validateAndCalculate(input, maxValue, studentId, type) {
    const value = parseFloat(input.value) || 0;
    
    if (value > maxValue && value > 0) {
        input.classList.add('exceeded');
        input.parentElement.classList.add('cell-exceeded');
        
        // Show warning but don't clear the value
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: `Score (${value}) exceeds maximum allowable value (${maxValue})`,
            showConfirmButton: false,
            timer: 1500
        });
    } else {
        input.classList.remove('exceeded');
        input.parentElement.classList.remove('cell-exceeded');
    }
    
    // Update calculations
    updateCalculations(studentId, type);
}

// Function for arrow key navigation between columns
function navigateWithArrows(event, currentInput) {
    // Get input properties
    const key = event.key;
    const studentId = currentInput.dataset.studentId;
    const type = currentInput.dataset.type;
    const currentColumn = parseInt(currentInput.dataset.column) || 1;
    const totalColumns = parseInt(currentInput.dataset.totalColumns) || 10;
    
    // Find the current row
    const currentRow = currentInput.closest('tr');
    
    if (key === 'ArrowRight' || key === 'Tab') {
        event.preventDefault(); // Prevent default tab behavior
        
        // Find next input in the same row
        let nextColumn = currentColumn + 1;
        if (nextColumn > totalColumns) {
            nextColumn = 1; // Loop back to first column
        }
        let nextInput = null;
        if (type === 'written') {
            nextInput = document.getElementById(`w${nextColumn}_input_${studentId}`);
        } else if (type === 'performance') {
            nextInput = document.getElementById(`pt${nextColumn}_input_${studentId}`);
        } else if (type === 'quarterly') {
            nextInput = document.getElementById(`qa_input_${studentId}`);
        } else if (type === 'attendance') {
            // For attendance, find the next month column in the same row
            const nextInputs = currentRow.querySelectorAll(`input[data-student-id="${studentId}"][data-type="attendance"]`);
            for (let i = 0; i < nextInputs.length; i++) {
                if (nextInputs[i] === currentInput && nextInputs[i + 1]) {
                    nextInput = nextInputs[i + 1];
                    break;
                }
            }
        }
        
        if (nextInput) {
            nextInput.focus();
            nextInput.select();
        }
    } 
    else if (key === 'ArrowLeft') {
        event.preventDefault();
        
        // Find previous input in the same row
        let prevColumn = currentColumn - 1;
        if (prevColumn < 1) {
            prevColumn = totalColumns; // Loop to last column
        }
        let prevInput = null;
        if (type === 'written') {
            prevInput = document.getElementById(`w${prevColumn}_input_${studentId}`);
        } else if (type === 'performance') {
            prevInput = document.getElementById(`pt${prevColumn}_input_${studentId}`);
        } else if (type === 'quarterly') {
            prevInput = document.getElementById(`qa_input_${studentId}`);
        } else if (type === 'attendance') {
            // For attendance, find the previous month column in the same row
            const prevInputs = currentRow.querySelectorAll(`input[data-student-id="${studentId}"][data-type="attendance"]`);
            for (let i = 0; i < prevInputs.length; i++) {
                if (prevInputs[i] === currentInput && prevInputs[i - 1]) {
                    prevInput = prevInputs[i - 1];
                    break;
                }
            }
        }
        
        if (prevInput) {
            prevInput.focus();
            prevInput.select();
        }
    }
    else if (key === 'ArrowDown') {
        event.preventDefault();
        // Find next row that contains a student
        let nextRow = currentRow.nextElementSibling;
        let searchCondition = (type === 'attendance') 
            ? (row) => row.querySelector('input[data-type="attendance"]') 
            : (row) => row.querySelector('input[name="student_id[]"]');
        
        while (nextRow && !searchCondition(nextRow)) {
            nextRow = nextRow.nextElementSibling;
        }
        if (nextRow) {
            let nextInput = null;
            if (type === 'attendance') {
                // For attendance, find the input with the same month column
                const allAttendanceInputs = nextRow.querySelectorAll('input[data-type="attendance"]');
                for (let input of allAttendanceInputs) {
                    if (input.dataset.column === currentInput.dataset.column) {
                        nextInput = input;
                        break;
                    }
                }
            } else {
                const nextSidInput = nextRow.querySelector('input[name="student_id[]"]');
                const nextSid = nextSidInput ? nextSidInput.value : null;
                if (nextSid) {
                    if (type === 'written') {
                        nextInput = document.getElementById(`w${currentColumn}_input_${nextSid}`);
                    } else if (type === 'performance') {
                        nextInput = document.getElementById(`pt${currentColumn}_input_${nextSid}`);
                    } else if (type === 'quarterly') {
                        nextInput = document.getElementById(`qa_input_${nextSid}`);
                    }
                }
            }

            if (nextInput) {
                nextInput.focus();
                nextInput.select();
            }
        }
    }
    else if (key === 'ArrowUp') {
        event.preventDefault();
        // Find previous row that contains a student
        let prevRow = currentRow.previousElementSibling;
        let searchCondition = (type === 'attendance') 
            ? (row) => row.querySelector('input[data-type="attendance"]') 
            : (row) => row.querySelector('input[name="student_id[]"]');
        
        while (prevRow && !searchCondition(prevRow)) {
            prevRow = prevRow.previousElementSibling;
        }
        if (prevRow) {
            let prevInput = null;
            if (type === 'attendance') {
                // For attendance, find the input with the same month column
                const allAttendanceInputs = prevRow.querySelectorAll('input[data-type="attendance"]');
                for (let input of allAttendanceInputs) {
                    if (input.dataset.column === currentInput.dataset.column) {
                        prevInput = input;
                        break;
                    }
                }
            } else {
                const prevSidInput = prevRow.querySelector('input[name="student_id[]"]');
                const prevSid = prevSidInput ? prevSidInput.value : null;
                if (prevSid) {
                    if (type === 'written') {
                        prevInput = document.getElementById(`w${currentColumn}_input_${prevSid}`);
                    } else if (type === 'performance') {
                        prevInput = document.getElementById(`pt${currentColumn}_input_${prevSid}`);
                    } else if (type === 'quarterly') {
                        prevInput = document.getElementById(`qa_input_${prevSid}`);
                    }
                }
            }

            if (prevInput) {
                prevInput.focus();
                prevInput.select();
            }
        }
    }
    else if (key === 'Enter') {
        event.preventDefault();
        // Same behavior as ArrowDown: move to same column next student row
        let nextRow = currentRow.nextElementSibling;
        while (nextRow && !nextRow.querySelector('input[name="student_id[]"]')) {
            nextRow = nextRow.nextElementSibling;
        }
        if (nextRow) {
            const nextSidInput = nextRow.querySelector('input[name="student_id[]"]');
            const nextSid = nextSidInput ? nextSidInput.value : null;
            if (nextSid) {
                let nextInput = null;
                if (type === 'written') {
                    nextInput = document.getElementById(`w${currentColumn}_input_${nextSid}`);
                } else if (type === 'performance') {
                    nextInput = document.getElementById(`pt${currentColumn}_input_${nextSid}`);
                } else if (type === 'quarterly') {
                    nextInput = document.getElementById(`qa_input_${nextSid}`);
                }

                if (nextInput) {
                    nextInput.focus();
                    nextInput.select();
                }
            }
        }
    }
}

// Function to check value and show warning
function checkValue(input, limitValue) {
    var enteredValue = parseInt(input.value);
    if (!isNaN(enteredValue) && enteredValue > limitValue) {
        // Instead of clearing, just add the exceeded class
        input.classList.add('exceeded');
        input.parentElement.classList.add('cell-exceeded');
        
        // Show warning message
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: 'Score exceeds maximum allowable value',
            showConfirmButton: false,
            timer: 1500
        });
    } else {
        input.classList.remove('exceeded');
        input.parentElement.classList.remove('cell-exceeded');
    }
}

// Initialize calculations on page load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all calculations
    <?php
    // Re-fetch student IDs for initialization
    $student_query = "SELECT DISTINCT s.id as student_id
                      FROM students s 
                      JOIN class_students cs ON s.id = cs.student_id 
                      JOIN class c ON cs.class_id = c.id
                      JOIN loads l ON c.id = l.class_id 
                      WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
                      ORDER BY s.lastName";
    $student_result = mysqli_query($conn, $student_query);
    
    while ($student_row = mysqli_fetch_assoc($student_result)) {
        $student_id = $student_row['student_id'];
        echo "updateCalculations('$student_id', 'written');\n";
        echo "updateCalculations('$student_id', 'performance');\n";
        echo "updateCalculations('$student_id', 'quarterly');\n";
    }
    ?>
    
    // Add event listeners for all score inputs
    const scoreInputs = document.querySelectorAll('.score-input');
    scoreInputs.forEach(input => {
        input.addEventListener('input', function() {
            const studentId = this.dataset.studentId;
            const type = this.dataset.type;
            const hps = parseFloat(this.dataset.hps) || 0;
            const value = parseFloat(this.value) || 0;
            
            // Validate
            if (value > hps && value > 0) {
                this.classList.add('exceeded');
                this.parentElement.classList.add('cell-exceeded');
            } else {
                this.classList.remove('exceeded');
                this.parentElement.classList.remove('cell-exceeded');
            }
            
            // Update calculations
            updateCalculations(studentId, type);
        });
        
        input.addEventListener('keydown', function(event) {
            navigateWithArrows(event, this);
        });
    });
    
    // Add keyboard shortcuts
    document.addEventListener('keydown', function(event) {
        const key = (event.key || '').toString().toLowerCase();
        // Ctrl + S to save (if any save button is visible)
        if ((event.ctrlKey || event.metaKey) && key === 's') {
            event.preventDefault();
            const saveButtons = Array.from(document.querySelectorAll('#saveChangesButton, #customSaveChangesButton, #thirdSaveChangesButton'));
            for (const btn of saveButtons) {
                if (btn && !btn.disabled && btn.offsetParent !== null) {
                    btn.click();
                    break;
                }
            }
        }

        // Ctrl + E to toggle edit mode
        if ((event.ctrlKey || event.metaKey) && key === 'e') {
            event.preventDefault();
            const toggleSwitch = document.querySelector('#flexSwitchCheckDefault, #customFlexSwitchCheckDefault, #thirdFlexSwitchCheckDefault');
            if (toggleSwitch) {
                toggleSwitch.click();
            }
        }
    });
});
</script>
<?php
include('../assets/includes/footer.php');
?>  