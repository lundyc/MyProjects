<?php 
/*
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() - 3600));
 if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
header('Content-type: text/html; charset=iso-8859-1');
*/
include("_mysqli.php"); 

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

// http://www.colourlovers.com/palette/2690607/Wisp

//session_start();

if (isMobile()) {
	// Load mobile version.... 
		include("mobile_index.php");
} else {
	// Load Normal one
	include("desktop_index.php");
}
?>