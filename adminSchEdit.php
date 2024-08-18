<?php
session_start();
require 'dbcon.php'; // Include your database connection settings

if (isset($_GET['tableName']) && isset($_GET['matchNumber'])) {
    $tableName = mysqli_real_escape_string($conn, $_GET['tableName']);
    $matchNumber = mysqli_real_escape_string($conn, $_GET['matchNumber']);

    // Check if tableName is one of the allowed tables to prevent SQL injection
    $allowedTables = ["football", "volleyball", "cricket", "hockey", "rugby", "tennis"];
    if (in_array($tableName, $allowedTables)) {
        // Prepare the SQL statement
        $query = "SELECT * FROM $tableName WHERE matchNumber = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $matchNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $matchData = $result->fetch_assoc();
        } else {
            $_SESSION['message'] = "No record found with matchNumber $matchNumber";
            header("Location: adminIndex.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Invalid table selected";
        header("Location: adminIndex.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "Required parameters missing";
    header("Location: adminIndex.php");
    exit(0);
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Match</title>
    <style>
        body {

       
       background-color: #6665ee;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <?php include('message.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Match
                        <a href="adminIndex.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <!-- Include hidden inputs for tableName and matchNumber -->
                        <input type="hidden" name="action" value="update_data">
                        <input type="hidden" name="tableName" value="<?= $tableName; ?>">
                        <input type="hidden" name="matchNumber" value="<?= $matchData['matchNumber']; ?>">

                        <div class="mb-3">
                            <label>Time</label>
                            <input type="text" name="time" value="<?= $matchData['time']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Day</label>
                            <input type="text" name="day" value="<?= $matchData['day']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Month</label>
                            <input type="text" name="month" value="<?= $matchData['month']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Home Team</label>
                            <input type="text" name="home_team" value="<?= $matchData['home_team']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Home Flag</label>
                            <input type="text" name="home_flag" value="<?= $matchData['home_flag']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Away Team</label>
                            <input type="text" name="away_team" value="<?= $matchData['away_team']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Away Flag</label>
                            <input type="text" name="away_flag" value="<?= $matchData['away_flag']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Stadium</label>
                            <input type="text" name="stadium" value="<?= $matchData['stadium']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Group</label>
                            <input type="text" name="group" value="<?= $matchData['group']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Round Number</label>
                            <input type="number" name="roundNumber" value="<?= $matchData['roundNumber']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="number" name="date" value="<?= $matchData['date']; ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="update_data" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
