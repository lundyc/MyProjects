<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (empty($_GET['name'])) {
// time to select a album
?>
<div class='tableborder'>
<div class='tableheaderalt'>Move Photo</div>
<table width='100%' cellpadding='4' cellspacing='0'>
<?php
$columns = "3";
$rows = "0";
$i = '';

$query = mysql_query("SELECT * FROM `gallery_categories` ORDER BY cid DESC");
while ($r = mysql_fetch_array($query)) {
($i % $columns) ? $row = FALSE : $row = TRUE;
if ($i && $row) {echo '</tr></tr>';}
$i++;

$query2 = mysql_query("SELECT * FROM `gallery` WHERE id='".(int)$_GET['id']."'");
$p = mysql_fetch_array($query2);



?>
<td align="center" colspan="2" class='tablerow1' valign="top">
<img src="../uploads/gallery/thumbs/<?php echo $r['thumb']; ?>" style="border: 1px solid black"/>
<br />
<?php echo $r['title']; ?><br />

<?php
if ($r['cid'] == $p['category']) {
echo "<b>Existing Album</b>"; 
} else {
?>
<form method="post" action="./?manager=gallery&action=move&id=<?php echo $_GET['id']; ?>&name=<?php echo $r['cid']; ?>">
<input type="submit" value="Select"/>
<?php
}
?> 
</form>
<br />

</td>
<?php
}
?>
</table>
<?php
} else {
mysql_query("UPDATE `gallery` SET `category` = '".(int)$_GET['name']."' WHERE `id` =".(int)$_GET['id']." LIMIT 1 ;") or die("Error: " . mysql_error());
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your photo has been moved.
 </p>
</div>
<br>

<?php

redirect("./?manager=gallery&action=photo&id=". $_GET['id'], 3);
}
?>

