<?php
if (isset($_GET['EventID'])) {
?>
 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Event Report</h2>

<?php
$event_query = safe_query("SELECT 
`ID`, 
`title`,
DATE_FORMAT(`start_date`, '%W, %D %M') as `form_sdate`,
DATE_FORMAT(`start_time`, '%l:%i %p') as `form_stime`,
DATE_FORMAT(`end_date`, '%W, %D %M') as `form_edate`,
DATE_FORMAT(`end_time`, '%l:%i %p') as `form_etime`,
`where`,
`street`,
`town`,
`info`,
`report`,
`gallery_cat`
 FROM `new_events` WHERE `ID`= '".(int)$_GET['EventID']."'");
if (mysql_num_rows($event_query) == 0) {
die("I wish I was real");
}

$e_results = mysql_fetch_array($event_query);


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

echo "<h5>Report</h5>";
echo (empty($e_results['report'])) ? 'no report' : nl2br($e_results['report']);

/// picture time
echo "<h5>Pictures</h5>";
$gallery_query = safe_query("SELECT * FROM `gallery` WHERE `category` = '".$e_results['gallery_cat']."'");
echo (mysql_num_rows($gallery_query) == 0) ? "no pictures added." : '';

while ($gal = mysql_fetch_array($gallery_query)) {
echo '<img src="uploads/gallery/thumbs/'. $gal['filename'].'" style="padding: 3px;">';
}

} else {
?>


 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Event Reports</h2>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="listing2" style="padding: 5px;">
<tr>
  <td colspan="2"> Please click on the Parade - Function name to view detials about this event. </td>
</tr>
<tr>
<td width="41%" style="padding-bottom: 3px;"><strong>Parade - Function</strong></td>
<td width="21%" style="padding-bottom: 3px;"><strong>Date</strong></td>
</tr>

<?php
$query = mysql_query("SELECT YEAR(`start_date`) FROM `new_events` GROUP BY YEAR(`start_date`) ORDER BY `start_date` DESC ");
$numbers = mysql_num_rows($query);

while ($o = mysql_fetch_array($query)) {
?>
<tr>
<td style="padding: 3px; border-bottom: 2px solid #666666; border-top: 2px solid #666666; text-align:center; font-weight:bold;" colspan="2">- <?php echo $o[0]; ?> -</td>
</tr>
<?php
$q = mysql_query("SELECT 
`ID`, 
`status`, 
`start_date`, 
`start_time`, 
`title`, 
`where`,

DATE_FORMAT(`start_date`, '%a %D %M') as `date_form`, 
DATE_FORMAT(`start_time`, '%l:%i %p') as `time_form`
FROM `new_events` WHERE YEAR(`start_date`) = '".$o['0']."' AND status='finished' ORDER BY `start_date` DESC") or die("MYSQL ERROR " . mysql_error());
$numbers2 = mysql_num_rows($q);

if ($numbers2 == 0) {
?>
<tr>
<td style="text-align:center; padding: 5px;" colspan="2"  bgcolor="#EEEEEE">* No Reports *</td>
</tr>
<?php
}

while($r = mysql_fetch_array($q)) {

if ($bgcolor == "#EEEEEE") {
$bgcolor = "#f5f5f5";
} else {
$bgcolor = "#EEEEEE";
}

?>
<tr>
<td align="left" bgcolor="<?php echo $bgcolor; ?>" style="padding: 5px;">
<a href="./?view=events&action=reports&EventID=<?=$r['ID'];?>"><?php echo (strlen($r['title']) > 40) ? substr_replace($r['title'], '...', 40) : $r['title']; ?></a>
<br />
<i><?php echo (strlen($r['where']) > 20) ? substr_replace($r['where'], '...', 20) : $r['where']; ?></i>
</td>
<td bgcolor="<?php echo $bgcolor; ?>">
<?php echo $r['date_form']; ?>
<br />
<?php echo $r['time_form']; ?>
</td>
</tr>

<?php
}

}

?>
</table>
<?php
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>