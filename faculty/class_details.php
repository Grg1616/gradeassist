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
</style>
<style>
    /* Hide input fields by default */
    .editable {
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
    width: 120px; /* Adjusted width for better visibility */
    max-width: 120px; /* Adjusted max-width */
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

.switchToggle input + label:before,
.switchToggle input + input + label:before {
    content: 'Edit';
    position: absolute;
    top: 3px;
    left: 35px;
    width: 100px;
    height: 26px;                      
    border-radius: 90px;
    transition: 0.3s;
    text-indent: 0;
    color: #fff;
}

.switchToggle input:checked + label:before,
.switchToggle input:checked + input + label:before {
    content: 'Editable';
    position: absolute;
    top: 3px;
    left: 10px;
    width: 100px;
    height: 26px;
    border-radius: 90px;
    transition: 0.3s;
    text-indent: 0;
    color: #fff;
}

.switchToggle input:checked + label:after,
.switchToggle input:checked + input + label:after {
    left: calc(100% - 2px);
    transform: translateX(-100%);
}

.switchToggle label:active:after {
    width: 60px;
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
// Retrieve load_id and faculty_id
$load_id = mysqli_real_escape_string($conn, $_GET['load_id']); // Assuming load_id is passed via GET or you can replace it accordingly
$faculty_id = mysqli_real_escape_string($conn, $_SESSION['user_id']); // Get faculty_id from session

// Check if load_id and faculty_id with status 'submit' exist in the submit_grades table
$sql = "SELECT * FROM submit_grades WHERE load_id = '$load_id' AND faculty_id = '$faculty_id' AND status = 'submit'";
$result = mysqli_query($conn, $sql);

// Flag to check if the grade submission is already done
$is_submitted = false;
if (mysqli_num_rows($result) > 0) {
    $is_submitted = true;
}
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
        
        $class_id = $_GET['class_id'];
        $load_id = $_GET['load_id'];
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
        $class_id = $_GET['class_id'];
        $load_id = $_GET['load_id'];
        $school_year = $_GET['school_year'];
        $semester = 1;
        $quarter = 1;
    }
} else {
    // Handle query execution error
    echo "Error executing query: " . mysqli_error($conn);
}

// Free the result set
mysqli_free_result($result);
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
        l.id = $load_id
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

echo $level;
?>




    <div class="pagetitle">
      <h1>Class Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
          <div class="d-flex align-items-center">
              <?php
                $quarter_names = [
                    1 => "First Quarter",
                    2 => "Second Quarter",
                    3 => "Third Quarter",
                    4 => "Fourth Quarter"
                ];

                // Defaulting $quarter to 1 if it's not defined or zero
                $quarter = isset($quarter) && $quarter > 0 ? $quarter : 1;

                $sql = "SELECT YEAR(class_start) AS start_year, YEAR(class_end) AS end_year FROM academic_calendar WHERE id = '$school_year'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $display_quarter = $quarter_names[$quarter];
                        echo "<p class=\"m-0 me-2 fw-semibold\">" . $display_quarter . " AY " . $row["start_year"] . "-" . $row["end_year"] . "</p>";
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

                                $query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.id as student_id
                                          FROM students s 
                                          JOIN class_students cs ON s.id = cs.student_id 
                                          JOIN class c ON cs.class_id = c.id
                                          JOIN loads l ON c.id = l.class_id 
                                          WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
                                          ORDER BY s.lastName";


                                $query_run = mysqli_query($conn, $query);

                                if ($query_run) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $student_id = $row['student_id'];
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
                                                        <span class="readonly" id="w<?php echo $i; ?>"><?php echo isset($row_ww['w'.$i]) ? $row_ww['w'.$i] : ''; ?></span>
                                                        <input class="editable input" type="text" id="w<?php echo $i; ?>_input" name="w<?php echo $i; ?>[<?php echo $student_id; ?>]" value="<?php echo isset($row_ww['w'.$i]) ? $row_ww['w'.$i] : ''; ?>" size="2" style="text-align: center;" onkeypress="return isNumberKey(event)" oninput="checkValue(this, <?php echo $wps_value; ?>)">
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
                                                <td><?php echo $w_score_total; ?></td>
                                            <?php endif; ?>
                                            <?php 
                                                if ($wpstotal != 0 && $written != 0) {
                                                    $written_ps = number_format(($w_score_total / $wpstotal) * 100, 2);
                                                    $written_percentage = number_format($written / 100, 2); // Convert $written to percentage and format to 2 decimal places
                                                    $written_ws = number_format($written_ps * $written_percentage, 2); // Multiply $percentage by $written percentage and format to 2 decimal places
                                                } else {
                                                    $written_ps = 0;
                                                    $written_ws = 0;
                                                }
                                            ?>
                                            <td><?php echo $written_ps; ?></td>
                                            <td><?php echo $written_ws; ?></td>

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
                <div class="row align-items-center px-3 py-2">
                    <div class="col-auto">
                        <div class="switchToggle">
                            <input type="checkbox" id="flexSwitchCheckDefault">
                            <label for="flexSwitchCheckDefault">Toggle</label>
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

                                $query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.id as student_id
                                            FROM students s 
                                            JOIN class_students cs ON s.id = cs.student_id 
                                            JOIN class c ON cs.class_id = c.id
                                            JOIN loads l ON c.id = l.class_id 
                                            WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
                                            ORDER BY s.lastName";

                                $query_run = mysqli_query($conn, $query);

                                if ($query_run) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $student_id = $row['student_id'];
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
                                                            <span class="custom-readonly" id="pt<?php echo $i; ?>"><?php echo isset($row_pt['pt'.$i]) ? $row_pt['pt'.$i] : ''; ?></span>
                                                            <input class="custom-editable input" type="text" id="pt<?php echo $i; ?>_input" name="pt<?php echo $i; ?>[<?php echo $student_id; ?>]" value="<?php echo isset($row_pt['pt'.$i]) ? $row_pt['pt'.$i] : ''; ?>" size="2" style="text-align: center;" onkeypress="return isNumberKey(event)" oninput="checkValue(this, <?php echo $pps_value; ?>)">

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
                                                <td><?php echo $p_score_total; ?></td>
                                            <?php endif; ?>
                                            <?php 
                                                if ($pps_total != 0 && $performance != 0) {
                                                    $performance_ps = number_format(($p_score_total / $pps_total) * 100, 2);
                                                    $performance_percentage = number_format($performance / 100, 2); // Convert $written to percentage and format to 2 decimal places
                                                    $performance_ws = number_format($performance_ps * $performance_percentage, 2); // Multiply $percentage by $written percentage and format to 2 decimal places
                                                } else {
                                                    $performance_ps = 0;
                                                    $performance_ws = 0;
                                                }
                                            ?>
                                            <td><?php echo $performance_ps; ?></td>
                                            <td><?php echo $performance_ws; ?></td>

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
                    <div class="row align-items-center px-3 py-2">
                            <div class="col-auto">
                                <div class="switchToggle">
                                    <input type="checkbox" id="customFlexSwitchCheckDefault">
                                    <label for="customFlexSwitchCheckDefault">Toggle</label>
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
                <!-- Table for Performance Task -->
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
                                <!-- Add 13 more columns here -->
                            </tr>
                            <tr class="text-center small" style="white-space: nowrap;">
                                <td colspan="3" class="text-end fw-semibold">Highest Possible Score</td>
                                <form action="crud_quarterly.php" method="POST">
                                <?php
                                $qps_total = 0; // Initialize $total for performance task
                                $qa_id = null;

                                // Cast and add $value to $total
                                function addQATotal(&$qps_total, $value) {
                                    if (is_numeric($value)) {
                                        $qps_total += (int)$value;
                                    }
                                }

                                // Query to retrieve performance tasks
                                $query = "SELECT id, ps 
                                          FROM quarterly_assessment 
                                          WHERE load_id = '$load_id' 
                                          AND school_year_id = '$school_year' 
                                          AND quarter = '$quarter'";

                                $result = mysqli_query($conn, $query);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $qa_id = $row['id']; // Store the id value
                                        $value = isset($row['ps']) ? $row['ps'] : 0;
                                        addQATotal($qps_total, $value); // Add to total using the function
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
                                        border: none; /* Removes the border */
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
                                <!-- Add 13 more columns here -->
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

                                $query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.id as student_id
                                            FROM students s 
                                            JOIN class_students cs ON s.id = cs.student_id 
                                            JOIN class c ON cs.class_id = c.id
                                            JOIN loads l ON c.id = l.class_id 
                                            WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
                                            ORDER BY s.lastName";

                                $query_run = mysqli_query($conn, $query);

                                if ($query_run) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $student_id = $row['student_id'];
                                ?>
                                        <tr class="text-center small" style="white-space: nowrap;">
                                            <td class=""><?php echo $no; ?></td>
                                            <td class="text-start"><?php echo $row['sr_code']; ?></td>
                                            <td class="text-start"><?php echo ucwords(strtolower($row['lastName'])) . ', ' . ucwords(strtolower($row['firstName'])) . ' ' . ucwords(substr($row['middleName'], 0, 1)) . '.'; ?>
                                            </td>
                                            <?php
                                            $query = "SELECT score, id FROM qa_score WHERE student_id = '$student_id' AND load_id = '$load_id' AND school_year_id = '$school_year' AND quarter = '$quarter' AND qa_id = '$qa_id'";
                                            $result = mysqli_query($conn, $query);

                                            $score_value = ''; // Default value if score is not found
                                            if ($result) {
                                                $q_score_total = 0;
                                                while ($row_qa = mysqli_fetch_assoc($result)) {
                                                    if (isset($row_qa['score']) && is_numeric($row_qa['score'])) {
                                                        $q_score_total += $row_qa['score'];
                                                        $score_value = $row_qa['score']; // Update $score_value with the retrieved score
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
                                                $query_qa = "SELECT $qa_column FROM quarterly_assessment WHERE id = '$qa_id'";
                                                $result_qa = mysqli_query($conn, $query_qa);
                                                
                                                if ($result_qa) {
                                                    $row_qqa = mysqli_fetch_assoc($result_qa);
                                                    
                                                    if ($row_qqa) {
                                                        $qa_value = $row_qqa[$qa_column];
                                                        
                                                        if (!empty($qa_value)) { ?>
                                                            <td>
                                                                <span class="third-readonly" id="score"><?php echo $score_value; ?></span>
                                                                <input class="third-editable input" type="text" id="score" name="score[<?php echo $student_id; ?>]" value="<?php echo $score_value; ?>" size="2" style="text-align: center;" onkeypress="return isNumberKey(event)" oninput="checkValue(this, <?php echo $qa_value; ?>)">
                                                            </td>
                                                        <?php } else { ?>
                                                            <td style="height: 30px;"></td>
                                                        <?php }
                                                    } else {
                                                    }
                                                    
                                                    mysqli_free_result($result_qa);
                                                } else {
                                                    // Handle query execution failure
                                                    echo "Error executing the query: " . mysqli_error($conn);
                                                }
                                            } 
                                            ?>

                                            
                                            <input type="hidden" id="load_id" name="load_id" value="<?= $load_id ?? '' ?>">
                                            <input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?? '' ?>">
                                            <input type="hidden" id="school_year" name="school_year" value="<?= $school_year ?? '' ?>">
                                            <input type="hidden" id="quarter" name="quarter" value="<?= $quarter ?? '' ?>">
                                            <input type="hidden" id="qa_id" name="qa_id" value="<?= $qa_id ?? '' ?>">
                                            <input type="hidden" id="student_id" name="student_id[]" value="<?= $student_id ?? '' ?>">

                                            <td></td>
                                            <?php if ($result): ?>
                                                <td><?php echo $q_score_total; ?></td>
                                            <?php endif; ?>
                                            <?php 
                                                if ($qps_total != 0 && $assessment != 0) {
                                                    $assessment_ps = number_format(($q_score_total / $qps_total) * 100, 2);
                                                    $assessment_percentage = number_format($assessment / 100, 2); // Convert $written to percentage and format to 2 decimal places
                                                    $assessment_ws = number_format($assessment_ps * $assessment_percentage, 2); // Multiply $percentage by $written percentage and format to 2 decimal places
                                                } else {
                                                    $assessment_ps = 0;
                                                    $assessment_ws = 0;
                                                }
                                            ?>   
                                            <td><?php echo $assessment_ps; ?></td>
                                            <td><?php echo $assessment_ws; ?></td>

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
                    <div class="row align-items-center px-3 py-2">
                            <div class="col-auto">
                                <div class="switchToggle">
                                    <input type="checkbox" id="thirdFlexSwitchCheckDefault">
                                    <label for="thirdFlexSwitchCheckDefault">Toggle</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button id="thirdSaveChangesButton" type="submit" name="qa_score" class="btn btn-sm btn-success" style="padding: 5px 10px; display: none;" <?php if ($is_submitted) echo 'disabled'; ?>>
                                    <i class="custom-icon bi bi-save me-2"></i> Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                <!-- End for Table for Performance Task -->
            </div>

            <div class="tab-pane fade" id="view-class-record" role="tabpanel" aria-labelledby="view-class-record-tab">
                <!-- Start for Table for class record -->
                <form action="crud_subject_grade.php" method="POST">
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
                                $no = 1;
                                $query = "SELECT * 
                                          FROM written_works 
                                          WHERE load_id = '$load_id' 
                                          AND school_year_id = '$school_year' 
                                          AND quarter = '$quarter'";
                                // Assuming $query_run is the result of mysqli_query() or similar
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        // Compute total of wps1 to wps10
                                        $total_wps = 0;
                                        for ($i = 1; $i <= 10; $i++) {
                                            // Check if the value is not empty or null before adding to the total
                                            if (!empty($row['wps' . $i]) && $row['wps' . $i] !== null) {
                                                $total_wps += $row['wps' . $i];
                                            }
                                        }
                                ?>
                                            <td><?= isset($row['wps1']) ? $row['wps1'] : ''; ?></td>
                                            <td><?= isset($row['wps2']) ? $row['wps2'] : ''; ?></td>
                                            <td><?= isset($row['wps3']) ? $row['wps3'] : ''; ?></td>
                                            <td><?= isset($row['wps4']) ? $row['wps4'] : ''; ?></td>
                                            <td><?= isset($row['wps5']) ? $row['wps5'] : ''; ?></td>
                                            <td><?= isset($row['wps6']) ? $row['wps6'] : ''; ?></td>
                                            <td><?= isset($row['wps7']) ? $row['wps7'] : ''; ?></td>
                                            <td><?= isset($row['wps8']) ? $row['wps8'] : ''; ?></td>
                                            <td><?= isset($row['wps9']) ? $row['wps9'] : ''; ?></td>
                                            <td><?= isset($row['wps10']) ? $row['wps10'] : ''; ?></td>
                                            <td><?= $total_wps; ?></td> 
                                            <td>100.00</td>
                                            <td><?php echo $written; ?>%</td>
                                <?php 
                                    }
                                }
                                ?>


                                <?php
                                $no = 1;
                                $query = "SELECT * 
                                          FROM performance_task 
                                          WHERE load_id = '$load_id' 
                                          AND school_year_id = '$school_year' 
                                          AND quarter = '$quarter'";
                                // Assuming $query_run is the result of mysqli_query() or similar
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        // Compute total of wps1 to wps10
                                        $total_pps = 0;
                                        for ($i = 1; $i <= 10; $i++) {
                                            // Check if the value is not empty or null before adding to the total
                                            if (!empty($row['pps' . $i]) && $row['pps' . $i] !== null) {
                                                $total_pps += $row['pps' . $i];
                                            }
                                        }
                                ?>
                                            <td><?= isset($row['pps1']) ? $row['pps1'] : ''; ?></td>
                                            <td><?= isset($row['pps2']) ? $row['pps2'] : ''; ?></td>
                                            <td><?= isset($row['pps3']) ? $row['pps3'] : ''; ?></td>
                                            <td><?= isset($row['pps4']) ? $row['pps4'] : ''; ?></td>
                                            <td><?= isset($row['pps5']) ? $row['pps5'] : ''; ?></td>
                                            <td><?= isset($row['pps6']) ? $row['pps6'] : ''; ?></td>
                                            <td><?= isset($row['pps7']) ? $row['pps7'] : ''; ?></td>
                                            <td><?= isset($row['pps8']) ? $row['pps8'] : ''; ?></td>
                                            <td><?= isset($row['pps9']) ? $row['pps9'] : ''; ?></td>
                                            <td><?= isset($row['pps10']) ? $row['pps10'] : ''; ?></td>
                                            <td><?= $total_pps; ?></td> 
                                            <td>100.00</td>
                                            <td><?php echo $performance; ?>%</td>
                                <?php 
                                    }
                                }
                                ?>
                                <?php
                                $no = 1;
                                $query = "SELECT * 
                                          FROM quarterly_assessment 
                                          WHERE load_id = '$load_id' 
                                          AND school_year_id = '$school_year' 
                                          AND quarter = '$quarter'";
                                // Assuming $query_run is the result of mysqli_query() or similar
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $total_ps = $row['ps'];
                                ?>
                                            <td><?= isset($row['ps']) ? $row['ps'] : ''; ?></td>
                                            <td>100.00</td>
                                            <td><?php echo $assessment; ?>%</td>
                                <?php 
                                    }
                                }
                                ?>
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
                            $query = "SELECT DISTINCT
                                s.sr_code,
                                s.firstName,
                                s.lastName,
                                s.middleName,
                                s.id as student_id,
                                ww.w1, ww.w2, ww.w3, ww.w4, ww.w5, ww.w6, ww.w7, ww.w8, ww.w9, ww.w10,
                                pt.pt1, pt.pt2, pt.pt3, pt.pt4, pt.pt5, pt.pt6, pt.pt7, pt.pt8, pt.pt9, pt.pt10,
                                qa.score
                            FROM 
                                students s 
                                JOIN class_students cs ON s.id = cs.student_id 
                                JOIN class c ON cs.class_id = c.id
                                JOIN loads l ON c.id = l.class_id 
                                LEFT JOIN ww_score ww ON s.id = ww.student_id
                                LEFT JOIN pt_score pt ON s.id = pt.student_id
                                LEFT JOIN qa_score qa ON s.id = qa.student_id
                            WHERE 
                                l.class_id = '$class_id' 
                                AND l.school_year_id = '$school_year' 
                                AND l.class_id = '$class_id'
                                AND ww.quarter = '$quarter'
                                AND ww.school_year_id = '$school_year'
                                AND ww.load_id = '$load_id'
                                AND pt.quarter = '$quarter'
                                AND pt.school_year_id = '$school_year'
                                AND pt.load_id = '$load_id'
                                AND qa.quarter = '$quarter'
                                AND qa.school_year_id = '$school_year'
                                AND qa.load_id = '$load_id'
                            ORDER BY s.lastName";

                            // Assuming $query_run is the result of mysqli_query() or similar
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    $student_id = $row['student_id'];

                                    // Compute total for w1 to w10
                                    $wtotal = array_sum(array_map(fn($key) => $row[$key] ?? 0, array_map(fn($i) => "w$i", range(1, 10))));

                                    // Compute total for pt1 to pt10
                                    $pttotal = array_sum(array_map(fn($key) => $row[$key] ?? 0, array_map(fn($i) => "pt$i", range(1, 10))));
                            ?>
                                <tr class="text-center small" style="white-space: nowrap;">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-start"><?= isset($row['sr_code']) ? $row['sr_code'] : ''; ?></td>
                                    <td class="text-start"><?php echo ucwords(strtolower($row['lastName'])) . ', ' . ucwords(strtolower($row['firstName'])) . ' ' . ucwords(substr($row['middleName'], 0, 1)) . '.'; ?>
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <td class="text-center"><?= isset($row["w$i"]) ? $row["w$i"] : ''; ?></td>
                                    <?php } ?>
                                    <td class="text-center"><?= $wtotal; ?></td>
                                    <?php 
                                        if ($total_wps != 0 && $written != 0) {
                                            $written_ps = number_format(($wtotal / $total_wps) * 100, 2);
                                            $written_percentage = number_format($written / 100, 2); // Convert $written to percentage and format to 2 decimal places
                                            $written_ws = number_format($written_ps * $written_percentage, 2); // Multiply $percentage by $written percentage and format to 2 decimal places
                                        } else {
                                            $written_ps = 0;
                                            $written_ws = 0;
                                        }
                                    ?>
                                    <td><?php echo $written_ps; ?></td>
                                    <td><?php echo $written_ws; ?></td>
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <td class="text-center"><?= isset($row["pt$i"]) ? $row["pt$i"] : ''; ?></td>
                                    <?php } ?>
                                    <td class="text-center"><?= $pttotal; ?></td>
                                    <?php 
                                        if ($total_pps != 0 && $performance != 0) {
                                            $performance_ps = number_format(($pttotal / $total_pps) * 100, 2);
                                            $performance_percentage = number_format($performance / 100, 2); // Convert $written to percentage and format to 2 decimal places
                                            $performance_ws = number_format($performance_ps * $performance_percentage, 2); // Multiply $percentage by $written percentage and format to 2 decimal places
                                        } else {
                                            $performance_ps = 0;
                                            $performance_ws = 0;
                                        }
                                    ?>
                                    <td><?php echo $performance_ps; ?></td>
                                    <td><?php echo $performance_ws; ?></td>
                                    
                                    <td class="text-center"><?= isset($row['score']) ? $row['score'] : '0'; ?></td>
                                    <?php if(isset($row['score']) && $row['score'] !== ''): ?>
                                    <?php 

                                        if ($total_ps != 0 && $assessment != 0) {
                                            $assessment_ps = number_format(($row['score'] / $total_ps) * 100, 2);
                                            $assessment_percentage = number_format($assessment / 100, 2); // Convert $written to percentage and format to 2 decimal places
                                            $assessment_ws = number_format($assessment_ps * $assessment_percentage, 2); // Multiply $percentage by $written percentage and format to 2 decimal places
                                        } else {
                                            $assessment_ps = 0;
                                            $assessment_ws = 0;
                                        }
                                    ?>
                                    <?php endif; ?>
                                    <td><?php echo $assessment_ps; ?></td>
                                    <td><?php echo $assessment_ws; ?></td>
                                    <?php
                                    $written_ws = $written_ws ?? 0;
                                    $performance_ws = $performance_ws ?? 0;
                                    $assessment_ws = $assessment_ws ?? 0;
                                    $initial_grade = $written_ws + $performance_ws + $assessment_ws;
                                    $formatted_initial_grade = number_format($initial_grade, 2);
                                    ?>
                                    <td><?php echo $formatted_initial_grade; ?></td>

                                    <?php

                                    // Calculate the transmuted grade
                                    if ($formatted_initial_grade >= 100) {
                                        $transmuted_grade = 100;
                                    } elseif ($formatted_initial_grade >= 98.40 && $formatted_initial_grade <= 99.99) {
                                        $transmuted_grade = 99;
                                    } elseif ($formatted_initial_grade >= 96.80 && $formatted_initial_grade <= 98.39) {
                                        $transmuted_grade = 98;
                                    } elseif ($formatted_initial_grade >= 95.20 && $formatted_initial_grade <= 96.79) {
                                        $transmuted_grade = 97;
                                    } elseif ($formatted_initial_grade >= 93.60 && $formatted_initial_grade <= 95.19) {
                                        $transmuted_grade = 96;
                                    } elseif ($formatted_initial_grade >= 92.00 && $formatted_initial_grade <= 93.59) {
                                        $transmuted_grade = 95;
                                    } elseif ($formatted_initial_grade >= 90.40 && $formatted_initial_grade <= 91.99) {
                                        $transmuted_grade = 94;
                                    } elseif ($formatted_initial_grade >= 88.80 && $formatted_initial_grade <= 90.39) {
                                        $transmuted_grade = 93;
                                    } elseif ($formatted_initial_grade >= 87.20 && $formatted_initial_grade <= 88.79) {
                                        $transmuted_grade = 92;
                                    } elseif ($formatted_initial_grade >= 85.60 && $formatted_initial_grade <= 87.19) {
                                        $transmuted_grade = 91;
                                    } elseif ($formatted_initial_grade >= 84.00 && $formatted_initial_grade <= 85.59) {
                                        $transmuted_grade = 90;
                                    } elseif ($formatted_initial_grade >= 82.40 && $formatted_initial_grade <= 83.99) {
                                        $transmuted_grade = 89;
                                    } elseif ($formatted_initial_grade >= 80.80 && $formatted_initial_grade <= 82.39) {
                                        $transmuted_grade = 88;
                                    } elseif ($formatted_initial_grade >= 79.20 && $formatted_initial_grade <= 80.79) {
                                        $transmuted_grade = 87;
                                    } elseif ($formatted_initial_grade >= 77.60 && $formatted_initial_grade <= 79.19) {
                                        $transmuted_grade = 86;
                                    } elseif ($formatted_initial_grade >= 76.00 && $formatted_initial_grade <= 77.59) {
                                        $transmuted_grade = 85;
                                    } elseif ($formatted_initial_grade >= 74.40 && $formatted_initial_grade <= 75.99) {
                                        $transmuted_grade = 84;
                                    } elseif ($formatted_initial_grade >= 72.80 && $formatted_initial_grade <= 74.39) {
                                        $transmuted_grade = 83;
                                    } elseif ($formatted_initial_grade >= 71.20 && $formatted_initial_grade <= 72.79) {
                                        $transmuted_grade = 82;
                                    } elseif ($formatted_initial_grade >= 69.60 && $formatted_initial_grade <= 71.19) {
                                        $transmuted_grade = 81;
                                    } elseif ($formatted_initial_grade >= 68.00 && $formatted_initial_grade <= 69.59) {
                                        $transmuted_grade = 80;
                                    } elseif ($formatted_initial_grade >= 66.40 && $formatted_initial_grade <= 67.99) {
                                        $transmuted_grade = 79;
                                    } elseif ($formatted_initial_grade >= 64.80 && $formatted_initial_grade <= 66.39) {
                                        $transmuted_grade = 78;
                                    } elseif ($formatted_initial_grade >= 63.20 && $formatted_initial_grade <= 64.79) {
                                        $transmuted_grade = 77;
                                    } elseif ($formatted_initial_grade >= 61.60 && $formatted_initial_grade <= 63.19) {
                                        $transmuted_grade = 76;
                                    } elseif ($formatted_initial_grade >= 60.00 && $formatted_initial_grade <= 61.59) {
                                        $transmuted_grade = 75;
                                    } elseif ($formatted_initial_grade >= 56.00 && $formatted_initial_grade <= 59.99) {
                                        $transmuted_grade = 74;
                                    } elseif ($formatted_initial_grade >= 52.00 && $formatted_initial_grade <= 55.99) {
                                        $transmuted_grade = 73;
                                    } elseif ($formatted_initial_grade >= 48.00 && $formatted_initial_grade <= 51.99) {
                                        $transmuted_grade = 72;
                                    } elseif ($formatted_initial_grade >= 44.00 && $formatted_initial_grade <= 47.99) {
                                        $transmuted_grade = 71;
                                    } elseif ($formatted_initial_grade >= 40.00 && $formatted_initial_grade <= 43.99) {
                                        $transmuted_grade = 70;
                                    } elseif ($formatted_initial_grade >= 36.00 && $formatted_initial_grade <= 39.99) {
                                        $transmuted_grade = 69;
                                    } elseif ($formatted_initial_grade >= 32.00 && $formatted_initial_grade <= 35.99) {
                                        $transmuted_grade = 68;
                                    } elseif ($formatted_initial_grade >= 28.00 && $formatted_initial_grade <= 31.99) {
                                        $transmuted_grade = 67;
                                    } elseif ($formatted_initial_grade >= 24.00 && $formatted_initial_grade <= 27.99) {
                                        $transmuted_grade = 66;
                                    } elseif ($formatted_initial_grade >= 20.00 && $formatted_initial_grade <= 23.99) {
                                        $transmuted_grade = 65;
                                    } elseif ($formatted_initial_grade >= 16.00 && $formatted_initial_grade <= 19.99) {
                                        $transmuted_grade = 64;
                                    } elseif ($formatted_initial_grade >= 12.00 && $formatted_initial_grade <= 15.99) {
                                        $transmuted_grade = 63;
                                    } elseif ($formatted_initial_grade >= 4.00 && $formatted_initial_grade <= 7.99) {
                                        $transmuted_grade = 62;
                                    } elseif ($formatted_initial_grade >= 0.00 && $formatted_initial_grade <= 3.99) {
                                        $transmuted_grade = 60;
                                    }
                                    ?>
                                    <td><?php echo $transmuted_grade; ?></td>
                                    <input type="hidden" id="load_id" name="load_id" value="<?= $load_id ?? '' ?>">
                                    <input type="hidden" id="class_id" name="class_id" value="<?= $class_id ?? '' ?>">
                                    <input type="hidden" id="school_year" name="school_year" value="<?= $school_year ?? '' ?>">
                                    <input type="hidden" id="quarter" name="quarter" value="<?= $quarter ?? '' ?>">
                                    <input type="hidden" name="transmuted_grade[<?= $student_id ?>]" value="<?= $transmuted_grade ?>">
                                    <input type="hidden" name="student_id[]" value="<?= $student_id ?>">
                                </tr>
                            <?php 
                                }
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
                    <!-- End for Table for class record -->
                    <div class="row align-items-center px-3 py-2">


                        <!-- HTML Button Code -->
                        <div class="col-auto">
                            <button type="button" 
                                    class="btn btn-sm btn-success" 
                                    style="padding: 5px 10px;" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmSubmitModal"
                                    <?php if ($is_submitted) echo 'disabled'; ?>> <!-- Disable button if already submitted -->
                                <i class="bi bi-save me-2"></i> Submit Grade
                            </button>
                        </div>
                        <!-- Confirmation Modal -->
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
$query = "SELECT DISTINCT s.sr_code, s.firstName, s.lastName, s.middleName, s.id as student_id, c.gradeLevel
          FROM students s 
          JOIN class_students cs ON s.id = cs.student_id 
          JOIN class c ON cs.class_id = c.id
          JOIN loads l ON c.id = l.class_id 
          WHERE l.class_id = '$class_id' AND l.school_year_id = '$school_year'
          ORDER BY s.lastName";
$query_run = mysqli_query($conn, $query);
if ($query_run) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        $student_id = $row['student_id'];
        $gradeLevel = $row['gradeLevel'];
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

                 <form action="crud_attendance.php" method="POST">
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
                                                            <input class="input" size="1" type="text" class="form-control text-center" name="days_present_<?php echo $student_id; ?>_<?php echo $month_id; ?>" value="<?php echo $daysPresent; ?>" style="text-align: center;" onkeypress="return isNumberKey(event)" oninput="checkValue(this, <?php echo $daysInMonth; ?>)"/>
                                                            <input type='hidden' name='class_id' value="<?php echo $class_id; ?>">
                                                            <input type='hidden' name='load_id' value="<?php echo $load_id; ?>">
                                                            <input type='hidden' name='month_id' value="<?php echo $month_id; ?>">
                                                            <input type='hidden' name='school_year_id' value="<?php echo $school_year; ?>">
                                                            <input type='hidden' name='quarter' value="<?php echo $quarter; ?>">
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

                    <button type="submit" name="edit_attendance" class="btn btn-sm btn-success" style="padding: 5px 10px;" <?php if ($is_submitted) echo 'disabled'; ?>>
                        <i class="bi bi-save"></i> Save Changes
                    </button>

                </form>


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
<?php
include('../assets/includes/footer.php');
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
    document.getElementById(selectedTabGrades).click();
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
    document.getElementById(selectedTabWrittenWorks).click();
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
            
            if (switchState === 'true') {
                switchElement.checked = true;
                toggleEditable(true); // Enable editable mode if switch is checked
            } else {
                switchElement.checked = false;
                toggleEditable(false); // Disable editable mode if switch is unchecked
            }

            // Function to toggle editable mode
            function toggleEditable(editable) {
                for (var i = 0; i < spans.length; i++) {
                    if (editable) {
                        spans[i].style.display = 'none';
                        inputs[i].style.display = 'inline-block';
                        saveButton.style.display = 'inline-block'; // Show the button
                    } else {
                        spans[i].style.display = 'inline-block';
                        inputs[i].style.display = 'none';
                        saveButton.style.display = 'none'; // Hide the button
                    }
                }
            }

            // Event listener for switch change
            switchElement.addEventListener('change', function() {
                if (this.checked) {
                    localStorage.setItem(switchStateKey, 'true');
                    toggleEditable(true); // Enable editable mode if switch is checked
                } else {
                    localStorage.setItem(switchStateKey, 'false');
                    toggleEditable(false); // Disable editable mode if switch is unchecked
                }
            });
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
    function checkValue(input, limitValue) {
        var enteredValue = parseInt(input.value);
        if (!isNaN(enteredValue) && enteredValue > limitValue) {
            // Trigger SweetAlert2 message
            Swal.fire({
                icon: 'warning',
            title: 'Error!',
            text: 'Input exceeds maximum allowable value.',
            showConfirmButton: false,
            timer: 1000,
            customClass: {
                popup: 'my-sweetalert',
            }
            });

            input.value = '';
        }
    }
</script>


