<?php
// setting more secure session cookie properties
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Strict');

if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
    ini_set('session.cookie_secure', 1);
}

session_name('session');

session_start();

include("config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $_SESSION["ctfname"] ?> CTF</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body style="background-color:#252525">
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="/"><?php echo $_SESSION["ctfname"] ?> CTF<span>.</span></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="/">Home</a></li>
          <li><a class="nav-link scrollto " href="/user/register">Register</a></li>
          <li><a class="nav-link" href="/user/login">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>

  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1 >Welcome to <span><?php echo $_SESSION["ctfname"] ?> CTF</span></h1>
      <h2><?php echo $_SESSION["ctfmessage"] ?></h2>
    </div>
  </section>
  <main id="main" >
    <br>
    <section class="about section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Welcome</h2>
          <h3>CTF Information</span></h3>
        </div>

        <div class="col-lg-15 pt-4 pt-lg-2 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <p class="fst-italic">
            Some info about CTFs...
          </p>
          <ul>
            <li>
              <div>
                <h5>What is a CTF?</h5>
                <br>
                <p>
                    CTFs or Capture The Flag events are challenge-based competitions that test participants on various aspects of computer science, cybersecurity, and more! They are framed in a gamified environment which means teams of participants engage in challenges spanning across two or three days of digital hackathon that mirror real-world cybersecurity situations. The goal? To 'capture the flag', a piece of data that is hidden, encrypted, or protected in some way. The reward? A cash prize of around $500 and some digital goodies.
                <br><br>
                Categories of challenges include...
                <br><br>
     <b>Cryptography</b>: This involves unraveling encrypted data and involves heavy reliance on math and various mathematical principles
     <br>
     <b>Binary</b>: A deep dive into binary files, this category challenges participants to exploit binary code and find subtle vulnerabilities. Perfect for those interested in systems, architecture, and low level code
     <br>
     <b>Web</b>: Participants probe web pages for vulnerabilities or weak spots, seeking ways to access a flag they should not normally have access too in web or full-stack environments
     <br>
     <b>Reverse Engineering</b>: In this intricate category, participants deconstruct software or hardware systems to understand their inner workings. Ideal for those with an analytical mindset and an understanding of program design
     <br>
     <b>Miscellaneous</b>: All the other wide range of challenges that involve anything from open source intelligence, digital forensics, or algorithm design
                </p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏<a target="_blank" href="https://ctftime.org">https://ctftime.org</a> </p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏<a target="_blank" href="https://ctfd.io/whats-a-ctf/">https://ctfd.io/whats-a-ctf/</a> </p>

                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏<a target="_blank" href="https://dev.to/atan/what-is-ctf-and-how-to-get-started-3f04">https://dev.to/atan/what-is-ctf-and-how-to-get-started-3f04</a> </p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏<a target="_blank" href="https://ctf101.org/">https://ctf101.org/</a> </p>

      </div>
    </section>
    <br>
    <br>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs@1.1.1/js/purecounter.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js"></script>

  <script src="/assets/js/main.js"></script>
</body>

</html>
