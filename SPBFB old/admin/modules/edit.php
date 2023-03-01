<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
system_error("Sorry, but the ID requested is not Numberic");
}

$q = "SELECT `ID`, `status`, `start_date`, `start_time`, `end_date`, `end_time`, `title`, `where`, `street`, `town`,
`info`, `poster`, `report` FROM `new_events` WHERE `ID` = '". mysql_real_escape_string($_GET['id']) ."'";

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
<td class='tablerow1'><strong>Event Title</strong></td>
<td class='tablerow1'><input type='text' name='title' size='30' class='textinput' style="width: 85%" value="<?php echo $r['title']; ?>"></td>
</tr>


<tr>
<td class='tablerow1'><strong>Location</strong></td>
<td class='tablerow1'><input type='text' name='location' size='30' class='textinput' style="width: 85%" value="<?php echo $_POST['location']; ?>"></td>
</tr>

<tr>
<td class='tablerow1'><strong>Start Date / Time</strong></td>
<td class='tablerow1'>
<select name="sday">
<?php
for ($day= 1; $day <= 32; $day++) {
$selected = ($day == date("j", $r['start_time'])) ? "selected" : '';
echo '<option value="'.$day.'" '.$selected.'>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
}
?>
</select>

<select name="smonth">

<?php
for ($month= 1; $month <= 12; $month++) {
$selected = ($month == date("m", $r['start_time'])) ? "selected" : '';
echo '<option value="'.$month.'" '.$selected.'>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>';
}
?>
</select>

<select name="syear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
$selected = ($year == date("Y", $r['start_time'])) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>

at <select name="shour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == date("G", $r['start_time'])) ? "selected" : '';
echo '<option value="'.$hour.'" '.$selected.'>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="sminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
$selected = ($minute == date("i", $r['start_time'])) ? "selected" : '';
echo '<option value="'.date("i", mktime(0,$minute,0)).'" '.$selected.'>'.date("i", mktime(0,$minute,0)).'</option>';
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
$selected = ( date("j", $r['end_time']) == $day) ? "selected" : '';
echo '<option value="'.$day.'" '.$selected.'>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>'."\n";
}
?>
</select>

<select name="emonth">

<?php
for ($month= 1; $month <= 12; $month++) {
$selected = ($month == date("m", $r['end_time'])) ? "selected" : '';
echo '<option value="'.$month.'" '.$selected.'>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>';
}
?>
</select>

<select name="eyear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
$selected = ($year == date("Y", $r['end_time'])) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>

at <select name="ehour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == date("g", $r['end_time'])) ? "selected" : '';
echo '<option value="'.$hour.'" '.$selected.'>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="eminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
$selected = ($minute == date("i", $r['end_time'])) ? "selected" : '';
echo '<option value="'.date("i", mktime(0,$minute,0)).'" '.$selected.'>'.date("i", mktime(0,$minute,0)).'</option>';
}
?>
</select>
</td>
</tr>
	
<tr>
<td class='tablerow1'><strong>Event Type</strong></td>
<td class='tablerow1'>
<select name="category">
<?php
$cat = mysql_query("SELECT * FROM `events_cat` ORDER BY id ASC");
while ($c = mysql_fetch_array($cat)) {
$selected = ($c['id'] == $r['category']) ? "selected" : '';
echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['title'].'</option>';
}
?>
</select>
</td>
</tr>	


  <tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Full Event Report</strong> - This will be displayed to the public.</td>
</tr>
  
  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Height = 500;
$oFCKeditor->Value = $_POST['FCKeditor1'] ;
$oFCKeditor->Create() ;
?>
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
