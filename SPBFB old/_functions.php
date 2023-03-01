<?php
systeminc("func/captcha");

function redirect($url, $tps)
{
    $temps = $tps * 1000;

    echo "<script type=\"text/javascript\">\n"
    . "<!--\n"
    . "\n"
    . "function redirect() {\n"
    . "window.location='" . $url . "'\n"
    . "}\n"
    . "setTimeout('redirect()','" . $temps ."');\n"
    . "\n"
    . "// -->\n"
    . "</script>\n";
} 

function safe_query($query="") {
    if(stristr($query, "union")===FALSE){
	if(empty($query)) return false;
	if(DEBUG == "OFF") $result = mysql_query($query) or die('Query failed!');
	else {
$result = mysql_query($query) or die('<table border="0" cellpadding="2" cellspacing="2" bgcolor="#eeeeee" width="50%"><tr>
    <td colspan="2"><strong>QUERY ERROR</strong></td></tr>
  <tr bgcolor="#ffffff">
    <td><strong>Error Number:</strong></td>
    <td>'.mysql_errno().'</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td><strong>Error:</strong></td>
    <td>'.mysql_error().'</td>
  </tr>
  <tr bgcolor="#ffffff">
    <td><strong>SQL Query:</strong></td>
    <td>'.$query.'</td></tr></table>');
	}
	return $result;
    }
    else {
    die();
    }
}

function system_error($text,$system=1) {
	if($system) {
		$info='PHP version: '.phpversion().'<br>MySQL version: '.mysql_get_server_info().'<br>';
	} else {
	$info = '';
	}
die('<html><body><center><br><table border="0" cellpadding="1" cellspacing="1" bgcolor="#eeeeee"><tr><td><strong>ERROR</strong></td></tr><tr bgcolor="#ffffff"><td><div style="color:#333333;font-family: Tahoma, Verdana, Arial; font-size: 8pt;">'.$info.'<br><font color="red">'.$text.'</font><br>&nbsp;</div></td></tr></table></center></body></html>');
}

function systeminc($file) {
	if(!include('src/'.$file.'.php')) system_error('Could not get system file for '.$file);
}



/************************************************************************************
THIS IS ALL THE OLD STUFF TO BE SORTED OUT LATER ON *************
*************************************/
if(! function_exists('str_split')) {
	function str_split($text, $split = 1) {
	$array = array();
		for ($i = 0; $i < strlen($text); $i += $split) {
			$array[] = substr($text, $i, $split);
		}				
	return $array;
	}
} 

// My Security Functions // 
systeminc("func/security");
// User Functions
systeminc("func/user");
// Bulletin Board Code	
systeminc("func/bbcode");
?>