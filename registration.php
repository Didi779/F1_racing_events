<!DOCTYPE html>
<html>
    <head>
        <title>User Registration</title>
        <link rel="stylesheet" href="style.css">
        <script>
            function validateForm() {
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*]).{5,}$/; // At least 5 characters, one number, one special character

                if (username.length < 5) {
                    alert('Username must be at least 5 characters long.');
                    return false;
                }

                if (!passwordPattern.test(password)) {
                    alert('Password must be at least 5 characters long, and contain at least one number and one special character.');
                    return false;
                }

                return true;
            }
        </script>
    </head>
    <body>
        <h2>User Registration</h2>
        <form method="post" action="registration.php" onsubmit="return validateForm();">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required minlength="5"><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="5" pattern="(?=.*[0-9])(?=.*[!@#$%^&*]).{5,}"><br>
            <input type="submit" value="Register">
        </form>
        <br><br>
        <div class="nav-buttons">
            <a href="index.php" class="button">Go Back</a>
        </div>
    </body>
</html>

<?php
require 'DB_Con_For_1.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the input
    if (strlen($username) < 5) {
        echo "<script>alert('Username must be at least 5 characters long.'); window.location.href = 'registration.php';</script>";
        exit;
    }

    // Validate password using regular expression
    if (!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*]).{5,}$/', $password)) {
        echo "<script>alert('Password must be at least 5 characters long, and contain at least one number and one special character.'); window.location.href = 'registration.php';</script>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert the user into the database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        // User registered successfully
        echo "<script>alert('User registered successfully!'); window.location.href = 'login.html';</script>";
    } else {
        // Error registering user
        echo "<script>alert('Error registering user: " . $stmt->error . "'); window.location.href = 'registration.php';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

