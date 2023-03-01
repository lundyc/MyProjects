 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Edit Profile Image</h2>

<?php
if(isset($_POST['Submit'])) {  
$file_name = $_FILES['imagefile']['name'];
$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
$allowed = array('.jpg','.gif','.png','.bmp');

if (empty($file_name)) {
die("Please select a file");
}

if(in_array($file_ext, $allowed)) {

if ($_FILES['imagefile']['tmp_name'] == "default.jpg") {
die ("This filename is not allowed");
}

copy ($_FILES['imagefile']['tmp_name'], "uploads/profiles/".$_FILES['imagefile']['name']) or die ("<br><br>Could not updade!"); 
$ext = strtolower(substr($_FILES['imagefile']['name'], strrpos($_FILES['imagefile']['name'],".")));

$newfilename = str_replace(" ", "_", IDtoName($_SESSION['uid']));
$newfilename .= "_". rand(1, 2000) . $ext;
rename("uploads/profiles/".$_FILES['imagefile']['name'], "uploads/profiles/". $newfilename);

$scale = '190x190';
$thumb_scale = '90x90';
$profile = '/var/www/vhosts/spb-fb.co.uk/httpdocs/uploads/profiles/'. $newfilename;
$thumb = '/var/www/vhosts/spb-fb.co.uk/httpdocs/uploads/profiles/thumbs/'. $newfilename;
exec("convert -resize $scale $profile -thumbnail $thumb_scale $thumb");
exec("convert $profile -resize $scale\> $profile");


$query = mysql_query("SELECT * FROM `profile` WHERE mid = '".(int)$_SESSION['uid']."'");
$r = mysql_fetch_array($query);

if (strlen($r['picture']) > 0 && $r['picture'] != "default.jpg") {
$oldpicture = "uploads/profiles/". $r['picture'];
$oldthumb = "uploads/profiles/thumbs/". $r['picture'];
if (file_exists($oldpicture)) {
@unlink($oldpicture);
@unlink($oldthumb);
}
} 

mysql_query("UPDATE `profile` SET picture = '".$newfilename."' WHERE `mid` ='".$_SESSION['uid']."' LIMIT 1;") or die(mysql_error());

}

} 

$query = mysql_query("SELECT * FROM `profile` WHERE mid = '".(int)$_SESSION['uid']."'");
$r = mysql_fetch_array($query);

if (strlen($r['picture']) > 0) {
$picture = "uploads/profiles/". $r['picture'];
$picture2 = "uploads/profiles/thumbs/". $r['picture'];
} else {
$picture = "uploads/profiles/default.jpg";
$picture2 = "uploads/profiles/thumbs/". $r['picture'];
}

if(!file_exists($picture)) {
$picture = "uploads/profiles/default.jpg";
$picture2 = "uploads/profiles/thumbs/". $r['picture'];
}
?>


<table width="97%" border="0" align="center" cellpadding="5" cellspacing="2">
<tr> 
<td> 
Current Profile Picture
</td>
</tr>
<tr>
<td align="center">
<img src="<? echo $picture; ?>" align="middle" style="border: 1px solid black" /></td>
</tr>


<tr> 
<td> 
Upload New Picture
</td>
</tr>
<tr>
<td>
<p>
There are certain restrictions when it comes to profile images:<br />
<br />
» The file must be jpg, gif, png or bmp format
</p>

<form method='post' enctype='multipart/form-data'>
<input type='file' name='imagefile' style="width: 75%"><br>
<input type='submit' name='Submit' value='Upload Image'>
</form>


</td>
</tr>

</table>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>