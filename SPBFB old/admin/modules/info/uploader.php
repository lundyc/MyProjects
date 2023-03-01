<?php
if ($_POST) {
$uploaddir = '../uploads/mp3/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

echo "file uploaded. <br>";

$path_parts = pathinfo($uploadfile);
rename($uploadfile, $uploaddir. basename(str_replace(" ", "_", $_POST['filename'])). '.' .$path_parts['extension']);

echo "File renamed.<br>";

if ($path_parts['extension'] != "mp3") {
$oldfile = basename(str_replace(" ", "_", $_POST['filename'])). '.' .$path_parts['extension'];
$newfile = basename(str_replace(" ", "_", $_POST['filename'])) . '.mp3';

$ofile = $uploaddir . $oldfile;
$nfile = $uploaddir . $newfile;

$command = "ffmpeg -i " . $ofile . " -ab 32 " . $nfile . " 2>&1";
exec($command);

echo "file converted.<br>";

unlink($ofile);

if (!is_file($ofile)) {
echo $path_parts['extension'] . " file has been removed.<br>";
} else {
echo $path_parts['extension']. " file still lives<br>";
}

}

echo "File is valid, and was successfully uploaded.\n";
?>
<script type="text/javascript"
 src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
setInterval(window.history.go(-2), 2000);
});
</script>
<?php

} else {
echo "Possible file upload attack!\n";
}

} else {
?>

<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="" method="POST">
<!-- MAX_FILE_SIZE must precede the file input field -->
<input type="hidden" name="MAX_FILE_SIZE" value="" />
<!-- Name of input element determines name in $_FILES array -->
Song Name: <input name="filename" type="input">
<br />
Send this file: <input name="userfile" type="file" />
<input type="submit" value="Send File" />
</form>
<?php
}
?>
