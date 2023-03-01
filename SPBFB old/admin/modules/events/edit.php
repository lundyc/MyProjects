<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
system_error("Sorry, but the ID requested is not Numberic");
}

if (isset($_POST['a'])) {

  foreach ($_POST as $key => $value) { 
    $_POST[$key] = mysql_real_escape_string(trim($value)); 
  } 
  
if (!empty($_POST['report'])) {
	$_POST['status'] = 'Finished';
}

$start_date = $_POST['syear'] . "-" . $_POST['smonth'] . "-" . $_POST['sday'];
$start_time = $_POST['shour'] . ":" . $_POST['sminute'] . ":00";
$end_date = $_POST['eyear'] . "-" . $_POST['emonth'] . "-" . $_POST['eday'];
$end_time = $_POST['ehour'] . ":" . $_POST['eminute'] . ":00";

$update = "UPDATE  `new_events` SET  
`status` =  '".$_POST['status']."',
`start_date` = '".$start_date."',
`start_time` = '".$start_time."', 
`end_date` = '".$end_date."',
`end_time` = '".$end_time."',
`title` = '".$_POST['title']."',
`where` = '".$_POST['where']."',
`street` = '".$_POST['street']."',
`town` = '".$_POST['town']."',
`info` =  '".$_POST['info']."',
`report` = '".$_POST['report']."',
`gallery_cat` = '".$_POST['gallery_cat']."'
WHERE  `new_events`.`ID` ='".mysql_real_escape_string($_GET['id'])."';";

mysql_query($update);
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your information has been edited.
 </p>
</div>
<br>

<?php
redirect("index.php?manager=events", 2);
}



$q = "SELECT 
`ID`, 
`status`, 
`start_date`, 
`start_time`, 
`end_date`, 
`end_time`, 
`title`, 
`where`, 
`street`, 
`town`,
`info`, 
`poster`, 
`report`,

DAY(`start_date`) as `start_day`,
MONTH(`start_date`) as `start_month`,
YEAR(`start_date`) as `start_year`,
HOUR(`start_time`) as `start_hour`,
MINUTE(`start_time`) as `start_minute`,

DAY(`end_date`) as `end_day`,
MONTH(`end_date`) as `end_month`,
YEAR(`end_date`) as `end_year`,
HOUR(`end_time`) as `end_hour`,
MINUTE(`end_time`) as `end_minute`,

`gallery_cat`
 
FROM `new_events` WHERE `ID` = '". mysql_real_escape_string($_GET['id']) ."'";

$query = mysql_query($q);

if (mysql_num_rows($query) == 0) {
system_error("We cannot find any posts ... are you sure you are not a hacker");
}

$r = mysql_fetch_assoc($query);

?>
<div class='tableborder'>
<div class='tableheaderalt'>Edit Event</div>

<form method="post" name="edit" action="index.php?manager=events&action=edit&id=<?php echo $r['ID']; ?>">
<input type="hidden" name="a" value="doedit">

<table width='100%' cellpadding='4' cellspacing='0'>
<tr>
<td width='15%' class='tablerow1'><strong>ID</strong></td>
<td width='85%' class='tablerow1'><?php echo $r['ID']; ?></td>
</tr>
				
<tr>
<td class='tablerow1'><strong>Status</strong></td>
<td class='tablerow1'>
<input type='radio' name='status' value="Upcoming" <?php echo ($r['status'] == "Upcoming") ? 'checked="checked" ' : ''; ?>> Upcoming - 
<input type='radio' name='status' value="Finished" <?php echo ($r['status'] == "Finished") ? 'checked="checked" ' : ''; ?>> Finished
</td>
</tr>

<tr>
<td class='tablerow1'><strong>Event Title</strong></td>
<td class='tablerow1'><input type='text' name='title' size='30' class='textinput' style="width: 85%" value="<?php echo $r['title']; ?>"></td>
</tr>
		

<tr>
<td class='tablerow1'><strong>Start Date / Time</strong></td>
<td class='tablerow1'>
<select name="sday">
<?php
for ($day= 1; $day <= 32; $day++) {

echo '<option value="'.$day.'" ';
echo ($day == $r['start_day']) ? "selected" : '';
echo '>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>'."\n";
}
?>
</select>

<select name="smonth">
<?php
for ($month= 1; $month <= 12; $month++) {

echo '<option value="'.$month.'" ';
echo ($month == $r['start_month']) ? "selected" : '';
echo '>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>'."\n";
}
?>
</select>

<select name="syear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
echo '<option value="'.$year.'" ';
echo ($year == $r['start_year']) ? "selected" : '';
echo '>'.$year.'</option>'."\n";
}
?>
</select>

at <select name="shour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
echo '<option value="'.$hour.'" ';
echo ($hour == $r['start_hour']) ? "selected" : '';
echo '>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="sminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
echo '<option value="'.date("i", mktime(0,$minute,0)).'" ';
echo ($minute == $r['start_minute']) ? "selected" : '';
echo '>'.date("i", mktime(0,$minute,0)).'</option>';
}
?>
</select>
</td>
</tr>

<tr>
<td class='tablerow1'><strong>End Date / Time</strong></td>
<td class='tablerow1'>
<select name="eday">
<?php
for ($day= 1; $day <= 32; $day++) {

echo '<option value="'.$day.'" ';
echo ($day == $r['end_day']) ? "selected" : '';
echo '>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>'."\n";
}
?>
</select>

<select name="emonth">
<?php
for ($month= 1; $month <= 12; $month++) {

echo '<option value="'.$month.'" ';
echo ($month == $r['end_month']) ? "selected" : '';
echo '>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>'."\n";
}
?>
</select>

<select name="eyear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
echo '<option value="'.$year.'" ';
echo ($year == $r['end_year']) ? "selected" : '';
echo '>'.$year.'</option>'."\n";
}
?>
</select>

at <select name="ehour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
echo '<option value="'.$hour.'" ';
echo ($hour == $r['end_hour']) ? "selected" : '';
echo '>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="eminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
echo '<option value="'.date("i", mktime(0,$minute,0)).'" ';
echo ($minute == $r['end_minute']) ? "selected" : '';
echo '>'.date("i", mktime(0,$minute,0)).'</option>';
}
?>
</select>
</td>
</tr>

<tr>
<td class='tablerow1'><strong>Where</strong></td>
<td class='tablerow1'><input type='text' name='where' size='30' class='textinput' style="width: 85%" value="<?php echo $r['where']; ?>"></td>
</tr>

<tr>
<td class='tablerow1'><strong>Street</strong></td>
<td class='tablerow1'><input type='text' name='street' size='30' class='textinput' style="width: 85%" value="<?php echo $r['street']; ?>"></td>
</tr>

	
<tr>
<td class='tablerow1'><strong>Town</strong></td>
<td class='tablerow1'><input type='text' name='town' size='30' class='textinput' style="width: 85%" value="<?php echo $r['town']; ?>"></td>
</tr>

  <tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Event Information</strong> - This will be displayed to the public.</td>
</tr>

  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<textarea name="info" rows='10' style="width: 100%">
<?php echo stripslashes($r['info']); ?>
</textarea>
</td>
</tr>

  <tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Full Event Report</strong> - This will be displayed to the public.</td>
</tr>
  
  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<textarea name="report" rows='10' style="width: 100%">
<?php echo stripslashes($r['report']); ?>
</textarea>
</td>
</tr>

<tr>
<td class='tablerow1'><strong>Gallery Category</strong></td>
<td class='tablerow1'>
<select name="gallery_cat">

<?php
echo '<option value="0" ';
echo ($r['gallery_cat'] == 0) ? "selected" : '';
echo '>No Album set</option>'."\n";

$gal_query = mysql_query("SELECT `cid`, `title`	 FROM `gallery_categories` ORDER BY `added` DESC");
while ($gal = mysql_fetch_array($gal_query)) { 

echo '<option value="'.$gal['cid'].'" ';
echo ($r['gallery_cat'] == $gal['cid']) ? "selected" : '';
echo '>'.$gal['title'].'</option>'."\n";
}
?>
</select>
</td>
</tr>

<tr>
<td class='tablerow1'><strong>Video Category</strong></td>
<td class='tablerow1'>..............</td>
</tr>


<tr>
<td align='center' class='tablesubheader' colspan='2' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'>
</td>
</tr>
</table>
</form>

</div>
