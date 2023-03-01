 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2 style="margin-bottom: 0;">Upcoming Events</h2>
      
<?php
// Today's events
$q = "SELECT `ID`, `start_time`, `title`  FROM `new_events` WHERE `status` = 'Upcoming' AND `start_date` = CURRENT_DATE();";
$query = mysql_query($q);
$today = mysql_num_rows($query);

if ($today > 0) {
echo "<h4>Today</h4>";

while ($r = mysql_fetch_array($query)) {
	echo '<a href="./?view=events&action=details&EventID='. $r['ID'].'">';
echo $r['title'];
echo "</a><br />";
echo "Today " . date("g:i a", strtotime($r['start_time']));
echo "<hr />";
}

}

// 2moro's events
$q2 = "SELECT `ID`, `start_time`, `title`  FROM `new_events` WHERE `status` = 'Upcoming' AND `start_date` = CURDATE() + INTERVAL 1 DAY;";
$query2 = mysql_query($q2);
$rows2 = mysql_num_rows($query2);

if ($rows2 > 0) {
echo "<h4>Tomorrow</h4>";

while ($r2 = mysql_fetch_array($query2)) {
	echo '<a href="./?view=events&action=details&EventID='. $r2['ID'].'">';
echo $r2['title'];
echo "</a><br />";
echo "Tomorrow " . date("g:i a", strtotime($r2['start_time']));
echo "<hr />";
}

}

// This Months events
$q3 = "SELECT `ID`, `start_time`, `start_date`, `title`  FROM `new_events` WHERE 
`status` = 'Upcoming' AND 
`start_date` != CURRENT_DATE() AND
`start_date` != CURRENT_DATE() + INTERVAL 1 DAY AND
MONTH(`start_date`) = MONTH(CURDATE()) ";
$query3 = mysql_query($q3);
$rows3 = mysql_num_rows($query3);

if ($rows3 > 0) {
echo "<h4>This Month</h4>";

while ($r3 = mysql_fetch_array($query3)) {
	echo '<a href="./?view=events&action=details&EventID='. $r3['ID'].'">';
	echo $r3['title'];
	echo "</a><br />";
echo date("jS F", strtotime($r3['start_date']));
echo " at " . date("g:i a", strtotime($r3['start_time']));
echo "<hr />";
}

}

// Other Months events
$q4 = "SELECT  MONTH(`start_date`) as `start_month`, DATE_FORMAT(`start_date`, '%M') as `month_name` FROM `new_events` WHERE 
`status` = 'Upcoming' AND MONTH(`start_date`) != MONTH(CURDATE()) GROUP BY `start_month` ORDER BY MONTH(`start_date`) ";
$query4 = mysql_query($q4);

while ($month = mysql_fetch_assoc($query4)) {
echo "<h4>".$month['month_name']."</h4>";

$q5 = "SELECT
`ID`, `start_time`, `start_date`, `title` FROM `new_events` WHERE
`status` = 'Upcoming' AND
MONTH(`start_date`) = '".$month['start_month']."' ORDER BY `start_date`";

$query5 = mysql_query($q5);
while ($r5 = mysql_fetch_assoc($query5)) {
echo '<a href="./?view=events&action=details&EventID='. $r5['ID'].'">';
echo $r5['title'];
echo "</a><br />";
echo date("jS F", strtotime($r5['start_date']));
echo " at " . date("g:i a", strtotime($r5['start_time']));
echo "<hr />";
}


}
?>
      
  </div>
  <div class="bb"><div><div></div></div></div>
</div>