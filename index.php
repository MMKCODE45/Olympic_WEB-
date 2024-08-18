<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'dbcon.php';

$message = '';

// Function to validate input
function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle Signup
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $fullName = validateInput($_POST['FullName']);
    $email = validateInput($_POST['Email']);
    $contactNumber = validateInput($_POST['ContactNumber']);
    $country = validateInput($_POST['Country']);
    $password = validateInput($_POST['password']);
    $password_confirm = validateInput($_POST['password_confirm']);

    // Check if passwords match
    if ($password !== $password_confirm) {
        $message = "Passwords do not match.";
    } else {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        // Check if email already exists
        $email_check_query = $conn->prepare("SELECT id FROM user WHERE Email = ?");
        $email_check_query->bind_param("s", $email);
        $email_check_query->execute();
        $email_check_query->store_result();

        if ($email_check_query->num_rows > 0) {
            $message = "Email already exists. Please use a different email.";
        } else {
            $stmt = $conn->prepare("INSERT INTO user (FullName, Email, ContactNumber, Country, Password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $fullName, $email, $contactNumber, $country, $password_hashed);

            if ($stmt->execute()) {
                $message = "Signup successful!";
                header("Location: index.php#login"); // Redirect to login form after successful signup
                exit();
            } else {
                $message = "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $email_check_query->close();
    }
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);

    $stmt = $conn->prepare("SELECT id, Password, Role FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['user_role'] = $role;
            $message = "Login successful!";
            header("Location: home1.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No user found with this email.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Olympics</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="landing.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
        .weak-password-message {
            color: #ff0000;
            font-size: 12px;
            margin-top: 5px;
        }
        .message {
            color: green;
            font-size: 14px;
            margin-top: 10px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <a href="#" class="nav_logo">FUN OLYMPICS</a>
            <ul class="nav_items">
            

            </ul>
            
            <button type="button" class="button"><a href="logout-user.php">Login</a></button>
        </nav>
        <div id="google_translate_element"></div> 
    </header>

    <section class="homepage" id="home">
        <div class="content">
            <div class="text">
                <h1>Welcome to Fun Olympics!</h1>
                <p>
                    Join us in celebrating the spirit of sportsmanship with our exclusive Olympic streaming service.
                    <br> Watch live events, highlights, and stay updated with all the latest happenings.
                    <br>Enjoy the thrill and excitement of the Olympics from the comfort of your home!
                </p>
            </div>
            <a href="#services">Our Services</a>
        </div>
    </section>

    <!-- Home -->
    <section class="home">
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
            <!-- Login Form -->
            <div class="form login_form">
                <form action="index.php" method="post">
                    <h2>Login</h2>
                    <div class="input_box">
                        <input type="email" name="email" placeholder="Enter your email" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="password" placeholder="Enter your password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="option_field">
                        <span class="checkbox">
                            <input type="checkbox" id="check" />
                            <label for="check">Remember me</label>
                        </span>
                        <a href="#" class="forgot_pw">Forgot password?</a>
                    </div>
                    <button type="submit" name="login" class="button">Login Now</button>
                    <div class="login_signup">
                        Don't have an account? <a href="#" id="signup">Signup</a>
                    </div>
                </form>
            </div>
            <!-- Signup Form -->
            <div class="form signup_form">
                <form action="index.php" method="post">
                    <h2>Signup</h2>
                    <button class="scroll-top">Scroll to Top</button>
                    <div class="input_box">
                        <input type="text" name="FullName" placeholder="Full Name" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="email" name="Email" placeholder="Email" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="tel" name="ContactNumber" placeholder="Contact Number" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="text" name="Country" placeholder="Country" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="password" placeholder="Create password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                        <div class="password-strength"></div>
                    </div>
                    <div class="input_box">
                        <input type="password" name="password_confirm" placeholder="Confirm password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <button type="submit" name="signup" class="button" id="signupNowBtn">Signup Now</button>
                    <div class="weak-password-message"></div>
                    <div class="login_signup">
                        Already have an account? <a href="#" id="login">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="message">
        <?php if (!empty($message)) echo $message; ?>
    </div>

    <script>
        document.getElementById('signup').addEventListener('click', () => {
            document.querySelector('.login_form').style.display = 'none';
            document.querySelector('.signup_form').style.display = 'block';
        });

        document.getElementById('login').addEventListener('click', () => {
            document.querySelector('.signup_form').style.display = 'none';
            document.querySelector('.login_form').style.display = 'block';
        });

        document.querySelectorAll('.pw_hide').forEach(icon => {
            icon.addEventListener('click', () => {
                let passwordInput = icon.previousElementSibling;
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.replace('uil-eye-slash', 'uil-eye');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.replace('uil-eye', 'uil-eye-slash');
                }
            });
        });
    </script>
    <script src="script.js"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'google_translate_element'
            );
        } 
  </script>

   <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>