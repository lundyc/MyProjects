 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Multimedia Centre</h2>

<div align="center">
<a href="./?view=media&type=wallpapers" class="style6">Wallpapers</a> &nbsp;&nbsp;|&nbsp;&nbsp;  
<a href="./?view=media&type=video" class="style6">Video's</a> &nbsp;</td>
</div>

<?php
if (!isset($_GET['type'])) {
$_GET['type'] = "video";
}

if (($_GET['type'] != "wallpapers") && ($_GET['type'] != "video") && ($_GET['type'] != "audio") && ($_GET['type'] != "watch")) {
die ("<br /><br /><br />ERROR: Please leave the website alone");
} 

include_once("modules/media/" . basename($_GET['type']) . ".php");
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>

