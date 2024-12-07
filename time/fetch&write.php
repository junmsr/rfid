<?php
// Database credentials
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "attendance";

// Connect to the database
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Check if RFID tag is provided
if (isset($_POST['rfid_tag']) && !empty($_POST['rfid_tag'])) {
    $rfid = $_POST['rfid_tag'];

    // Prepare the query
    $query = "SELECT role, surname, fname, contact, gender FROM logs WHERE rfid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $rfid);
    $stmt->execute();
    $stmt->store_result();

    // Check if the RFID exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($role, $surname, $fname, $contact, $gender);
        $stmt->fetch();

        // Send success response
        echo json_encode([
            "success" => true,
            "role" => $role,
            "surname" => $surname,
            "fname" => $fname,
            "contact" => $contact,
            "gender" => $gender
        ]);
    } else {
        // RFID not found
        echo json_encode(["success" => false, "message" => "RFID not found in the database."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "No RFID tag provided."]);
}

$conn->close();
?>

