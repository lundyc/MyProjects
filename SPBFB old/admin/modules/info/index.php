<?php
if (level($_SESSION['uid']) >= 4) {

if (isset($_GET['id'])) {

if ($_GET['a'] == "dodelete") {

if ($_GET['id'] > 7) {
mysql_query("DELETE FROM `info` WHERE id='".$_GET['id']."'") or die("Error: " . mysql_error());
redirect("index.php?manager=info",0);
} else {
die("Sorry, you cannot delete this item");
}

} 

} else {

?>

<script language="javascript">
<!--	
function delinfo(id)
{
if (confirm('Are you sure you want to delete this item?'))
{document.location.href = 'index.php?manager=info&a=dodelete&id='+id;}
}
   
// -->

</script>

<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Site Information </div>
  </h2>
 <p>
 	<br />
 	You can select to edit or delete information, viewable to the Public.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>Information Overview </div>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
   <td class='tablesubheader' width='10%'>ID</td>
   
  <td class='tablesubheader' width='31%'>Title</td>
  <td class='tablesubheader' width='16%'>&nbsp;</td>
 </tr>
 
 <?php
 $query = mysql_query("SELECT * FROM `info` ORDER BY id ASC");
 $rows = mysql_num_rows($query);
 while ($r = mysql_fetch_array($query)) {
 ?>
 
 
 <tr>
   <td class='tablerow2'><strong><?php echo $r['id']; ?></strong></td>
  <td class='tablerow2'><strong><?php echo $r['title']; ?></strong></td>
  <td class='tablerow1' align='center'>
  <div align='center' style='white-space:nowrap'>
<?php 
if ($r['id'] == 4) {
	echo '<a href="index.php?manager=members">'; 
} elseif ($r['id'] == 7) {
?>
<a href="index.php?manager=info&action=playlist">
<?php
} else {	
?>
<a href="index.php?manager=info&action=edit&id=<?php echo $r['id']; ?>">
<?php
}
?>
<img src='images/page_edit.png' border='0' alt='Edit'  /></a>

<?php
/*
Removed at the moment its pointless having it there

<a href="javascript:delinfo('<?php echo $r['id']; ?>');"><img src='images/page_delete.png' border='0' alt='Delete'  /></a>
*/
?>
  </div></td>
</tr>
<?php
}
?>
 </table>

<?php
}

} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

?>

