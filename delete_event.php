<?php

// Include the database connection file
require 'DB_Con_For_1.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the event ID from the form submission
    $delete_id = $_POST['delete_id'];

    // Prepare a SQL query to delete the event based on the event ID
    $sql = "DELETE FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the event ID to the statement and execute it
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();

        // Check if the delete was successful
        if ($stmt->affected_rows > 0) {
            echo '<script>alert("Event deleted successfully.");window.location.href = "manage_race.html";</script>';
        } else {
            echo '<script>alert("No event found with ID: ");window.location.href = "manage_race.html";</script>' . htmlspecialchars($delete_id);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . htmlspecialchars($conn->error);
    }
}

// Close the database connection
$conn->close();

