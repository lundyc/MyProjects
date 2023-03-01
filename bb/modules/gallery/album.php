<?php
if (isset($_GET['AlbumID'])) {
$AlbumID = $_GET['AlbumID'];

$query = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".$AlbumID."'");
$rows = mysql_num_rows($query);

if ($rows == 0) {
echo "<center>False category</center>";
} else {

$c = mysql_fetch_array($query);
?>

<script type="text/javascript" src="scripts/lightbox.js"></script>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2><?php echo $c['title']; ?></h2>

<div class='h3'><?php echo $c['desc']; ?></div>

<div align="center">
<?php
$query2 = mysql_query("SELECT * FROM `gallery` WHERE category = '".$AlbumID."'");
$grows = mysql_num_rows($query2);

if ($grows == 0) {
echo "No Images";
}

// demo code still needs cleaned up
$i=0;
while ($r = mysql_fetch_array($query2)) {
$href = "./?view=photo&PhotoID=". $r['id'];
?>
<a href='uploads/gallery/<?php echo $r['filename']; ?>' rel="lightbox" title='"<?php echo $r['title']; ?>'><img src='uploads/gallery/thumbs/<?php echo $r['filename']; ?>' style='border: 1px solid #000000; margin: 1px ' alt='<?php echo $r['title']; ?>'/></a>

<?php
echo "\n";
    if ($i % 3 == 2) echo "<br>\n\n";
    $i++; 
}

}
}
?>
</div>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>