<?php 
require_once "controllerUserData.php"; 
$errors = $errors ?? [];
$name = $name ?? '';
$email = $email ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="logAndsign.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup-user.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Signup Form</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errors as $error): ?>
                                <p><?php echo htmlspecialchars($error, ENT_QUOTES); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="FullName" placeholder="Full Name" required value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="Email" placeholder="Email Address" required value="<?php echo htmlspecialchars($email, ENT_QUOTES); ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="tel" name="ContactNumber" placeholder="Contact Number" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="Country" placeholder="Country" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Create password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirm" placeholder="Confirm password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login-user.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
