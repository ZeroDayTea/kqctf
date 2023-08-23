<?php
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
          <a href="<?php echo $_SESSION['discordlink'] ?>"><img src="assets/img/discord.png" style="width:50px; padding-right:25%"></a>
          <li><a class="nav-link scrollto active" href="/">Home</a></li>
          <li><a class="nav-link scrollto " href="../user/register.php">Register</a></li>
          <li><a class="nav-link" href="../user/login.php">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>

  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1 >Welcome to <span><?php echo $_SESSION["ctfname"] ?> CTF</span></h1>
      <h2>Register soon, information below!</h2>
    </div>
  </section>
  <main id="main" >
    <br>
    <section class="featured-services section-bg">
      <div class="section-title">
          <h3>Meet our <span>Sponsors</span></h3>
          <p>We couldn't thank them enough for making this CTF possible and helping us get prizes for the top teams as well as spreading awareness about cybersecurity.</p>
      </div>
      <div class="container" data-aos="fade-up">

        <div class="row">
           <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"> <img src="./assets/img/sponsors/trail-of-bits-dark-alt.png" alt="TOF Logo" width="40%" > </div>
                <h4 class="title"><a target="_blank" href="https://www.trailofbits.com/">Trail of Bits</a></h4>
                <p class="description">A huge shoutout to Trail of Bits for sponsoring the prizes for this CTF. They have been so generous to many CTFs in the past, and you should definitely check them o>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"> <img src="./assets/img/sponsors/GHSL-purple.svg" alt="TOF Logo" width="40%" > </div>
              <h4 class="title"><a target="_blank" href="https://securitylab.github.com/">GitHub Security Lab</a></h4>
              <p class="description">GitHub Security Lab’s mission is to inspire and enable the community to secure the open source software we all depend on. Check out their website and bug hunting op>
            </div>
          </div>
        </div>

        <div class="row">
            <br>
          </div>

      <div class="row">
          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"> <img src="./assets/img/sponsors/HTB-Logo-RGB_72.png" alt="HTB Logo" width="80%" > </div>
                <h4 class="title"><a target="_blank" href="https://www.hackthebox.eu/">Hack the Box</a></h4>
                <p class="description">Thank you so much Hack the Box for sponsoring this event. We have some amazing Hack the Box subscriptions (VIP passes) for the top teams.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"> <img src="./assets/img/sponsors/DO/PNG/DO_Logo_Vertical_Blue.png" alt="TOF Logo" width="40%" > </div>
                <h4 class="title"><a target="_blank" href="https://www.digitalocean.com/">Digital Ocean</a></h4>
                <p class="description">DigitalOcean offers a fantastic platform for innovators, developers, and entrepreneurs to grow. Find out more <a target="_blank" href="https://www.digitalocean.com/">here</a>.</p>
              </div>
            </div>


          <div class="col-md-6 col-lg-4 d-flex mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"> <img src="./assets/img/sponsors/wolframlogo-1.png" alt="Wolfram Logo" width="50%" > </div>
              <h4 class="title"><a target="_blank" href="https://www.wolframalpha.com/">Wolfram Alpha</a></h4>
              <p class="description">Thank you Wolfram for supplying Wolfram|One to ALL participants for 30 days. They will also give the special Wolfram Award (Wolfram|One for one year and a one-year su>
            </div>
          </div>

      </div>
    </section>
    <br>
    <section class="about section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Welcome</h2>
          <h3>CTF Information</span></h3>
        </div>

        <div class="col-lg-15 pt-4 pt-lg-2 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <h3></h3>
          <p class="fst-italic">
            Some info about CTFs...
          </p>
          <ul>
            <li>
              <div>
                <h5>What is a CTF?</h5>
                <p>CTF stands for "Capture The Flag" which are a type of cybersecurity competition intended to teach about computer science and computer security. They involve participants exploiting common vulnerabilities found on web applications, pieces of software, cryptographic methods, networks, and other computer topics in order to gain a "flag" or proof that they successfully completed a particular challenge. Here are some great links to help you understand what a ctf is:</p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏<a target="_blank" href="https://ctftime.org/ctf-wtf/">https://ctftime.org/ctf-wtf/</a> </p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏<a target="_blank" href="https://dev.to/atan/what-is-ctf-and-how-to-get-started-3f04">https://dev.to/atan/what-is-ctf-and-how-to-get-started-3f04</a> </p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏<a target="_blank" href="https://ctfd.io/whats-a-ctf/">https://ctfd.io/whats-a-ctf/</a> </p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏<a target="_blank" href="https://ctf101.org/">https://ctf101.org/</a> </p>

      </div>
    </section>
    <br>
    <section class="about section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Our CTF...</h2>
          <h3>Killer Queen CTF</span></h3>
        </div>

        <div class="col-lg-15 pt-4 pt-lg-2 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <h3></h3>
          <p class="fst-italic">
            Here are some common questions we would like to answer about our CTF and CTFs in general.
          </p>
          <ul>
            <li>
              <div>
                <h5>Divisions:</h5>
                <p>We will have three divisions <b>Middle School</b>, <b>High School</b>, and <b>Open/College</b>. Teams are allowed to switch divisions by asking an admin and we do allow upcoming college freshmen to compete under the High School division since we still consider that as 12th grade.</p>

                <p> Better put: </p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ Middle school division is open to US-based 8th graders and younger</p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏High school division is open to US-based high school seniors and younger</p>
                <p>-->‏‏‎ ‎‏‏‎ ‎‏‏‎ ‎‏‏‎ Open/College is well...open to all!</p>
 
              <br>
               
              </div>
            </li>
            <li>
              <div>
                <h5>Prizes:</h5>
                <p>High School Division:<br>
                    1st Place - $500, Wolfram Award, and HTB VIP 1 year<br>
                    2nd Place - $250, Wolfram Award, and HTB VIP 6 months<br>
                    3rd Place - $130, Wolfram Award, and HTB VIP 1 month<br>
                    4th Place - $20 and Wolfram Award<br>
                    5th Place - $20 and Wolfram Award<br>
                    <br>
                    Open Division:
                    1st Place - $500<br>
                    2nd Place - $250<br>
                    3rd Place - $130<br>
                    4th Place - $20<br>
                    5th Place - $20<br>
                    <br>
                    Middle School Division:<br>
                    1st Place - $50<br>
                </p>
 
              <br>
               
              </div>
            </li>
            <li>
              <div>
                <h5>Connect with us:</h5>
                <p>Feel free to join our discord server and engage with a community of passionate cybersecurity enthusiasts and CTF competitors. You can talk to the admins there as well as get support related to challenges and competition infrastructure. Discord Link: <a href="">  </a> </p>
                
                <p> For more direct contact you can email us at: <a href="mailto: support@killerqueenctf.org"> support@killerqueenctf.org</a></p>
                <p>Want to know more? Visit us out our website: <a href="" target="_blank"> </a> </p>
              
                
              </div>

              
            </li>
          </ul>
        </div>


      </div>
    </section>
    <br>
    <section class="about section-bg">
      <div class="container" data-aos="fade-up">
        <p style="text-align: center"> Front-end visuals of site inspired by the work of DefyGG and the rctf CTF platform </p>
      </div>
    </section>
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
