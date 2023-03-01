<?php
if (isset($_GET['id'])) {

$q = "SELECT 
`profile`.`mid`, 
`profile`.`realname`, 
`profile`.`nickname`,
`profile`.`picture`, 
`profile`.`location`, 
`profile`.`msn`, 
`profile`.`yahoo`, 
`profile`.`bebo`, 
`profile`.`bday_day`, 
`profile`.`bday_month`, 
`profile`.`bday_year`, 
`profile`.`phone_number`, 
`profile`.`favband`, 

`members`.`id`, 
`members`.`username`, 
`members`.`email`, 
`members`.`joined`, 
`members`.`last_logged`, 
`members`.`level`, 

(SELECT `position` FROM `office` WHERE `office`.`member_id` = `members`.`id`) AS `office_name`,
(SELECT `name` FROM `role` WHERE `roleID` = `members`.`section2`) AS `play_name`,
(SELECT `statusname` FROM `memberstatus` WHERE `statusid` = `members`.`rank1`) AS `ranker1`,
(SELECT `statusname` FROM `memberstatus` WHERE `statusid` = `members`.`rank2`) AS `ranker2` 

FROM `profile`, `members` 
WHERE `members`.`id` = '{$_GET['id']}' AND `profile`.`mid` = '{$_GET['id']}' LIMIT 1;";
$query = mysql_query($q);

    if (empty($query)) {
        trigger_error('MySQL ERROR ('.mysql_errno().'): "<br />'.
            mysql_error().'"<br /><br />Query: "' . $q . '".<br />',
            E_USER_ERROR);
    }

$r = mysql_fetch_array($query);

if (!$r) {
die("This user isnt here");
}

$picture = (strlen($r['picture']) > 0) ? "../uploads/profiles/". $r['picture'] : "../uploads/profiles/default.jpg";


if (($r['bday_year'] != 0) && ($r['bday_month'] != 0) && ($r['bday_day'] != 0)) {
$age = date("Y") - $r['bday_year']; 
if(($r['bday_month'] > date("m")) || ($r['bday_month'] == date("m") && date("d") < $r['bday_day']))  { 
$age -= 1; 
} 

$dob = $r['bday_day'] . "/" .  $r['bday_month'] . "/" . $r['bday_year'] . " (" . $age . ")";

} else {
$dob = "No Data";
}


?> 
 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Members Profile</h2>


<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td width='1%' class='tablerow1'>
<div style='border:1px solid #000;background:#FFF;width:147px; padding:3px'>
<img src="<?php echo $picture; ?>" width='147' height='147' />
</div>
</td>
<td>


<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
  <td class='tablerow1'>Username</td>
  <td class='tablerow2'><?php echo $r['username']; ?></td>
</tr>
<tr>
<td width='40%' class='tablerow1'>Real Name</td>
<td width='60%' class='tablerow2'><?php echo $r['realname']; ?></td>
</tr>
<tr>
  <td width='40%' class='tablerow1'>Location</td>
  <td width='60%' class='tablerow2'><?php echo (empty($r['location'])) ? "No Data" : $r['location']; ?></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Date of Birth</td>
<td width='60%' class='tablerow2'><?php echo $dob; ?></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Favourite Band</td>
<td width='60%' class='tablerow2'><?php echo $r['favband']; ?></td>
</tr>
</table>

</td>
</tr>
</table>
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td colspan="2" class='tablerow1'><strong>Band Information</strong>  </td>
</tr>

<?php
if (strlen($r['office_name']) > 0) {
?>

<tr>
  <td width="40%" class='tablerow1'>Office-Bearer</td>
  <td width="60%" class='tablerow2'><?php echo $r['office_name']; ?></td>
</tr>
<?php
}
if (strlen($r['play_name']) > 0) {
?>

<tr>
  <td class='tablerow1'>Playing Posistion</td>
  <td class='tablerow2'>
  <?php 
  echo $r['play_name'];

  echo (!empty($r['ranker2'])) ? " (". $r['ranker2'] . ")" : ''; 
  ?></td>
</tr>
<?php
}
?>
</table>


<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td colspan="2" class='tablerow1'><strong>Contact Information</strong></td>
</tr>

<tr>
  <td class='tablerow1'>E-Mail</td>
  <td class='tablerow2'><?php echo $r['email']; ?></td>
</tr>
<tr>
<td width='40%' class='tablerow1'>
Phone Number</td>
<td width='60%' class='tablerow2'><?php echo (!empty($r['phone_number'])) ? $r['phone_number'] : "No Data"; ?></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>MSN Messenger</td>
<td width='60%' class='tablerow2'><?php echo (!empty($r['msn'])) ? $r['msn'] : "No Data"; ?></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Yahoo Messenger</td>
<td width='60%' class='tablerow2'><?php echo (!empty($r['yahoo'])) ? $r['yahoo'] : "No Data"; ?></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Bebo Username</td>
<td width='60%' class='tablerow2'><?php echo (!empty($r['bebo'])) ? $r['bebo'] : "No Data"; ?></td>
</tr>
</table>

<?php
/*
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td colspan="2" class='tablerow1'><strong>Attendance History</strong></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Attended</td>
<td width='60%' class='tablerow2'>
<?php 
$q = mysql_query("SELECT COUNT(*) FROM `attendance` WHERE `UserID` = '{$_GET['id']}' AND `attended` = 'Yes'");
$t = mysql_fetch_array($q);
echo $t[0];
?>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Not Attended</td>
<td width='60%' class='tablerow2'>
<?php 
$q2 = mysql_query("SELECT COUNT(*) FROM `attendance` WHERE `UserID` = '{$_GET['id']}' AND `attended` = 'No'");
$t2 = mysql_fetch_array($q2);
echo $t2[0];
?>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Not Attended with Appolgy</td>
<td width='60%' class='tablerow2'>
<?php 
$q3 = mysql_query("SELECT COUNT(*) FROM `attendance` WHERE `UserID` = '{$_GET['id']}' AND `attended` = 'Apology'");
$t3 = mysql_fetch_array($q3);
echo $t3[0];
?>
</td>
</tr>
</table>
*/
?>

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td colspan="2" class='tablerow1'><strong>Site Activity</strong></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>
Last Login</td>
<td width='60%' class='tablerow2'>
<?php 
if(!$r['last_logged']) {
echo "--";
} else {
$dateformat = date("d-m-y", $r['last_logged']);

if ($dateformat == date("d-m-y")) {
$date1 = "Today, ". date("g:i A", $r['last_logged']); 
} elseif ($dateformat == date("d-m-y", strtotime("-1 day"))) {
$date1 = "Yesterday, ". date("g:i A", $r['last_logged']); 
} else {
$date1 = date("d M @ h:i A", $r['last_logged']);
}
echo $date1;
} 
?></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Last Active</td>
<td width='60%' class='tablerow2'>
<?php 
$active = mysql_query("SELECT * FROM `online_users` WHERE `UserID` = '".$r['mid']."'");
$ac = mysql_fetch_array($active);

if(!$ac) {
echo "--";
} else {
$dateformat = date("d-m-y", $ac['time']);

if ($dateformat == date("d-m-y")) {
$date = "Today, ". date("g:i A", $ac['time']); 
} elseif ($dateformat == date("d-m-y", strtotime("-1 day"))) {
$date = "Yesterday, ". date("g:i A", $ac['time']); 
} else {
$date = date("d M @ h:i A", $ac['time']);
}
echo $date;
}
?>
</td>
</tr>
</table>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<?php
} else {
?>
We could not find the post you were looking for because the ID is not numeric. This has been logged and forwarded to a admin.
<?php
}
?>