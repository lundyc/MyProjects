 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Event Details</h2>
<?php
if (isset($_GET['EventID'])) {

$query = "SELECT
`ID`, 
`title`,
DATE_FORMAT(`start_date`, '%W, %D %M') as `form_sdate`,
DATE_FORMAT(`start_time`, '%l:%i %p') as `form_stime`,
DATE_FORMAT(`end_date`, '%W, %D %M') as `form_edate`,
DATE_FORMAT(`end_time`, '%l:%i %p') as `form_etime`,
`where`,
`street`,
`town`,
`info`
FROM `new_events` WHERE `ID` = '".mysql_real_escape_string($_GET['EventID'])."';";

$event_query = safe_query($query);
$e_results = mysql_fetch_array($event_query);

//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////   /////////////////////////////////////////////////////

echo "<h3>". $e_results['title'] ."</h3>";

echo '<div style="padding-right: 50px;">';
echo '<div style="float: right;">';
echo $e_results['form_sdate'] . ' @ ' . $e_results['form_stime'];
echo '</div>';
echo '<div style="float: left;">Start Time:</div>';
echo '<br />';

echo '<div style="float: right;">';
echo $e_results['form_edate'] . ' @ ' . $e_results['form_etime'];
echo '</div>';
echo '<div style="float: left;">End Time:</div>';
echo '<br />';

echo '<div style="float: right;">'. $e_results['where'] . '</div>';
echo '<div style="float: left;">Location:</div>';
echo '<br />';

if (isset($e_results['street'])) {
echo '<div style="float: right;">'. $e_results['street'] . '</div>';
echo '<div style="float: left;">Street:</div>';
echo '<br />';
}

if (isset($e_results['town'])) {
echo '<div style="float: right;">'. $e_results['town'] . '</div>';
echo '<div style="float: left;">Town:</div>';
echo '<br />';

echo '<a target="_new" href="http://maps.google.com/maps?f=q&hl=en&q='.str_replace(" ", "+", $e_results['street']).'%2C+'.str_replace(" ", "+", $e_results['town']).'%2C+United+Kingdom">View Map</a>';
}

echo "</div>";

echo "<h5>Description</h5>";
echo nl2br($e_results['info']);

//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////   /////////////////////////////////////////////////////
} else {
	echo "ID Please";
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>