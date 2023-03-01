<?php
include("_mysql.php");
include("_functions.php");
include("_settings.php");
?>
<title>Attendance Record for Colin Lundy -</title>

<style>
body { 
margin: 0px;
padding: 0px;
}

.month {
width:100%; 
background-color: #747474; 
color:#FFFFFF;

padding: 5px;
font-size: 14px;
font-weight:bold;
font-family:Verdana, Arial, Helvetica, sans-serif
}
.date {
background-color: #87A6BE; 
color:#FFFFFF; 
float:left; 
display:block;
}
.attend {
color:#000000; 
float:left; 
display:block;
}
.daddy {
width: 800px; 
float:left; 
display:block;
}

</style>


<div style="padding: 10px">
<span style="padding-right: 6px; font-weight:bold;">Attended:</span> 
<?php 
$q = mysql_query("SELECT COUNT(*) FROM `attendance` WHERE `UserID` = '{$_SESSION['uid']}' AND `attended` = 'Yes'");
$t = mysql_fetch_array($q);
echo $t[0];
?><br />
<span style="padding-right: 6px; font-weight:bold;">Absent:</span> 
<?php 
$q2 = mysql_query("SELECT COUNT(*) FROM `attendance` WHERE `UserID` = '{$_SESSION['uid']}' AND `attended` = 'No'");
$t2 = mysql_fetch_array($q2);
echo $t2[0];
?>
<br />
<span style="padding-right: 6px; font-weight:bold;">Apology:</span> 
<?php 
$q3 = mysql_query("SELECT COUNT(*) FROM `attendance` WHERE `UserID` = '{$_SESSION['uid']}' AND `attended` = 'Apology'");
$t3 = mysql_fetch_array($q3);
echo $t3[0];
?>
<br />
</div>

<div style="clear:both;"></div>

<?php
$next = mysql_query("SELECT * FROM `practice` WHERE id = 1;");
$ne = mysql_fetch_array($next);

$query = mysql_query("SELECT MONTHNAME(date) AS month FROM practices GROUP BY month ORDER BY MONTH(date)");
while($row = mysql_fetch_array($query)) {
?>
<div class="daddy">

<div class="month"><?php echo $row['month']; ?></div>

<?php
$query2 = mysql_query("SELECT id, DATE_FORMAT(date, '%D') as day FROM `practices` WHERE MONTHNAME(date) = '".$row['month']."'");
$k = 0;
while($row2[$k] = mysql_fetch_object($query2)){
$width = ((mysql_num_rows($query2) % 2) == 0) ? "25" : "20";

if ($ne['date'] != $row2[$k]->date) {
?>
<div class="date" style="width: <?php echo $width; ?>%"><?php echo $row2[$k]->day; ?></div>
<?php

$k++;
} else {
echo '<div style="clear:both;"></div>';
}
}

echo "<div style='clear:both;'></div>\n";

for($i=0; $i<$k; $i++){
$query3 = mysql_query("SELECT * FROM `attendance` WHERE `PracID` = '".$row2[$i]->id."' && UserID = '".$_SESSION['uid']."'");
$at = mysql_fetch_object($query3);

if ($at->attended == "No") {
$bgcolor = "#EC4A4A";
} elseif ($at->attended == "Yes") {
$bgcolor = "#88BCF0";
} elseif ($at->attended == "Apology") {
$bgcolor = "#CCCCCC";
} else {
unset($bgcolor);
}

echo "<div class='attend' style='width: ".$width."%; background-color: ".$bgcolor."'>". $at->attended . "</div>\n";

if ($i == $k) {
echo '<div style="clear:both;"></div>';
}

}
?>
</div>
<?php
}

mysql_close($link);
?>