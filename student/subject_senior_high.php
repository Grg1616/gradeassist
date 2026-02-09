<!-- Navigation tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="subject-list-view-tab" data-bs-toggle="tab" data-bs-target="#subject-list-view" type="button" role="tab" aria-controls="subject-list-view" aria-selected="true">
                            <i class="bi bi-list-ul"></i> List View
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="subject-table-view-tab" data-bs-toggle="tab" data-bs-target="#subject-table-view" type="button" role="tab" aria-controls="subject-table-view" aria-selected="false">
                            <i class="bi bi-table"></i> Table View
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="myTabContent">
                    <!-- Start List View Tab Content -->
                    <div class="tab-pane fade show active" id="subject-list-view" role="tabpanel" aria-labelledby="subject-list-view-tab">
                        <!-- PHP code to display data in list view -->
                     <?php
                        if (isset($class_id) && isset($school_year_id)) {
                            // Construct the SQL query with JOIN
                            $query = "SELECT loads.*, subjects.courseCode, subjects.courseTitle, class.gradeLevel, class.section, faculty.rank, faculty.firstName, faculty.middleName, faculty.lastName, faculty.designation 
                                      FROM loads 
                                      JOIN subjects ON loads.subject_id = subjects.id
                                      JOIN class ON loads.class_id = class.id
                                      JOIN faculty ON loads.faculty_id = faculty.id
                                      WHERE loads.class_id = '$class_id' AND loads.school_year_id = '$school_year_id' AND loads.semester = '$semester' ";

                            // Execute the query
                            $query_run = mysqli_query($conn, $query);

                            $subject_ids = array();

                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        if (!in_array($row['subject_id'], $subject_ids)) {
                                            // Add subject_id to the array
                                            $subject_ids[] = $row['subject_id'];

                                            // Fetch user details for the faculty
                                            $user_query = "SELECT * FROM users WHERE user_id = '{$row['faculty_id']}' AND userType = LOWER('{$row['designation']}')";
                                            $user_result = mysqli_query($conn, $user_query);

                                            if ($user_result && mysqli_num_rows($user_result) > 0) {
                                                $user_row = mysqli_fetch_assoc($user_result);

                                                // Check if profile picture exists
                                                $profile_picture = !empty($user_row['image']) ? "../uploads/" . $user_row['image'] : "../assets/img/user.png";
                                                ?>
                                                <div class="card mt-3">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Profile Picture" class="img-thumbnail" width="100" style="width: 100px; height: 100px;">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0"><strong><?= !empty($row['courseCode']) ? htmlspecialchars($row['courseCode']) . ' - ' . htmlspecialchars($row['courseTitle']) : htmlspecialchars($row['courseTitle']); ?></strong></h5>
                                                                    <p class=""><strong><?= htmlspecialchars($row['gradeLevel']) ?: '-'; ?> - <?= htmlspecialchars($row['section']) ?: '-'; ?></strong>  / NASUGBU</p>
                                                                    <p class="mb-0 text-uppercase"><?= strtoupper(htmlspecialchars($row['rank'] ?: '-')) ?> <?= strtoupper(htmlspecialchars($row['firstName'] ?: '-')) ?> <?= !empty($row['middleName']) ? strtoupper(htmlspecialchars($row['middleName'][0])) . '. ' : ''; ?><?= strtoupper(htmlspecialchars($row['lastName'] ?: '-')) ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $no++;
                                            }
                                        }
                                    }
                                } else {
                                    echo "<h5 class='text-center mt-3'>No Record Found</h5>";
                                }
                            } else {
                                echo "Error: " . htmlspecialchars(mysqli_error($conn));
                            }
                        }
                        ?>


                    </div>
                    <!-- End List View Tab Content -->

                    <!-- Start Table View Tab Content -->
                    <div class="tab-pane fade" id="subject-table-view" role="tabpanel" aria-labelledby="subject-table-view-tab">
                        <!-- PHP code to display data in table view -->
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-hover table-bordered" style="width: 100%;">
                                <thead>
                                    <tr class="text-left" style="white-space: nowrap;">
                                        <th scope="col">Code</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Grade Section</th>
                                        <th scope="col">Instructor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($class_id) && isset($school_year_id)) {
                                        // Escape the parameters to prevent SQL injection
                                        $class_id = mysqli_real_escape_string($conn, $class_id);
                                        $school_year_id = mysqli_real_escape_string($conn, $school_year_id);

                                        // Check if the values are not empty
                                        if (!empty($class_id) && !empty($school_year_id)) {
                                            // Construct the SQL query
                                            $query = "SELECT * FROM loads 
                                                      JOIN subjects ON loads.subject_id = subjects.id
                                                      JOIN class ON loads.class_id = class.id
                                                      JOIN faculty ON loads.faculty_id = faculty.id
                                                      WHERE loads.class_id = '$class_id' AND loads.school_year_id = '$school_year_id'AND loads.semester = '$semester' ";

                                            // Execute the query
                                            $result = mysqli_query($conn, $query);

                                            $subject_ids = array();

                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    $no = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        if (!in_array($row['subject_id'], $subject_ids)) {
                                                            // Add subject_id to the array
                                                            $subject_ids[] = $row['subject_id'];
                                    ?>
                                                            <tr class="text-left small" style="white-space: nowrap;">
                                                                <td><?= htmlspecialchars($row['courseCode'] ?: ''); ?></td>
                                                                <td><?= htmlspecialchars($row['courseTitle'] ?: ''); ?></td>
                                                                <td><?= htmlspecialchars($row['gradeLevel'] ?: ''); ?> - <?= htmlspecialchars($row['section'] ?: ''); ?></td>
                                                                <td><?= htmlspecialchars($row['rank'] ?: ''); ?> <?= htmlspecialchars($row['firstName'] ?: ''); ?> <?= !empty($row['middleName']) ? htmlspecialchars($row['middleName'][0] . '. ') : ''; ?><?= htmlspecialchars($row['lastName'] ?: ''); ?></td>
                                                            </tr>
                                    <?php
                                                            $no++;
                                                        }
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='4' class='text-center mt-3'>No Record Found</td></tr>";
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($conn);
                                            }
                                        } else {
                                            echo "<tr><td colspan='4' class='text-center mt-3'>No Record Found</td></tr>";
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Table View Tab Content -->
                </div>
                <!-- Tab content -->