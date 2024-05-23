<?php
include('database_connection.php');
if(isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'beneficiaries' => "SELECT name FROM beneficiaries WHERE name LIKE '%$searchTerm%'",
        'reports' => "SELECT reportname FROM reports WHERE reportname LIKE '%$searchTerm%'",
        'media' => "SELECT mediaID FROM media WHERE mediaID LIKE '%$searchTerm%'",
        'volunteer' => "SELECTvoluntunteerID  FROM volunteer WHERE volunteerID LIKE '%$searchTerm%'",
        'notification' => "SELECT message FROM notification WHERE message LIKE '%$searchTerm%'",
        'donations' => "SELECT amount FROM donations WHERE amount LIKE '%$searchTerm%'",
        'campaigns' => "SELECT goal FROM campaigns WHERE goal LIKE '%$searchTerm%'",
        'payment' => "SELECT timestamp FROM payment WHERE timestamp LIKE '%$searchTerm%'",
        'Feedback' => "SELECT feedbackID FROM Feedback WHERE feedbackID LIKE '%$searchTerm%'",

    ];

    // Output search results
    echo "<style>
                h2 {
                    color: blue;
                    text-decoration: underline;
                }
                h3 {
                    color: blue;
                }
                p {
                    color: orange;
                }
          </style>";
    echo "<h2>Search Results:</h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>