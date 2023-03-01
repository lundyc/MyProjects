<?php 
if (level($_SESSION['uid']) >= 3) { 

mysql_query("DELETE FROM `guestbook` WHERE id='".$_GET['id']."'") or die("Error: " . mysql_error()); 

mysql_query("DELETE FROM `guestbook_reply` WHERE replyto='".$_GET['id']."'") or die("Error: " . mysql_error()); 
redirect("index.php?manager=guestbook", 0);
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
} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>
