<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Groups </div>
  </h2>
 <p>
 	<br />
You can select to edit, delete members of the website.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>User Group Management</div>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class='tablesubheader' width='28%'>Group Title</td>
  <td class='tablesubheader' width='15%'>Can Access ACP</td>
  <td class='tablesubheader' width='20%'>Members</td>
  <td class='tablesubheader' width='20%'>&nbsp;</td>
 </tr>
 
 <?php
 $query = mysql_query("SELECT * FROM `permissions` ORDER BY `pid` ASC");
 while ($r = mysql_fetch_array($query)) {
 
$rows = mysql_num_rows(mysql_query("SELECT `id` FROM `members` WHERE `group` = '".$r['pid']."'"));
?>
  
<tr>
<td class='tablerow1'><?php echo $r['name']; ?></td>
<td align='center' class='tablerow1'>
<?php 
$img = ($r['canviewadmin'] == 1) ? "aff_tick" : "aff_cross";

echo "<img src='images/".$img.".png'>";
?>
</td>
<td align='center' class='tablerow1'><?php echo $rows; ?></td>

<td align='center' class='tablerow2'>
<div align='center' style='white-space:nowrap'>
<a href="./?manager=members&action=edit_permissions&id=<?php echo $r['pid']; ?>"><img src='images/page_edit.png' border='0' alt='Edit'  /></a> 
</div>

</td>
</tr>
<?php
}
?>

 </table>
</div>

<br />

<div class='tableheaderalt'>Band Group Management</div>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
	<td class='tablesubheader' width='20%'>Display Order</td>
  	<td class='tablesubheader' width='28%'>Group Title</td>
	<td class='tablesubheader' width='20%'>Members</td>
 </tr>
 
 <?php
 $query = mysql_query("SELECT * FROM `memberstatus` ORDER BY `displayorder` ASC");
 while ($r = mysql_fetch_array($query)) {
 
$rows = mysql_num_rows(mysql_query("SELECT `id` FROM `members` WHERE `status` = '".$r['statusid']."'"));
?>
  
<tr>
<td align='center' class='tablerow1'><?php echo $r['displayorder']; ?></td>
<td class='tablerow1'><?php echo $r['statusname']; ?></td>
<td align='center' class='tablerow1'><?php echo $rows; ?></td>

</tr>
<?php
}
?>

 </table>
</div>