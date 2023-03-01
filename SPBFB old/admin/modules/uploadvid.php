<?php
error_reporting(E_ALL);




if(isset($_POST['submit'])) {
  
$uploadErrors = array(
    0 => 'There is no error, the file uploaded with success.',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
    3 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
    4 => 'The uploaded file was only partially uploaded.',
    5 => 'No file was uploaded.',
    6 => 'Missing a temporary folder.',
    7 => 'Failed to write file to disk.',
    8 => 'File upload stopped by extension.',
);  

$file_ext = strtolower(substr($_FILES['videofile']['name'],strrpos($_FILES['videofile']['name'],".")));
$allowed = array('.mpg', '.avi', '.wmv', '.rm', '.3gp', '.mp4', '.asf', '.mpeg', '.mov');

if(in_array($file_ext, $allowed)) {
// Lets Upload the file....
copy ($_FILES['videofile']['tmp_name'], "uploads/videos/" . basename($_FILES['videofile']['name'])) or die ("ERROR: ". $uploadErrors[$_FILES['videofile']['error']]); 

$filename = "uploads/videos/" . $_FILES['videofile']['name'];
$newfilename = str_replace(" ", "_", $filename);
rename("uploads/videos/" . $_FILES['videofile']['name'], $newfilename);

$flv = basename($newfilename, ".".pathinfo($newfilename, PATHINFO_EXTENSION)) . ".flv";
$tmpflv = basename($newfilename, ".".pathinfo($newfilename, PATHINFO_EXTENSION)) . "_tmp.flv";

$picture = getcwd() ."/uploads/videos/%d.jpg";

$ffmpeg_file = getcwd() ."/". $newfilename;
$ffmpeg_flv_file = getcwd() ."/uploads/videos/" . $flv;
$ffmpeg_tmp_file = getcwd() ."/uploads/videos/" . $tmpflv;

// now that it has uploaded and replaced spaces.... lets convert it to a FLV File
$ffmpeg = "ffmpeg -i $ffmpeg_file -sameq -acodec libmp3lame -ar 22050 -ab 96000 -deinterlace -nr 500 -s 320x240 -aspect 4:3 -r 20 -g 500 -me_range 20 -b 270k -f flv -y $ffmpeg_tmp_file 2>&1";

exec($ffmpeg, $output, $return);

// now that the temp file has been made :) lets change it to a flv file....
$flvtools = "/usr/bin/flvtool2 -Uv $ffmpeg_tmp_file $ffmpeg_flv_file";
exec($flvtools, $flvout, $flvreturn);

// so now that, its been changed... lets make a little picture
exec("ffmpeg -i $ffmpeg_flv_file -an -ss 00:00:08 -an -r 1 -vframes 1 -y ".$picture);

@unlink($newfilename);	// Gets rid of the Video File
@unlink("uploads/videos/" . $tmpflv);	// Gets rid of the TEMP Video File

$picture = "uploads/videos/" . basename($newfilename, ".".pathinfo($newfilename, PATHINFO_EXTENSION)) . ".jpg";

if (file_exists("uploads/videos/1.jpg")) {
copy("uploads/videos/1.jpg", $picture);
@unlink("uploads/videos/1.jpg");
} 

//////////////

//exec("/usr/local/bin/mplayer -vo null -ao null -frames 0 -identify ". $cdir . $filename. ".flv", $p);
//$duration = str_replace("ID_LENGTH=", '', $p['22']);
//$duration = round($duration/60, 2);

}

} else { 
?>


<table width="97%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">
<tr> 
<td style="border-collapse: collapse; color: #E1E1E1; border: 1px solid #808080; background-color: #E1E1E1"> 
<font color="#000000">Upload Video</font>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080">
<p>
There are certain restrictions when it comes to uploading videos:<br />
<br />
» The file must be mpg, avi, wmv, rm, 3gp, mp4, asf, mpeg, mov, etc. format
</p>

<form name='form1' method='post' action='' enctype='multipart/form-data'>
<input type='file' name='videofile' style="width: 75%"><br>
<input type='submit' name='submit' value='Upload Image'>
</form>


</td>
</tr>

</table>
<?php
}
?>