<?php
    include("session.php");
    include("config.php");
    $pagetodisplay = $_GET['page'];
    
    $_SESSION['pagetodisplay'] = $pagetodisplay;

    $username = $_SESSION['logintoken'];
    $query = "SELECT team FROM users WHERE username='$username';";
    $result = mysqli_query($conn, $query);
    $userrow = mysqli_fetch_array($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Killer Queen CTF</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/alertify.css">


  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/ctf.css" rel="stylesheet">

</head>

<body style="background-color:#252525; margin: 0; padding: 0; height:100%; width: 100%;">

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="../ctfpage.php?page=home">Killer Queen CTF<span>.</span></a></h1>


      <nav id="navbar" class="navbar">
        <ul>
          <a target="_blank" href="https://discord.gg/XV9S2nucbZ"><img src="../assets/img/discord.png" style="width:50px; padding-right:25%"></a>
          <li><a class="nav-link scrollto <?php if($_SESSION['pagetodisplay'] == 'home') {echo "active";} ?>" href="../ctfpage.php?page=home">Home</a></li>
          <li><a class="nav-link scrollto <?php if($_SESSION['pagetodisplay'] == 'leaderboard') {echo "active";} ?>" href="ctfpage.php?page=leaderboard">Leaderboard</a></li>
          <li><a class="nav-link scrollto <?php if($_SESSION['pagetodisplay'] == 'challenges') {echo "active";} ?>"" href="/ctfpage.php?page=challenges">Challenges</a></li>
          <li><a class="nav-link scrollto <?php if($_SESSION['pagetodisplay'] == 'team') {echo "active";} ?>" href="/ctfpage.php?page=team">Team</a></li>
          <li><a class="nav-link scrollto" href="/logout.php">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>


  <main id="main">
    <div class="wrapper">
  <?php
    if($_GET['page'] == 'home')
    {
      include("home.php");
    }
    else if($_GET['page'] == 'leaderboard')
    {
      $username = $_SESSION['logintoken'];
      $query2 = "SELECT * FROM users WHERE username='$username';";
      $queryresult2 = mysqli_query($conn, $query2);
      $userrow = mysqli_fetch_array($queryresult2, MYSQLI_ASSOC);
      if($userrow['verified'] == false || !isset($userrow['verified']) || empty($userrow['verified']))
      {
        include("team.php");
      }
      else
      {
        include("challenges.php");
      }
    }
    else if($_GET['page'] == 'challenges')
    {
      $username = $_SESSION['logintoken'];
      $query2 = "SELECT * FROM users WHERE username='$username';";
      $queryresult2 = mysqli_query($conn, $query2);
      $userrow = mysqli_fetch_array($queryresult2, MYSQLI_ASSOC);
      if($userrow['verified'] == false || !isset($userrow['verified']) || empty($userrow['verified']))
      {
        include("team.php");
      }
      else
      {
        include("challenges.php");
      }
    }

    else if($_GET['page'] == 'team')
    {
      include("team.php");
    }
    
  ?>
  </div>

<div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/purecounter/purecounter.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../assets/js/alertify.js"></script>

  <script src="../assets/js/main.js"></script>

</body>

</html>
