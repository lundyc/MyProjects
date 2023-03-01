<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (isset($_GET['id'])) {

if (isset($_POST['a']) && $_POST['a'] == "doedit") {

$shour = $_POST['shour'];
$sminute = $_POST['sminute'];
$sday = $_POST['sday'];
$smonth = $_POST['smonth'];
$syear = $_POST['syear'];

if (strlen($shour) < 2) {
$shour = "0". $shour;
}

$start_postdate = mktime($shour, $sminute, 0, $smonth, $sday, $syear);

$ehour = $_POST['ehour'];
$eminute = $_POST['eminute'];
$eday = $_POST['eday'];
$emonth = $_POST['emonth'];
$eyear = $_POST['eyear'];

$end_postdate = mktime($ehour, $eminute, 0, $emonth, $eday, $eyear);


$_SESSION['error'] = '';
$error = 0;
$status = 0;

// Check the Event Title
if (empty($_POST['title'])) {
$_SESSION['error'] .= "<li>Please enter a Event Title</li>\n";
$error = 1;
}

// Check the Event Location
if (empty($_POST['location'])) {
$_SESSION['error'] .= "<li>Please enter a Event Location</li>\n";
$error = 1;
}

if ((time() > $start_postdate) || (time() > $end_postdate)) {

if (empty($_POST['FCKeditor1'])) { 
$_SESSION['error'] .= "<li>Please enter a Event Report</li>\n";
$error = 1;
} 

$status = 1;

} else { 
$status = 0; 
}

if ($error == 0) {
$title = $_POST['title'];
$location = $_POST['location'];
$mainbody = $_POST['FCKeditor1'];
$category = $_POST['category'];

// Time to Update the Events Table :)
mysql_query("UPDATE `events` SET `status` = '$status', `title` = '$title', `location` = '$location', `category` = '$category', `start_time` = '$start_postdate', `end_time` = '$end_postdate' WHERE `id` = '".(int)$_GET['id']."' LIMIT 1;");

mysql_query("UPDATE `events_reports` SET `report` = '$mainbody' WHERE EventID = '".(int)$_GET['id']."'");


?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Thank you, this event has been edited.
 </p>
</div>
<br>

<?php
redirect("index.php?manager=parades", 3);

} else {
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Error Message</h2>
 <p>
There was a error with your form submission. Please check the following errors.<br>
 
 <ul style="margin: 0px 0px 0px 105px;">
 <?php echo $_SESSION['error']; ?>
 </ul>
 </p>
</div>
<br>

<?php
unset($_SESSION['error']);
$query = mysql_query("SELECT * FROM `events` WHERE id = '".(int)$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);
?>

<div class='tableborder'>
<div class='tableheaderalt'>Edit Parade Event</div>

<form method="post" name="edit" action="index.php?manager=parades&action=edit&id=<?php echo $r['id']; ?>">
<input type="hidden" name="a" value="doedit">

<table width='100%' cellpadding='4' cellspacing='0'>
<tr>
<td width='15%' class='tablerow1'><strong>ID</strong></td>
<td width='85%' class='tablerow1'><? echo $r['id']; ?></td>
</tr>
				
<tr>
<td class='tablerow1'><strong>Event Title</strong></td>
<td class='tablerow1'><input type='text' name='title' size='30' class='textinput' style="width: 85%" value="<?php echo $_POST['title']; ?>"></td>
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

<?php
}

} else {
?>

<?php
$query = mysql_query("SELECT * FROM `events` WHERE id = '".$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);
?>

<div class='tableborder'>
<div class='tableheaderalt'>Edit Parade Event</div>

<form method="post" name="edit" action="index.php?manager=parades&action=edit&id=<?php echo $r['id']; ?>">
<input type="hidden" name="a" value="doedit">

<table width='100%' cellpadding='4' cellspacing='0'>
<tr>
<td width='15%' class='tablerow1'><strong>ID</strong></td>
<td width='85%' class='tablerow1'><? echo $r['id']; ?></td>
</tr>
				
<tr>
<td class='tablerow1'><strong>Event Title</strong></td>
<td class='tablerow1'><input type='text' name='title' size='30' class='textinput' style="width: 85%" value="<?php echo $r['title']; ?>"></td>
</tr>


<tr>
<td class='tablerow1'><strong>Location</strong></td>
<td class='tablerow1'><input type='text' name='location' size='30' class='textinput' style="width: 85%" value="<?php echo $r['location']; ?>"></td>
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
for ($year= date("Y")-2; $year <= date("Y")+5; $year++) {
$selected = ($year == date("Y", $r['start_time'])) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>

at <select name="shour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == date("G", $r['start_time'])) ? "selected" : '';
echo "<option value=\"$hour\" $selected>".date("g a", mktime($hour,0,0))."</option>\n";
}
?>
</select>

&nbsp;
<select name="sminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
$selected = ($minute == date("i", $r['start_time'])) ? "selected" : '';
echo '<option value="'.date("i", mktime(0,$minute,0)).'" '.$selected.'>'.date("i", mktime(0,$minute,0))."</option>\n";
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
$selected = ($day == date("j", $r['end_time'])) ? "selected" : '';
echo '<option value="'.$day.'" '.$selected.'>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
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
for ($year= date("Y")-2; $year <= date("Y")+5; $year++) {
$selected = ($year == date("Y", $r['end_time'])) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>

at <select name="ehour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == date("G", $r['end_time'])) ? "selected" : '';
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
$po = mysql_fetch_array(mysql_query("SELECT `report` FROM `events_reports` WHERE EventID = '".$r['id']."'"));

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Height = 500;
$oFCKeditor->Value = $po['report'] ;
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

<?php
}

} else {
?>
We could not find the post you were looking for because the ID is not numeric. This has been logged and forwarded to a admin.
<?php
}
?>