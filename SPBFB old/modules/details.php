 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Event Details</h2>
<?php
if (isset($_GET['EventID'])) {
$event_query = safe_query("SELECT * FROM `events` WHERE `id`= '".(int)$_GET['EventID']."'");
$e_results = mysql_fetch_array($event_query);

$get_category = safe_query("SELECT `title` FROM `events_cat` WHERE id = '".$e_results['category']."'");
$c = mysql_fetch_array($get_category);

$day = floor(($e_results['start_time'] - time())/60/60/24);
if ($day == 1) {
$days = $day . " day until";
} elseif ($day == 0) {
$hours = floor(($e_results['start_time'] - time())/60/60%24);	
$mins = floor(($e_results['start_time'] - time())/60%60);

if ($hours == 0) {
	$days = "!! Today !!";
} else {
	$days = $hours ." hours and " . $mins ." minutes left";
}

} else {
$days = $day . " days until";
}
?>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">

<tr>
<td width="50%"><strong>Event Name:</strong></td>
<td width="50%"><?php echo $e_results['title']; ?></td>
</tr>

<tr>
<td><strong>Event Type:</strong></td>
<td><?php echo $c['title']; ?></td>
</tr>

<tr>
<td><strong>Location:</strong></td>
<td><?php echo $e_results['location']; ?></td>
</tr>

</table>
<br />

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="2">

<tr>
<td width="50%"><strong>Time Until Event:</strong></td>
<td width="50%"><?php echo $days; ?></td>
</tr>

<tr>
  <td><strong>Start Date / Time:</strong></td>
  <td><?php echo date("l d F @ g:i a", $e_results['start_time']); ?></td>
</tr>
<tr>
<td><strong>End Date / Time:</strong></td>
<td><?php echo date("l d F @ g:i a", $e_results['end_time']); ?></td>
</tr>



</table>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>

<?php
if (isset($_SESSION['uid'])) {
?>

<style>
#notes {
width: 100%;
margin-bottom: 10px;
}

#notes .name {
width: 25%;
padding-left: 5px;
font-weight:bold;
float: left;
}

#notes .text {
width: 70%;
float: right;
}
</style>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Band Notes</h2>
<?php
$notes = safe_query("SELECT `UserID`, `Body` FROM `band_notes` WHERE `EventID`='".(int)$_GET['EventID']."' ORDER BY `NoteID` DESC");
if (mysql_num_rows($notes) > 0) {
?>

<div id="notes">

<?php
while ($note = mysql_fetch_array($notes)) {
?>
<span class="name"><?php echo IDtoFullName($note['UserID']); ?></span>
<span class="text"><?php echo icon($note['Body']);  ?></span>
<span style="border-bottom: 1px solid #666; clear:both;"></span>
<?php
}
?>

</div>
<?php
} else {
?>
<div align="center">No comments</div>
<?php
}

//if (mysql_num_rows(safe_query("SELECT * FROM `band_notes` WHERE `UserID`='".$_SESSION['uid']."' AND `EventID`='".(int)$_GET['EventID']."'")) < 1) {
?>

<div align="center" >
<form action="sendshout.php" method="post" id="Upcoming">
<input type="hidden" name="EventID" value="<?php echo (int)$_GET['EventID']; ?>">
<input type="hidden" name="upcoming" value="yes">
<textarea name="CommentsBody" id="CommentBody" style="overflow: hidden; width: 90%;"></textarea>
<br />
<input type="submit" name="submit" id="Upcoming_Submit" value="Add Note">
</form>
</div>

<?php
//} 
?>

<script type="text/javascript" src="scripts/moo/upcoming.js"></script>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<?php
}

}
?>