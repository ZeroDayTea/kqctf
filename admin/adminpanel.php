<?php
  include("../user/session.php");
  include("../config/config.php");

  // page only available to admins
  if(!$_SESSION['admin'])
  {
      header("Location:/user/logout");
      exit;
  }

  $username = $_SESSION['logintoken'];

  // used in table generation below
  $stmt = $conn->prepare("SELECT challengename FROM challenges WHERE released = 'false'");
  $stmt->execute();
  $result = $stmt->get_result();
  $counter = 1;
?>
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


      <?php if(isset($_GET['message']) && $_GET['message'] == 'incompleteData') {echo '<br><h5 style="color:red; text-align:center"> Incomplete Data passed </h5>';} ?>

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

      <div class="col-lg-7 center">
        <form class="input-forms" onsubmit="event.preventDefault(); userLookup();">
        <div class="section-title">
            <h3><span>User Lookup</span></h3>
        </div>
        <div class="row">
            <div class="col form-group">
            <input type="text" class="form-control" name="userlookup" id="userlookup" placeholder="Username" required>
            </div>
        </div>
        <br>
        <script>
            function userLookup() {
            let username = document.getElementById("userlookup").value;
            let locationto = "/ctfpage?page=admin&userlookup=" + username;
            window.location = locationto;
            }
        </script>
        <div class="text-center"><button type="submit" class="btn btn-primary">Lookup</button></div>
        <br>
        <table class="table scoreboard" style="border: none; background-color: white;">
            <thead style="text-align: center;">
            <tr>
                <th style="width: 4em; border-top: none;">UserID</th>
                <th style="width: 4em; border-top: none;">Username</th>
                <th style="width: 4em; border-top: none;">Email</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_GET['userlookup'])) {
                $userlookup = $_GET['userlookup'];
                $stmt = $conn->prepare("SELECT userid, email FROM users WHERE username=?");
                $stmt->bind_param("s", $userlookup);
                $stmt->execute();
                $stmt->bind_result($userid, $useremail);
                $stmt->fetch();
                $stmt->close();

                echo "<tr><th style=\"font-weight:normal;\">$userid</th><td style=\"font-weight:normal;\">$userlookup</td><td style=\"font-weight:normal;\">$useremail</td></tr>";
            }
            ?>
            </tbody>
        </table>
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
