<?php
session_start();
require 'dbcon.php'; // Include your database connection settings


// Check if the form has been submitted
if(isset($_POST['selected_table'])) {
    // Retrieve the selected table from the form
    $selected_table = $_POST['selected_table'];

    // Execute query based on selected table
    $query = "SELECT * FROM $selected_table";
    $result = mysqli_query($conn, $query);

    // Check if query was successful and fetch results
    if($result && mysqli_num_rows($result) > 0) {
        // Fetch data from the selected table
        $table_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        // No records found
        $table_data = array();
    }
} else {
    // Default table selection
    $selected_table = '';
    $table_data = array();
}

// Define an array of table names
$tables = array("football", "volleyball", "cricket", "hockey", "rugby", "tennis");
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Table Details</title>

    <style>
        body {

       
       background-color: #6665ee;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Table Details</h4>
                        <a href="adminSchCre.php" class="btn btn-primary float-end">Add Schedule</a>
                        <a href="adminDash.php" class="btn btn-danger float-end">BACK</a>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="tableSelect" class="form-label">Select Table:</label>
                                <select class="form-select" id="tableSelect" name="selected_table">
                                    <option value="">Select Table</option>
                                    <?php foreach($tables as $table): ?>
                                        <option value="<?= $table ?>" <?= ($selected_table == $table) ? 'selected' : '' ?>><?= ucfirst($table) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Fetch Data</button>
                        </form>
                        <hr>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <?php if(!empty($table_data)): ?>
                                        <?php foreach($table_data[0] as $key => $value): ?>
                                            <th><?= $key ?></th>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <th>Action</th> <!-- Added header for action buttons -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($table_data)): ?>
                                    <?php foreach($table_data as $row): ?>
                                        <tr>
                                            <?php foreach($row as $value): ?>
                                                <td><?= $value ?></td>
                                            <?php endforeach; ?>
                                            <td>
                                                <!-- View button -->
                                                <a href="adminSchView.php?matchNumber=<?= $row['matchNumber']; ?>&tableName=<?= $selected_table; ?>" class="btn btn-info btn-sm">View</a>
                                           <!-- Edit button -->
                                           <a href="adminSchEdit.php?matchNumber=<?= $row['matchNumber']; ?>&tableName=<?= $selected_table; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <!-- Delete button -->
                                            <form action="update.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="action" value="delete_data">
                                                    <input type="hidden" name="tableName" value="<?= $selected_table; ?>">
                                                    <input type="hidden" name="matchNumber" value="<?= $row['matchNumber']; ?>">
                                                    <button type="submit" name="delete_data" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                           
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="6">No records found</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
