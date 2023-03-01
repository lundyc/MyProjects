<?php
if (level($_SESSION['uid']) >= 2) {

?>
<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Gallery Albums </div>
  </h2>
 <p>
 	<br />
 	You can select to edit or delete gallery albums, viewable to the Public.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>Manage Albums </div>
 
 <table cellpadding='4' cellspacing='0' width='100%'>
 
 <?php
 $query = mysql_query("SELECT * FROM `gallery_categories` ORDER BY cid DESC");
 while ($r = mysql_fetch_array($query)) {
 
$pictures = mysql_num_rows(mysql_query("SELECT id FROM `gallery` WHERE category='".$r['cid']."'"));
?>
 <tr>
 <td width="36" class='tablerow1' valign="top" align="center">
 <a href="./?view=admin&manager=gallery&action=albums&id=<?php echo $r['cid']; ?>">
 <img src="../uploads/gallery/thumbs/<?php echo $r['thumb']; ?>" border="0" style="border: 1px solid black;">
 </a>
 </td>
 <td width="558" align="left" valign="top" class='tablerow2'>
<h4 style="margin-bottom: 8px; font-weight:700; font-size:large; border-bottom: 1px solid #000000; width: 100%">
<?php echo $r['title']; ?>
</h4>

<div>
<?php echo $r['desc']; ?>
</div>
<br>

<div style="vertical-align:bottom">
Photos: <?php echo $pictures; ?><br />
Visits: <?php echo $r['views']; ?><br />
Added: <?php echo date("D jS M y", strtotime($r['added'])); ?>
</div>
 </td>
 </tr>
 
 
<?php
}
?>

</table>

<?php
} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>