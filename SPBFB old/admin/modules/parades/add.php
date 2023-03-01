<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (isset($_POST['a']) && $_POST['a'] == "doadd") {

// Start Date and Time
$shour = $_POST['shour'];
$sminute = $_POST['sminute'];
$sday = $_POST['sday'];
$smonth = $_POST['smonth'];
$syear = $_POST['syear'];

$start_postdate = mktime($shour, $sminute, 0, $smonth, $sday, $syear);

// End Date and Time
$ehour = $_POST['ehour'];
$eminute = $_POST['eminute'];
$eday = $_POST['eday'];
$emonth = $_POST['emonth'];
$eyear = $_POST['eyear'];

$end_postdate = mktime($ehour, $eminute, 0, $emonth, $eday, $eyear);


$_SESSION['error'] = '';
$error = 0;

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

if ($error == 0) {


// Time to Update the Events Table :)

mysql_query("INSERT INTO `events` (`status`,`title`,`location`,`category`,`start_time`,`end_time`) VALUES ('0', '".$_POST['title']."', '".$_POST['location']."', '".$_POST['category']."', '".$start_postdate."', '".$end_postdate."');");


if (strlen($_POST['FCKeditor1']) > 0) {
mysql_query("INSERT INTO `band_notes` (`EventID`,`UserID`,`Body`)VALUES ('".mysql_insert_id()."', '".$_SESSION['uid']."', '".$_POST['FCKeditor1']."');");
}

mysql_query("INSERT INTO `events_reports`(`EventID`) VALUES (NULL);");

?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Thank you, this event has been added.
 </p>
</div>
<br>

<?php
redirect("index.php?manager=parades", 5);

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
?>

<div class='tableborder'>
<div class='tableheaderalt'>Add Parade Event</div>

<form method="post" name="edit" action="index.php?manager=parades&action=add">
<input type="hidden" name="a" value="doadd">

<table width='100%' cellpadding='4' cellspacing='0'>
				
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
$selected = ($day == $_POST['sday']) ? "selected" : '';
echo '<option value="'.$day.'" '.$selected.'>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
}
?>
</select>

<select name="smonth">

<?php
for ($month= 1; $month <= 12; $month++) {
$selected = ($month == $_POST['smonth']) ? "selected" : '';
echo '<option value="'.$month.'" '.$selected.'>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>';
}
?>
</select>

<select name="syear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
$selected = ($year == $_POST['syear']) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>

at <select name="shour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == $_POST['shour']) ? "selected" : '';
echo '<option value="'.$hour.'" '.$selected.'>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="sminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
$selected = ($minute == $_POST['sminute']) ? "selected" : '';
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
$selected = ($day == $_POST['eday']) ? "selected" : '';
echo '<option value="'.$day.'" '.$selected.'>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
}
?>
</select>

<select name="emonth">

<?php
for ($month= 1; $month <= 12; $month++) {
$selected = ($month == $_POST['emonth']) ? "selected" : '';
echo '<option value="'.$month.'" '.$selected.'>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>';
}
?>
</select>

<select name="eyear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
$selected = ($year == $_POST['eyear']) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>

at <select name="ehour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == $_POST['ehour']) ? "selected" : '';
echo '<option value="'.$hour.'" '.$selected.'>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="eminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
$selected = ($minute == $_POST['eminute']) ? "selected" : '';
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
$selected = ($c['id'] == $_POST['category']) ? "selected" : '';

echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['title'].'</option>';
}
?>
</select>
</td>
</tr>	

  <tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Band Notes</strong> - This will on display to members of the band who are logged into the website.</td>
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

<div class='tableborder'>

<div class='tableheaderalt'>Add Parade Event</div>

<form method="post" name="edit" action="index.php?manager=parades&action=add">
<input type="hidden" name="a" value="doadd">

<table width='100%' cellpadding='4' cellspacing='0'>
			
<tr>
<td class='tablerow1'><strong>Event Title</strong></td>
<td class='tablerow1'><input type='text' name='title' size='30' class='textinput' style="width: 85%" value=""></td>
</tr>


<tr>
<td class='tablerow1'><strong>Location</strong></td>
<td class='tablerow1'><input type='text' name='location' size='30' class='textinput' style="width: 85%" value=""></td>
</tr>

<tr>
<td class='tablerow1'><strong>Start Date / Time</strong></td>
<td class='tablerow1'>
<select name="sday">
<?php
for ($day= 1; $day <= 32; $day++) {
$selected = ($day == date("d")) ? "selected" : '';
echo '<option value="'.$day.'" '.$selected.'>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
}
?>
</select>

<select name="smonth">

<?php
for ($month= 1; $month <= 12; $month++) {
$selected = ($month == date("m")) ? "selected" : '';
echo '<option value="'.$month.'" '.$selected.'>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>';
}
?>
</select>

<select name="syear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
$selected = ($year == date("Y")) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>

at <select name="shour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == date("G")) ? "selected" : '';
echo '<option value="'.$hour.'" '.$selected.'>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="sminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
$selected = ($minute == date("i")) ? "selected" : '';
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
$selected = ($day == date("d")) ? "selected" : '';
echo '<option value="'.$day.'" '.$selected.'>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
}
?>
</select>

<select name="emonth">

<?php
for ($month= 1; $month <= 12; $month++) {
$selected = ($month == date("m")) ? "selected" : '';
echo '<option value="'.$month.'" '.$selected.'>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>';
}
?>
</select>

<select name="eyear">
<?php
for ($year= date("Y"); $year <= date("Y")+5; $year++) {
$selected = ($year == date("Y")) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>

at <select name="ehour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == date("G")) ? "selected" : '';
echo '<option value="'.$hour.'" '.$selected.'>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>

&nbsp;
<select name="eminute">
<?php
for ($minute= 00; $minute <= 45; $minute+=15) {
$selected = ($minute == date("i")) ? "selected" : '';
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
echo '<option value="'.$c['id'].'">'.$c['title'].'</option>';
}
?>
</select>
</td>
</tr>	

  <tr>
<td colspan="2" valign="top" class='tablerow1'>
<strong>Band Notes</strong> - This will on display to the public and members on the website.</td>
</tr>
  
  <tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
<textarea id="FCKeditor1" name="FCKeditor1" style="width: 100%; height:75px;"></textarea>
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