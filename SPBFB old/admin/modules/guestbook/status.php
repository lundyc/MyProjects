<?php 
if (level($_SESSION['uid']) >= 3) { 
mysql_query("UPDATE `guestbook` SET `status` = '".$_GET['status']."' WHERE `id` =".$_GET['id']." LIMIT 1 ;") or die("Error: " . mysql_error());

redirect("index.php?manager=guestbook", 1);
?> 

<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
This guestbook entry has now been, <?php echo ((int)$_GET['status'] == 0) ? "Un-Accecpted" : "Accecpted"; ?>
 </p>
</div>
<br>
<?php
} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>
