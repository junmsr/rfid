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
                    <a href="">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Faculties</span>
                    </a>
                </li>
                <li>
                    <a href="">
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
            <div class="new">
                <button class="add-new" id="new-faculty"><ion-icon name="person-add-outline"></ion-icon>New</button>
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
                        <th>Setting</th>
                    </tr>
                </thead>

                <?php
                    $conn = mysqli_connect("localhost", "root", "", "attendance");
                    if(!$conn){
                        die("Connection failed: ".$conn-> connect_error);
                    }
                    $sql = "SELECT rfid, role, surname, fname, contact, gender from logs";
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
        
        <div class="container-form" id="container-form">
            <div class="close-btn" id="close-btn">&times;</div>
            <form  method="POST" id="form">
                <div class="title-form">Add Faculty</div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details" id="rfid">ID tag</span>
                        <input type="text" id="rfid-tag" placeholder="ID tag" name="rfid-tag" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Role</span>
                        <input type="text" id="role" placeholder="Role" name="role" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Surname</span>
                        <input type="text" id="surname" placeholder="Enter your Surname" name="surname" required>
                    </div>
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" id="fname" placeholder="Enter your First Name" name="fname" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Contact No.</span>
                        <input type="text" id="contact" placeholder="Contact Number" name="contact" required>
                    </div>
                </div>
                <div class="gender-details">
                    <input type="radio" name="gender" id="dot-1" value="male">
                    <input type="radio" name="gender" id="dot-2" value="female">
                    <input type="radio" name="gender" id="dot-3" value="n/a">
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">Prefer not to say</span>
                        </label>
                    </div>
                    <div class="button-reg">
                        <input type="submit" id="register" value="Register">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="response"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $("#register").click(function() {
            $.ajax({
                url: "logs.php",
                type: "POST",
                data: $("#form").serialize(),
                success: function(response) {
                    console.log("Server Response: ", response); // Log response for debugging
                    $("#response").html(response);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", error);
                    console.error("XHR Response: ", xhr.responseText); // Log server response
                }
            });
        });
    </script>
    
    <script src="faculty.js"></script>
    <script src="../admin/admin.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>