<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/dashboard.css">
    <title>Document</title>
</head>
<body>
    <div class="container" id="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="">
                        <span class="icon">
                            <ion-icon name="cloudy-night-outline"></ion-icon>
                        </span>
                        <span class="title">Admin Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../admin/admin.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="faculties.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Faculties</span>
                    </a>
                </li>
                <li>
                    <a href="attendance.php">
                        <span class="icon">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">Attendance Log</span>
                    </a>
                </li>
                <li>
                    <a href="../main/index.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="grid-outline"></ion-icon>
            </div>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>RFID</th>
                        <th>Role</th>
                        <th>Surname</th>
                        <th>First Name</th>
                        <th>Contact #</th>
                        <th>Gender</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <?php
                    $conn = mysqli_connect("localhost", "root", "", "attendance");
                    if(!$conn){
                        die("Connection failed: ".$conn-> connect_error);
                    }
                    $sql = "SELECT rfid, role, surname, fname, contact, gender,  time_in, time_out, date_in from attendance";
                    $result = $conn-> query($sql);

                    if($result-> num_rows > 0){
                        while($row = $result-> fetch_assoc()){
                            echo"<tbody>
                    <tr>
                        <td>".$row["rfid"]."</td>
                        <td>".$row["role"]."</td>
                        <td>".$row["surname"]."</td>
                        <td>".$row["fname"]."</td>
                        <td>".$row["contact"]."</td>
                        <td>".$row["gender"]."</td>
                        <td>".$row["time_in"]."</td>
                        <td>".$row["time_out"]."</td>
                        <td>".$row["date_in"]."</td>
                    </tr>
                </tbody>";
                        }
                    }
                ?>
                <!-- <tbody>
                    <tr>
                        <td data-label="RFID" id="rfid-tb"></td>
                        <td data-label="Role" id="role-tb"></td>
                        <td data-label="Surname" id="surname-tb"></td>
                        <td data-label="First Name" id="fname-tb"></td>
                        <td data-label="Contact #" id="contact-tb"></td>
                        <td data-label="Gender" id="gender-tb"></td>
                        <td data-label="Setting" id="setting-tb"></td>
                    </tr>
                </tbody> -->
            </table>
        </div>
    </div>
    <div id="response"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="faculty.js"></script>
    <script src="../admin/admin.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>