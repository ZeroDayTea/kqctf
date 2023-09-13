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

<div class="modal fade" id="challengesolves-modal" tabindex="-1" aria-labelledby="challengesolves-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal-content">
            <div class="modal-header border-0">
              <h2 class="modal-title">Challenge Solves</h2>
            </div>
            <div class="modal-body" id="challengesolves-body">
              <!-- Data will be appended here -->
            </div>
            <div class="modal-footer border-0">
              <button type="button" class="btn btn-secondary" style="background-color: rgb(37, 37, 37);" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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

$(document).ready(function(){
    $('#challengesolves-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var challengename = button.closest('.challengeBox').find('.chal-title').text().trim();
        showSolves(challengename);
    });
});

function showSolves(challengename) {
        $.ajax({
                url: '/challenges/getsolves',
            type: 'POST',
            data: {challengename: challengename},
            success: function(response){
                var data = JSON.parse(response);
                console.log(data);
                var html = '<table class="table" style="border-radius: 10px; overflow: hidden;"><thead><tr><th>#</th><th>Team</th><th>Timestamp</th></tr></thead>';
                html += '<tbody class="table">'
                for(var i=0; i<data.length; i++){
                    html += '<tr><td>' + (i+1) + '</td><td>' + data[i].teamname + '</td><td>' + data[i].solvetime + '</td></tr>';
                }
                html += '</tbody></table>';
                $('#challengesolves-body').html(html);
                $('#challengesolves-modal').show();
            },
            error: function(response) {
                console.log("Error:");
                console.log(response);
            }
            });
    }
</script>
</div>


