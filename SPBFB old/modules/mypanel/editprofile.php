<?php
if (isset($_POST['action']) && $_POST['action'] == "doedit") {
$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['members']['email'])) {
$_SESSION['error'] .= "<li>Please enter a E-Mail</li>\n";
$error = 1;
}


if ($error == 0) {
$updatestring = '';
$updatestring2 = '';

while (list($settingname, $settingvalue) = each($_POST['members'])) {
$updatestring .= "`".$settingname."` = '".$settingvalue."', ";
}

while (list($settingname2, $settingvalue2) = each($_POST['profile'])) {
$updatestring2 .= $settingname2."='".$settingvalue2."',";
}

$updatestring = substr($updatestring,0,strlen($updatestring) - 2);
$updatestring2 = substr($updatestring2,0,strlen($updatestring2) - 1);

mysql_query("UPDATE `members` SET $updatestring WHERE id =".$_SESSION['uid']." LIMIT 1 ;");
mysql_query("UPDATE `profile` SET $updatestring2 WHERE `mid` =".$_SESSION['uid']." LIMIT 1 ;");
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">
<tr>
<td bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080; text-align:center">
<table width="100%">
<tr>
  <td width="11%" rowspan="2" align="center" valign="middle">
    <img src="themes/images/admin/tick.png" width="48" height="48" align="left" /></td>
  <td width="89%" align="left" style="border-bottom: 1px solid #666666; width:100%;"><strong><big>Thank You</big></strong></td>
</tr>
<tr>
<td align="left">
<p>
Your profile has been updated. Please hold as we redirect you back to my controls<br>
</p></td>
</tr>
</table>
</td>
</tr>
</table>
<?php
unset($_SESSION['error']);
redirect("index.php?view=mypanel", 5);

} else {
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">
<tr>
<td bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080; text-align:center">
<table width="100%">
<tr>
  <td width="11%" rowspan="2" align="center" valign="middle">
    <img src="themes/images/admin/warning.png" width="48" height="48" align="left" /></td>
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

$query = mysql_query("SELECT * FROM `members` WHERE id='".$_SESSION['uid']."' LIMIT 1;");
$r = mysql_fetch_array($query);

$query2 = mysql_query("SELECT * FROM `profile` WHERE mid='".$_SESSION['uid']."' LIMIT 1;");
$p = mysql_fetch_array($query2);

$day = $p['bday_day'];
$month = $p['bday_month'];
$year = $p['bday_year'];

?>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Edit Profile </h2>
<form method="post" name="post" action="./?view=mypanel&action=editprofile" >
<table width="100%" border="0" align="center" cellspacing="2" cellpadding="5">

<tr>
<td valign="top">Date of Birth</td>
 <td>
<select name="profile[bday_day]" class="shoutbox">
<?php
if ($day != "") {
echo "<option>" . $day . "</option>\n";
echo "<option>---------</option>\n";
} else {
$checked1 = "selected=\"selected\"";
} 

$day2 = 1;
while ($day2 < 32) {
if ($day2 == date("d")) {
echo "<option value=\"" . $day2 . "\" " . $checked1 . ">" . $day2 . "</option>\n";
} else {
echo "<option value=\"" . $day2 . "\">" . $day2 . "</option>\n";
} 
$day2++;
} 
?>
</select>

<select name="profile[bday_month]" class="shoutbox">
<?php

if ($month != ""){
echo "<option value=\"" . $month . "\">" . date("F", mktime(0,0,0, $month,1,0)) . "</option>\n";
echo "<option>---------</option>\n";
} else {
$checked2 = "selected=\"selected\"";
} 

$month2 = 1;
    	while ($month2 < 13)
    	{
            if ($month2 == date("m"))
            {
		echo "<option value=\"" . $month2 . "\" " . $checked2 . ">" . date("F", mktime(0,0,0, $month2,1,0)) . "</option>\n";
            } 
            else
            {
		echo "<option value=\"" . $month2 . "\">" . date("F", mktime(0,0,0, $month2,1,0)) . "</option>\n";
            } 
            $month2++;
    	} 
?>
</select>

<select name="profile[bday_year]" class="shoutbox">
<?php
if ($year != "") {
 echo "<option value=\"" . $year . "\">" . $year . "</option>\n";
 echo "<option>---------</option>\n";
	}  else {
 $checked3 = "selected=\"selected\"";
	} 

	$year2 = 1938;
	$lastyear = date("Y") + 1;

	while ($year2 < $lastyear)
	{
            if ($year2 == date("Y"))
            {
		echo "<option value=\"" . $year2 . "\" " . $checked3 . ">" . $year2 . "</option>\n";
            } 
            else
            {
		echo "<option value=\"" . $year2 . "\">" . $year2 . "</option>\n";
            } 
            $year2++;
	} 
?>
</select></td>
</tr>

<tr>
  <td valign="top">Location</td>
   <td><input type="text" name="profile[location]" value="<?php echo $p['location']; ?>" size="30" /></td>
</tr>
<tr>
  <td valign="top">Fav Band</td>
   <td><input type="text" name="profile[favband]" value="<?php echo $p['favband']; ?>" size="30" /></td>
</tr>

<tr>
<td colspan="2">Contact Information</td>
</tr>

<tr>
<td valign="top">Email</td>
 <td>
<input type="text" name="members[email]" value="<?php echo $r['email']; ?>" size="30" /></td>
</tr>

<tr>
  <td valign="top">Phone Number</td>
   <td><input type="text" name="profile[phone_number]" value="<?php echo $p['phone_number']; ?>" size="30" /></td>
  </tr>
<tr>
<td valign="top">MSN Messenger</td>
 <td>
<input type="text" name="profile[msn]" value="<?php echo $p['msn']; ?>" size="30" /></td>
</tr>

  <tr>
    <td valign="top">Yahoo Messenger</td>
     <td><input type="text" name="profile[yahoo]" value="<?php echo $p['yahoo']; ?>" size="30" /></td>
  </tr>
  <tr>
    <td valign="top">Bebo Username</td>
     <td><input type="text" name="profile[bebo]" value="<?php echo $p['bebo']; ?>" size="30" /></td>
  </tr>
  
  <tr> 
<td colspan="2">
<input type="hidden" name="action" value="doedit">
<input type="submit" class='button' value="Amend my profile" /></td>
</tr>
  </table>
</form>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>

<?php
}
?>