<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

    require '../db_conn.php';

    if(isset($_FILES["csvFile"]) && $_FILES["csvFile"]["error"] == 0){
        $filename = $_FILES["csvFile"]["name"];
        $tempname = $_FILES["csvFile"]["tmp_name"];
        $filetype = $_FILES["csvFile"]["type"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(strtolower($ext) == "csv"){
            // Read the file
            $file = fopen($tempname, "r");
            $header = true; // To skip the header row

            // Initialize variable to accumulate skipped records
            $skippedRecords = array();
            $inserted = false; // Flag to track if any records are inserted

            // Insert data into database
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                if($header) {
                    $header = false;
                    continue;
                }

                // Extract only the first 24 columns
                $data = array_slice($data, 0, 23);

                // Check if sr_code already exists
                $check_sql = "SELECT COUNT(*) AS count FROM students WHERE sr_code = '" . $data[0] . "'";
                $result = $conn->query($check_sql);
                $row = $result->fetch_assoc();

                if($row['count'] == 0) {
                    // Format birthday value from 'MM/DD/YYYY' to 'YYYY-MM-DD'
                    $birthday = date('Y-m-d', strtotime(str_replace('/', '-', $data[6])));
                    $sr_code_numeric = preg_replace('/[^0-9]/', '', $data[0]);
                    $username = $data[0];
                    $email = $data[9];

                    // Format other values
                    $firstName = ucwords(strtolower($data[2]));
                    $middleName = ucwords(strtolower($data[3]));
                    $lastName = ucwords(strtolower($data[4]));
                    $gender = ucwords(strtolower($data[5]));
                    $homeAddress = ucwords(strtolower($data[8]));
                    $religion = ucwords(strtolower($data[10]));
                    $fatherName = ucwords(strtolower($data[11]));
                    $fatherOccupation = ucwords(strtolower($data[12]));
                    $motherName = ucwords(strtolower($data[15])); 
                    $motherOccupation = ucwords(strtolower($data[16])); 
                    $guardianName = ucwords(strtolower($data[19])); 
                    $guardianOccupation = ucwords(strtolower($data[20])); 

                    // If sr_code doesn't exist, insert data
                    $sql = "INSERT INTO students 
                            (sr_code, lrn, firstName, middleName, lastName, gender, birthday, contactNumber, homeAddress, email, religion,
                             fatherName, fatherOccupation, fatherContact, fatherEmail,
                             motherName, motherOccupation, motherContact, motherEmail,
                             guardianName, guardianOccupation, guardianContact, guardianEmail)
                            VALUES 
                            ('" . $data[0] . "', '" . $data[1] . "', '" . $firstName . "', '" . $middleName . "', '" . $lastName . "',
                             '" . $gender . "', '" . $birthday . "', '" . $data[7] . "', '" . $homeAddress . "', '" . $data[9] . "',
                             '" . $religion . "', '" . $fatherName . "', '" . $fatherOccupation . "', '" . $data[13] . "', '" . $data[14] . "',
                             '" . $motherName . "', '" . $motherOccupation . "', '" . $data[17] . "', '" . $data[18] . "', '" . $guardianName . "',
                             '" . $guardianOccupation . "', '" . $data[21] . "', '" . $data[22] . "')";
                    if ($conn->query($sql) !== TRUE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    } else {
                        $inserted = true;
                        // Retrieve the last inserted ID
                        $id = mysqli_insert_id($conn);

                        $student_password = $sr_code_numeric . strtoupper(substr($firstName, 0, 1)) . strtoupper(substr($lastName, 0, 1));

                        $student_hash_password = md5($student_password);

                        $parent_password = $sr_code_numeric;

                        $parent_hash_password = md5($parent_password);

                        $userTypeStudent = "student";
                        $userTypeParent = "parent";

                        // Now, insert into users table with lowercase designation
                       $query_student = "INSERT INTO users (username, password, email, userType, user_id, status, online_status) VALUES ('$username', '$student_hash_password', '$email', '$userTypeStudent', '$id', 'enabled', 'offline')";
                        $result_student = mysqli_query($conn, $query_student);

                        $query_parent = "INSERT INTO users (username, password, email, userType, user_id, status, online_status) VALUES ('$username', '$parent_hash_password', '$email', '$userTypeParent', '$id', 'enabled', 'offline')";
                        $result_parent = mysqli_query($conn, $query_parent);

                    }
                } else {
                    $skippedRecords[] = $data[0];
                }
            }

            fclose($file);

            // Redirect with message
            if ($inserted) {
                $_SESSION['message'] = "Students data has been imported successfully!";
                if (!empty($skippedRecords)) {
                    $_SESSION['message_ok'] .= "Students data has been imported successfully! <br><br> Skip insertion of student records for " . implode(', ', $skippedRecords) . ". They already exist.";
                }
            } else {
                $_SESSION['message_danger_ok'] = "Skipping insertion of student records for " . implode(', ', $skippedRecords) . ". They already exist.";
            }

            header('Location: students.php');
            exit();
        } else {
            $_SESSION['message_danger'] = "Invalid file format. Please upload a CSV file.";
            header('Location: students.php');
            exit();
        }
    } else {
        $_SESSION['message_danger'] = "Error uploading file.";
        header('Location: students.php');
        exit();
    }
} else {
    header("Location: ../admin_login.php");
    exit();
}
?>
