
<?php

require 'DB_Con_For_1.php';

// Retrieve form data from POST request
$event_id = $_POST['event_id'];
$team_name = $_POST['team_name'];
$position = $_POST['position'];
$points = $_POST['points'];

// Validate that the event_id exists in the events table
$event_check_query = "SELECT id FROM events WHERE id = ?";
$event_check_stmt = $conn->prepare($event_check_query);
$event_check_stmt->bind_param("i", $event_id);
$event_check_stmt->execute();
$event_check_stmt->store_result();

if ($event_check_stmt->num_rows === 0) {
    echo "Error: Event ID does not exist.";
    $event_check_stmt->close();
    exit;
}

$event_check_stmt->close();

// Prepare and bind a SQL statement to insert data into results
$stmt = $conn->prepare("INSERT INTO results (event_id, team_name, position, points) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isii", $event_id, $team_name, position, points);

// Execute the prepared statement and check for errors
if ($stmt->execute()) {
    echo "Race results added successfully!";
} else {
    echo "Error adding race results: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
