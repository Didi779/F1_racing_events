<?php

// Include the database connection file
require 'DB_Con_For_1.php';

try {
    // Prepare a SQL query to fetch all race events
    $sql = "SELECT * FROM events";
    $stmt = $conn->prepare($sql);

    // Execute the statement
    $stmt->execute();

    // Fetch the results
    $results = $stmt->get_result();

    // Check if there are any results
    if ($results->num_rows > 0) {
        $events = [];

        // Fetch each row and store it in the $events array
        while ($row = $results->fetch_assoc()) {
            $events[] = [
                'id' => htmlspecialchars($row['id']),
                'EventDate' => htmlspecialchars($row['EventDate']),
                'EventVenue' => htmlspecialchars($row['EventVenue']),
                'RaceCoordinator' => htmlspecialchars($row['RaceCoordinator']),
                'PodiumPositions' => htmlspecialchars($row['PodiumPositions']),
                'team_name' => htmlspecialchars($row['team_name']),
                'team_leader' => htmlspecialchars($row['team_leader']),
                'nationality' => htmlspecialchars($row['nationality']),
                'race_time' => htmlspecialchars($row['race_time']),
            ];
        }

        // Convert the events array to JSON and echo it
        echo json_encode($events);
    } else {
        // No results found, return an empty array in JSON format
        echo json_encode([]);
    }
} catch (Exception $e) {
    // Handle exceptions and errors gracefully
    echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
