<?php 
$ip = $_GET['ip'];
mysql_query("INSERT INTO `banip` (`ip`) VALUES ('$ip')") or die("ERROR: " . mysql_error());
mysql_query("DELETE FROM `guestbook` WHERE id='".$_GET['id']."'") or die("Error: " . mysql_error());
redirect("index.php?manager=guestbook", 1);

?> 

<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
<?php echo $ip; ?> has been banned from using the SPBFB website.<br />
<?PHP echo $_GET['id']; ?> has been deleted successfully.
 </p>
</div>
<br>