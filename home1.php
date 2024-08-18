<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login-user.php');
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
            <li><a href="testing.php">Profile</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </nav>
    <form method="post">
    <button type="button" class="button"><a href="logout-user.php">Logout</a></button>
    </form>
    <div id="google_translate_element"></div> 
</header>

<section class="homepage" id="home">
    <div class="content">
        <div class="text">
            <h1>Sports Channels for Ultimate Entertainment</h1>
            <p>
            Explore a wide range of sports channels for thrilling entertainment and exciting matches. <br> Tune in and experience the adrenaline rush!</p>
        </div>
        <a href="#services">Our Services</a>
    </div>
</section>

<section class="services" id="services">
    <h2>Our Sports TV Stations</h2>
    <p>Explore the TV stations dedicated to broadcasting your favorite sports.</p>
    <ul class="cards">
        <li class="card">
            <a href="cricket.html">
                <img src="images/cricket1.jpg" alt="img">
                <h3>Cricket</h3>
                <p>Tune in to Cricket TV for exclusive coverage of cricket matches worldwide, providing insightful commentary, analysis, and highlights to keep you updated with all the action on the pitch.</p>
            </a>
        </li>
        <li class="card">
            <a href="footballTV.php">
                <img src="images/football1.jpg" alt="img">
                <h3>Football</h3>
                <p>Experience the excitement of football with Football TV, your go-to channel for live matches, in-depth analysis, and behind-the-scenes coverage, delivering the passion and drama of the beautiful game straight to your screen.</p>
            </a>
        </li>
        <li class="card">
            <a href="hockey.html">
                <img src="images/hockey1.jpg" alt="img">
                <h3>Hockey</h3>
                <p>Watch thrilling hockey action on Hockey TV, the ultimate destination for hockey enthusiasts, offering live games, expert commentary, and in-depth coverage of leagues and tournaments from around the world.</p>
            </a>
        </li>
        <li class="card">
            <a href="rugby.html">
                <img src="images/rugby1.jpg" alt="img">
                <h3>Rugby</h3>
                <p>Immerse yourself in the world of rugby with Rugby TV, bringing you the adrenaline-pumping excitement of rugby matches, player interviews, and expert analysis, ensuring you never miss a moment of the intense on-field action.</p>
            </a>
        </li>
        <li class="card">
            <a href="swimming.html">
                <img src="images/swimming1.jpg" alt="img">
                <h3>Swimming</h3>
                <p>Dive into Swimming TV for comprehensive coverage of swimming events, featuring live competitions, athlete profiles, and expert insights, allowing you to witness the grace and athleticism of swimmers from around the globe.</p>
            </a>
        </li>
        <li class="card">
            <a href="tennis.html">
                <img src="images/tennis1.jpg" alt="img">
                <h3>Tennis</h3>
                <p>Experience the thrill of tennis on Tennis TV, your premier destination for live matches, player interviews, and behind-the-scenes access, bringing you closer to the action and excitement of the tennis world.</p>
            </a>
        </li>
    </ul>
</section>


<section class="contact" id="contact">
    <h2>Contact Us</h2>
    <p>Reach out to us for any inquiries or feedback.</p>
    <div class="row">
        <div class="col information">
            <div class="contact-details">
                <p><i class="fas fa-map-marker-alt"></i> </p>
                <p><i class="fas fa-envelope"></i> info@campinggearexperts.com</p>
                <p><i class="fas fa-phone"></i> (123) 456-7890</p>
                <p><i class="fas fa-clock"></i> Monday - Friday: 9:00 AM - 5:00 PM</p>
                <p><i class="fas fa-clock"></i> Saturday: 10:00 AM - 3:00 PM</p>
                <p><i class="fas fa-clock"></i> Sunday: Closed</p>
                <p><i class="fas fa-globe"></i> </p>
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
</body>
</html>
