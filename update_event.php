<?php

// Include the database connection file
require 'DB_Con_For_1.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the event ID and other data from the form submission
    $update_id = $_POST['update_id'];
    $event_date = $_POST['event_date'];
    $event_venue = $_POST['event_venue'];
    $race_coordinator = $_POST['race_coordinator'];
    $podium_positions = $_POST['podium_positions'];
    $team_name = $_POST['team_name'];
    $team_leader = $_POST['team_leader'];
    $nationality = $_POST['nationality'];
    $race_time = $_POST['race_time'];

    // Prepare a SQL query to update the event based on the event ID
    $sql = "UPDATE events SET EventDate = ?, EventVenue = ?, RaceCoordinator = ?, PodiumPositions = ?, team_name = ?, team_leader = ?, nationality = ?, race_time = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the event ID and other data to the statement
        $stmt->bind_param("ssssssssi", $event_date, $event_venue, $race_coordinator, $podium_positions, $team_name, $team_leader, $nationality, $race_time, $update_id);

        // Execute the statement and check if the update was successful
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo '<script>alert("Event updated successfully.");window.location.href = "manage_race.html";</script>';
            } else {
                echo '<script>alert("No event found with ID: ");window.location.href = "manage_race.html";</script>' . htmlspecialchars($update_id);
            }
        } else {
            echo "Error executing statement: " . htmlspecialchars($stmt->error);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . htmlspecialchars($conn->error);
    }
}

// Close the database connection
$conn->close();

