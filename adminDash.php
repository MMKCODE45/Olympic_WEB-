<?php
require_once "controllerUserData.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fun Olympics</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="games.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="admin.css">
    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/js/bootstrap.js">
    <style>
        
        body {

            background: #6665ee;
            background-color: #6665ee;
            color: #fff; /* Light text color for better readability */
            font-family: 'Poppins', sans-serif; /* Optional: Use Poppins font for text */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            text-decoration: none !important; 
            text-decoration-color: #fff;
        }
        a {
          color: #0d6efd;
          text-decoration: none; /* Remove underline */
          }


        .card {
            background-color: #222; /* Dark background color for cards */
            color: #fff; /* Light text color for card content */
            padding: 20px; /* Add some padding for better spacing */
            border-radius: 10px; /* Optional: Add border radius for rounded corners */
            margin: 20px; /* Add margin to separate cards */
            cursor: pointer; /* Change cursor to pointer on hover */
        }

        .nav-header {
            background-color: #333; /* Dark background color for header */
            padding: 10px; /* Add padding for better spacing */
            text-align: center; /* Center align the content */
        }

        .nav_logo {
            color: #fff; /* Light color for the logo text */
            font-size: 24px; /* Adjust font size */
            text-decoration: none; /* Remove underline */
        }

        .button {
            background-color: #444; /* Dark background color for buttons */
            color: #fff; /* Light color for button text */
            border: none; /* Remove default button border */
            padding: 10px 20px; /* Add padding for better button size */
            border-radius: 5px; /* Optional: Add border radius for rounded buttons */
            cursor: pointer; /* Change cursor to pointer on hover */
            
        }

        /* Adjust the rest of your styles as needed */
        
            .material-symbols-outlined {
                font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
}

    </style>

</head>
<body>
    <!-- Header -->
    <header class="nav-header">
        <nav class="nav">
            <a href="#" class="nav_logo">FUN OLYMPICS</a>
            <div>

            </div>
            <button class="button" id="sign-out-btn"><a href="logout-user.php">Sign Out</button>
            
        </nav>
    </header>

    <!-- About -->
    <div class="about">
        <a class="bg_links social portfolio" href="https://www.rafaelalucas.com" target="_blank">
            <span class="icon"></span>
        </a>
        <a class="bg_links social dribbble" href="https://dribbble.com/rafaelalucas" target="_blank">
            <span class="icon"></span>
        </a>
        <a class="bg_links social linkedin" href="https://www.linkedin.com/in/rafaelalucas/" target="_blank">
            <span class="icon"></span>
        </a>
        <a class="bg_links logo"></a>
    </div>
    <!-- End about -->
    

    <div class="content">
        <!-- Card 1 -->
        <a href="adminProIndex" class="card">
        <span class="material-symbols-outlined">
        account_circle
          </span>
            <p class="title">Profile</p>
            <p class="text">Click to see or edit your profile page.</p>
        </a>
        <!-- End card 1 -->

        <!-- Card 2 -->
        <a href="adminIndex" class="card">
        <span class="material-symbols-outlined">
             schedule
             </span>
            <p class="title">Schedule</p>
            <p class="text">Check all your favourites in one place.</p>
        </a>
        <!-- End card 2 -->

        <!-- Card 3 -->
        <a href="contacts.html" class="card">
        <span class="material-symbols-outlined">
          smart_display
          </span>
            <p class="title">highlights</p>
            <p class="text">Add or change your contacts and links.</p>
        </a>
        <!-- End card 3 -->
    </div>

    <script src="script.js"></script>
</body>
</html>
