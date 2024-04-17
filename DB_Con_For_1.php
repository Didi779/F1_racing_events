<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "f1_racing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addRaceResults($conn, $event_id, $team_name, $position, $points) {
    $sql = "INSERT INTO results (event_id, team_name, position, points) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isis", $event_id, $team_name, $position, $points);
    $stmt->execute();
    $stmt->close();
}

function addEvent($conn, $id, $EventDate, $EventVenue, $RaceCoordinator, $PodiumPositions, $team_name, $team_leader, $nationality, $race_time) {
    // Prepare the SQL query
    $sql = "INSERT INTO events (id, EventDate, EventVenue, RaceCoordinator, PodiumPositions,team_name,team_leader,nationality,race_time) VALUES (?, ?, ?, ?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared correctly
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        return;
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("issss", $id, $EventDate, $EventVenue, $RaceCoordinator, $PodiumPositions, $team_name, $team_leader, $nationality, $race_time);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Event added successfully.";
    } else {
        echo "Error adding event: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
