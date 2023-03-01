<?php
if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {

if (isset($_GET['delete'])) { 
$getsong = $mysqli->query("SELECT `file` FROM `song` WHERE `songID` = '".$_GET['delete']."';");
$song = $getsong->fetch_assoc();

if ($song['file']) {
unlink("userfiles/mp3/".$song['file']);
} 
$mysqli->query("DELETE FROM `song` WHERE `songID` = '".$_GET['delete']."'");
//$mysqli->query("DELETE FROM `profile` WHERE `mid` = '".$_GET['delete']."'");
//$mysqli->query("DELETE FROM `news` WHERE `id` = '".$_GET['delete']."';");
?>
<script>
window.location = "/about?InfoID=6";
</script>
<?php
}
}
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
		opt_auto_play = true, // If true, when a track is selected, it will auto-play.
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
		swfPath: "js",
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

});
//]]>
</script>

<style>
.demo-container {

}

.demo-container p {
text-align: center;
}

.demo-container ul {
	list-style-type:none;
	padding:0;
	margin:1em 0;
	width:100%;
	overflow:hidden;
	text-align: center;
	
}

.demo-container li {

	margin-right:1em;
}

.demo-container .track-name {
font-weight: bold;
}


#contentsong { 
  overflow:auto; 
  width: 100%; 
} 

#left, #right { 
  width: 49%;  
  padding: 2px;
} 

#left  { float:left;  }
#right { float:right; } 

#left:hover, #right:hover { 
background-color: #E9E3D1;
}
</style>
<div class="subtitle">
<?php

if ($level['admin'] == 1) {
echo '<span style="float: right;"><a href="/about?action=addsong">Add Song</a></span>';
} 
?>

Our Playlist</div>

<div id="jquery_jplayer"></div>

		<!-- Using the cssSelectorAncestor option with the default cssSelector class names to enable control association of standard functions using built in features -->

		<div id="jp_container" class="demo-container">
			<p>
				<span class="play-state"></span> :
				<span class="track-name">nothing</span>
				at <span class="extra-play-info"></span>
				of <span class="jp-duration"></span>, which is
				<span class="jp-current-time"></span>
			</p>
			<p>
				<a class="jp-play" href="#">Play</a>
				<a class="jp-pause" href="#">Pause</a>
				&nbsp;&nbsp;&nbsp;
				<a class="jp-stop" href="#">Stop</a>
				&nbsp;&nbsp;&nbsp;
					[ volume :
				<a class="jp-mute" href="#">Mute</a>
				<a class="jp-unmute" href="#">Unmute</a>
				<a class="jp-volume-bar" href="#">|&lt;----------&gt;|</a>
				<a class="jp-volume-max" href="#">Max</a> ]
			</p>
	
	<div id="contentsong">
	
<?php
$i = 1;

$pos = 'left';

$query = "SELECT `songID`, `name`, `file`, `hymm` FROM  `song` ORDER BY  `song`.`hymm` DESC ,  `name` ASC ";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

while ($r = $result->fetch_assoc()) {
$pos = ($i % 2 == 0) ? 'right' : 'left'; 


echo "<div id='".$pos."'>";

if ($level['admin'] == 1) {
echo '<span style="float: right;">';
echo '<a href="/about?action=editsong&songID='.$r['songID'] .'">Edit</a>';
echo ' - ';
echo '<a href="/about?InfoID=6&delete='.$r['songID'].'" onclick="return confirm(\'Are you sure want to delete?\');">';
echo "Delete</a> ";
echo '</span>';
} 
	
echo $i . ") ";

if (!empty($r['file'])) {
echo '<a href="/userfiles/mp3/'.$r['file'].'?t='.rand().'" class="track';
echo ($i == 1) ? ' track-default' : '';		
echo '">';
}

echo $r['name'];
if (!empty($r['file'])) {
echo '</a>';
}

echo '	</div>';
$i++;
}
echo '	</div>';
echo '</div>';
} else {
?>

<div class="subtitle">Our Playlist</div>

<?php
$query = "SELECT `name` FROM `song` WHERE `hymm` = 'no' ORDER BY `name`";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
$count = 1;
while($r = $result->fetch_assoc()) {
echo '<div style="margin: 2px 0 0 3px">';
echo $count . ") " . $r['name'];
echo '</div>';
$count++;
}
?>

<div class="subtitle">Hymms</div>
<?php
$query2 = "SELECT `name` FROM `song` WHERE `hymm` = 'yes' ORDER BY `name`";
$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
$count = 1;
while($r2 = $result2->fetch_assoc()) {
echo '<div style="margin: 2px 0 0 3px">';
echo $count . ") " .  $r2['name'];
echo '</div>';
$count++;
}

}
?>