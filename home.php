<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header('Location: login.html');
    exit;
}

// The user is authenticated, so display the content
?>

<!DOCTYPE html>
<html>

    <head>
        <title>F1 Racing Management</title>
        <link rel="stylesheet" href="index.css">
    </head>

    <body>
        <header class="front-cover">
            <h1>Welcome to F1 Racing Management</h1>
            <p>Manage racing events, enter race results, and explore past events with ease.</p>

            <!-- Navigation buttons -->
            <div class="nav-buttons">
                <a href="add_event.html" class="button">Add Race Event</a>
                <a href="view_past_races.html" class="button">View Past Races</a>
                <a href="manage_race.html" class="button">Manage Races</a>
                <a href="upcoming_events.html" class="button">Add Upcoming Event</a>
                <a href="upcoming.html" class="button">View Upcoming Event</a>
            </div>
        </header>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
        <footer>
            <p>© 2024 F1 Racing Management. All rights reserved.</p>
        </footer>
    </body>

</html>
