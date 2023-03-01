 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Photo Albums</h2>

<?php
$query = mysql_query("SELECT * FROM `gallery_categories` ORDER BY cid DESC");
$crows = mysql_num_rows($query);

if ($crows == 0) {
echo "<center>no categories</center>";
}

while ($c = mysql_fetch_array($query)) {

$query2 = mysql_query("SELECT * FROM `gallery` WHERE `category` = '".$c['cid']."'");
$img = mysql_num_rows($query2);

$src = "uploads/gallery/thumbs/".$c['thumb'];

$da 	= explode("-", $c['added']);
$date 	= date("d/m/Y", mktime(0, 0, 0, $da['1'], $da['2'], $da['0'])); 

?>

<a href='./?view=albums&action=album&AlbumID=<?php echo $c['cid']; ?>'>
<img class='imgborder' src='<?php echo $src; ?>' align='right' style='margin-top: 2px; margin-left: 4px; margin-right: 4px; margin-bottom: 2px; float: right;' alt='Pics'/>
</a>

<div class='h3' style="font-size:16px;">
<a href='./?view=albums&action=album&AlbumID=<?php echo $c['cid']; ?>'><?php echo $c['title']; ?></a>
</div>

<div class='desc'>
<?php echo (strlen($c['desc']) > 0) ? $c['desc'] . "<br /><br />" : ''; ?>

Photos: <?php echo $img; ?><br/>
Visits: <?php echo $c['views']; ?><br/>
Added: <?php echo $date; ?><br />
</div>

<div class='divider' style='margin-bottom: 2px; clear: both;'></div>

<?php
}
?>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>
