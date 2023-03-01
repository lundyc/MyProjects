<?php
echo "<pre>";

if ($handle = opendir('userfiles/mp3')) {

    while (false !== ($file = readdir($handle))) {
	if ($file == "." || $file == "..") {
	continue; 
	}
	echo "<b>".$file ."</b><br>";
	
	/*
	if ($file != "courtroom_old_ulster.mp3") {
	@unlink("userfiles/mp3/".$file);
	}
	*/

		print_r(posix_getpwuid(fileowner("userfiles/mp3/". $file)));
    }

    closedir($handle);
}

echo "</pre>";
?>