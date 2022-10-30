<?php
    session_start();
    include("config.php");

    unset($errormsg);

    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = $_POST['password'];

      $query = "SELECT username, password FROM users WHERE username='$username';";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);

        if ($count == 1) 
        {
          if(password_verify($password, $row['password']))
          {
            $_SESSION['logintoken'] = $username;

            header("location:/ctfpage.php?page=home");
            exit();
          }
          else 
          {
            $errormsg = '<h6 class="text-center" style="color:red">Invalid Login</h6>';
          }
        } 
        else 
        {
            $errormsg = '<h6 class="text-center" style="color:red">Invalid Login</h6>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
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
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body style="background-color:#252525">

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="../index.php">Killer Queen CTF<span>.</span></a></h1>


      <nav id="navbar" class="navbar">
        <ul>
          <a href="[adddiscordlink]"><img src="../assets/img/discord.png" style="width:50px; padding-right:25%"></a>
          <li><a class="nav-link scrollto " href="/">Home</a></li>
          <li><a class="nav-link scrollto " href="/register.php">Register</a></li>
          <li><a class="nav-link active" href="/login.php">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>


  <main id="main">
  <section id="login" class="login" >
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h3><span>User Login:</span></h3>
          <p>If you haven't registered...do that first :p</p>
          <?php if (isset($errormsg)) echo $errormsg; ?>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100" >
          <div class="col-lg-6 center" >
            <form class="input-forms" action="login.php" method="post">
              <div class="row">
                <div class="col form-group">
                  <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
                </div>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
              </div>
              <div class="text-center"><button type="submit" class="btn btn-primary">Login</button></div>
            </form>
          </div>
        </div>
      </div>
  </section>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/input-forms/validate.js"></script>
  <script src="../assets/vendor/purecounter/purecounter.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>

  <script src="../assets/js/main.js"></script>

</body>

</html>
