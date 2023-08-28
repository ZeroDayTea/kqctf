<div class='section-title'>
<h2>Challenges</h2>
</div>
<div class='row' style='justify-content: center;margin: 0;margin-bottom: 50px;display: flex;'>
  <div class='col-3' id='sidebox'>
    <div class='challengeBox'>
      <b style='font-size: 18px;margin-bottom: 5px;'>Filters</b>
      <div class='form-check'>
        <input class='form-check-input' type='checkbox' value='' id='checkbox-solved'>
        <label class='form-check-label' for='checkbox-solved' id='display-solvecount'>
          Include Solved (0/0 solved)
        </label>
      </div>
    </div>
    <div class='challengeBox'>
      <b style='font-size: 18px;margin-bottom: 5px;'>Categories</b>
      <div class='form-check'>
        <input class='form-check-input' type='checkbox' value='' id='checkbox-crypto'>
        <label class='form-check-label' for='checkbox-crypto' id='display-crypto'>
          crypto <a id='crypto-solve'>0/0</a> solved
        </label>
      </div>
      <div class='form-check'>
        <input class='form-check-input' type='checkbox' value='' id='checkbox-misc'>
        <label class='form-check-label' for='checkbox-misc' id='display-misc'>
          misc <a id='misc-solve'>0/0</a> solved
        </label>
      </div>
      <div class='form-check'>
        <input class='form-check-input' type='checkbox' value='' id='checkbox-pwn'>
        <label class='form-check-label' for='checkbox-pwn' id='display-pwn'>
          pwn <a id='pwn-solve'>0/0</a> solved
        </label>
      </div>
      <div class='form-check'>
        <input class='form-check-input' type='checkbox' value='' id='checkbox-rev'>
        <label class='form-check-label' for='checkbox-rev' id='display-rev'>
          rev <a id='rev-solve'>0/0</a> solved
        </label>
      </div>
      <div class='form-check'>
        <input class='form-check-input' type='checkbox' value='' id='checkbox-web'>
        <label class='form-check-label' for='checkbox-web' id='display-web'>
          web <a id='web-solve'>0/0</a> solved
        </label>
      </div>
    </div>
  </div>

<div class='col-6' id='challengesDisplay'>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    function getChallenges() {
      var solved = document.getElementById('checkbox-solved').checked;
      var crypto = document.getElementById('checkbox-crypto').checked;
      var misc = document.getElementById('checkbox-misc').checked;
      var pwn = document.getElementById('checkbox-pwn').checked;
      var rev = document.getElementById('checkbox-rev').checked;
      var web = document.getElementById('checkbox-web').checked;

      var checked = [solved, crypto, misc, pwn, rev, web];
      var checkedJSON = JSON.stringify( checked );

      $.post("/challenges/getchallenges", { checkedJSON : checkedJSON }, function(response){
        var result = response;
        document.getElementById("challengesDisplay").innerHTML = response;
      });

      $.post("/challenges/getchallengecounts", { }, function(response){
        var result = response;
        var resultArray = JSON.parse(result);
        document.getElementById("display-solvecount").innerHTML = resultArray[5];
        document.getElementById("display-crypto").innerHTML = resultArray[0];
        document.getElementById("display-misc").innerHTML = resultArray[1];
        document.getElementById("display-pwn").innerHTML = resultArray[2];
        document.getElementById("display-rev").innerHTML = resultArray[3];
        document.getElementById("display-web").innerHTML = resultArray[4];

      });
    }

    document.getElementById('checkbox-solved').addEventListener('change', getChallenges);
    document.getElementById('checkbox-crypto').addEventListener('change', getChallenges);
    document.getElementById('checkbox-misc').addEventListener('change', getChallenges);
    document.getElementById('checkbox-pwn').addEventListener('change', getChallenges);
    document.getElementById('checkbox-rev').addEventListener('change', getChallenges);
    document.getElementById('checkbox-web').addEventListener('change', getChallenges);

    window.onload = getChallenges;
  </script>
  <script>
    function checkFlag(event) {
      var element = $(event.target);
      var flagguess = element.closest("div.chal-des").find("input[name='flaginput']").val();
      var challengeguess = element.closest("div.chal-des").closest("div.challengeBox").children('.row').children('.col-6').children('.chal-title').attr('name');

      var info = [challengeguess, flagguess];
      var infoJSON = JSON.stringify( info );
      $.post("/challenges/checkflag", { infoJSON : infoJSON }, function(response){
        var result = response;
        if(result == "Correct!")
        {
          alertify.success("Correct!");
          element.closest("div.chal-des").find("input[name='flaginput']").val('');
          getChallengesAndSolves();
        }
        else if(result == "You already solved this challenge!")
        {
          alertify.message("Your team already solved this challenge!");
          element.closest("div.chal-des").find("input[name='flaginput']").val('');
        }
        else if(result == "Incorrect guess!")
        {
          alertify.error("That flag is incorrect");
        }
        else
        {
          alertify.error("Error submitting flag");
        }
      });
    }
  </script>
  </div>
