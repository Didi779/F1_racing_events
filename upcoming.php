<?php
// Include the database connection file
require 'DB_Con_For_1.php';

// Prepare a SQL query to fetch all upcoming events
// Assuming events have a date attribute and you want to retrieve events from today onward
$sql = "SELECT EventDate, EventVenue, RaceCoordinator, PodiumPositions, team_name, team_leader, nationality, race_time FROM events WHERE EventDate >= CURDATE()";
$stmt = $conn->prepare($sql);

// Execute the statement
if ($stmt && $stmt->execute()) {
    // Fetch the results
    $results = $stmt->get_result();

    // Check if there are any results
    if ($results->num_rows > 0) {
        echo "<h3>Upcoming Events</h3>";
        // Add class for styling the table
        echo "<table class='styled-table'>";
        // Add classes for styling table headers and rows
        echo "<tr class='styled-table-header'><th>Event Date</th><th>Event Venue</th><th>Race Coordinator</th><th>Podium Positions</th><th>Team Name</th><th>Team Leader</th><th>Nationality</th><th>Race Time</th></tr>";

        // Display each row of the results
        while ($row = $results->fetch_assoc()) {
            echo "<tr class='styled-table-row'>";
            echo "<td>" . htmlspecialchars($row['EventDate']) . "</td>";
            echo "<td>" . htmlspecialchars($row['EventVenue']) . "</td>";
            echo "<td>" . htmlspecialchars($row['RaceCoordinator']) . "</td>";
            echo "<td>" . htmlspecialchars($row['PodiumPositions']) . "</td>";
            echo "<td>" . htmlspecialchars($row['team_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['team_leader']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nationality']) . "</td>";
            echo "<td>" . htmlspecialchars($row['race_time']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        // No results found
        echo "<p>No upcoming events found.</p>";
    }
} else {
    // Error executing the query
    echo "Error executing query: " . htmlspecialchars($stmt->error);
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>

<!-- Include a link to the CSS file for styling -->
<link rel="stylesheet" href="past.css">

<!-- Add a Home button with consistent styling -->
<div class="nav-buttons" style="margin-top: 20px; text-align: center;">
    <a href="home.php" class="button" style="display: inline-block; padding: 10px 20px; margin: 10px; border-radius: 5px; text-decoration: none; color: white; background-color: #1F2833; font-weight: bold; font-size: 1rem; transition: background 0.3s ease;">
        Home
    </a>
</div>
