<?php
include("_mysql.php");
include("_functions.php");
include("_settings.php");
systeminc('globals.inc');

if (empty($_POST['username']) || (empty($_POST['password']))) {
?>
<html>
<head>
<style>
table {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 10px;
    color: #000000;
}
	</style>
</head>
<body bgcolor="#E6E6E6">
<table width="100%" height="100%">
  <tr>
    <td align="center">
    <img src="themes/spbfb/images/header_badge.png" border="0">
	  <table width="350" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666" bgcolor="#FFFFFF">
	    <tr>
		  <td align="center">
			Please enter a username or password. <br><br>
			<a href="javascript:history.back()">Go back and try it again!</a>
          </td>
		</tr>
	  </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php
} else {


$username = $_POST['username'];
$md5pass = md5($_POST['password']);

if (mysql_num_rows(safe_query("SELECT * FROM `members` WHERE `username`='$username'"))) {
$check = safe_query("SELECT `id`, `password` FROM `members` WHERE `username`='".$username."' ");
$user = mysql_fetch_array($check);

if ($md5pass == $user['password']) {
$_SESSION['uid'] 		= $user['id'];

mysql_query("UPDATE `members` SET `ip_address` = '".getip()."', `last_logged` = '".time()."' WHERE `id` ='".$user['id']."' LIMIT 1;") or die(mysql_error());

$cookie = base64_encode($user['id']); 
setcookie("cookuid", $cookie, time()+604800, '/');
$cookie2 = base64_encode(getip()); 
setcookie("cooklogged", $cookie2, time()+604800, '/');

$query2 = mysql_query("SELECT realname FROM `profile` WHERE mid = '".$user['id']."'");
$result = mysql_fetch_row($query2);

//$url = "http://ape.spb-fb.co.uk:6969/?control&testpwd&testchannel&POSTMSG&mailnotif&I AM ".ucfirst($result[0])."&anticache";
//file_get_contents($url); // this should send a command to APE-Server to tell everyone that this user has came online ...
//echo $url;
header("location: index.php?view=mypanel");

} else {
?>
<html>
<head>
<style>
table {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 10px;
    color: #000000;
}
	</style>
</head>
<body bgcolor="#E6E6E6">
<table width="100%" height="100%">
  <tr>
    <td align="center">
        <img src="themes/spbfb/images/header_badge.png" border="0">
	  <table width="350" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666" bgcolor="#FFFFFF">
	    <tr>
		  <td align="center">
You have entered an invalid password.<br><br>
<a href="javascript:history.back()">Go back and try it again!</a>
          </td>
		</tr>
	  </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php
}
} else {
?>
<html>
<head>
<style>
table {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 10px;
    color: #000000;
}
	</style>
</head>
<body bgcolor="#E6E6E6">
<table width="100%" height="100%">
  <tr>
    <td align="center">
        <img src="themes/spbfb/images/header_badge.png" border="0">
	  <table width="350" border="1" cellpadding="10" cellspacing="0" bordercolor="#666666" bgcolor="#FFFFFF">
	    <tr>
		  <td align="center">
No user with username <b><?php echo htmlspecialchars($username); ?></b> available.<br><br>
					  <a href="javascript:history.back()">Go back and try it again!</a>
          </td>
		</tr>
	  </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php
}

}

mysql_close($link);
?>

