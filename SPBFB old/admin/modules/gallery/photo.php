<?php
if (level($_SESSION['uid']) >= 2) {

if (isset($_GET['delete']) && $_GET['delete'] == 1) {
$path = "../uploads/gallery/";
$thumb = "thumbs/";

$query = mysql_query("SELECT * FROM `gallery` WHERE id='".$_GET['id']."'");
$r = mysql_fetch_array($query);

$old = getcwd(); // Save the current directory
chdir($path);

if (file_exists($r['filename'])) {
unlink($r['filename']);
unlink($thumb . $r['filename']);
} 

mysql_query("DELETE FROM `gallery` WHERE id='".$_GET['id']."'") or die("Error: " . mysql_error());

?> 
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
<tr>
  <td colspan="2" class="form_heading">Success</td>
  </tr>

<tr>
<td class="form_fieldinput1" align="center">
<img src="images/layout/admin/tick.gif" class="icon" />
</td>
  <td valign="top" class="form_fieldinput1">
<?PHP echo $_GET['id']; ?> has been deleted successfully.
<br />
<a href="index.php?manager=gallery" >go back</a> 
</td>
</tr>
</table> 
<?php
} else {

if (isset($_GET['cover']) && $_GET['cover'] == 1) {
$query = mysql_query("SELECT * FROM `gallery` WHERE id='".(int)$_GET['id']."'");
$r = mysql_fetch_array($query);

mysql_query("UPDATE `gallery_categories` SET `thumb` = '".$r['filename']."' WHERE `cid` =".$_GET['cid']." LIMIT 1 ;") or die("Error: " . mysql_error());
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
This picture has been set as the albums cover.
 </p>
</div>
<br>
<?php
redirect("index.php?manager=gallery&action=photo&id=".(int)$_GET['id'], 3);

} else {
?>

<div class='tableborder'>
<div class='tableheaderalt'>Manage Photo</div>
<table width='100%' cellpadding='0' cellspacing='0'>

<?php
$query = mysql_query("SELECT * FROM `gallery` WHERE id='".(int)$_GET['id']."'");
$r = mysql_fetch_array($query);

$query2 = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".$r['category']."' LIMIT 1;");
$c = mysql_fetch_array($query2);

$cover = ($r['filename'] == $c['thumb']) ? "<img src=\"../images/misc/aff_tick.png\"> yes" : "<img src=\"../images/misc/exclamation.png\"> no";

$href = "../uploads/gallery/".$r['filename'];
$title = "<b>". stripslashes($r['title']) ."</b><br /> ". stripslashes($r['desc']);
?>

 <tr>
   <td colspan="2" align="center" class='tablerow1'>
<a href="./?manager=gallery&action=photo&id=<?php echo $_GET['id']; ?>&cid=<?php echo $c['cid']; ?>&cover=1">
Use as Album Cover
</a> | 
<a href="./?manager=gallery&action=edit&id=<?php echo $_GET['id']; ?>">Edit Photo</a> |
   <a href="./?manager=gallery&action=move&id=<?php echo $_GET['id']; ?>">Move Photo</a> |
   <a href="./?manager=gallery&action=photo&id=<?php echo $_GET['id']; ?>&delete=1">Delete Photo</a></td>
  </tr>

 <tr>
   <td colspan="2" align="center" class='tablerow1'><a href="<?php echo $href; ?>" title="<?php echo $title; ?>" class="thickbox" rel="lightbox"> <img src="../uploads/gallery/thumbs/<?php echo $r['filename']; ?>" style="BORDER: 1px solid #000000" title="<?php echo $r['title']; ?>"/></a></td>
  </tr>

 <tr>
<td width="27%" class='tablerow1'><strong>Title:</strong></td>
<td width="73%" class='tablerow1'><?php echo (!$r['title']) ? "no title" : $r['title']; ?></td>
</tr>

<tr>
<td class='tablerow1'><strong>Album:</strong></td>
<td class='tablerow1'><?php echo $c['title']; ?></td>
</tr>

<tr>
<td class='tablerow1'><strong>Added:</strong></td>
<td class='tablerow1'><?php echo $r['added']; ?></td>
</tr>

<tr>
<td class='tablerow1'><strong>Album Cover?</strong></td>
<td class='tablerow1'><?php echo $cover; ?></td>
</tr>

<tr>
<td class='tablerow1'><strong>Description:</strong></td>
<td class='tablerow1'><?php echo (!$r['desc']) ? "no description" : $r['desc']; ?></td>
</tr>
</table>
 
<?php
 }
 }
 
 } else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
 ?>