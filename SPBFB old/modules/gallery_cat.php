<?php
$cat = $_GET['cat'];
$columns = "4";
$rows = "0";

if (is_numeric($cat)) {

$query = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".$cat."'");
$rows = mysql_num_rows($query);

if ($rows == 0) {
echo "<center>False category</center>";
} else {

$c = mysql_fetch_array($query);
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="listing2_header">
<span class="style5">Photo </span><span class="style6">Gallery</span>
</td>
</tr>
</table>

<table width="100%" cellspacing="0" class='ipbtable'>
<tr>
<td class="maintitle">
<span style="text-transform:uppercase;"><?php echo $c['title']; ?></span>
</td>
</tr>
<tr>
<td class="subtitle">
<small>&raquo;<em> <?php echo $c['desc']; ?></em></small>
</td>
</tr>
</table>

<table width="100%" cellpadding="1" cellspacing="0" class='ipbtable'>

<?php
$query2 = mysql_query("SELECT * FROM `gallery` WHERE category = '".$cat."'");
$grows = mysql_num_rows($query2);

if ($grows == 0) {
?>
<tr>
<td align="center">No images</td>
</tr>
<?php
} else {

$view = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".(int)$_GET['cat']."'");
$views = mysql_fetch_array($view);

if ($views['views'] > 0) {
$views2 = $views['views']+1;
} else {
$views2 = 1;
}

mysql_query("UPDATE `gallery_categories` SET `views` = '". $views2 ."' WHERE `cid` =".$cat." LIMIT 1 ;") or die("Error: " . mysql_error());


while ($r = mysql_fetch_array($query2)) {
($i % $columns) ? $row = FALSE : $row = TRUE;
if ($i && $row) {echo '</tr></tr>';}
$i++;

$da 	= explode("-", $r['added']);
$date 	= date("d/m/Y", mktime(0, 0, 0, $da['1'], $da['2'], $da['0'])); 

$href = "uploads/gallery/".$r['filename'];
//$title = "<strong>".$r['title']."</strong><br /> ".substr($r['desc'], 0, 40 - 3) . "...";
$title = "<b>". stripslashes($r['title']) ."</b><br /> ". stripslashes($r['desc']);

?>

<td valign="top">

<table width="100%" border="0" cellpadding="0" cellspacing="0" >
<tr>
<td class="row2"><strong>
<?php 
if (empty($r['title'])) {
echo "unnamed";
} else {
echo $r['title']; 
}
?></strong></td>
</tr>

<tr>
<td class="row2" align="center">
<a href="<?php echo $href; ?>" title="<?php echo $title; ?>" class="thickbox" rel="lightbox">
<img src="uploads/gallery/thumbs/<?php echo $r['filename']; ?>" width="127" height="115" style="BORDER: 1px solid #000000" title="<?php echo $r['title']; ?>" align="middle"/></a>
</td>
</tr>

</table>
</td>

<?php

}

}
?>
</table>

<?php
}
}
?>
