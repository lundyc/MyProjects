<div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb2">
      <h2 class="about">Band Information</h2>

<div id="links">
<?php
$query = mysql_query("SELECT `id`, `title` FROM `info` ORDER BY OrderID DESC ");
while ($l = mysql_fetch_array($query)) {
echo "<span><a href=\"./?view=about&InfoID=".$l['id']."\">".$l['title']."</a></span>\n";
}
?>

</div>

<?php
if ($_GET['InfoID'] == 4) {
include_once("modules/about/members.php");
} elseif ($_GET['InfoID'] == 7) {
include_once("modules/about/playlist.php");
} else {
?>
<div style="padding: 0 5px 5px 5px;">
<?php
$InfoID = (!isset($_GET['InfoID'])) ? 1 : $_GET['InfoID'];
$r = mysql_fetch_array(mysql_query("SELECT * FROM `info` WHERE id = '$InfoID' LIMIT 1;"));

echo $r['content'];

?>
</div>
<?php
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
