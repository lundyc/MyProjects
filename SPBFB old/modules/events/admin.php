<?php
if (level($_SESSION['uid']) >= 2) {

if (isset($_GET['id'])) {

if ($_GET['a'] == "dodelete") {
mysql_query("DELETE FROM `events` WHERE id='".$_GET['id']."'") or die("Error: " . mysql_error());
mysql_query("DELETE FROM `events_reports` WHERE EventID='".$_GET['id']."'") or die("Error: " . mysql_error());

if (mysql_num_rows(mysql_query("SELECT `EventID` FROM `band_notes` WHERE EventID = '".$_GET['id']."'")) > 0) { 
mysql_query("DELETE FROM `band_notes` WHERE EventID = '".$_GET['id']."'") or die("Error: " . mysql_error());
}

redirect("index.php?manager=parades", 0);
} 

} else {
?>

<script language="javascript">


<!--	
function delparade(id)
{
if (confirm('Are you sure you want to delete this item?'))
{document.location.href = 'index.php?manager=parades&a=dodelete&id='+id;}
}
   
// -->

</script>


<div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb2">
      <h2 class="about">Parades and Events Manager</h2>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class="subtitle" colspan="3">Upcoming Events</td>
 </tr>

<?php
 $q = "SELECT * FROM `events` WHERE STATUS = '0' ORDER BY `start_time` ASC";
 $q2 = mysql_query($q);
 while ($r = mysql_fetch_array($q2)) {
$query3 = mysql_query("SELECT `title` FROM `events_cat` WHERE id='".$r['category']."'");
$c = mysql_fetch_array($query3);
$notes = mysql_num_rows(mysql_query("SELECT * FROM `band_notes` WHERE EventID='".$r['id']."'"));
 
?>
 <tr>
<td width="63%" class='tablerow2'>
<strong><?php echo $r['title']; ?></strong><br />
(<?php echo date("l, jS F y", $r['start_time']); ?>)  <i><?php echo $r['location']; ?></i>

</td>
  <td width="26%" class='tablerow2'><?php echo $c['title']; ?></td>
  <td width="11%" align='center' class='tablerow1'>
  <div align='center' style='white-space:nowrap'>
  <a href="./?view=events&action=edit&id=<?php echo $r['id']; ?>"><img src="images/misc/pencil.png" border="0" /></a>    
  <a href="javascript:delparade('<?php echo $r['id']; ?>');"><img src="images/misc/delete.png" border="0" /></a>
  </div></td>
</tr>
<?php
 }
 ?>

 <tr>
  <td class="subtitle" colspan="3">Finished Events</td>
 </tr>
 
 <?php
 //$query = mysql_query("");
 
 
 
 $query = mysql_query("SELECT * FROM `events` WHERE `status` = '1' ORDER BY id DESC, start_time DESC");
 $rows = mysql_num_rows($query);
 while ($r = mysql_fetch_array($query)) {
 
  $query2 = mysql_query("SELECT `report` FROM `events_reports` WHERE EventID='".$r['id']."'");
  $port = mysql_fetch_array($query2);
  
    $query3 = mysql_query("SELECT `title` FROM `events_cat` WHERE id='".$r['category']."'");
  $c = mysql_fetch_array($query3);
  
  $query4 = mysql_query("SELECT * FROM `band_notes` WHERE EventID='".$r['id']."'");
  $notes = mysql_num_rows($query4);
 
 
 $class = '';
if ($r['status'] == 0) {
$status = "<img src='images/arrow_up.png' title='Upcoming Event'>";
} elseif ($r['status'] == 1 && isset($port['report']) && strlen($port['report']) > 0) {
$status = "<img src='images/tick.png' title='Done and Report Entered'>";
} else {
$status = "<img src='images/exclamation.png' title='Done, but NO report entered'>";
$class = 'style="background-color: #fa9e8f;" ';
}




 ?>
 
 
 <tr <?php echo $class; ?>>
<td class='tablerow2'>
<strong><?php echo $r['title']; ?></strong><br />
<?php echo $status; ?> (<?php echo date("l, jS F y", $r['start_time']); ?>)  <i><?php echo $r['location']; ?></i>



</td>
  <td class='tablerow2'><?php echo $c['title']; ?></td>
  <td class='tablerow1' align='center'>
  <div align='center' style='white-space:nowrap'>
  <a href="./?view=events&action=edit&id=<?php echo $r['id']; ?>"><img src="images/misc/pencil.png" border="0" /></a>    
  <a href="javascript:delparade('<?php echo $r['id']; ?>');"><img src="images/misc/delete.png" border="0" /></a>
  </div>
  </td>
</tr>
<?php
}
?>

 <tr>
  <td class='tablerow1' colspan='3' align='right'><strong>Total Parades Posts : (<?php echo $rows; ?>)</strong></td>
  </tr>
 </table>
 
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<?php
 }

} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>