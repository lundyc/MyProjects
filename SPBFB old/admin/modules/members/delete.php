<?php 
if (level($_SESSION['uid']) > 4) {

$error = 0;
$message = '';

if ($_GET['id'] == $_SESSION['uid']) {
$error = 1;
$message = "Sorry but you cannot delete yourself";
}

if (level($_GET['id']) > level($_SESSION['uid'])) {
$error = 1;
$message = "This user has a higher admin level, you cannot delete this user.";
}

if ($error == 1) {
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
<?php
echo $message; 
?>
 </p>
</div>
<br>
<?php
} else {
	$q = "DELETE FROM `attendance`, `band_notes` USING `attendance` INNER JOIN `band_notes` WHERE `attendance`.`UserID` = `band_notes`.`UserID` AND `band_notes`.`UserID` = ".$_GET['id']."; ";
	$q2 = "DELETE FROM `msgs` WHERE `to` = '".$_GET['id']."' OR `from` = '".$_GET['id']."'; ";
	$q3 = "UPDATE `news` SET `poster` = '1' WHERE `poster` ='".$_GET['id']."'; ";
	$q4 = "UPDATE `news_comments` SET `UserID` = '1' WHERE `UserID` ='".$_GET['id']."'; ";
	$q5 = "DELETE FROM `members` WHERE id='".$_GET['id']."'; ";
	$q6 = "DELETE FROM `profile` WHERE `profile`.`mid` = '".$_GET['id']."'; ";
	
	mysql_query($q) or die(mysql_error());
	mysql_query($q2) or die(mysql_error());
	mysql_query($q3) or die(mysql_error());
	mysql_query($q4) or die(mysql_error());
	mysql_query($q5) or die(mysql_error());
	mysql_query($q6) or die(mysql_error());
	
	
	
//mysql_query("DELETE FROM `attendance` WHERE UserID='{$_GET['id']}'") or die("Error: " . mysql_error());
//mysql_query("DELETE FROM `band_notes` WHERE UserID='{$_GET['id']}'") or die("Error: " . mysql_error());
//mysql_query("DELETE FROM `msgs` WHERE `from`='{$_GET['id']}'") or die("Error: " . mysql_error());
//mysql_query("DELETE FROM `msgs` WHERE `to`='{$_GET['id']}'") or die("Error: " . mysql_error());
//mysql_query("UPDATE `news` SET `poster` = '1' WHERE `poster` ='{$_GET['id']}'") or die("Error: " . mysql_error());
//mysql_query("UPDATE `news_comments` SET `UserID` = '1' WHERE `UserID` ='{$_GET['id']}'") or die("Error: " . mysql_error());
//mysql_query("DELETE FROM `members` WHERE id='{$_GET['id']}'") or die("Error: " . mysql_error());
//mysql_query("DELETE FROM `profile` WHERE mid='{$_GET['id']}'") or die("Error: " . mysql_error());

redirect("index.php?manager=members", 2);
?> 

<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
<?PHP echo $_GET['id']; ?> has been deleted successfully.
 </p>
</div>
<br>

<?php
}

} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>