<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUN OLYMPICS</title>
    <link rel="stylesheet" href="landing.css">
    
    <!-- Fontawesome Link for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Fun Olympics</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&amp;display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <link
      rel="stylesheet"
      href="bootstrap/css/bootstrap.css"
      />
    <link
      rel="stylesheet"
      href="bootstrap/js/bootstrap.js"
    />
    
    <style>
      figure {
        margin: 15px 0;
      }

      figcaption {
        text-align: center;
      }

      .grayscale {
        filter: grayscale(0);
      }

      .grayscale:hover {
        filter: grayscale(50%);
      }
      .pics{
        margin-top: 80px; /* Adjust this value to create space below the header */

  padding-top: 20px; /* Example padding for space at the top of the section */
  padding-left: 100px; /* Left padding */
  padding-right: 100px; /* Right padding */

      }
    </style>


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
            <li><a href="home1.php">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="schedule.php">Schedule</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
        <button class="button" id="sign-out-btn">Sign Out</button>
    </nav>
</header>
<section class="pics">
      <div class="row justify-content-center">
      <!-- bootstrap image gallery 1 -->
      

        <div class="row">
          <div class="col-sm-4">
            <a href="#"></a>
            <figure>
              <img
                src="images/volleyball1.jpg"
                class="img-thumbnail grayscale"
                data-url="volleyball.html"
              />
              <figcaption>volleyball</figcaption>
            </figure>
          </div>
          <div class="col-sm-4">
            <figure>
              <img
                src="images/football1.jpg"
                class="img-thumbnail grayscale"
                data-url="football.html"
              />
              <figcaption>Football</figcaption>
            </figure>
          </div>
          <div class="col-sm-4">
            <figure>
              <img
                src="images/hockey.1.jpg"
                class="img-thumbnail grayscale"
                data-url="hockey.html"
              />
              <figcaption>Hockey</figcaption>
            </figure>
          </div>
        </div>
        </div>


        <div class="row">
          <div class="col-sm-4">
            <figure>
              <img
                src="images/rugby1.jpg"
                class="img-thumbnail grayscale"
                data-url="rugby.html"
              />
              <figcaption>Rugby</figcaption>
            </figure>
          </div>
          <div class="col-sm-4">
            <figure>
              <img
                src="images/cricket1.jpg"
                class="img-thumbnail grayscale"
                data-url="criket.html"
              />
              <figcaption>cricket</figcaption>
            </figure>
          </div>
          <div class="col-sm-4">
            <figure>
              <img
                src="images/tennis1.jpg"
                class="img-thumbnail grayscale"
                data-url="tennis.html"
              />
              <figcaption>Tennis</figcaption>
            </figure>
          </div>
        </div>
          
        </div>
      </div>
      </div>
    </section>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
    // Get all the images with the class "img-thumbnail"
    var images = document.querySelectorAll(".img-thumbnail");

    // Loop through each image
    images.forEach(function(image) {
        // Add a click event listener to each image
        image.addEventListener("click", function() {
            // Get the URL from the data-url attribute of the clicked image
            var url = this.getAttribute("data-url");
            
            // Check if the URL is not empty
            if(url) {
                // Redirect to the URL
                window.location.href = url;
            }
        });
    });
});

    </script>






<footer>
    <div>
        <span>Copyright © 2023 All Rights Reserved</span>
        <span class="link">
            <a href="#">Home</a>
            <a href="#contact">Contact</a>
        </span>
    </div>
</footer>

</body>
</html>
