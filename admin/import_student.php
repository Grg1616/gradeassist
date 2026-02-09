<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {

    require '../db_conn.php';

    // Updated expected header columns to match Import_Student_template (2).xlsx
    $expectedHeaders = [
        'SR-Code','LRN','First Name','Last Name','Middle Name','Gender','Birthday','Religion','Contact Number','Email Address','Home Address',
        'Fathers Name','Father Occupation','Father Contact','Father Email',
        'Mothers Name','Mother Occupation','Mother Contact','Mother Email',
        'Guardian Name','Guardian Occupation','Guardian Contact','Guardian Email'
    ];

    // Helper: normalize header text
    function normalize_header($h) {
        $h = trim($h);
        $h = strtolower($h);
        $h = preg_replace('/\s+/', ' ', $h);
        return $h;
    }

    // Helper: return SQL literal or NULL for empty values
    function sql_val_or_null($conn, $v) {
        $v = trim($v);
        if ($v === '') return "NULL";
        return "'" . mysqli_real_escape_string($conn, $v) . "'";
    }

    // Simple XLSX reader for basic data (reads first worksheet)
    function read_xlsx($filePath) {
        $zip = new ZipArchive;
        $rows = [];
        if ($zip->open($filePath) === TRUE) {
            // Read shared strings
            $sharedStrings = [];
            if (($s = $zip->getFromName('xl/sharedStrings.xml')) !== false) {
                $xml = simplexml_load_string($s);
                $xml->registerXPathNamespace('a', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
                foreach ($xml->si as $si) {
                    $t = '';
                    if (isset($si->t)) {
                        $t = (string)$si->t;
                    } elseif (isset($si->r)) {
                        foreach ($si->r as $r) {
                            $t .= (string)$r->t;
                        }
                    }
                    $sharedStrings[] = $t;
                }
            }

            // Read first worksheet (sheet1)
            $sheetName = 'xl/worksheets/sheet1.xml';
            if (($sheet = $zip->getFromName($sheetName)) !== false) {
                $xml = simplexml_load_string($sheet);
                $xml->registerXPathNamespace('a', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
                foreach ($xml->sheetData->row as $r) {
                    $row = [];
                    foreach ($r->c as $c) {
                        $v = '';
                        $cellType = (string)$c['t'];
                        if ($cellType === 's') {
                            $idx = (int)$c->v;
                            $v = isset($sharedStrings[$idx]) ? $sharedStrings[$idx] : '';
                        } else {
                            $v = (string)$c->v;
                        }
                        $row[] = $v;
                    }
                    $rows[] = $row;
                }
            }
            $zip->close();
        }
        return $rows;
    }

    if(isset($_FILES['studentFile']) && $_FILES['studentFile']['error'] == 0){
        $filename = $_FILES['studentFile']['name'];
        $tempname = $_FILES['studentFile']['tmp_name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        $rows = [];
        if ($ext === 'csv') {
            if (($handle = fopen($tempname, 'r')) !== false) {
                while (($data = fgetcsv($handle, 0, ',')) !== false) {
                    $rows[] = $data;
                }
                fclose($handle);
            } else {
                $_SESSION['message_danger'] = 'Unable to read uploaded CSV file.';
                header('Location: students.php'); exit();
            }
        } elseif ($ext === 'xlsx') {
            $rows = read_xlsx($tempname);
            if (empty($rows)) {
                $_SESSION['message_danger'] = 'Unable to read uploaded XLSX file or file is empty.';
                header('Location: students.php'); exit();
            }
        } else {
            $_SESSION['message_danger'] = 'Unsupported file type. Please upload a CSV or XLSX file.';
            header('Location: students.php'); exit();
        }

        // Validate header: locate header row within the first few rows (supports header on row 2)
        $headerIndex = null;
        $searchLimit = min(5, count($rows));
        for ($r = 0; $r < $searchLimit; $r++) {
            $candidate = $rows[$r];
            $normalized = array_map('normalize_header', $candidate);
            $normalized = array_slice($normalized, 0, count($expectedHeaders));
            if (count($normalized) < count($expectedHeaders)) continue;

            $match = true;
            for ($i = 0; $i < count($expectedHeaders); $i++) {
                if (normalize_header($expectedHeaders[$i]) !== normalize_header($normalized[$i])) {
                    $match = false;
                    break;
                }
            }
            if ($match) { $headerIndex = $r; break; }
        }

        if ($headerIndex === null) {
            $_SESSION['message_danger'] = 'Invalid header format. Please use the correct Import_Student_template.xlsx.';
            header('Location: students.php'); exit();
        }

        // Remove rows up to and including header row; remaining rows are data
        $dataRows = array_slice($rows, $headerIndex + 1);
        $rows = $dataRows;

        $skippedRecords = [];
        $inserted = false;

        foreach ($rows as $data) {
            // Ensure we have at least expected columns
            $data = array_slice($data, 0, count($expectedHeaders));
            // Skip empty rows
            $allEmpty = true;
            foreach ($data as $cell) { if (trim($cell) !== '') { $allEmpty = false; break; } }
            if ($allEmpty) continue;

            // Map columns by index for clarity - NOW MATCHING THE EXCEL FILE COLUMNS
            $sr_code = isset($data[0]) ? mysqli_real_escape_string($conn, trim($data[0])) : '';
            $lrn = isset($data[1]) ? mysqli_real_escape_string($conn, trim($data[1])) : '';
            $firstName = isset($data[2]) ? ucwords(strtolower(trim($data[2]))) : '';
            $lastName = isset($data[3]) ? ucwords(strtolower(trim($data[3]))) : '';
            $middleName = isset($data[4]) ? ucwords(strtolower(trim($data[4]))) : '';
            $gender = isset($data[5]) ? ucwords(strtolower(trim($data[5]))) : '';
            $birthday_raw = isset($data[6]) ? trim($data[6]) : '';
            $religion = isset($data[7]) ? ucwords(strtolower(trim($data[7]))) : '';
            $contact = isset($data[8]) ? mysqli_real_escape_string($conn, trim($data[8])) : '';
            $email = isset($data[9]) ? mysqli_real_escape_string($conn, trim($data[9])) : '';
            $homeAddress = isset($data[10]) ? ucwords(strtolower(trim($data[10]))) : '';
            
            // Father details
            $fatherName = isset($data[11]) ? ucwords(strtolower(trim($data[11]))) : '';
            $fatherOccupation = isset($data[12]) ? ucwords(strtolower(trim($data[12]))) : '';
                $fatherContact = isset($data[13]) ? trim($data[13]) : '';
                $fatherEmail = isset($data[14]) ? trim($data[14]) : '';
            
            // Mother details
            $motherName = isset($data[15]) ? ucwords(strtolower(trim($data[15]))) : '';
            $motherOccupation = isset($data[16]) ? ucwords(strtolower(trim($data[16]))) : '';
                $motherContact = isset($data[17]) ? trim($data[17]) : '';
                $motherEmail = isset($data[18]) ? trim($data[18]) : '';
            
            // Guardian details
            $guardianName = isset($data[19]) ? ucwords(strtolower(trim($data[19]))) : '';
            $guardianOccupation = isset($data[20]) ? ucwords(strtolower(trim($data[20]))) : '';
                $guardianContact = isset($data[21]) ? trim($data[21]) : '';
                $guardianEmail = isset($data[22]) ? trim($data[22]) : '';

            // Normalize birthday to YYYY-MM-DD if possible
            $birthday = null;
            if ($birthday_raw !== '') {
                $ts = strtotime(str_replace('/', '-', $birthday_raw));
                if ($ts !== false) $birthday = date('Y-m-d', $ts);
            }

            if ($sr_code === '') continue;

            // Check if sr_code already exists
            $check_sql = "SELECT COUNT(*) AS count FROM students WHERE sr_code = '" . mysqli_real_escape_string($conn, $sr_code) . "'";
            $result = $conn->query($check_sql);
            $row = $result->fetch_assoc();

            if ($row['count'] == 0) {
                $birthday_val = $birthday ? "'" . $birthday . "'" : "NULL";

                    // Prepare parent/guardian SQL values (NULL when empty)
                    $fatherName_val = sql_val_or_null($conn, $fatherName);
                    $fatherOccupation_val = sql_val_or_null($conn, $fatherOccupation);
                    $fatherContact_val = sql_val_or_null($conn, $fatherContact);
                    $fatherEmail_val = sql_val_or_null($conn, $fatherEmail);

                    $motherName_val = sql_val_or_null($conn, $motherName);
                    $motherOccupation_val = sql_val_or_null($conn, $motherOccupation);
                    $motherContact_val = sql_val_or_null($conn, $motherContact);
                    $motherEmail_val = sql_val_or_null($conn, $motherEmail);

                    $guardianName_val = sql_val_or_null($conn, $guardianName);
                    $guardianOccupation_val = sql_val_or_null($conn, $guardianOccupation);
                    $guardianContact_val = sql_val_or_null($conn, $guardianContact);
                    $guardianEmail_val = sql_val_or_null($conn, $guardianEmail);
                $sql = "INSERT INTO students 
                    (sr_code, lrn, firstName, middleName, lastName, gender, birthday, religion, contactNumber, email, homeAddress,
                     fatherName, fatherOccupation, fatherContact, fatherEmail,
                     motherName, motherOccupation, motherContact, motherEmail,
                     guardianName, guardianOccupation, guardianContact, guardianEmail)
                    VALUES 
                    ('" . mysqli_real_escape_string($conn, $sr_code) . "', 
                     '" . mysqli_real_escape_string($conn, $lrn) . "', 
                     '" . mysqli_real_escape_string($conn, $firstName) . "', 
                     '" . mysqli_real_escape_string($conn, $middleName) . "', 
                     '" . mysqli_real_escape_string($conn, $lastName) . "',
                     '" . mysqli_real_escape_string($conn, $gender) . "', 
                     " . $birthday_val . ", 
                     '" . mysqli_real_escape_string($conn, $religion) . "', 
                     '" . mysqli_real_escape_string($conn, $contact) . "', 
                     '" . mysqli_real_escape_string($conn, $email) . "', 
                     '" . mysqli_real_escape_string($conn, $homeAddress) . "',
                     " . $fatherName_val . ", 
                     " . $fatherOccupation_val . ", 
                     " . $fatherContact_val . ", 
                     " . $fatherEmail_val . ",
                     " . $motherName_val . ", 
                     " . $motherOccupation_val . ", 
                     " . $motherContact_val . ", 
                     " . $motherEmail_val . ", 
                     " . $guardianName_val . ",
                     " . $guardianOccupation_val . ", 
                     " . $guardianContact_val . ", 
                     " . $guardianEmail_val . ")";

                if ($conn->query($sql) !== TRUE) {
                    // Log or collect error (but continue processing other rows)
                    error_log("Error importing student $sr_code: " . $conn->error);
                } else {
                    $inserted = true;
                    $id = mysqli_insert_id($conn);

                    $sr_code_numeric = preg_replace('/[^0-9]/', '', $sr_code);
                    $student_password = $sr_code_numeric . strtoupper(substr($firstName, 0, 1)) . strtoupper(substr($lastName, 0, 1));
                    $student_hash_password = md5($student_password);
                    $parent_password = $sr_code_numeric;
                    $parent_hash_password = md5($parent_password);

                    $userTypeStudent = 'student';
                    $userTypeParent = 'parent';

                    $query_student = "INSERT INTO users (username, password, email, userType, user_id, status, online_status) VALUES ('" . mysqli_real_escape_string($conn, $sr_code) . "', '$student_hash_password', '" . mysqli_real_escape_string($conn, $email) . "', '$userTypeStudent', '$id', 'enabled', 'offline')";
                    $result_student = mysqli_query($conn, $query_student);

                    $query_parent = "INSERT INTO users (username, password, email, userType, user_id, status, online_status) VALUES ('" . mysqli_real_escape_string($conn, $sr_code) . "', '$parent_hash_password', '" . mysqli_real_escape_string($conn, $email) . "', '$userTypeParent', '$id', 'enabled', 'offline')";
                    $result_parent = mysqli_query($conn, $query_parent);
                }
            } else {
                $skippedRecords[] = $sr_code;
            }
        }

        if ($inserted) {
            $_SESSION['message'] = 'Students data has been imported successfully!';
            if (!empty($skippedRecords)) {
                $_SESSION['message_ok'] = 'Some records were skipped because they already exist: ' . implode(', ', $skippedRecords);
            }
        } else {
            if (!empty($skippedRecords)) {
                $_SESSION['message_danger'] = 'No new records were imported. Skipped: ' . implode(', ', $skippedRecords);
            } else {
                $_SESSION['message_danger'] = 'No records were imported.';
            }
        }

        header('Location: students.php');
        exit();
    } else {
        $_SESSION['message_danger'] = 'Error uploading file.';
        header('Location: students.php');
        exit();
    }
} else {
    header('Location: ../admin_login.php');
    exit();
}
?>