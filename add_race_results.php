<?php

// Include the database connection and functions
require 'DB_Con_For_1.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $event_id = $_POST['event_id'];
    $team_name = $_POST['team_name'];
    $position = $_POST['position'];
    $points = $_POST['points'];

    // Validate the data (you can add additional validation as needed)
    if (is_numeric($event_id) && !empty($team_name) && is_numeric($position) && is_numeric($points)) {
        // Add race results to the database
        addRaceResults($conn, $event_id, $team_name, $position, $points);

        // Provide feedback to the user
        echo "Race results added successfully!";
    } else {
        // Handle invalid data
        echo "Invalid data provided. Please try again.";
    }
} else {
    // Handle cases where the script is accessed directly without a POST request
    echo "Please submit the form to add race results.";
}

// Close the database connection
$conn->close();

