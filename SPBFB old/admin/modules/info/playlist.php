<?php
if (level($_SESSION['uid']) >= 4) {
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
  	<div>Manage Our Playlist </div>
  </h2>
 <p>
 	<br />
In this section you can add, edit or delete any tunes the band currently play. You an also upload a snippet off the tune for learner's to practice via the website.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>
<span style="float: right; padding-right: 5px;">
<a href="./?manager=info&amp;action=add_song">Add</a>
</span>
Our Playlist

</div>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class='tablesubheader' width='10%'>ID</td>
  <td class='tablesubheader' width='31%'>Name</td>
  <td class='tablesubheader' width='31%'>File</td>  
  <td class='tablesubheader' width='15%'>Category</td> 
  <td class='tablesubheader' width='22%'>&nbsp;</td>
 </tr>
 
 <?php
$query = mysql_query("SELECT `songID`, `name`, `file`, `hymm` FROM `song` ORDER BY `hymm` DESC, `name`");
while ($r = mysql_fetch_assoc($query)) {
echo "<tr>";
echo "<td class='tablerow2'><strong>". $r['songID']."</strong></td>";
echo "<td class='tablerow2'>". $r['name']."</td>";
echo "<td class='tablerow2'>". $r['file']."</td>";
echo "<td class='tablerow2'>";
echo ($r['hymm'] == "yes") ? 'Hymm' : '';
echo "</td>";
echo "<td class='tablerow1' align='center'>";
echo "<div align='center' style='white-space:nowrap'>";
echo '<a href="./?manager=info&action=edit_song&songID='.$r['songID'].'">';
echo "<img src='images/page_edit.png' border='0' alt='Edit'  />";
echo '</a> ';
echo "<img src='images/page_delete.png' border='0' alt='Delete'  />";
echo "</div></td>";
echo "</tr>";
}

?> 
 </table>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <?php
 /*
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

?>
  </div></td>
</tr>
<?php
}
?>
 </table>

<?php
}
*/

} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

?>

