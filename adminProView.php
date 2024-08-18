<?php
session_start();
require 'dbcon.php';

if(isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM user WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_assoc($query_run);
    } else {
        $_SESSION['message'] = "No Such User Found";
        header("Location: adminProIndex.php");
        exit(0);
    }
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

    <title>User Details</title>
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
                        <h4>User Details
                            <a href="adminProIndex.php" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>ID:</label>
                            <p><?= $user['id']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Full Name:</label>
                            <p><?= $user['FullName']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Email:</label>
                            <p><?= $user['Email']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Contact Number:</label>
                            <p><?= $user['ContactNumber']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Country:</label>
                            <p><?= $user['Country']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Password:</label>
                            <p><?= $user['Password']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Role:</label>
                            <p><?= $user['Role']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
