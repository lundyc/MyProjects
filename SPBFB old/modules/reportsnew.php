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
<div id="listing2_header"><span>Report</span> Details</div>


<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">

<tr>
<td width="20%" bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080"><strong>Event Name:</strong></td>
<td width="80%" bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080"><?php echo $e_results['title']; ?></td>
</tr>

<tr>
<td bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080"><strong>Event Type:</strong></td>
<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080"><?php echo $c['title']; ?></td>
</tr>

<tr>
<td bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080"><strong>Location:</strong></td>
<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080"><?php echo $e_results['location']; ?></td>
</tr>

<tr>
  <td width="20%" bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080"><strong>Date:</strong></td>
  <td width="80%" bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080"><?php echo date("l, jS F Y", $e_results['start_time']); ?></td>
</tr>

<tr>
  <td width="20%" bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080"><strong>Time:</strong></td>
  <td width="80%" bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080"><?php echo date("g:i a", $e_results['start_time']); ?></td>
</tr>

</table>

<?php
if (isset($_SESSION['logged'])) {
?>
<br />
<div id="listing2_header"><span>Band</span> Notes</div>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">


<?php
$notes = safe_query("SELECT * FROM `band_notes` WHERE `EventID`='".$_GET['EventID']."'");
if (mysql_num_rows($notes) == 0) {
echo "<tr>";
echo '<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080; text-align: center">';
echo '* No Notes *';
echo '</td>';
echo "</tr>";
}

while ($note = mysql_fetch_array($notes)) {
?>
<tr>
<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080">
<?php
echo $note['Body']; 
?>
<div class="avail-item" style="margin-top:5px;"><span class="titel">By <?php echo IDtoName($note['UserID']); ?></span></div>     
</td>
</tr>

<?php
}
?>
</table>
<?php
}
?>

<link rel="stylesheet" href="lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="scripts/lightbox.js"></script>

<br />
<div id="listing2_header"><span>Event</span> Pictures</div>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">

<?php
$query = mysql_query("SELECT * FROM `events_pictures` WHERE `category` = '".$_GET['EventID']."'");

if (mysql_num_rows($query) == 0) {
echo '<tr>';
echo '<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080">';
echo "<center>* No Pictures *</center>";
echo '</td>';
echo '</tr>';
}

echo "<tr>";
echo '<td align="center">';

while ($r = mysql_fetch_array($query)) {
$href = "uploads/gallery/". $r['filename'];
//$title = "<strong>".$r['title']."</strong><br /> ".substr($r['desc'], 0, 40 - 3) . "...";
$title = "<b>". $r['title'] ."</b><br /> ". $r['desc'];
?>

<a href='<?php echo $href; ?>' title='<?php echo $title; ?>' class="thickbox" rel="lightbox">
<img src='uploads/gallery/thumbs/<?php echo $r['filename']; ?>' class='imgborder' style='margin-right: 5px; margin-bottom: 5px;' />
</a>



<?php
}
echo '</td>';
echo "</tr>";
?>
</table>

<br />
<div id="listing2_header"><span>Event</span> Report</div>
<?php
$rep = mysql_fetch_array(safe_query("SELECT * FROM `events_reports` WHERE `EventID`='".$_GET['EventID']."'"));

?>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">
<tr>
<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080">
<?php
if (strlen($rep['report']) > 0) {
echo $rep['report']; 
} else {
echo "<center>* No Report *</center>";
}
?>
</td>
</tr>
</table>

<?php
} else {
?>
<div id="listing2_header"><span>Event</span> Reports</div>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="listing2" style="padding: 5px;">
<tr>
  <td colspan="4"> Please click on the Parade - Function name to view detials about this event. </td>
</tr>
<tr>
<td width="41%" style="padding-bottom: 3px;"><strong>Parade - Function</strong></td>
<td width="21%" style="padding-bottom: 3px;"><strong>Date</strong></td>
<td width="11%" style="padding-bottom: 3px;"><strong>Time</strong></td>
<td width="27%" style="padding-bottom: 3px;"><strong>Location</strong></td>
</tr>

<?php
$query = mysql_query("SELECT EXTRACT(YEAR FROM FROM_UNIXTIME(`start_time`)) FROM `events` GROUP BY EXTRACT(YEAR FROM FROM_UNIXTIME(`start_time`)) ORDER BY `start_time` DESC ");
$numbers = mysql_num_rows($query);
while ($o = mysql_fetch_array($query)) {
?>
<tr>
<td style="padding: 3px; border-bottom: 2px solid #666666; border-top: 2px solid #666666; text-align:center; font-weight:bold;" colspan="4">- <?php echo $o[0]; ?> -</td>
</tr>
<?php
$q = mysql_query("SELECT * FROM `events` WHERE EXTRACT(YEAR FROM FROM_UNIXTIME(`start_time`)) = '".$o['0']."' AND status='1' ORDER BY `start_time` DESC");
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
<td align="left" bgcolor="<?php echo $bgcolor; ?>" style="padding: 5px;"><a href="./?view=reports&EventID=<?=$r['id'];?>"><?php echo $r['title']; ?></a></td>
<td bgcolor="<?php echo $bgcolor; ?>">
<?php echo $r['date']; ?></td>
<td bgcolor="<?php echo $bgcolor; ?>">
<?php echo $r['time']; ?></td>
<td align="left" bgcolor="<?php echo $bgcolor; ?>">
<?php echo (strlen($r['location']) > 20) ? substr_replace($r['location'], '...', 20) : $r['location']; ?></td>
</tr>

<?php
}

}

?>
</table>
<?php
}
?>