 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Update E-Mail</h2>

<?php
if ($_POST['action'] == "changeemail") {

$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['email'])) {
$_SESSION['error'] .= "<li>Please enter a email address.</li>\n";
$error = 1;
}

if ($error == 0) {
mysql_query("UPDATE `members` SET `email` = '".$_POST['email']."' WHERE `id` ='".$_SESSION['uid']."' LIMIT 1;");
?>
Your email address has been updated
<?php
unset($_SESSION['error']);
redirect("./?view=mypanel", 5);

} else {
?>
<p>
There was a error with your form submission. Please check the following errors.<br>
<br>
<?php echo $_SESSION['error'];?></p></td>
<?php
}

} else {
?>


<form method="post" action="./?view=changeemail">
<input type="hidden" name="action" value="changeemail" />

<table width="100%" border="0" align="center" cellspacing="5" cellpadding="0">

<tr>
<td valign="top">E-Mail:</td>
<td><input type="text" id="email" name="email" value="" size="60" /></td>
</tr>
    
    <tr> 
<td colspan="2" align="center">
<input type="submit" class='button' value="Update E-Mail" /></td>
</tr>
 
</table>

</form>
<?php
}
?>


  </div>
  <div class="bb"><div><div></div></div></div>
</div>
