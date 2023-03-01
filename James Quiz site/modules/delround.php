<?php
$GameID = htmlentities($_GET['GameID']);
$round = htmlentities(($_GET['round']));
$query = "SELECT `gName`, `status` FROM `games` WHERE `GameID` = '".$GameID."';";
	   
$res = $mysqli->query($query);
$game = $res->fetch_array();

if ($game) { 

	$mysqli->query("DELETE FROM `quiz`.`questions` WHERE `questions`.`GameID` = '".$GameID."' AND `round` = '".$round."' ");
	$mysqli->query("DELETE FROM `quiz`.`answers` WHERE `answers`.`GameID` = '".$GameID."' AND `roundID` = '".$round."';");
echo "<script>window.location = './?page=editgame&GameID=".$GameID."';</script>";
} else {
	echo "something is wrong with the warp drive :-(";
}
?>