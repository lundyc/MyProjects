<?php
$todaysdate = date('Y-m-d');

$position = '1';

$league = (empty($_GET['leagueID'])) ? 1 : $_GET['leagueID'];

$s_start = (isset($_GET['season']) && is_numeric($_GET['season'])) ? ' WHERE YEAR(`season_start`) = ' . $_GET['season'] : '';

$query = "SELECT `season_start`, `season_end`, YEAR(`season_start`) as `sea_start` FROM seasons " . $s_start;
$result = $mysqli->query($query);
$row = $result->fetch_assoc();

$season_start = $row["season_start"];
$season_end = $row["season_end"];
$sea_start = $row['sea_start'];				

$season = (empty($_GET['season'])) ? $sea_start : $_GET['season'];
?>

<div class="module"><div class="mb"><h2>
<span style="float: right;">
<select class="dropdown-select" id="league_select">
<?php
$leagueS = "SELECT `matchtype_id`, `matchtype` FROM `matchtypes` ORDER BY `matchtype_id`";
$league_query = $mysqli->query($leagueS) or die($mysqli->error.__LINE__);
while ($row = $league_query->fetch_assoc()) {
	$selected = (isset($_GET['leagueID']) && $_GET['leagueID'] == $row['matchtype_id']) ? 'selected' : '';
	echo '<option value="'. $row['matchtype_id'].'" '. $selected . '/>'. $row['matchtype'] . '</option>';
}

?>
</select>

<select class="dropdown-select" id="dynamic_select">
<?php
$seasons = "SELECT YEAR(`season_start`) as `s_start`, YEAR(`season_end`) as `s_end` FROM `seasons` ORDER BY `season_id`";
$season_query = $mysqli->query($seasons) or die($mysqli->error.__LINE__);
while($row = $season_query->fetch_assoc()) {
	$selected = (isset($_GET['season']) && is_numeric($_GET['season']) && $_GET['season'] == $row['s_start']) ? 'selected' : '';
?>
<option value="<?php echo $row['s_start']; ?>" <?php echo $selected; ?> /><?php echo $row['s_start'] . " / " . $row['s_end']; ?></option>
<?php
}
?>
</select>

<script>
    $(function(){
      // bind change event to select
      $('#dynamic_select').bind('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = './?page=championship&leagueID=<?php echo $league; ?>&season=' + url; // redirect
          }
          return false;
      });
	  
	  $('#league_select').bind('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
		  window.location = './?page=championship&leagueID=' + url + '&season=<?php echo $season; ?>'; // redirect
          }
          return false;
      });
    });
</script>
</span>
Championship Table : Company Section

</h2>	  

<table cellspacing="1" width="100%" id="league">
<tr>
<th width="2%" align="center" title="Position">Pos</th>
<th  align="center" title="Team Name">Team</th>

<?PHP
$test = array();

$activites = "SELECT `title`, `act_id` FROM `championship_activites` WHERE `section` = '".$league."'";
$activites_query = $mysqli->query($activites) or die($mysqli->error.__LINE__);
while($row = $activites_query->fetch_assoc()) {
	$test[] = $row['act_id'];
?>
<th align="center" title="<?php echo $row['title']; ?>">
<?php 
if (str_word_count($row['title'], 0) > 1) {
	$words = explode(" ", $row['title']);
$acronym = "";

foreach ($words as $w) {
  $acronym .= $w[0];
}
echo $acronym;
} else {
	echo $row['title'];
}
?>
</th>
<?php
}
?>
<th width="5%" align="center" title="Total">Total</th>
    </tr>

<?php
//---------------------------------
// Select all teams from database (this will be used to set the teams DB with total points for sorting)
//---------------------------------
$dbQuery = "SELECT 
		`company`.`CompanyID`,
		`company`.`Name`,
	
(
    SELECT SUM(`score`) 
    FROM `champ_score` 
    WHERE
     `champ_score`.`team_id` = `company`.`CompanyID` 
    AND 
    `champ_score`.`league` = '".$league."' 
    GROUP BY `champ_score`.`team_id`) as `champ_total`

FROM `company` ORDER BY `champ_total` DESC";

$result = $mysqli->query($dbQuery) or die("Couldn't get teams");
while($row = $result->fetch_assoc()) {
$teamname = $row["Name"];
$teamID = $row['CompanyID'];

$border = ($position == 1 || $position == 3) ? 'style="border-bottom: 1px dashed #CCC;" ' : '';

$total = 0;
?>

<tr>
<td align="center" <?php echo $border; ?>><?php echo $position; ?></td>
<td <?php echo $border; ?>><?php echo $teamname; ?></td>
<?php
foreach ($test as $key => $value) {
	
$dbQuery2 = "SELECT `score` FROM `champ_score` WHERE `activity_id` = '".$value."' AND `team_id` = '".$teamID."' AND `league` = '".$league."';";
$result2 = $mysqli->query($dbQuery2) or die("Couldn't get scores");
$score = $result2->fetch_assoc();
$score['score'] = (!isset($score['score'])) ? '0' : $score['score'];

$total = ($total + $score['score']);
?>
<td align="center" <?php echo $border; ?>><?php echo $score['score']; ?></td>
<?php
}
?>
</td>
<td align="center" <?php echo $border; ?>><?php echo $total; ?></td>
</tr>
<?php
++$position;
}
?>
</table>
</div></div>


<div class="module"><div class="mb"><h2>Overall</h2>
<table width="100%">
<tr>
<th>POS</th>
<th>Company Name</th>
<th>Company Section</th>
<th>Junior Section</th>
<th>Total</th>
</tr>

<?php
	$dbQuery = "SELECT 
			`company`.`CompanyID`,
			`company`.`Name`,
		
		(SELECT SUM(`score`) 
		FROM `champ_score` 
		WHERE
		 `champ_score`.`team_id` = `company`.`CompanyID` 
		AND 
		`champ_score`.`league` = '1' 
		GROUP BY `champ_score`.`team_id`) as `junior_total`,
		
		(SELECT SUM(`score`) 
		FROM `champ_score` 
		WHERE
		 `champ_score`.`team_id` = `company`.`CompanyID` 
		AND 
		`champ_score`.`league` = '2' 
		GROUP BY `champ_score`.`team_id`) as `company_total`,
		
		(SELECT SUM(`score`) 
		FROM `champ_score` 
		WHERE
		 `champ_score`.`team_id` = `company`.`CompanyID` 
		GROUP BY `champ_score`.`team_id`) as `champ_total`

	FROM `company` ORDER BY `champ_total` DESC";

$pos = 1;
$result = $mysqli->query($dbQuery) or die("Couldn't get teams");
while($row = $result->fetch_assoc()) {
$teamname = $row["Name"];
$teamID = $row['CompanyID'];
?>

<tr>
<td><?php echo $pos; ?></td>
<td><?php echo $teamname; ?></td>
<td><?php echo $row['company_total']; ?></td>
<td><?php echo $row['junior_total']; ?></td>
<td><?php echo $row['champ_total']; ?></td>
</tr>
<?php
++$pos;
}
?>
</table>

</div></div>