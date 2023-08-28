<?php
  include("../user/session.php");
  include("../config/config.php");
  $username = $_SESSION['logintoken'];
  if($username === $configjson["adminusername"])
  {
    echo "Authorized!";
  }
  else
  {
    header("Location:/user/logout");
  }

  // used in table generation below
  $stmt = $conn->prepare("SELECT challengename FROM challenges WHERE released = 'false'");
  $stmt->execute();
  $result = $stmt->get_result();
  $counter = 1;
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
  <link href="/assets/css/ctf.css" rel="stylesheet">

</head>

<body style="background-color:#252525; margin: 0; padding: 0; height:100%; width: 100%;">

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="../ctfpage.php?page=home"><?php echo $_SESSION["ctfname"] ?> CTF<span>.</span></a></h1>


      <nav id="navbar" class="navbar">
        <ul>
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

    <section id="login" class="login" >
    <div class="section-title">
        <h2>Add and Update Challenges </h2>
    </div>
    <div class="container" data-aos="fade-up">
    <div class="row" data-aos="fade-up" data-aos-delay="100" >
      <div class="col-lg-6 center" >
        <form class="input-forms" action="/admin/addchallenge.php" method="post">
        <div class="section-title">
          <h3><span>Add New Challenge:</span></h3>
        </div>
          <div class="row">
            <div class="col form-group">
              <input type="text" class="form-control" name="challengename" placeholder="Challenge Name" required>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="challengedescription" placeholder="Challenge Description" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="challengeauthor" placeholder="Challenge Author" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="providedfile" placeholder="Name of Provided File">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="solutionflag" placeholder="Solution Flag" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="category" placeholder="Category" required>
            <div style="text-align:center">
            <p>crypto, misc, pwn, rev, or web (type exactly as seen)</p>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="basescore" placeholder="Basescore" required>
          </div>
          <br>
          <div class="text-center"><button type="submit" class="btn btn-primary">Add</button></div>
          <?php if(isset($_GET['message']) && $_GET['message'] == 'erroradd') {echo '<br><h5 style="color:red; text-align:center"> Error adding challenge </h5>';} ?>
          <?php if(isset($_GET['message']) && $_GET['message'] == 'successadd') {echo '<br><h5 style="color:green; text-align:center"> Added challenge successfully! </h5>';} ?>
        </form>
      </div>
      <div class="col-lg-6 center" >
        <form class="input-forms" action="/admin/updatechallenge" method="post">
        <div class="section-title">
          <h3><span>Edit Challenge:</span></h3>
        </div>
        <div class="row">
            <div class="col form-group">
              <input type="text" class="form-control" name="oldchallengename" placeholder="Old Challenge Name" required>
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
              <input type="text" class="form-control" name="challengename" placeholder="Challenge Name" required>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="challengedescription" placeholder="Challenge Description" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="challengeauthor" placeholder="Challenge Author" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="providedfile" placeholder="Name of Provided File">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="solutionflag" placeholder="Solution Flag" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="category" placeholder="Category" required>
            <div style="text-align:center">
            <p>crypto, misc, pwn, rev, or web (type exactly as seen)</p>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="basescore" placeholder="Basescore" required>
          </div>
          <br>
          <div class="text-center"><button type="submit" class="btn btn-primary">Update</button></div>
          <?php if(isset($_GET['message']) && $_GET['message'] == 'errorupdate') {echo '<br><h5 style="color:red; text-align:center"> Error updating challenge </h5>';} ?>
          <?php if(isset($_GET['message']) && $_GET['message'] == 'successupdate') {echo '<br><h5 style="color:green; text-align:center"> Updated challenge successfully! </h5>';} ?>
        </form>
      </div>
      <br>
      <div class="col-lg-6 center" >
        <form class="input-forms" action="/admin/releasechallenges" method="post">
        <div class="section-title">
          <h3><span>Release Challenges:</span></h3>
        </div>
        <div class="row">
            <div class="col form-group">
              <input type="text" class="form-control" name="releasechallenges" placeholder="Type 'yes' to release all unreleased challenges" required>
            </div>
          </div>
          <br>
          <div class="text-center"><button type="submit" class="btn btn-primary">Release</button></div>
          <?php if(isset($_GET['message']) && $_GET['message'] == 'errorrelease') {echo '<br><h5 style="color:red; text-align:center"> Error releasing challenges </h5>';} ?>
          <?php if(isset($_GET['message']) && $_GET['message'] == 'successrelease') {echo '<br><h5 style="color:green; text-align:center"> Released challenges successfully! </h5>';} ?>
          <?php if(isset($_GET['message']) && $_GET['message'] == 'norelease') {echo '<br><h5 style="color:red; text-align:center"> You need to type \'yes\' exactly to relase challenges </h5>';} ?>
        </form>
      </div>
</div>
</section>

      <div class="section-title">
        <h2>Unreleased Challenges </h2>
      </div>
        <div class="col-6 center" style="min-height: 230px;">
        <table class="table scoreboard" style="border: none; background-color: white;">
        <thead style="text-align: center;">
          <tr>
            <th style="width: 4em;border-top: none;">#</th>
            <th style="border-top: none;">Challenge Name</th>
          </tr>
        </thead>
        <tbody style="text-align: center;" id="sc-teams">
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td class="normal-font"><?= $counter ?></td>
                <td class="normal-font"><?= htmlspecialchars($row['challengename']) ?></td>
            </tr>
            <?php $counter++; ?>
        <?php endwhile; ?>
        </tbody>
        </table>

        <style>
            .normal-font {
                font-weight: normal;
            }
        </style>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs@1.1.1/js/purecounter.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.2.0/swiper-bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="/assets/js/main.js"></script>
</body>
</html>
