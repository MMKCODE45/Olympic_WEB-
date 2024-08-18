<?php
session_start();
require 'dbcon.php';

if(isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM user WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_array($query_run);
    } else {
        $_SESSION['message'] = "No Such User Found";
        header("Location: index.php");
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

    <title>Edit User</title>
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
                        <h4>Edit User
                            <a href="adminProindex.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="codePro.php" method="POST">
                            <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                            <div class="mb-3">
                                <label>Full Name</label>
                                <input type="text" name="fullname" value="<?= $user['FullName']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="<?= $user['Email']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Contact Number</label>
                                <input type="text" name="contactnumber" value="<?= $user['ContactNumber']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Country</label>
                                <input type="text" name="country" value="<?= $user['Country']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter new password">
                                <small class="text-muted">Leave blank if you don't want to change the password.</small>
                            </div>
                            <div class="mb-3">
                                <label>Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="user" <?= $user['Role'] == 'user' ? 'selected' : '' ?>>User</option>
                                    <option value="admin" <?= $user['Role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
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
