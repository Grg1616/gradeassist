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
              // Check if there are existing records in observe_values_sh
              $existing_records_query = "SELECT * FROM observe_values_sh WHERE 
                                          core_value IN (1, 2, 3, 4) AND 
                                          behavior_statement IN (1, 2, 3, 4, 5, 6, 7) AND 
                                          student_id = '$student_id' AND 
                                          class_id = '$class_id' AND 
                                          school_year_id = '$school_year'";

              $result = $conn->query($existing_records_query);

              if ($result->num_rows > 0) {
                  // Existing records found, do not insert new values
              } else {
                  // No existing records found, proceed with insertion
                  // Define the observed values array
                  $observed_values = [
                      1 => [
                          'behavior_statements' => ['Expresses one’s spiritual beliefs while respecting the spiritual beliefs of others', 'Shows adherence to ethical principles by upholding truth']
                      ],
                      2 => [
                          'behavior_statements' => ['Is sensitive to individual, social, and cultural differences', 'Demonstrates contributions toward solidarity']
                      ],
                      3 => [
                          'behavior_statements' => ['Cares for the environment and utilizes resources wisely, judiciously, and economically']
                      ],
                      4 => [
                          'behavior_statements' => ['Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen', 'Demonstrates appropriate behavior in carrying out activities in the school, community, and country']
                      ]
                  ];

                  // Define the mapping of behavior statements to numerical values
                  $behavior_statement_mapping = [
                      1 => [1, 2], // For core value 1, behavior statements 1 and 2
                      2 => [3, 4], // For core value 2, behavior statements 3 and 4
                      3 => [5],    // For core value 3, behavior statement 5
                      4 => [6, 7]  // For core value 4, behavior statements 6 and 7
                  ];

                  // Prepare and execute the SQL insert statements
                  foreach ($observed_values as $core_value => $values) {
                      // Get numerical values for behavior statements
                      $numerical_values = $behavior_statement_mapping[$core_value];

                      // Loop through each numerical value and insert into database
                      foreach ($numerical_values as $numerical_value) {
                          $quarter_values = ['AO', 'AO', 'AO', 'AO']; // Default values for quarters 1 to 4
                          $sql = "INSERT INTO observe_values_sh (core_value, behavior_statement, quarter_1, quarter_2, quarter_3, quarter_4, student_id, class_id, school_year_id) VALUES ('$core_value', '$numerical_value', '$quarter_values[0]', '$quarter_values[1]', '$quarter_values[2]', '$quarter_values[3]', '$student_id', '$class_id', '$school_year')";
                          if ($conn->query($sql) !== TRUE) {
                              echo "Error: " . $sql . "<br>" . $conn->error;
                          }
                      }
                  }

                  // echo "Observed values inserted successfully";
              }

              ?>


            <?php
            // Define core values
            $core_values = [
                1 => [
                    'core_values' => ['1. Maka-Diyos']
                ],
                2 => [
                    'core_values' => ['2. Makatao']
                ],
                3 => [
                    'core_values' => ['3. Makakalikasan']
                ],
                4 => [
                    'core_values' => ['4. Makabansa']
                ]
            ];

            // Define behavior statements
            $behavior_statements = [
                1 => [
                    'behavior_statements' => ['Expresses one’s spiritual beliefs<br> while respecting the spiritual beliefs<br> of others']
                ],
                2 => [
                    'behavior_statements' => ['Shows adherence to ethical<br> principles by upholding truth']
                ],
                3 => [
                    'behavior_statements' => ['Is sensitive to individual, social, and<br> cultural differences']
                ],
                4 => [
                    'behavior_statements' => ['Demonstrates contributions toward<br> solidarity']
                ],
                5 => [
                    'behavior_statements' => ['Cares for the environment and<br> utilizes resources wisely, judiciously,<br> and economically']
                ],
                6 => [
                    'behavior_statements' => ['Demonstrates pride in being a <br>Filipino; exercises the rights and<br> responsibilities of a Filipino citizen']
                ],
                7 => [
                    'behavior_statements' => ['Demonstrates appropriate behavior<br> in carrying out activities in the<br> school, community, and country']
                ]
            ];


            $fetch_values_query = "SELECT * FROM observe_values_sh WHERE student_id = '$student_id' AND class_id = '$class_id' AND school_year_id = '$school_year'";
            $fetch_result = $conn->query($fetch_values_query);

            // Define an array to hold observed values
            $observed_values = [];

            // Populate the observed values array
            if ($fetch_result->num_rows > 0) {
                while ($row = $fetch_result->fetch_assoc()) {
                    $core_value = $row['core_value'];
                    $behavior_statement_index = $row['behavior_statement']; // No need to adjust for zero-based indexing
                    $quarter_1 = $row['quarter_1'];
                    $quarter_2 = $row['quarter_2'];
                    $quarter_3 = $row['quarter_3'];
                    $quarter_4 = $row['quarter_4'];

                    // Add observed values to the array
                    if (!isset($observed_values[$core_value])) {
                        $observed_values[$core_value] = [];
                        $observed_values[$core_value]['rowspan'] = 0; // Initialize rowspan count
                    }

                    // Increment rowspan count for the current core value
                    $observed_values[$core_value]['rowspan']++;

                    $observed_values[$core_value]['data'][$behavior_statement_index] = [
                        'behavior_statement' => $behavior_statements[$behavior_statement_index]['behavior_statements'][0], // Assuming there's only one statement per index
                        'quarters' => [$quarter_1, $quarter_2, $quarter_3, $quarter_4]
                    ];
                }
            }
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
                                <input type="hidden" name="quarter" value="<?php echo $quarter; ?>">
                                <table class="table table-sm table-hover table-bordered mb-0" style="width: 100%;">
                                    <thead>
                                        <tr style="white-space: nowrap;">
                                            <th class="text-start">Core Values</th>
                                            <th class="text-start">Behavior Statements</th>
                                            <th class="text-center">Quarter 1</th>
                                            <th class="text-center">Quarter 2</th>
                                            <th class="text-center">Quarter 3</th>
                                            <th class="text-center">Quarter 4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($observed_values as $core_value => $data) : ?>
                                            <?php $rowspan = $data['rowspan']; ?>
                                            <?php foreach ($behavior_statements as $behavior_statement_index => $behavior_statement_data) : ?>
                                                <?php if (isset($data['data'][$behavior_statement_index])) : ?>
                                                    <?php $item = $data['data'][$behavior_statement_index]; ?>
                                                    <tr style="white-space: nowrap;">
                                                        <?php if ($behavior_statement_index === array_key_first($data['data'])) : ?>
                                                            <td rowspan="<?php echo $rowspan; ?>" class="text-start" style="vertical-align: middle;"><?php echo $core_values[$core_value]['core_values'][0]; ?></td>
                                                        <?php endif; ?>
                                                        <td class="text-start"><?php echo $item['behavior_statement']; ?></td>
                                                        <?php for ($ovquarter = 1; $ovquarter <= 4; $ovquarter++) : ?>
                                                            <td class="text-left">
                                                                <select class="form-select form-select-sm" name="quarter_values[<?php echo $core_value; ?>][<?php echo $behavior_statement_index; ?>][<?php echo $ovquarter; ?>]" style="text-align: center;">
                                                                    <option value="AO" <?php echo $item['quarters'][$ovquarter - 1] === 'AO' ? 'selected' : ''; ?>>AO</option>
                                                                    <option value="SO" <?php echo $item['quarters'][$ovquarter - 1] === 'SO' ? 'selected' : ''; ?>>SO</option>
                                                                    <option value="RO" <?php echo $item['quarters'][$ovquarter - 1] === 'RO' ? 'selected' : ''; ?>>RO</option>
                                                                    <option value="NO" <?php echo $item['quarters'][$ovquarter - 1] === 'NO' ? 'selected' : ''; ?>>NO</option>
                                                                </select>
                                                            </td>
                                                        <?php endfor; ?>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <button type="submit" name="edit_observe" class="btn btn-sm btn-success my-2" style="padding: 5px 10px;" <?php if ($is_submitted) echo 'disabled'; ?>>
                                    <i class="bi bi-save"></i> Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
 </tr>