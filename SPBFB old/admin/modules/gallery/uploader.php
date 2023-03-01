<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (isset($_POST['uploader']) && $_POST['uploader'] == false) {

if (empty($_GET['name'])) {
// time to select a album
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
<tr>
<td colspan="3" class="form_heading">Upload Photo</td>
</tr>
<tr>
<td colspan="3" class="">Select an Album to Upload the photo to...</td>
</tr>

<?php
$columns = "3";
$rows = "0";

$query = mysql_query("SELECT * FROM `gallery_categories` ORDER BY cid DESC");
while ($r = mysql_fetch_array($query)) {
($i % $columns) ? $row = FALSE : $row = TRUE;
if ($i && $row) {echo '</tr></tr>';}
$i++;
?>
<td align="center" style="padding: 5px;">
<img src="../uploads/gallery/thumbs/<?php echo $r['thumb']; ?>" style="border: 1px solid black"/>
<br />
<?php echo $r['title']; ?><br />


<form method="post" action="./?manager=gallery&action=upload&name=<?php echo $r['cid']; ?>">
  <input type="submit" value="Select"/>
</form>
<br />

</td>
<?php
}
?>
</table>
<?php
} else {

$query = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".addslashes($_GET['name'])."' LIMIT 1");
$r = mysql_fetch_array($query);

$album = $r['title']; 

?>
<form method="post" name="images" enctype="multipart/form-data" />
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
<tr>
<td colspan="2" class="form_heading">Upload Photo</td>
</tr>
<tr>
<td colspan="2" valign="top" class="form_fieldinput1">Select a Photo to Upload to <strong><?php echo $album; ?></strong>...</td>
</tr>

<?php
for($i=1; $i<=5; $i++){
?>
<tr>
<td valign="top" class="form_fieldinput1">
Add Photo <?php echo $i; ?>)
</td>
<td valign="top" class="form_fieldinput1">
<input type="file" name='images[]'>
</td>
</tr>
<?php
}
?>
<tr>
<td colspan="2" align="center" valign="top" class="form_fieldinput1"><input type="submit" value='Add Image'>
<input type="hidden" name="uploader" value="true" />
</td>
</tr>

</table>
</form> 
<?php
}

} else {

while(list($key, $value) = each($_FILES['images']['name'])) {
list($keys, $tmp) = each($_FILES['images']['tmp_name']);

if(!empty($value)){ 
// Lets Start
$file_name = $value;
$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
$allowed = array('.jpg','.gif','.png','.bmp');

if(in_array($file_ext, $allowed)) {

if ($tmp == "default.jpg") { die ("This filename is not allowed"); }

copy ($tmp, "uploads/gallery/tmp/".$value) or die ("<br><br>Could not updade!"); 
$ext = strtolower(substr($value, strrpos($value,".")));

$newfilename = time() . $ext;
rename("uploads/gallery/tmp/".$value, "uploads/gallery/tmp/". $newfilename);

$scale = '640x480';
$thumb_scale = '150x112';
$imagename = '/home/spbfb/public_html/uploads/gallery/tmp/'. $newfilename;
$thumb = '/home/spbfb/public_html/uploads/gallery/thumbs/'. $newfilename;
exec("convert -resize $scale $imagename -thumbnail $thumb_scale $thumb");
exec("convert $imagename -resize $scale\> $imagename");
exec("mv $imagename /home/spbfb/public_html/uploads/gallery/". $newfilename);

$added = date("Y-m-d");

mysql_query("UPDATE `gallery_categories` SET `thumb` = '".$newfilename."' WHERE `cid` =".$_GET['name']." LIMIT 1 ;") or die("Error: " . mysql_error());

mysql_query("INSERT INTO `gallery` (`filename`, `category`, `added`) VALUES ('$newfilename', '".$_GET['name']."', '$added')") or die("ERROR: " . mysql_error());

}
// Lets Finsh

}
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
Your news post has been added successfully.
<br />
<a href="index.php?view=admin&manager=gallery" >go back</a> 
</td>
</tr>
</table> 
<?php

}
?>


