<?php
$GameID = htmlentities($_GET['GameID']);

$query = "SELECT `round` FROM `questions` WHERE `GameID` = ".$GameID." GROUP BY `round` ORDER BY `questions`.`round` DESC LIMIT 1";		
$res = $mysqli->query($query);
$game = $res->fetch_array();

if ($game) { 
	$nextround = $game['round']+1;
$mysqli->query("INSERT INTO `quiz`.`questions` (`question_number`, `GameID`, `round`, `question`) VALUES (NULL, '".$GameID."', '".$nextround."', 'question 1');");

$query2 = "SELECT `question_number` FROM `questions` WHERE `GameID` = ".$GameID." AND `round` = '".$nextround."' AND `question` = 'question 1'";		
$res2 = $mysqli->query($query2);
$game2 = $res2->fetch_array();

$i = 1;
$rand = rand(1, 4);
while($i <= 4){
   $correct = ($i == $rand) ? 'yes' : 'no';
   $points = ($correct == "yes") ? '100' : '0';
$mysqli->query("INSERT INTO `quiz`.`answers` (`answerID`, `gameID`, `questionID`, `roundID`, `answer`, `correct`, `points`) VALUES (NULL, '".$GameID."', '".$game2['question_number']."', '".$nextround."', 'Answer ".$i."', '".$correct."', '".$points."');");
 $i++;
}

echo "<script>window.location = './?page=editgame&GameID=".$GameID."';</script>";

}
?>