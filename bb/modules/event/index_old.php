<style>
h4 { 
letter-spacing: 0.1em;
margin-bottom: 10px;
}

.event { 
border-bottom: 1px solid black;
margin-bottom: 10px;
padding-bottom: 8px;
}

.title { 
font-weight: bold;
}

.date, .time, .title, .info {
padding-right: 30px;
 display: inline;
 
}

</style>

<div class="module"><div class="mb">
<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
echo '<h2>Event Details</h2>';

$query = "SELECT  `ID`, 
DATE_FORMAT(`date`, '%W, %D %M %Y') as `format_date`,
DATE_FORMAT(`time`, '%l:%i %p') as `format_time`, 
`title`, `where`, `street`, `town`, `info` FROM  `new_events` WHERE `ID` = '".mysqli_real_escape_string($mysqli, $_GET['id'])."'";

$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
$r = $result->fetch_assoc();

echo '<div class="title">'.$r['title'] . '</div>';

echo '<div class="datentime">';
echo "Date: " . $r['format_date'] . "<br>";
echo "Time: " . $r['format_time'] . "<br>";
echo '</div>';

echo $r['info'];

if (!empty($r['report'])) {
echo '<div>'.$r['report'].'</div>';
}

} else {
echo '<h2>';
if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {
echo '<span style="float: right"><a href="/event?action=add">ADD</a></span>';
} 

}
echo 'Events';
echo '</h2>';

// Today's events
$today_query = "SELECT `ID`, `time`, `title`  FROM `new_events` WHERE `status` = 'Upcoming' AND `date` = CURRENT_DATE();";
$today = $mysqli->query($today_query) or die($mysqli->error.__LINE__);

if ( $today->num_rows > 0) {
echo "<h4>Today</h4>";

while($r = $today->fetch_assoc()) {

echo '<div class="event">';
echo '<span class="date">';
echo date("D jS M", strtotime($r['date']));
echo '</span>';

echo '<span class="time">';
echo  date("g:i a", strtotime($r['time']));
echo '</span>';

echo '<span class="title">';
echo $r['title'];
echo '</span>';

echo (!empty($r['info'])) ? '<br><span class="info">'.$r['info']."</span>" : '';
echo '</div>';
}

}

// 2moro's events
$q2 = "SELECT `ID`, `time`, `title`  FROM `new_events` WHERE `status` = 'Upcoming' AND `date` = CURDATE() + INTERVAL 1 DAY;";
$query2 = $mysqli->query($q2) or die($mysqli->error.__LINE__);

if ($query2->num_rows > 0) {
echo "<h4>Tomorrow</h4>";

while ($r2 = $query2->fetch_assoc()) {

echo '<div class="event">';
echo '<span class="date">';
echo date("D jS M", strtotime($r2['date']));
echo '</span>';

echo '<span class="time">';
echo  date("g:i a", strtotime($r2['time']));
echo '</span>';

echo '<span class="title">';
echo $r2['title'];
echo '</span>';

echo (!empty($r2['info'])) ? '<br><span class="info">'.$r2['info']."</span>" : '';
echo '</div>';
}

}

// This Months events
$q3 = "SELECT `ID`, `time`, `date`, `title`, `info`  FROM `new_events` WHERE 
`status` = 'Upcoming' AND 
`date` != CURRENT_DATE() AND
`date` != CURRENT_DATE() + INTERVAL 1 DAY AND
MONTH(`date`) = MONTH(CURDATE()) ORDER BY `date` ASC ";
$query3 = $mysqli->query($q3) or die($mysqli->error.__LINE__);

if ($query3->num_rows > 0) {
echo "<h4>This Month</h4>";

while ($r3 = $query3->fetch_assoc()) {

echo '<div class="event">';
echo '<span class="date">';
echo date("D jS M", strtotime($r3['date']));
echo '</span>';

echo '<span class="time">';
echo  date("g:i a", strtotime($r3['time']));
echo '</span>';

echo '<span class="title">';
echo $r3['title'];
echo '</span>';

echo (!empty($r3['info'])) ? '<br><span class="info">'.$r3['info']."</span>" : '';
echo '</div>';
}

}

// Other Months events
$q4 = "SELECT  MONTH(`date`) as `month`, DATE_FORMAT(`date`, '%M') as `month_name` FROM `new_events` WHERE 
`status` = 'Upcoming' AND MONTH(`date`) != MONTH(CURDATE()) GROUP BY `month` ORDER BY MONTH(`date`) ";
$query4 = $mysqli->query($q4) or die($mysqli->error.__LINE__);

while ($month = $query4->fetch_assoc()) {
echo "<h4>".$month['month_name']."</h4>";

$q5 = "SELECT
`ID`, `time`, `date`, `title` FROM `new_events` WHERE
`status` = 'Upcoming' AND
MONTH(`date`) = '".$month['month']."' ORDER BY `date`";

$query5 = $mysqli->query($q5) or die($mysqli->error.__LINE__);
while ($r5 = $query5->fetch_assoc()) {

echo '<div class="event">';
echo '<span class="date">';
echo date("D jS M", strtotime($r5['date']));
echo '</span>';

echo '<span class="time">';
echo  date("g:i a", strtotime($r5['time']));
echo '</span>';

echo '<span class="title">';
echo $r5['title'];
echo '</span>';

echo (!empty($r5['info'])) ? '<br><span class="info">'.$r5['info']."</span>" : '';
echo '</div>';
}


}
}
?>
</div></div>