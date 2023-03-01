<?php
if (isset($_POST['a']) && $_POST['a'] == "doedit") {

$next = strtotime("next " . $_POST['day'] . " " . $_POST['hour'] . ":" . $_POST['minute']);

$q = mysql_query("SELECT `date` FROM `practices` WHERE `date` = '".date("Y-m-d", $next)."'");
if (mysql_num_rows($q) == 0) {
mysql_query("UPDATE `next_practice` SET `date` = '".$next."'");
mysql_query("INSERT INTO `practices` (`date` )VALUES ('".date("Y-m-d", $next)."');");

//$message = 'Band practice will start at <font size="3"><strong>7:00pm</strong></font> on '. date("l jS F Y", strtotime("next " . $_POST['day'])).'.<br /><br />Your attendance is necessary.';
//mysql_query("UPDATE `news` SET `MainBody` = '".$message."', `date` = '".date("Y-m-d")."' WHERE `id` = '13'");

?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
<br />
Thank you, the next practice will be on<br />
<span style="font-size:18px; font-weight:bold;">
<?php echo date("l jS M Y @ g:i a", strtotime("next " . $_POST['day'] . " " . $_POST['hour'] . ":" . $_POST['minute'])); ?>
</span>
</p>
</div>
<?php
redirect("index.php?manager=practice", 5);
} else {
?>
	<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
<br />
The next practice has already been updated.
</p>
</div>
<?php	
}
} else {
?>

<div class='tableborder'>
<div class='tableheaderalt'>Manage Next Practice</div>

<form method="post" name="edit" action="index.php?manager=practice">
<input type="hidden" name="a" value="doedit">

<table width='100%' cellpadding='4' cellspacing='0'>
<tr>
<td class='tablerow1' colspan="2">Please select the next day a practice is on, do not worrie if the practice is 1 day away. The script will automatically generate this.</td>
</tr>

<tr>
<td class='tablerow1'><strong>Date</strong></td>
<td class='tablerow1'>
<select name="day" style="padding: 6px;">
<?php
$d = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"); 
for ($day= 0; $day <= 6; $day++) {

if ($day == 3) { 
$selected = "selected";
} else {
unset($selected);
}


echo '<option value="'.$d[$day].'" '.$selected.'>'.$d[$day].'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
}
?>
</select>
</td>
</tr>
	
    
<tr>
<td class='tablerow1'><strong>Time</strong></td>
<td class='tablerow1'>
<select name="hour">
<?php
for ($hour= 17; $hour <= 20; $hour++) {
$selected = ($hour == 19) ? "selected" : '';
echo '<option value="'.$hour.'" '.$selected.'>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="minute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
$selected = ($minute == 00) ? "selected" : '';
echo '<option value="'.date("i", mktime(0,$minute,0)).'" '.$selected.'>'.date("i", mktime(0,$minute,0)).'</option>';
}
?>
</select>
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
<?php
}
?>