<?php
    // setting more secure session cookie properties
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_samesite', 'Strict');

    if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        ini_set('session.cookie_secure', 1);
    }

    session_name('session');

    session_start();

    include("../config/config.php");

    unset($errormsg);

    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $userquery = $conn->prepare("SELECT username, password, admin FROM users WHERE username=?;");
      $userquery->bind_param("s", $username);
      $userquery->execute();
      $userresult = $userquery->get_result();
      $userrow = $userresult->fetch_assoc();
      $usercount = $userresult->num_rows;
      $userquery->close();

        if ($usercount == 1)
        {
          if(password_verify($password, $userrow['password']))
          {
            $_SESSION['logintoken'] = $username;

            // check if admin user
            $_SESSION['admin'] = $userrow['admin'];

            header("location:/ctfpage?page=home");
            exit;
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
</head>

<body style="background-color:#252525">

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="/"><?php echo $_SESSION["ctfname"] ?> CTF<span>.</span></a></h1>


      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="/">Home</a></li>
          <li><a class="nav-link scrollto " href="register.php">Register</a></li>
          <li><a class="nav-link active" href="login.php">Login</a></li>
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
