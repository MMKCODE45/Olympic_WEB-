<?php
session_start();
include('dbcon.php');

// Save User Function
if(isset($_POST['save_user'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contactnumber = $_POST['contactnumber'];
    $country = $_POST['country'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypting the password
    $role = $_POST['role'];
    $code = $_POST['code'] ?? NULL; // Assuming you have a 'code' field in your form

    $query = "INSERT INTO user (FullName, Email, ContactNumber, Country, Password, Role, code) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $fullname, $email, $contactnumber, $country, $password, $role, $code);
    
    if(mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "User Added Successfully";
        header("Location: adminProindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "User Not Added";
        header("Location: adminProCreate.php");
        exit(0);
    }
    mysqli_stmt_close($stmt);
}

// Delete User Function
if(isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];

    $query = "DELETE FROM user WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    
    if(mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "User Deleted Successfully";
        header("Location: adminProindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "User Not Deleted";
        header("Location: adminProindex.php");
        exit(0);
    }
    mysqli_stmt_close($stmt);
}

// Update User Function
if(isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contactnumber = $_POST['contactnumber'];
    $country = $_POST['country'];
    $role = $_POST['role'];
    $code = $_POST['code'] ?? NULL; // Assuming you have a 'code' field in your form

    $query = "UPDATE user SET FullName=?, Email=?, ContactNumber=?, Country=?, Role=?, code=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssssi", $fullname, $email, $contactnumber, $country, $role, $code, $user_id);
    
    if(mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "User Updated Successfully";
        header("Location: adminProindex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "User Not Updated";
        header("Location: adminProEdit.php");
        exit(0);
    }
    mysqli_stmt_close($stmt);
}
?>
