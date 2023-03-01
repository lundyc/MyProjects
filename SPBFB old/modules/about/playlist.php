<?php
if (isset($_SESSION['uid'])) { 
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
			
</div>



<?php
echo '<h2>Members Playlist</h2>';

$i = 1;
$query = mysql_query("SELECT `name`, `file` FROM `song` WHERE `hymm` = 'no' ORDER BY `name`");
while ($r = mysql_fetch_assoc($query)) {

if (!empty($r['file'])) {
echo '<a href="uploads/mp3/'.$r['file'].'" class="track';
echo ($i == 1) ? ' track-default' : '';		
echo '">';
}

echo $r['name'];
if (!empty($r['file'])) {
echo '</a>';
}
echo "<br>\n";

}

}
?>

<h2>Our Playlist</h2>

<?php
$query = mysql_query("SELECT `name` FROM `song` WHERE `hymm` = 'no' ORDER BY `name`");
while ($r = mysql_fetch_assoc($query)) {
echo $r['name'] . "<br>";
}

echo '<h3>Hymms</h3>';

$query = mysql_query("SELECT `name` FROM `song` WHERE `hymm` = 'yes' ORDER BY `name`");
while ($r = mysql_fetch_assoc($query)) {
echo $r['name'] . "<br>";
}
?>