<?php
    include("user/session.php");
    include("config/config.php");
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

  <link href="/assets/css/style.css" rel="stylesheet">
  <link href="/assets/css/alertify.css" rel="stylesheet">
  <link href="/assets/css/ctf.css" rel="stylesheet">
</head>

<body style="background-color:#252525; margin: 0; padding: 0; height:100%; width: 100%;">

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

     <h1 class="logo"><a href="/ctfpage.php?page=home"><?php echo $_SESSION["ctfname"] ?> CTF<span>.</span></a></h1>


      <nav id="navbar" class="navbar">
        <ul>
     <a href="<?php echo $_SESSION['discordlink'] ?>"><img src="/assets/img/discord.png" style="width:50px; padding-right:25%"></a>
          <li><a class="nav-link scrollto <?php if($_SESSION['pagetodisplay'] == 'home') {echo "active";} ?>" href="../ctfpage.php?page=home">Home</a></li>
          <li><a class="nav-link scrollto <?php if($_SESSION['pagetodisplay'] == 'leaderboard') {echo "active";} ?>" href="ctfpage.php?page=leaderboard">Leaderboard</a></li>
          <li><a class="nav-link scrollto <?php if($_SESSION['pagetodisplay'] == 'challenges') {echo "active";} ?>"" href="/ctfpage.php?page=challenges">Challenges</a></li>
          <li><a class="nav-link scrollto <?php if($_SESSION['pagetodisplay'] == 'team') {echo "active";} ?>" href="/ctfpage.php?page=team">Team</a></li>
          <li><a class="nav-link scrollto" href="/user/logout.php">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>


  <main id="main">
    <div class="wrapper">
  <?php
    $maindir = "";
    if(DIRECTORY_SEPARATOR === '/') {
        // unix, linux, mac
        $maindir = __DIR__ . "/";
    }

    if(DIRECTORY_SEPARATOR === '\\') {
        // windows
        $maindir = addslashes(__DIR__) . "\\\\";
    }

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
      if($userrow['team'] === NULL)
      {
        include($maindir . "team/team.php");
      }
      else
      {
        include($maindir . "leaderboard/leaderboard.php");
      }
    }
    else if($_GET['page'] == 'challenges')
    {
      $username = $_SESSION['logintoken'];
      $query2 = "SELECT * FROM users WHERE username='$username';";
      $queryresult2 = mysqli_query($conn, $query2);
      $userrow = mysqli_fetch_array($queryresult2, MYSQLI_ASSOC);
      if($userrow['team'] === NULL)
      {
        include($maindir . "team/team.php");
      }
      else
      {
        include($maindir . "challenges/challenges.php");
      }
    }

    else if($_GET['page'] == 'team')
    {
      include($maindir . "team/team.php");
    }

  ?>
  </div>

<div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs@1.1.1/js/purecounter.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/assets/js/alertify.js"></script>

  <script src="/assets/js/main.js"></script>

</body>

</html>
