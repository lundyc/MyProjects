<?PHP
include("../../_mysqli.php");
require '../../lib/password.php';
if ($_POST['action'] == "doedit") {
$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['newpass']) || empty($_POST['newpass2'])) {
$_SESSION['error'] .= "<li>Please enter a new password and confirm it.</li>\n";
$error = 1;
}

if ($_POST['newpass'] != $_POST['newpass2']) {
$_SESSION['error'] .= "<li>The passwords you entrerd do not match.</li>\n";
$error = 1;
}

if ($error == 0) {


$password = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
$mysqli->query("UPDATE `members` SET `password` = '".$password."' WHERE `id` ='".$_GET['id']."' LIMIT 1;");
?>
<center>
Password Changed<br />
<A href="javascript: self.close ()">Close this Window</A> 
</center>

<?php

} else {
echo $_SESSION['error'];
}

} else {
$query = $mysqli->query("SELECT * FROM `profile` WHERE mid='".$_GET['id']."' LIMIT 1;");
$p = $query->fetch_assoc();

?>
<style>
body {
background-color: #EEEEEE
}
</style>


Editing: <?php echo $p['realname'] ;?> (ID: <?php echo $p['mid'] ;?>)

<form method="post" action="">
<input type="hidden" name="action" value="doedit">
<table>
<tr>
<td>New Password:</td>
<td><input type='password' name='newpass' value="" size='30'></td>
</tr>
<tr>
<td>Confirm New Password:</td>
<td><input type='password' name='newpass2' value="" size='30'></td>
</tr>
<tr>
<td colspan="2"><input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td>
</tr>
</table>
<?php
}
?>