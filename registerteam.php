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

<body>

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="../index.html">Killer Queen CTF<span>.</span></a></h1>


      <nav id="navbar" class="navbar">
        <ul>
          <a href="[adddiscordlink]"><img src="../assets/img/discord.png" style="width:50px; padding-right:25%"></a>
          <li><a class="nav-link scrollto " href="/">Home</a></li>
          <li><a class="nav-link scrollto active" href="/register">Register</a></li>
          <li><a class="nav-link" href="/login">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>


  <main id="main">
  <section id="login" class="login" >
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h3><span>Register:</span></h3>
          <p>Just a couple of inputs and you're all set! (one account per team). *note: If your team is found spam registering you WILL be disqualified</p>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100" >
          <div class="col-lg-6 center" >
            <form class="input-forms" action="/register" method="post">
              <div class="row">
                <div class="col form-group">
                  <input type="text" class="form-control" name="username" placeholder="Team Name" required>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="ref" placeholder="Referral Token (optional)">
              </div>
              <br>
              <div class="form-group">
               <input type="checkbox" id="hs" name="hs" value="Highschool"> <label for="hs"> Do you qualify for Highschool Division? (If not => College/Open Division) </label><br>
             </div>
              <div class="text-center"><button type="submit" class="btn btn-primary">Register</button></div>
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
