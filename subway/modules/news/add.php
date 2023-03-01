<?php
$check = 0;
$show_forn = 1;
?>

<div class="module"><div class="mb" id='news'>
<h2>
<a style="float: right;" href="javascript:history.back(-1);">Back</a>
Add News</h2>	
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

<form method="post" name="post" action="/news?action=add">
<input type="hidden" name="action" value="doeditnews">

<b>Title:</b><br />
<input name="title" id="title" type="text" value="" style="padding: 4px; width: 99%; font-size:20px;color:#000;font-weight:bold;line-height:1.2em;font-family:arial;"  />

<br /><br />

		<textarea cols="80" id="editor1" name="editor1" rows="10">
		</textarea>
		<script>

			// This call can be placed at any point after the
			// <textarea>, or inside a <head><script> in a
			// window.onload event handler.

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.

						CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: '/browse.php',
    filebrowserUploadUrl: '/upload.php'
});

		</script>


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