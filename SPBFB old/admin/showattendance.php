<?php
include("_mysql.php");
include("_functions.php");
include("_settings.php");

function days_in_month($month, $year) 
{ 
// calculate number of days in a month 
return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31); 
} 
?>
<table cellpadding='4' cellspacing='0' width='100%'>
<tr>
<td class='tablesubheader' width='15%'></td>
<?php
$q = 'SELECT date, MONTHNAME(date) as month FROM `practices` GROUP BY month ORDER BY MONTH(date);';
$query = mysql_query($q);

$m = 0;
$k = 0;

while($month[$m] = mysql_fetch_object($query)){

?>
<td colspan="<?php echo mysql_num_rows(mysql_query("SELECT * FROM `practices` WHERE MONTHNAME(date) = '".$month[$m]->month."'")); ?>" class='tablesubheader' style="text-align:center; border-right: 1px solid black; border-left: 1px solid black">
<? 


//echo ceil(days_in_month("2", "2012") / 7);


$days = cal_days_in_month(CAL_GREGORIAN, 3, 2012);
$week_day = date("N", mktime(0,0,0,3,1,2012));
$weeks = ceil(($days + $week_day) / 7);
//echo $weeks . " - ";
echo $month[$m]->month; ?>
</td>
<?php
$m++;
}
?>
</tr>
<tr>
<td class='tablesubheader' width='10%'>Name</td>

<?php
$q2 = "SELECT id, date, DAY(date) as day, MONTHNAME(date) as monther from practices";
$query2 = mysql_query($q2);

while($row[$k] = mysql_fetch_object($query2)){

?>
<td class='tablesubheader' style="text-align:center;"><? echo $row[$k]->day; ?></td>
<?php
$k++;
}
?>
 </tr>

<?php
$q2 = "select mid, realname from profile";
$query3 = mysql_query($q2);
while($row2 = mysql_fetch_object($query3)){

$join = mysql_query("SELECT `joined` FROM `members` WHERE `id` = '{$row2->mid}'");
$j = mysql_fetch_array($join);
?>
 <tr>
  <td class='tablerow2'><strong><?php echo $row2->realname; ?></strong></td>
<?php
for($i=0; $i<$k; $i++){
$q4 = "SELECT * FROM `attendance` WHERE `PracID` = '".$row[$i]->id."' && UserID = '".$row2->mid."'";
$query4 = mysql_query($q4);

$rower = mysql_num_rows($query4);
$at = mysql_fetch_object($query4);

if (strtotime($row[$i]->date) < $j['joined'] && $rower == 0) {
echo "<td class='tablerow2'>--</td>";
} else {

if ($rower > 0) {

if ($at->attended == "No") {
$bgcolor = "#EC4A4A";
} elseif ($at->attended == "Yes") {
$bgcolor = "#88BCF0";
} elseif ($at->attended == "Apology") {
$bgcolor = "#CCCCCC";
} elseif ($at->attended == "Unknown") {
$bgcolor = "white";
} else {
$bgcolor = '';
}
?>
<td id="<?php echo $row2->mid; ?>_<?php echo $row[$i]->id; ?>" class='tablerow2' style="background-color: <?php echo $bgcolor; ?>; text-align:center;" onclick="saveData('Delete', '<?php echo $row2->mid; ?>', '<?php echo $row[$i]->id; ?>');">
<?php

} else {
?>
<td class='tablerow2' id="<?php echo $row2->mid; ?>_<?php echo $row[$i]->id; ?>">
<a onclick="saveData('Yes', '<?php echo $row2->mid; ?>', '<?php echo $row[$i]->id; ?>');" ><img src="y.png" border="0" title="Yes" /></a> 
<a onclick="saveData('No', '<?php echo $row2->mid; ?>', '<?php echo $row[$i]->id; ?>');" ><img src="n.png" border="0" title="No" /></a> 
<a onclick="saveData('Apology', '<?php echo $row2->mid; ?>', '<?php echo $row[$i]->id; ?>');" ><img src="a.gif" border="0" title="Apology" /></a>
<a onclick="saveData('Unknown', '<?php echo $row2->mid; ?>', '<?php echo $row[$i]->id; ?>');" ><img src="a.gif" border="0" title="Unknown" /></a>
<?php
}
?>
</td>
<?php
}
}
?>
</tr>
<?php
}

?>

</table>