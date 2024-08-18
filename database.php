<?php
// Database connection settings
$host = 'localhost:3308'; // Change this if your database is hosted elsewhere
$dbname = 'funoly';
$username = 'root';
$password = 'Whales123';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Retrieve form data (assuming the form is submitted via POST method)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['FullName'];
    $email = $_POST['Email'];
    $contactNumber = $_POST['ContactNumber'];
    $country = $_POST['Country'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $role = 'user'; // Default role for normal users

    // Add your logic here to determine if the user is an admin
    // For demonstration purposes, I'll assume admin role based on a hardcoded condition
    if ($role != 'admin') {
        // Prepare SQL statement
    $sql = "INSERT INTO user (FullName, Email, ContactNumber, Country, Password, Role) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fullName, $email, $contactNumber, $country, $password, $role); // Bind parameters
    $stmt->execute();

    // Optionally, you can handle success/failure here
    if ($stmt->affected_rows > 0) {
        echo "User added successfully.";
    } else {
        echo "Failed to add user.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
    }else{
        
        
    }

    


}
?>
