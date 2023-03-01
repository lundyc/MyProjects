<?php
$check = 0;
$show_forn = 1;
?>

<div class="module"><div class="mb" id='news'>
<h2>Edit News</h2>	

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
	
	$q = "UPDATE `news` SET 
	`title` = '".$title."', 
	`MainBody` = '".$content."' WHERE `news`.`id` = ".$_GET['newsid'].";";
	
	//$q = "INSERT INTO `news`(`title`, `date`, `MainBody`, `poster`) VALUES ('".$title."', CURDATE( ), '".$content."', '".$_SESSION['uid']."');";

if (!$mysqli->query($q)) {
    echo "INSERT failed: (" . $mysqli->errno . ") " . $mysqli->error;
} 
//	echo '<div style="border: 1px solid #B3B5B5; background-color: #E9E3D1; padding: 3px; margin: 3px;">';
	echo "<b>Congrats:</b> This item has been updated.</p>";
//	echo '</div>';
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

$query = "SELECT `id`, `OrderBy`, `title`, `date`, `MainBody`, `poster` FROM `news` WHERE `id` = '".$_GET['newsid']."'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$r = $result->fetch_assoc();

if (!$r) {
die("This news post does not exisit or has been removed by the admin");
}
?>

<form method="post" name="post" action="/news?action=edit&newsid=<?php echo $_GET['newsid']; ?>">
<input type="hidden" name="action" value="doeditnews">


<b>Title:</b><br />
<input name="title" id="title" type="text" value="<?php echo $r['title']; ?>" style="padding: 4px; width: 99%; font-size:20px;color:#000;font-weight:bold;line-height:1.2em;font-family:arial;"  />
<br /><br />


		<textarea cols="80" id="editor1" name="editor1" rows="10">
		<?php
		echo $r['MainBody'];
		?>
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
