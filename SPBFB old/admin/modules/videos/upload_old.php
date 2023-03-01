<?php
chdir("../uploads/media/videos/");

if (isset($_POST['action']) && $_POST['action'] == "doupload") {
$result = 0;

$error = 0;
$file_name = $_FILES['videofile']['name'];
$file_ext = strtolower(substr($_FILES['videofile']['name'], strrpos($_FILES['videofile']['name'], ".")));
$allowed = array('.mpg', '.avi', '.wmv', '.rm', '.3gp', '.mp4', '.asf', '.mpeg', '.mov');

if (strlen($_POST['title']) < 5) {
$titleerror = 1;
$error = 1;

$titleerrortxt = "Field cannot be below 5 characters.";
}

if (strlen($_POST['location']) < 5) {
$locationerror = 1;
$error = 1;

$locationerrortxt = "Field cannot be below 5 characters.";
}


if ($_FILES['videofile']['error'] > 0) {
$videofileerror = 1;
$error = 1;
$videofileerrortxt = "Please select a video file from your computer.";
}

if(!in_array($file_ext, $allowed)) {
$videofileerror = 1;
$error = 1;
$videofileerrortxt = "Please select a video file from your computer.";
}


if (strlen($_POST['content']) < 5) {
$contenterror = 1;
$error = 1;

$contenterrortxt = "Field cannot be below 5 characters.";
}

if ($error == 0) {
$title = trim(addslashes(htmlentities($_POST['title'], ENT_QUOTES)));
$location = trim(addslashes(htmlentities($_POST['location'], ENT_QUOTES)));
$host = trim(addslashes(htmlentities($_POST['host'], ENT_QUOTES)));
$content = trim(addslashes($_POST['content']));

// Lets Upload the file....
copy ($_FILES['videofile']['tmp_name'], basename($_FILES['videofile']['name'])) or die ("ERROR: ". $uploadErrors[$_FILES['videofile']['error']]); 


$filename = $_FILES['videofile']['name'];
$newfilename = time() . $file_ext;
rename($_FILES['videofile']['name'], $newfilename);

$flv = basename($newfilename, ".".pathinfo($newfilename, PATHINFO_EXTENSION)) . ".flv";
$tmpflv = basename($newfilename, ".".pathinfo($newfilename, PATHINFO_EXTENSION)) . "_tmp.flv";

$picture = basename($newfilename, ".".pathinfo($newfilename, PATHINFO_EXTENSION)) . ".jpg";

$ffmpeg_file = getcwd() ."/". $newfilename;
$ffmpeg_flv_file = getcwd() ."/". $flv;
$ffmpeg_tmp_file = getcwd() ."/". $tmpflv;

// now that it has uploaded and replaced spaces.... lets convert it to a FLV File
$ffmpeg = "ffmpeg -i $ffmpeg_file -sameq -acodec libmp3lame -ar 22050 -ab 96000 -deinterlace -nr 500 -s 320x240 -aspect 4:3 -r 20 -g 500 -me_range 20 -b 270k -f flv -y $ffmpeg_tmp_file 2>&1";

exec($ffmpeg, $output, $return);

// now that the temp file has been made :) lets change it to a flv file....
$flvtools = "/usr/bin/flvtool2 -Uv $ffmpeg_tmp_file $ffmpeg_flv_file";
exec($flvtools, $flvout, $flvreturn);

// so now that, its been changed... lets make a little picture
$make_pic = "ffmpeg -i $ffmpeg_flv_file -an -ss 00:00:03 -an -r 1 -vframes 1 -y -s 128x96 ".getcwd() ."/".$picture;
exec($make_pic, $output);

@unlink($newfilename);	// Gets rid of the Video File
@unlink($tmpflv);	// Gets rid of the TEMP Video File

exec("/usr/local/bin/mplayer -vo null -ao null -frames 0 -identify $ffmpeg_flv_file", $p);
$duration = str_replace("ID_LENGTH=", '', $p['22']);
$duration = round($duration/60, 2);


mysql_query("INSERT INTO `video` (`title`, `filename`, `video_length`, `added`, `location`, `host`, `description`) VALUES ('$title', '".basename($newfilename, ".".pathinfo($newfilename, PATHINFO_EXTENSION))."', '$duration', '".time()."','$location', '$host', '$content')") or die("ERROR: " . mysql_error());
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
Your video has been uploaded successfully.
<br />
<a href="index.php?view=admin&manager=videos" >go back</a> 
</td>
</tr>
</table> 
<?php
} else {
?>

<form name='post' method='post' enctype='multipart/form-data'>
<input type="hidden" name="action" value="doupload" />
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="form_table">
<tr>
<td colspan="2" class="form_heading">Upload Wallpaper</td>
</tr>

<tr>
  <td colspan="2" valign="top">
There are certain restrictions when it comes to uploading videos:<br />
<br />
The file must be mpg, avi, wmv, rm, 3gp, mp4, asf, mpeg, mov, etc. format
  </td>
  </tr>
<tr>
<td width="20%" valign="top" class="form_fieldtitle1">Title
<?php
if ($titleerror == 1) {
echo "<div class=\"form_error\">* ".$titleerrortxt."</div>";
}
?></td>
<td class="form_fieldinput1">
<?php
if ($titleerror == 1) {
echo "<div class=\"form_error_input\">";
}
?>
<input name="title" type="text" value="<?php echo $_POST['title']; ?>" size="64" maxlength="64"/>
<?php
if ($titleerror == 1) {
echo "</div>";
}
?></td>
</tr>

<tr>
<td width="20%" valign="top" class="form_fieldtitle1">Location
<?php
if ($locationerror == 1) {
echo "<div class=\"form_error\">* ".$locationerrortxt."</div>";
}
?></td>
<td class="form_fieldinput1">
<?php
if ($locationerror == 1) {
echo "<div class=\"form_error_input\">";
}
?>
<input name="location" type="text" value="<?php echo $_POST['location']; ?>" size="64" maxlength="64"/>
<?php
if ($locationerror == 1) {
echo "</div>";
}
?></td>
</tr>

<tr>
<td width="20%" valign="top" class="form_fieldtitle1">Host Band</td>
<td class="form_fieldinput1"><input name="host" type="text" value="<?php echo $_POST['host']; ?>" size="64" maxlength="64"/></td>
</tr>


<tr>
<td valign="top" class="form_fieldtitle1">File
<?php
if ($videofileerror == 1) {
echo "<div class=\"form_error\">* ".$videofileerrortxt."</div>";
}
?></td>
<td class="form_fieldinput1" valign="top">
<?php
if ($videofileerror == 1) {
echo "<div class=\"form_error_input\">";
}
?>
<input type='file' name='videofile' style="width: 75%">
<?php
if ($videofileerror == 1) {
echo "</div>";
}
?>
</td>
</tr>

<tr>
<td colspan="2" align="center" valign="top" class="form_fieldinput2" >
<?PHP echo bbtype(text); ?><br/></td>
  </tr>
  <tr>
    <td align="center" valign="top" class="form_fieldtitle1"><?PHP echo bbtype(smilies); ?></td>
    <td align="center" class="form_fieldinput1">
    <?php
if ($contenterror == 1) {
echo "<div class=\"form_error\">* ".$contenterrortxt."</div>";
echo "<div class=\"form_error_input\">";
}
?>
<textarea name="content" rows="15" wrap="virtual" style="width:450px; height: 220px; overflow:auto;" tabindex="3" class="form_table" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"><?php echo $_POST['content']; ?></textarea>
<?php
if ($contenterror == 1) {
echo "</div>";
}
?>
</td>
  </tr>



<tr>
<td align='center' class="form_fieldinput2" colspan='2' >
<button class="button" onclick="document.post.submit();" style="margin-bottom: 5px;">
<img src="../../images/misc/disk.png"/> Upload Video</button></td>
</tr>
</table>
</form>

<?php
}

} else {
?>
<script language="javascript">
function startUpload(){
      document.getElementById('f1_upload_process').style.visibility = 'visible';
      document.getElementById('f1_upload_form').style.visibility = 'hidden';
      return true;
}

function stopUpload(success){
      var result = '';
      if (success == 1){
         result = '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
      }
      else {
         result = '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
      }
      document.getElementById('f1_upload_process').style.visibility = 'hidden';
      document.getElementById('f1_upload_form').innerHTML = result + '<label>File: <input name="myfile" type="file" size="30" /><\/label><label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /><\/label>';
      document.getElementById('f1_upload_form').style.visibility = 'visible';      
      return true;   
}
</script>

<style>
#loader{
   visibility:hidden;
}

#f1_upload_form{
   height:100px;
}

#f1_error{
   font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
   font-weight:bold;
   color:#FF0000;
}

#f1_ok{
   font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
   font-weight:bold;
   color:#00FF00;

}

#f1_upload_form {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
	color: #666666;
}

#f1_upload_process{
   z-index:100;
   visibility:hidden;
   position:absolute;
   text-align:center;
   width:400px;
}
</style>

<div class='tableborder'>
 <div class='tableheaderalt'>Upload Video</div>
 
<form action="modules/videos/uploadvid.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
                     <p id="f1_upload_process">Loading...<br/><img src="loader.gif" /><br/></p>
                     <p id="f1_upload_form" align="center"><br/>
                         <label>File:  
                              <input name="myfile" type="file" size="30" />
                         </label>
                         <label>
                             <input type="submit" name="submitBtn" class="sbtn" value="Upload" />
                         </label>
                     </p>
                     
                     <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                 </form>

 
 
 <?php
 exit;
 ?>
 
 
<form action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" > 
<form name='post' method='post' enctype='multipart/form-data' target="upload_target">
<input type="hidden" name="action" value="doupload" />

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td valign="top" class="form_fieldtitle1"><strong>File:</strong></td>
<td class="form_fieldinput1" valign="top">
<p>
There are certain restrictions when it comes to uploading videos:<br />
<br />
» The file must be mpg, avi, wmv, rm, 3gp, mp4, asf, mpeg, mov, etc. format</p>
<input type='file' name='videofile' style="width: 75%"></td>
</tr>


<tr>
<td class='tablerow1'  width='19%'  valign='middle'><b>Video Title:</b></td>
<td class='tablerow2'  width='81%'  valign='middle'><input name="title" type="text" class="textinput" value="" size="60" /></td>
</tr>

<tr>
<td class='tablerow1'  width='19%'  valign='middle'><b>Location:</b></td>
<td class='tablerow2'  width='81%'  valign='middle'><input name="location" type="text" class="textinput" value="" size="60" /></td>
</tr>

<tr>
<td width="20%" valign="top" class="form_fieldtitle1">Host Band:</td>
<td class="form_fieldinput1"><input name="host" type="text" value="" size="64" maxlength="64"/></td>
</tr>




<tr>
<td colspan="2" align="center" valign="top" class="form_fieldinput2" >
<?PHP //echo bbtype(text); ?><br/>
</td>
  </tr>
  <tr>
    <td align="center" valign="top" class="form_fieldtitle1"><?PHP //echo bbtype(smilies); ?></td>
    <td align="center" class="form_fieldinput1">
<textarea name="content" rows="15" wrap="virtual" style="width:450px; height: 220px; overflow:auto;" tabindex="3" class="form_table" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"></textarea></td>
  </tr>



<tr>
<td align='center' class="form_fieldinput2" colspan='2' >
<button class="button" onclick="document.post.submit();" style="margin-bottom: 5px;">
<img src="../../images/misc/disk.png"/> Upload Video</button></td>
</tr>
</table>
</form>
</div>
<?php
}
?>