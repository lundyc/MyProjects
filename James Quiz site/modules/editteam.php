<?php 
if (isset($_GET['teamID']) && !(empty($_GET['teamID']))) {
	$teamID = $_GET['teamID'];

	$query = "SELECT * FROM `teams` WHERE `teamID` = '".$teamID."';";
	       
	$res = $mysqli->query($query);
	$team = $res->fetch_array();
  ?>
<script type="text/javascript">
	   $(document).ready(function() {
		     $(".delTeam").click(function(event) {
	       if (!confirm('Are you sure that you want to delete this Team?'))
	         event.preventDefault();
	     });
		});     
</script>

  <h1 class="leaderboard">Editing Team: <?php echo $team['teamName']; ?></h1>

  	<form action="./?page=editteam&teamID=<?php echo $teamID; ?>" autocomplete="off" method="post" id="EditTeam" name="EditTeam">
		<table width="100%">
			<tr>
				<td width="20%"><b>Team Name:</b></td>
				<td width="80%"><input class="input eighty" id="teamName" name="teamName" type="text" value="<?php echo $team['teamName']; ?>"></td>
			</tr>
			<tr>
				<td><b>Username:</b></td>
				<td><input class="input eighty" id="username" name="username" type="text" value="<?php echo $team['username']; ?>"></td>
			</tr>

			<tr>
				<td><b>Is Admin:</b></td>
				<td><input <?php echo ($team['admin'] == "yes") ? 'checked ' : ''; ?>
			class="correct-answer" id="admin" name="admin" type="checkbox" value="<?php echo $team['admin']; ?>">
			<label for="admin"></label>
				</td>
			</tr>

			<tr>
				<td><b>Password:</b></td>
				<td><input class="input eighty" id="password" name="password" type="text" value=""></td>
			</tr>

			<tr>
				<td><b>Points:</b></td>
				<td><input class="input eighty" id="points" name="points" type="text" value="<?php echo $team['points']; ?>"></td>
			</tr>

		</table>
	<button class="submit input twenty" type="submit" id="SaveTeam">
	Save Team
	</button> 
	
	<button class="delTeam submit input five delbutton" formaction="./?page=delteam&teamID=<?php echo $teamID; ?>" id="delete" name="submit" style="margin-right: 50px; float: right;" type="submit">
		<i class="fa fa-trash"></i>
	</button>
	</form>

<?php
} else {
	die("Team ID not set.");
}
?>