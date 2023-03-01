<?php
chdir("../uploads/videos/");
$result = 0;

$file_name = $_FILES['videofile']['name'];
$file_ext = strtolower(substr($_FILES['videofile']['name'], strrpos($_FILES['videofile']['name'], ".")));
$allowed = array('.mpg', '.avi', '.wmv', '.rm', '.3gp', '.mp4', '.asf', '.mpeg', '.mov');

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

$result = 1;
?>
<script language="javascript" type="text/javascript">
window.top.window.stopUpload(<?php echo $result; ?>);
</script>