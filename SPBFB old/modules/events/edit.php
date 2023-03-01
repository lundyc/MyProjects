<?php
$check = 0;
$show_forn = 1;

$query = mysql_query("SELECT * FROM `events` WHERE id = '".$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);
?>

<style>
form fieldset{
	margin:20px 0px 20px 0px;
	position:relative;
	display:block;
	/* [disabled]padding: 0px 10px 10px 10px; */
}

form fieldset legend{	
	
	color: #000000;
	font-weight:bold;
	font-variant:small-caps;
	font-size:110%;
		
	padding:2px 5px;
	margin:0px 0px 5px 0px;
	position:relative;
	top: -12px;
	
}
</style>

<div class="module">
	<div class="tb">
		<div>
			<div>
			</div>
		</div>
	</div>
	<div class="mb2">
		<h2 class="about">Edit Event</h2>
<?php
if ($_POST['action'] == "doeditevent") {

if (empty($_POST['title'])) {
	$check = 1;
	$title_error = "Please enter a title";
}

if (empty($_POST['location'])) {
	$check = 1;
	$location_error = "Please enter a Location";
}

// for reports, if the Posted Date is after the current date then they must enter a report ... 
$current_date = time();


$shour = $_POST['shour'];
$sminute = $_POST['sminute'];
$sday = $_POST['sday'];
$smonth = $_POST['smonth'];
$syear = $_POST['syear'];

if (strlen($shour) < 2) {
$shour = "0". $shour;
}

$posted_start_format = mktime($shour, $sminute, 0, $smonth, $sday, $syear);

$ehour = $_POST['ehour'];
$eminute = $_POST['eminute'];
$eday = $_POST['eday'];
$emonth = $_POST['emonth'];
$eyear = $_POST['eyear'];

$posted_end_format = mktime($ehour, $eminute, 0, $emonth, $eday, $eyear);

if ($posted_end_format < $current_date) {
	if (empty($_POST['editor1'])) {
	$check = 1;
	$editor1_error = "Please enter a report";
	}
}


if ($check == 0) { 
$show_forn = 0;

mysql_query("UPDATE `events` SET  `title` = '".$_POST['title']."', `location` = '".$_POST['location']."', `category` = '".$_POST['category']."', `start_time` = '$posted_start_format', `end_time` = '$posted_ed_format' WHERE `id` = '".(int)$_GET['id']."' LIMIT 1;");

if ($posted_end_format < $current_date) {
	if (!empty($_POST['editor1'])) {
mysql_query("UPDATE `events_reports` SET `report` = '".$_POST['editor1']."' WHERE EventID = '".(int)$_GET['id']."'");
	}
}



echo "done";
}

}


/*
if (empty($_POST['editor1'])) {
	$check = 1;
	$editor1_error = "please enter some news";
}

if ($check == 0) {
	$show_forn = 0;
	mysql_query("UPDATE `news` SET `date` = NOW( ), `title` = '".$_POST['title']."', `MainBody` = '".$_POST['editor1']."' WHERE `id` =".(int)$_GET['NewsID']." LIMIT 1");
	
	echo "<p>This news item has been updated.</p>";
	redirect("index.php?view=news&action=admin", 5);
	
	
	
}
*/


		
if ($show_forn == 1) {
?>		
<form method="post" name="post" action="?view=events&action=edit&id=<?php echo $_GET['id']; ?>">
<input type="hidden" name="action" value="doeditevent">
			
<fieldset>
	<legend>Details</legend>
	
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td width="20%">
				<strong>
					Event ID:
				</strong>
			</td>
			<td width="80%" align="right">
				<? echo $r['id']; ?>
			</td>
		</tr>	
        
        <tr>
			<td width="20%">
				<strong>
					Statu:
				</strong>
			</td>
			<td width="80%" align="right">
				<? echo $r['status']; ?>
			</td>
		</tr>
		
		<tr>	
			<td>	
				<strong>
					Title:
				</strong> 
			</td>
			
			<td>
				<input name="title" id="title" type="text" value="<?php echo $r['title']; ?>" style="width: 90%; float: right;">
<?php
if ($check == 1 && isset($title_error)) {
	echo '<br>';
	echo $title_error;
}
?>
			</td>
		</tr>
	
		<tr>
			<td>
				<strong>
						Location:
				</strong>		
			</td>
			
			<td>
				<input name="location" id="location" type="text" value="<?php echo $r['location']; ?>" style="width: 90%; float: right;">
				<?php
if ($check == 1 && isset($location_error)) {
	echo '<br>';
	echo $location_error;
}
?>
			</td>
		</tr>	
	
		<tr>
			<td>
				<strong>
						Type:
				</strong>
			</td>
		
			<td>
				<select name="category" style="width: 100%; float: right">
					<?php
						$cat = mysql_query("SELECT * FROM `events_cat` ORDER BY id ASC");
							while ($c = mysql_fetch_array($cat)) {
								$selected = ($c['id'] == $r['category']) ? "selected" : '';
								
								echo '<option value="';
								echo $c['id'];
								echo '"';
								echo $selected;
								echo '>';
								echo $c['title'];
								echo '</option>';
							}
					?>
				</select>
			</td>
		
		</tr>		
	</table>

</fieldset>

<fieldset>
	<legend>Date / Time</legend>

<table width="100%" cellpadding="0" cellspacing="1">

<tr>
<td>
<strong>
Start
</strong>
</td>

<td>

<select name="sday">
<?php
for ($day= 1; $day <= 32; $day++) {
$selected = ($day == date("j", $r['start_time'])) ? "selected" : '';
echo '<option value="'.$day.'" '.$selected.'>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
}
?>
</select>
</td>

<td>
 <select name="smonth">

<?php
for ($month= 1; $month <= 12; $month++) {
$selected = ($month == date("m", $r['start_time'])) ? "selected" : '';
echo '<option value="'.$month.'" '.$selected.'>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>';
}
?>
</select>
</td>

<td>
 <select name="syear">
<?php
for ($year= date("Y")-2; $year <= date("Y")+5; $year++) {
$selected = ($year == date("Y", $r['start_time'])) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>
</td>

<td>
at
</td>

<td>
<select name="shour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == date("G", $r['start_time'])) ? "selected" : '';
echo "<option value=\"$hour\" $selected>".date("g a", mktime($hour,0,0))."</option>\n";
}
?>
</select>
</td>

<td>
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

<td>
	<strong>
	End:
	</strong>
</td>

<td>	
<select name="eday">
<?php
for ($day= 1; $day <= 32; $day++) {
$selected = ($day == date("j", $r['end_time'])) ? "selected" : '';
echo '<option value="'.$day.'" '.$selected.'>'.$day.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
}
?>
</select>
</td>

<td>
 <select name="emonth">

<?php
for ($month= 1; $month <= 12; $month++) {
$selected = ($month == date("m", $r['end_time'])) ? "selected" : '';
echo '<option value="'.$month.'" '.$selected.'>'.date("F", mktime(0,0,0, $month, 1,0)).'</option>';
}
?>
</select>
</td>

<td>
 <select name="eyear">
<?php
for ($year= date("Y")-2; $year <= date("Y")+5; $year++) {
$selected = ($year == date("Y", $r['end_time'])) ? "selected" : '';
echo '<option value="'.$year.'" '.$selected.'>'.$year.'</option>';
}
?>
</select>
</td>

<td>
 at
 </td>
 
<td> <select name="ehour">
<?php
for ($hour= 1; $hour <= 24; $hour++) {
$selected = ($hour == date("G", $r['end_time'])) ? "selected" : '';
echo '<option value="'.$hour.'" '.$selected.'>'.date("g a", mktime($hour,0,0)).'</option>';
}
?>
</select>
</td>

<td>
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
</table>


			</fieldset> 

<?php
$po = mysql_fetch_array(mysql_query("SELECT `report` FROM `events_reports` WHERE EventID = '".$r['id']."'"));
$initialValue = $po['report'];

include("ckeditor/ckeditor.php");
include("ckeditor/spb_setup.php");


echo $code;

if ($check == 1 && isset($editor1_error)) {
	echo '<br>';
	echo $editor1_error;
}
?>
  			<div align="center">
				<input type="submit" name="submit" value="Save Changes" accesskey="s">
			</div>
		</form>
<?php
}
?>
	</div>
	<div class="bb">
		<div>
			<div>
			</div>
		</div>
	</div>
</div>