<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Schedule Create</title>
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
                    <h4>Match Add
                        <a href="adminIndex.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                
                <div class="card-body">
                    <form action="code.php" method="POST">
                        
                        <!-- Dropdown menu for sports selection -->
                        <div class="mb-3">
                            <label for="sportSelect" class="form-label">Select Sport</label>
                            <select class="form-select" id="sportSelect" name="sport" required>
                                <option value="Football">Football</option>
                                <option value="Volleyball">Volleyball</option>
                                <option value="Cricket">Cricket</option>
                                <option value="Hockey">Hockey</option>
                                <option value="Rugby">Rugby</option>
                                <option value="Tennis">Tennis</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="time">Time</label>
                            <input type="time" name="time" id="time" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="day">Day</label>
                            <input type="number" name="day" id="day" class="form-control" placeholder="Enter day" min="1" max="31" required>
                        </div>
                        <div class="mb-3">
                            <label for="month">Month</label>
                            <input type="number" name="month" id="month" class="form-control" placeholder="Enter month" min="1" max="12" required>
                        </div>
                        <div class="mb-3">
                            <label for="home_team">Home Team</label>
                            <input type="text" name="home_team" id="home_team" class="form-control" placeholder="Enter home team" required>
                        </div>
                        <div class="mb-3">
                            <label for="home_flag">Home Flag</label>
                            <input type="text" name="home_flag" id="home_flag" class="form-control" placeholder="Enter home flag URL" required>
                        </div>
                        <div class="mb-3">
                            <label for="away_team">Away Team</label>
                            <input type="text" name="away_team" id="away_team" class="form-control" placeholder="Enter away team" required>
                        </div>
                        <div class="mb-3">
                            <label for="away_flag">Away Flag</label>
                            <input type="text" name="away_flag" id="away_flag" class="form-control" placeholder="Enter away flag URL" required>
                        </div>
                        <div class="mb-3">
                            <label for="stadium">Stadium</label>
                            <input type="text" name="stadium" id="stadium" class="form-control" placeholder="Enter stadium" required>
                        </div>
                        <div class="mb-3">
                            <label for="group">Group</label>
                            <input type="text" name="group" id="group" class="form-control" placeholder="Enter group" required>
                        </div>
                        <div class="mb-3">
                            <label for="roundNumber">Round Number</label>
                            <input type="number" name="roundNumber" id="roundNumber" class="form-control" placeholder="Enter round number" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="save_match" class="btn btn-primary">Save Match</button>
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
