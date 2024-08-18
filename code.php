<?php
session_start();
require 'dbcon.php'; // Include your database connection settings

if(isset($_POST['save_match'])) {
    // Retrieve form data
    $sport = $_POST['sport'];
    $time = $_POST['time'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $home_team = $_POST['home_team'];
    $home_flag = $_POST['home_flag'];
    $away_team = $_POST['away_team'];
    $away_flag = $_POST['away_flag'];
    $stadium = $_POST['stadium'];
    $group = $_POST['group'];
    $roundNumber = $_POST['roundNumber'];
    $date = $_POST['date'];

    // Format the date as 'YYYYMMDD'
    $formatted_date = date('Ymd', strtotime($date));

    // Determine the table based on the selected sport
    $table = ''; // Initialize variable for table name

    switch($sport) {
        case 'Football':
            $table = 'football';
            break;
        case 'Volleyball':
            $table = 'volleyball';
            break;
        case 'Cricket':
            $table = 'cricket';
            break;
        case 'Hockey':
            $table = 'hockey';
            break;
        case 'Rugby':
            $table = 'rugby';
            break;
        case 'Tennis':
            $table = 'tennis';
            break;
        default:
            // Handle default case (if needed)
            break;
    }

    // Insert data into the determined table
    $query = "INSERT INTO $table (time, day, month, home_team, home_flag, away_team, away_flag, stadium, `group`, roundNumber, date) 
              VALUES ('$time', '$day', '$month', '$home_team', '$home_flag', '$away_team', '$away_flag', '$stadium', '$group', '$roundNumber', '$formatted_date')";
    $result = mysqli_query($conn, $query);

    if($result) {
        $_SESSION['message'] = 'Match added successfully';
    } else {
        $_SESSION['message'] = 'Error adding match';
        // Redirect back to the adminSchCre.php page
        header('Location: adminSchCre.php');
        exit();
    }
}

// Redirect to the schedule page
header('Location: adminSchCre.php');
exit();
?>
