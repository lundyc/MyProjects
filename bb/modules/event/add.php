<?php
$check = 0;
$show_forn = 1;
?>

<div class="module"><div class="mb" id='news'>
<h2>
<a style="float: right;" href="javascript:history.back(-1);">Back</a>
Add Event</h2>	
<?php
if ($_POST['action'] == "doeditnews") {

if (empty($_POST['title'])) {
	$check = 1;
	$title_error = "Please enter a title";
}

if (empty($_POST['editor1'])) {
	$check = 1;
	$editor1_error = "please enter some news";
}

if ($check == 0) {
	$show_forn = 0;
	
	$title = $_POST['title'];
	$content = $_POST['editor1'];
	
	$q = "INSERT INTO `news`(`title`, `date`, `MainBody`, `poster`) VALUES ('".$title."', CURDATE( ), '".$content."', '".$_SESSION['uid']."');";

if (!$mysqli->query($q)) {
    echo "INSERT failed: (" . $mysqli->errno . ") " . $mysqli->error;
} 
	
	echo "<p>This news item has been added.</p>";
	?>
	<script>
	window.setTimeout(function() {
    window.location.href = '/news';
}, 2000);
 </script>
<?php
//	redirect("index.php?view=news&action=admin", 5);
}


}


if ($show_forn == 1) {

if ($check == 1) {

if (isset($title_error)) {
	echo '<div style="border: 1px solid red; background-color: pink; padding: 3px; margin: 3px;"><b>Error:</b> Please enter a title!</div>';
}

if (isset($editor1_error)) {
	echo '<div style="border: 1px solid red; background-color: pink;  padding: 3px; margin: 3px;"><b>Error:</b> Please enter content!</div>';
}

}
?>

<form method="post" name="post" action="/event?action=add">
<input type="hidden" name="action" value="doeditnews">

<b>Title:</b><br />
<input name="title" id="title" type="text" value="" style="padding: 4px; width: 99%; font-size:20px;color:#000;font-weight:bold;line-height:1.2em;font-family:arial;"  />

<br><br>
<b>Date / Time:</b><br />

<input id=":1z-sd" class="text dr-date" title="From date" size="9" autocomplete="off" style="padding: 4px; font-size: 20px; line-height:1.2em; letter-spacing: 2px;" value="<?php echo date("d/m/Y"); ?>">

<span style="margin-left: 4px; margin-right: 4px">at</span>

<input id=":1z-st" class="text dr-time" title="From time" size="7" style="padding: 4px; font-size: 20px; line-height:1.2em; letter-spacing: 2px;" value="<?php echo date("G:i"); ?>">

<br /><br />

<b>Information about Event:</b><br>
<textarea cols="80" id="info" name="info" rows="10" style="width: 100%;"></textarea>
		
<div align="center">
<input type='submit' name="submit" value='Save Changes' accesskey='s'>
</div>
</form>

<?php
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>