<?php
if (isset($_SESSION['userID'])) {

if (isset($_GET['delete'])) { 
$mysqli->query("DELETE FROM `news` WHERE `id` = '".$_GET['delete']."';");
?>
<script>
window.location = "/news";
</script>
<?php
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
<?php 
}
?>

<div class="module"><div class="mb" id='news'>
<h2>
<?php
if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {
echo '<span style="float: right"><a href="/news?action=add">ADD</a></span>';
} 

} 
?>


News</h2>	  

<?php
$query = "SELECT `id`, DATE_FORMAT(`date`, '%W, %M %Y') as `fdate`, (SELECT `realname` FROM `profile` WHERE `poster` = `mid`) as `posterID`, 
`title`, `MainBody`, `poster` FROM `news` ORDER BY `date` DESC , `OrderBy` DESC limit 5;";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if ($result->num_rows == 0) {
echo "<center>There is currently no news in our database. Please try again later</center>";
} else {
while($r = $result->fetch_assoc()) {
$poster = '<a href="./?view=mypanel&action=profile&id='. $r['poster'].'">'.$r['posterID'].'</a>';
echo "<div class='fadelisting'><div class='header'>".stripslashes($r['title'])."</div><div class='h4'>By: <b>";
echo (isset($_SESSION['uid'])) ? $poster." " : "webmaster ";
echo "</b>on " . $r['fdate'];

if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {

echo '<span style="float: right"><a href="/news?action=edit&newsid='.$r['id'].'">edit</a> - 
<a href="/news?delete='.$r['id'].'" onclick="return confirm(\'Are you sure want to delete?\');">delete</a></span>';

} 
} 

echo "</div>";
echo "<div class='MainBody'>". stripslashes($r['MainBody']) ."</div><div style='clear: both'></div></div>";
}
}
?>
</div></div>