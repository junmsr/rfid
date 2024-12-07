<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Selection</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="popup.js"></script>
</head>
<body>
    <div class="container" id="box">
        <h1>WELCOME!<br>Select Your Role.</h1>
        <div class="button-group">
            <button id="admin-login" class="role-button admin-button"> <img src="../assets/human.png" width="50vh" height="auto" alt="#"><br>Admin</button><br>
            <button class="role-button user-button" onclick="location.href='../time/in-out.php';" ></a><img src="../assets/group.png" width="50vh" height="auto" alt="#"><br>User</button>
        </div>
    </div>
    <div class="modal">
        <div class="close-btn">&times;</div>
        <div class="form">
            <h2>Admin</h2>
            <div class="form-element">
                <label for="username"><img src="../assets/user.png" width="30px" height="auto" alt=""></label>
                <input type="text" id="username" placeholder="username" required><br>
                <label for="password"><img src="../assets/padlock.png" width="20px" height="auto" alt=""></label>
                <input type="password" id="password" placeholder="password" required>
            </div>
            <div class="form-element">
                <input type="checkbox" id="remember-me">
                <label for="remember-me">Remember me</label>
            </div>
            <div class="form-element">
                <button id="submit">Sign in</button>
            </div>
            <div class="message-box">
                <p id="message"></p>
            </div>
        </div>
    </div>
    <script src="popup.js"></script>
    <script src="../admin/admin.js"></script>
</body>
</html>
