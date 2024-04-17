<?php

require 'DB_Con_For_1.php'; // Include database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user details from the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Create a session to keep the user logged in
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo "Login successful! Welcome, " . $_SESSION['username'];
            // Redirect to the dashboard or other protected area
            header("Location: home.php");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } else {

        echo "<script>alert('Invalid username or password: " . $stmt->error . "'); window.location.href = 'login.html';</script>";

        echo "Invalid username or password.";
    }

    $stmt->close();
}

