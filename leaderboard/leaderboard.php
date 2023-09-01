  <div class="section-title">

  <h3>Main Leaderboard: </h3>
  </div>
  <div class="row" style="justify-content: center;margin: 0;margin-bottom: 50px;display: flex;">
<div class="col-3">
  <div class="challengeBox">
    <div class="form-group">
      <label for="filtereligibility">Division</label>
      <select class="form-control" id="leaderboardselect">
        <option value="All">All</option>
        <option value="High School Division">Highschool</option>
        <option value="Open/College Division">Open/College</option>
        <option value="Middleschool Division">Middleschool</option>
      </select>
      <br>
    </div>
  </div>
</div>
<script>
  document.getElementById('leaderboardselect').addEventListener('change', function() {
    var selectedLeaderboard = this.value;

    $.post("/leaderboard/leaderboardgetteams", { selectedLeaderboard : selectedLeaderboard }, function(response){
      var result = response;
      document.getElementById("sc-teams").innerHTML = response;
    });
});
</script>
<div class="col-6 " style="min-height: 230px;">
  <table class="table scoreboard" style="border: none; border-radius:25px;">
    <thead style="text-align: center; background-color:white; border-radius:25px;">
      <tr>
        <th style="width: 4em;border-top: none;">#</th>
        <th style="border-top: none;">Team</th>
        <th style="width: 5em;border-top: none">Points</th>
      </tr>
    </thead>
    <tbody style="text-align: center;" id="sc-teams">

    <?php
      $leaderboardquery = $conn->prepare("SELECT * FROM teams ORDER BY points DESC;");
      $leaderboardquery->execute();
      $result = $leaderboardquery->get_result();
      $counter = 1;

      while($leaderboardrow = $result->fetch_assoc())
      {
        $teamname = htmlspecialchars($leaderboardrow['teamname'], ENT_QUOTES, 'UTF-8');
        $teampoints = htmlspecialchars($leaderboardrow["points"], ENT_QUOTES, 'UTF-8');
        echo <<<HTML
            <tr class="" style="background-color:white">
            <td>{$counter}</td>
            <td><a class="ctflink" id="teamname-{$counter}" href="/ctfpage?page=team&team={$teamname}">{$teamname}</a></td>
            <td>{$teampoints}</td>
            </tr>
            HTML;
        $counter++;
      }

      $leaderboardquery->close();
    ?>
    </tbody>
  </table>
</div>
</div>
