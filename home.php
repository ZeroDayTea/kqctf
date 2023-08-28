  <div style="text-align:center;">
    <div style="width: 800px; margin: 0 auto;">
      <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100" style="text-align:center">
          <img src="/assets/img/logo.png" alt="Logo" width="300" height="374">
          <br><br><br>
          <h1><span><?php echo $_SESSION["ctfname"] ?> CTF</span></h1>
        </div>
      </section>
      <div>
        <script src="https://cdn.logwork.com/widget/countdown.js"></script>
        <a target="_blank" href="https://logwork.com/countdown-1gbr" class="countdown-timer" data-timezone="<?php echo $configjson['ctftimertimezone'] ?>" data-textcolor="#f8f8f8" data-date="<?php echo $configjson['ctftimerend'] ?>" data-background="#494949" data-digitscolor="#d4595a" data-unitscolor="#b8b8b8" style="pointer-events: none;">&nbsp</a>
      </div>
    </div>
  </div>

  <main id="main" >
    <section class="about section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Our CTF...</h2>
          <h3><?php echo $_SESSION['ctfname'] ?> CTF</span></h3>
        </div>

        <div class="col-lg-15 pt-4 pt-lg-2 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <?php
              echo $configjson['homepageinfo'];
            ?>
        </div>
      </div>
    </section>
    <br>
