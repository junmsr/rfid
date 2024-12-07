<?php
    $rfid = $_POST['rfid-tag'];
    $role = $_POST['role'];
    $surname = $_POST['surname'];
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];

    if(!empty($rfid) || !empty($role) || !empty($surname) || !empty($fname) || !empty($contact) || !empty($gender)){
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "attendance";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

        if($conn->connect_error){
            die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
        } else{
            $SELECT = "SELECT rfid From logs Where rfid = ? Limit 1";
            $INSERT = "INSERT Into logs (rfid, role, surname, fname, contact, gender) values (?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s", $rfid);
            $stmt->execute();
            $stmt->bind_result($rfid);
            $stmt->store_result();
            $rnum = $stmt->num_rows;

            if($rnum == 0){
                $stmt->close();

                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("ssssis", $rfid, $role, $surname, $fname, $contact, $gender);
                $stmt->execute();
                echo '<script>alert("New record has been added!")</script>';
            }else{
                echo '<script>alert("Someone already registered using this ID")</script>';
            }

            $stmt->close();
            $conn->close();
        }
    } else{
        echo '<script>alert("All fields are required!")</script>';
        die();
    }
?>