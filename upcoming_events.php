<?php

require 'DB_Con_For_1.php';

// Initialize variables with default values
$id = $_POST['id'] ?? null;
$EventDate = $_POST['EventDate'] ?? null;
$EventVenue = $_POST['EventVenue'] ?? null;
$PodiumPosition = $_POST['PodiumPosition'] ?? null;
$RaceCoordinator = $_POST['RaceCoordinator'] ?? null;

// Check if all the required form data is present
if ($id === null || $EventDate === null || $EventVenue === null || $PodiumPosition === null || $RaceCoordinator === null) {
    echo "Missing required form data. Please fill in all fields.";
} else {
    // Call the function to add the event
    addEvent($conn, $id, $EventDate, $EventVenue, $RaceCoordinator, $PodiumPosition);

    // Redirect to a success page or display a success message
    echo "Event added successfully!";
}

