       <h1 class="leaderboard">Teams Manager</h1>
	   
	   <a href="./?page=addteam" target="_parent">
	   <button>Add Team</button>
	   </a>
	   
	   <table width="100%" id="hover">
	   	<thead>
	   <tr>
	   <th>ID</th>
	   <th>Name</th>
	   <th>Username</th>
	   <th>Admin</th>
	   </tr>
	   </thead>

	   <tbody>
	 <?php
	   $query = "SELECT `teamID`, `admin`, `username`, `teamName` FROM `teams`;";
	   
$res = $mysqli->query($query);
while ($row = $res->fetch_array()) { 
?>
	   
	   <tr>
	   <td class="center">#<?php echo $row['teamID']; ?></td>
	   <td><a href="./?page=editteam&teamID=<?php echo $row['teamID']; ?>"><b><?php echo $row['teamName']; ?></b></a></td>
	   <td class="center"><?php echo $row['username']; ?></td>
	   <td class="center"><?php echo $row['admin']; ?></td>
	   </tr>
	   <?php
	}
	?>
	   </tbody>
	</table>
