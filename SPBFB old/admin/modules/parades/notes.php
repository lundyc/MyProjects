<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (isset($_POST['submit'])) {
safe_query("INSERT INTO `band_notes` (`EventID` ,`UserID` ,`Body` ) VALUES ('".$_POST['EventID']."', '".$_SESSION['uid']."', '".$_POST['CommentsBody']."');");


}

if (isset($_GET['a']) && $_GET['a'] == "dodelete") {
mysql_query("DELETE FROM `band_notes` WHERE NoteID = '".$_GET['NoteID']."'") or die("Error: " . mysql_error());
}
?>

<div class='tableborder'>
<div class='tableheaderalt'>Manage Band Notes</div>
<?php
$notes = safe_query("SELECT * FROM `band_notes` WHERE `EventID`='".$_GET['EventID']."'");
if (mysql_num_rows($notes) > 0) {
?>

<table width='100%' cellpadding='4' cellspacing='0'>

<?php
while ($note = mysql_fetch_array($notes)) {
?>
<tr>
<td class='tablerow1'>
<?php
echo nl2br($note['Body']); 
?>	
<div style="float:left; width: 40%;">By <?php echo IDtoName($note['UserID']); ?></div>
<div style="float:right;">[ <a href="./?manager=parades&action=notes&EventID=<?php echo $note['EventID']; ?>&a=dodelete&NoteID=<?php echo $note['NoteID']; ?>">Delete Note</a> ]</div>   
</td>
</tr>

<?php
}
?>
</table>

<?php
} else {
?>
<div align="center">Sorry no notes left yet</div>
<?php
}
?>
</div>
<br />

<div class='tableborder'>
<div class='tableheaderalt'>Add Note</div>

<?php
if (mysql_num_rows(safe_query("SELECT * FROM `band_notes` WHERE `UserID`='".$_SESSION['uid']."' AND `EventID`='".$_GET['EventID']."'")) < 1) {
?>

<div align="center">
<form action="" method="post">
<input type="hidden" name="EventID" value="<?php echo $_GET['EventID']; ?>">
<textarea name="CommentsBody" rows="15" wrap="virtual" style="width:450px; height: 220px; overflow:auto;" tabindex="3" class="form_table"></textarea>
&nbsp;
<input type="submit" name="submit" value="Add Note">
</form>
</div>

<?php
} else {
echo "Thank you for your post.";
}
?>
</div>