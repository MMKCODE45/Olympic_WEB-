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

    header('Location: testing.php');
    exit();
}

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUN OLYMPICS</title>
    <link rel="stylesheet" href="landing.css">
    
    <!-- Fontawesome Link for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Edit User</title>
    
</head>
<body>
<header>
    <nav class="navbar">
        <h2 class="logo"><a href="#">FUN OLYMPICS</a></h2>
        <input type="checkbox" id="menu-toggler">
        <label for="menu-toggler" id="hamburger-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 18h18v-2H3v2zm0-5h18V11H3v2zm0-7v2h18V6H3z"/>
            </svg>
        </label>
        <ul class="all-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="schedule.php">Schedule</a></li>
            <li><a href="userProEdit.php">Profile</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </nav>
    <form method="post">
    <button type="button" class="button"><a href="logout-user.php">Logout</a></button>
    </form>
    <div id="google_translate_element"></div> 
</header>

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










<section class="contact" id="contact">
    <h2>Contact Us</h2>
    <p>Reach out to us for any inquiries or feedback.</p>
    <div class="row">
        <div class="col information">
            <div class="contact-details">
                <p><i class="fas fa-map-marker-alt"></i> 123 Campsite Avenue, Wilderness, CA 98765</p>
                <p><i class="fas fa-envelope"></i> info@campinggearexperts.com</p>
                <p><i class="fas fa-phone"></i> (123) 456-7890</p>
                <p><i class="fas fa-clock"></i> Monday - Friday: 9:00 AM - 5:00 PM</p>
                <p><i class="fas fa-clock"></i> Saturday: 10:00 AM - 3:00 PM</p>
                <p><i class="fas fa-clock"></i> Sunday: Closed</p>
                <p><i class="fas fa-globe"></i> www.codingnepalweb.com</p>
            </div>
        </div>
        <div class="col form">
            <form>
                <input type="text" placeholder="Name*" required>
                <input type="email" placeholder="Email*" required>
                <textarea placeholder="Message*" required></textarea>
                <button id="submit" type="submit">Send Message</button>
            </form>
        </div>
    </div>
</section>



<footer>
    <div>
        <span>Copyright © 2023 All Rights Reserved</span>
        <span class="link">
            <a href="#">Home</a>
            <a href="#contact">Contact</a>
        </span>
    </div>
</footer>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
            {pageLanguage: 'en'},
            'google_translate_element'
        );
    } 
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
