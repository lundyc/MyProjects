 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Change Password</h2>

<?php
if ($_POST['action'] == "changepassword") {

$_SESSION['error'] = '';
$error = 0;

$password = md5($_POST['password']);
$query = mysql_query("SELECT `id` FROM `members` WHERE password = '".$password."' AND id = '".$_SESSION['uid']."' LIMIT 1;");
$ans = mysql_num_rows($query);

if ($ans == 0) {
$_SESSION['error'] .= "<li>Your password doesn't match the password in our database.</li>\n";
$error = 1;
}

if (empty($_POST['newpass']) || empty($_POST['newpass2'])) {
$_SESSION['error'] .= "<li>Please enter a new password and confirm it.</li>\n";
$error = 1;
}

if ($_POST['newpass'] != $_POST['newpass2']) {
$_SESSION['error'] .= "<li>The passwords you entrerd do not match.</li>\n";
$error = 1;
}

if ($error == 0) {
$password = md5($_POST['newpass']);
mysql_query("UPDATE `members` SET `password` = '".$password."' WHERE `id` ='".$_SESSION['uid']."' LIMIT 1;");
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">
<tr>
<td bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080; text-align:center">
<table width="100%">
<tr>
  <td width="11%" rowspan="2" align="center" valign="middle">
    <img src="themes/spbfb/images/admin/tick.png" width="48" height="48" align="left" /></td>
  <td width="89%" align="left" style="border-bottom: 1px solid #666666; width:100%;"><strong><big>Thank You</big></strong></td>
</tr>
<tr>
<td align="left">
<p>
Your password has been successfully updated. Please remember the next time you login to use your new password.
<br>
</p></td>
</tr>
</table>
</td>
</tr>
</table>
<?php
unset($_SESSION['error']);
redirect("./?view=mypanel", 5);

} else {
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">
<tr>
<td bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080; text-align:center">
<table width="100%">
<tr>
  <td width="11%" rowspan="2" align="center" valign="middle">
    <img src="themes/spbfb/images/admin/warning.png" width="48" height="48" align="left" /></td>
  <td width="89%" align="left" style="border-bottom: 1px solid #666666; width:100%;"><strong><big>Warning</big></strong></td>
</tr>
<tr>
<td align="left">


<p>
There was a error with your form submission. Please check the following errors.<br>
<br>
<?php echo $_SESSION['error'];?></p></td>
</tr>
</table>
</td>
</tr>
</table>
<?php
}

} else {
?>


<form method="post" action="" id="changepassword">
<input type="hidden" name="action" value="changepassword" />

<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">

<tr>
<td valign="top"><b>Current Password</b></td>
 <td><input type="password" id="password" name="password" value="" size="60"></td>
</tr>

  <tr>
<td valign="top">Create New Password:</td>
 <td><input type="password" id="newpass" name="newpass" value="" size="60" /></td>
  </tr>
  
  <tr>
<td valign="top">Confirm New Password: </td>
<td><input type="password" id="newpass2" name="newpass2" value="" size="60"></td>
  </tr>
  
    <tr> 
<td colspan="2">
<input type="submit" class='button' value="Change my password" /></td>
</tr>
 
</table>

</form>
<?php
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>