<?php
function IsOnline($userID) {
    $ergebnis=mysql_query("SELECT query FROM `online_users` WHERE userID='{$userID}'");

	if(mysql_num_rows($ergebnis)) {
	    $ds=mysql_fetch_array($ergebnis);
		return "<b>online</b> @ <a href=\"index.php?view={$ds['query']}\">{$ds['query']}</a>";
	}	
	else return 'offline';
}

function IDtoName($uid) {
$query2 = mysql_query("SELECT username FROM `members` WHERE id = '{$uid}'");
$result = mysql_fetch_row($query2);

return ucfirst($result['0']);
}

function IDtoNick($uid) {
$query2 = mysql_query("SELECT nickname FROM `profile` WHERE mid = '{$uid}'");
$result = mysql_fetch_row($query2);

return ucfirst($result['0']);
}

function IDtoFullName($uid) {
$query2 = mysql_query("SELECT realname FROM `profile` WHERE mid = '{$uid}'");
$result = mysql_fetch_row($query2);

return ucfirst($result[0]);
}

function IDtoEmail($uid) {
$query2 = mysql_query("SELECT email FROM `members` WHERE id = '{$uid}'");
$result = mysql_fetch_row($query2);

return $result['0'];
}

function CustomStatus($uid) {
$st = mysql_query("SELECT `name` FROM `customstatus` WHERE `id` = '{$uid}'");
$s = mysql_fetch_array($st);

return $s['name'];
}

function UserFlag($uid) {

$query3 = mysql_query("SELECT filename,name FROM `flags` WHERE `id` = '{$uid}' LIMIT 1;");
list($filename, $name) = mysql_fetch_row($query3);

return '<img src="images/flags/'.$filename.'" alt="'.$name.'" width="18" height="12" border="0" align="absmiddle" class="user_flag" />';
}
?>