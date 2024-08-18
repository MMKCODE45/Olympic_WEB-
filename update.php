<?php
session_start();
require 'dbcon.php'; // Include your database connection settings

if(isset($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'save_match':
            // Code to handle saving a new match
            break;
        case 'update_data':
            if(isset($_POST['update_data'])) {
                $tableName = $_POST['tableName'];
                $matchNumber = $_POST['matchNumber'];

                // Escape user inputs for security
                $time = mysqli_real_escape_string($conn, $_POST['time']);
                $day = mysqli_real_escape_string($conn, $_POST['day']);
                $month = mysqli_real_escape_string($conn, $_POST['month']);
                $home_team = mysqli_real_escape_string($conn, $_POST['home_team']);
                $home_flag = mysqli_real_escape_string($conn, $_POST['home_flag']);
                $away_team = mysqli_real_escape_string($conn, $_POST['away_team']);
                $away_flag = mysqli_real_escape_string($conn, $_POST['away_flag']);
                $stadium = mysqli_real_escape_string($conn, $_POST['stadium']);
                $group = mysqli_real_escape_string($conn, $_POST['group']);
                $roundNumber = mysqli_real_escape_string($conn, $_POST['roundNumber']);
                $date = mysqli_real_escape_string($conn, $_POST['date']);

                // Update query
                $query = "UPDATE $tableName SET time='$time', day='$day', month='$month', home_team='$home_team', home_flag='$home_flag', away_team='$away_team', away_flag='$away_flag', stadium='$stadium', `group`='$group', roundNumber=$roundNumber, date=$date WHERE matchNumber=$matchNumber";

                if(mysqli_query($conn, $query)) {
                    $_SESSION['message'] = "Data updated successfully";
                } else {
                    $_SESSION['message'] = "Error updating data: " . mysqli_error($conn);
                }
            }
            // Redirect back to Edit.php with the necessary parameters
            header("Location: adminSchEdit.php?tableName=$tableName&matchNumber=$matchNumber");
            exit();
            case 'delete_data':
                if (isset($_POST['delete_data'])) {
                    $tableName = $_POST['tableName'];
                    $matchNumber = $_POST['matchNumber'];
    
                    // Delete query
                    $query = "DELETE FROM $tableName WHERE matchNumber=$matchNumber";
    
                    if (mysqli_query($conn, $query)) {
                        $_SESSION['message'] = "Data deleted successfully";
                    } else {
                        $_SESSION['message'] = "Error deleting data: " . mysqli_error($conn);
                    }
                }
                // Redirect back to the main page
                header("Location: adminIndex.php");
                exit();
        // Add more cases for other actions if needed
        default:
            // Handle default case (if needed)
            break;
    }
}
?>
