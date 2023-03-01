<?php
/*
Functions in this file....

getip()				// get the clients IP
checkloggedin()		// check if the user has cookies set
level(userid)		// grabs the users level from db
*/

function getip() {
	$GLOBALS['ip'] = $_SERVER['REMOTE_ADDR'];
	if(!$GLOBALS['ip']) $GLOBALS['ip']=getenv('REMOTE_ADDR');
	
	return $GLOBALS['ip'];
}

function checkloggedin() {
if(isset($_COOKIE['cookuid']) && isset($_COOKIE['cooklogged'])){

$q = mysql_query("SELECT `id` FROM members WHERE id='".base64_decode($_COOKIE['cookuid'])."' AND ip_address='".base64_decode($_COOKIE['cooklogged'])."'");
$user = mysql_fetch_array($q);
		
if($user['id'] > 0) {
$_SESSION['uid'] 		= $user['id'];
mysql_query("UPDATE `members` SET `last_logged` = '".time()."' WHERE `id` ='".$user['id']."' LIMIT 1;") or die(mysql_error());

if(mysql_num_rows(mysql_query("SELECT userID FROM `online_users` WHERE `userID`='".$_SESSION['uid']."'")) > 0) {

mysql_query("UPDATE `online_users` SET `query` = '".$_GET['view']."', `time`= '".time()."' WHERE `userID`='".$_SESSION['uid']."'");

}	
else mysql_query("INSERT INTO `online_users` (time, userID, nickname, query, ip) VALUES ('".time()."', '".$_SESSION['uid']."', '".idtoname($_SESSION['uid'])."', '".$_GET['view']."', '".getip()."')");


		}
	
	}

}

function level($uid) {
	$q = mysql_query("SELECT `level` FROM `members` WHERE id='$uid' LIMIT 1;");
	$res = mysql_fetch_array($q);
	return $res['0'];
}

?>