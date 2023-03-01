 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Forgot Password</h2>

<?php
if (isset($_GET['id'])) {
$query = mysql_query("SELECT `id`, `email`, `password` FROM `members` WHERE `id`='".$_GET['id']."'");
$r = mysql_fetch_array($query);

$getcode = base64_decode($_GET['code']);
$pass = substr($r['password'],0,10);

if ($getcode == $pass) {
//$p = substr(md5(uniqid(rand(),1)), 3, 10); 
//$np = md5($p);

$p = "changeme";
$np = md5("changeme");

mysql_query("UPDATE `members` SET `password` = '".$np."' WHERE `members`.`id` =".(int)$_GET['id']." LIMIT 1 ;");

$body = "Dear ".idtoname($r['id']).",\n\n";
$body .= "As you requested, your password has now been reset. Your new details are as follows:\n\n";
$body .= "Username: ". idtoname($r['id']) . "\n";
$body .= "Password: ". $p . "\n\n";
$body .= "To edit your profile, go to this page:\n";
$body .= "http://www.spb-fb.co.uk/?view=mypanel\n\n";
$body .= "All the best,\n";
$body .= "Webmaster, Saltcoats Protestant Boys FB\n\n\n";
mail ($r['email'], 'Your temporary password.', $body, 'From: SPB Password Recovery <password@spb-fb.co.uk>'); 

?>
<table width="98%" border="0" align="center" cellpadding="5" cellspacing="3">
<tr>
  <td colspan="2" valign="top">Your password has now been reset and emailed to you. Please check your email to find your new password.</td>
  </tr>
  </table>
<?php } else { ?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td colspan="2" valign="top">Code does not match</td>
  </tr>
  </table>
<?php
}

} else {

if ($_POST['action'] == "step1") {
$error = 0;
$errortxt = '';

if (empty($_POST['email'])) { 
$error = 1; 
$errortxt = "You forgot to enter your email!";
} else {

$query = mysql_query("SELECT `id`, `email`, `password` FROM `members` WHERE `email`='".$_POST['email']."'");
$r = mysql_fetch_array($query);

if (strlen($r['email']) > 0) {
$id 		= $r['id'];
$email 		= $r['email'];
$password 	= $r['password'];

$code = substr($password, 0, 10); 
$code = base64_encode($code);

} else {
$error = 1;
$errortxt = "The submitted email does not match those on file!"; 
}

}

if ($error == 0) {
// Send an email. 
$body = "Dear " . idtoname($r['id']) . ",\n\n";
$body .= "You have requested to reset your password on the Saltcoats Protestant Boys FB website, because you have forgotten your password. If you did not request this, please ignore it. It will expire and become useless in 24 hours time.\n\n";
$body .= "To reset your password, please visit the following page:\n\n";
$body .= "http://www.spb-fb.co.uk/?view=forgotpass&id=".$id."&code=".$code ."\n\n";
$body .= "When you visit that page, your password will be reset, and the new password will be emailed to you.\n\n";
$body .= "Your username is: " . strtolower(idtoname($r['id'])) . "\n\n";
$body .= "To edit your profile, go to this page:\n";
$body .= "http://www.spb-fb.co.uk/?view=mypanel\n\n";
$body .= "All the best,\n";
$body .= "Webmaster, Saltcoats Protestant Boys FB\n\n\n";

mail ($email, 'Your temporary password.', $body, 'From: SPB Password Recovery <password@spb-fb.co.uk>'); 
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td colspan="2" valign="top">Your username and details about how to reset your password have been sent to you by email.</td>
  </tr>
  </table>
<?php
} else {
?>
<form id='form' action='' method='post'>
<input type='hidden' name='action' value='step1' />
<table width="98%" border="0" align="center" cellpadding="5" cellspacing="3">
<tr>
  <td colspan="2" valign="top">We can email you a new one. Just enter your email address in the box below.</td>
  </tr>
<tr>
<td width="20%" valign="top">Email:
<?php
if (strlen($errortxt) > 0) {
echo "<div class=\"form_error\">* ".$errortxt."</div>";
}
?>
</td>
<td class="form_fieldinput1">
<?php
if (strlen($errortxt) > 0) {
echo '<div class="form_error_input">';
}
?>
<input style='border:1px solid #AAA;' type='text' size='60' name='email' id='namefield' />
<?php
if (strlen($errortxt) > 0) {
echo "</div>";
}
?>
</td>
</tr>

<tr><td align='center' colspan='2' >
<button class="button" onclick="document.post.submit();" style="margin-bottom: 5px">
<img src="../../images/misc/disk.png"/> Request Password</button>
</td></tr>
</table>
</form>
<?php
}

} else {
?>
<form id='post' name="post" method='post'>
<input type='hidden' name='action' value='step1' />
<table width="98%" border="0" align="center" cellpadding="5" cellspacing="3">
<tr>
  <td colspan="2" valign="top">We can email you a new one. Just enter your email address in the box below.</td>
  </tr>
<tr>
<td width="20%" valign="top">Email address:</td>
<td><input style='border:1px solid #AAA;' type='text' size='60' name='email' id='namefield' /></td>
</tr>

<tr><td align='center' colspan='2' >
<button class="button" onclick="document.post.submit();" style="margin-bottom: 5px">
<img src="images/misc/disk.png"/> Request Password</button>
</td></tr>
</table>
</form>
<?php
}

}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
