<?php
include("../_mysql.php");
include("../_functions.php");
include("../_settings.php");

if (!empty($_FILES)) {
$uploaddir = '../../uploads/videos/tmp/';
$uploadfile = $uploaddir . basename($_FILES['Filedata']['name']);

if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $uploadfile)) {

$path_parts = pathinfo($uploadfile);
$time = time();
$new_name = $time .'.' .$path_parts['extension'];

rename($uploadfile, $uploaddir. $new_name);

$oldfile = $new_name;
$newfile = $time . '.flv';

$ofile = $uploaddir . $oldfile;
$nfile = '/home/spbfb/public_html/uploads/videos/tmp/' . $new_name;
$realfile = '/home/spbfb/public_html/uploads/videos/' . $new_name;
$tfile = '/home/spbfb/public_html/uploads/videos/' . $time . '.flv';

$ffmpeg = "ffmpeg -i $nfile -sameq -acodec libmp3lame -ar 22050 -ab 96000 -deinterlace -nr 500 -s 320x240 -aspect 4:3 -r 20 -g 500 -me_range 20 -b 270k -f flv -y $tfile ";
echo "2>&1";

echo "<pre>";
exec($ffmpeg);
echo "</pre>";


/*
<script type="text/javascript"
 src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
setInterval(window.history.go(-2), 2000);
});
</script>
*/
} else {
echo "Possible file upload attack!\n";
}

} 
?>