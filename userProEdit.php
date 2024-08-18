<?php
session_start();
require 'dbcon.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login-user.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    $_SESSION['message'] = "User not found!";
    header('Location: home1.php');
    exit();
}

if (isset($_POST['update_user'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contactnumber = mysqli_real_escape_string($conn, $_POST['contactnumber']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($password)) {
        // Update with new password
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $query = "UPDATE user SET FullName = ?, Email = ?, ContactNumber = ?, Country = ?, Password = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $fullname, $email, $contactnumber, $country, $encpass, $user_id);
    } else {
        // Update without changing password
        $query = "UPDATE user SET FullName = ?, Email = ?, ContactNumber = ?, Country = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $fullname, $email, $contactnumber, $country, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "User updated successfully!";
    } else {
        $_SESSION['message'] = "User update failed!";
    }

    header('Location: userProEdit.php');
    exit();
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
</head>
<body>

<div class="container mt-5">

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="fullname" value="<?= htmlspecialchars($user['FullName']); ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['Email']); ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Contact Number</label>
                            <input type="text" name="contactnumber" value="<?= htmlspecialchars($user['ContactNumber']); ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Country</label>
                            <input type="text" name="country" value="<?= htmlspecialchars($user['Country']); ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter new password">
                            <small class="text-muted">Leave blank if you don't want to change the password.</small>
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
