<?php
if (isset($_GET['delete'])) { 
mysql_query("DELETE FROM `news` WHERE `id` = '".$_GET['delete']."'");
}

if (isset($_GET['NewsID'])) { 
mysql_query("UPDATE `news` SET `OrderBy` = '".$_GET['Number']."' WHERE `id` =".$_GET['NewsID']." LIMIT 1 ;");
}
?>

<script type="text/javascript">
<!--
function del_news(id) {
if (confirm('Are you sure you want to delete this news item?')){ 

document.location.href = './?view=news&action=admin&delete='+id;
}
}
// -->
</script>

<style type="text/css">
.left-element {
float: left; 
width: 75%; 
   } 

.right-element {
float: left;
text-align: center;
width: 25%; 
   } 

</style>

<div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb2">
      <h2 class="about">News Manager</h2>


<div class="left-element">You can manage the news from here either by adding, editing, deleting or re-ordering the items. </div>
<div class="right-element"><a href="./?view=news&action=add">Add News</a></div>


<table style="width: 100%; padding: 2px; margin: 2px;">
<tr>
<td width="9%" style="font-weight: bold;">Order</td>
<td width="13%" style="font-weight: bold;">Date</td>
<td width="36%" style="font-weight: bold;">Title</td>
<td width="22%" style="font-weight: bold;">Author</td>
<td width="20%" align="center" style="">&nbsp;</td>
</tr>

<?php
$q = mysql_query("SELECT DATE_FORMAT( `date` , '%D %b' ) AS FDate, title, OrderBy, poster, id FROM `news` ORDER BY `date` DESC , `OrderBy` DESC LIMIT 0 , 30 ");
while ($r = mysql_fetch_array($q)) { 
$up = $r['OrderBy']+1;
$down = ($r['OrderBy'] == 0) ? 0 : $r['OrderBy']-1;

?>

<tr>
<td>
<a href="index.php?view=news&action=admin&NewsID=<?php echo $r['id']; ?>&Number=<?php echo $up; ?>"><img src="images/up.gif" /></a> 
<a href="index.php?view=news&action=admin&NewsID=<?php echo $r['id']; ?>&Number=<?php echo $down; ?>"><img src="images/down.gif" /></a> </td>
<td><?php echo $r['FDate']; ?></td>
<td><?php echo strlen($r['title']) > 28 ? substr($r['title'], 0, 25) . '...' : $r['title']; ?></td>
<td><?php echo IDtoFullName($r['poster']); ?></td>
<td align="center"><a href="./?view=news&action=edit&NewsID=<?php echo $r['id']; ?>">Edit</a> - <a href="javascript:del_news('<?php echo $r['id']; ?>');">Delete</a></td>
</tr>
<?php
}
?>
</table>


  </div>
  <div class="bb"><div><div></div></div></div>
</div>
