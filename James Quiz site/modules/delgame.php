<?php
	   $GameID = htmlentities($_GET['GameID']);
$query = "SELECT `gName`, `status` FROM `games` WHERE `GameID` = '".$GameID."';";
	   
$res = $mysqli->query($query);
$game = $res->fetch_array();

if ($game) { 
	$mysqli->query("DELETE FROM `quiz`.`games` WHERE `games`.`GameID` = '".$GameID."';");
	$mysqli->query("DELETE FROM `quiz`.`questions` WHERE `questions`.`GameID` = '".$GameID."'");
	$mysqli->query("DELETE FROM `quiz`.`answers` WHERE `answers`.`GameID` = '".$GameID."';");
echo "<script>window.location = './?page=games';</script>";
} else {
	echo "something is wrong with the warp drive :-(";
}
?>