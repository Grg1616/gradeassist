<tr class="text-center small" style="white-space: nowrap;">
                    <td class=""><?php echo $no; ?></td>
                    <td class="text-start"><?php echo $row_student['sr_code']; ?></td>
                    <td class="text-start"><?php
                        echo ucwords(strtolower($row_student['lastName'])) . ', ' .
                            ucwords(strtolower($row_student['firstName'])) .
                            (!empty($row_student['middleName']) ? ' ' . ucwords(substr($row_student['middleName'], 0, 1)) . '.' : '');
                        ?>
                    </td>
                    <td class="text-center">

              <?php
                // Check if there are existing records in observe_values_k
                $existing_records_query = "SELECT * FROM observe_values_k WHERE 
                                            value BETWEEN 1 AND 15 AND 
                                            student_id = '$student_id' AND 
                                            class_id = '$class_id' AND 
                                            school_year_id = '$school_year'";

                $result = $conn->query($existing_records_query);

                if ($result->num_rows > 0) {
                    // Existing records found, do not insert new values
                } else {
                    // No existing records found, proceed with insertion
                    // Define the observed values array
                    $values = [];
                    for ($i = 1; $i <= 15; $i++) {
                        // Insert "AO" for each quarter for each value column
                        $values[] = "($i, 'AO', 'AO', 'AO', 'AO', '$student_id', '$class_id', '$school_year')";
                    }
                    
                    // Prepare SQL insert statement
                    $sql = "INSERT INTO observe_values_k (value, quarter_1, quarter_2, quarter_3, quarter_4, student_id, class_id, school_year_id) VALUES ";
                    $sql .= implode(',', $values);
                    
                    // Execute the SQL insert statement
                    if ($conn->query($sql) === TRUE) {
                        // echo "Observed values inserted successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                ?>

<?php
// Associative array mapping values to their text equivalents
$value_text_equivalents = [
    1 => "Exercises good health habits",
    2 => "Dresses up independently",
    3 => "Eats without help",
    4 => "Uses toilet independently",
    5 => "Interacts with teachers, peers and other people",
    6 => "Completes tasks willingly",
    7 => "Plays cooperatively",
    8 => "Participates actively in manipulative activities",
    9 => "Follows rules and routines",
    10 => "Accepts simple responsibilities",
    11 => "Says simple prayers",
    12 => "Shows concern for others",
    13 => "Cares for plants and animals",
    14 => "Accepts criticism",
    15 => "Waits for one’s turn"
];
?>

<form action="crud_observe.php" method="POST">
    <div class="accordion" id="accordion_<?php echo $student_id; ?>">
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading_<?php echo $student_id; ?>">
                <button class="accordion-button p-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $student_id; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $student_id; ?>">
                    Learner's Observed Values
                </button>
            </h2>
            <div id="collapse_<?php echo $student_id; ?>" class="accordion-collapse collapse" aria-labelledby="heading_<?php echo $student_id; ?>" data-bs-parent="#accordion_<?php echo $student_id; ?>">
                <div class="accordion-body p-0">
                    <!-- Inside the accordion-body div -->
                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                    <input type="hidden" name="load_id" value="<?php echo $load_id; ?>">
                    <input type="hidden" name="school_year" value="<?php echo $school_year; ?>">
                    <table class="table table-sm table-hover table-bordered mb-0" style="width: 100%;">
                        <thead>
                            <tr style="white-space: nowrap;">
                                <th class="text-start">Observe Values</th>
                                <th class="text-center">Quarter 1</th>
                                <th class="text-center">Quarter 2</th>
                                <th class="text-center">Quarter 3</th>
                                <th class="text-center">Quarter 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Initialize flags
                            $added_personal_social_heading = false;
                            $added_affective_development_heading = false;

                            // Fetch data from the database
                            $fetch_query = "SELECT * FROM observe_values_k WHERE 
                                value BETWEEN 1 AND 15 AND 
                                student_id = '$student_id' AND 
                                class_id = '$class_id' AND 
                                school_year_id = '$school_year'";
                            $result = $conn->query($fetch_query);

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    // Display the row data with input fields for each quarter
                                    if ($row['value'] == 1 && !$added_personal_social_heading) {
                                        echo "<tr><td colspan='5' class='text-center'>PERSONAL – SOCIAL DEVELOPMENT</td></tr>";
                                        $added_personal_social_heading = true;
                                    }

                                    if ($row['value'] == 11 && !$added_affective_development_heading) {
                                        echo "<tr><td colspan='5' class='text-center'>AFFECTIVE DEVELOPMENT</td></tr>";
                                        $added_affective_development_heading = true;
                                    }
                                    ?>
                                    <tr style="white-space: nowrap;">
                                        <td class='text-start'><?php echo $value_text_equivalents[$row['value']]; ?></td>
                                        <td><input class="input" size="1" style="text-align: center;" type="text" name="quarter_1_<?php echo $row['value']; ?>" value="<?php echo $row['quarter_1']; ?>"></td>
                                        <td><input class="input" size="1" style="text-align: center;" type="text" name="quarter_2_<?php echo $row['value']; ?>" value="<?php echo $row['quarter_2']; ?>"></td>
                                        <td><input class="input" size="1" style="text-align: center;" type="text" name="quarter_3_<?php echo $row['value']; ?>" value="<?php echo $row['quarter_3']; ?>"></td>
                                        <td><input class="input" size="1" style="text-align: center;" type="text" name="quarter_4_<?php echo $row['value']; ?>" value="<?php echo $row['quarter_4']; ?>"></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                // No records found
                                echo "<tr><td colspan='5'>No records found.</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                    <button type="submit" name="edit_observe_k" class="btn btn-sm btn-success my-2" style="padding: 5px 10px;" <?php if ($is_submitted) echo 'disabled'; ?>>
                        <i class="bi bi-save"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

</tr>