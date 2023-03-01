<?php
/*
MP or P - matches played or played (in short terms) 
W - matches won 
D - matches drawn 
L - matches lose 
GF or F - goals for or goals scored 
GA or A - goals against or goals conceded 
GD - goal difference (goals scored minus goals conceded) 
Pts - points

3 points per win 
1 point for a draw 
0 for a loss. 
*/
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

$query = "SELECT CONCAT(YEAR(`season_start`), ' / ', YEAR(`season_end`)) as `season_name` FROM `seasons` WHERE `season_start` = '$season_start' AND season_end = '$season_end';";
$result = $mysqli->query($query);	
$row = $result->fetch_assoc();
$season_name = $row["season_name"];

$query = "SELECT `matchtype`, `division`, `matchtype_id` FROM matchtypes WHERE matchtype_id = '". $league ."'; ";
$result = $mysqli->query($query);
while($row = $result->fetch_assoc()) {
$matchtype = $row["matchtype"];
$division = $row["division"];
}
?>
<style>
#league th { 
border-bottom: 1px solid #000;
}
</style>
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
              window.location = './?page=football&leagueID=<?php echo $league; ?>&season=' + url; // redirect
          }
          return false;
      });
	  
	  $('#league_select').bind('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
		  window.location = './?page=football&leagueID=' + url + '&season=<?php echo $season; ?>'; // redirect
          }
          return false;
      });
    });
</script>
</span>
<?php echo $matchtype; ?> : <?php echo $season_name; ?></h2>	  

<table cellspacing="1" width="100%" id="league">
<tr>
<th width="4%" align="center" title="Position">Pos</th>
<th width="35%" align="center" title="Team Name">Team</th>
<th width="4%" align="center" title="Matches Played">P</th>
<th width="4%" align="center" title="Matches Won">W</th>
<th width="4%" align="center" title="Matches Drawn">D</th>
<th width="4%" align="center" title="Matches Lost">L</th>
<th width="4%" align="center" title="Matches Goals For">F</th>
<th width="4%" align="center" title="Matches Goals Against">A</th>
<th width="4%" align="center" title="Goal Differance">GD</th>
<th width="4%" align="center" title="Points">Pts</th>
    </tr>

<?php
//---------------------------------
// Select all teams from database (this will be used to set the teams DB with total points for sorting)
//---------------------------------
$dbQuery = "SELECT team_name, `team_id` FROM teams WHERE `league_name` = '". $league ."' ORDER BY points_total DESC"; 
$result = $mysqli->query($dbQuery) or die("Couldn't get teams");
while($row = $result->fetch_assoc()) {
$teamname = $row["team_name"];
$teamID = $row['team_id'];


//-------------------------------
// select total points for team
//-------------------------------

$getpoints = "SELECT sum(points) as points FROM league_table WHERE teamID = '$teamID' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$pointsresult = $mysqli->query($getpoints) or die($mysqli->error.__LINE__);
list($points) = $pointsresult->fetch_row();
	if ($points == '') {
		$points = '0';
	}

//-------------------------------
// select total goals for team
//-------------------------------
$dbQuery = "SELECT goals_for FROM league_table WHERE teamID = '$teamID' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end'  "; 
$goals_for = $mysqli->query($dbQuery) or die("Couldn't get goals for");

$goalsfor = "SELECT sum(goals_for) as goalsf FROM league_table WHERE teamID = '$teamID' AND match_type='$league'"; 
$goalsfresult = $mysqli->query($goalsfor) or die($mysqli->error.__LINE__);
list($gfor) = $goalsfresult->fetch_row();

//-------------------------------
// select total goals against for team - to insert into teams for sorting leaguetable
//-------------------------------
$dbQuery = "SELECT goals_against FROM league_table WHERE teamID = '$teamID' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$goals_against = $mysqli->query($dbQuery) or die("Couldn't get goals against");

$goalsagainst = "SELECT sum(goals_against) as goalsa FROM league_table WHERE teamID = '$teamID' AND match_type='$league'"; 
$goalsaresult = $mysqli->query($goalsagainst) or die($mysqli->error.__LINE__);

list($gagainst) = $goalsaresult->fetch_row();

if ($gfor == '') {
		$gfor = '0';
	}

if ($gagainst == '') {
		$gagainst = '0';
	}

$gd = ("$gfor" - "$gagainst");

//-----------------------------------------------------
// insert total points into team table for sorting purpose
//-----------------------------------------------------

$query="UPDATE teams SET points_total='$points', goaldiff='$gd' WHERE team_id='$teamID'"; 
$mysqli->query($query); 
}


//---------------------------------
// Select all teams from database - This now starts the selecting for populating the league table
//---------------------------------
$dbQuery = "SELECT `team_name`, `team_id` FROM `teams` WHERE `league_name` = '".$league."' ORDER BY points_total DESC, goaldiff DESC"; 
$result = $mysqli->query($dbQuery) or die($mysqli->error.__LINE__);
while($row = $result->fetch_assoc()) {
$teamname = $row["team_name"];
$teamID = $row['team_id'];

//-------------------------------
// select total points for team
//-------------------------------
$getpoints = "SELECT sum(points) as points FROM league_table WHERE teamID = '$teamID' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end'  "; 
$pointsresult = $mysqli->query($getpoints) or die($mysqli->error.__LINE__);

list($points) = $pointsresult->fetch_row();

	if ($points == '') {
		$points = '0';
	}

//-------------------------------
// select number of wins
//-------------------------------
$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'W' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end'  "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get wins");
$win = $w_d_l->num_rows;

//-------------------------------
// select number of losses
//-------------------------------
$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'L' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get losses");
$lose = $w_d_l->num_rows;

//-------------------------------
// select number of draws
//-------------------------------
$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'D' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get draws");
$draw = $w_d_l->num_rows;

//-------------------------------
// select number of home wins
//-------------------------------
$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'W' AND home_away='home' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get home wins");
$homewin = $w_d_l->num_rows;

//-------------------------------
// select number of home losses
//-------------------------------
$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'L' AND home_away='home' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end'  "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get home losses");
$homelose = $w_d_l->num_rows;

//-------------------------------
// select number of home draws
//-------------------------------
$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'D' AND home_away='home' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get home draws");
$homedraw = $w_d_l->num_rows;

//-------------------------------
// select number of away wins
//-------------------------------
$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'W' AND home_away='away' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get away wins");
$awaywin = $w_d_l->num_rows;

//-------------------------------
// select number of away losses
//-------------------------------
$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'L' AND home_away='away'  AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get away losses.");
$awaylose = $w_d_l->num_rows;

//-------------------------------
// select number of wins
//-------------------------------
$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'W' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end'  "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get number of wins");
$win = $w_d_l->num_rows;

$dbQuery = "SELECT w_d_l FROM league_table WHERE teamID = '$teamID' AND w_d_l = 'D' AND home_away='away' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$w_d_l = $mysqli->query($dbQuery) or die("Couldn't get Draws");
$awaydraw = $w_d_l->num_rows;

//-------------------------------
// select games played
//-------------------------------
$dbQuery = "SELECT `teamID` FROM `league_table` WHERE `teamID` = '".$teamID."'  AND `match_type` = '".$league."' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$pld = $mysqli->query($dbQuery) or die("Couldn't get games played");
$totalpld = $pld->num_rows;

	if ($totalpld == '') {
		$totalpld = '0';
	}

//-------------------------------
// select total goals for team
//-------------------------------
$dbQuery = "SELECT goals_for FROM league_table WHERE teamID = '$teamID' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end'  "; 
$goals_for = $mysqli->query($dbQuery) or die("Couldn't get goals for");

$goalsfor = "SELECT sum(goals_for) as goalsf FROM league_table WHERE teamID = '$teamID' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$goalsfresult = $mysqli->query($goalsfor) or die($mysqli->error.__LINE__);

list($goalsf) = $goalsfresult->fetch_row();


if ($goalsf == '') {
		$goalsf = '0';
	}


//-------------------------------
// select total goals against for team
//-------------------------------
$dbQuery = "SELECT goals_against FROM league_table WHERE teamID = '$teamID' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$goals_against = $mysqli->query($dbQuery) or die("Couldn't get goals against for team.");

$goalsagainst = "SELECT sum(goals_against) as goalsa FROM league_table WHERE teamID = '$teamID' AND match_type='$league' AND match_date >= '$season_start' AND match_date <= '$season_end' "; 
$goalsaresult = $mysqli->query($goalsagainst) or die($mysqli->error.__LINE__);

list($gagainst) = $goalsaresult->fetch_row();



if ($gagainst == '') {
		$gagainst = '0';
	}

$gd = ($goalsf - $gagainst);
$border = ($position == 1 || $position == 3) ? 'style="border-bottom: 1px dashed #CCC;" ' : '';
?>

<tr>
<td align="center" <?php echo $border; ?>><?php echo $position; ?></td>
<td <?php echo $border; ?>><?php echo $teamname; ?></td>
<td align="center" <?php echo $border; ?>><?php echo $totalpld; ?></td>
<td align="center" <?php echo $border; ?>><?php echo $win; ?></td>
<td align="center" <?php echo $border; ?>><?php echo $draw; ?></td>
<td align="center" <?php echo $border; ?>><?php echo $lose; ?></td>
<td align="center" <?php echo $border; ?>><?php echo $goalsf; ?></td>
<td align="center" <?php echo $border; ?>><?php echo $gagainst; ?></td>
<td align="center" <?php echo $border; ?>>
<?php 
echo ($gd > '0') ? '+' : '';
echo $gd;
?>
</td>
<td align="center" <?php echo $border; ?>><?php echo $points; ?></td>
</tr>
<?php
++$position;
}
?>
</table>
</div></div>

<div class="module"><div class="mb"><h2>Fixtures & Results</h2>

<?php
// time to select dates 
$query = "SELECT `fix_date`, DATE_FORMAT(`fix_date`, '%a, %D %b %Y') as `form_date` FROM `fixtures` WHERE `match_type` = '".$league."' AND `fix_date` >= '".$season_start."' AND `fix_date` <= '".$season_end."' GROUP BY `fix_date`";
$fixdates = $mysqli->query($query) or die($mysqli->error.__LINE__);
while($drow = $fixdates->fetch_assoc()) {

$query = "SELECT 
`fix_id`,
`team_A`,
`team_B`,
`closed`,
(SELECT `team_name` FROM `teams` WHERE `teams`.`team_id` = `fixtures`.`team_A`) as `team_A_name`,
(SELECT `team_name` FROM `teams` WHERE `teams`.`team_id` = `fixtures`.`team_B`) as `team_B_name`
 FROM `fixtures` WHERE `match_type` = '".$league."' AND `fix_date` = '".$drow['fix_date']."'";

$fixresults = $mysqli->query($query) or die($mysqli->error.__LINE__);
// while($row = $result->fetch_assoc()) 
$tmp = array(); 

$columns = (isMobile()) ? '1' : '2';

$row = ceil($fixresults->num_rows / $columns);  
for ($x =1; $x <= $columns; $x++) 
  for ($y = 1; $y <= $row; $y++) 
     $tmp[$x][$y] = $fixresults->fetch_assoc(); 

?>

<table align="center" width="100%">
<tr>
<td colspan="2" align="center" style="border-bottom: 1px solid #000"><b><?php echo $drow['form_date']; ?></b></td>
</tr>
<?php
  for ($y =1; $y <= $row; $y++) { 
   echo "<tr>"; 
   
  for ($x = 1; $x <= $columns; $x++) {
    if (isset($tmp[$x][$y]['fix_id'])) {
        echo "<td>";
		
		 if ($tmp[$x][$y]['closed'] == 'yes') {
			 // lets see what the score is ....
			 $scoreQuery  = "SELECT `goals_for`, `goals_against` FROM `league_table` WHERE `match_id` = '".$tmp[$x][$y]['fix_id']."' GROUP BY `match_id`";
			 $scoreresult = $mysqli->query($scoreQuery) or die($mysqli->error.__LINE__);
			 $score = $scoreresult->fetch_assoc(); 
			 
	 $tmp[$x][$y]['team_A_score'] = $score['goals_for'];
	 $tmp[$x][$y]['team_B_score'] = $score['goals_against'];
 }
 
 echo '<table width="100%">';
 echo '<tr>';
 			echo '<td width="40%">'. $tmp[$x][$y]['team_A_name'] . "</td>";
			echo '<td align="center">';
			if (isset($tmp[$x][$y]['team_A_score'])) { 
				echo  "<b>". $tmp[$x][$y]['team_A_score'] . " - ". $tmp[$x][$y]['team_B_score']. "</b>";
			} else {
				echo 'vs';
			}
			echo "</td>";
			echo "<td width='40%'>". $tmp[$x][$y]['team_B_name']. "</td>";
			echo '</tr>';
 echo '</table>';
		echo "</td>"; 
  } else {
        echo "<td></td>"; 
	echo "</tr>\n"; 
  }
} 
}
}
?>
</table>  
</div></div>