<!-- Navigation tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="grade-list-view-tab" data-bs-toggle="tab" data-bs-target="#grade-list-view" type="button" role="tab" aria-controls="grade-list-view" aria-selected="true"><i class="bi bi-list-ul"></i> List View</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="grade-table-view-tab" data-bs-toggle="tab" data-bs-target="#grade-table-view" type="button" role="tab" aria-controls="grade-table-view" aria-selected="false"><i class="bi bi-table"></i> Table View</button>
                  </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="myTabContent">
                  <!-- Start Home Tab Content -->
                  <div class="tab-pane fade show active" id="grade-list-view" role="tabpanel" aria-labelledby="grade-list-view-tab">

                      <div class="list-group mt-3">
                        <?php
                        $student_id = $_SESSION['user_id'];
                        if (isset($class_id) && isset($school_year_id)) {
                            // Escape the parameters to prevent SQL injection
                            $class_id = mysqli_real_escape_string($conn, $class_id);
                            $school_year_id = mysqli_real_escape_string($conn, $school_year_id);

                            // Determine which quarter grade to display based on the value of $quarter
                            $grade_column = '';
                            switch ($quarter) {
                                case 1:
                                    $grade_column = 'q1_grade';
                                    break;
                                case 2:
                                    $grade_column = 'q2_grade';
                                    break;
                                case 3:
                                    $grade_column = 'q3_grade';
                                    break;
                                case 4:
                                    $grade_column = 'q4_grade';
                                    break;
                                default:
                                    echo "<h5 class='text-center mt-3'>Invalid Quarter</h5>";
                                    exit;
                            }

                            // Construct the SQL query
                            $query = "
                                SELECT 
                                    subject_grades.$grade_column AS grade, 
                                    subjects.courseCode,
                                    subjects.courseTitle,
                                    faculty.firstName,
                                    faculty.middleName,
                                    faculty.lastName,
                                    faculty.rank,
                                    loads.mapeh_name
                                FROM 
                                    subject_grades
                                JOIN 
                                    loads ON subject_grades.load_id = loads.id
                                JOIN 
                                    subjects ON loads.subject_id = subjects.id
                                JOIN 
                                    faculty ON loads.faculty_id = faculty.id
                                WHERE 
                                    subject_grades.student_id = '$student_id' 
                                    AND subject_grades.school_year_id = '$school_year_id'
                                    AND loads.class_id = '$class_id'
                                    AND subjects.courseCode NOT LIKE '%MAPEH%'
                                ORDER BY 
                                    subjects.courseCode;
                            ";

                            // Execute the query
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $grade = htmlspecialchars($row['grade'] ?: '');
                    ?>
                    <a href="#" class="list-group-item list-group-item-action">
                        <h6 class="list-group-item-heading">
                            <strong><?php 
                                if(isset($row['courseCode']) && $row['courseCode'] != '') {
                                    if(isset($row['mapeh_name']) && $row['mapeh_name'] != '') {
                                        echo $row['courseCode'] . ' - ' . $row['mapeh_name'];
                                    } else {
                                        echo $row['courseCode'] . ' - ' . $row['courseTitle'];
                                    }
                                } else {
                                    echo isset($row['courseTitle']) ? $row['courseTitle'] : '-';
                                }
                                ?></strong>
                        </h6>
                        <p class="mb-0 text-uppercase"><?= strtoupper(htmlspecialchars($row['rank'] ?: '')) ?> <?= strtoupper(htmlspecialchars($row['firstName'] ?: '-')) ?> <?= !empty($row['middleName']) ? strtoupper(htmlspecialchars($row['middleName'][0])) . '. ' : ''; ?><?= strtoupper(htmlspecialchars($row['lastName'] ?: '-')) ?></p>
                        <p class="list-group-item-text">
                            <?= $grade; ?>
                            <span class="text-success"><?php if ($grade >= 75): ?>
                                <span class="text-success"><i class="bi bi-check-lg"></i></span>
                            <?php else: ?>
                                <span class="text-danger"><i class="bi bi-x-lg"></i></span>
                            <?php endif; ?></i></span>
                        </p>
                    </a>
                    <?php
                                    }
                                } else {
                                    echo "<h5 class='text-center mt-3'>No Record Found</h5>";
                                }
                            } else {
                                echo "Error: " . htmlspecialchars(mysqli_error($conn));
                            }
                        } else {
                            echo "<h5 class='text-center mt-3'>Class ID and School Year ID are required.</h5>";
                        }
                    ?>

                    
                   <?php
                    $student_id = $_SESSION['user_id'];
                    if (isset($class_id) && isset($school_year_id)) {
                        // Escape the parameters to prevent SQL injection
                        $class_id = mysqli_real_escape_string($conn, $class_id);
                        $school_year_id = mysqli_real_escape_string($conn, $school_year_id);

                        // Construct the SQL query to fetch MAPEH subjects only
                        $query = "SELECT 
                            AVG(subject_grades.$grade_column) AS average_grade,
                            subjects.courseCode,
                            subjects.courseTitle,
                            faculty.firstName,
                            faculty.middleName,
                            faculty.lastName,
                            loads.mapeh_name
                        FROM 
                            subject_grades
                        JOIN 
                            loads ON subject_grades.load_id = loads.id
                        JOIN 
                            subjects ON loads.subject_id = subjects.id
                        JOIN 
                            faculty ON loads.faculty_id = faculty.id
                        WHERE 
                            subject_grades.student_id = '$student_id' 
                            AND subject_grades.school_year_id = '$school_year_id'
                            AND loads.class_id = '$class_id'
                            AND subjects.courseCode LIKE '%MAPEH%'
                        GROUP BY
                            subjects.courseCode;"; // Grouping by course code to get distinct MAPEH subjects

                        // Execute the query
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $grade = round($row['average_grade']);
                                
                                // Don't display if grade is zero or below and not MAPEH subject
                                if ($grade > 0) {
                    ?>
                        <a href="#" class="list-group-item list-group-item-action">
                            <h6 class="list-group-item-heading">
                                <strong><?= htmlspecialchars($row['courseCode'] ?: ''); ?> - <?= htmlspecialchars($row['courseTitle'] ?: ''); ?></strong>
                            </h6>
                            <p class="list-group-item-text"><?= strtoupper(ucwords($row['lastName'] . ', ' . $row['firstName'] . ' ' . $row['middleName']) ?: ''); ?></p>
                            <p class="list-group-item-text">
                                <?= $grade; ?>
                                <span class="text-success">
                                    <?php if ($grade >= 75): ?>
                                        <span class="text-success"><i class="bi bi-check-lg"></i></span>
                                    <?php else: ?>
                                        <span class="text-danger"><i class="bi bi-x-lg"></i></span>
                                    <?php endif; ?>
                                </span>
                            </p>
                        </a>
                     <?php
                                }
                            }
                            
                            // If no rows were displayed, show message
                            if (mysqli_num_rows($result) == 0) {
                                // echo "<h5 class='text-center mt-3'>No MAPEH Subjects Found</h5>";
                            }
                        } else {
                            echo "Error: " . htmlspecialchars(mysqli_error($conn));
                        }
                    } else {
                        echo "<h5 class='text-center mt-3'>Class ID and School Year ID are required.</h5>";
                    }
                    ?>

                                           


                    </div>

                  </div>
                  <!-- End Home Tab Content -->

                  <!-- Start Home Tab Content -->
                  <div class="tab-pane fade" id="grade-table-view" role="tabpanel" aria-labelledby="grade-table-view-tab">
                      
                      <div class="table-responsive mt-3">
                        <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                            <thead>
                                <tr class="text-left" style="white-space: nowrap;">
                                    <th scope="col">Code</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Grade</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th scope="col">Instructor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $student_id = $_SESSION['user_id'];
                                if (isset($class_id) && isset($school_year_id)) {
                                    // Escape the parameters to prevent SQL injection
                                    $class_id = mysqli_real_escape_string($conn, $class_id);
                                    $school_year_id = mysqli_real_escape_string($conn, $school_year_id);

                                    // Determine which quarter grade to display based on the value of $quarter
                                    $grade_column = '';
                                    switch ($quarter) {
                                        case 1:
                                            $grade_column = 'q1_grade';
                                            break;
                                        case 2:
                                            $grade_column = 'q2_grade';
                                            break;
                                        case 3:
                                            $grade_column = 'q3_grade';
                                            break;
                                        case 4:
                                            $grade_column = 'q4_grade';
                                            break;
                                        default:
                                            echo "<h5 class='text-center mt-3'>Invalid Quarter</h5>";
                                            exit;
                                    }

                                    // Construct the SQL query
                                     $query = "
                                        SELECT 
                                            subject_grades.$grade_column AS grade, 
                                            subjects.courseCode,
                                            subjects.courseTitle,
                                            faculty.firstName,
                                            faculty.middleName,
                                            faculty.lastName,
                                            faculty.rank,
                                            loads.mapeh_name
                                        FROM 
                                            subject_grades
                                        JOIN 
                                            loads ON subject_grades.load_id = loads.id
                                        JOIN 
                                            subjects ON loads.subject_id = subjects.id
                                        JOIN 
                                            faculty ON loads.faculty_id = faculty.id
                                        WHERE 
                                            subject_grades.student_id = '$student_id' 
                                            AND subject_grades.school_year_id = '$school_year_id'
                                            AND loads.class_id = '$class_id'
                                            AND subjects.courseCode NOT LIKE '%MAPEH%'
                                        ORDER BY 
                                            subjects.courseCode;
                                    ";


                                    // Execute the query
                                    $result = mysqli_query($conn, $query);

                                    if ($result) {
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $grade = htmlspecialchars($row['grade'] ?: '');
                                ?>
                                                <tr class="small" style="white-space: nowrap;">
                                                    <td class="text-left"><?= htmlspecialchars($row['courseCode'] ?: ''); ?></td>
                                                    <td class="text-left"><?= !empty($row['mapeh_name']) ? htmlspecialchars($row['mapeh_name']) : htmlspecialchars($row['courseTitle'] ?: ''); ?></td>
                                                    <td class="text-center"><?= $grade; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($grade >= 75): ?>
                                                            <span class="text-success"><i class="bi bi-check-lg"></i></span>
                                                        <?php else: ?>
                                                            <span class="text-danger"><i class="bi bi-x-lg"></i></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-left"><?= strtoupper(htmlspecialchars($row['rank'] ?: '')) ?> <?= strtoupper(htmlspecialchars($row['firstName'] ?: '-')) ?> <?= !empty($row['middleName']) ? strtoupper(htmlspecialchars($row['middleName'][0])) . '. ' : ''; ?><?= strtoupper(htmlspecialchars($row['lastName'] ?: '-')) ?></td>
                                                </tr>
                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center mt-3'>No Record Found</td></tr>";
                                        }
                                    } else {
                                        echo "Error: " . htmlspecialchars(mysqli_error($conn));
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center mt-3'>No Record Found</td></tr>";
                                }
                                ?>

                               <?php
                                $student_id = $_SESSION['user_id'];
                                if (isset($class_id) && isset($school_year_id)) {
                                    // Escape the parameters to prevent SQL injection
                                    $class_id = mysqli_real_escape_string($conn, $class_id);
                                    $school_year_id = mysqli_real_escape_string($conn, $school_year_id);

                                    // Construct the SQL query to fetch MAPEH subjects only
                                    $query = "SELECT 
                                        AVG(subject_grades.$grade_column) AS average_grade,
                                        subjects.courseCode,
                                        subjects.courseTitle,
                                        faculty.firstName,
                                        faculty.middleName,
                                        faculty.lastName,
                                        faculty.rank,
                                        loads.mapeh_name
                                    FROM 
                                        subject_grades
                                    JOIN 
                                        loads ON subject_grades.load_id = loads.id
                                    JOIN 
                                        subjects ON loads.subject_id = subjects.id
                                    JOIN 
                                        faculty ON loads.faculty_id = faculty.id
                                    WHERE 
                                        subject_grades.student_id = '$student_id' 
                                        AND subject_grades.school_year_id = '$school_year_id'
                                        AND loads.class_id = '$class_id'
                                        AND subjects.courseCode LIKE '%MAPEH%'
                                    GROUP BY
                                        subjects.courseCode;"; // Grouping by course code to get distinct MAPEH subjects

                                    // Execute the query
                                    $result = mysqli_query($conn, $query);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $grade = round($row['average_grade']);
                                            
                                            // Don't display if grade is zero or below and not MAPEH subject
                                            if ($grade > 0) {
                                ?>
                                                <tr class="small" style="white-space: nowrap;">
                                                    <td class="text-left"><?= htmlspecialchars($row['courseCode'] ?: ''); ?></td>
                                                    <td class="text-left"><?= htmlspecialchars($row['courseTitle'] ?: ''); ?></td>
                                                    <td class="text-center"><?= $grade; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($grade >= 75): ?>
                                                            <span class="text-success"><i class="bi bi-check-lg"></i></span>
                                                        <?php else: ?>
                                                            <span class="text-danger"><i class="bi bi-x-lg"></i></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-left"><?= strtoupper(htmlspecialchars($row['rank'] ?: '')) ?> <?= strtoupper(htmlspecialchars($row['firstName'] ?: '-')) ?> <?= !empty($row['middleName']) ? strtoupper(htmlspecialchars($row['middleName'][0])) . '. ' : ''; ?><?= strtoupper(htmlspecialchars($row['lastName'] ?: '-')) ?></td>
                                                </tr>
                                <?php
                                            }
                                        }
                                        
                                        // If no rows were displayed, show message
                                        if (mysqli_num_rows($result) == 0) {
                                            // echo "<h5 class='text-center mt-3'>No MAPEH Subjects Found</h5>";
                                        }
                                    } else {
                                        echo "Error: " . htmlspecialchars(mysqli_error($conn));
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center mt-3'>No Record Found</td></tr>";
                                }
                                ?>




                            </tbody>
                        </table>
                    </div>


                  </div>
                  <!-- End Home Tab Content -->
                </div>
                <!-- Tab content -->