<?php
    $rfid = $_POST['rfid-tag'];
    $role = $_POST['role'];
    $surname = $_POST['surname'];
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];

    // Check if required fields are filled
    if (!empty($rfid) && !empty($role) && !empty($surname) && !empty($fname) && !empty($contact) && !empty($gender)) {
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "attendance-system";

        // Establish database connection
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

            // Prepare SQL statements
            $SELECT = "SELECT rfid FROM logs WHERE rfid = ? LIMIT 1";
            $INSERT = "INSERT INTO logs (rfid, roles, surname, fname, contact, gender) VALUES (?, ?, ?, ?, ?, ?)";

            // Prepare SELECT statement
            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s", $rfid); // Assuming RFID is a string
            $stmt->execute();
            $stmt->store_result();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();

                // Prepare INSERT statement
                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("ssssss", $rfid, $role, $surname, $fname, $contact, $gender);
                $stmt->execute();
                echo '<script>alert("New record has been added!")</script>';
            } else {
                echo '<script>alert("Someone already registered using this ID")</script>';
            }
            // Close statement and connection
            $stmt->close();
            $conn->close();
    } else {
        echo '<script>alert("All fields are required!")</script>';
        die();
    }
?>
