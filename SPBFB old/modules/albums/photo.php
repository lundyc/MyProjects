<div id="listing2_header"><span>Gallery</span> Photo</div>

<?php
if (isset($_GET['PhotoID'])) {
$r = mysql_fetch_array(safe_query("SELECT * FROM `gallery` WHERE id = '".$_GET['PhotoID']."'"));

?>
<div style='width: 100%; padding-bottom: 4px; border-bottom: 1px #000 solid;'>
<span class='header'><?php echo $r['title']; ?></span>
</div>

<div align="center">
<a href='uploads/gallery/<?php echo $r['filename'];?>'>
<img src='uploads/gallery/<?php echo $r['filename'];?>'>
</a>
</div>

<br/>
<div style='text-align: center; margin-top: 10px;'>
<div class='h3'><?php echo $r['desc']; ?></div>


<br/>
<a class='misc-header' href='./?view=album&AlbumID=<?php echo $r['category']; ?>'>Album Index</a> 
<noscript>
| <a class='misc-header' href='/photo/58286'>Previous</a>
</noscript>

</div>
<br clear='all'>
<br/>

<div id="contentmain">
<div id='threadcontainer'></div><div id='error'></div><div id='profanity'></div><div id='threadform'></div></div>

<?php
}
?>
