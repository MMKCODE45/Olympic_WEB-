<?php
// Database connection settings
$host = 'localhost:3308'; // Change this if your database is hosted elsewhere
$dbname = 'funoly';
$username = 'root';
$password = 'Whales123';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is an XMLHttpRequest (AJAX) request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // The request is AJAX, output JSON data
    $sql = "SELECT * FROM footballTV";
    $result = $conn->query($sql);

    $matches = array();
    while($row = $result->fetch_assoc()) {
        $matches[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($matches);
} else {
    // The request is not AJAX, output HTML content
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Football Matches</title>
    </head>
    <body>
        <h1>Football Matches</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Match</th>
                    <th>Date</th>
                    <th>Video</th>
                </tr>
            </thead>
            <tbody id="matchesTable">
            </tbody>
        </table>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                fetchMatches();

                function fetchMatches() {
                    fetch('fetchMatch.php') // Adjust the path as needed
                        .then(response => response.json())
                        .then(data => {
                            const table = document.getElementById('matchesTable');
                            data.forEach(match => {
                                const row = document.createElement('tr');

                                // Create cells for match details
                                const matchCell = document.createElement('td');
                                matchCell.textContent = match.match_details; // Adjust as per your column name
                                row.appendChild(matchCell);

                                const dateCell = document.createElement('td');
                                dateCell.textContent = match.match_date; // Adjust as per your column name
                                row.appendChild(dateCell);

                                // Create cell for YouTube video
                                const videoCell = document.createElement('td');
                                const videoId = getYouTubeId(match.youtube_video_link); // Extract video ID from the link
                                if (videoId) {
                                    const iframe = document.createElement('iframe');
                                    iframe.width = "560";
                                    iframe.height = "315";
                                    iframe.src = `https://www.youtube.com/embed/${videoId}`;
                                    iframe.frameBorder = "0";
                                    iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
                                    iframe.allowFullscreen = true;
                                    videoCell.appendChild(iframe);
                                }
                                row.appendChild(videoCell);

                                table.appendChild(row);
                            });
                        })
                        .catch(error => console.error('Error fetching matches:', error)); // Handle fetch errors
                }

                // Function to extract YouTube video ID from the link
                function getYouTubeId(url) {
                    // Extract video ID from the YouTube link
                    const match = url.match(/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
                    return match ? match[1] : null;
                }
            });
        </script>
    </body>
    </html>
    <?php
}

$conn->close();
?>
