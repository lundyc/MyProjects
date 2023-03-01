<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

$allowed = array('.jpg','.gif','.png','.bmp');
if (isset($_POST['uploader']) && $_POST['uploader'] == "gogogo") {

foreach ($_FILES["images"]["error"] as $key => $error) {
	print_r($_FILES);
	echo "<br />";
	
if ($error == UPLOAD_ERR_OK) {
$tmp_name = $_FILES["images"]["tmp_name"][$key];
$name = $_FILES["images"]["name"][$key];

//echo "Checking for Errors: [OK]<br />";
$file_ext = strtolower(substr($name,strrpos($name,".")));
if(in_array($file_ext, $allowed)) {

//echo "Checking file extention: [OK]";

if ($name == "default.jpg") { die ("This filename is not allowed"); }
 move_uploaded_file($tmp_name, "../uploads/gallery/tmp/".$name);

//if (file_exists("../uploads/gallery/tmp/$name")) { 
//echo "File Uploaded: [OK]<br />";
//} else {
//echo "File Uploaded: [ERROR]<br />";
//}


$ext = strtolower(substr($name, strrpos($name,".")));

$newfilename = rand(time(), time()+rand(1,100)).$ext;
rename("../uploads/gallery/tmp/".$name, "../uploads/gallery/tmp/". $newfilename);
exec("chmod 0777 ../uploads/gallery/tmp/". $newfilename);

#if (file_exists("../uploads/gallery/tmp/$newfilename")) { 
#echo "File Renamed: [OK]<br />";
#} else {
#echo "File Renamed: [ERROR]<br />";
#}

$scale = '640x480';
$thumb_scale = '150x112';
$imagename = '/var/www/vhosts/spb-fb.co.uk/httpdocs/uploads/gallery/tmp/'. $newfilename;
$thumb = '/var/www/vhosts/spb-fb.co.uk/httpdocs/uploads/gallery/thumbs/'. $newfilename;

exec("/usr/bin/convert -resize $scale $imagename -thumbnail $thumb_scale $thumb", $return); 
exec("/usr/bin/convert $imagename -resize $scale\> $imagename", $return2);
exec("mv $imagename /var/www/vhosts/spb-fb.co.uk/httpdocs/uploads/gallery/". $newfilename, $return3);

mysql_query("UPDATE `gallery_categories` SET `thumb` = '".$newfilename."' WHERE `cid` =".$_GET['name']." LIMIT 1 ;") or die("Error: " . mysql_error());
mysql_query("INSERT INTO `gallery` (`filename`, `category`, `added`) VALUES ('".$newfilename."', '".$_GET['name']."', '".date("Y-m-d")."')") or die("ERROR: " . mysql_error());
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
<?php echo $newfilename; ?> was uploaded to the database.
 </p>
</div>
<?php

} else {
echo "File Not Allowed";
}

} 
}
} 


if (empty($_GET['name'])) {
// time to select a album
?>
<div class='tableborder'>
<div class='tableheaderalt'>Upload Photo</div>
<table width='100%' cellpadding='4' cellspacing='0'>

<?php
$columns = "3";
$rows = "0";
$i = 0;

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
<div class='tableborder'>
<div class='tableheaderalt'>Upload Photo</div>
<form method="post" name="images" enctype="multipart/form-data" />
<input type="hidden" name="uploader" value="gogogo" />

<table width='100%' cellpadding='4' cellspacing='0'>
<tr>
<td colspan="2" valign="top" class="form_fieldinput1">
Select a Photo to Upload to <strong><?php echo $album; ?></strong>...<br />
Allowed File Types: <?php 
$allow = '';
while (list($key, $val) = each($allowed)) { 
$allow .= $val . ", "; 
} 

$allow = substr($allow,0,strlen($allow) - 2);

echo $allow; ?>
</td>
</tr>

<?php
for($i=1; $i<=10; $i++){
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
<td colspan="2" align="center" valign="top" class="form_fieldinput1"><input type="submit" value='Add Image'></td>
</tr>

</table>
</form> 
<?php
}

/*
while(list($key, $value) = each($_FILES['images']['name'])) {
list($keys, $tmp) = each($_FILES['images']['tmp_name']);

if(!empty($value)){ 
// Lets Start
$file_name = $value;
$file_ext = strtolower(substr($value,strrpos($value,".")));

if(in_array($file_ext, $allowed)) {

if ($tmp == "default.jpg") { die ("This filename is not allowed"); }

echo "Temp: " . $tmp . "<br>";
echo "Value:  ". $value."<br><br>";

copy($tmp, "../uploads/gallery/tmp/".$value) or die ("Could not Upload the image(s)") or die ("could not upload for some reason...."); 
$ext = strtolower(substr($value, strrpos($value,".")));

$newfilename = time() . $ext;
rename("../uploads/gallery/tmp/".$value, "../uploads/gallery/tmp/". $newfilename);
exec("chmod 0777 ../uploads/gallery/tmp/". $newfilename);

$scale = '640x480';
$thumb_scale = '150x112';
$imagename = '/var/www/vhosts/spb-fb.co.uk/httpdocs/uploads/gallery/tmp/'. $newfilename;
$thumb = '/var/www/vhosts/spb-fb.co.uk/httpdocs/uploads/gallery/thumbs/'. $newfilename;

exec("/usr/bin/convert -resize $scale $imagename -thumbnail $thumb_scale $thumb", $return); 
exec("/usr/bin/convert $imagename -resize $scale\> $imagename", $return2);
exec("mv $imagename /var/www/vhosts/spb-fb.co.uk/httpdocs/uploads/gallery/". $newfilename, $return3);

mysql_query("UPDATE `gallery_categories` SET `thumb` = '".$newfilename."' WHERE `cid` =".$_GET['name']." LIMIT 1 ;") or die("Error: " . mysql_error());
mysql_query("INSERT INTO `gallery` (`filename`, `category`, `added`) VALUES ('".$newfilename."', '".$_GET['name']."', '".date("Y-m-d")."')") or die("ERROR: " . mysql_error());

}

}
}
*/

?>