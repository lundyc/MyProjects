<?php
if (level($_SESSION['uid']) >= 2) {

if (isset($_GET['id'])) {

if ($_GET['a'] == "dodelete") {
mysql_query("DELETE FROM `new_events` WHERE id='".$_GET['id']."'") or die("Error: " . mysql_error());
redirect("index.php?manager=events", 0);
} 

} else {
?>

<script language="javascript">


<!--	
function delparade(id)
{
if (confirm('Are you sure you want to delete this item?'))
{document.location.href = 'index.php?manager=events&a=dodelete&id='+id;}
}
   
// -->

</script>

<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Events </div>
  </h2>
 <p>
 	<br />
 	You can select to edit or delete parades, viewable to the Public.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>Events Overview </div>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class='tablesubheader' colspan="3">Upcoming Events</td>
 </tr>

 <tr>
  <td class="tablerow1shaded" width='42%'>Name</td>
  <td class="tablerow1shaded" width='26%'>Poster</td>
  <td class="tablerow1shaded" width='10%'>&nbsp;</td>
 </tr>

<?php
 $q = "SELECT `ID`, `status`, `start_date`, `title`, `where`, 
 DATE_FORMAT(`start_date`,'%W, %D %M %Y') AS showdate,
 
 (SELECT `realname` FROM `profile` WHERE `mid` = `new_events`.`poster`) as `PosterName`
 
 FROM `new_events` WHERE STATUS = 'Upcoming' ORDER BY `start_date` ASC";
 $q2 = mysql_query($q);
 while ($r = mysql_fetch_array($q2)) {
 
?>
 <tr>
<td class='tablerow2'>
<strong><?php echo $r['title']; ?></strong><br />
(<?php echo $r['showdate']; ?>)  <i><?php echo $r['where']; ?></i>

</td>
  <td class='tablerow2'><?php echo $r['PosterName']; ?></td>

  <td class='tablerow1' align='center'>
  <div align='center' style='white-space:nowrap'>
  <a href="index.php?manager=events&action=edit&id=<?php echo $r['ID']; ?>"><img src='images/page_edit.png' border='0' alt='Edit'  /></a>  
  <a href="javascript:delparade('<?php echo $r['ID']; ?>');"><img src='images/page_delete.png' border='0' alt='Delete'  /></a>
  </div></td>
</tr>
<?php
 }
 ?>

 <tr>
  <td class='tablesubheader' colspan="3">Finished Events</td>
 </tr>

  <tr>
  <td class="tablerow1shaded" width='42%'>Name</td>
  <td class="tablerow1shaded" width='26%'>Poster</td>
  <td class="tablerow1shaded" width='10%'>&nbsp;</td>
 </tr>

<?php
 $q = "SELECT `ID`, `status`, `start_date`, `title`, `where`, 
 DATE_FORMAT(`start_date`,'%W, %D %M %Y') AS showdate,
 
 (SELECT `realname` FROM `profile` WHERE `mid` = `new_events`.`poster`) as `PosterName`
 
 FROM `new_events` WHERE STATUS = 'Finished' ORDER BY `start_date` ASC";
 $q2 = mysql_query($q);
 while ($r = mysql_fetch_array($q2)) {
 
?>
 <tr>
<td class='tablerow2'>
<strong><?php echo $r['title']; ?></strong><br />
(<?php echo $r['showdate']; ?>)  <i><?php echo $r['where']; ?></i>

</td>
  <td class='tablerow2'><?php echo $r['PosterName']; ?></td>

  <td class='tablerow1' align='center'>
  <div align='center' style='white-space:nowrap'>
  <a href="index.php?manager=events&action=edit&id=<?php echo $r['ID']; ?>"><img src='images/page_edit.png' border='0' alt='Edit'  /></a>  
  <a href="javascript:delparade('<?php echo $r['ID']; ?>');"><img src='images/page_delete.png' border='0' alt='Delete'  /></a>
  </div></td>
</tr>
<?php
 }
 ?>
 <tr>
  <td class='tablerow1' colspan='2' align='right'>
  <strong>Total Parades Posts : (
  <?php 
$qu = mysql_query("SELECT `ID` FROM `new_events`");
echo mysql_num_rows($qu);
  ?>
  )</strong>
  </td>
  <td class='tablerow1'>&nbsp;</td>
 </tr>
 </table>
 
<?php
 }

} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>