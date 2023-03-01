<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
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

$insert = "INSERT INTO `new_events` (`poster`, `status`, `start_date`, `start_time`, `end_date`, `end_time`, `title`, `where`, `street`, `town`, `info`, `report`) VALUES ('".$_SESSION['uid']."', '".$_POST['status']."', '".$start_date."', '".$start_time."', '".$end_date."', '".$end_time."','".$_POST['title']."', '".$_POST['where']."','".$_POST['street']."', '".$_POST['town']."','".$_POST['info']."', '".$_POST['report']."' )";
mysql_query($insert);
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your information has been added.
 </p>
</div>
<br>

<?php
redirect("index.php?manager=events", 2);
}
?>
<div class='tableborder'>
<div class='tableheaderalt'>Add Event</div>

<form method="post" name="add" action="index.php?manager=events&action=add">
<input type="hidden" name="a" value="doadd">

<table width='100%' cellpadding='4' cellspacing='0'>
			
<tr>
<td class='tablerow1'><strong>Status</strong></td>
<td class='tablerow1'>
<input type='radio' name='status' value="Upcoming" checked="checked"> Upcoming - 
<input type='radio' name='status' value="Finished"> Finished
</td>
</tr>

<tr>
<td class='tablerow1'><strong>Event Title</strong></td>
<td class='tablerow1'><input type='text' name='title' size='30' class='textinput' style="width: 85%" value=""></td>
</tr>
		

<tr>
<td class='tablerow1'><strong>Start Date / Time</strong></td>
<td class='tablerow1'>
<select name="sday">
<?php
for ($day= 1; $day <= 32; $day++) {

echo '<option value="'.$day.'" ';
echo ($day == date("d")) ? "selected" : '';
echo '>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>'."\n";
}
?>
</select>

<select name="smonth">
<?php
for ($month= 1; $month <= 12; $month++) {

echo '<option value="'.$month.'" ';
echo ($month == date("m")) ? "selected" : '';
echo '>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>'."\n";
}
?>
</select>

<select name="syear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
echo '<option value="'.$year.'" ';
echo ($year == date("Y")) ? "selected" : '';
echo '>'.$year.'</option>'."\n";
}
?>
</select>

at <select name="shour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
echo '<option value="'.$hour.'" ';
echo '>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="sminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
echo '<option value="'.date("i", mktime(0,$minute,0)).'" ';
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
echo ($day == date("d")) ? "selected" : '';
echo '>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>'."\n";
}
?>
</select>

<select name="emonth">
<?php
for ($month= 1; $month <= 12; $month++) {

echo '<option value="'.$month.'" ';
echo ($month == date("m")) ? "selected" : '';
echo '>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>'."\n";
}
?>
</select>

<select name="eyear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
echo '<option value="'.$year.'" ';
echo ($year == date("Y")) ? "selected" : '';
echo '>'.$year.'</option>'."\n";
}
?>
</select>

at <select name="ehour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
echo '<option value="'.$hour.'" ';
echo '>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="eminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
echo '<option value="'.date("i", mktime(0,$minute,0)).'" ';
echo '>'.date("i", mktime(0,$minute,0)).'</option>';
}
?>
</select>
</td>
</tr>

<tr>
<td class='tablerow1'><strong>Where</strong></td>
<td class='tablerow1'><input type='text' name='where' size='30' class='textinput' style="width: 85%" value=""></td>
</tr>

<tr>
<td class='tablerow1'><strong>Street</strong></td>
<td class='tablerow1'><input type='text' name='street' size='30' class='textinput' style="width: 85%" value=""></td>
</tr>

	
<tr>
<td class='tablerow1'><strong>Town</strong></td>
<td class='tablerow1'><input type='text' name='town' size='30' class='textinput' style="width: 85%" value=""></td>
</tr>

  <tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Event Information</strong> - This will be displayed to the public.</td>
</tr>

  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<textarea name="info" rows='10' style="width: 100%"></textarea>
</td>
</tr>

  <tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Full Event Report</strong> - This will be displayed to the public.</td>
</tr>
  
  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<textarea name="report" rows='10' style="width: 100%">
</textarea>
</td>
</tr>

<tr>
<td align='center' class='tablesubheader' colspan='2' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'>
</td>
</tr>
</table>
</form>

</div>
