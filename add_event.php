<?php

// Include database connection file
require 'DB_Con_For_1.php';

// Retrieve form data from POST request
$id = $_POST['id'];
$EventDate = $_POST['EventDate'];
$EventVenue = $_POST['EventVenue'];
$RaceCoordinator = $_POST['RaceCoordinator'];
$PodiumPositions = $_POST['PodiumPositions'];
$team_name = $_POST['team_name'];
$team_leader = $_POST['team_leader'];
$nationality = $_POST['nationality'];
$race_time = $_POST['race_time'];

// Prepare and bind a SQL statement to insert data into the events table
$stmt = $conn->prepare("INSERT INTO events (id, EventDate, EventVenue, RaceCoordinator, PodiumPositions,team_name,team_leader,nationality,race_time) VALUES (?, ?, ?, ?, ?,?,?,?,?)");
$stmt->bind_param("isssissss", $id, $EventDate, $EventVenue, $RaceCoordinator, $PodiumPositions, $team_name, $team_leader, $nationality, $race_time);

// Execute the prepared statement and check for errors
if ($stmt->execute()) {
    echo '<script>alert("Event added successfully!"); window.location.href = "home.php";</script>';
} else {
    // Error adding event
    echo '<script>alert("Error adding event: ' . $stmt->error . '"); window.location.href = "index.php";</script>';
}

// Close the statement and connection
$stmt->close();
$conn->close();

