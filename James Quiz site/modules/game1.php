       <h1 class="leaderboard">Games Manager</h1>
	   
	   <a href="./?page=addgame" target="_parent">
	   <button>Add Game</button>
	   </a>
	   
	   <table width="100%" id="hover">
	   <thead>
	   <tr>
	   <th>Name</th>
	   <th>Status</th>
	   </tr>
	   </thead>
	   
	   <tbody>
	   <?php
	   $query = "SELECT `GameID`, `gName`, `status` FROM `games`;";
	   
$res = $mysqli->query($query);
while ($row = $res->fetch_array()) { 
?>
	   
	   <tr>
	   <td><a href="./?page=editgame&GameID=<?php echo $row['GameID']; ?>"><b><?php echo $row['gName']; ?></b></a></td>
	   <td class="center"><?php echo $row['status']; ?></td>
	   </tr>
<?php
}
?>	   
</tbody>
		   </table>
