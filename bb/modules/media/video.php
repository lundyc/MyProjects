<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js"></script>

<script type="text/javascript">

      var flashvars =
      {
        'file':                                  'http://gdata.youtube.com/feeds/api/playlists/D1F20FCF8E9BC817?v=2',
        'playlist':                              'bottom',
        'playlistsize':                          '300',
        'stretching':                            'none',
        'shuffle':                               'false',
        'volume':                                '100',
        'frontcolor':                            '000000', // text & icons                  (green)
        'backcolor':                             'FFFFFF', // playlist background           (blue)
        'lightcolor':                            '003367', // selected text/track highlight (red)
        'screencolor':                           'FFFFFF', // screen background             (black)
        'quality':                               'true',
        'autostart':                             'false'
      };

      var params =
      {
        'allowfullscreen':                       'true',
        'allowscriptaccess':                     'always',
        'bgcolor':                               '#FFFFFF'
      };

      var attributes =
      {
        'id':                                    'playerId',
        'name':                                  'playerId'
      };

      swfobject.embedSWF('mediaplayer.swf', 'player', '450', '700', '9.0.124', false, flashvars, params, attributes);

      var player    = null;
      var playList  = null;

</script>
<div id="playercontainer" class="playercontainer" style="text-align:center;"><a id="player" class="player" href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash">Get the Flash Plugin to see this video.</a></div>

<?php
/*
$columns = "4";
$rows = "0";

$q = "SELECT * FROM `video` ORDER BY id desc";
$query = mysql_query($q);

while ($r = mysql_fetch_array($query)) {
	($i % $columns) ? $row = FALSE : $row = TRUE;
	if ($i && $row) {echo '</tr></tr>';}
	$i++;
}
?>

<table width="100%" border="0" cellpadding="5" cellspacing="0" >

<?php
$columns = "4";
$rows = "0";
$posts_per_page = 6; 
$root = getcwd();
$dir = $root . "/uploads/media/videos/";

(!$_GET['start']) ? $start = 0 : $start = $_GET['start']; 

$query = "SELECT COUNT(*) FROM `video` "; 
$result = mysql_query($query) or die (mysql_error()); 
$row = mysql_fetch_row($result); 
$total_records = $row[0]; 

if (($total_records > 0) && ($start < $total_records))  { 
$query = "SELECT * FROM `video` ORDER BY id desc LIMIT $start, $posts_per_page"; 
$result = mysql_query($query) or die (mysql_error()); 

while($r = mysql_fetch_array($result)) { 
($i % $columns) ? $row = FALSE : $row = TRUE;
if ($i && $row) {echo '</tr></tr>';}
$i++;


exec("/usr/local/bin/mplayer -vo null -ao null -frames 0 -identify ". $dir . $r['filename']. ".flv", $p);
$duration = str_replace("ID_LENGTH=", '', $p['22']);
$duration = round($duration/60, 2);

if ($duration == 0) {
$duration = "not avaliable";
}

$filesize =  round((filesize($dir . $r['filename'] . ".flv")/1048576),2);
?>
<tr>
<td class="row2" colspan="2" style="font-size:16px; border-bottom: 1px solid gray;"><strong><?php echo $r['title']; ?></strong></td>
</tr>

<tr>
<td align="center" class="row2">
<a href="./?view=media&type=watch&id=<?php echo $r['id']; ?>">
<img src="uploads/media/videos/<?php echo $r['filename']; ?>.jpg" style="border: 1px solid #444444" /></a></td>
<td valign="top" class="row2">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="150"><strong>Host Band:</strong></td>
<td width="150"><?php echo ($r['host']) ? $r['host'] : "n/a"; ?></td>
</tr>
<tr>
<td><strong>Location:</strong></td>
<td><?php echo ($r['location']) ? $r['location'] : "n/a"; ?></td>
</tr>
<tr>
<td><strong>File Duration:</strong></td>
<td><?php echo $duration; ?></td>
</tr>
<tr>
<td><strong>File Size:</strong></td>
<td><?php echo $filesize; ?>  mb</td>
</tr>
<tr>
<td><strong>Added on:</strong></td>
<td><?php echo date("d F Y", $r['added']); ?></td>
</tr>

<tr>
<td colspan="2">
<?php echo $r['description']; ?></td>
</tr>
</table>

</td>
</tr>

<?php
}
} 
?>
</table>
<?php
echo '<div id="NextPrevious">'; 
if ($start >= $posts_per_page) 
{ 
echo "<a href=?view=media&start=".($start-$posts_per_page)."> << $start </a>"; 
} 
if ($start+$posts_per_page < $total_records && $start >= 0) 
{ 
  $sum; 
  $sum = $start + 5; 
  if ($start == 0){ 
  echo "$start - <a href=?view=media&start=".($start + $posts_per_page)."> $sum >> </a>"; 
  } 
  else 
  { 
   echo " -<a href=?view=media&start=".($start + $posts_per_page)."> $sum >> </a>"; 
  } 
} 
echo '</div>';

*/
?>
