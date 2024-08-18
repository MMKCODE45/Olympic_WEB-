<?php
    include("dbcon.php");
?>
<!doctype html>
<html>
    <head>
        <style>
            video {
                float: left;
            }
            .video-container {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div>
          
        <?php
        $fetchVideos = mysqli_query($conn, "SELECT * FROM FootballTV ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($fetchVideos)){
            $location = $row['location'];
            $title = $row['title'];
            
            echo "<div class='video-container'>";
            echo "<h2>$title</h2>";
            echo "<video src='".$location."' controls width='320' height='200'>";
            echo "</div>";
        }
        ?>
          
        </div>

    </body>
</html>
