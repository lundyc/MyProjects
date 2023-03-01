<?php
if (level($_SESSION['uid']) >= 2) {

$path = "../uploads/gallery/";
$thumb = "thumbs/";
if (isset($_GET['delete']) && $_GET['delete'] == 1) {

// Grabs the title before it gets deleted
$h = mysql_fetch_object(mysql_query("SELECT `title` FROM `gallery_categories` WHERE cid='".$_GET['id']."'"));

$query = mysql_query("SELECT * FROM `gallery` WHERE category='".$_GET['id']."'");
if (mysql_num_rows($query) > 0) {

$old = getcwd(); // Save the current directory
chdir($path);

while ($r = mysql_fetch_array($query)) {

if (file_exists($r['filename'])) {
unlink($r['filename']);
unlink($thumb . $r['filename']);
} 


}
chdir($old); // Restore the old working directory

mysql_query("DELETE FROM `gallery` WHERE `category`='".$_GET['id']."'") or die("Error: " . mysql_error());


}

mysql_query("DELETE FROM `gallery_categories` WHERE cid='".$_GET['id']."'") or die("Error: " . mysql_error());

?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
<?php echo $h->title; ?> has been deleted successfully.
 </p>
</div>
<br>
<?php
//redirect("index.php?manager=gallery", 5);
} else {

$h = mysql_fetch_object(mysql_query("SELECT `title` FROM `gallery_categories` WHERE cid='".(int)$_GET['id']."'"));
?>

<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Gallery Albums </div>
  </h2>
 <p>
 	<br />
 	You can select to edit or delete gallery albums, viewable to the Public.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>Manage Album - <?php echo $h->title; ?></div>


 <a href="./?manager=gallery&action=upload&name=<?php echo (int)$_GET['id']; ?>" style="color: #000000">Upload Photo</a> 
 | 
 <a href="./?manager=gallery&action=editalbum&name=<?php echo (int)$_GET['id']; ?>" style="color: #000000">Edit Album</a> 
 | 
 <a href="./?manager=gallery&action=albums&id=<?php echo (int)$_GET['id']; ?>&delete=1" style="color: #000000">Delete Album</a><br />
<table cellpadding='4' cellspacing='0' width='100%'>

<?php
$columns = "3";
$rows = "0";

$i = '';

$query = mysql_query("SELECT * FROM `gallery` WHERE category='".(int)$_GET['id']."'");
$numbs = mysql_num_rows($query);

if ($numbs == 0) { echo "<div align='center'>no photo's in this album</div>"; }
while ($r = mysql_fetch_array($query)) {
($i % $columns) ? $row = FALSE : $row = TRUE;
if ($i && $row) {echo '</tr></tr>';}
$i++;

$title = (strlen($r['title']) == 0) ? "no title" : $r['title'];
?>
 <td class="form_fieldinput1" valign="top" align="center">
 <a href="./?manager=gallery&action=photo&id=<?php echo $r['id']; ?>">
 <img src="<?php echo $path . $thumb . $r['filename']; ?>" border="0" style="border: 1px solid black;">
 <br />
<?php echo $title; ?>
 </a>
 </td>

<?php
}
?>

</table>

<?php
}

} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>
 