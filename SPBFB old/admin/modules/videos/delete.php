<?php 
$query = mysql_query("SELECT `filename` FROM `video` WHERE id='".$_GET['id']."'") or die("Error: " . mysql_error());
$r = mysql_fetch_array($query);

$file = $r['filename'];
$path = "uploads/media/videos/";
if (file_exists($path . $file.".flv") && file_exists($path . $file.".jpg")) {
unlink($path . $file.".flv");
unlink($path . $file.".jpg");
mysql_query("DELETE FROM `video` WHERE id='".$_GET['id']."'") or die("Error: " . mysql_error()); 
}
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
<?php echo $file; ?> has been deleted successfully.
<br />
<a href="index.php?view=admin&manager=videos" >go back</a> 
</td>
</tr>
</table> 