<?php
// Include the database connection file
require 'DB_Con_For_1.php';

// Function to validate and sanitize event ID
function validateEventId($id) {
    // Check if the ID is a valid integer
    if (filter_var($id, FILTER_VALIDATE_INT) === false) {
        return false;
    }
    return $id;
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the event ID from the form submission
    $id = $_POST['id'];

    // Validate and sanitize the event ID
    $id = validateEventId($id);

    if ($id !== false) {
        // Prepare a SQL query to fetch past race results based on the event ID
        $sql = "SELECT EventDate, EventVenue, RaceCoordinator, PodiumPositions, team_name, team_leader, nationality, race_time FROM events WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the event ID to the statement
            $stmt->bind_param("i", $id);

            // Execute the statement and check for errors
            if ($stmt->execute()) {
                // Fetch the results
                $results = $stmt->get_result();

                // Check if there are any results
                if ($results->num_rows > 0) {
                    // Display the results
                    echo "<h3>Past Event for Event ID: " . htmlspecialchars($id) . "</h3>";
                    echo "<table border='1' class='styled-table'>"; // Add class to table
                    // Add classes to table headers and rows
                    echo "<tr class='styled-table-header'><th>EventDate</th><th>EventVenue</th><th>RaceCoordinator</th><th>PodiumPositions</th><th>team_name</th><th>team_leader</th><th>nationality</th><th>race_time</th></tr>";

                    while ($row = $results->fetch_assoc()) {
                        echo "<tr class='styled-table-row'><td>" . htmlspecialchars($row['EventDate']) . "</td><td>" . htmlspecialchars($row['EventVenue']) . "</td><td>" . htmlspecialchars($row['RaceCoordinator']) . "</td><td>" . htmlspecialchars($row['PodiumPositions']) . "</td><td>" . htmlspecialchars($row['team_name']) . "</td><td>" . htmlspecialchars($row['team_leader']) . "</td><td>" . htmlspecialchars($row['nationality']) . "</td><td>" . htmlspecialchars($row['race_time']) . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No results found for Event ID: " . htmlspecialchars($id) . "</p>";
                }
            } else {
                echo "Error executing statement: " . htmlspecialchars($stmt->error);
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . htmlspecialchars($conn->error);
        }
    } else {
        echo "<p>Invalid Event ID.</p>";
    }
}

// Close the database connection
$conn->close();
?>

<!-- Include a link to the CSS file for styling -->
<link rel="stylesheet" href="past.css">

<!-- Add a Back button with styling -->
<div class="nav-buttons" style="margin-top: 20px; text-align: center;">
    <a href="view_past_races.html" class="button" style="display: inline-block; padding: 10px 20px; margin: 10px; border-radius: 5px; text-decoration: none; color: white; background-color: #1F2833; font-weight: bold; font-size: 1rem; transition: background-color 0.3s ease;">
        Back
    </a>
</div>
