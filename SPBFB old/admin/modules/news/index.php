<?php
if (level($_SESSION['uid']) >= 2) {

if (isset($_GET['id'])) {

if ($_GET['a'] == "dodelete") {
mysql_query("DELETE FROM `news` WHERE id='".$_GET['id']."'") or die("Error: " . mysql_error());
mysql_query("DELETE FROM `news_comments` WHERE `NewsID` = '".$_GET['id']."'") or die("Error: " . mysql_error());

redirect("index.php?manager=news", 0);
} 

} else {

?>

<script language="javascript">
<!--	
function del_news(id)
{
if (confirm('Are you sure you want to delete this news item?'))
{document.location.href = 'index.php?manager=news&a=dodelete&id='+id;}
}
   
// -->

</script>

<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Site News </div>
  </h2>
 <p>
 	<br />
 	You can select to edit or delete news posts, viewable to the Public.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>News Overview </div>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class='tablesubheader' width='31%'>Title</td>
  <td class='tablesubheader' width='13%'>Author</td>
  <td class='tablesubheader' width='15%'>Date</td>
  <td class='tablesubheader' width='16%'>&nbsp;</td>
 </tr>
 
 <?php
 $query = mysql_query("SELECT * FROM `news` ORDER BY date DESC");
 $rows = mysql_num_rows($query);
 while ($r = mysql_fetch_array($query)) {
 
  $query2 = mysql_query("SELECT username FROM `members` WHERE id='".$r['poster']."'");
  $name = mysql_fetch_array($query2);
  
  
  $date = explode("-", $r['date']);
$date 	= date("d/m/y", mktime(0,0,0, $date['1'], $date['2'], $date['0'])); 
 ?>
 
 
 <tr>
  <td class='tablerow2'><strong><?php echo $r['title']; ?></strong></td>
  <td align='center' class='tablerow2'><i><?php echo $name['0']; ?></i></td>
  <td class='tablerow2' align='center'><?php echo $date; ?></td>
  <td class='tablerow1' align='center'>
  <div align='center' style='white-space:nowrap'>
<?php
if ( ($r['poster'] == $_SESSION['uid']) || (level($_SESSION['uid']) >= level($r['poster']) )) {
?>
<a href="index.php?manager=news&action=edit&id=<?php echo $r['id']; ?>"><img src='images/page_edit.png' border='0' alt='Edit'  /></a> <?php
} else {
echo "-";
}

if ( ($r['poster'] == $_SESSION['uid']) || (level($_SESSION['uid']) >= level($r['poster']) )) {
?>
  <a href="javascript:del_news('<?php echo $r['id']; ?>');"><img src='images/page_delete.png' border='0' alt='Delete'  /></a>
<?php
} else {
echo "-";
}
?>
</div></td>
</tr>
<?php
}
?>

 <tr>
  <td class='tablerow1' colspan='3' align='right'><strong>Total News Posts : (<?php echo $rows; ?>)</strong></td>
  <td class='tablerow1'>&nbsp;</td>
 </tr>
 </table>

<?php
}
?>

</div>

<?php
} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>