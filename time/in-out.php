<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFID Lookup</title>
    <link rel="stylesheet" href="in-out.css"> <!-- Link to your CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Attendance</h1>
    
    <!-- Real-time Date and Time -->
    <div id="datetime-container">
        <p><strong>Date:</strong> <span id="current-date"></span></p>
        <p><strong>Time:</strong> <span id="current-time"></span></p>
    </div>

    <!-- Input for RFID -->
    <label for="rfid-tag" class="label-tag">Enter RFID Tag:</label>
    <input type="text" id="rfid-tag" name="rfid-tag" placeholder="Scan or Enter RFID">
    
    <!-- Output Fields -->
    <div id="output">
        <p><strong>Role:</strong> <span id="role"></span></p>
        <p><strong>Surname:</strong> <span id="surname"></span></p>
        <p><strong>First Name:</strong> <span id="fname"></span></p>
        <p><strong>Contact:</strong> <span id="contact"></span></p>
        <p><strong>Gender:</strong> <span id="gender"></span></p>
        <p><strong>Time in:</strong> <span id="time"></span></p>
    </div>
    <script src="time.js"></script>
    <script>
        // Real-time Date and Time Script
        function updateDateTime() {
            const now = new Date();
            const date = now.toLocaleDateString(); // Format: MM/DD/YYYY
            const time = now.toLocaleTimeString(); // Format: HH:MM:SS AM/PM
            document.getElementById('current-date').textContent = date;
            document.getElementById('current-time').textContent = time;
        }

        // Update the time every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Call once to initialize immediately

        // RFID Lookup AJAX Script
        $(document).ready(function() {
            $("#search").click(function() {
                var rfid = $("#rfid-tag").val(); // Get RFID input value
                
                // Send AJAX request
                $.ajax({
                    url: "fetch.php", // Path to the PHP script
                    type: "POST",
                    data: { rfid_tag: rfid }, // Send RFID as data
                    success: function(response) {
                        try {
                            var data = JSON.parse(response); // Parse JSON response
                            if (data.success) {
                                // Populate output fields
                                $("#role").text(data.role);
                                $("#surname").text(data.surname);
                                $("#fname").text(data.fname);
                                $("#contact").text(data.contact);
                                $("#gender").text(data.gender);
                            } else {
                                alert(data.message);
                            }
                        } catch (e) {
                            console.error("Error parsing response: ", e);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", error);
                    }
                });
            });
        });
    </script>
</body>
</html>
