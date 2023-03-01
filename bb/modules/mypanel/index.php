<?php
if (!$_SESSION['uid']) {
die(redirect("index.php",0));
}

$q = "SELECT 
`members`.`id`,
`members`.`email`, 
`members`.`level`, 
`members`.`password`,

`profile`.`realname`,
`profile`.`picture`,
`profile`.`location`,
`profile`.`bday_day`,
`profile`.`bday_month`,
`profile`.`bday_year`,

(SELECT `name` FROM `role` WHERE `roleID` = `members`.`section1`) AS `office_name`,
(SELECT `name` FROM `role` WHERE `roleID` = `members`.`section2`) AS `play_name`,
(SELECT `statusname` FROM `memberstatus` WHERE `statusid` = `members`.`rank1`) AS `ranker1`,
(SELECT `statusname` FROM `memberstatus` WHERE `statusid` = `members`.`rank2`) AS `ranker2` 

FROM `members`, `profile` WHERE `members`.`id` = '{$_SESSION['uid']}' AND `profile`.`mid` = '{$_SESSION['uid']}'";

$query = mysql_query($q);
$r = mysql_fetch_array($query);

$picture = ((strlen($r['picture']) > 0) || (!file_exists("uploads/profiles/" . $r['picture']))) ? "uploads/profiles/" . $r['picture'] : "uploads/profiles/default.jpg";
list($width, $height) = getimagesize($picture);

$width = 180;
$height = 180;

if (($r['bday_year'] != 0) && ($r['bday_month'] != 0) && ($r['bday_day'] != 0)) {

$birthstamp = mktime(0,0, 0, $r['bday_month'], $r['bday_day'], $r['bday_year']); 
$diff = time() - $birthstamp; 
$age_years = floor($diff / 31556926); 

} else {
$age_years = "No Data";
}

$na = explode(' ', $r['realname']);
$email = strtolower($na['0']) ."@". strtolower($na['1']).".com";

if ($r['email'] == $email) {
 ?>
<div class="errorwrap" style='margin-bottom:0px;padding-bottom:0px'>
<h4>Attention!</h4>
<p>
You need to update you e-mail. Please do this now !!
</p>

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

</div> 
<br />
<?php
}

////////////////////////////////////////////////////
/////////////////////////////////////////
if ($r['password'] == md5("changeme")) {
 ?>
<div class="errorwrap" style='margin-bottom:0px;padding-bottom:0px'>
<h4>Attention!</h4>
<p>
Your password is still set as the default password, this is a major security risk.<br />
Please change your password now. 
</p>

<form method="post" action="./?view=changepassword">
<input type="hidden" name="action" value="changepassword" />

<table width="100%" border="0" align="center" cellspacing="5" cellpadding="0">

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
<td colspan="2" align="center">
<input type="submit" class='button' value="Change my password" /></td>
</tr>
 
</table>

</form>

</div> 
<br />
<?php
}

/*
?>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Personal Information </h2>
<table width='100%' cellspacing='2' cellpadding='2'>
<tr>
<td width="23%" rowspan="4" align="center" valign="middle">
<img src="<?php echo $picture; ?>" width="90" height="90" border="0" style="border: 1px solid black;" /></td>
<td width="25%"><strong>Real Name</strong></td>
 <td width="53%">
 <?php echo (empty($r['realname'])) ? "unknown" : $r['realname']; ?> </td>
</tr>

<tr>
      <td><strong>Email address</strong></td>
      <td><?php echo $r['email']; ?></td>
    </tr>
    <tr>
      <td><strong>Age</strong></td>
      <td><?php echo $age_years; ?></td>
    </tr>
    <tr>
      <td><strong>Location</strong></td>
      <td><?php echo (strlen($r['location']) > 0) ? ucfirst($r['location']) : "No Data"; ?></td>
    </tr>
</table>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>More Information</h2>

<table width='100%' cellspacing='2' cellpadding='2'>
  <tr>
    <td width="50%" valign="top">Admin Group</td>
        <td>
<?php 
  $levels = array("", "Band Member", "Band Committee", "Administrator", "Root Admin", "Webmaster");
  echo $levels[$r['level']]; 
?>
        </td>
  </tr>
 
  <?php
  if (strlen($r['office_name']) > 0) {
  ?> 
  <tr>
    <td valign="top">Office Bearer</td>
          <td>
      <?php echo $r['office_name'] . " (" . $r['ranker1'] . ")"; ?>    
          </td>
  </tr>
  <?php
  }
  ?>
  
   <tr>
    <td valign="top">Playing Posistion</td>
   <td>
   <?php 
   echo $r['play_name']; 
   echo (empty($r['ranker2'])) ? '' : " (". $r['ranker2'] . ")";
   ?>
   </td>
  </tr>    
</table>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>


*/
?>
 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Attendance Report</h2>
<table width='100%' cellspacing='2' cellpadding='2' id='common_actions'>
<tr>
<td align="center" valign="top">Attended</td>
<td align="center" valign="top">Absent</td>
<td align="center" valign="top">Apology</td>
</tr>  

<tr>
<td align="center" valign="top">
<?php 
$yes = mysql_query("SELECT * FROM `attendance` WHERE `UserID` = '{$_SESSION['uid']}' AND `attended` = 'Yes'");
echo mysql_num_rows($yes);
?>
</td>
<td align="center" valign="top">
<?php 
$no = mysql_query("SELECT * FROM `attendance` WHERE `UserID` = '{$_SESSION['uid']}' AND `attended` = 'No'");
echo mysql_num_rows($no);
?>
</td>
<td align="center" valign="top">
<?php 
$apology = mysql_query("SELECT * FROM `attendance` WHERE `UserID` = '{$_SESSION['uid']}' AND `attended` = 'Apology'");
echo mysql_num_rows($apology);
?>
</td>
</tr>   

<tr>
<td colspan="3" align="right" valign="top">
<a HREF="javascript:void(0)" onclick="NewWindow('attendance.php', 'attendance','810','600','Yes')">
full report
</a>
</td>
</tr>  
</table>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Notice Board</h2>
<?php
$q = "SELECT * FROM `notice_board` WHERE `UserID` = '0' OR `UserID` = '". $_SESSION['uid']."'";
$query = mysql_query($q);

if (mysql_num_rows($query) == 0) {
echo "<center>no notices</center>";
}


while ($note = mysql_fetch_array($query)) {
$name = ($note['UserID'] == 0) ? 'Note to Everyone: ' : "Note From: " . IDtoName($note['UserID']);
echo $name . $note['Message'];
echo "<br>";


}
?>


  </div>
  <div class="bb"><div><div></div></div></div>
</div>