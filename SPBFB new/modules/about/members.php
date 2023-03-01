<style>
.myclassname .form{display:none;}
.updateo:hover, #savenow:hover {
cursor: pointer;
}
</style>

<div class="subtitle">
<?PHP
if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {

if (isset($_GET['delete'])) { 
$mysqli->query("DELETE FROM `members` WHERE `id` = '".$_GET['delete']."'");
$mysqli->query("DELETE FROM `profile` WHERE `mid` = '".$_GET['delete']."'");
//$mysqli->query("DELETE FROM `news` WHERE `id` = '".$_GET['delete']."';");
?>
<script>
window.location = "/about?InfoID=5";
</script>
<?php
}

if ($_POST['action'] == "doedit") {



foreach($_POST as $key => $value) {
if ($key == "action") { continue; }
$query = "UPDATE  `office` SET  `member_id` =  '".$value."' WHERE  `office`.`officeid` =".$key.";";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
}

}



echo '<div style="float: right;" class="myclassname">';
echo '<span class="updateo name">Update</span>';
echo '<div class="form" style="margin: 0; padding: 0;" id="savenow">';
echo 'Save';
echo '</div>';
echo '</div>';
}
}
?>

Office-Bearers</div>


<form method="post" name="post" id="officers" action="/about?InfoID=<?php echo $_GET['InfoID']; ?>">
<input type="hidden" name="action" value="doedit">

<table style="width: 100%; padding: 0; border: 0; margin: 3px;">

<?php
$officer_query = "SELECT `officeid`, `orderid`, `position`, `member_id`, (SELECT `realname` FROM `profile` WHERE `mid` = `office`.`member_id`) AS `real_name` FROM `office` WHERE `office`.`member_id` != 0 ORDER BY `orderid`";
$officer = $mysqli->query($officer_query) or die($mysqli->error.__LINE__);
while($o = $officer->fetch_assoc()) {

echo '<tr>';
echo '<td class="tablerow1"  style="width: 50%;">';
?>
<div class="myclassname">
   <span class="name"><?php echo $o['real_name']; ?></span>
   <div class="form">
    <select id="<?php echo $o['officeid']; ?>" name="<?php echo $o['officeid']; ?>">
	<?php
	$officer_query2 = "SELECT `realname`, `mid` FROM `profile` ORDER BY `mid`";
	$officer2 = $mysqli->query($officer_query2) or die($mysqli->error.__LINE__);
		while($o2 = $officer2->fetch_assoc()) {
			$selected = ($o2['mid'] == $o['member_id']) ? 'selected' : '';
				
			
	?>
				<option value="<?php echo $o2['mid']; ?>" <?php echo $selected; ?>><?php echo $o2['realname']; ?></option>
	<?php
		}
	?>
</select> 
   </div>
</div>
<?php

echo '</td>';
echo '<td class="tablerow1"  style="width: 50%;">';
echo $o['position'];
echo '</td>';
echo '</tr>';
}
?>

</table>

</form>
<?PHP
if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {
?>
<div style="float: right;"><a href="/about?action=addmember">Add Member</a></div>
<div style="clear: both;"></div>

<?php
}
}

$role_query = "SELECT * FROM `role` ORDER BY `displayID`";
$query = $mysqli->query($role_query) or die($mysqli->error.__LINE__);
while($r = $query->fetch_assoc()) {

$q2 = "SELECT
`profile`.`realname`,
`members`.`id`,
`members`.`rank2`,

(SELECT `displayorder` FROM `memberstatus` WHERE `statusid` = `members`.`rank2`) AS `display_order`,
(SELECT `statusname` FROM `memberstatus` WHERE `statusid` = `members`.`rank2`) AS `name`

FROM `members`, `profile` WHERE `members`.`section2` = '".$r['roleID']."' AND `members`.`id` = `profile`.`mid` 
ORDER BY `display_order` ASC;";

$query2 = $mysqli->query($q2) or die($mysqli->error.__LINE__);


?>
<div class="subtitle">
 <?php echo $r['name']; ?>
 <span style="float: right;">
 (<?php echo $query2->num_rows; ?>)
 </span>
</div>

<table style="width: 100%; padding: 0; border: 0; margin: 3px;">
<tr>

<?php
for($i = 0; $m = $query2->fetch_array(); ++$i) {
	if($i % 2 == 0 && $i != 0)  {
        echo "</tr><tr>";
    }
	
	if (strlen($m['name']) > 0 && $m['name'] != "Learner") {
	$format = '<span style="font-size: 16px;">'. $m['name'] . '</span><br>' . $m['realname'];
	}else
	if ($m['name'] == "Learner") {
	$format = $m['realname'] . ' - Learner';
	} else {
	$format = $m['realname'];
	}
?>

<td class="tablerow1"  style='width: 50%; vertical-align: middle;'>
<?php  
if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {
echo "<a href='/about?action=edit&memberID=".$m['id']."'><img src='images/edit.png' width='16' height='16'></a> ";
echo '<a href="/about?InfoID=5&delete='.$m['id'].'" onclick="return confirm(\'Are you sure want to delete?\');">';
echo "<img src='images/remove.png' width='16' height='16'></a> ";
} 
}

echo $format;
$format = '';
?>
</td>
<?php
}
?>
</tr>
</table>

<?php
}
?>