<?php
if (isset($_GET['EventID'])) { 

$event_query = safe_query("SELECT * FROM `events` WHERE `id`= '".(int)$_GET['EventID']."'");
$e_results = mysql_fetch_array($event_query);

$get_category = safe_query("SELECT `title` FROM `events_cat` WHERE id = '".$e_results['category']."'");
$c = mysql_fetch_array($get_category);

if (strlen($e_results['detials']) == 0) {
$e_results['detials'] = "There is no information for the band";
}

if (strlen($e_results['report']) == 0) {
$e_results['report'] = "There is no report for this event";
}

?>
 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Event Report</h2>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">

<tr>
<td width="50%" ><strong>Event Name:</strong></td>
<td width="50%"><?php echo $e_results['title']; ?></td>
</tr>

<tr>
<td ><strong>Event Type:</strong></td>
<td><?php echo $c['title']; ?></td>
</tr>

<tr>
<td ><strong>Location:</strong></td>
<td><?php echo $e_results['location']; ?></td>
</tr>

<tr>
  <td colspan="2" >&nbsp;</td>
  </tr>
<tr>
  <td ><strong>Start Date / Time:</strong></td>
  <td><?php echo date("l d F @ g:i a", $e_results['start_time']); ?></td>
</tr>
<tr>
<td ><strong>End Date / Time:</strong></td>
<td><?php echo date("l d F @ g:i a", $e_results['end_time']); ?></td>
</tr>



</table>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>


<?php
if ($_SESSION['logged']) {
?>
 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Band Notes</h2>
<?php
$notes = safe_query("SELECT * FROM `band_notes` WHERE `EventID`='".(int)$_GET['EventID']."'");
if (mysql_num_rows($notes) > 0) {
	
	while ($note = mysql_fetch_array($notes)) {

?>
<span style="width:25%; float: left; display:block;"><strong><?php echo IDtoFullName($note['UserID']); ?></strong></span>
<span style="width:75%; float:right; display:block;"></span><?php echo icon($note['Body']);  ?></table>
<hr style="margin: 0; padding: 0;" />
<?php
	}

} else {
?>
<center>* No Comments *</center>
<?php
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<?php
}
?>



 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>The Report</h2>
<?php
$report = safe_query("SELECT * FROM `events_reports` WHERE `EventID`='".(int)$_GET['EventID']."'");
$rep = mysql_fetch_array($report);
if (strlen($rep['report']) > 0) {

?>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
<tr>
<td>
<?php
echo $rep['report']; 
?>
</td>
</tr>
</table>
<?php
} else {
?>
<div style="text-align: center">
no report
</div>


<?php
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<?php
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
$query = mysql_query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(`start_time`)) FROM `events` GROUP BY EXTRACT(YEAR FROM FROM_UNIXTIME(`start_time`)) ORDER BY `start_time` DESC ");
$numbers = mysql_num_rows($query);

while ($o = mysql_fetch_array($query)) {
?>
<tr>
<td style="padding: 3px; border-bottom: 2px solid #666666; border-top: 2px solid #666666; text-align:center; font-weight:bold;" colspan="2">- <?php echo $o[0]; ?> -</td>
</tr>
<?php
$q = mysql_query("SELECT * FROM `events` WHERE EXTRACT(YEAR FROM FROM_UNIXTIME(`start_time`)) = '".$o['0']."' AND status='1' ORDER BY `start_time` DESC");
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

$r['date'] 	= date("D jS F", $r['start_time']); 
$r['time'] 	= date("g:ia", $r['start_time']); 

?>
<tr>
<td align="left" bgcolor="<?php echo $bgcolor; ?>" style="padding: 5px;">
<a href="./?view=events&action=reports&EventID=<?=$r['id'];?>"><?php echo (strlen($r['title']) > 40) ? substr_replace($r['title'], '...', 40) : $r['title']; ?></a>
<br />
<i><?php echo (strlen($r['location']) > 20) ? substr_replace($r['location'], '...', 20) : $r['location']; ?></i>
</td>
<td bgcolor="<?php echo $bgcolor; ?>">
<?php echo $r['date']; ?>
<br />
<?php echo $r['time']; ?>
</td>
</tr>

<?php
}

}

?>
</table>
<br />

  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<?php
}
?>