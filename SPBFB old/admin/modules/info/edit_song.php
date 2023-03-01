<?php
if (level($_SESSION['uid']) >= 4) {

if (isset($_POST['submit'])) {
	
	if (!empty($_POST['file'])) {
	$file = ", `file` = '".mysql_real_escape_string($_POST['file'])."' ";
	} else {
	$file = '';
	}
	
	$query = "UPDATE  `song` SET  `name` =  '". mysql_real_escape_string($_POST['title'])."',
	`hymm` =  '". mysql_real_escape_string($_POST['hymm']) ."' " . $file . " WHERE  `song`.`songID` = '". mysql_real_escape_string($_GET['songID'])  ."';";
	
	mysql_query($query);
	
	echo "done";
	
	}



$query = mysql_query("SELECT `songID`, `name`, `file`, `hymm` FROM `song` WHERE `songID` = '".mysql_real_escape_string($_GET['songID'])."'");
$r = mysql_fetch_assoc($query);

?>


<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	// Local copy of jQuery selectors, for performance.
	var	my_jPlayer = $("#jquery_jplayer"),
		my_trackName = $("#jp_container .track-name"),
		my_playState = $("#jp_container .play-state"),
		my_extraPlayInfo = $("#jp_container .extra-play-info");

	// Some options
	var	opt_play_first = false, // If true, will attempt to auto-play the default track on page loads. No effect on mobile devices, like iOS.
		opt_auto_play = false, // If true, when a track is selected, it will auto-play.
		opt_text_playing = "Now playing", // Text when playing
		opt_text_selected = "Track selected"; // Text when not playing

	// A flag to capture the first track
	var first_track = true;

	// Change the time format
	$.jPlayer.timeFormat.padMin = false;
	$.jPlayer.timeFormat.padSec = false;
	$.jPlayer.timeFormat.sepMin = " min ";
	$.jPlayer.timeFormat.sepSec = " sec";

	// Initialize the play state text
	my_playState.text(opt_text_selected);

	// Instance jPlayer
	my_jPlayer.jPlayer({
		ready: function () {
			$("#jp_container .track-default").click();
		},

		timeupdate: function(event) {
			my_extraPlayInfo.text(parseInt(event.jPlayer.status.currentPercentAbsolute, 10) + "%");
		},

	play: function(event) {
			my_playState.text(opt_text_playing);
		},

		pause: function(event) {
			my_playState.text(opt_text_selected);
		},

		ended: function(event) {
			my_playState.text(opt_text_selected);
		},

		swfPath: "../js",
		cssSelectorAncestor: "#jp_container",
		supplied: "mp3",
		wmode: "window"
	});

	// Create click handlers for the different tracks
	$("#jp_container .track").click(function(e) {
		my_trackName.text($(this).text());
		my_jPlayer.jPlayer("setMedia", {
			mp3: $(this).attr("href")
		});

		if((opt_play_first && first_track) || (opt_auto_play && !first_track)) {
			my_jPlayer.jPlayer("play");
		}

		first_track = false;
		$(this).blur();
		return false;
	});

	$("#jplayer_inspector").jPlayerInspector({jPlayer:$("#jquery_jplayer")});
});
//]]>
</script>
<style>
.demo-container {
}

.demo-container ul {
	list-style-type:none;
	padding:0;
	margin:1em 0;
	width:100%;
	overflow:hidden;
}

.demo-container li {
	float:left;
	margin-right:1em;
}

.demo-container .track-name {
font-weight: bold;
}
</style>

<div class='tableborder'>
<div class='tableheaderalt'>Edit Song</div>

<form method="post" name="post" action="index.php?view=admin&manager=info&action=edit_song&songID=<?php echo  mysql_escape_string($_GET['songID']); ?>" onsubmit="return checkForm(this)">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow1'  width='19%'  valign='middle'><b>Title:</b></td>
<td  width='81%'  valign='middle' class='tablerow2'><input name="title" type="text" class="textinput" value="<?php echo $r['name']; ?>" size="60" /></td>
</tr>

<tr>
<td class='tablerow1' valign='middle'><b>Hymm?:</b></td>
<td valign='middle' class='tablerow2'>
<input type="radio" name="hymm" value="yes" <?php echo ($r['hymm'] == 'yes') ? 'checked="checked"' : ''; ?> /> yes
<input type="radio" name="hymm" value="no" <?php echo ($r['hymm'] == 'no') ? 'checked="checked"' : ''; ?> /> no 
</td>
</tr>

<tr>
    <td colspan="2" align="center" valign="top" class='tablerow1'>
	<div id="jquery_jplayer"></div>

		<!-- Using the cssSelectorAncestor option with the default cssSelector class names to enable control association of standard functions using built in features -->

		<div id="jp_container" class="demo-container">
			<p>
				<span class="play-state"></span> :
				<span class="track-name">nothing</span>
				<br>
			<span>
				<a class="jp-play" href="#">Play</a>
				<a class="jp-pause" href="#">Pause</a>
				<a class="jp-stop" href="#">Stop</a>
			</span>
				</p>
			
<div style="border: 1px dashed #333333; background-color: #cccccc; display: inline; padding: 2px; margin: 2px; float: left; padding-left: 10px; padding-right: 10px; ">
<a href="./?manager=info&action=uploader">
Upload
<br>
Song
</a>
</div>
		
	
	<?php
/*
<audio src="../uploads/mp3/King Billys on the wall.mp3" controls="controls" preload="auto">

</audio>
*/	
$handle = opendir('../uploads/mp3/');
$i = 1;
    while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {	
	

	
	echo '<div style="border: 1px solid #333333; background-color: #cccccc; display: inline; padding: 2px; margin: 2px; float: left; ">';
    
		echo '<a href="../uploads/mp3/'.$entry.'" class="track';
		echo ($i == 1) ? ' track-default' : '';		
		echo '">';
		echo $entry;
		echo '</a>';
		echo "<br>\n";
		echo '<input type="radio" name="file" value="'.$entry.'" ';
		echo ($r['file'] == $entry) ? 'checked="checked"' : '';
		echo ' />';
	echo '</div>';	
		}
    } 
    closedir($handle);
?>
</td>
</tr>

 <tr>
<td valign='middle' class='tablerow2' colspan="2">
<button type="submit" name="submit">Save</button>
</td>
</tr>

 
</table>
</form>

</div>
		</div>
<?php
} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

?>

