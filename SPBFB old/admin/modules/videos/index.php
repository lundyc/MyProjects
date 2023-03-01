<div class='tableheaderalt'>Manage Videos </div>
<table cellpadding='4' cellspacing='0' width='100%'>
<tr>
<td width="4%" class='tablesubheader'>[a]</td>
<td width="48%" class='tablesubheader'>Title</td>
<td width="13%" class='tablesubheader'>Time</td>
<td width="21%" class='tablesubheader'>Date Added</td>
<td width="14%" class='tablesubheader'>Views</td>
<td width="14%" class='tablesubheader'>&nbsp;</td>
</tr>


<?php
chdir("../");
$root = getcwd();
chdir("admin/");

$dir = $root . "/uploads/media/videos/";
$result = mysql_query("SELECT * FROM `video` ORDER BY `VideoID` desc") or die (mysql_error()); 

while($r = mysql_fetch_array($result)) { 
$size = filesize($dir . $r['filename'] . ".flv");
$filesize =  round(($size/1048576),2);

?>

<tr>
<td align="center" class="row2"><input type="checkbox" class="checkbox" value="" /></td>
<td>
<img src="../uploads/media/videos/<?php echo $r['filename'];?>.jpg" width="40" height="30" border="0" /> <?php echo $r['title']; ?></td>
<td><?php echo date("d M Y", $r['added']); ?></td>
<td><?php echo date("d M Y", $r['added']); ?></td>
<td><?php echo $r['number_of_views']; ?></td>
<td>Edit Delete</td>
</tr>

<?php
}
?>

</table>