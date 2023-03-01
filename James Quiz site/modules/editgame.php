<?php
	$GameID = $_GET['GameID'];

if (isset($_POST['gName']) && !(empty($_POST['gName']))) {
	$gName = htmlentities($_POST['gName']);
	$status = $_POST['status'];

$mysqli->query("UPDATE `quiz`.`games` SET `gName` = '".$gName."', `status` = '".$status."' WHERE `games`.`GameID` = ".$GameID.";");

foreach ($_POST['question'] as $key => $value) {
$mysqli->query("UPDATE `quiz`.`questions` SET `question` = '".$value."' WHERE `questions`.`question_number` = ".$key.";");
}

foreach ($_POST['answers'] as $key => $value) {
	$value['correct'] = (empty($value['correct'])) ? 'no' : $value['correct'];
	$mysqli->query("UPDATE `quiz`.`answers` SET `answer` = '".$value['answer']."', `correct` = '".$value['correct']."', `points` = '".$value['points']."' WHERE `answers`.`answerID` = ".$key.";");
}

$_SESSION['saved'] = "y";
	echo '<script>';
		echo 'window.location = "./?page=editgame&GameID='.$GameID.'"';
	echo '</script>';
} else {

	if (isset($_GET['action']) && $_GET['action'] == "AddQuestion") {
		if (isset($_POST['addQuestionSubmit'])) {
	$newGameID = $_GET['GameID'];
	$round = $_GET['round'];
	$question = $_POST['question'];

	$gameQ = "INSERT INTO `quiz`.`questions` (`GameID`, `round`, `question`) VALUES ('".$newGameID."', '".$round."', '".$question."');";
	$mysqli->query($gameQ) or die ($mysqli->error.__LINE__);

	$GetQuestionID = "SELECT `question_number` FROM `questions` WHERE `GameID` = '".$newGameID."' AND `question` = '".$question."'";		
	$QuestionQuery = $mysqli->query($GetQuestionID) or die ($mysqli->error.__LINE__);
	$ques = $QuestionQuery->fetch_array();

			foreach ($_POST['answers'] as $key => $value) {
				$value['correct'] = (isset($value['correct'])) ? 'yes' : 'no';
				$answerQ = "INSERT INTO `quiz`.`answers` (`gameID`, `questionID`, `roundID`, `answer`, `correct`, `points`) VALUES ('".$newGameID."', '".$ques['question_number']."', '".$round."', '".$value['answer']."', '".$value['correct']."', '".$value['points']."');";
				$mysqli->query($answerQ) or die ($mysqli->error.__LINE__);
			}
	echo '<script>';
		echo 'window.location = "./?page=editgame&GameID='.$newGameID.'"';
	echo '</script>';
} else {
		$RoundID = $_GET['round'];
?>
<script type="text/javascript">
	$(document).on('click', '#cancel', function() {
    parent.history.back();
});

</script>

<h1 class="leaderboard">Edit Game - Add Question to Round <?php echo $RoundID; ?></h1>
  <form id="AddQuestionForm" name="AddQuestionForm" action="./?page=editgame&action=AddQuestion&GameID=<?php echo $GameID; ?>&round=<?php echo $RoundID; ?>" method="POST">
	    <label for="question"><b>Question:</b></label> 
	    <input class="input eighty field" id="question" name="question" required="required" type="text">
	    <br>
	    
	    <input class="correct-answer" id="answers[1][correct]" name="answers[1][correct]" type="checkbox" value="yes"> 
	    <label for="answers[1][correct]"></label> 

	    <input class="input seventy-nine" id="answers[1][answer]" name="answers[1][answer]" placeholder="Answer 1" required="" type="text"> 

	    <input class="input twenty" id="answers[1][points]" maxlength="4" name="answers[1][points]" placeholder="0" required="" size="2" type="text">
	    <br>
	    
	    <input class="correct-answer" id="answers[2][correct]" name="answers[2][correct]" type="checkbox" value="yes"> 
	    <label for="answers[2][correct]"></label> 

	    <input class="input seventy-nine" id="answers[2][answer]" name="answers[2][answer]" placeholder="Answer 2" required="" type="text"> 

	    <input class="input twenty" id="answers[2][points]" maxlength="4" name="answers[2][points]" placeholder="0" required="" size="2" type="text">
	    <br>
	    
	    <input class="correct-answer" id="answers[3][correct]" name="answers[3][correct]" type="checkbox" value="yes">
	    <label for="answers[3][correct]"></label> 

	    <input class="input seventy-nine" id="answers[3][answer]" name="answers[3][answer]" placeholder="Answer 3" required="" type="text"> 

	    <input class="input twenty" id="answers[3][points]" maxlength="4" name="answers[3][points]" placeholder="0" required="" size="2" type="text">

	    <br>
	    <input class="correct-answer" id="answers[4][correct]" name="answers[4][correct]" type="checkbox" value="yes"> 
	    <label for="answers[4][correct]"></label> 

	    <input class="input seventy-nine" id="answers[4][answer]" name="answers[4][answer]" placeholder="Answer 4" required="" type="text"> 

	    <input class="input twenty" id="answers[4][points]" maxlength="4" name="answers[4][points]" placeholder="0" required="" size="2" type="text">

	    <br>
	    
	    <button class="input twenty delbutton" style="float: left !important;" type="button" id="cancel">Cancel</button> 

	    <button class="input twenty" id="addQuestionSubmit" name="addQuestionSubmit" style="float: right;" type="submit">Add</button>
	  </form>
	
<?php
}
	} else {
	$query = "SELECT `gName`, `status` FROM `games` WHERE `GameID` = '".$GameID."';";
	       
	$res = $mysqli->query($query);
	$game = $res->fetch_array();

	$query2 = "SELECT round FROM `questions` WHERE `GameID` = ".$GameID." GROUP BY `round` ORDER BY `questions`.`round` DESC LIMIT 1";
	$res2 = $mysqli->query($query2);
	$max = $res2->fetch_array();
?>

<script type="text/javascript">
	   $(document).ready(function() {
    $('.correct-answer').on('change', function() {
        $('.correct-answer').not(this).prop('checked', false);  
    });

	     $(".testform").click(function(event) {
	       if (!confirm('Are you sure that you want to delete this game?'))
	         event.preventDefault();
	     });

	     $(".delRound").click(function(event) {
	       if (!confirm('Are you sure that you want to delete this round?'))
	         event.preventDefault();
	     });

	$(".addQuestion").click(function() {
		var round = $(this).attr("data-roundID");
    	window.location = "./?page=editgame&action=AddQuestion&GameID=<?php echo $GameID; ?>&round=" + round;
});

	   });
	</script>
	
<h1 class="leaderboard">Edit Game</h1>

<?php
if (isset($_SESSION['saved']) && $_SESSION['saved'] == "y") {
	echo "<div style='background-color: #28a745; color: #FFFFFF; padding: 3px; border: 1px solid #009929; text-align: center;'>Your game has been saved.</div>";
	unset($_SESSION['saved']);
}
?>
	<form action="./?page=editgame&GameID=<?php echo $GameID;?>" autocomplete="off" method="post" id="EditGame" name="EditGame">
		<table width="100%">
			<tr>
				<td width="20%"><b>Game Name:</b></td>
				<td width="80%"><input class="input eighty" id="gName" name="gName" type="text" value="<?php echo $game['gName']; ?>"></td>
			</tr>
			<tr>
				<td><b>Status:</b></td>
				<td><select class="input eighty" id="status" name="status">
					<option value="upcoming">
						Upcoming
					</option>
					<option value="started">
						Started
					</option>
					<option value="stopped">
						Stopped
					</option>
				</select></td>
			</tr>

			<?php
			$query2 = "SELECT round FROM `questions` WHERE `GameID` = ".$GameID." GROUP BY `round`;";
			$res2 = $mysqli->query($query2);

			$q = 1;
			while ($rounds = $res2->fetch_array()) {

			    $query3 = "SELECT `question_number`, `GameID`, `round`, `question` FROM `questions` WHERE `GameID` = '".$GameID."' AND `round` = '".$rounds['round']."';";
			    $res3 = $mysqli->query($query3);

			?>
			<tr>
				<td valign="middle" style="background-color: #E4E4E4;">
					<span class="leaderboard" style="vertical-align: bottom">
						Round: <?php echo $rounds['round']; ?>
				</span>
			</td>
				<td valign="middle" style="background-color: #E4E4E4;">
<button class="delRound submit input five delbutton" formaction="./?page=delround&GameID=<?php echo $GameID; ?>&round=<?php echo $rounds['round']; ?>" id="delete" name="submit" style="margin-right: 50px; float: right;" type="submit" title="Delete Round">
	<i class="fa fa-trash"></i>
</button>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<table width="100%">
						<tbody>
							<?php 
							$q++;
							$i = 1;
							while ($ques = $res3->fetch_array()) {
							?>
							<tr>
								<td>Question <?php echo $i; ?></td>
								<td><input class="input eighty" id="question[<?php echo $ques['question_number']; ?>]" name="question[<?php echo $ques['question_number']; ?>]" type="text" value="<?php echo $ques['question']; ?>"></td>
							</tr>
							<tr>
								<td colspan="2">
									<table width="100%">
										<?php
										    $query4 = "SELECT `answerID`, `gameID`, `questionID`, `roundID`, `answer`, `correct`, `points` FROM `answers` WHERE `gameID` = '".$GameID."' AND `questionID` = '".$ques['question_number']."' AND `roundID` = '".$rounds['round']."'; ";
										    $res4 = $mysqli->query($query4);

										    while ($ans = $res4->fetch_array()) {
										                ?>
	<tr>
		<td>
			<input <?php echo ($ans['correct'] == "yes") ? 'checked ' : ''; ?>

			class="correct-answer" id="answers[<?php echo $ans['answerID'];?>][correct]" name="answers[<?php echo $ans['answerID'];?>][correct]" type="checkbox" value="<?php echo $ans['correct']; ?>">
			<label for="answers[<?php echo $ans['answerID'];?>][correct]"></label>
		</td>
											<td><input class="input seventy-nine" id="answers[<?php echo $ans['answerID'];?>]" name="answers[<?php echo $ans['answerID'];?>][answer]" placeholder="Answer 1" required="" type="text" value="<?php echo $ans['answer']; ?>"> <input class="input twenty" id="answers[<?php echo $ans['answerID'];?>][points]" maxlength="4" name="answers[<?php echo $ans['answerID'];?>][points]" placeholder="20" required="" size="2" type="text" value="<?php echo $ans['points']; ?>"></td>
										</tr><?php
										    }
										                ?>
									</table>
								</td>
							</tr><?php   
							$i++;
							}
							    ?>
						</tbody>
					</table>
					<button name="AddQuestion" id="addQuestion" class="addQuestion input twenty" type="button" data-roundID='<?php echo $rounds['round']; ?>'>Add Question</button>
									</td>
			</tr><?php
			}
			?>
		</table>

		<button class="addRound submit input twenty" formaction="./?page=addround&GameID=<?php echo $GameID; ?>" id="addRound" name="submit" type="submit">
		Add Round
	</button> 

	<button class="submit input twenty" type="submit" id="SaveGame">
	Save Game 
	</button> 
	
	<button class="testform submit input five delbutton" formaction="./?page=delgame&GameID=<?php echo $GameID; ?>" id="delete" name="submit" style="margin-right: 50px; float: right;" type="submit">
		<i class="fa fa-trash"></i>
	</button>
	</form>
	<?php
	}
}
	?>