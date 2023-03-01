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

<div class="module"><div class="mb" id='news'>
<h2>NEWS MANAGER</h2> 


<div class="left-element">You can manage the news from here either by adding, editing, deleting or re-ordering the items. </div>
<div class="right-element"><a href="./?view=news&action=add">Add News</a></div>


<table style="width: 100%; padding: 2px; margin: 2px;">
<tr>
<td width="36%" style="font-weight: bold;">Title</td>

<td width="22%" style="font-weight: bold;">Author</td>
<td width="13%" style="font-weight: bold;">Date</td>
<td width="20%" align="center" style="">&nbsp;</td>
</tr>

<?php
$query = "SELECT DATE_FORMAT( `date` , '%D %b' ) AS FDate, title, OrderBy, poster, id, 
(SELECT `realname` FROM `profile` WHERE `poster` = `mid`) as `posterID` FROM `news` ORDER BY `date` DESC , `OrderBy` DESC LIMIT 0 , 30 ";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

while($r = $result->fetch_assoc()) {
$up = $r['OrderBy']+1;
$down = ($r['OrderBy'] == 0) ? 0 : $r['OrderBy']-1;

?>

<tr>
<td><?php echo strlen($r['title']) > 28 ? substr($r['title'], 0, 25) . '...' : $r['title']; ?></td>
<td><?php echo $r['posterID']; ?></td>
<td><?php echo $r['FDate']; ?></td>
<td align="center"><a href="./?view=news&action=edit&NewsID=<?php echo $r['id']; ?>">Edit</a> - <a href="javascript:del_news('<?php echo $r['id']; ?>');">Delete</a></td>
</tr>
<?php
}
?>
</table>


  </div>
  <div class="bb"><div><div></div></div></div>
</div>
