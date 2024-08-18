<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "dbcon.php";
require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = "";
$errors = array();

// Function to send emails using PHPMailer
function sendEmail($email, $name, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'methamoetik@gmail.com'; // Replace with your email
        $mail->Password = 'wziq fyud dewx cwvz'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('methamoetik@gmail.com', 'FunOly'); // Replace with your email and website name
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// If user signup button
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['FullName']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['ContactNumber']);
    $country = mysqli_real_escape_string($conn, $_POST['Country']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['password_confirm']);
    
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }

    $email_check = "SELECT * FROM user WHERE Email = '$email'";
    $res = mysqli_query($conn, $email_check);

    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you have entered already exists!";
    }

    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO user (FullName, Email, ContactNumber, Country, Password, code, status)
                        VALUES ('$name', '$email', '$contactNumber', '$country', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($conn, $insert_data);

        if ($data_check && sendEmail($email, $name, 'Email Verification Code', '<p>Your verification code is: <b style="font-size: 30px;">' . $code . '</b></p>')) {
            $info = "We've sent a verification code to your email - $email";
            $_SESSION['info'] = $info;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('location: user-otp.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while sending code!";
        }
    }
}

// If user click verification code submit button
if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM user WHERE code = $otp_code AND status = 'notverified'";
    $code_res = mysqli_query($conn, $check_code);

    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['Email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE user SET code = $code, status = '$status' WHERE Email = '$email'";
        $update_res = mysqli_query($conn, $update_otp);

        if ($update_res) {
            $_SESSION['name'] = $fetch_data['FullName'];
            $_SESSION['email'] = $email;
            header('location: login-user.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// If user clicks login button
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $check_email = "SELECT * FROM user WHERE Email = '$email'";
    $res = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['Password'];
        if (password_verify($password, $fetch_pass)) {
            $_SESSION['user_id'] = $fetch['id'];
            $_SESSION['email'] = $email;
            echo "User ID: " . $_SESSION['user_id'] . "<br>";
               echo "Email: " . $_SESSION['email'] . "<br>";

            $status = $fetch['status'];
            if ($status == 'verified') {
                if ($fetch['Role'] == 'admin') {
                    header('location: adminDash.php');
                    exit();
                } else {
                    header('location: home1.php');
                    exit();
                }
            } else {
                $info = "It looks like you haven't still verified your email - $email";
                $_SESSION['info'] = $info;
                header('location: user-otp.php');
            }
        } else {
            $errors['email'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It looks like you're not yet a member! Click on the bottom link to signup.";
    }
}


// If user clicks check email button
if(isset($_POST['check-email'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Ensure 'email' is lowercase

    $check_email = "SELECT * FROM user WHERE Email='$email'";
    $run_sql = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($run_sql) > 0){
        $code = rand(999999, 111111);
        $insert_code = "UPDATE user SET code = $code WHERE Email = '$email'";
        $run_query =  mysqli_query($conn, $insert_code);

        if($run_query){
            $body = "<p>Your password reset code is: <b style='font-size: 30px;'>$code</b></p>";
            if(sendEmail($email, '', 'Password Reset Code', $body)){
                $info = "We've sent a password reset OTP to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Something went wrong!";
        }
    }else{
        $errors['email'] = "This email address does not exist!";
    }
}

// If user click check reset otp button
if(isset($_POST['check-reset-otp'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM user WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['Email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    }else{
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// If user click change password button
if(isset($_POST['change-password'])){
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['password_confirm']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }else{
        $code = 0;
        $email = $_SESSION['email'];
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE user SET code = $code, Password = '$encpass' WHERE Email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
        if($run_query){
            $info = "Your password has been changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
        }else{
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

// If login now button click
if(isset($_POST['login-now'])){
    header('Location: login-user.php');
}
?>