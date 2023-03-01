<h1 class="leaderboard">Add Game</h1>

<?php

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
	if (!isset($_GET['step']))  {
		$query = "SELECT `GameID` FROM `games` ORDER BY `games`.`GameID` DESC LIMIT 1;";
		$gquery = $mysqli->query($query) or die ($mysqli->error.__LINE__);
		$row = $gquery->fetch_array();
		$newGameID = $row['GameID']+1;
?>
	<form action="./?page=addgame&step=1" method="POST" autocomplete="off">
	  <input type="hidden" name="step" value="1">
	  <table width="100%">
	    <tr>
	      <td><b>Game Number:</b></td>
	      <td><?php echo $newGameID; ?><input type="hidden" name="GameID" value="<?php echo $newGameID; ?>"></td>
	    </tr>

	    <tr>
	      <td width="20%"><b>Game Name:</b></td>
	      <td width="80%"><input required type="text" name="gName" id="gName" autocomplete="off" class="input eighty"></td>
	    </tr>
	  </table>
	  <input name="submit" class="input eighty" id="submit" type="submit" value="Next">
	</form>
<?php
	} elseif ($_GET['step'] == 1) {
		$newGameID = $_POST['GameID'];
		$GameName = $_POST['gName'];

	$gameQ = "INSERT INTO `quiz`.`games` (`GameID`, `gName`, `status`) VALUES (".$newGameID.", '".$GameName."', 'upcoming');";
	$mysqli->query($gameQ) or die ($mysqli->error.__LINE__);

?>
<script>
	$(document).ready(function(){
		$('#frm1').submit();   
	});
</script>
	<form method="POST" action="./?page=addgame&step=2" id="frm1">
	<input type="hidden" name="GameID" value="<?php echo $newGameID; ?>">
	<input type="submit" style="visibility: hidden; display: none;">
	</form>


<?php
} elseif ($_GET['step'] == 2) {

if (isset($_POST['saveQuestion'])) {
			$newGameID = $_POST['GameID'];
			$round = $_POST['round'];
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
		}


		$newGameID = $_POST['GameID'];
		$round = (isset($_GET['round'])) ? $_GET['round'] : 1;
		$question = (isset($_GET['question'])) ? $_GET['question'] : 1;

		$prevRound = $round-1;
		$prevRound = ($prevRound == 0) ? '1' : $prevRound;
		$nextRound = $round+1;

		$prevQuestion = $question-1;
		$prevQuestion = ($prevQuestion == 0) ? '1' : $prevQuestion;
		$nextQuestion = $question+1;
?>
	<form method="POST" autocomplete="off">
		<input type="submit" formaction="./?page=addgame&step=2&question=<?php echo $nextQuestion; ?>" style="visibility: hidden; display: none;">
	<input type="hidden" name="GameID" value="<?php echo $newGameID; ?>">
	<input type="hidden" name="round" value="<?php echo $round; ?>">
	<input type="hidden" name="saveQuestion" value="true">

	<div>Game ID: <?php echo $newGameID; ?><br>
	Round: <?php echo $round; ?><br>



  	<div style="width: 100%; background-color: #E4E4E4;">
    	<b>Round <?php echo $round; ?></b>
	</div>

	 <table width="100%">
    <tr>
      <td>
        <b>Question <?php echo $question; ?>:</b>
      </td>
      <td>
        <input required type="text" name="question" id="question" value="Question <?php echo $question; ?>" class="input eighty">
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <input type="checkbox" name="answers[1][correct]" id="answers[1][correct]" value="yes" class="correct-answer" />
        <label for="answers[1][correct]"></label>
        <input required type="text" name="answers[1][answer]" id="answers[1][answer]" value="test" placeholder="Answer 1" class="input seventy-nine">
         <input required type="text" name="answers[1][points]" id="answers[1][points]" value="100" placeholder="20" maxlength="4" size="2" class="input twenty">
      </td>
    </tr>

     <tr>
      <td colspan="2">
        <input type="checkbox" name="answers[2][correct]" id="answers[2][correct]" value="yes" class="correct-answer" />
        <label for="answers[2][correct]"></label>
        <input required type="text" name="answers[2][answer]" id="answers[2][answer]" value="test" placeholder="Answer 2" class="input seventy-nine">
         <input required type="text" name="answers[2][points]" id="answers[2][points]" value="0" placeholder="20" maxlength="4" size="2" class="input twenty">
      </td>
    </tr>

        <tr>
      <td colspan="2">
        <input type="checkbox" name="answers[3][correct]" id="answers[3][correct]" value="yes" class="correct-answer" />
        <label for="answers[3][correct]"></label>
        <input required type="text" name="answers[3][answer]" id="answers[3][answer]" value="test" placeholder="Answer 3" class="input seventy-nine">
         <input required type="text" name="answers[3][points]" id="answers[3][points]" value="0" placeholder="20" maxlength="4" size="2" class="input twenty">
      </td>
    </tr>

        <tr>
      <td colspan="2">
        <input type="checkbox" name="answers[4][correct]" id="answers[4][correct]" value="yes" class="correct-answer" />
        <label for="answers[4][correct]"></label>
        <input required type="text" name="answers[4][answer]" id="answers[4][answer]" value="test" placeholder="Answer 4" class="input seventy-nine">
         <input required type="text" name="answers[4][points]" id="answers[4][points]" value="0" placeholder="20" maxlength="4" size="2" class="input twenty">
      </td>
    </tr>
  </table>

<button formaction="./?page=addgame&step=2&round=<?php echo $round; ?>&question=<?php echo $nextQuestion; ?>" class="submit input eighty">Add Question</button>
 <input formaction="./?page=addgame&step=2&round=<?php echo $nextRound; ?>" name="submit" class="submit input eighty" id="submit" type="submit" value="Next Round">
<button formaction="./?page=games" class="submit input eighty">Finish Game Setup</button>

    <script type="text/javascript">
    $('.correct-answer').on('change', function() {
        $('.correct-answer').not(this).prop('checked', false);  
    });

    $('.submit').on('click', function() {
    valid = true;   
    if ($('#name').val() == '') {
        alert ("please enter your name");
        valid = false;
    }
    
    if ($('#address').val() == '') {
        alert ("please enter your address");
         valid = false;
    }    
});
  </script>
  <?php		
	}
	exit;
?>












<?php
if (isset($_POST['submit'])) {

if ($_GET['step'] == 1) {
	$newGameID = $_POST['GameID'];
	$GameName = $_POST['gName'];
?>
<form action="" method="POST" autocomplete="off">
	<input type="hidden" name="step" value="2">
	<input type="hidden" name="GameID" value="<?php echo $newGameID; ?>">
	<input type="hidden" name="gName" value="<?php echo $GameName; ?>">
  <table width="100%">
    <tr>
      <td><b>Game Number:</b></td>
      <td><?php echo $newGameID; ?></td>
    </tr>

    <tr>
      <td width="20%"><b>Game Name:</b></td>
      <td width="80%"><?php echo $GameName; ?></td>
    </tr>
  </table>

<?php
$round = (isset($_POST['round'])) ? $_POST['round'] : 1;
	echo '<input type="text" name="round" value="'.$round.'">';

?>
  <div style="width: 100%; background-color: #E4E4E4;">
    <b>Round <?php echo $round; ?></b>
</div>

    <input name="submit" class="input eighty" id="submit" type="submit" value="Next">
  </form>

<?php
} 

} else {
	$query = "SELECT `GameID` FROM `games` ORDER BY `games`.`GameID` DESC LIMIT 1;";
	$gquery = $mysqli->query($query) or die ($mysqli->error.__LINE__);
	$row = $gquery->fetch_array();
	$newGameID = $row['GameID']+1;
?>
<form action="/addgame.php?step=1" method="POST" autocomplete="off">
	<input type="hidden" name="step" value="1">
  <table width="100%">
    <tr>
      <td><b>Game Number:</b></td>
      <td><?php echo $newGameID; ?><input type="hidden" name="GameID" value="<?php echo $newGameID; ?>"></td>
    </tr>

    <tr>
      <td width="20%"><b>Game Name:</b></td>
      <td width="80%"><input type="text" name="gName" id="gName" autocomplete="off" class="input eighty"></td>
    </tr>
  </table>
    <input name="submit" class="input eighty" id="submit" type="submit" value="Next">
  </form>
  <?php
		}
	?>




















<?php
/*

<div id="rounds_parent">
  <div style="width: 100%; background-color: #E4E4E4;">
    <b>Round 1</b>
</div>

  <table width="100%">
    <tr>
      <td>
        <b>Question 1:</b>
      </td>
      <td>
        <input type="text" name="round<?php echo $round; ?>[question1]" id="question1" value="Question 1" class="input eighty">
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <input type="checkbox" name="round<?php echo $round; ?>[question1][correct]" id="round<?php echo $round; ?>[question1][correct1]" value="1" class="example" />
        <label for="round<?php echo $round; ?>[question1][correct1]"></label>
        <input type="text" name="round<?php echo $round; ?>[question1][answer1]" id="round<?php echo $round; ?>[question1][answer1]" value="Answer 1" class="input seventy-nine">
        <input type="text" name="round<?php echo $round; ?>[question1][points1]" id="round<?php echo $round; ?>[question1][points1]" value="10" maxlength="4" size="2" class="input twenty">
      </td>
    </tr>
    <tr>
      <td colspan="2"><input type="checkbox" name="round<?php echo $round; ?>[question1][correct]" id="round<?php echo $round; ?>[question1][correct2]" value="2" class="example" /><label for="round<?php echo $round; ?>[question1][correct2]"></label>
        <input type="text" name="round<?php echo $round; ?>[question1][answer2]" id="round<?php echo $round; ?>[question1][answer2]" value="Answer 2" class="input seventy-nine">
        <input type="text" name="round<?php echo $round; ?>[question1][points2]" id="round<?php echo $round; ?>[question1][points2]" value="0" maxlength="4" size="2" class="input twenty">
      </td>

    </tr>
    <tr>
      <td colspan="2"><input type="checkbox" name="round<?php echo $round; ?>[question1][correct]" id="round<?php echo $round; ?>[question1][correct3]" value="3" class="example" /><label for="round<?php echo $round; ?>[question1][correct3]"></label>
        <input type="text" name="round<?php echo $round; ?>[question1][answer3]" id="round<?php echo $round; ?>[question1][answer3]" value="Answer 3" class="input seventy-nine">
        <input type="text" name="round<?php echo $round; ?>[question1][points3]" id="round<?php echo $round; ?>[question1][points3]" value="10" maxlength="4" size="2" class="input twenty">
      </td>
    </tr>
    <tr>
      <td colspan="2"><input type="checkbox" name="round<?php echo $round; ?>[question1][correct]" id="round<?php echo $round; ?>[question1][correct4]" value="4" class="example" /><label for="round<?php echo $round; ?>[question1][correct4]"></label>
        <input type="text" name="round<?php echo $round; ?>[question1][answer4]" id="round<?php echo $round; ?>[question1][answer4]" value="Answer 4" class="input seventy-nine">
        <input type="text" name="round<?php echo $round; ?>[question1][points4]" id="round<?php echo $round; ?>[question1][points4]" value="10" maxlength="4" size="2" class="input twenty">
      </td>

    </tr>
  </table>
</div>
</div>

  <input name="nextRound" class="input fifty" type="button" value="Next Round"> <input name="nextQuestion" class="input fifty" type="button" value="Next Question">
  <input name="submit" class="input eighty" id="submit" type="submit" value="Close Game">
</form>
*/
?>