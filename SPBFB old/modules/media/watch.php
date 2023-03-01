<?php
if (is_numeric($_GET['id'])) {
$root = getcwd();
$dir = $root . "/uploads/media/videos/";

$query = "SELECT * FROM `video` WHERE id='".(int)$_GET['id']."' LIMIT 1;"; 
$result = mysql_query($query) or die (mysql_error()); 
$r = mysql_fetch_array($result);

exec("/usr/local/bin/mplayer -vo null -ao null -frames 0 -identify ". $dir . $r['filename']. ".flv", $p);
$duration = str_replace("ID_LENGTH=", '', $p['22']);
$duration = round($duration/60, 2);

if ($duration == 0) {
$duration = "not avaliable";
}

$size = filesize($dir . $r['filename'] . ".flv");
$filesize =  round(($size/1048576),2);

echo str_replace("v=", '', parse_url("http://www.youtube.com/watch?v=bGGZcOOUgdc", PHP_URL_QUERY));
?>

<div align="center">
<script type="text/javascript" src="scripts/swfobject.js"></script>

<div id="player">Please install the newest version of the adobe flashplayer and enable javascript.</div>
<script type="text/javascript">
var so = new SWFObject('mediaplayer.swf','mpl','470','320','9');
	so.addParam('allowscriptaccess','always');
	so.addParam('allowfullscreen','true');
	so.addParam('flashvars','&file=test.php?v=LY5Lc4Ihqv0 &type=video');
	so.write('player');
</script>

<script type='text/javascript'>
/*
<div id='mediaspace'>This text will be replaced</div>
// this is the demo code which works :)
  var so = new SWFObject('mediaplayer.swf','ply','450','367','9','#ffffff');
  so.addParam('allowfullscreen','true');
  so.addParam('allowscriptaccess','always');
  so.addParam('wmode','opaque');
  so.addVariable('file','http://www.youtube.com/watch%3Fv%3DLY5Lc4Ihqv0');
// %3D is equal to =
 	so.addVariable('displayheight','450'); 
	so.addVariable('height','450'); 
	so.addVariable('width','367'); 
		
	so.addVariable('showstop','true'); 
	so.addVariable('shuffle','false'); 
	so.addVariable('smoothing','true'); 
	so.addVariable('volume','100'); 
	so.addVariable('usefullscreen','false'); 
	  
  so.write('mediaspace');
  */
</script>


<div id="player1">This text will be replaced</div> 
<script type="text/javascript"> 
var so = new SWFObject('mediaplayer.swf','mpl','450','367','7'); 
so.addParam('allowfullscreen','true'); 
so.addParam('allowscriptaccess','always'); 
so.addVariable('image','uploads/media/videos/<?php echo $r['filename']; ?>.jpg');

so.addVariable('displayheight','450'); 
so.addVariable('file','uploads/media/videos/<?php echo $r['filename']; ?>.flv'); 
so.addVariable('height','450'); 
so.addVariable('width','367'); 

so.addVariable('frontcolor','0xFFFFFF'); 
so.addVariable('backcolor','0x000000'); 
so.addVariable('lightcolor','0x6666FF'); 
so.addVariable('screencolor','0xFFFFFF'); 

so.addVariable('showstop','true'); 
so.addVariable('shuffle','false'); 
so.addVariable('smoothing','true'); 
so.addVariable('volume','100'); 
so.addVariable('usefullscreen','false'); 
so.write('player1'); 
</script>
</div>


<div style="margin-left: 10px; width: 95%">
<div class="header">
<?php echo $r['title']; ?>
</div>
<div class='borderthick'></div>

<div style='float: left; width: 100px;'>Host Band</div>
<div style='float: left;'><?php echo ($r['host']) ? $r['host'] : "n/a"; ?></div>
<br>
<div style='float: left; width: 100px;'>Location</div>
<div style='float: left;'><?php echo ($r['location']) ? $r['location'] : "n/a"; ?></div>
<br>
<div style='float: left; width: 100px;'>File Duration</div>
<div style='float: left;'><?php echo $duration; ?></div>
<br>
<div style='float: left; width: 100px;'>Views</div>
<div style='float: left;'><?php echo $r['number_of_views']; ?></div>
<br>
<div style='float: left; width: 100px;'>File Size</div>
<div style='float: left;'><?php echo $filesize; ?> mb</div>
<br>
<div style='float: left; width: 100px;'>Added on</div>
<div style='float: left;'><?php echo date("d F Y", $r['added']); ?></div>
<br><br />
<?php echo nl2br($r['description']); ?>

</div>
<?php
    //update video counter
    $views_counter = $r['number_of_views'] + 1;
    $sql = "UPDATE video SET number_of_views = $views_counter WHERE id = ".(int)$_GET['id'];
    $query = @mysql_query($sql);


}
?>