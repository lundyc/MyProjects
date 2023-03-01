<?php
session_start();

if (!isset($_SESSION['userID'])) {
	header("location: login.php");
}

/////////////////////////////////////////

$link = mysqli_connect("localhost","lundy_subway","e039288466","lundy_subway") or die("Error " . mysqli_error($link));

$admin_query = "SELECT `admin` FROM  `staff` WHERE `StaffID` = '".$_SESSION['userID']."';";
$admin = $link->query($admin_query);
$adminr = mysqli_fetch_array($admin, MYSQLI_ASSOC);

if (isset($_GET['date'])) {
$query = "WHERE `start_date` = '".$_GET['date']."'";
} else { 
$query = '';
}

$week = "SELECT 
DATE_FORMAT(`start_date`, '%d/%m/%Y') as `startD`,
DATE_FORMAT(`end_date`, '%d/%m/%Y') as `endD`,
`start_date`, `end_date` 
FROM  `weeks` 
".$query."
ORDER BY  `weeks`.`WeekID` DESC 
LIMIT 1";

$weeq = $link->query($week);
$weer = mysqli_fetch_array($weeq, MYSQLI_ASSOC);

$bgcolor = "#D4E178";

$query = "SELECT `StaffID`, `Name` FROM `staff` ORDER BY `StaffID`" or die("Error in the consult.." . mysqli_error($link));
$result = $link->query($query);

if (!isset($weer['start_date'])) {
$weer['start_date'] = date("Y-m-d", strtotime("last Wednesday"));
}

$prev_link = date("Y-m-d", strtotime($weer['start_date']. " -7 days"));
$next_link = date("Y-m-d", strtotime($weer['start_date'] . " +7 days"));

$prev_week_q = "SELECT start_date as `rows` FROM `weeks` WHERE `start_date` = '".$prev_link."'";
$prev_week = $link->query($prev_week_q);
 $prow_cnt = $prev_week->num_rows;
 

$next_week_q = "SELECT start_date as `rows` FROM `weeks` WHERE `start_date` = '".$next_link."'";
$next_week = $link->query($next_week_q);
 $row_cnt = $next_week->num_rows;
 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<?php
if ($adminr['admin'] > 0) {
?>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="myscripts.js"></script>
<?php
}
?>

<link rel="stylesheet" href="css/main.css?v=1">
<link rel="stylesheet" href="css/print.css?v=1">

<title>Staff Portal - ROTA</title>
</head>

<body>
<div id="nav">
<ul>
<li><a href="/index.php">Home</a></li>
<li><a href="/holidays.php">Holidays</a></li>
<?php
if ($adminr['admin'] > 0) {
?>
<li><a id="print" href="#print">Print Rota</a></li>
<?php
}
?>
<li style="float: right;"><a href="/logout.php">Logout</a></li>
</ul>
</div>
   
<div id="weekDate">
<?php
if ($prow_cnt > 0) {
echo '<a href="'. $_SERVER["PHP_SELF"] . '?date='. $prev_link .'"><img src="arrow_large_left.png"></a>';
}
echo " " . $weer['startD'] . " - " . $weer['endD'] . " ";

if ($row_cnt > 0) {
echo '<a href="'. $_SERVER["PHP_SELF"] . '?date='. $next_link .'" ><img src="arrow_large_right.png"></a>';
}
?>
</div>

<table>
<tr>
<th style="border-left: 0"></th>
<?php
$days = array();
for ($x = 0; $x < 7; $x++) {
	echo '<th>';
	echo strtoupper(date('l', strtotime("+$x days", strtotime($weer['start_date']))));
	echo '</th>';
}
?>
</tr>

<?php
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
$bgcolor = ($bgcolor == "bg1") ? 'bg2' : 'bg1';
?>

<tr>
<td class="<?php echo $bgcolor; ?>" style="font-weight: bold;">
<?php 
$name = explode(" ", $row['Name']);
echo $name['0'] . "<br>" . $name['1'];
?>
</td>

<?php
$days = array();
for ($x = 0; $x < 7; $x++) {
echo '<td class="'.$bgcolor.'" align="center">';

$query_start_Date = date("Y-m-d", strtotime("+$x days", strtotime($weer['start_date'])));

$query2 = "SELECT 
count(`RotaID`) as `num`, 
LOWER(DATE_FORMAT(`start_time`, '%l')) as `stime`, 
LOWER(DATE_FORMAT(`end_time`, '%l')) as `etime`,

DATE_FORMAT(`start_time`, '%k') as `select_start_time`,
DATE_FORMAT(`end_time`, '%k') as `select_end_time`,

`start_time`, `end_time`, `RotaID`
FROM `rota` WHERE `StaffID` = '".$row['StaffID']."' AND `start_date` = '".$query_start_Date."'" or die("Error in the consult.." . mysqli_error($link));

$result2 = $link->query($query2);

while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

if ($row2['num'] > 0) {

if ($adminr['admin'] > 0) {

echo '<span class="time">';
echo $row2['stime'] . " - " . $row2['etime'];
echo '</span>';

echo '<form action="" style="display: none;">';
echo '<input type="hidden" id="RotaID" name="RotaID" value="'. $row2['RotaID'] .'">';

echo '<select id="stime" name="stime">';	
echo '<option value="off">OFF</option>';	

	for ($i = 6; $i <= 21; $i++) {
		$selected = ($i == $row2['select_start_time']) ? 'selected' : '';
		$value = date("H:i:s", strtotime($i . ":00:00"));
		$time = date("h A", strtotime($i . ":00:00"));

		echo '<option ' . $selected .' value="'. $value .'">';
		echo $time;
		echo '</option>';
	}
echo '</select>'; 

echo '<select id="etime" name="etime">';
echo '<option value="off">OFF</option>';	
	for ($i = 6; $i <= 21; $i++) {
		$selected = ($i == $row2['select_end_time']) ? 'selected' : '';
		$value = date("H:i:s", strtotime($i . ":00:00"));
		$time = date("h A", strtotime($i . ":00:00"));

		echo '<option ' . $selected .' value="'. $value .'">';
		echo $time;
		echo '</option>';
	}
echo '</select>'; 

echo ' <input type="submit" class="save" id="save" value="ok">';
echo '</form>';
} else {
echo $row2['stime'] . " - " . $row2['etime'];
}

} else {

$query3 = "SELECT count(`StaffID`) as `num2` FROM `holiday` WHERE `StaffID` = '".$row['StaffID']."' AND '".$query_start_Date."' BETWEEN `from` AND `to`;";
$holi = $link->query($query3);
$hr = mysqli_fetch_array($holi, MYSQLI_ASSOC);

echo '<span class="time">';
if ($hr['num2'] > 0) {
echo 'holiday';
echo '</span>';
} else {

if ($adminr['admin'] > 0) {

// if its their day off
echo "off";
echo '</span>';
echo '<form action="" style="display: none;">';
echo '<input type="hidden" id="StaffID1" name="StaffID1" value="'.$row['StaffID'].'">';
echo '<input type="hidden" id="date" name="date" value="'.$query_start_Date.'">';

echo '<select id="stime" name="stime">';
	for ($i = 6; $i <= 21; $i++) {
		$selected = ($i == 10) ? 'selected' : '';
		$value = date("H:i:s", strtotime($i . ":00:00"));
		$time = date("h A", strtotime($i . ":00:00"));

		echo '<option ' . $selected .' value="'. $value .'">';
		echo $time;
		echo '</option>';
	}
echo '</select>'; 

echo '<select id="etime" name="etime">';
	for ($i = 6; $i <= 21; $i++) {
		$selected = ($i == 18) ? 'selected' : '';
		$value = date("H:i:s", strtotime($i . ":00:00"));
		$time = date("h A", strtotime($i . ":00:00"));

		echo '<option ' . $selected .' value="'. $value .'">';
		echo $time;
		echo '</option>';
	}
echo '</select>'; 

echo ' <input type="submit" class="save" id="save" value="ok">';
echo '</form>';
} else {
echo "off";
}

}
}

}
echo '</td>';
}

?>
</tr>
<?php
}
?>

</table>

</body>
</html>