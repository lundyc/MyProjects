<?php
function safe_query($query="") {
    if(stristr($query, "union")===FALSE){
	if(empty($query)) return false;
	if(defined('DEBUGGING') && DEBUGGING == "OFF") $result = mysql_query($query) or die('Query failed!');
	else {
		$result = mysql_query($query) or die('Query failed: '
												.'<li>errorno='.mysql_errno()
												.'<li>error='.mysql_error()
												.'<li>query='.$query);
	}
	return $result;
    } else {
    die();
    }
}

function system_error($text) {
die('<html><body><center><br><table border="0" cellpadding="1" cellspacing="1" bgcolor="#eeeeee"><tr><td>ERROR</td></tr><tr bgcolor="#ffffff"><td><div style="color:#333333;font-family: Tahoma, Verdana, Arial; font-size: 8pt;"><font color="red">'.$text.'</font><br>&nbsp;</div></td></tr></table></center></body></html>');
}

/************************************************************************************
THIS IS ALL THE OLD STUFF TO BE SORTED OUT LATER ON *************
*************************************/
function checkbanned() {
	if (mysql_num_rows(mysql_query("SELECT * FROM `banned_ip` WHERE IP='".getip()."'"))> 0) {
		die("It seems you have been banned from viewing this website.<br />If you think you have been banned in error please contact me. admin@spb-fb.co.uk"); 
	}
}

function forcelogout() {
if ($_SESSION['uid'] == true) {
$logout 		= mysql_fetch_array(mysql_query("SELECT `force_logout` FROM members WHERE id='".$_SESSION['uid']."'"));

if ($logout['force_logout'] == 1) {
mysql_query("UPDATE `members` SET `force_logout` = '0' WHERE `id` ='".$_SESSION['uid']."' LIMIT 1;") or die(mysql_error());
header("location:logout.php");
}

}
}


function checkloggedin() {
if(isset($_COOKIE['cookuid']) && isset($_COOKIE['cooklogged'])){
$user 		= mysql_fetch_array(mysql_query("SELECT `id` FROM members WHERE id='".base64_decode($_COOKIE['cookuid'])."' AND ip_address='".base64_decode($_COOKIE['cooklogged'])."'"));

if(isset($user)) {
$_SESSION['uid'] 		= $user['id'];
mysql_query("UPDATE `members` SET `last_logged` = '".time()."' WHERE `id` ='".$user['id']."' LIMIT 1;") or die(mysql_error());
}

}

}

if(! function_exists('str_split')) {
function str_split($text, $split = 1) {
$array = array();
for ($i = 0; $i < strlen($text); $i += $split) {
$array[] = substr($text, $i, $split);
}
            
return $array;
}
} 

function cansee($item, $uid) {
$q = mysql_query("SELECT ".$item." FROM `members` WHERE id='".$uid."' LIMIT 1;");
$res = mysql_fetch_array($q);

return ($res[$item] == 1) ? true : false;
}

function permission($item) {

$q = mysql_query("SELECT `group` FROM `members` WHERE id='".$_SESSION['uid']."' LIMIT 1;");
$res = mysql_fetch_array($q);

$query2 = mysql_query("SELECT ".$item." FROM `permissions` WHERE pid='".$res['group']."'");
$res1 = mysql_fetch_array($query2);

return ($res1[$item] == 1) ? true : false;
}



// My Security Functions // 
function canviewadmin($pid) {
$q = mysql_query("SELECT `canviewadmin` FROM `permissions` WHERE pid='$pid' LIMIT 1;");
$res = mysql_fetch_array($q);
return $res['0'];
}


function getip() {
if (isSet($_SERVER)) {
 if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"])) {
  $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
 } elseif (isSet($_SERVER["HTTP_CLIENT_IP"])) {
  $realip = $_SERVER["HTTP_CLIENT_IP"];
 } else {
  $realip = $_SERVER["REMOTE_ADDR"];
 }

} else {
 if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
  $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
 } elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
  $realip = getenv( 'HTTP_CLIENT_IP' );
 } else {
  $realip = getenv( 'REMOTE_ADDR' );
 }
}
return $realip;
}

// The end of my settings....





function IDtoName($uid) {
$query2 = mysql_query("SELECT username FROM `members` WHERE id = '".$uid."'");
$result = mysql_fetch_row($query2);

return ucfirst($result['0']);
}

function userflag($uid) {

$query3 = mysql_query("SELECT * FROM `flags` WHERE `id` = '".$uid."' LIMIT 1;");
$results = mysql_fetch_array($query3);

return "<img src=\"images/flags/".$results['filename']."\" alt=\"".$results['name']."\" width=\"18\" height=\"12\" border=\"0\" align=\"absmiddle\" class=\"user_flag\" />";
}

/*
BB CODE STUFF 
*/

function icon($texte) {

    $texte = str_replace("mailto:", "mailto!", $texte);
    $texte = str_replace("http://", "_http_", $texte);
    $texte = str_replace("&quot;", "_QUOT_", $texte);
    $texte = str_replace("&#039;", "_SQUOT_", $texte);
    $texte = str_replace("&agrave;", "à", $texte);
    $texte = str_replace("&acirc;", "â", $texte);
    $texte = str_replace("&eacute;", "é", $texte);
    $texte = str_replace("&egrave;", "è", $texte);
    $texte = str_replace("&ecirc;", "ê", $texte);
    $texte = str_replace("&ucirc;", "û", $texte);

    $sql = mysql_query("SELECT `code`, `url` FROM `smilies` ORDER BY `id`");
    while (list($code, $url) = mysql_fetch_array($sql))
    {
           $texte = str_replace($code, '<img src="images/icones/' . $url . '" alt="" title="'.$code.'" />', $texte);
    } 

    $texte = str_replace("mailto!", "mailto:", $texte);
    $texte = str_replace("_http_", "http://", $texte);
    $texte = str_replace("_QUOT_", "&quot;", $texte);
    $texte = str_replace("_SQUOT_", "&#039;", $texte);
    $texte = str_replace("à", "&agrave;", $texte);
    $texte = str_replace("â", "&acirc;", $texte);
    $texte = str_replace("é", "&eacute;", $texte);
    $texte = str_replace("è", "&egrave;", $texte);
    $texte = str_replace("ê", "&ecirc;", $texte);
    $texte = str_replace("û", "&ucirc;", $texte);

    return($texte);
} 

function checkimg($url)
{       
    $url = rtrim($url);
    $ext = strrchr($url, ".");
    $ext = substr($ext, 1);

    if (!eregi("\.php", $url) && !eregi("\.htm", $url) && !eregi("\.[a-z]htm", $url) && substr($url, -1) != "/" && (eregi("jpg", $ext) || eregi("jpeg", $ext) || eregi("gif", $ext) || eregi("png", $ext) || eregi("bmp", $ext))) $img = $url;
    else $img = "images/noimagefile.gif";

    return($img);
}

function BBcode($texte)
{
    global $bgcolor3, $bgcolor1;

    if ($texte != "")
    {


        $texte = " " . $texte;
        $texte = preg_replace("#([\t\r\n ])([a-z0-9]+?){1}://([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="\2://\3"  onclick="window.open(this.href); return false;">\2://\3</a>', $texte);
        $texte = preg_replace("#([\t\r\n ])(www|ftp)\.(([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="http://\2.\3"  onclick="window.open(this.href); return false;">\2.\3</a>', $texte);
        $texte = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $texte);

	$texte = str_replace("\r", "", $texte);
	$texte = str_replace("\n", "<br />", $texte);

        $texte = preg_replace("/\[color=(.*?)\](.*?)\[\/color\]/i", "<span style=\"color: \\1;\">\\2</span>", $texte);
        $texte = preg_replace("/\[size=(.*?)\](.*?)\[\/size\]/i", "<span style=\"font-size: \\1px;\">\\2</span>", $texte);
        $texte = preg_replace("/\[font=(.*?)\](.*?)\[\/font\]/i", "<span style=\"font-family: \\1;\">\\2</span>", $texte);

/* 
ROFL THIS IS THE MODDED STUFF ALL THE REST MIGHT BE LEFT OUT I THINK ,..... MAYBE IM WRONG
*/ 
        $texte = str_replace("[b]", "<b>", $texte);
        $texte = str_replace("[/b]", "</b>", $texte);
        $texte = str_replace("[i]", "<i>", $texte);
        $texte = str_replace("[/i]", "</i>", $texte);
        $texte = str_replace("[u]", "<span style=\"text-decoration: underline;\">", $texte);
        $texte = str_replace("[/u]", "</span>", $texte);
        $texte = str_replace("[strike]", "<span style=\"text-decoration: line-through;\">", $texte);
        $texte = str_replace("[/strike]", "</span>", $texte);		
		
		$texte = str_replace("[left]", "<div style=\"text-align: left;\">", $texte);
        $texte = str_replace("[/left]", "</div>", $texte);
		$texte = str_replace("[center]", "<div style=\"text-align: center;\">", $texte);
        $texte = str_replace("[/center]", "</div>", $texte);
		$texte = str_replace("[right]", "<div style=\"text-align: right;\">", $texte);
        $texte = str_replace("[/right]", "</div>", $texte);		
        $texte = str_replace("[list]", "<li>", $texte);
        $texte = str_replace("[/list]", "</li>", $texte);		

        $texte = str_replace("[quote]", "<br /><table style=\"background: " . $bgcolor3 . ";\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" border=\"0\"><tr><td style=\"background: #FFFFFF;color: #000000\"><b>Quote :</b><br />", $texte);
        $texte = str_replace("[/quote]", "</td></tr></table><br />", $texte);
        $texte = str_replace("[code]", "<br /><table style=\"background: " . $bgcolor3 . ";\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" border=\"0\"><tr><td style=\"background: #FFFFFF;color: #000000\"><b>Code:</b><pre>", $texte);
        $texte = str_replace("[/code]", "</pre></td></tr></table>", $texte);

		$texte = preg_replace("/\[url\]www.(.*?)\[\/url\]/i", "<a href=\"http://www.\\1\" onclick=\"window.open(this.href); return false;\">\\1</a>", $texte);
        $texte = preg_replace("/\[url\](.*?)\[\/url\]/i", "<a href=\"\\1\" onclick=\"window.open(this.href); return false;\">\\1</a>", $texte);


        $texte = preg_replace_callback('/\[img\](.*?)\[\/img\]/i', create_function('$var', '$img = "<img style=\"border: 0;\" src=\"" . checkimg($var[1]) . "\" alt=\"\" />";return $img;'), $texte);
/*
END OF MODDED SHITE
*/

        $texte = str_replace("[blink]", "<span style=\"text-decoration: blink;\">", $texte);
        $texte = str_replace("[/blink]", "</span>", $texte);
        $texte = preg_replace("/\[flip\](.*?)\[\/flip\]/i", "<div style=\"width: 100%;filter: FlipV;\">\\1</div>", $texte);
        $texte = preg_replace("/\[blur\](.*?)\[\/blur\]/i", "<div style=\"width: 100%;filter: blur();\">\\1</div>", $texte);
        $texte = preg_replace("/\[glow\](.*?)\[\/glow\]/i", "<div style=\"width: 100%;filter: glow(color=red);\">\\1</div>", $texte);
        $texte = preg_replace("/\[glow=(.*?)\](.*?)\[\/glow\]/i", "<div style=\"width: 100%;filter: glow(color=\\1);\">\\2</div>", $texte);
        $texte = preg_replace("/\[shadow\](.*?)\[\/shadow\]/i", "<div style=\"width: 100%;filter: shadow(color=red);\">\\1</div>", $texte);
        $texte = preg_replace("/\[shadow=(.*?)\](.*?)\[\/shadow\]/i", "<div style=\"width: 100%;filter: shadow(color=\\1);\">\\2</div>", $texte);
        $texte = preg_replace("/\[email\](.*?)\[\/email\]/i", "<a href=\"mailto:\\1\">\\1</a>", $texte);
        $texte = preg_replace("/\[email=(.*?)\](.*?)\[\/email\]/i", "<a href=\"mailto:\\1\">\\2</a>", $texte);
        $texte = preg_replace("/\[quote=(.*?)\]/i", "<br /><table style=\"background: " . $bgcolor3 . ";\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\" border=\"0\"><tr><td style=\"background: #FFFFFF;color: #000000\"><b>\\1 Has Wrote:</b><br />", $texte);
        $texte = preg_replace_callback('/\[img\](.*?)\[\/img\]/i', create_function('$var', '$img = "<img style=\"border: 0;\" src=\"" . checkimg($var[1]) . "\" alt=\"\" />";return $img;'), $texte);
        $texte = preg_replace_callback('/\[img=(.*?)x(.*?)\](.*?)\[\/img\]/i', create_function('$var', '$img = "<img style=\"border: 0;\" width=\"" . $var[1] . "\" height=\"" . $var[2] . "\" src=\"" . checkimg($var[3]) . "\" alt=\"\" />";return $img;'), $texte);
	$texte = preg_replace("/\[flash\](.*?)\[\/flash\]/i", "<object type=\"application/x-shockwave-flash\" data=\"\\1\"><param name=\"movie\" value=\"\\1\" /><param name=\"pluginurl\" value=\"http://www.macromedia.com/go/getflashplayer\" /></object>", $texte);
        $texte = preg_replace("/\[flash=(.*?)x(.*?)\](.*?)\[\/flash\]/i", "<object type=\"application/x-shockwave-flash\" data=\"\\3\" width=\"\\1\" height=\"\\2\"><param name=\"movie\" value=\"\\3\" /><param name=\"pluginurl\" value=\"http://www.macromedia.com/go/getflashplayer\" /></object>", $texte);
	$texte = preg_replace("/\[url\]www.(.*?)\[\/url\]/i", "<a href=\"http://www.\\1\" onclick=\"window.open(this.href); return false;\">\\1</a>", $texte);
        $texte = preg_replace("/\[url\](.*?)\[\/url\]/i", "<a href=\"\\1\" onclick=\"window.open(this.href); return false;\">\\1</a>", $texte);
        $texte = preg_replace("/\[url=(.*?)\](.*?)\[\/url\]/i", "<a href=\"\\1\" onclick=\"window.open(this.href); return false;\">\\2</a>", $texte);
        $texte = preg_replace("#\[s\](http://)?(.*?)\[/s\]#si", "<img style=\"border: 0;\" src=\"images/icones/\\2\" alt=\"\" />", $texte);
    
	$texte = ltrim($texte);
    } 
    return($texte);
} 

?>