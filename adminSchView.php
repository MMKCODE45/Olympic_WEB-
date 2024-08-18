<?php
require 'dbcon.php';

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Match Details</title>
    <style>
        body {

       
       background-color: #6665ee;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Match Details
                        <a href="adminIndex.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    $tables = array("football", "volleyball", "cricket", "hockey", "rugby", "tennis");

                    // Rest of your code
                    
                    if(isset($_GET['matchNumber']) && isset($_GET['tableName']))
                    {
                        $match_number = mysqli_real_escape_string($conn, $_GET['matchNumber']);
                        $table_name = mysqli_real_escape_string($conn, $_GET['tableName']);
                        
                        // Ensure that the table name is valid to prevent SQL injection
                        if(in_array($table_name, $tables)) {
                            $query = "SELECT * FROM $table_name WHERE matchNumber='$match_number'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $match = mysqli_fetch_assoc($query_run);
                                ?>
                                <div class="mb-3">
                                    <label>Match Number</label>
                                    <p class="form-control"><?= $match['matchNumber']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Time</label>
                                    <p class="form-control"><?= $match['time']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Day</label>
                                    <p class="form-control"><?= $match['day']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Month</label>
                                    <p class="form-control"><?= $match['month']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Home Team</label>
                                    <p class="form-control"><?= $match['home_team']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Home Flag</label>
                                    <p class="form-control"><?= $match['home_flag']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Away Team</label>
                                    <p class="form-control"><?= $match['away_team']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Away Flag</label>
                                    <p class="form-control"><?= $match['away_flag']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Stadium</label>
                                    <p class="form-control"><?= $match['stadium']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Group</label>
                                    <p class="form-control"><?= $match['group']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Round Number</label>
                                    <p class="form-control"><?= $match['roundNumber']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Date</label>
                                    <p class="form-control"><?= $match['date']; ?></p>
                                </div>
                                <!-- Displaying the associated user_id -->
                                <div class="mb-3">
                                    <label>User ID</label>
                                    <p class="form-control"><?= $match['user_id']; ?></p>
                                </div>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Match Found</h4>";
                            }
                        } else {
                            echo "<h4>Invalid Table Name</h4>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
